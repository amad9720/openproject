<?php

namespace Sup\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
}
