<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_user_model extends CI_Model{
  public function editUser(){
    $data = [
      'name'  => htmlspecialchars($this->input->post('name')),
      'email' => htmlspecialchars($this->input->post('email')),
      'image' => htmlspecialchars($this->input->post('image'))
    ];

    $this->db->where('id', $this->input->post('id'));
    $this->db->update('user', $data);
  }
}