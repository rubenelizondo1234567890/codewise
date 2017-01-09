<?php

namespace RetsBundle\Controller;

use RetsBundle\Entity\RetsServers;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Retsserver controller.
 *
 * @Route("/retsservers")
 */
class RetsServersController extends Controller
{
    /**
     * Lists all retsServer entities.
     *
     * @Route("/", name="retsservers_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager('rets');

        $retsServers = $em->getRepository('RetsBundle:RetsServers')->findAll();

        return $this->render('retsservers/index.html.twig', array(
            'retsServers' => $retsServers,
        ));
    }

    /**
     * Creates a new retsServer entity.
     *
     * @Route("/new", name="retsservers_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $retsServer = new RetsServers();
        $form = $this->createForm('RetsBundle\Form\RetsServersType', $retsServer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager('rets');
            $em->persist($retsServer);
            $em->flush($retsServer);

            return $this->redirectToRoute('retsservers_show', array('id' => $retsServer->getId()));
        }

        return $this->render('retsservers/new.html.twig', array(
            'retsServer' => $retsServer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a retsServer entity.
     *
     * @Route("/{id}", name="retsservers_show")
     * @Method("GET")
     */
    public function showAction(RetsServers $retsServer)
    {
        $deleteForm = $this->createDeleteForm($retsServer);

        return $this->render('retsservers/show.html.twig', array(
            'retsServer' => $retsServer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing retsServer entity.
     *
     * @Route("/{id}/edit", name="retsservers_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, RetsServers $retsServer)
    {
        $deleteForm = $this->createDeleteForm($retsServer);
        $editForm = $this->createForm('RetsBundle\Form\RetsServersType', $retsServer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('retsservers_edit', array('id' => $retsServer->getId()));
        }

        return $this->render('retsservers/edit.html.twig', array(
            'retsServer' => $retsServer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a retsServer entity.
     *
     * @Route("/{id}", name="retsservers_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, RetsServers $retsServer)
    {
        $form = $this->createDeleteForm($retsServer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($retsServer);
            $em->flush($retsServer);
        }

        return $this->redirectToRoute('retsservers_index');
    }

    /**
     * Creates a form to delete a retsServer entity.
     *
     * @param RetsServers $retsServer The retsServer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RetsServers $retsServer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('retsservers_delete', array('id' => $retsServer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
