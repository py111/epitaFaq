<?php

namespace Epita\EpitaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Epita\EpitaBundle\Entity\User;

/**
 * Login controller.
 *
 * @Route("/login")
 */
class LoginController extends Controller {

    /**
     * Lists all Login details.
     *
     * @Route("/", name="login")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EpitaEpitaBundle:User')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Login Check.
     *
     * @Route("/", name="login_check")
     * @Method("POST")
     * @Template("EpitaEpitaBundle:Login:index.html.twig")
     */
    public function loginAction(Request $request) {
        $user = new User();
        $form = $this->createFormBuilder($user)
                ->add('username', 'text')
                ->add('password', 'password')
                ->add('save', 'submit')
                ->getForm();
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('EpitaEpitaBundle:User');
        if ($form->isValid()) {
            echo ("form validated");
            echo $user->getUsername();
        }
        echo ("form was not validated");
        return $this->render('EpitaEpitaBundle:Login:notification.html.twig');
    }

}

        /*    if ($request->getMethod() == "post") { //isvalid
          echo "hello";
          $username = $request->get('username');
          $password = $request->get('password');
          $em = $this->getDoctrine()->getEntityManager();
          $repository = $em->getRepository('EpitaEpitaBundle:User');
          $User = $repository->findOneBy(array('username' => $username, 'password' => $password));

          if ($User) {
          return $this->render('EpitaEpitaBundle:Admin:index.html.twig');
          //return $this->render('EpitaEpitaBundle:categories:show.html.twig', array('name' => $User->getClassName()));
          }
          } else {
          return $this->render('EpitaEpitaBundle:Login:notification.html.twig');
          }
          } */

