<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Signup extends CI_Controller {
  public function index()
  {
    $this->form_validation->set_rules('name', 'Fullname', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]');
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

    if($this->form_validation->run() == false){
      $data = [
        'title'   => 'Sign Up | beautyBooster.id',
        'css'     => 'assets/css/signup.css'
      ];
      $this->load->view('templates/header', $data);
      $this->load->view('users/signup');
      $this->load->view('templates/footer');    
    }else{
      $data = [
        'name'          => htmlentities($this->input->post('name', true)),
        'email'         => htmlspecialchars($this->input->post('email', true)),
        'image'         => 'default.jpg',
        'password'      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
        'role_id'       => 2,
        'is_active'     => 1,
        'date_created'  => time()
      ];

      $this->db->insert('user', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created! Please Login</div>');
      redirect('signin');
    }
  }

  // public function cekEmail()
  // {
  //   $email = $this->input->post('email');
  //   $countEmail= $this->db->get_where('user', ['email' => $email])->row_array();
  //   if($countEmail['email'] > 0){
  //     $this->form_validation->set_message('cekEmail','Username already exist please choose onther one');
  //     return  false;
  //   }else {
  //     return true;
  //   }
  // }
}