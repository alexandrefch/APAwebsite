<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Entity\Patient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        $isDoctor = $this->getDoctrine()
                ->getRepository(Doctor::class)
                ->findBy(['userProfile'=>$this->getUser()]) != null;

        $user = $this->getUser();

        return
            $this->render('home/index.html.twig',[
                'isDoctor'=>$isDoctor,
                'user'=>$user
            ]);
    }
}