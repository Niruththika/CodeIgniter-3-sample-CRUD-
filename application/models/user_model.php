<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user_model extends CI_Model
{
    public function store($data)
    {
        if ($this->db->insert('user', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    // public function get_user_data($email)
    // {
    //     $this->db->where('email', $email);
    //     $query = $this->db->get('user');
    //     return $query->result();
    // }
    
   
    
    public function delete_user_data($email)
    {
        $this->db->where('email', $email);
        $this->db->delete('user');
    }

    public function check_old_password($email, $old_password)
    {
        $this->db->where('email', $email);
        $this->db->where('password', $old_password);
        $query = $this->db->get('user');
        print_r($query->result());
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_user_data($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('user');
        return $query->result();
    }
    public function update_user_data($email, $data)
    {
        $this->db->where('email', $email);
        $this->db->update('user', $data);
        print_r($this->db->last_query());
        print_r($this->db->affected_rows());
    }
  
    public function get_all_user_data()
{
    $query = $this->db->get('user');
    return $query->result();
}

// public function manage_user_data($data, $action = 'insert')
//     {
//         switch ($action) {
//             case 'insert':
//                 return $this->store($data);
//             case 'update':
//                 $email = $data['email'];
//                 unset($data['email']);
//                 return $this->update_user_data($email, $data);
//             default:
//                 return false;
//         }
//     }
public function get_user_by_email($email)
{
    $this->db->where('email', $email);
    $query = $this->db->get('user');
    return $query->row(); // Return the user object if found, otherwise NULL
}

public function check_user_exists($email) {
    $this->db->where('email', $email);
    $query = $this->db->get('user');
    if ($query->num_rows() > 0) {
        return true;
    } else {
        return false;
    }
}

public function register_user($email, $name) {
    $data = array(
        'email' => $email,
        'name' => $name
    );
    $this->db->insert('user', $data);
}

public function search_users_by_name($name)
    {
        $this->db->like('name', $name);
        return $this->db->get('user')->result();
    }

    public function update()
{
    if ($this->session->userdata('logged_in')) {
        $email = $this->session->userdata('email');
        $user_data = $this->User_model->get_user_data($email);
        if (!empty($user_data)) {
            $data['user'] = $user_data[0]; // Assuming the result is an array of user objects
            $this->load->view('edit_profile', $data);
        } else {
            show_error('User not found.');
        }
    } else {
        redirect('user/login');
    }
}

    }

   
   
    
