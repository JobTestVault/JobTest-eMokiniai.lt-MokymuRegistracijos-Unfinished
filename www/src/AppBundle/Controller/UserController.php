<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ProfileFormType;
use AppBundle\Entity\User;

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
     * @Route("/new", name="user_new", options={"expose"=true})
     */
    public function editAction(Request $request, $id = 0) { 
        
        if ($id) {
            $user_repository = $this->getDoctrine()->getRepository('AppBundle:User');
            $user = $user_repository->find($id);
            $mode = 'edit';
        } else {
            $user = new User();
            $mode = 'create';
        }
        
        $form_container = $this->createForm(ProfileFormType::class, $user);
        $form_container->remove('current_password')->remove('username');
        
        $form_container->handleRequest($request);
        
        if ($form_container->isSubmitted() && $form_container->isValid()) {
            if (!$id) {
                $user->setPlainPassword(strtolower(sha1(microtime(true))));
                $user->setPassword($user->getPlainPassword());
                $user->setCreatedAt(new \DateTime('now'));
            }            
            
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);    
            
            $request->getSession()
                    ->getFlashBag()
                    ->add('success', $this->get('translator')->trans('user.saved'));
            
            return $this->redirectToRoute('users');
        }
        
        $form = $form_container->createView();
        
        return $this->render('user/create_or_edit.html.twig', compact('form', 'mode'));
    }
    
    

}
