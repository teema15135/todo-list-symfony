<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LogoutController extends AbstractController
{   
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/logout", name="logout_page", methods={"POST"})
     */
    public function logout(Request $request): RedirectResponse
    {
        $this->session->remove('name');
        return $this->redirectToRoute('index');
    }
}