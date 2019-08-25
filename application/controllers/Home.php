<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    $check = $this->session->flashdata('notifikasi');
    if ( isset($check) ) echo "<script>alert('{$check}');</script>";

  }

	public function index()
	{
    $this->load->view('Home/header');
		$this->load->view('Home/home');
    $this->load->view('Home/footer');
	}
}
