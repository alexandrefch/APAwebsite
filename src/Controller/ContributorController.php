<?php

namespace App\Controller;

use App\Entity\Structure;
use App\Repository\StructureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contributor")
 */
class ContributorController extends AbstractController
{
    /**
     * @Route("/my_structure", name="my_structure", methods={"GET"})
     */
    public function my_structure(StructureRepository $structureRepository): Response
    {
        return $this->render('structure/home.html.twig', [
            'structures' => $structureRepository->findAll(),
        ]);
    }
}
