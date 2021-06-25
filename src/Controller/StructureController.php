<?php

namespace App\Controller;

use App\Entity\Structure;
use App\Form\StructureType;
use App\Repository\StructureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/structure")
 */
class StructureController extends AbstractController
{
    /**
     * @Route("/", name="structure_index", methods={"GET"})
     */
    public function index(StructureRepository $structureRepository): Response
    {
        return $this->render('structure/index.html.twig', [
            'structures' => $structureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="structure_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $structure = new Structure();
        $form = $this->createForm(StructureType::class, $structure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($structure);
            $entityManager->flush();

            return $this->redirectToRoute('structure_index');
        }

        return $this->render('structure/new.html.twig', [
            'structure' => $structure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="structure_show", methods={"GET"})
     */
    public function show(Structure $structure): Response
    {
        return $this->render('structure/show.html.twig', [
            'structure' => $structure,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="structure_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Structure $structure): Response
    {
        $form = $this->createForm(StructureType::class, $structure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
        }

        $form = $this->createForm(StructureType::class, $structure);
        return $this->render('structure/edit.html.twig', [
            'structure' => $structure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="structure_delete", methods={"POST"})
     */
    public function delete(Request $request, Structure $structure): Response
    {
        if ($this->isCsrfTokenValid('delete'.$structure->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($structure);
            $entityManager->flush();
        }

        return $this->redirectToRoute('structure_index');
    }
}
