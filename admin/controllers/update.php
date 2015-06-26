<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class update extends AD_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{


		//$this->load->vars($data);
		$this->load->view('update_img');
	}
}