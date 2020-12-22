<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class MyGuard extends AbstractGuardAuthenticator {
  public function start(Request $request, AuthenticationException $authException = null) {
    return new RedirectResponse('/?error');
  }

  public function supports(Request $request) {
    return preg_match('/\/login-user/', $request->getPathInfo());
  }

  public function getCredentials(Request $request) {
    $results = [
      'username' => $request->get('username', NULL),
      'password' => $request->get('password', NULL)
    ];

    return $results;
  }

  public function getUser($credentials, UserProviderInterface $userProvider) {
    if ($credentials['username'] == NULL | $credentials['password'] === NULL) {
      throw new UsernameNotFoundException();
    }

    return $userProvider->loadUserByUsername($credentials['username']);
  }

  public function checkCredentials($credentials, UserInterface $user) {
    if ($credentials['password'] !== '123456') {
      return false;
    }

    return true;
  }

  public function onAuthenticationFailure(Request $request, AuthenticationException $exception) {
    return new RedirectResponse('/?error');
  }

  public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey) {
    return new RedirectResponse('/todo');
  }

  public function supportsRememberMe() {
    return true;
  }
}
