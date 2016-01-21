<?php
/**
 * User: maykon
 * Date: 20/01/16
 * Time: 21:43
 */

namespace naCidade\Controller;


class CadastroController extends AbstractController
{
    public function __construct($app)
    {
        $this->app = $app;
//        $this->em = $app['em'];
    }

    public function ocorrencia()
    {
        $request = $this->app['request'];
        if ($request->getMethod() == 'POST') {
            $this->salvaOcorrencia();
        }
        return $this->app['twig']->render('cadastro/ocorrencia.twig', array());
    }

    private function salvaOcorrencia()
    {
        $request = $this->app['request']->request;
        $dados = $request->all();

        $this->entity = 'naCidade\Entity\Ocorrencia';

//        $assoc = $this->getAssociationMappingToArray($this->entity);
//        $dados = $this->getAssociations($dados, $assoc);

        var_dump($dados);
        return;
    }

}