<?php

namespace App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WebController extends AbstractController {
  public function index() {
    return $this->render('web_index.html.twig');
  }
}
