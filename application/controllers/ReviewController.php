<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReviewController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ReviewModel');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    // Display the review form
    public function create() {
        $this->load->view('review_form');
    }

    // Handle review submission
   // Handle review submission
public function store() {
    // Set validation rules
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('description', 'Description', 'required');
    $this->form_validation->set_rules('rating', 'Rating', 'required|integer|greater_than[0]|less_than_equal_to[5]');

    // Check if the form validation is successful
    if ($this->form_validation->run() === FALSE) {
        // Validation failed, re-load the review form with errors
        $this->create(); // Re-load the form with validation errors
    } else {
        // Handle file uploads (if applicable)
        $image = $this->upload_file('image'); // Upload image
        $video = $this->upload_file('video'); // Upload video

        // Prepare review data to insert
        $review_data = array(
            'rating' => $this->input->post('rating'),
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'image' => $image,
            'video' => $video
        );

        // Insert review data into the database
        $this->ReviewModel->insert_review($review_data);

        // Redirect to the show method to display all reviews
        redirect('review/show'); // Redirect to show reviews
    }
}


    // Display reviews for a product
    public function show() {
        $data['reviews'] = $this->ReviewModel->get_all_reviews(); // Assuming you want all reviews
        $this->load->view('review_display', $data);
    }

    

    // Helper function for file upload
    private function upload_file($field_name) {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = ($field_name == 'image') ? 'gif|jpg|png' : 'mp4|avi|mkv';
        $config['max_size'] = '10000'; // Set file size limit in KB
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($field_name)) {
            return NULL; // Return null if no file or invalid file uploaded
        } else {
            return $this->upload->data('file_name'); // Return the file name if uploaded
        }
    }
}
?>
