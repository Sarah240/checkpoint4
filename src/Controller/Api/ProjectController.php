<?php

namespace App\Controller\Api;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProjectController
 * @package App\Controller\Api
 * @Route("/api/project")
 */
class ProjectController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="api_project_collection_get")
     * @param ProjectRepository $projectRepository
     * @return JsonResponse
     */
    public function collection(ProjectRepository $projectRepository): JsonResponse
    {
        return $this->json($projectRepository->findAll());
    }
}
