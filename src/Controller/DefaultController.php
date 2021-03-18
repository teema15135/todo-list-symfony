<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function index(): Response
    {
        if (empty($this->session->get('name')))
        {
            $buttonLabel = "Enter todo-list";
            return $this->render('index.html.twig', [
                'button_label' => $buttonLabel
            ]);
        } else {
            return $this->redirectToRoute('todo_page');
        }
    }
}