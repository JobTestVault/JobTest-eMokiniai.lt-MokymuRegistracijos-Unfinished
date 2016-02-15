<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller {        

    /**
     * @Route("/users/{page}/{limit}", name="users", defaults={"page": 1, "limit": 15})
     */
    public function indexAction(Request $request, $page = 1, $limit = 15) {
        $user_repository = $this->getDoctrine()->getRepository('AppBundle:User');
         
        $count = $user_repository->count();
        $pages = ceil($count / $limit);
        $offset = ($page - 1) * $limit;
        
        $items = $user_repository->findBy([], null, $limit, $offset);
        
        return $this->render('user/index.html.twig', compact('page', 'limit', 'pages', 'items'));
    }
    
    

}
