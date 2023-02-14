<?php
  include 'models/employee/employee.php';

  // Controller for performing operations on Employee
  class Employe{

    // Create a Employee model
    public function __construct() {
        $this->temp = new Employee();

        $this->response = array();
        $this->response['status'] = 200;

        header("Content-Type: application/json");

    }

    // Print the error when we are unable to do operation
    public function raise_error($code,$str) {
      http_response_code($code);
      $this->response['status'] = $code;
      $this->response['message'] = $str;
      echo json_encode($this->response);
    }

    // It direct the api Call's according to method
    public function index() {

      switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET' :
              $this->all();
              break;
        case 'POST' :
              $this->insert();
              break;
        case 'PUT' :
              $this->update();
              break;
        case "DELETE" :
              $this->delete();
              break;
      }

    }

    // Fetches details of all Employee
    public function all() {
      $records = $this->temp->get_employee();
      $count = $records->num_rows;

      if ($count > 0) {
        $this->response['body'] = array();
        $this->response['EmployeeCount'] = $count;

        while ($row = $records->fetch_assoc()) {
          array_push($this->response['body'],$row);
        }
        http_response_code(200);
        $this->response['message'] = "Records found.";
        echo json_encode($this->response);
      }
      else {
        $this->raise_error(400, "No record found.");
      }
    }

    // Fetch details of a single Employee
    public function get($id = "") {

      if ($id) {

        $this->temp->set_id($id);
        $record = $this->temp->single_employee();

        if ($record) {
          $this->response['body'] = array();

          array_push($this->response['body'],$record);

          http_response_code(200);
          $this->response['message'] = "Record found.";
          echo json_encode($this->response);
        }
        else {
          $this->raise_error(404,"No record found.");
        }
      }
      else {
        $this->raise_error(400,"Bad Request");
      }
    }

    // Insert details of new Employee
    public function insert() {
      $_POST = json_decode(file_get_contents("php://input"), true);

      if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['designation']) && isset($_POST['joining_date'])) {

        $this->temp->setvalue($_POST['name'], $_POST['email'], $_POST['designation'], $_POST['joining_date']);

        if ($this->temp->new_employee()) {
          http_response_code(200);
          $response['status'] = 200;
          $response['message'] = "Inserted Successfully";
          echo json_encode($response);
        }
        else {
          $this->raise_error(404,"Insertion failed");
        }
      }
      else {
        $this->raise_error(400,"Bad Request");
      }
    }

    // Update details of Employee
    public function update() {
      $_POST = json_decode(file_get_contents("php://input"), true);

      if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['designation']) && isset($_POST['joining_date'])) {

        $this->temp->setvalue($_POST['name'], $_POST['email'], $_POST['designation'], $_POST['joining_date']);
        $this->temp->set_id($_POST['id']);

        if ($this->temp->update_employee()) {
          http_response_code(200);
          $this->response['status'] = 200;
          $this->response['message'] = "Updated Successfully";
          echo json_encode($this->response);
        }
        else {
          $this->raise_error(404,"Updation failed");
        }
      }
      else {
        $this->raise_error(400,"Bad Request");
      }
    }

    // Delete the record of Employee
    public function delete() {
      $_POST = json_decode(file_get_contents("php://input"), true);

      if (isset($_POST['id'])) {

        $this->temp->set_id($_POST['id']);

        if ($this->temp->delete_employee()) {
          http_response_code(200);
          $this->response['status'] = 200;
          $this->response['message'] = "Deleted Successfully";
          echo json_encode($this->response);
        }
        else {
          $this->raise_error(404,"Deletion failed");
        }
      }
      else {
        $this->raise_error(400,"Bad Request");
      }
    }
  }

?>
