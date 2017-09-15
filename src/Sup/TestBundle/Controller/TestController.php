<?php

namespace Sup\TestBundle\Controller;

use Sup\TestBundle\Entity\FruitList;
use Sup\TestBundle\Entity\Health;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class TestController extends Controller
{
    public function indexAction($pageName_1, $pageName_2, $id_1, $id_2)
    {


        return $this->render('SupTestBundle:Test:index.html.twig', [
            "Current" => 'Acceuil',
            "Current_id" => 1,
            "pageName_1" => $pageName_1,
            "pageName_2" => $pageName_2,
            "id_1" => $id_1,
            "id_2" => $id_2
        ]);
    }

    public function restaurantAction($pageName_1, $pageName_2, $id_1, $id_2)
    {
        return $this->render('SupTestBundle:Test:restaurant.html.twig', [
            "Current" => 'Restaurant',
            "Current_id" => 2,
            "pageName_1" => $pageName_1,
            "pageName_2" => $pageName_2,
            "id_1" => $id_1,
            "id_2" => $id_2
        ]);
    }

    public function fournisseurAction($pageName_1, $pageName_2, $id_1, $id_2)
    {
        return $this->render('SupTestBundle:Test:fournisseur.html.twig',[
            "Current" => 'Fournisseur',
            "Current_id" => 3,
            "pageName_1" => $pageName_1,
            "pageName_2" => $pageName_2,
            "id_1" => $id_1,
            "id_2" => $id_2
        ]);
    }

    public function healthCheckAction(Request $request)
    {
        // just setup a fresh $Health object
        $health = new Health();
        $fruit_list = new FruitList();
        $healthArray = Array(
            'Orange' => ($health->getOrangeFruit()),
            'Tomate' => ($health->getTomateFruit()),
            'Banane' => ($health->getBananeFruit())
        );
        $form = $this->createFormBuilder($fruit_list)
            ->add('orange', NumberType::class)
            ->add('tomate', NumberType::class)
            ->add('banane', NumberType::class)
            ->add('save', SubmitType::class, array('label' => 'Envoyer'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $health_r = $form->getData();

            $health_check = $this->get('sup_test.healthcheck');

            $resultSentence = $health_check->isHealthy($health_r,$health);

            return $this->redirectToRoute('sup_test_health_result', array(
                'result' => $resultSentence
            ));

        }

        return $this->render('@SupTest/Test/health.html.twig', array(
            'form' => $form->createView(),
            'health' => $healthArray
        ));
    }

    public function healthResultAction($result)
    {
        return $this->render('@SupTest/Test/health_result.html.twig', array(
            'result' => $result
        ));
    }
}
