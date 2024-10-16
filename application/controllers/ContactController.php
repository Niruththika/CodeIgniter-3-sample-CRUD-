<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the URL helper
        $this->load->helper('url');
        $this->load->model('ContactModel');
    }

    public function index() {
        // Load the contact form view
        $this->load->view('contact_us');
    }

    public function submit() {
        // Get form input data
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $message = $this->input->post('message');

        // Save the form data using the model
        $this->ContactModel->save_contact_form($name, $email, $message);

        // Load a success message or redirect
        $this->load->view('contact_success');
    }
}
