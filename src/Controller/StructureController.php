<?php

namespace App\Controller;

use App\Entity\Structure;
use App\Form\StructureType;
use App\Repository\ActivityRepository;
use App\Repository\StructureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/structure")
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
     * @Route("/{id}", name="structure_show", methods={"GET"})
     */
    public function show(Structure $structure): Response
    {
        return $this->render('structure/show.html.twig', [
            'structure' => $structure,
        ]);
    }
}
