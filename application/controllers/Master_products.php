<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_products extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Master_products_model', 'pm');
  }

  public function index()  
  {
    $data = [
      'user'      => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'menu'      => $this->db->get('tb_m_menu')->result_array(),
      'subMenu'   => $this->pm->getSubMenu(),
      'title'     => $this->pm->getProductTitle(),
      'mainTitle' => '',
      'css'       => 'assets/css/homeAdmin.css',
      'js'        => ''
    ];

    $this->load->view('master_templates/header', $data);
    $this->load->view('master_templates/side-navbar', $data);
    $this->load->view('Master_main/products', $data);
    $this->load->view('master_templates/footer', $data);
  }
}