<?php

namespace naCidade\Controller;

use Symfony\Component\BrowserKit\Response;

class IndexController extends AbstractController
{

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function index()
    {
        echo 'Index Controller';
        return new Response();
    }

}