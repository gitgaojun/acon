<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app extends AD_Controller {

    function __construct(){
        parent::__construct();
    }


    /**
     * acon 的首页面的展示
     */
	public function index()
	{
	    $adUser = $this->session->userdata('adUser');//管理员信息
	    $data['adName'] = $adUser[0]['real_name'];
	    //var_dump($data['adUser']['real_name']);exit; 
	    $this->load->vars($data);
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