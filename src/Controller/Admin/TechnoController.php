<?php


namespace App\Controller\Admin;

use App\Entity\Techno;
use App\Form\TechnoType;
use App\Repository\TechnoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TechnoController
 * @package App\Controller\Admin
 * @Route("/admin/techno")
 */

class TechnoController extends AbstractController
{

    /**
     * @Route("/index", name="techno_index")
     * @param TechnoRepository $technoRepository
     * @return Response
     */
    public function index(TechnoRepository $technoRepository): Response
    {
        $techno = $technoRepository->findAll();
        return $this->render("techno/index.html.twig", [
            "techno" => $techno
        ]);
    }


    /**
     * @Route("/create", name="techno_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $techno = new Techno();
        $form = $this->createForm(TechnoType::class, $techno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($techno);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "La techno a été ajouté avec succès !");

            return $this->redirectToRoute("techno_index");
        }

        return $this->render("techno/create.html.twig", [
            "form" => $form->createView()
        ]);
    }


    /**
     * @Route("/{id}/update", name="techno_update")
     * @param Techno $techno
     * @param Request $request
     * @return Response
     */
    public function update(Techno $techno, Request $request): Response
    {
        $form = $this->createForm(TechnoType::class, $techno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "La techno a été modifiée avec succès !");

            return $this->redirectToRoute("techno_index");
        }

        return $this->render("techno/update.html.twig", [
            "form" => $form->createView()
        ]);

    }

      /**
     * @Route("/{id}/delete", name="techno_delete")
     * @param Techno $techno
     * @return RedirectResponse
     */
    public function delete(Techno $techno): RedirectResponse
    {
        $this->getDoctrine()->getManager()->remove($techno);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash("success", "La techno a été supprimée avec succès !");

        return $this->redirectToRoute("techno_index");
    }

}
