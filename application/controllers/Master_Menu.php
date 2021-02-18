<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_menu extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Master_menu_model', 'mm');
  }
  public function index(){
    $data = [
      'user'    => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'menu'    => $this->db->get('tb_m_menu')->result_array(),
      'subMenu' => $this->db->get('tb_m_sub_menu')->result_array(), 
      'title'   => 'Menu Management | beautyBooster.id',
      'css'     => 'assets/css/homeAdmin.css',
      'js'      => 'assets/js/homeAdmin.js'
    ];

    $this->form_validation->set_rules('menu', 'Menu', 'required');

    if($this->form_validation->run() == false){
      $this->load->view('Master_templates/header', $data);
      $this->load->view('Master_templates/side-navbar', $data);
      $this->load->view('Master_menu/menu', $data);
      $this->load->view('Master_templates/footer', $data);
    }else{
      $data = [
        'menu'  => htmlspecialchars($this->input->post('menu'))
      ];
      $this->db->insert('tb_m_menu', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" 
          role="alert">New Menu Added Successfully!</div>');
      redirect('master_menu');
    }
  }

  public function deleteMenu($id){
    $this->mm->deleteMenu($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success" 
          role="alert">Menu Deleted Successfully!</div>');
    redirect('master_menu');
  }

  public function editMenu(){
    $data = [
      'user'    => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'menu'    => $this->db->get('tb_m_menu')->result_array(),
      'subMenu' => $this->db->get('tb_m_sub_menu')->result_array(), 
      'title'   => 'Menu Management | beautyBooster.id',
      'css'     => 'assets/css/homeAdmin.css',
      'js'      => 'assets/js/homeAdmin.js'
    ];

    $this->form_validation->set_rules('menu', 'Menu', 'required');

    if($this->form_validation->run() == false){
      $this->load->view('Master_templates/header', $data);
      $this->load->view('Master_templates/side-navbar', $data);
      $this->load->view('Master_menu/menu', $data);
      $this->load->view('Master_templates/footer', $data);
    }else{
      $this->mm->editMenu();
      $this->session->set_flashdata('message', '<div class="alert alert-success" 
          role="alert">Menu Updated Successfully!</div>');
      redirect('master_menu');
    }
  }

  public function getMenuRow(){
    $id = $this->input->post('id');

    $row = $this->db->where('id', $id)->get('tb_m_menu')->row_array();
    echo json_encode($row);
  }
}