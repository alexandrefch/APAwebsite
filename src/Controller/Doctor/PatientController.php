<?php

namespace App\Controller\Doctor;

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
 * @Route("/doctor/patient")
 */
class PatientController extends AbstractController
{
    /**
     * @Route("/", name="patient_index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        return $this->render('patient/index.html.twig', [
            'follows' => $this->getUser()->getFollows(),
        ]);
    }

    /**
     * @Route("/show/{id}", name="patient_show", methods={"GET"})
     */
    public function show(AccountRepository $accountRepository, int $id): Response
    {
        $account = $accountRepository->findOneBy(['id'=>$id]);

        if( $account == null )
            return $this->render('patient/show.html.twig', [
                'account' => null,
            ]);
        else {
            $person = $account->getPerson();

            return $this->render('patient/show.html.twig', [
                'personal' => false,
                'account' => $account,
                'person' => $person,
            ]);
        }
    }

    /**
     * @Route("/add", name="patient_add", methods={"GET","POST"})
     */
    public function add(Request $request,AccountRepository $accountRepository, FollowRepository $followRepository): Response
    {
        $form = $this->createForm(PatientType::class);
        $form->handleRequest($request);
        $errors=[];

        if ($form->isSubmitted() && $form->isValid()) {
            $doctorAccount = $this->getUser();
            $patientEmail = $form->get('email')->getData();

            if($patientEmail==$doctorAccount->getEmail())
            {
                array_push($errors,'Vous ne pouvez pas vous suivre vous même !');
            }
            else
            {
                $patient = $accountRepository->findOneBy(['email'=>$patientEmail]);
                if( !$patient )
                {
                    array_push($errors,"Aucun patient trouvé pour l'email suivant '$patientEmail'");
                }
                else
                {
                    $alreadyFollow = $followRepository->findOneBy(['doctor'=>$doctorAccount,'patient'=>$patient])!=null;

                    if( !$alreadyFollow )
                    {
                        $follow = new Follow();
                        $follow->setDoctor($doctorAccount);
                        $follow->setPatient($patient);
                        $follow->setSince(new \DateTime("now"));

                        $doctorAccount->addFollow($follow);

                        $entityManager = $this->getDoctrine()->getManager();
                        $entityManager->persist($follow);
                        $entityManager->persist($doctorAccount);
                        $entityManager->flush();
                    }

                    return $this->redirectToRoute('patient_show', [ 'id'  => $patient->getId() ]);
                }
            }
        }

        $form = $this->createForm(PatientType::class);
        return $this->render('patient/add.html.twig',[
            'form' => $form->createView(),
            'errors' => $errors
        ]);
    }
}
