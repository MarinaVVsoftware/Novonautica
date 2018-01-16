<?php

namespace AppBundle\Controller\Tienda;

use AppBundle\Entity\Tienda\Solicitud;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Solicitud controller.
 *
 * @Route("tienda_solicitud")
 */
class SolicitudController extends Controller
{
    /**
     * Lists all solicitud entities.
     *
     * @Route("/", name="tienda_solicitud_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $solicituds = $em->getRepository('AppBundle:Tienda\Solicitud')->findAll();

        return $this->render('tienda/solicitud/index.html.twig', array(
            'solicituds' => $solicituds,
        ));
    }

    /**
     * Creates a new solicitud entity.
     *
     * @Route("/new", name="tienda_solicitud_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $solicitud = new Solicitud();
        $form = $this->createForm('AppBundle\Form\Tienda\SolicitudType', $solicitud);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($solicitud);
            $em->flush();

            return $this->redirectToRoute('tienda_solicitud_show', array('id' => $solicitud->getId()));
        }

        return $this->render('tienda/solicitud/new.html.twig', array(
            'solicitud' => $solicitud,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a solicitud entity.
     *
     * @Route("/{id}", name="tienda_solicitud_show")
     * @Method("GET")
     */
    public function showAction(Solicitud $solicitud)
    {
        $deleteForm = $this->createDeleteForm($solicitud);

        return $this->render('tienda/solicitud/show.html.twig', array(
            'solicitud' => $solicitud,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing solicitud entity.
     *
     * @Route("/{id}/edit", name="tienda_solicitud_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Solicitud $solicitud)
    {
        $deleteForm = $this->createDeleteForm($solicitud);
        $editForm = $this->createForm('AppBundle\Form\Tienda\SolicitudType', $solicitud);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tienda_solicitud_edit', array('id' => $solicitud->getId()));
        }

        return $this->render('tienda/solicitud/edit.html.twig', array(
            'solicitud' => $solicitud,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a solicitud entity.
     *
     * @Route("/{id}", name="tienda_solicitud_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Solicitud $solicitud)
    {
        $form = $this->createDeleteForm($solicitud);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($solicitud);
            $em->flush();
        }

        return $this->redirectToRoute('tienda_solicitud_index');
    }

    /**
     * Creates a form to delete a solicitud entity.
     *
     * @param Solicitud $solicitud The solicitud entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Solicitud $solicitud)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tienda_solicitud_delete', array('id' => $solicitud->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
