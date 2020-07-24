<?php

namespace App\Controller\Api;

use App\Repository\ClientsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ClientsController
 * @package App\Controller\Api
 * @Route("/api/clients")
 */
class ClientsController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="api_clients_collection_get")
     * @param ClientsRepository $clientsRepository
     * @return JsonResponse
     */
    public function collection(ClientsRepository $clientsRepository): JsonResponse
    {
        return $this->json($clientsRepository->findAll());
    }
}
