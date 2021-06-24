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
        $structureCount = count($this->getDoctrine()
            ->getRepository(Structure::class)
            ->findAll());

        $activityCount = count($this->getDoctrine()
            ->getRepository(Activity::class)
            ->findAll());

        $scheduleCount = count($this->getDoctrine()
            ->getRepository(Schedule::class)
            ->findAll());

        return
            $this->render('home/index.html.twig',[
                'stats' => [
                    'structureCount' => [
                        'value' => $structureCount,
                        'desc' => 'Structures prêtes à vous accompagner'
                    ],
                    'activityCount' => [
                        'value' => $activityCount,
                        'desc' => 'Activités disponibles'
                    ],

                    'scheduleCount' => [
                        'value' => $scheduleCount,
                        'desc' => 'Créneaux par semaine possibles'
                    ],
                ]
            ]);
    }

    /**
     * @Route("/calendar", name="calendar")
     */
    public function calendar(): Response
    {
        return $this->render('home/calendar.html.twig');
    }
}