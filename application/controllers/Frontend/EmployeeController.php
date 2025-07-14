<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 * @property CI_Input $input
 * @property CI_Form_validation $form_validation
 * @property CI_Session $session
 * @property EmployeeModel $EmployeeModel
 */

class EmployeeController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $this->load->view('template/header');

        // Initialize cURL
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://localhost:8000/api/employees', 
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false, 
        ]);

        $response = curl_exec($curl);

        // Check for errors
        if ($response === false) {
            $error = curl_error($curl);
            curl_close($curl);
            show_error("Curl Error: $error");
            return;
        }

        curl_close($curl);

        // Decode the JSON response
        $employee = json_decode($response, true);

        
        $this->load->view('frontend/employee', ['employee' => $employee]);
        $this->load->view('template/footer');
    }

    public function create()
    {
        $this->load->view('template/header');
        $this->load->view('frontend/create');
        $this->load->view('template/footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'last Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required');
        $this->form_validation->set_rules('email', 'Email Address', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email')
            ];

            $this->load->model('EmployeeModel');
            $this->EmployeeModel->insertEmployee($data);
            redirect(base_url('employee'));
        } else {
            $this->create();
        }
    }

    public function edit($id)
    {

        $this->load->view('template/header');

        $this->load->model('EmployeeModel');
        $employee = $this->EmployeeModel->editEmployee($id);


        $this->load->view('frontend/edit', ['employee' => $employee]);
        $this->load->view('template/footer');
    }

    public function update($id)
    {

        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'last Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required');
        $this->form_validation->set_rules('email', 'Email Address', 'required');
        if ($this->form_validation->run()) :
            $data = [
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email')
            ];

            $this->load->model('EmployeeModel');
            $this->EmployeeModel->updateEmployee($data, $id);
            redirect(base_url('employee'));
        else :
            $this->edit($id);
        endif;
    }

    public function delete($id)
    {
        $this->load->model('EmployeeModel');
        $this->EmployeeModel->deleteEmployee($id);
        redirect(base_url('employee'));
    }
}
