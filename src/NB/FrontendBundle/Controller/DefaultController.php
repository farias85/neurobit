<?php

namespace NB\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontendBundle:Default:index.html.twig');
    }

    public function dispatchAction($template) {
        return $this->render('FrontendBundle:Template:' . $template . '.html.twig');
    }
}
