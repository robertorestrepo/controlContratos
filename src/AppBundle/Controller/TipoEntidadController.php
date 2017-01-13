<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\TipoEntidad;
use AppBundle\Form\TipoEntidadType;

/**
 * TipoEntidad controller.
 *
 * @Route("/tipoentidad")
 */
class TipoEntidadController extends Controller
{
    /**
     * Lists all TipoEntidad entities.
     *
     * @Route("/", name="tipoentidad_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tipoEntidads = $em->getRepository('AppBundle:TipoEntidad')->findAll();

        return $this->render('tipoentidad/index.html.twig', array(
            'tipoEntidads' => $tipoEntidads,
        ));
    }

    /**
     * Creates a new TipoEntidad entity.
     *
     * @Route("/new", name="tipoentidad_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tipoEntidad = new TipoEntidad();
        $form = $this->createForm('AppBundle\Form\TipoEntidadType', $tipoEntidad);
        $form->get('current')->setData(new \DateTime());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoEntidad);
            $em->flush();

            return $this->redirectToRoute('tipoentidad_show', array('id' => $tipoEntidad->getId()));
        }

        return $this->render('tipoentidad/new.html.twig', array(
            'tipoEntidad' => $tipoEntidad,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TipoEntidad entity.
     *
     * @Route("/{id}", name="tipoentidad_show")
     * @Method("GET")
     */
    public function showAction(TipoEntidad $tipoEntidad)
    {
        $deleteForm = $this->createDeleteForm($tipoEntidad);

        return $this->render('tipoentidad/show.html.twig', array(
            'tipoEntidad' => $tipoEntidad,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TipoEntidad entity.
     *
     * @Route("/{id}/edit", name="tipoentidad_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TipoEntidad $tipoEntidad)
    {
        $deleteForm = $this->createDeleteForm($tipoEntidad);
        $editForm = $this->createForm('AppBundle\Form\TipoEntidadType', $tipoEntidad);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoEntidad);
            $em->flush();

            return $this->redirectToRoute('tipoentidad_edit', array('id' => $tipoEntidad->getId()));
        }

        return $this->render('tipoentidad/edit.html.twig', array(
            'tipoEntidad' => $tipoEntidad,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TipoEntidad entity.
     *
     * @Route("/{id}", name="tipoentidad_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TipoEntidad $tipoEntidad)
    {
        $form = $this->createDeleteForm($tipoEntidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tipoEntidad);
            $em->flush();
        }

        return $this->redirectToRoute('tipoentidad_index');
    }

    /**
     * Creates a form to delete a TipoEntidad entity.
     *
     * @param TipoEntidad $tipoEntidad The TipoEntidad entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TipoEntidad $tipoEntidad)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipoentidad_delete', array('id' => $tipoEntidad->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
