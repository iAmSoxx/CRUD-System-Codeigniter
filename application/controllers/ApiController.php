<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property EmployeeModel $EmployeeModel
 */
class ApiController extends CI_Controller
{
    public function employees()
    {
        $this->load->model('EmployeeModel');
        $employees = $this->EmployeeModel->getEmployee();
        

        header('Content-Type: application/json');
        echo json_encode($employees);

    }
}
