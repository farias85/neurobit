<?php

namespace NB\FrontendBundle\Controller;

use NB\CommonBundle\Entity\Asignacion;
use NB\CommonBundle\Entity\Planificacion;
use NB\CommonBundle\Util\Entity;
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

    public function index2Action()
    {
        $em = $this->getDoctrine()->getManager();
        $asignacion = new Asignacion();
        $form1 = $this->createForm('NB\CommonBundle\Form\AsignacionType', $asignacion);
        $planificacion = new Planificacion();
        $form2 = $this->createForm('NB\CommonBundle\Form\Planificacion2Type', $planificacion);
        $equipos = $this->findArrayResult(Entity::EQUIPO);
        $pruebas = $this->findArrayResult(Entity::PRUEBA);
        return $this->render("@Frontend/Planificacion/index2.html.twig", array(
            'equipos' => $equipos,
            'pruebas' => $pruebas,
            'form1' => $form1->createView(),
            'form2' => $form2->createView(),
        ));
    }

    /**
     * @param $entity string
     * @param $orderBy string
     */
    public function findArrayResult($entity, $orderBy = 'nombre')
    {
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository($entity)
            ->createQueryBuilder('e')
            ->orderBy('e.' . $orderBy, 'ASC')
            ->getQuery()
            ->getArrayResult();
        return $result;
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
            $data = $form->getData();
            $f = $data->getFecha();
            $planificacion->setFecha(new \DateTime($f));
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
            $data = $editForm->getData();
            $f = $data->getFecha();
            $planificacion->setFecha(new \DateTime($f));
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
    /*public function deleteAction(Request $request, Planificacion $planificacion)
    {
        $form = $this->createDeleteForm($planificacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($planificacion);
            $em->flush();
        }

        return $this->redirectToRoute('planificacion_index');
    }*/

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $planificacion = $em->getRepository(Entity::PLANIFICACION)->find($id);
        if (!empty($planificacion)) {
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
            ->getForm();
    }
}
