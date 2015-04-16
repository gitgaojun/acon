<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model("blog_model");
    }

    /**
     * acon 的首页面的展示
     */
	public function index()
	{
        $data['cateList'] = $this->blog_model->getCateList();


        $this->load->vars($data);
		$this->load->view('app');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */