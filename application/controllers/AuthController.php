<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 * @property CI_Input $input
 * @property CI_Session $session
 */
class AuthController extends CI_Controller
{
    public function index()
    {
        $this->load->view('login');
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

       
        if ($username === 'admin' && $password === 'admin123') {
            $this->session->set_userdata('logged_in', true);
            redirect('employee');
        } else {
            $this->session->set_flashdata('error', 'Invalid credentials');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        redirect('auth');
    }
}
