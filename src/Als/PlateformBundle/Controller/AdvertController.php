<?php
//
//namespace Als\PlateformBundle\Controller;
//
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\JsonResponse;
//use Symfony\Component\HttpFoundation\RedirectResponse;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
//
//class AdvertController extends Controller
//{
//    public function indexAction()
//    {
//        $url = $this->get('router')->generate('als_plateform_home', array(), true);
//        return $this->render('AlsPlateformBundle:Advert:index.html.twig',array(
//            "url" => $url
//        ));
//    }
//
//    public function viewAction($id, Request $request)
//    {
//
//        $url = $this->get('router')->generate(
//            'als_plateform_view',
//            array("id" => 5)
//        );
//
//        $tag = $request->query->get('tag');
//        return $this->render('AlsPlateformBundle:Advert:view.html.twig', array(
//            "id" => $id,
//            "url" => $url,
//            "tag" => $tag
//        ));
//    }
//
//    public function viewSlugAction($year, $slug, $_format)
//    {
////        return $view = $this->get('templating')->renderResponse('AlsPlateformBundle:Advert:viewSlug.html.twig', [
////            "year" => $year,
////            "slug" => $slug,
////            "format" => $_format
////        ]);
//        return $this->render('AlsPlateformBundle:Advert:viewSlug.html.twig', array(
//            "year" => $year,
//            "slug" => $slug,
//            "format" => $_format
//        ));
//    }
//
//    public function viewErrorAction()
//    {
//        // On crée la réponse sans lui donner de contenu pour le moment
//        $response = new Response();
//
//        // On définit le contenu
//        $response->setContent("Ceci est une page d'erreur 404");
//
//        // On définit le code HTTP à « Not Found » (erreur 404)
//        $response->setStatusCode(Response::HTTP_NOT_FOUND);
//
//        // On retourne la réponse
//        return $response;
//    }
//
//    public function redirectAction(Request $request)
//    {
////        $url = $this->get('router')->generate('als_plateform_home');
////        return new RedirectResponse($url);
//
//        $session = $request->getSession();
//
//        $session->getFlashBag('info', 'la demande a bien ete enregistree');
//
//        return $this->redirectToRoute('als_plateform_home');
//    }
//
//    public function jsonViewAction()
//    {
////        $json = new Response(json_encode([
////            "id" => 5,
////            "name" => 'Amadou',
////            "date" =>  date("m.d.y")
////        ]));
////
////        $json->headers->set('Content-Type','application/json');
////        return $json;
//        return new JsonResponse(array(
//            "id" => 5,
//            "name" => 'Amadou',
//            "date" =>  date("m.d.y")
//        ));
//    }
//
//    public function manSessionAction(Request $request)
//    {
//        $session = $request->getSession();
//        $userId = $session->get('user_id');
//        $session->set('user_id', 9);
//
//        return new Response("Je suis une page de test et je n'ai rien a dire" . $userId);
//
//    }
//}

namespace Als\PlateformBundle\Controller;

