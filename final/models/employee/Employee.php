<?php

  namespace drmonkeyninja\final\models\employee;
  // Employee model
  class Employee {

    //Table
    private $table = "employee";
    protected $db;

    //Attributes
    private $id;
    private $name;
    private $email;
    private $designation;
    private $joining_date;

    // Result of Operations
    public $result;

    // Create connection to Database
    function __construct() {
      if (!$this->db) {
        // write the connection parameters
        $this->db = mysqli_connect('127.0.0.1','root','','notes');
      }
    }

    // Set attribute values
    public function setvalue( $name = "", $email = "", $designation = "", $joining_date = "") {
      if (empty($name)) return False;
      if (empty($email)) return False;
      if (empty($designation)) return False;
      if (empty($joining_date)) return False;
      $this->name = $name;
      $this->email = $email;
      $this->designation = $designation;
      $this->joining_date = $joining_date;
      return True;
    }

    // Set id of Employee
    public function set_id($id) {
      if ($id <= 0) return False;
      $this->id = $id;
      return True;
    }

    // Get all Employee from database
    public function get_employee() {
      $sql = "SELECT * FROM `employee`";

      $this->result = mysqli_query($this->db, $sql);

      return $this->result;
    }

    // Get single Employee from database
    public function single_employee() {
      $sql = "SELECT * FROM `employee` Where id = " . $this->id ;

      $this->result = mysqli_query($this->db, $sql);
      $datarow = $this->result->fetch_assoc();

      return $datarow;
    }

    // Insert new Employee to database
    public function new_employee() {
      try {
        $sql = "INSERT INTO `employee` (`name`, `email`,`designation`,`joining_date`)
                VALUES ('".$this->name."', '" . $this->email. "','" .$this->designation . "','" . $this->joining_date . "')";

        $this->result = mysqli_query($this->db, $sql);
        return True;

      } catch (Exception $e) {
        return False;
      }
    }

    // Update Employee in database
    public function update_employee() {
      try {
        $sql = "UPDATE `employee` SET `name` = '" . $this->name . "' , `email` = '" .$this->email. "', `designation` = '" .$this->designation. "',
                `joining_date` = '" .$this->joining_date. "' WHERE `id` = " . $this->id;

        $this->result = mysqli_query($this->db, $sql);
        return True;

      } catch (Exception $e) {
        return False;
      }
    }

    // Delete Employee record from database
    public function delete_employee() {
      try {
        $sql = "DELETE FROM `employee` WHERE `id` = " . $this->id;

        $this->result = mysqli_query($this->db, $sql);
        return True;

      } catch (Exception $e) {
        return False;
      }
    }
  }

?>
