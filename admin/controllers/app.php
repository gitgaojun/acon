<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app extends MY_Controller {

    function __construct(){
        parent::__construct();
    }


    /**
     * acon 的首页面的展示
     */
	public function index()
	{
		$this->load->view('app');
	}
	
	
	/**
	 * 后台首页的logo
	 */
	public function logoImage()
	{
	    $this->load->helper('logo_helper');
	    $siteName = 'acon';
	    createLogo(300,50,$siteName);
	    exit;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */