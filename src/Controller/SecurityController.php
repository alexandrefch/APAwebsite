<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Entity\Patient;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="authenticate")
     * @return Response
     */
    public function index(): Response
    {
        if($this->getUser()!=null)
            return $this->redirectToRoute('home');

        $form = $this->createForm(
            RegistrationFormType::class,
            new User(),
            ['action' => $this->generateUrl('app_register')]
        );

        return $this->render('security/authenticate.html.twig', [
            'registrationForm' => $form->createView(),
            'error' => '',
            'lastEmail' => '',
        ]);
    }

    /**
     * @Route("/login", name="app_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        return $this->redirectToRoute(
            'authenticate',
            ['error'=>$error]
        );
    }

    /**
     * @Route("/register", name="app_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @param LoginFormAuthenticator $authenticator
     * @return Response
     * @throws \Exception
     */
    public function register(Request $request, UserPasswordEncoderInterface
    $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            do {
                $uid = User::generateUid();
            } while (
                $this->getDoctrine()
                    ->getRepository(User::class)
                    ->findBy(['uid'=>$uid]) != null
            );
            $user->setUid($uid);

            $patient = new Patient();
            $patient->setUserProfile($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->persist($patient);
            $entityManager->flush();

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->redirectToRoute('/');
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): RedirectResponse
    {
        return $this->redirectToRoute('app_authenticate');
    }
}
