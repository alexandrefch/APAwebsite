<?php

namespace App\Controller;

use App\Entity\Follow;
use App\Entity\Prescription;
use App\Form\PatientType;
use App\Form\PrescriptionType;
use App\Repository\AccountRepository;
use App\Repository\FollowRepository;
use App\Repository\PrescriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile")
 */
class PatientController extends AbstractController
{
    /**
     * @Route("/", name="my_profile", methods={"GET"})
     */
    public function show(Request $request): Response
    {
        $account = $this->getUser();
        $person = $account->getPerson();

        return $this->render('patient/show.html.twig', [
            'personal' => true,
            'account' => $account,
            'person' => $person,
        ]);
    }
}
