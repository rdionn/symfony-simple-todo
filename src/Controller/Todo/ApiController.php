<?php

namespace App\Controller\Todo;

use App\Repository\TodoRepository;
use App\Entity\Todo;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends AbstractController {
  private $todoRepo;

  public function __construct(TodoRepository $repo) {
    $this->todoRepo = $repo;
  }

  public function getTodos(Request $request) {
    $status = $request->get('status', NULL);
    $todos = $this->todoRepo->findBy([ 'status' => $status ]);

    return $this->json(
      [
        'status' => 200,
        'data' => $todos
      ]
    );
  }

  public function makeTodo(Request $request) {
    $name = $request->get('name', '');
    $desc = $request->get('desc', '');
    $status = $request->get('status', '');

    $entityManager = $this->getDoctrine()->getManager();

    $todo = new Todo();
    $todo->setName($name);
    $todo->setStatus($status);
    $todo->setDescription($desc);
    $todo->setUserName($this->getUser()->getUsername());

    $entityManager->persist($todo);
    $entityManager->flush();

    return $this->json([
      'status' => 200,
      'data' => []
    ]);
  }

  public function completeTodo(Request $request) {
    $id = $request->get('id', NULL);

    if ($id === NULL) {
      return $this->json([
        'status' => 400,
        'data' => []
      ]);
    }

    $todo = $this->todoRepo->findOneBy(['id' => $id]);

    if ($todo !== NULL) {
      $todo->setStatus('COMPLETE');

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($todo);
      $entityManager->flush();

      return $this->json([
        'status' => 200,
        'data' => []
      ]);
    }

    return $this->json([
      'status' => 404,
      'data' => []
    ]);
  }
}
