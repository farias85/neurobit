<?php

namespace NB\BackendBundle\Controller;

use NB\CommonBundle\Entity\Procedencia;
use NB\CommonBundle\Util\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Procedencium controller.
 *
 */
class ProcedenciaController extends Controller
{
    /**
     * Lists all procedencia entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $procedencias = $em->getRepository('CommonBundle:Procedencia')->findAll();

        return $this->render('@Backend/Procedencia/index.html.twig', array(
            'procedencias' => $procedencias,
        ));
    }

    /**
     * Creates a new procedencia entity.
     *
     */
    public function newAction(Request $request)
    {
        $procedencia = new Procedencia();
        $form = $this->createForm('NB\CommonBundle\Form\ProcedenciaType', $procedencia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($procedencia);
            $em->flush();

            return $this->redirectToRoute('procedencia_index'/*, array('id' => $procedencia->getId())*/);
        }

        return $this->render('@Backend/Procedencia/new.html.twig', array(
            'procedencia' => $procedencia,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a procedencia entity.
     *
     */
    public function showAction(Procedencia $procedencia)
    {
        $deleteForm = $this->createDeleteForm($procedencia);

        return $this->render('@Backend/Procedencia/show.html.twig', array(
            'procedencia' => $procedencia,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing procedencia entity.
     *
     */
    public function editAction(Request $request, Procedencia $procedencia)
    {
        $deleteForm = $this->createDeleteForm($procedencia);
        $editForm = $this->createForm('NB\CommonBundle\Form\ProcedenciaType', $procedencia);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('procedencia_index'/*, array('id' => $procedencia->getId())*/);
        }

        return $this->render('@Backend/Procedencia/edit.html.twig', array(
            'procedencia' => $procedencia,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a procedencia entity.
     *
     */
    /* public function deleteAction(Request $request, Procedencia $procedencia)
     {
         $form = $this->createDeleteForm($procedencia);
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
             $em = $this->getDoctrine()->getManager();
             $em->remove($procedencia);
             $em->flush();
         }

         return $this->redirectToRoute('procedencia_index');
     }*/

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $procedencia = $em->getRepository(Entity::PROCEDENCIA)->find($id);
        if (!empty($procedencia)) {
            $em->remove($procedencia);
            $em->flush();
        }
        return $this->redirectToRoute('procedencia_index');
    }

    /**
     * Creates a form to delete a procedencia entity.
     *
     * @param Procedencia $procedencia The procedencia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Procedencia $procedencia)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('procedencia_delete', array('id' => $procedencia->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
