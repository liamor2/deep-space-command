<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

abstract class AbstractAppController extends AbstractController
{
    abstract protected function getEntityClass(): string;

    #[Route('/api/{entity}', name: 'app_entity')]
    public function index(ManagerRegistry $managerRegistry, string $entity): Response
    {
        $entityClass = $this->getEntityClass();
        $entities = $managerRegistry->getRepository($entityClass)->findAll();

        return $this->json($entities);
    }

    #[Route('/api/{entity}/{id}', name: 'app_entity_show')]
    public function show(ManagerRegistry $managerRegistry, string $entity, int $id): Response
    {
        $entityClass = $this->getEntityClass();
        $entity = $managerRegistry->getRepository($entityClass)->find($id);

        return $this->json($entity);
    }

    #[Route('/api/{entity}/{id}', name: 'app_entity_delete', methods: ['DELETE'])]
    public function delete(ManagerRegistry $managerRegistry, string $entity, int $id): Response
    {
        $entityClass = $this->getEntityClass();
        $entity = $managerRegistry->getRepository($entityClass)->find($id);

        $managerRegistry->getManager()->remove($entity);
        $managerRegistry->getManager()->flush();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }  

    #[Route('/api/{entity}', name: 'app_entity_create', methods: ['POST'])]
    public function create(ManagerRegistry $managerRegistry, Request $request, string $entity): Response
    {
        $entityClass = $this->getEntityClass();
        $entity = new $entityClass();
        $data = json_decode($request->getContent(), true);

        foreach ($data as $key => $value) {
            $setter = 'set' . ucfirst($key);
            $entity->$setter($value);
        }

        $managerRegistry->getManager()->persist($entity);
        $managerRegistry->getManager()->flush();

        return $this->json($entity, Response::HTTP_CREATED);
    }

    #[Route('/api/{entity}/{id}', name: 'app_entity_update', methods: ['PUT'])]
    public function update(ManagerRegistry $managerRegistry, Request $request, string $entity, int $id): Response
    {
        $entityClass = $this->getEntityClass();
        $entity = $managerRegistry->getRepository($entityClass)->find($id);
        $data = json_decode($request->getContent(), true);

        foreach ($data as $key => $value) {
            $setter = 'set' . ucfirst($key);
            $entity->$setter($value);
        }

        $managerRegistry->getManager()->flush();

        return $this->json($entity);
    }

    #[Route('/api/{entity}/{id}', name: 'app_entity_partial_update', methods: ['PATCH'])]
    public function partialUpdate(ManagerRegistry $managerRegistry, Request $request, string $entity, int $id): Response
    {
        $entityClass = $this->getEntityClass();
        $entity = $managerRegistry->getRepository($entityClass)->find($id);
        $data = json_decode($request->getContent(), true);

        foreach ($data as $key => $value) {
            $setter = 'set' . ucfirst($key);
            $entity->$setter($value);
        }

        $managerRegistry->getManager()->flush();

        return $this->json($entity);
    }
}