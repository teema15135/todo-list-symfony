<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{   
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/login", name="login_page", methods={"POST"})
     */
    public function login(Request $request): RedirectResponse
    {
        $name = $request->get('name');
        $this->session->set('name', $name);
        return $this->redirectToRoute('todo_page');
    }
}