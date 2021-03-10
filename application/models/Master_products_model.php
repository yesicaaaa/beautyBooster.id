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

  public function getProducts()
  {
    $query = "SELECT `tb_m_products`.*, `menu_categories`.`category`, `menu_sub_categories`.`title`
              FROM `tb_m_products` 
              JOIN `menu_categories` ON `tb_m_products`.`category_id` = `menu_categories`.`id`
              JOIN `menu_sub_categories` ON `tb_m_products`.`sub_category_id` = `menu_sub_categories`.`id`
              ";
    return $this->db->query($query)->result_array();
  }

  public function deleteProduct($id)
  {
    $this->db->delete('tb_m_products', ['id' => $id]);
  }

  public function editProduct()
  {
    $data = [
      'category_id'       => htmlspecialchars($this->input->post('category_id')),
      'sub_category_id'   => htmlspecialchars($this->input->post('sub_category_id')),
      'product_name'      => htmlspecialchars($this->input->post('product_name')),
      'stock'             => htmlspecialchars($this->input->post('stock')),
      'price'             => htmlspecialchars($this->input->post('price')),
      'description'       => htmlspecialchars($this->input->post('description'))
    ];

    $this->db->where('id', $this->input->post('id'));
    $this->db->update('tb_m_products', $data);
  }
}
