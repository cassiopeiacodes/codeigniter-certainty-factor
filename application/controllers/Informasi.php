<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi extends CI_Controller
{
	public function __construct()
  {
    parent::__construct();
		$this->load->library('getdata');
  }

	public function index()
	{
		$data = $this->getdata->_getData();

    $this->load->view('Informasi/header');
		$this->load->view('Informasi/informasi',$data);
    $this->load->view('Informasi/footer');
	}
}
