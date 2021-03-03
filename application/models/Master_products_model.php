<?php
defined('BASEPATH') or exit('No direct script access allowed');

class master_products_model extends CI_Model
{
  public function getSubMenu()
  {
    $query = "SELECT `tb_m_sub_menu`.*, `tb_m_menu`.`menu`
              FROM `tb_m_sub_menu` JOIN `tb_m_menu`
              ON `tb_m_sub_menu`.`menu_id` = `tb_m_menu`.`id`
              ";
    return $this->db->query($query)->result_array();
  }
}
