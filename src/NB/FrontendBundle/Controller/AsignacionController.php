<?php

namespace NB\FrontendBundle\Controller;

use NB\CommonBundle\Entity\Asignacion;
use NB\CommonBundle\Util\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Asignacion controller.
 *
 */
class AsignacionController extends Controller
{
    /**
     * Lists all asignacion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $asignacions = $em->getRepository('CommonBundle:Asignacion')->findAll();

        return $this->render('@Frontend/Asignacion/index.html.twig', array(
            'asignacions' => $asignacions,
        ));
    }

    /**
     * Creates a new asignacion entity.
     *
     */
    public function newAction(Request $request)
    {
        $asignacion = new Asignacion();
        $form = $this->createForm('NB\CommonBundle\Form\AsignacionType', $asignacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($asignacion);
            $em->flush();

            return $this->redirectToRoute('asignacion_index');
        }

        return $this->render('@Frontend/Asignacion/new.html.twig', array(
            'asignacion' => $asignacion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a asignacion entity.
     *
     */
    public function showAction(Asignacion $asignacion)
    {
        $deleteForm = $this->createDeleteForm($asignacion);

        return $this->render('@Frontend/Asignacion/show.html.twig', array(
            'asignacion' => $asignacion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing asignacion entity.
     *
     */
    public function editAction(Request $request, Asignacion $asignacion)
    {
        $deleteForm = $this->createDeleteForm($asignacion);
        $editForm = $this->createForm('NB\CommonBundle\Form\AsignacionType', $asignacion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('asignacion_index');
        }

        return $this->render('@Frontend/Asignacion/edit.html.twig', array(
            'asignacion' => $asignacion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a asignacion entity.
     *
     */
    /*public function deleteAction(Request $request, Asignacion $asignacion)
    {
        $form = $this->createDeleteForm($asignacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($asignacion);
            $em->flush();
        }

        return $this->redirectToRoute('asignacion_index');
    }*/
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $asignacion = $em->getRepository(Entity::ASIGNACION)->find($id);
        if (!empty($asignacion)) {
            $em->remove($asignacion);
            $em->flush();
        }
        return $this->redirectToRoute('asignacion_index');
    }
    
    /**
     * Creates a form to delete a asignacion entity.
     *
     * @param Asignacion $asignacion The asignacion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Asignacion $asignacion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('asignacion_delete', array('id' => $asignacion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
