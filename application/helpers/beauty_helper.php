<?php 

function is_logged_in_user()
{
  $ci = get_instance();
  $role = $ci->session->userdata('role_id');
  $access = $ci->db->get_where('user', ['role_id' => $role])->row_array();
  if(!$ci->session->userdata('email')){
    redirect('signin');
  } elseif($access['role_id'] == 1){
    redirect('blocked/admin'); 
  }
}

function is_logged_in_admin()
{
  $ci = get_instance();
  $role = $ci->session->userdata('role_id');
  $access = $ci->db->get_where('user', ['role_id' => $role])->row_array();
  if(!$ci->session->userdata('email')){
    redirect('signin');
  }elseif($access['role_id'] != 1){
    redirect('blocked/user');
  }
}

?>