<?php
class crud extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('crud_model');
        $this->load->helper('url');
    }

    public function savedata(){
        //$this->load->view('insert');
        if($this->input->post('save')){
            $data['first_name']=$this->input->post('first_name');
            $data['last_name']=$this->input->post('last_name');
            $data['email']=$this->input->post('email');

            $response=$this->crud_model->saverecords($data);
            if($response==true)
            {
                echo "Inserted Sucessfully";
                redirect('crud/displaydata');
            }
            else{
                echo "Insert failed";
            }
        } 
        
    }

    public function displaydata()
    {
        $result['data']= $this->crud_model->display_records();
        $this->load->view('display_records', $result);
    }

    public function updatedata()
    {
        $id = $this ->input->get('id');
        $result['data']=$this->crud_model->displayrecordsById($id);
        $this->load->view('update_records', $result);
        if($this->input->post('update')){
            $first_name=$this->input->post('first_name');
            $last_name=$this->input->post('last_name');
            $email=$this->input->post('email');
            $this->crud_model->update_records($first_name,$last_name,$email,$id);
           redirect('crud/displaydata');
            echo "Data updated sucessfully";
        }
    }

    public function deletedata()
    {
        $id = $this->input->get('id');
        $responses=$this ->crud_model->deleteRecordById($id);
        if($responses==true)
        {
            echo "Deleted succesfully";
            redirect('crud/displaydata');
        }
        else
        {
            echo "Record not deleted";
        }

    }

    public function insert()
    {
         $this->load->view('insert');
    }
    
   
}
?>