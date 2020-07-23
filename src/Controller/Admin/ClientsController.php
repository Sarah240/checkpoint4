<?php


namespace App\Controller\Admin;

use App\Entity\Clients;
use App\Form\ClientsType;
use App\Repository\ClientsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ClientsController
 * @package App\Controller\Admin
 * @Route("/admin/clients")
 */

class ClientsController extends AbstractController
{

    /**
     * @Route("/index", name="clients_index")
     * @param ClientsRepository $clientsRepository
     * @return Response
     */
    public function index(ClientsRepository $clientsRepository): Response
    {
        return $this->render("clients/index.html.twig", [
            "clients" => $clientsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create", name="clients_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $client = new Clients();
        $form = $this->createForm(ClientsType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($client);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "Le client a été ajouté avec succès !");

            return $this->redirectToRoute("clients_index");
        }

        return $this->render("clients/create.html.twig", [
            "form" => $form->createView()
        ]);
    }


    /**
     * @Route("/{id}/update", name="clients_update")
     * @param Clients $client
     * @param Request $request
     * @return Response
     */
    public function update(Clients $client, Request $request): Response
    {
        $form = $this->createForm(ClientsType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "Le client a été modifiée avec succès !");

            return $this->redirectToRoute("clients_index");
        }

        return $this->render("clients/update.html.twig", [
            "form" => $form->createView()
        ]);

    }

      /**
     * @Route("/{id}/delete", name="clients_delete")
     * @param Clients $client
     * @return RedirectResponse
     */
    public function delete(Clients $client): RedirectResponse
    {
        $this->getDoctrine()->getManager()->remove($client);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash("success", "Le client a été supprimée avec succès !");

        return $this->redirectToRoute("clients_index");
    }

}
