<?php

namespace App\Security;

use App\Security\DummyUserContainer;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class MyProvider implements UserProviderInterface {
  public function loadUserByUsername(string $username)
  {
    return $this->createDummyUser($username);
  }

  public function supportsClass($class) {
    return $class === DummyUserContainer::class;
  }

  public function refreshUser(UserInterface $user)
  {
    if ($user instanceof DummyUserContainer) {
      return $user;
    }

    throw new UnsupportedUserException(sprintf('Invalid user class "%s".', get_class($user)));
  }

  private function createDummyUser($username) {
    if ($username === 'Rizal') {
      return new DummyUserContainer($username, '123456');
    } else if ($username === 'Anyone') {
      return new DummyUserContainer('Anyone', '123456');
    }

    throw new UsernameNotFoundException();
  }
}
