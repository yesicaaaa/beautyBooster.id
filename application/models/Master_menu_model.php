<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_menu_model extends CI_Model
{
  public function getMenu($limit, $start, $keyword = null)
  {
    if ($keyword != null) {
      $query = "SELECT * FROM `tb_m_menu`
                WHERE `menu` LIKE '%$keyword%'
                LIMIT $start, $limit
                ";
    } else {
      $query = "SELECT * FROM `tb_m_menu`
                LIMIT $start, $limit
                ";
    }
    return $this->db->query($query)->result_array();
  }

  public function deleteMenu($id)
  {
    $this->db->delete('tb_m_menu', ['id' => $id]);
  }

  public function editMenu()
  {
    $data = [
      'menu'  => htmlspecialchars($this->input->post('menu'))
    ];

    $this->db->where('id', $this->input->post('id'));
    $this->db->update('tb_m_menu', $data);
  }
}
