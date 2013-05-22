<?php
namespace App\Controllers;

use Orlex\Annotation\Route;
use Orlex\Annotation\Before;
use Orlex\Annotation\After;
use Orlex\ContainerAwareTrait;
use Orlex\Controller\TwigTrait;

use Symfony\Component\HttpFoundation\Response;

/**
 * @Route(path="/")
 */
class IndexController
{
    use ContainerAwareTrait;
    use TwigTrait;

    /**
     * @Route(path="/",methods={"GET"})
     */
    public function indexAction()
    {
        return $this->render('index.html.twig');
    }
}