use Als\PlateformBundle\Entity\Advert;
use Als\PlateformBundle\Entity\AdvertSkill;
use Als\PlateformBundle\Entity\Application;
use Als\PlateformBundle\Entity\Image;
use Als\PlateformBundle\Form\AdvertType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AdvertController extends Controller
{
    public function indexAction($page)
    {
        // On ne sait pas combien de pages il y a
        // Mais on sait qu'une page doit être supérieure ou égale à 1
        if ($page < 1) {
            // On déclenche une exception NotFoundHttpException, cela va afficher
            // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        // Notre liste d'annonce en dur
        $listAdverts = array(
            array(
                'title'   => 'Recherche développpeur Symfony2',
                'id'      => 1,
                'author'  => 'Alexandre',
                'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
                'date'    => new \Datetime()
            ),
            array(
                'title'   => 'Mission de webmaster',
                'id'      => 2,
                'author'  => 'Hugo',
                'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
                'date'    => new \Datetime()
            ),
            array(
                'title'   => 'Offre de stage webdesigner',
                'id'      => 3,
                'author'  => 'Mathieu',
                'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
                'date'    => new \Datetime()
            )
        );


        return $this->render('AlsPlateformBundle:Advert:index.html.twig', array(
            'listAdverts' => $listAdverts
        ));
    }

    public function viewAction($id, Request $request)
    {
        // Ici, on récupérera l'annonce correspondante à l'id $id
//        $url = $this->get('router')->generate(
//            'als_plateform_view',
//             array("id" => 5)
//        );
//
//        $tag = $request->query->get('tag');
//        return $this->render('AlsPlateformBundle:Advert:view.html.twig', array(
//            "id" => $id,
//            "url" => $url,
//            "tag" => $tag
//        ));

        $em = $this->getDoctrine()->getManager();

        // On récupère l'annonce $id
        $advert = $em
            ->getRepository('AlsPlateformBundle:Advert')
            ->find($id)
        ;

        if (null === $advert) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }

        // On avait déjà récupéré la liste des candidatures
        $listApplications = $em
            ->getRepository('AlsPlateformBundle:Application')
            ->findBy(array('advert' => $advert))
        ;

        // On récupère maintenant la liste des AdvertSkill
        $listAdvertSkills = $em
            ->getRepository('AlsPlateformBundle:AdvertSkill')
            ->findBy(array('advert' => $advert))
        ;

        return $this->render('AlsPlateformBundle:Advert:view.html.twig', array(
            'advert'           => $advert,
            'listApplications' => $listApplications,
            'listAdvertSkills' => $listAdvertSkills
        ));
    }

    /**
     * @Security("has_role('ROLE_AUTEUR') and has_role('ROLE_MODERATEUR')")
     */
    public function addAction(Request $request)
    {
//        // La gestion d'un formulaire est particulière, mais l'idée est la suivante :
//
//        // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
//        if ($request->isMethod('POST')) {
//            // Ici, on s'occupera de la création et de la gestion du formulaire
//
//            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
//
//            // Puis on redirige vers la page de visualisation de cettte annonce
//            return $this->redirectToRoute('als_plateform_view', array('id' => 5));
//        }
//
//        // Si on n'est pas en POST, alors on affiche le formulaire
//        return $this->render('AlsPlateformBundle:Advert:add.html.twig');
//        $antispam = $this->get('als_plateform.antispam');
//
//        $text = '....';
//
//        if ($antispam->isSpam($text)) {
//            throw new \Exception('Votre message a été détecté comme spam !');
//        }
        // Création de l'entité

        // On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
//        if (!$this->get('security.context')->isGranted('ROLE_AUTEUR')) {
//            // Sinon on déclenche une exception « Accès interdit »
//            throw new AccessDeniedException('Accès limité aux auteurs.');
//        }


        $advert = new Advert();

        $form = $this
            ->get('form.factory')
            ->create(new AdvertType(), $advert)
        ;

        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()) {


            $em = $this->getDoctrine()->getManager();

            $listSkills = $em->getRepository('AlsPlateformBundle:Skill')->findAll();

            foreach ($listSkills as $skill) {

                $advertSkill = new AdvertSkill();
                $advertSkill->setAdvert($advert);
                $advertSkill->setSkill($skill);
                $advertSkill->setLevel('Expert');

                $em->persist($advertSkill);
            }

            $application1 = new Application();
            $application1->setAuthor('Marine');
            $application1->setContent("J'ai toutes les qualités requises.");

            $application2 = new Application();
            $application2->setAuthor('Pierre');
            $application2->setContent("Je suis très motivé.");

            $application1->setAdvert($advert);
            $application2->setAdvert($advert);

            $em->persist($advert);

            $em->persist($application1);
            $em->persist($application2);

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            return $this->redirect($this->generateUrl('als_plateform_view', array('id' => $advert->getId())));
        }

        // Reste de la méthode qu'on avait déjà écrit
//        if ($request->isMethod('POST')) {
//            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
//            return $this->redirect($this->generateUrl('als_plateform_view', array('id' => $advert->getId())));
//        }

        return $this->render('AlsPlateformBundle:Advert:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {
        // Ici, on récupérera l'annonce correspondante à $id
        // Même mécanisme que pour l'ajout
//        if ($request->isMethod('POST')) {
//            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');
//
//            return $this->redirectToRoute('als_plateform_view', array('id' => 5));
//        }
//
//        return $this->render('AlsPlateformBundle:Advert:edit.html.twig');

        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository('AlsPlateformBundle:Advert')->find($id);

        if (null === $advert) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }

        $listCategories = $em->getRepository('AlsPlateformBundle:Category')->findAll();

        foreach ($listCategories as $category) {
            $advert->addCategory($category);
        }

        $em->flush();

        return $this->render('AlsPlateformBundle:Advert:edit.html.twig', array(
            'advert' => $advert
        ));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository('AlsPlateformBundle:Advert')->find($id);

        if (null === $advert) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }

        foreach ($advert->getCategories() as $category) {
            $advert->removeCategory($category);
        }

        $em->flush();

        return $this->render('AlsPlateformBundle:Advert:delete.html.twig');
    }

    public function listAction()
    {
        $listAdverts = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AlsPlateformBundle:Advert')
            ->getAdvertWithApplications()
        ;

        foreach ($listAdverts as $advert) {

            $advert->getApplications();
        }
    }

    public function testAction()
    {
        $advert = new Advert();
        $advert->setTitle("Recherche développeur !");
        $advert->setAuthor('Marine');
        $advert->setContent("Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…");

        $em = $this->getDoctrine()->getManager();
        $em->persist($advert);
        $em->flush(); // C'est à ce moment qu'est généré le slug

        return new Response('Slug généré : '.$advert->getSlug());
        // Affiche « Slug généré : recherche-developpeur »
    }

    public function menuAction()
    {
        // On fixe en dur une liste ici, bien entendu par la suite
        // on la récupérera depuis la BDD !
        $listAdverts = array(
            array('id' => 2, 'title' => 'Recherche développeur Symfony2'),
            array('id' => 6, 'title' => 'Mission de webmaster'),
            array('id' => 9, 'title' => 'Offre de stage webdesigner')
        );

        return $this->render('AlsPlateformBundle:Advert:menu.html.twig', array(
            // Tout l'intérêt est ici : le contrôleur passe
            // les variables nécessaires au template !
            'listAdverts' => $listAdverts
        ));
    }
}