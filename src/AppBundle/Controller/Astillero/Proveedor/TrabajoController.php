<?php

namespace AppBundle\Controller\Astillero\Proveedor;

use AppBundle\Entity\Astillero\Proveedor\Trabajo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Trabajo controller.
 *
 * @Route("astillero/proveedor/trabajo")
 */
class TrabajoController extends Controller
{
    /**
     * Lists all trabajo entities.
     *
     * @Route("/", name="astillero_proveedor_trabajo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $trabajos = $em->getRepository('AppBundle:Astillero\Proveedor\Trabajo')->findAll();

        return $this->render('astillero/proveedor/trabajo/index.html.twig', array(
            'trabajos' => $trabajos,
            'title' => 'Catálogo trabajos'
        ));
    }

    /**
     * Creates a new trabajo entity.
     *
     * @Route("/nuevo", name="astillero_proveedor_trabajo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $trabajo = new Trabajo();
        $form = $this->createForm('AppBundle\Form\Astillero\Proveedor\TrabajoType', $trabajo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($trabajo);
            $em->flush();

            return $this->redirectToRoute('astillero_proveedor_trabajo_index');
        }

        return $this->render('astillero/proveedor/trabajo/new.html.twig', array(
            'trabajo' => $trabajo,
            'form' => $form->createView(),
            'title' => 'Nuevo Tipo Trabajo'
        ));
    }

    /**
     * Finds and displays a trabajo entity.
     *
     * @Route("/{id}", name="astillero_proveedor_trabajo_show")
     * @Method("GET")
     */
    public function showAction(Trabajo $trabajo)
    {
        $deleteForm = $this->createDeleteForm($trabajo);

        return $this->render('astillero/proveedor/trabajo/show.html.twig', array(
            'trabajo' => $trabajo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing trabajo entity.
     *
     * @Route("/{id}/editar", name="astillero_proveedor_trabajo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Trabajo $trabajo)
    {
        $deleteForm = $this->createDeleteForm($trabajo);
        $editForm = $this->createForm('AppBundle\Form\Astillero\Proveedor\TrabajoType', $trabajo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('astillero_proveedor_trabajo_index');
        }

        return $this->render('astillero/proveedor/trabajo/edit.html.twig', array(
            'trabajo' => $trabajo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'title' => 'Editar Tipo Trabajo'
        ));
    }

    /**
     * Deletes a trabajo entity.
     *
     * @Route("/{id}", name="astillero_proveedor_trabajo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Trabajo $trabajo)
    {
        $form = $this->createDeleteForm($trabajo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($trabajo);
            $em->flush();
        }

        return $this->redirectToRoute('astillero_proveedor_trabajo_index');
    }

    /**
     * Creates a form to delete a trabajo entity.
     *
     * @param Trabajo $trabajo The trabajo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Trabajo $trabajo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('astillero_proveedor_trabajo_delete', array('id' => $trabajo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
