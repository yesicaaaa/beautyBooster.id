<?php 
defined('BASEPATH') or exit('No direct script allowed');

class Blocked extends CI_Controller{
  public function admin()
  {
    $this->load->view('blocked-admin');
  }

  public function user()
  {
    $this->load->view('blocked-user');
  }
}
?>