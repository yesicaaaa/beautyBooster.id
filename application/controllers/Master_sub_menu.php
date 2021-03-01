<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_sub_menu extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Master_sub_menu_model', 'sm');
  }

  public function index()
  {
    $data = [
      'user'     => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'menu'     => $this->db->get('tb_m_menu')->result_array(),
      'title'    => 'SubMenu Management | beautyBooster.id',
      'css'      => 'assets/css/homeAdmin.css',
      'js'       => 'assets/js/subMenuAdmin.js'
    ];

    //pagination
    $config['base_url'] = 'http://localhost/beautyBooster.id/Master_sub_menu/index/';
    $config['total_rows'] = $this->sm->countAllSubMenu();
    $config['per_page'] = 5;

    //initialize
    $this->pagination->initialize($config);

    $data['start']  = $this->uri->segment(3);
    $data['subMenu'] = $this->sm->getSubMenu($config['per_page'], $data['start']);

    $this->form_validation->set_rules('menu_id', 'Menu', 'required');
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('icon', 'Icon', 'required');
    $this->form_validation->set_rules('url', 'Url', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('Master_templates/header', $data);
      $this->load->view('Master_templates/side-navbar', $data);
      $this->load->view('Master_menu/sub_menu', $data);
      $this->load->view('Master_templates/footer', $data);
    } else {
      $data = [
        'menu_id'   => htmlspecialchars($this->input->post('menu_id')),
        'title'     => htmlspecialchars($this->input->post('title')),
        'icon'      => htmlspecialchars($this->input->post('icon')),
        'url'       => htmlspecialchars($this->input->post('url')),
        'is_active' => 1
      ];
      $this->db->insert('tb_m_sub_menu', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" 
          role="alert">SubMenu Added Successfully!</div>');
      redirect('master_sub_menu');
    }
  }

  public function deleteSubMenu($id)
  {
    $this->sm->deleteSubMenu($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success" 
        role="alert">SubMenu Deleted Successfully!</div>');
    redirect('master_sub_menu');
  }

  public function getSubMenuRow()
  {
    $id = $this->input->post('id');
    $row = $this->db->where('id', $id)->get('tb_m_sub_menu')->row_array();
    echo json_encode($row);
  }

  public function editSubMenu()
  {
    $data = [
      'user'     => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'title'    => 'SubMenu Management | beautyBooster.id',
      'css'      => 'assets/css/homeAdmin.css',
      'js'       => 'assets/js/subMenuAdmin.js'
    ];

    //pagination
    $config['base_url'] = 'http://localhost/beautyBooster.id/Master_sub_menu/index';
    $config['total_rows'] = $this->sm->countAllSubMenu();
    $config['per_page'] = 5;

    //initialize
    $this->pagination->initialize($config);

    $data['start']  = $this->uri->segment(3);
    $data['subMenu'] = $this->sm->getSubMenu($config['per_page'], $data['start']);

    $this->form_validation->set_rules('menu_id', 'Menu', 'required');
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('icon', 'Icon', 'required');
    $this->form_validation->set_rules('url', 'Url', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('Master_templates/header', $data);
      $this->load->view('Master_templates/side-navbar', $data);
      $this->load->view('Master_menu/sub_menu', $data);
      $this->load->view('Master_templates/footer', $data);
    } else {
      $this->sm->editSubMenu();
      $this->session->set_flashdata('message', '<div class="alert alert-success" 
        role="alert">SubMenu Updated Successfully!</div>');
      redirect('master_sub_menu');
    }
  }
}
