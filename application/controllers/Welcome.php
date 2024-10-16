<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->helper('url');
		$this ->load->library('session');
		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
		
	}

	public function save()
{
	$this->load->helper('url');
    $this->load->library('session');
    $name = $this->input->post('name');
    $this->session->set_userdata('savename', $name); #key , value
	redirect('welcome');
}
public function clear()
{
	$this->load->helper('url');
	$this->load->library('session');
	$this->session->unset_userdata('savename');
	redirect('welcome');
}
}
