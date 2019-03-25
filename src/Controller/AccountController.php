<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends BaseController
{
    /**
     * @Route("/account", name="app_account")
     */
    public function index(LoggerInterface $logger)
    {
        $logger->debug('Checking account page for '.$this->getUser()->getEmail());

        return $this->render('account/index.html.twig', [

        ]);
    }

    /**
     * @Route("/api/account", name="api_account")
     */
    public function accountApi()
    {
        $user = $this->getUser();
//        $data = [
//            'email' => $user->getEmail(),
//            'roles' => $user->getRoles(),
//            'firstName' => $user->getFirstName(),
//            'twitterUsername' => $user->getTwitterUsername()
//        ];
//
//        return new JsonResponse($data, 200);

        return $this->json($user, 200, [], [
            'groups' => ['main']
        ]);
    }
}
