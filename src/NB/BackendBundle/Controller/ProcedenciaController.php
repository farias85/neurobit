<?php

namespace NB\BackendBundle\Controller;

use NB\CommonBundle\Entity\Procedencia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Procedencium controller.
 *
 */
class ProcedenciaController extends Controller
{
    /**
     * Lists all procedencium entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $procedencias = $em->getRepository('CommonBundle:Procedencia')->findAll();

        return $this->render('@Backend/procedencia/index.html.twig', array(
            'procedencias' => $procedencias,
        ));
    }

    /**
     * Creates a new procedencium entity.
     *
     */
    public function newAction(Request $request)
    {
        $procedencium = new Procedencia();
        $form = $this->createForm('NB\CommonBundle\Form\ProcedenciaType', $procedencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($procedencium);
            $em->flush();

            return $this->redirectToRoute('procedencia_index'/*, array('id' => $procedencium->getId())*/);
        }

        return $this->render('@Backend/procedencia/new.html.twig', array(
            'procedencium' => $procedencium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a procedencium entity.
     *
     */
    public function showAction(Procedencia $procedencium)
    {
        $deleteForm = $this->createDeleteForm($procedencium);

        return $this->render('@Backend/procedencia/show.html.twig', array(
            'procedencium' => $procedencium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing procedencium entity.
     *
     */
    public function editAction(Request $request, Procedencia $procedencium)
    {
        $deleteForm = $this->createDeleteForm($procedencium);
        $editForm = $this->createForm('NB\CommonBundle\Form\ProcedenciaType', $procedencium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('procedencia_index'/*, array('id' => $procedencium->getId())*/);
        }

        return $this->render('@Backend/procedencia/edit.html.twig', array(
            'procedencium' => $procedencium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a procedencium entity.
     *
     */
    public function deleteAction(Request $request, Procedencia $procedencium)
    {
        $form = $this->createDeleteForm($procedencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($procedencium);
            $em->flush();
        }

        return $this->redirectToRoute('procedencia_index');
    }

    /**
     * Creates a form to delete a procedencium entity.
     *
     * @param Procedencia $procedencium The procedencium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Procedencia $procedencium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('procedencia_delete', array('id' => $procedencium->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
