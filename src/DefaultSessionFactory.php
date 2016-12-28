<?php

namespace Interop\Session\Utils\ArraySession\Factory;

use Interop\Session\{SessionInterface as SessionInterface, Factory\SessionFactoryInterface as SessionFactoryInterface, Manager\SessionManagerInterface as SessionManagerInterface};
use Interop\Session\Utils\ArraySession\ImmutableArraySession as Session;


class DefaultSessionFactory implements SessionFactoryInterface {

  protected $sessionManager = null;

  public function __construct(SessionManagerInterface $sessionManager) {
    $this->sessionManager = $sessionManager;
  }

  public function get(?string $prefix): SessionInterface {
    $oldActive = $this->sessionManager->isSessionActive();
    $this->sessionManager->ensureSessionHasStart();
    $s =  new Session($_SESSION, $prefix);
    if (!$oldActive) {
      $this->sessionManager->close();
    }
    return $s;
  }

}
