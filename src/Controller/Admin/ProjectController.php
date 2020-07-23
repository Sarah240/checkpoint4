<?php


namespace App\Controller\Admin;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProjectController
 * @package App\Controller\Admin
 * @Route("/admin/project")
 */

class ProjectController extends AbstractController
{

    /**
     * @Route("/index", name="project_index")
     * @param ProjectRepository $projectRepository
     * @return Response
     */
    public function index(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll();
        return $this->render("project/index.html.twig", [
            "projects" => $projects
        ]);
    }


    /**
     * @Route("/create", name="project_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($project);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "Le projet a été ajouté avec succès !");

            return $this->redirectToRoute("project_index");
        }

        return $this->render("project/create.html.twig", [
            "form" => $form->createView()
        ]);
    }


    /**
     * @Route("/{id}/update", name="project_update")
     * @param Project $project
     * @param Request $request
     * @return Response
     */
    public function update(Project $project, Request $request): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "Le projet a été modifiée avec succès !");

            return $this->redirectToRoute("project_index");
        }

        return $this->render("project/update.html.twig", [
            "form" => $form->createView()
        ]);

    }

      /**
     * @Route("/{id}/delete", name="project_delete")
     * @param Project $project
     * @return RedirectResponse
     */
    public function delete(Project $project): RedirectResponse
    {
        $this->getDoctrine()->getManager()->remove($project);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash("success", "Le projet a été supprimée avec succès !");

        return $this->redirectToRoute("project_index");
    }

}
