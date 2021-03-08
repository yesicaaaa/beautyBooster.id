<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Signin extends CI_Controller
{
  public function index()
  {
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|trim');

    if ($this->form_validation->run() == false) {
      $data = [
        'title'   => 'Sign in | beautyBooster.id',
        'css'     => 'assets/css/signin.css'
      ];
      $this->load->view('templates/header', $data);
      $this->load->view('users/signin');
      $this->load->view('templates/footer');
    } else {
      $this->_signin();
    }
  }

  private function _signin()
  {
    $email    = $this->input->post('email');
    $password = $this->input->post('password');
    $user     = $this->db->get_where('user', ['email' => $email])->row_array();

    if ($user) {
      if ($user['is_active'] == 1) {
        if (password_verify($password, $user['password'])) {
          $data = [
            'email'   => $user['email'],
            'role_id' => $user['role_id']
          ];
          $this->session->set_userdata($data);
          if ($user['role_id'] == 1) {
            redirect('master_menu');
          } else {
            redirect('main/home');
          }
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
          redirect('signin');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
        redirect('signin');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
      redirect('signin');
    }
  }
}
