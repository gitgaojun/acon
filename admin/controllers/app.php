<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app extends CI_Controller {



    /**
     * acon 的首页面的展示
     */
	public function index()
	{

		$this->load->view('app');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */