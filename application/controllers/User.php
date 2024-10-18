<?php
defined('BASEPATH') or exit('No direct script access allowed');
use Dompdf\Dompdf;
use Dompdf\Options;
// use Box\Spout\Writer\Common\Creator;
// use Box\Spout\Common\Entity\Row;
use Box\Spout\Writer\Common\Creator;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
// require_once APPPATH . 'vendor/box/spout/src/Box/Spout/Writer/Common/Creator.php';
// require_once APPPATH . 'vendor/box/spout/src/Box/Spout/Common/Entity/Row.php';

require 'vendor/autoload.php';
require_once APPPATH . '../vendor/autoload.php';


class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->user_model = $this->User_model;
        $this->load->library('session');
        $this->load->helper('url'); 
    }

    public function index()
    {
       
        $this->load->view('register');
       
    }

    //Register form
   public function register()
{
    $this->load->library('form_validation');

    $this->form_validation->set_rules('name', 'Name', 'required');
    // $this->form_validation->set_rules('name', 'Name', 'required|alpha');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[10]|regex_match[/^(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,10}$/]');
    if ($this->form_validation->run() == FALSE) {
       $this->load->view('register', array('message' => ''));
        
    } else {
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );
        $result = $this->User_model->store($data);
        if ($result) {
            $this->load->view('register', array('message' => 'Registered successfully'));
            ?>
            <meta http-equiv="refresh" content="3;url=<?php echo base_url();?>user/login">
            <?php
        } else {
            $this->load->view('register', array('message' => 'Registration failed'));
        }
    }
}

    //Login form 
    public function login()
    {
        if ($this->input->post('email') && $this->input->post('password')) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $result = $this->User_model->login($email, $password);
            if ($result) {
                $this->session->set_userdata('logged_in', true);
                $this->load->view('login', array('message' => 'Login successfully'));
                ?>
                <meta http-equiv="refresh" content="1;url=<?php echo base_url();?>user/dashboard">
                <?php
                $this->session->set_userdata('email', $email); 
               // redirect('user/dashboard');
            } else {
                $this->load->view('login', array('message' => 'Invalid email or password'));
            }
        } else {
           
            $this->load->view('login');
        }
    }

//Logout
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login', 'refresh');
    }

//dashboard functions
public function dashboard()
{
    if ($this->session->userdata('logged_in')) {
        // Get the search query from the GET request
        $search_name = $this->input->get('search_name');  

        if ($search_name) {
            // If there's a search term, get the filtered user data
            $user_data = $this->User_model->search_users_by_name($search_name);
        } else {
            // Otherwise, get all user data
            $user_data = $this->User_model->get_all_user_data();
        }

        // Load the dashboard view with the user data and additional parameters
        $this->load->view('dashboard', array('user_data' => $user_data, 'show_update_form' => false));
    } else {
        // Redirect to the login page if the user is not logged in
        redirect('user/login');
    }
}



