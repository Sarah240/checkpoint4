<?php

namespace App\Controller\Api;

use App\Repository\TechnoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TechnoController
 * @package App\Controller\Api
 * @Route("/api/techno")
 */
class TechnoController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="api_clients_collection_get")
     * @param TechnoRepository $technorepository
     * @return JsonResponse
     */
    public function collection(TechnoRepository $technorepository): JsonResponse
    {
        return $this->json($technorepository->findAll());
    }
}
