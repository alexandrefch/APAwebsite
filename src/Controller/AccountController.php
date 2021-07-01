<?php

namespace App\Controller;

use App\Entity\Account;
use App\Form\AccountType;
use App\Repository\AccountRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class AccountController extends AbstractController
{
    /**
     * @Route("/profile", name="account_profile", methods={"GET"})
     */
    public function profile(): Response
    {
        $account = $this->getUser();
        $person = $account->getPerson();

        return $this->render('account/profile.html.twig', [
            'account' => $account,
            'person' => $person,
        ]);
    }
}
