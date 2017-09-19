<?php

namespace Hlt\ManageurBundle\Controller;

use Hlt\ManageurBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
        $product = new Product();
        $form = $this->createFormBuilder($product)
            ->add('name', NumberType::class)
            ->add('weight', NumberType::class)
            ->add('endDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Enregistrer'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            return $this->redirectToRoute('hlt_manageur_homepage');

        }

        return $this->render('HltManageurBundle:Meal:add.html.twig', array(
            'form' => $form->createView(),
        ));


    }

    public function addProductAction(Request $request)
    {
        $product = new Product();

        $form = $this->createFormBuilder($product)
            ->add('name', NumberType::class)
            ->add('weight', NumberType::class)
            ->add('endDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Enregistrer'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

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
        return $this->render('HltManageurBundle:Meal:list.html.twig');
    }

    public function listProductAction()
    {
        return $this->render('HltManageurBundle:Product:list.html.twig');
    }

    public function menuAction()
    {

        $listMeal = '';
        $listProduct = '';

        return $this->render('HltManageurBundle:Default:menu.html.twig', array(
            'listMeal' => $listMeal,
            'listProduct' => $listProduct
        ));
    }
}

