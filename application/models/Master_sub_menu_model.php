<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_sub_menu_model extends CI_Model{
  public function getSubMenu($limit, $start){
    $query = "SELECT `tb_m_sub_menu`.*, `tb_m_menu`.`menu`
              FROM `tb_m_sub_menu` JOIN `tb_m_menu`
              ON `tb_m_sub_menu`.`menu_id` = `tb_m_menu`.`id`";
    return $this->db->query($query, $limit, $start)->result_array();
  }

  public function deleteSubMenu($id){
    $this->db->delete('tb_m_sub_menu', ['id' => $id]);
  }

  public function editSubMenu(){
    $data = [
      'menu_id'   => htmlspecialchars($this->input->post('menu_id')),
      'title'     => htmlspecialchars($this->input->post('title')),
      'icon'      => htmlspecialchars($this->input->post('icon')),
      'url'       => htmlspecialchars($this->input->post('url'))              
    ];
    $this->db->where('id', $this->input->post('id'));
    $this->db->update('tb_m_sub_menu', $data);
  }

  public function countAllSubMenu(){
    return $this->db->get('tb_m_sub_menu')->num_rows();
  }
}