//delete operations
public function delete($email = null)
{
    if ($this->session->userdata('logged_in')) {
        // Check if email is provided
        if ($email) {
            // Decode email if necessary
            $email = urldecode($email);

            // Proceed to delete the user
            $this->User_model->delete_user_data($email);

            // Redirect to the dashboard or another appropriate page
            redirect('user/dashboard');
        } else {
            // Handle the case where email is not provided
            echo "No user email provided for deletion.";
        }
    } else {
        redirect('user/login');
    }
}


    public function update()
    {
        if ($this->session->userdata('logged_in')) {
            $email = $this->session->userdata('email');
            $user_data = $this->User_model->get_user_data($email);
            $this->load->view('dashboard', array('user_data' => $user_data, 'show_update_form' => true));
        } else {
            redirect('user/login');
        }
    }

    // public function update_user_data()
    // {
    //     if ($this->session->userdata('logged_in')) {
    //         $email = $this->session->userdata('email');
    //         $old_password = $this->input->post('old_password');
    //         $new_password = $this->input->post('new_password');
    //         $confirm_password = $this->input->post('confirm_password');
    
    //         $this->load->library('form_validation');
    
    //         $this->form_validation->set_rules('old_password', 'Old Password', 'required');
    //         $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[8]|max_length[10]|regex_match[/^(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,10}$/]');
    //         $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');
    
    //         if ($this->form_validation->run() == FALSE) {
    //             $this->session->set_flashdata('error', validation_errors());
    //             redirect('user/update');
    //         } else {
    //             if ($this->User_model->check_old_password($email, $old_password)) {
    //                 if ($new_password == $confirm_password) {
    //                     $data = array(
    //                         'name' => $this->input->post('name'),
    //                         'email' => $this->input->post('email'),
    //                         'password' => $new_password
    //                     );
    //                     $this->User_model->update_user_data($email, $data);
    //                     redirect('user/dashboard');
    //                 } else {
    //                     $this->session->set_flashdata('error', 'New password and confirm password do not match');
    //                     redirect('user/update');
    //                 }
    //             } else {
    //                 $this->session->set_flashdata('error', 'Old password is incorrect');
    //                 redirect('user/update');
    //             }
    //         }
    //     } else {
    //         redirect('user/login');
    //     }
    // }
    public function home()
    {
        $this->load->view('header');
        $this->load->view('home');
    }

    // public function insert()
    // {
    //     redirect('user/register');
    // }

    // public function cancel()
    // {
    //     redirect('user/dashboard');
    // }

    // public function insert_user()
    // {
    //     if ($this->session->userdata('logged_in')) {
    //         $this->load->library('form_validation');

    //         $this->form_validation->set_rules('name', 'Name', 'required');
    //         $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
    //         $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[10]|regex_match[/^(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,10}$/]');

    //         if ($this->form_validation->run() == FALSE) {
    //             $this->session->set_flashdata('error', validation_errors());
    //             redirect('user/dashboard');
    //         } else {
    //             $data = array(
    //                 'name' => $this->input->post('name'),
    //                 'email' => $this->input->post('email'),
    //                 'password' => $this->input->post('password')
    //             );

    //             $result = $this->User_model->store($data);
    //             if ($result) {
    //                 $this->session->set_flashdata('success', 'User inserted successfully');
    //             } else {
    //                 $this->session->set_flashdata('error', 'Failed to insert user');
    //             }
    //             redirect('user/dashboard');
    //         }
    //     } else {
    //         redirect('user/login');
    //     }
    // }

    public function manage_user()
{
    if ($this->session->userdata('logged_in')) {
        $this->load->library('form_validation');

        $email = $this->input->post('email');
        $user_exists = !empty($email) && $this->User_model->get_user_by_email($email);

        
        if ($user_exists) {
            
            $this->form_validation->set_rules('old_password', 'Old Password', 'required');
            $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[8]|max_length[10]|regex_match[/^(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,10}$/]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');
        } else {
            
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[10]|regex_match[/^(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,10}$/]');
        }

        if ($this->form_validation->run() == FALSE) {
         
            $this->session->set_flashdata('error', validation_errors());
            redirect('user/dashboard');
        } else {
            if ($user_exists) {
                
                $old_password = $this->input->post('old_password');
                $new_password = $this->input->post('new_password');

                if ($this->User_model->check_old_password($email, $old_password)) {
                    $data = array(
                        'name' => $this->input->post('name'),
                        'email' => $this->input->post('email'),
                        'password' => $new_password
                    );
                    $result = $this->User_model->update_user_data($email, $data);
                    if ($result) {
                        $this->session->set_flashdata('success', 'User updated successfully');
                    } else {
                        $this->session->set_flashdata('error', 'Failed to update user');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Old password is incorrect');
                }
            } else {
                
                $data = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password')
                );
                $result = $this->User_model->store($data);
                if ($result) {
                    $this->session->set_flashdata('success', 'User inserted successfully');
                } else {
                    $this->session->set_flashdata('error', 'Failed to insert user');
                }
            }
            redirect('user/dashboard');
        }
    } else {
        redirect('user/login');
    }
}

//facebook
public function facebook_login() {
    $this->load->library('facebook');
    $login_url = $this->facebook->get_login_url();
    redirect($login_url);
}

public function facebook_login_callback() {
    
    
    if ($this->input->get('error') || $this->input->get('error_reason')) {
        
        redirect('user/login');
    } else {
        // Proceed with the normal Facebook login flow
        $this->load->library('facebook');
        $code = $this->input->get('code');
        $access_token = $this->facebook->get_access_token($code);
        $user_data = $this->facebook->get_user_data($access_token);

        // Use the user data to login or register the user
        $email = $user_data['email'];
        $name = $user_data['name'];

        // Check if the user exists in your database
        $user_exists = $this->User_model->check_user_exists($email);
        if ($user_exists) {
            // Login the user
            $this->session->set_userdata('logged_in', true);
            $this->session->set_userdata('email', $email);
            redirect('user/dashboard');
        } else {
            // Register the user
            $this->User_model->register_user($email, $name);
            $this->session->set_userdata('logged_in', true);
            $this->session->set_userdata('email', $email);
            redirect('user/dashboard');
        }
    }
}

