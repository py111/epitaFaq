<?php

namespace Epita\EpitaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Epita\EpitaBundle\Entity\questionanswer;
use Epita\EpitaBundle\Form\questionanswerType;

/**
 * questionanswer controller.
 *
 * @Route("/questionanswer")
 */
class questionanswerController extends Controller
{

    /**
     * Lists all questionanswer entities.
     *
     * @Route("/", name="questionanswer")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EpitaEpitaBundle:questionanswer')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new questionanswer entity.
     *
     * @Route("/", name="questionanswer_create")
     * @Method("POST")
     * @Template("EpitaEpitaBundle:questionanswer:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new questionanswer();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        
        // select resources from resource, question where question.id=resource.id;

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('questionanswer_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a questionanswer entity.
     *
     * @param questionanswer $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(questionanswer $entity)
    {
        $form = $this->createForm(new questionanswerType(), $entity, array(
            'action' => $this->generateUrl('questionanswer_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new questionanswer entity.
     *
     * @Route("/new", name="questionanswer_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new questionanswer();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a questionanswer entity.
     *
     * @Route("/{id}", name="questionanswer_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $test = $em->getRepository('EpitaEpitaBundle:questionanswer')->findOneBy(['id'=>$id]);
        $entity = $em->getRepository('EpitaEpitaBundle:questionanswer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find questionanswer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing questionanswer entity.
     *
     * @Route("/{id}/edit", name="questionanswer_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EpitaEpitaBundle:questionanswer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find questionanswer entity.');
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
    * Creates a form to edit a questionanswer entity.
    *
    * @param questionanswer $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(questionanswer $entity)
    {
        $form = $this->createForm(new questionanswerType(), $entity, array(
            'action' => $this->generateUrl('questionanswer_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing questionanswer entity.
     *
     * @Route("/{id}", name="questionanswer_update")
     * @Method("PUT")
     * @Template("EpitaEpitaBundle:questionanswer:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EpitaEpitaBundle:questionanswer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find questionanswer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('questionanswer_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a questionanswer entity.
     *
     * @Route("/{id}", name="questionanswer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EpitaEpitaBundle:questionanswer')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find questionanswer entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('questionanswer'));
    }

    /**
     * Creates a form to delete a questionanswer entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('questionanswer_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
