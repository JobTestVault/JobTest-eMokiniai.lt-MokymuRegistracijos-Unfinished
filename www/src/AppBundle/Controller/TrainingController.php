<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TrainingController extends Controller {        

    /**
     * @Route("/trainings/{page}/{limit}", name="trainings", defaults={"page": 1, "limit": 15})
     */
    public function indexAction(Request $request, $page = 1, $limit = 15) {
        $training_repository = $this->getDoctrine()->getRepository('AppBundle:Training');
         
        $count = $training_repository->count();
        $pages = ceil($count / $limit);
        $offset = ($page - 1) * $limit;
        
        $items = $training_repository->findBy([], null, $limit, $offset);
        
        return $this->render('training/index.html.twig', compact('page', 'limit', 'pages', 'items'));
    }
    
    

}
