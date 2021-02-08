<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Signin extends CI_Controller {
  public function index()
  {
    $data = [
      'title'   => 'Sign in | beautyBooster.id',
      'css'     => 'assets/css/signin.css'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('main/signin', $data);
    $this->load->view('templates/footer', $data);    
  }
}