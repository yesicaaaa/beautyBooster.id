<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller {
  public function index()
  {
    $data = [
      'title' => 'Admin Management',
      'css'   => ''
    ];
    $this->load->view('templates/header', $data);
    $this->load->view('../admin/views/menu.php');
    $this->load->view('templates/footer');
  }
}