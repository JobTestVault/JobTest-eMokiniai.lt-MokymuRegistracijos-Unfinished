<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/users")
 */
class UserController extends Controller {

    /**
     * @Route("/", name="users", options={"expose"=true})
     */
    public function indexAction(Request $request) {
        $datatable = $this->get('app.datatable.user');
        $datatable->buildDatatable();

        return $this->render('user/index.html.twig', compact('datatable'));
    }

    /**
     * @Route("/results", name="user_results", options={"expose"=true})
     */
    public function resultsAction(Request $request) {
        $datatable = $this->get('app.datatable.user');
        $datatable->buildDatatable();

        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }
    
     /**
     * @Route("/edit/{id}", name="user_edit", options={"expose"=true})
     */
    public function editAction(Request $request, $id) { 
        
    }
    
    

}
