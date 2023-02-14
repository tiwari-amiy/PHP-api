<?php

  use PHPUnit\Framework\TestCase;

  class EmployeTest extends TestCase {

    public function testall() {
      $url = 'http://localhost/final/Employe';
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
      $response = json_decode($response);
      curl_close($ch);

      $this->assertEquals(200, $response->status);
    }

    public function testinsert() {
      $url = 'http://localhost/final/Employe';
      $ch = curl_init($url);

      $postData = array();
      $postData['name'] = "joe";
      $postData['email'] = "joe@yahoo.com";
      $postData['designation'] = "manager";
      $postData['joining_date'] = "2011-01-01";

      curl_setopt_array($ch, array(
        CURLOPT_POST => TRUE, CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
        CURLOPT_POSTFIELDS => json_encode($postData)
      ));
      $response = curl_exec($ch);
      $response = json_decode($response);
      curl_close($ch);

      $this->assertEquals(200, $response->status);
    }

    public function testupdate() {
      $url = 'http://localhost/final/Employe';

      $ch = curl_init($url);
      $postData = array();
      $postData['id'] = "23";
      $postData['name'] = "joe";
      $postData['email'] = "joe@yahoo.com";
      $postData['designation'] = "manager";
      $postData['joining_date'] = "2011-01-01";

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      $headers = [];
      $headers[] = 'Content-Type:application/json';
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

      $result = curl_exec($ch);
      $result = json_decode($result);
      curl_close($ch);

      $this->assertEquals(200, $result->status);
    }

    public function testdelete() {
      $url = 'http://localhost/final/Employe';
      $postData = array();
      $postData['id'] = "23";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
      $result = curl_exec($ch);
      $result = json_decode($result);

      curl_close($ch);

      $this->assertEquals(200, $result->status);
    }
  }

 ?>
