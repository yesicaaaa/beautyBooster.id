<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in_user();
  }

  public function index()
  {
    $data = [
      'title'   => 'beautyBooster.id',
      'css'     => 'assets/css/landingPage.css',
      'js'      => 'assets/js/landingPage.js'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('landingPage');
    $this->load->view('templates/footer', $data);
  }

  public function home()
  {
    $data = [
      'user'    => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'menu'    => $this->db->get('menu_categories')->result_array(),
      'title'   => 'Home | beautyBooster.id',
      'css'     => 'assets/css/home.css',
      'js'      => 'assets/js/home.js'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/side-navbar', $data);
    $this->load->view('main/home', $data);
    $this->load->view('templates/footer', $data);
  }

  public function dashboard()
  {
    $data = [
      'user'      => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'title'     => 'Dashboard | beautyBooster.id',
      'css'       => 'assets/css/products.css',
      'js'        => 'assets/js/products.js'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/side-navbar', $data);
    $this->load->view('main/dashboard', $data);
    $this->load->view('templates/footer', $data);
  }

  public function products($id)
  {
    $data = [
      'user'      => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'products'  => $this->db->get_where('tb_m_products', ['sub_category_id' => $id])->result_array(),
      'title'     => 'Body Care | beautyBooster.id',
      'mainTitle' => 'Body Lotion',
      'css'       => 'assets/css/products.css',
      'js'        => 'assets/js/products.js'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/side-navbar', $data);
    $this->load->view('main/products', $data);
    $this->load->view('templates/footer', $data);
  }

  public function product_detail($id)
  {
    $data = [
      'user'      => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'product'  => $this->db->get_where('tb_m_products', ['id' => $id])->row_array(),
      'title'     => 'Body Care | beautyBooster.id',
      'mainTitle' => 'Body Lotion',
      'css'       => 'assets/css/products.css',
      'js'        => 'assets/js/products.js'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/side-navbar', $data);
    $this->load->view('main/product-detail', $data);
    $this->load->view('templates/footer', $data);
  }

  public function add_to_cart($id)
  {
    $product = $this->db->get_where('tb_m_products', ['id' => $id])->row_array();

    $data = [
      'id'      => $product['id'],
      'qty'     => 1,
      'price'   => $product['price'],
      'name'    => $product['product_name'],
      'image'   => $product['image']
    ];
    $this->cart->insert($data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" 
          role="alert">Add To Cart Successfully!</div>');
    redirect('main/product_detail/' . $id);
  }

  public function cart()
  {
    $data = [
      'user'      => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'cart'      => $this->cart->contents(),
      'title'     => 'Cart | beautyBooster.id',
      'css'       => 'assets/css/products.css',
      'js'        => 'assets/js/products.js'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/side-navbar', $data);
    $this->load->view('main/cart', $data);
    $this->load->view('templates/footer', $data);
  }

  public function signout()
  {
    $this->session->unset_userdata();
    redirect('signin');
  }

  public function profile()
  {
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'My Profile | BeautyBooster.id',
      'css'   => 'assets/css/products.css',
      'js'    => 'assets/js/products.js'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/side-navbar', $data);
    $this->load->view('main/my-profile', $data);
    $this->load->view('templates/footer', $data);
  }

  public function delete_cart()
  {
    $data = [
      'rowid'  => $this->uri->segment(3),
      'qty' => 0
    ];

    $this->cart->update($data);
    redirect('main/cart');
  }

  public function checkout()
  {
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'products'  => $this->cart->contents(),
      'title' => 'Check Out | BeautyBooster.id',
      'css'   => 'assets/css/products.css',
      'js'    => 'assets/js/products.js'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/side-navbar', $data);
    $this->load->view('main/checkout', $data);
    $this->load->view('templates/footer', $data);
  }

  public function struk_pembayaran()
  {
    $data = [
      'title' => 'Bukti Pembelian | beautyBooster.id',
      'css'   => 'assets/css/struk.css',
      'js'    => 'assets/js/products.js'
    ];

    $this->cart->destroy();

    $this->load->view('templates/header', $data);
    $this->load->view('main/struk-pembayaran');
    $this->load->view('templates/footer', $data);
  }
}
