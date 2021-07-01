<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Entity\Schedule;
use App\Entity\Structure;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return
            $this->render('home.html.twig');
    }
}