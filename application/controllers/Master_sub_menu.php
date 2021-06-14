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

    if ($this->input->post('submit')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    //pagination
    $config['base_url'] = 'http://localhost/beautyBooster.id/Master_sub_menu/index/';
    $this->db->like('title', $data['keyword']);
    $this->db->from('tb_m_sub_menu');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 5;

    //initialize
    $this->pagination->initialize($config);

    $data['start']  = $this->uri->segment(3);
    
    $start = ($data['start'] > 0) ? $data['start'] : 0;
    $data['subMenu'] = $this->sm->getSubMenu($config['per_page'], $start, $data['keyword']);

    if (!$this->input->post('submit')) {
      $this->form_validation->set_rules('menu_id', 'Menu', 'required');
      $this->form_validation->set_rules('title', 'Title', 'required');
      $this->form_validation->set_rules('icon', 'Icon', 'required');
      $this->form_validation->set_rules('url', 'Url', 'required');
    }

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
      'menu'     => $this->db->get('tb_m_menu')->result_array(),
      'title'    => 'SubMenu Management | beautyBooster.id',
      'css'      => 'assets/css/homeAdmin.css',
      'js'       => 'assets/js/subMenuAdmin.js'
    ];

    if ($this->input->post('submit')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    //pagination
    $this->db->like('title', $data['keyword']);
    $this->db->from('tb_m_sub_menu');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 5;

    //initialize
    $this->pagination->initialize($config);

    $data['start']  = $this->uri->segment(3);
    // $data['start']  .= ($data['start'] != "") ? $data['start'] : "0";

    $start = ($data['start'] > 0) ? $data['start'] : 0;
    $data['subMenu'] = $this->sm->getSubMenu($config['per_page'], $start, $data['keyword']);

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

  public function refresh()
  {
    $this->session->unset_userdata('keyword');
    redirect('master_sub_menu');
  }
}
