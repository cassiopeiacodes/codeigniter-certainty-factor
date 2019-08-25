<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*  register verification */
$config['register']      = array(
  array(
    'field'         => 'password',
    'label'         => "<strong>password</strong>",
    'rules'         => 'trim|required|min_length[8]|max_length[15]|differs[email]|alpha_numeric',
    'errors'        => array(
      'required'      => '{field} tidak boleh kosong!',
      'differs'       => '{field} tidak boleh sama dengan {param}!',
      'min_length'    => '{field} tidak boleh kurang dari {param}',
      'max_length'    => '{field} tidak boleh lebih dari {param}!',
      'alpha_numeric' => 'hanya boleh menggunakan huruf dan angka saja di {field}!',
    ),
  ),
  array(
    'field'         => 're-password',
    'label'         => "<strong>password ulang</strong>",
    'rules'         => 'trim|required|matches[password]',
    'errors'      => array(
      'required'      => '{field} tidak boleh kosong!',
      'matches'       => '{field} tidak cocok!',
    ),
  ),
  array(
    'field'         => 'email',
    'label'         => "<strong>email</strong>",
    'rules'         => 'trim|required|valid_email|is_unique[user.email]',
    'errors'      => array(
      'required'      => '{field} tidak boleh kosong!',
      'valid_email'   => 'penulisan {field} salah!',
      'is_unique'     => '{field} tidak dapat digunakan!'
    ),
  ),
);

/*  login verification */
$config['login']      = array(
  array(
    'field'         => 'password',
    'label'         => "<strong>password</strong>",
    'rules'         => 'trim|required',
    'errors'        => array(
      'required'      => '{field} tidak boleh kosong!',
    ),
  ),
  array(
    'field'         => 'email',
    'label'         => "<strong>email</strong>",
    'rules'         => 'trim|required|valid_email',
    'errors'      => array(
      'required'      => '{field} tidak boleh kosong!',
      'valid_email'   => 'penulisan {field} salah!',
    ),
  ),
);

?>
