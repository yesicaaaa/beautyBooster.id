<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_products extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Master_products_model', 'pm');
    is_logged_in_admin();
  }

  public function index()
  {
    $data = [
      'user'      => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'menu'      => $this->db->get('tb_m_menu')->result_array(),
      'subMenu'   => $this->pm->getSubMenu(),
      'product_categories'  => $this->db->get('menu_categories')->result_array(),
      'product_sub_categories'  => $this->db->get('menu_sub_categories')->result_array(),
      'title'     => 'All Products | beautyBooster.id',
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
    $config['base_url'] = 'http://localhost/beautyBooster.id/master_products/index/';
    $this->db->like('product_name');
    $this->db->from('tb_m_products');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 5;

    //initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);

    $start = ($data['start'] > 0) ? $data['start'] : 0;
    $data['products'] = $this->pm->getProducts($config['per_page'], $start, $data['keyword']);

    if (!$this->input->post('submit')) {
      $this->form_validation->set_rules('category_id', 'Category', 'required');
      $this->form_validation->set_rules('sub_category_id', 'Sub Category', 'required');
      $this->form_validation->set_rules('image', 'Product Name', 'required');
      $this->form_validation->set_rules('product_name', 'Product Name', 'required');
      $this->form_validation->set_rules('rating', 'Product Name', 'required');
      $this->form_validation->set_rules('stock', 'Stock', 'required');
      $this->form_validation->set_rules('price', 'Price', 'required');
      $this->form_validation->set_rules('description', 'Description', 'required');
    }

    if ($this->form_validation->run() == false) {
      $this->load->view('Master_templates/header', $data);
      $this->load->view('Master_templates/side-navbar', $data);
      $this->load->view('Master_main/products', $data);
      $this->load->view('Master_templates/footer', $data);
    } else {
      $data = [
        'category_id'     => htmlspecialchars($this->input->post('category_id')),
        'sub_category_id' => htmlspecialchars($this->input->post('sub_category_id')),
        'image'           => htmlspecialchars($this->input->post('image')),
        'product_name'    => htmlspecialchars(strtoupper($this->input->post('product_name'))),
        'rating'          => htmlspecialchars($this->input->post('rating')),
        'stock'           => htmlspecialchars($this->input->post('stock')),
        'price'           => htmlspecialchars($this->input->post('price')),
        'description'     => htmlspecialchars($this->input->post('description')),
        'date_created'    => time()
      ];

      $this->db->insert('tb_m_products', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" 
          role="alert">Product Added Successfully!</div>');
      redirect('master_products');
    }
  }

  public function deleteProduct($id)
  {
    $this->pm->deleteProduct($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success" 
          role="alert">Product Deleted Successfully!</div>');
    redirect('master_products');
  }

  public function getProductRow()
  {
    $id = $this->input->post('id');
    $row = $this->db->where('id', $id)->get('tb_m_products')->row_array();

    echo json_encode($row);
  }

  public function editProduct()
  {
    $data = [
      'user'      => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'menu'      => $this->db->get('tb_m_menu')->result_array(),
      'subMenu'   => $this->pm->getSubMenu(),
      'product_categories'  => $this->db->get('menu_categories')->result_array(),
      'product_sub_categories'  => $this->db->get('menu_sub_categories')->result_array(),
      'title'     => 'All Products | beautyBooster.id',
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
    $config['base_url'] = 'http://localhost/beautyBooster.id/master_products/index/';
    $this->db->like('product_name', $data['keyword']);
    $this->db->from('tb_m_products');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 5;

    //initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);

    $start = ($data['start'] > 0) ? $data['start'] : 0;
    $data['products'] = $this->pm->getProducts($config['per_page'], $start, $data['keyword']);


    if (!$this->input->post('submit')) {
      $this->form_validation->set_rules('category_id', 'Category', 'required');
      $this->form_validation->set_rules('sub_category_id', 'Sub Category', 'required');
      $this->form_validation->set_rules('image', 'Product Name', 'required');
      $this->form_validation->set_rules('product_name', 'Product Name', 'required');
      $this->form_validation->set_rules('rating', 'Product Name', 'required');
      $this->form_validation->set_rules('stock', 'Stock', 'required');
      $this->form_validation->set_rules('price', 'Price', 'required');
      $this->form_validation->set_rules('description', 'Description', 'required');
    }

    if ($this->form_validation->run() == false) {
      $this->load->view('Master_templates/header', $data);
      $this->load->view('Master_templates/side-navbar', $data);
      $this->load->view('Master_main/products', $data);
      $this->load->view('Master_templates/footer', $data);
    } else {
      $this->pm->editProduct();
      $this->session->set_flashdata('message', '<div class="alert alert-success" 
          role="alert">Product Updated Successfully!</div>');
      redirect('master_products');
    }
  }

  public function refresh()
  {
    $this->session->unset_userdata('keyword');
    redirect('master_products');
  }
}
