<?php

namespace Hlt\ManageurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ManageurController extends Controller
{
    public function indexAction()
    {
        return $this->render('HltManageurBundle:Default:index.html.twig');
    }

    public function addMealAction()
    {

        return $this->render('HltManageurBundle:Meal:add.html.twig');
    }

    public function addProductAction()
    {
        return $this->render('HltManageurBundle:Product:add.html.twig');
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

