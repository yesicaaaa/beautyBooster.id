<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller {
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
      'title'   => 'Home | beautyBooster.id',
      'css'     => 'assets/css/home.css',
      'js'      => 'assets/js/home.js'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('main/home');
    $this->load->view('templates/footer', $data);
  }
}