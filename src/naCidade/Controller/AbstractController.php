<?php

namespace naCidade\Controller;


class AbstractController
{
    protected $app;
    protected $em;
    protected $entity;

    public function insert(array $dados)
    {
        if (null != $dados) {
            $entity = new $this->entity($dados);
            $this->persist($entity);
            return $entity;
        }

        throw new \Exception("Dados vazios.");
    }

    public function update(array $dados)
    {
        if (null != $dados && isset($dados['id'])) {
            $entity = $this->em->getRepository($this->entity)->find($dados['id']);

            if ($entity) {
                $entity->__construct($dados);
                $this->persist($entity);
                return $entity;
            }
        }
        throw new \Exception("Dados vazios ou id indefinido.");
    }

    public function delete($id)
    {
        if (null != $id) {
            $entity = $this->em->getRepository($this->entity)->find($id);

            if ($entity) {
                $this->em->remove($entity);
                $this->em->flush();
                return $id;
            } else {
                throw new \Exception('Registro não encontrado.');
            }
        }
        throw new \Exception("Id indefinido.");
    }

    protected function persist($entity)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->persist($entity);
            $this->em->flush();
            $this->em->clear();
            $this->em->getConnection()->commit();
        } catch (\Exception $exc) {
            $this->em->getConnection()->rollback();
            $this->em->close();
            throw $exc;
        }

        return $entity;
    }

    public function getAssociationMappingToArray($entity)
    {
        $assoc = array();
        foreach ($this->em->getClassMetadata($entity)->getAssociationMappings() as $map) {
            $campo = $map['fieldName'];
            $metodo = 'get' . ucfirst($map['fieldName']);
            $entidade = $map['targetEntity'];

            $assoc[$campo] = [$metodo, $entidade];
        }

        return $assoc;
    }

    public function getAssociations(array $dados, array $assoc)
    {
        foreach ($assoc as $key => $value) {
            if (array_key_exists($key, $dados)) {
                $repo = $this->em->getRepository($value[1]);

                if (is_array($dados[$key])) { // Se receber um array com dados do objeto
                    $id = $dados[$key]['id']; // Seta apenas o id
                } else {
                    $id = $dados[$key];
                }

                $item = $repo->find($id); // Encontra a referência do objeto
                $dados[$key] = $item;
            }
        }
        return $dados;
    }

}