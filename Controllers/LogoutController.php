<?php

class LogoutController extends AppController
{
  protected function loadModel($model = "")
  {
  }
    protected function beforeRender()
    {
      session_reset();
      session_unset();
      session_destroy();

      setcookie("log", "", time() -3600);

      $this->redirect();
    }
}
