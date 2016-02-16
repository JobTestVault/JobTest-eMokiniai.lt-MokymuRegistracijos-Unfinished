<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/trainings")
 */
class TrainingController extends Controller {

    /**
     * @Route("/", name="trainings", options={"expose"=true})
     */
    public function indexAction(Request $request) {
        $datatable = $this->get('app.datatable.training');
        $datatable->buildDatatable();

        return $this->render('training/index.html.twig', compact('datatable'));
    }

    /**
     * @Route("/results", name="training_results", options={"expose"=true})
     */
    public function resultsAction(Request $request) {
        $datatable = $this->get('app.datatable.training');
        $datatable->buildDatatable();

        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }

    /**
     * @Route("/edit/{id}", name="training_edit", options={"expose"=true})     
     * @Route("/new", name="training_new", options={"expose"=true})
     */
    public function editAction(Request $request, $id = 0) {

        if ($id) {
            $user_repository = $this->getDoctrine()->getRepository('AppBundle:Training');
            $user = $user_repository->find($id);
            $mode = 'edit';
        } else {
            $user = new User();
            $mode = 'create';
        }

        $form_container = $this->createForm(TrainingFormType::class, $user);
        $form_container->remove('current_password')->remove('username');

        $form_container->handleRequest($request);

        if ($form_container->isSubmitted() && $form_container->isValid()) {
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);

            $request->getSession()
                    ->getFlashBag()
                    ->add('success', $this->get('translator')->trans('training.saved'));

            return $this->redirectToRoute('trainings');
        }

        $form = $form_container->createView();

        return $this->render('training/create_or_edit.html.twig', compact('form', 'mode'));
    }

}
