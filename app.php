<?php
use naCidade\Controller\IndexController;

require_once __DIR__ . "/bootstrap.php";

/**
 * Controllers
 */
$app['index.controller'] = $app->share(function () use ($app) {
    return new IndexController($app);
});

/**
 * Rotas
 */
$app->get('/{action}', function ($action) use ($app) {
    return $app['index.controller']->$action();
})->value('action', 'index');

/**
 * Método para captura de exceções
 */
$app->error(function (\Exception $e) use ($app) {
    $msg = array(
        'Um erro ocorreu' => array(
            'Mensagem' => $e->getMessage(),
            'Cod' => $e->getCode(),
            'Arquivo' => $e->getFile(),
            'Linha' => $e->getLine()
        )
    );

    return $app->json($msg);
});

$app->run();