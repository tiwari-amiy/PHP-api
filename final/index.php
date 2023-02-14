<?php

class Core {
  protected $currentController = 'Employe';
  protected $currentMethod = 'index';
  protected $params = [];

  public function __construct(){

    // Require the controller
    require_once 'controllers/'. $this->currentController . '.php';

    // Instantiate controller class
    $this->currentController = new $this->currentController;

    // Call a callback with array of params
    try {
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    } catch (\Exception $e) {
      echo "error " . $this->currentMethod;
      print_r($this->params);
    }

  }
}

  $init = new Core;
 ?>
