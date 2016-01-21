<?php
use naCidade\Controller\CadastroController;
use naCidade\Controller\IndexController;

require_once __DIR__ . "/bootstrap.php";

/**
 * Controllers
 */
$app['index.controller'] = $app->share(function () use ($app) {
    return new IndexController($app);
});

$app['cadastro.controller'] = $app->share(function () use ($app) {
    return new CadastroController($app);
});

/**
 * Rotas
 */
$app->get('/{action}', function ($action) use ($app) {
    if (method_exists($app['index.controller'], "{$action}")) {
        return $app['index.controller']->$action();
    } else {
        throw new Exception('Conteúdo não existente.');
    }
})->value('action', 'index');

$app->match('/cadastro/{action}', function ($action) use ($app) {
    if (method_exists($app['cadastro.controller'], "{$action}")) {
        return $app['cadastro.controller']->$action();
    } else {
        throw new Exception('Conteúdo não existente.');
    }
})->value('action', 'ocorrencia')->method('GET|POST');

/**
 * Método para captura de exceções
 */
$app->error(function (\Exception $e) use ($app) {
    $titulo = 'Um erro ocorreu!';
    $tipo = 'alert-danger';
    $icon = 'glyphicon-remove';
    if ($e->getCode() == 403) {
        $btVoltar = '/';
    }

    return $app['twig']->render('error/error.twig', array(
        'message' => $e->getMessage(),
        'titulo' => $titulo,
        'tipo' => $tipo,
        'icon' => $icon,
//        'btVoltar' => $btVoltar
    ));
});

$app->run();