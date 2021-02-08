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
    $this->load->view('landingPage', $data);
    $this->load->view('templates/footer', $data);
  }
}