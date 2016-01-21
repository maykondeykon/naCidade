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
        return $this->app['twig']->render('cadastro/ocorrencia.twig', array(
        ));
    }

    public function tt(){
    }

}