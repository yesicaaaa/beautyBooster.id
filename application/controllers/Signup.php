<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Signup extends CI_Controller {
  public function index()
  {
    $this->form_validation->set_rules('name', 'Fullname', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]');
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

    if($this->form_validation->run() == false){
      $data = [
        'title'   => 'Sign Up | beautyBooster.id',
        'css'     => 'assets/css/signup.css'
      ];
      $this->load->view('templates/header', $data);
      $this->load->view('users/signup');
      $this->load->view('templates/footer');    
    }else{
      $email = $this->input->post('email', true);
      $data = [
        'name'          => htmlentities($this->input->post('name', true)),
        'email'         => htmlspecialchars($email),
        'image'         => 'default.jpg',
        'password'      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
        'role_id'       => 2,
        'is_active'     => 0,
        'date_created'  => time()
      ];

      //siapkan token
      $token = base64_encode(random_bytes(32));
      $user_token = [
        'email'         => $email,
        'token'         => $token,
        'date_created'  => time()
      ];

      $this->db->insert('user', $data);
      $this->db->insert('user_token', $user_token);

      $this->_sendEmail($token, 'verify');

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created! Please activate your account.  </div>');
      redirect('signin');
    }
  }

  private function _sendEmail($token, $type)
  {
    $config = [
      'protocol'  => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_user' => 'dalhaneul.s@gmail.com',
      'smtp_pass' => 'seo555554444',
      'smtp_port' => 465,
      'mailtype'  => 'html',
      'charset'   => 'utf-8',
      'newline'   => "\r\n"
    ];

    $this->email->initialize($config);

    $this->email->from('dalhaneul.s@gmail.com', '달하늘 서');
    $this->email->to($this->input->post('email'));

    if($type == 'verify'){
      $this->email->subject('Account Verification');
      $this->email->message('Click this link to verify your account : <a href="' . base_url() . 'signup/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
    } else if($type == 'forgot') {
      $this->email->subject('Reset Password');
      $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'signup/resetPassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
    }

    if($this->email->send()) {
      return true;
    } else {
      echo $this->email->print_debugger();
      die;
    }
  }

  public function verify()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');

    $user = $this->db->get_where('user', ['email' => $email])->row_array();

    if($user){
      $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

      if($user_token){
        if(time() - $user_token['date_created'] < (60*60*24)){
          $this->db->set('is_active', 1);
          $this->db->where('email', $email);
          $this->db->update('user');

          $this->db->delete('user_token', ['email' => $email]);

          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' has been activated! Please login.</div>');
          redirect('signin');
        }else{
          $this->db->delete('user', ['email' => $email]);
          $this->db->delete('user_token', ['email' => $email]);

          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Token expired!</div>');
          redirect('signin');
        }
      }else{
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Token invalid!</div>');
        redirect('signin');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong email!</div>');
      redirect('signin');
    }
  }

  public function forgotPassword()
  {
    $data = [
      'title'   => 'Forgot Password | beautyBooster.id',
      'css'     => 'assets/css/signin.css'
    ];

    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('users/forgot_password');
      $this->load->view('templates/footer');
    } else {
      $email = $this->input->post('email');
      $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

      if ($user) {
        $token = base64_encode(random_bytes(32));
        $user_token = [
          'email'         => $this->input->post('email'),
          'token'         => $token,
          'date_created'  => time()
        ];

        $this->db->insert('user_token', $user_token);
        $this->_sendEmail($token, 'forgot');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset your password!</div>');
        redirect('signup/forgotPassword');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered or activated!</div>');
        redirect('signup/forgotPassword');
      }
    }
  }

  public function resetPassword()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');

    $user = $this->db->get_where('user', ['email' => $email])->row_array();

    if($user){
      $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
      if($user_token){
        if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
          $this->session->set_userdata('reset_email', $email);
          $this->changePassword();
        } else {
          $this->db->delete('user', ['email' => $email]);
          $this->db->delete('user_token', ['email' => $email]);

          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset Password failed! Token expired!</div>');
          redirect('signin');
        }
      }else{
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong token.</div>');
        redirect('signin');
      }
    }else{
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong email.</div>');
      redirect('signin');
    }
  }

  public function changePassword()
  {
    if(!$this->session->userdata('reset_email')){
      redirect('signin');
    }
    
    $data = [
      'title'   => 'Change Password | beautyBooster.id',
      'css'     => 'assets/css/signin.css'
    ];

    $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[6]|matches[password2]');
    $this->form_validation->set_rules('password2', 'Confirm Password', 'trim|required|matches[password1]');

    if($this->form_validation->run() == false){
      $this->load->view('templates/header', $data);
      $this->load->view('users/change_password', $data);
      $this->load->view('templates/footer');
    }else{
      $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
      $email = $this->session->userdata('reset_email');

      $this->db->set('password', $password);
      $this->db->where('email', $email);
      $this->db->update('user');

      $this->session->unset_userdata('reset_email');

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed! Please signin.</div>');
      redirect('signin');
    }
  }
}