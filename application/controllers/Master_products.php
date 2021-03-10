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
      'products'  => $this->pm->getProducts(),
      'product_categories'  => $this->db->get('tb_m_products_categories')->result_array(),
      'product_sub_categories'  => $this->db->get('menu_sub_categories')->result_array(),
      'title'     => 'All Products | beautyBooster.id',
      'css'       => 'assets/css/homeAdmin.css',
      'js'        => ''
    ];

    $this->form_validation->set_rules('category_id', 'Category', 'required');
    $this->form_validation->set_rules('sub_category_id', 'Sub Category', 'required');
    $this->form_validation->set_rules('product_name', 'Product Name', 'required');
    $this->form_validation->set_rules('stock', 'Stock', 'required');
    $this->form_validation->set_rules('price', 'Price', 'required');
    $this->form_validation->set_rules('description', 'Description', 'required');

    if($this->form_validation->run() == false){
      $this->load->view('Master_templates/header', $data);
      $this->load->view('Master_templates/side-navbar', $data);
      $this->load->view('Master_main/products', $data);
      $this->load->view('Master_templates/footer', $data);
    } else {
      $data = [
        'category_id'     => htmlspecialchars($this->input->post('category_id')),
        'sub_category_id' => htmlspecialchars($this->input->post('sub_category_id')),
        'product_name'    => htmlspecialchars($this->input->post('product_name')),
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
      'products'  => $this->pm->getProducts(),
      'product_categories'  => $this->db->get('tb_m_products_categories')->result_array(),
      'product_sub_categories'  => $this->db->get('menu_sub_categories')->result_array(),
      'title'     => 'All Products | beautyBooster.id',
      'css'       => 'assets/css/homeAdmin.css',
      'js'        => ''
    ];

    $this->form_validation->set_rules('category_id', 'Category', 'required');
    $this->form_validation->set_rules('sub_category_id', 'Sub Category', 'required');
    $this->form_validation->set_rules('product_name', 'Product Name', 'required');
    $this->form_validation->set_rules('stock', 'Stock', 'required');
    $this->form_validation->set_rules('price', 'Price', 'required');
    $this->form_validation->set_rules('description', 'Description', 'required');

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
}