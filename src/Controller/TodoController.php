<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/todo", name="todo_page")
     */
    public function todo(Request $request): Response
    {
        $name = $this->session->get('name');
        if ($name == null)
        {
            return $this->redirectToRoute('index');
        }

        $allUserTasks = $this->session->get('tasks');
        if ($allUserTasks == null)
        {
            $tasks = [
                $name => []
            ];
            $allUserTasks = $tasks;
            $this->session->set('tasks', $allUserTasks);
        }

        $hasTasks = array_key_exists($name, $allUserTasks);
        if (!$hasTasks)
        {
            $tasks = [];
            $allUserTasks[$name] = $tasks;
            $this->session->set('tasks', $allUserTasks);
        }

        var_dump($allUserTasks);
        
        return $this->render('todo.html.twig', [
            'name' => $name,
            'tasks' => $allUserTasks[$name]
        ]);
    }

    /**
     * @Route("/todo/new", name="todo_new", methods={"POST"})
     */
    public function newTodo(Request $request): RedirectResponse
    {
        $name = $this->session->get('name');
        $allUserTasks = $this->session->get('tasks');
        $tasks = $allUserTasks[$name];

        array_push($tasks, $request->get('task'));
        $allUserTasks[$name] = $tasks;

        $this->session->set('tasks', $allUserTasks);
        
        return $this->redirectToRoute('todo_page');
    }
}