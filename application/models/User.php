<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

	public function login() {

    $this->email = htmlspecialchars($this->input->post('email', true));
    $this->password = $this->input->post('password');

    $user =  $this->db->get_where('user', ['email' => $this->email])->row_array();

    if ($user) {
      $response['email'] = true;
      if (password_verify($this->password, $user['password'])) {
        $response['password'] = true;
      } else {
        $response['password'] = false;
      }
    } else {
      $response['email'] = false;
      $response['password'] = false;
    }
     return $response;
  }
}