<?php

namespace NB\FrontendBundle\Controller;

use NB\CommonBundle\Entity\Planificacion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Planificacion controller.
 *
 */
class PlanificacionController extends Controller
{
    /**
     * Lists all planificacion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $planificacions = $em->getRepository('CommonBundle:Planificacion')->findAll();

        return $this->render('@Frontend/Planificacion/index.html.twig', array(
            'planificacions' => $planificacions,
        ));
    }

    /**
     * Creates a new planificacion entity.
     *
     */
    public function newAction(Request $request)
    {
        $planificacion = new Planificacion();
        $form = $this->createForm('NB\CommonBundle\Form\PlanificacionType', $planificacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($planificacion);
            $em->flush();

            return $this->redirectToRoute('planificacion_index');
        }

        return $this->render('@Frontend/Planificacion/new.html.twig', array(
            'planificacion' => $planificacion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a planificacion entity.
     *
     */
    public function showAction(Planificacion $planificacion)
    {
        $deleteForm = $this->createDeleteForm($planificacion);

        return $this->render('@Frontend/Planificacion/show.html.twig', array(
            'planificacion' => $planificacion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing planificacion entity.
     *
     */
    public function editAction(Request $request, Planificacion $planificacion)
    {
        $deleteForm = $this->createDeleteForm($planificacion);
        $editForm = $this->createForm('NB\CommonBundle\Form\PlanificacionType', $planificacion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('planificacion_index');
        }

        return $this->render('@Frontend/Planificacion/edit.html.twig', array(
            'planificacion' => $planificacion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a planificacion entity.
     *
     */
    public function deleteAction(Request $request, Planificacion $planificacion)
    {
        $form = $this->createDeleteForm($planificacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($planificacion);
            $em->flush();
        }

        return $this->redirectToRoute('planificacion_index');
    }

    /**
     * Creates a form to delete a planificacion entity.
     *
     * @param Planificacion $planificacion The planificacion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Planificacion $planificacion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('planificacion_delete', array('id' => $planificacion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
