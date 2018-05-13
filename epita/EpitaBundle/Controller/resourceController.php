<?php

namespace Epita\EpitaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Epita\EpitaBundle\Entity\resource;
use Epita\EpitaBundle\Form\resourceType;

/**
 * resource controller.
 *
 * @Route("/resource")
 */
class resourceController extends Controller
{

    /**
     * Lists all resource entities.
     *
     * @Route("/", name="resource")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EpitaEpitaBundle:resource')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new resource entity.
     *
     * @Route("/", name="resource_create")
     * @Method("POST")
     * @Template("EpitaEpitaBundle:resource:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new resource();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('resource_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a resource entity.
     *
     * @param resource $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(resource $entity)
    {
        $form = $this->createForm(new resourceType(), $entity, array(
            'action' => $this->generateUrl('resource_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new resource entity.
     *
     * @Route("/new", name="resource_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new resource();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a resource entity.
     *
     * @Route("/{id}", name="resource_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EpitaEpitaBundle:resource')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find resource entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing resource entity.
     *
     * @Route("/{id}/edit", name="resource_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EpitaEpitaBundle:resource')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find resource entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a resource entity.
    *
    * @param resource $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(resource $entity)
    {
        $form = $this->createForm(new resourceType(), $entity, array(
            'action' => $this->generateUrl('resource_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing resource entity.
     *
     * @Route("/{id}", name="resource_update")
     * @Method("PUT")
     * @Template("EpitaEpitaBundle:resource:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EpitaEpitaBundle:resource')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find resource entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('resource_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a resource entity.
     *
     * @Route("/{id}", name="resource_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EpitaEpitaBundle:resource')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find resource entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('resource'));
    }

    /**
     * Creates a form to delete a resource entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('resource_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
}