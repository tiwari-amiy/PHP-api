<?php

  class Database {
    protected $db;

    function __construct() {
      if (!$this->db) {
        // write the connection parameters
        $this->db = new mysqli('127.0.0.1','root','','notes');
      }
    }

    public function getdb() {
      return $this->db;
    }
  }

  $temp = new Database();


?>
