<?php

namespace NB\BackendBundle\Controller;

use NB\CommonBundle\Entity\Especialidad;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Especialidad controller.
 *
 */
class EspecialidadController extends Controller
{
    /**
     * Lists all especialidad entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $especialidads = $em->getRepository('CommonBundle:Especialidad')->findAll();

        return $this->render('@Backend/Especialidad/index.html.twig', array(
            'especialidads' => $especialidads,
        ));
    }

    /**
     * Creates a new especialidad entity.
     *
     */
    public function newAction(Request $request)
    {
        $especialidad = new Especialidad();
        $form = $this->createForm('NB\CommonBundle\Form\EspecialidadType', $especialidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($especialidad);
            $em->flush();

            return $this->redirectToRoute('especialidad_index'/*, array('id' => $especialidad->getId())*/);
        }

        return $this->render('@Backend/Especialidad/new.html.twig', array(
            'especialidad' => $especialidad,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a especialidad entity.
     *
     */
    public function showAction(Especialidad $especialidad)
    {
        $deleteForm = $this->createDeleteForm($especialidad);

        return $this->render('@Backend/Especialidad/show.html.twig', array(
            'especialidad' => $especialidad,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing especialidad entity.
     *
     */
    public function editAction(Request $request, Especialidad $especialidad)
    {
        $deleteForm = $this->createDeleteForm($especialidad);
        $editForm = $this->createForm('NB\CommonBundle\Form\EspecialidadType', $especialidad);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('especialidad_index'/*, array('id' => $especialidad->getId())*/);
        }

        return $this->render('@Backend/Especialidad/edit.html.twig', array(
            'especialidad' => $especialidad,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a especialidad entity.
     *
     */
    public function deleteAction(Request $request, Especialidad $especialidad)
    {
        $form = $this->createDeleteForm($especialidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($especialidad);
            $em->flush();
        }

        return $this->redirectToRoute('especialidad_index');
    }

    /**
     * Creates a form to delete a especialidad entity.
     *
     * @param Especialidad $especialidad The especialidad entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Especialidad $especialidad)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('especialidad_delete', array('id' => $especialidad->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