// public function search_user() {
//     $search_name = $this->input->get('search_name');
//     $this->db->like('name', $search_name);
//     $data['user_data'] = $this->db->get('users')->result();
//     $this->load->view('user_management', $data);
// }

public function search_user() {
    $search_name = $this->input->get('search_name');
    $this->db->like('name', $search_name);
    $data['user_data'] = $this->db->get('user')->result();
    
    
    foreach ($data['user_data'] as $row) {
        echo "<tr>
                <td>" . htmlspecialchars($row->name) . "</td>
                <td>" . htmlspecialchars($row->email) . "</td>
                <td>********</td>
                <td>
                    <a href='#' class='btn btn-primary btn-sm' onclick='showUpdateModal(\"" . htmlspecialchars($row->name) . "\", \"" . htmlspecialchars($row->email) . "\")'>Update</a>
                    <a href='" . base_url('user/delete/' . urlencode($row->email)) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
                </td>
            </tr>";
    }

    // If no users are found, return a message
    if (empty($data['user_data'])) {
        echo "<tr><td colspan='4' class='text-center'>No users found</td></tr>";
    }
}

public function update_profile()
{
    if ($this->session->userdata('logged_in')) {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('edit_profile', array('user' => $this->User_model->get_user_data($this->session->userdata('email'))[0]));
        } else {
            $email = $this->session->userdata('email');
            $new_email = $this->input->post('email');
            $name = $this->input->post('name');
            
            $data = array(
                'name' => $name,
                'email' => $new_email
            );

            $this->User_model->update_user_data($email, $data);
            $this->session->set_userdata('email', $new_email);
            $this->session->set_flashdata('success', 'Profile updated successfully.');
            redirect('user/dashboard');
        }
    } else {
        redirect('user/login');
    } 
}
public function edit_profile()
{
    if ($this->session->userdata('logged_in')) {
        $email = $this->session->userdata('email');
        $user_data = $this->User_model->get_user_by_email($email);

        if ($user_data) {
            $this->load->view('edit_profile', array('user' => $user_data));
        } else {
            show_error('User not found.');
        }
    } else {
        redirect('user/login');
    }
}

// Method to generate PDF for user data
// public function generate_pdf()
// {
//     // Load user data
//     $user_data = $this->User_model->get_all_user_data();

//     // Load the HTML view to be converted into PDF
//     $html = $this->load->view('pdf_view', array('user_data' => $user_data), true);

//     // Initialize dompdf with options
//     $options = new Options();
//     $options->set('isRemoteEnabled', true); // Enable external styles and images

//     $dompdf = new Dompdf($options);
//     $dompdf->loadHtml($html);
//     $dompdf->setPaper('A4', 'portrait');

//     // Render the HTML as PDF
//     $dompdf->render();

//     // Output the generated PDF (send it to the browser)
//     $dompdf->stream("user_data.pdf", array("Attachment" => false)); // Attachment: false for inline, true for download
// }
// public function generate_pdf()
// {
//     // Load user data
//     $user_data = $this->User_model->get_all_user_data();

//     // Load the HTML view to be converted into PDF
//     $html = $this->load->view('pdf_view', array('user_data' => $user_data), true);

//     // Initialize dompdf with options
//     $options = new Options();
//     $options->set('isRemoteEnabled', true); // Enable external styles and images

//     $dompdf = new Dompdf($options);
//     $dompdf->loadHtml($html);
//     $dompdf->setPaper('A4', 'portrait');

//     // Render the HTML as PDF
//     if ($dompdf->render()) {
//         // Output the generated PDF (send it to the browser)
//         $dompdf->stream("user_data.pdf", array("Attachment" => false)); // Attachment: false for inline, true for download
//     } else {
//         echo "Error generating PDF";
//     }
// }

public function generate_pdf()
{
    // Load user data
    $user_data = $this->User_model->get_all_user_data();

    // Load the HTML view to be converted into PDF
    $html = $this->load->view('pdf_view', array('user_data' => $user_data), true);

    // Initialize dompdf with options
    $options = new Options();
    $options->set('isRemoteEnabled', true); // Enable external styles and images

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');


    try {
        $dompdf->render();
        $dompdf->stream("user_data.pdf", array("Attachment" => false)); // Attachment: false for inline, true for download
    } catch (Exception $e) {
        echo "Error generating PDF: " . $e->getMessage();
    }
}


}


   








