<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_user extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Master_user_model', 'um');
    is_logged_in_admin();
  }

  public function index()
  {
    $data = [
      'user'    => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'menu'    => $this->db->get('tb_m_menu')->result_array(),
      'subMenu' => $this->db->get('tb_m_sub_menu')->result_array(),
      'title'   => 'My Profile | beautyBooster.id',
      'css'     => 'assets/css/homeAdmin.css',
      'js'      => ''
    ];

    $this->load->view('Master_templates/header', $data);
    $this->load->view('Master_templates/side-navbar', $data);
    $this->load->view('Master_user/index', $data);
    $this->load->view('Master_templates/footer', $data);
  }

  public function getUserRow()
  {
    $id = $this->input->post('id');
    $row = $this->db->where('id', $id)->get('user')->row_array();
    echo json_encode($row);
  }

  public function editUser()
  {
    $data = [
      'user'    => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'menu'    => $this->db->get('tb_m_menu')->result_array(),
      'subMenu' => $this->db->get('tb_m_sub_menu')->result_array(),
      'title'   => 'My Profile | beautyBooster.id',
      'css'     => 'assets/css/homeAdmin.css',
      'js'      => ''
    ];

    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('image', 'Image', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('Master_templates/header', $data);
      $this->load->view('Master_templates/side-navbar', $data);
      $this->load->view('Master_user/index', $data);
      $this->load->view('Master_templates/footer', $data);
    } else {
      $this->um->editUser();
      $this->session->set_flashdata('message', '<div class="alert alert-success" 
        role="alert">User Updated Successfully!</div>');
      redirect('master_user');
    }
  }

  public function changePassword()
  {
    $data = [
      'user'    => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'menu'    => $this->db->get('tb_m_menu')->result_array(),
      'subMenu' => $this->db->get('tb_m_sub_menu')->result_array(),
      'title'   => 'ChangeP | beautyBooster.id',
      'css'     => 'assets/css/homeAdmin.css',
      'js'      => ''
    ];

    $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
    $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
    $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]');

    if ($this->form_validation->run() == false) {
      $this->load->view('Master_templates/header', $data);
      $this->load->view('Master_templates/side-navbar', $data);
      $this->load->view('Master_user/index', $data);
      $this->load->view('Master_templates/footer', $data);
    } else {
      $current_password = $this->input->post('current_password');
      $new_password = $this->input->post('new_password1');

      if (!password_verify($current_password, $data['user']['password'])) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
        role="alert">Wrong Current Password!</div>');
        redirect('master_user');
      } else {
        if ($current_password == $new_password) {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" 
          role="alert">New Password Cannot Be The Same As Current Password!</div>');
          redirect('master_user');
        } else {
          $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

          $this->db->set('password', $password_hash);
          $this->db->where('email', $this->session->userdata('email'));
          $this->db->update('user');

          $this->session->set_flashdata('message', '<div class="alert alert-success" 
          role="alert">Password Changed!</div>');
          redirect('master_user');
        }
      }
    }
  }

  public function signout()
  {
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('role_id');
    $this->session->set_flashdata('message', '<div class="alert alert-success" 
    role="alert">You have been logged out!</div>');
    redirect('signin');
  }

  public function usersShow()
  {
    $data = [
      'user'      => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'title'     => 'User Management | beautyBooster.id',
      'css'       => 'assets/css/homeAdmin.css',
      'js'        => ''
    ];

    if ($this->input->post('submit')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    //pagination
    $config['base_url'] = 'http://localhost/beautyBooster.id/master_user/usersShow/';
    $this->db->like('name', $data['keyword']);
    $this->db->from('user');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 5;

    //initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $start = ($data['start'] > 0) ? $data['start'] : 0;

    $data['userdata'] = $this->um->getUsers($config['per_page'], $start, $data['keyword']);

    $this->load->view('Master_templates/header', $data);
    $this->load->view('Master_templates/side-navbar', $data);
    $this->load->view('Master_user/user', $data);
    $this->load->view('Master_templates/footer', $data);
  }

  public function deleteUser($id)
  {
    $this->um->deleteUser($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success" 
        role="alert">User Deleted Successfully!</div>');
    redirect('master_user/usersShow');
  }

  public function getUserRowByAdmin()
  {
    $id = $this->input->post('id');
    $row = $this->db->where('id', $id)->get('user')->row_array();
    echo json_encode($row);
  }

  public function editUserByAdmin()
  {
    $data = [
      'user'      => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'userdata'  => $this->db->get('user')->result_array(),
      'title'     => 'User Management | beautyBooster.id',
      'css'       => 'assets/css/homeAdmin.css',
      'js'        => ''
    ];

    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
    $this->form_validation->set_rules('image', 'Image', 'required');
    $this->form_validation->set_rules('role_id', 'Role Id', 'required');
    $this->form_validation->set_rules('is_active', 'Is Active', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('Master_templates/header', $data);
      $this->load->view('Master_templates/side-navbar', $data);
      $this->load->view('Master_user/user', $data);
      $this->load->view('Master_templates/footer', $data);
    } else {
      $this->um->editUserByAdmin();
      $this->session->set_flashdata('message', '<div class="alert alert-success" 
        role="alert">User Updated Successfully!</div>');
      redirect('master_user/usersShow');
    }
  }

  public function refresh()
  {
    $this->session->unset_userdata('keyword');
    redirect('master_user/usersShow');
  }
}
