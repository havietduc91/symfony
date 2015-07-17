<?php

// src/AppBundle/Controller/DefaultController.php
namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends Controller
{
    public function newAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->add('task', 'text')
            ->add('dueDate', 'date')
            ->add('save', 'submit', array('label' => 'Create Task'))
            ->getForm();

        $form->handleRequest($request);

        $errors = array();
        if ($form->isValid()) {
            // perform some action, such as saving the task to the database
            $data = $form->getData();
            var_dump($data);
            die();

        } else {
            $errors = $form->getErrors();
        }

        return $this->render('task/new.html.twig', array(
            'form' => $form->createView(),
            'errors' => $errors
        ));
    }
}