<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Form\ActivityType;
use App\Repository\ActivityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/activity")
 */
class ActivityController extends AbstractController
{
    /**
     * @Route("/", name="activity_index", methods={"GET"})
     */
    public function index(ActivityRepository $activityRepository): Response
    {
        return $this->render('activity/index.html.twig', [
            'activities' => $activityRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{structure_id}/new", name="activity_new", methods={"GET","POST"})
     */
    public function new(Request $request, int $structure_id): Response
    {
        $activity = new Activity();
        $form = $this->createForm(ActivityType::class, $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activity);
            $entityManager->flush();

            return $this->redirectToRoute('activity_index');
        }

        return $this->render('activity/new.html.twig', [
            'activity' => $activity,
            'form' => $form->createView(),
            'structure_id' => $structure_id,
        ]);
    }

    /**
     * @Route("/{id}", name="activity_show", methods={"GET"})
     */
    public function show(Activity $activity): Response
    {
        return $this->render('activity/show.html.twig', [
            'activity' => $activity,
        ]);
    }

    /**
     * @Route("/{structure_id}/{id}/edit", name="activity_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Activity $activity, int $structure_id): Response
    {
        $form = $this->createForm(ActivityType::class, $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('activity_index');
        }

        return $this->render('activity/edit.html.twig', [
            'activity' => $activity,
            'form' => $form->createView(),
            'structure_id' => $structure_id,
        ]);
    }

    /**
     * @Route("/{id}", name="activity_delete", methods={"POST"})
     */
    public function delete(Request $request, Activity $activity): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activity->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($activity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('activity_index');
    }
}
