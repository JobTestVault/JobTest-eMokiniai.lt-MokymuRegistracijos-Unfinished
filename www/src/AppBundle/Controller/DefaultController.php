<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        $training_repository = $this->getDoctrine()->getRepository('AppBundle:Training');

        $user = $this->getUser();

        $available_trainings = $training_repository->getAvailableTrainings($user);
        $user_trainings = ($user === null) ? [] : $training_repository->getMyTrainings($user);       

        return $this->render('default/index.html.twig', compact('available_trainings', 'user_trainings'));
    }
    
    

}
