<?php

namespace Hlt\ManageurBundle\Controller;

use Hlt\ManageurBundle\Entity\Meal;
use Hlt\ManageurBundle\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class ManageurController extends Controller
{
    public function indexAction()
    {
        return $this->render('HltManageurBundle:Default:index.html.twig');
    }

    public function addMealAction(Request $request)
    {
        // just setup a fresh $Health object
        $meal = new Meal();
        $form = $this->createFormBuilder($meal)
            ->add('name',TextType::class)
            ->add('product_1', EntityType::class, array(
                // query choices from this entity
                'class' => 'Hlt\ManageurBundle\Entity\Product',

                // use the User.username property as the visible option string
                'choice_label' => function(Product $product){
                    if (!$product->getIsUsed()) return $product->getName();
                    return 'En Manque';
                },
            ))
            ->add('product_2', EntityType::class, array(
                // query choices from this entity
                'class' => 'Hlt\ManageurBundle\Entity\Product',

                // use the User.username property as the visible option string
                'choice_label' => function(Product $product){
                    if (!$product->getIsUsed()) return $product->getName();
                    return 'En Manque';
                },
            ))
            ->add('product_3', EntityType::class, array(
                // query choices from this entity
                'class' => 'Hlt\ManageurBundle\Entity\Product',

                // use the User.username property as the visible option string
                'choice_label' => function(Product $product){
                    if (!$product->getIsUsed()) return $product->getName();
                    return 'En Manque';
                },
            ))
            ->add('save', SubmitType::class, array('label' => 'Enregistrer'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $meal = $form->getData();

            $product_1 = $meal->getProduct1();
            $product_2 = $meal->getProduct2();
            $product_3 = $meal->getProduct3();

            $em = $this->getDoctrine()->getManager();

            $product_1->setMeal($meal)->setIsUsed(true);
            $product_2->setMeal($meal)->setIsUsed(true);
            $product_3->setMeal($meal)->setIsUsed(true);

            //service is used here
            $health_checker = $this->get('hlt_manageur.healthcheck');

            $meal->setIsHealthy($health_checker->isHealthy($meal));

            $em->persist($meal);
            $em->flush();

//            return $this->redirectToRoute('hlt_manageur_homepage');

        }

        return $this->render('HltManageurBundle:Meal:add.html.twig', array(
            'form' => $form->createView(),
        ));


    }

    public function addProductAction(Request $request)
    {
        $product = new Product();

        $form = $this->createFormBuilder($product)
            ->add('name', TextType::class)
            ->add('weight', NumberType::class)
            ->add('endDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Enregistrer'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $product = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('hlt_manageur_homepage');

        }

        return $this->render('HltManageurBundle:Product:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function deleteMealAction()
    {
        return $this->render('HltManageurBundle:Meal:delete.html.twig');
    }

    public function deleteProductAction()
    {
        return $this->render('HltManageurBundle:Product:delete.html.twig');
    }

    public function editMealAction()
    {
        return $this->render('HltManageurBundle:Meal:edit.html.twig');
    }

    public function editProductAction()
    {
        return $this->render('HltManageurBundle:Product:edit.html.twig');
    }

    public function viewMealAction()
    {
        return $this->render('HltManageurBundle:Meal:view.html.twig');
    }

    public function viewProductAction()
    {
        return $this->render('HltManageurBundle:Product:view.html.twig');
    }

    public function listMealAction()
    {
        $em = $this->getDoctrine()->getManager();
        $mealList = $em->getRepository('HltManageurBundle:Meal')->findAll();

        return $this->render('HltManageurBundle:Meal:list.html.twig', array(
            "mealList" => $mealList
        ));
    }

    public function listProductAction()
    {
        $em = $this->getDoctrine()->getManager();
        $productList = $em->getRepository('HltManageurBundle:Product')->findAll();

        return $this->render('HltManageurBundle:Product:list.html.twig', array(
            "productList" => $productList
        ));
    }

    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $productList = $em->getRepository('HltManageurBundle:Product')->findAll();
        $mealList = $em->getRepository('HltManageurBundle:Meal')->findAll();



        return $this->render('HltManageurBundle:Default:menu.html.twig', array(
            'mealList' => $mealList,
            'productList' => $productList
        ));
    }
}

