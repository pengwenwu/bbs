<?php
class Index extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->model('Column_model');
		$this->load->helper('cookie');
	}

	public function index ()
	{	
		$this->load->view('Index/home');
	}

	public function right ()
	{
		$this->load->view('Index/right');
	}
}