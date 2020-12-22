<?php

namespace App\Security;

use Symfony\Component\Security\Core\User\UserInterface;

class DummyUserContainer implements UserInterface {
  private $username;
  private $password;

  public function __construct($username, $password) {
    $this->username = $username;
    $this->password = $password;
  }

  public function getRoles() {
    return [];
  }

  public function getPassword() {
    return $this->username;
  }

  public function getSalt() {
    return null;
  }

  public function getUsername() {
    return $this->username;
  }

  public function eraseCredentials() {
    // Do Nothing
  }
}
