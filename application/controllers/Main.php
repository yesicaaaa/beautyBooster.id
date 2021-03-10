<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
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

  public function products()
  {
    $data = [
      'user'      => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'title'     => 'Body Care | beautyBooster.id',
      'mainTitle' => 'Body Lotion',
      'css'       => 'assets/css/products.css',
      'js'        => 'assets/js/products.js'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/side-navbar', $data);
    $this->load->view('main/products');
    $this->load->view('templates/footer', $data);
  }
}
