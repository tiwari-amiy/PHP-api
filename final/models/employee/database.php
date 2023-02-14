<?php

  class Database {
    protected $db;

    function __construct() {
      if (!$this->db) {
        // write the connection parameters
        $this->db = new mysqli();
      }
    }

    public function getdb() {
      return $this->db;
    }
  }

  $temp = new Database();


?>
