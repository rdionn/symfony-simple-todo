<?php

namespace App\Controller\Todo;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TodoController extends AbstractController {
  public function index() {
    return $this->render('web_todos.html.twig');
  }
}
