<?php

namespace NB\CommonBundle\Controller;

use NB\CommonBundle\Entity\Prueba;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Prueba controller.
 *
 */
class PruebaController extends Controller
{
    /**
     * Lists all prueba entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pruebas = $em->getRepository('CommonBundle:Prueba')->findAll();

        return $this->render('prueba/index.html.twig', array(
            'pruebas' => $pruebas,
        ));
    }

    /**
     * Creates a new prueba entity.
     *
     */
    public function newAction(Request $request)
    {
        $prueba = new Prueba();
        $form = $this->createForm('NB\CommonBundle\Form\PruebaType', $prueba);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($prueba);
            $em->flush();

            return $this->redirectToRoute('prueba_index'/*, array('id' => $prueba->getId())*/);
        }

        return $this->render('prueba/new.html.twig', array(
            'prueba' => $prueba,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a prueba entity.
     *
     */
    public function showAction(Prueba $prueba)
    {
        $deleteForm = $this->createDeleteForm($prueba);

        return $this->render('prueba/show.html.twig', array(
            'prueba' => $prueba,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing prueba entity.
     *
     */
    public function editAction(Request $request, Prueba $prueba)
    {
        $deleteForm = $this->createDeleteForm($prueba);
        $editForm = $this->createForm('NB\CommonBundle\Form\PruebaType', $prueba);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prueba_index'/*, array('id' => $prueba->getId())*/);
        }

        return $this->render('prueba/edit.html.twig', array(
            'prueba' => $prueba,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a prueba entity.
     *
     */
    public function deleteAction(Request $request, Prueba $prueba)
    {
        $form = $this->createDeleteForm($prueba);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($prueba);
            $em->flush();
        }

        return $this->redirectToRoute('prueba_index');
    }

    /**
     * Creates a form to delete a prueba entity.
     *
     * @param Prueba $prueba The prueba entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Prueba $prueba)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('prueba_delete', array('id' => $prueba->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
