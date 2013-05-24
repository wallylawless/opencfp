<?php
namespace App\Controllers;

use Orlex\Annotation\Route;
use Orlex\ContainerAwareTrait;
use Orlex\Controller\TwigTrait;
use Orlex\Controller\FormTrait;
use Orlex\Controller\SessionTrait;
use Orlex\Controller\UrlGeneratorTrait;

use Symfony\Component\HttpFoundation\Response;

/**
 * @Route(path="/")
 */
class IndexController
{
    use ContainerAwareTrait;
    use TwigTrait;
    use FormTrait;
    use SessionTrait;
    use UrlGeneratorTrait;

    /**
     * @Route(path="/",methods={"GET"})
     */
    public function indexAction()
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route(path="/login",methods={"GET"})
     */
    public function loginAction()
    {
        $request = $this->get('request');

        $form = $this->get('form.factory')
            ->createBuilder('form')
            ->add('username', 'text', array('label' => 'Username', 'data' => $this->get('session')->get('_security.last_username')))
            ->add('password', 'password', array('label' => 'Password'))
            ->getForm();

        $lastError = $this->get('security.last_error');
        return $this->render('login.html.twig', [
            'form'  => $form->createView(),
            'error' => $lastError($request),
        ]);
    }
}
