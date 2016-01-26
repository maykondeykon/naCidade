<?php

namespace naCidade\Controller;

use Symfony\Component\BrowserKit\Response;

class IndexController extends AbstractController
{

    public function __construct($app)
    {
        $this->app = $app;
//        $this->em = $app['em'];
    }

    public function index()
    {
        return $this->app['twig']->render('index/ocorrencias.twig', array(
        ));
    }

    public function login()
    {
        return $this->app['twig']->render('index/login.twig', array(
        ));
    }

}