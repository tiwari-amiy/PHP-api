<?php

  use drmonkeyninja\final\models\employee\Employee;
  use PHPUnit\Framework\TestCase;

  class EmployeeTest extends TestCase {

    public function testsetvalue() {
      $temp = new Employee();

      $this->assertTrue($temp->setvalue("Jade","jade12S@yahoo.com","intern","2020-01-01"));
    }

    public function testset_id() {
      $temp = new Employee();

      $this->assertTrue($temp->set_id(23));
    }

    public function testget_employee() {
      $temp = new Employee();
      $result = $temp->get_employee();

      $this->assertTrue($result->num_rows > 0);
    }

    public function testsingle_employee() {
      $temp = new Employee();
      $temp->set_id(1);

      $result = $temp->single_employee();

      $this->assertIsArray($result);
    }

    public function testnew_employee() {
      $temp = new Employee();
      $temp->setvalue("Jade","jade12S@yahoo.com","intern","2020-01-01");

      $this->assertTrue($temp->new_employee());
    }

    public function testupdate_employee() {
      $temp = new Employee();
      $temp->setvalue("Jade","jade12S@yahoo.com","intern","2020-01-01");
      $temp->set_id(23);

      $this->assertTrue($temp->update_employee());
    }

    public function testdelete_employee() {
      $temp = new Employee();
      $temp->set_id(23);

      $this->assertTrue($temp->delete_employee());
    }
  }

 ?>
