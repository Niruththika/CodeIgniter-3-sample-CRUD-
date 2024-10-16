<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Load the database library
        $this->load->database();
    }

    public function save_contact_form($name, $email, $message) {
        // Prepare the data to be saved
        $data = array(
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'created_at' => date('Y-m-d H:i:s')
        );

        // Insert the data into the database
        return $this->db->insert('contacts', $data);
    }
}
