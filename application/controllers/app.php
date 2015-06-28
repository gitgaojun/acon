<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model("blog_model");
        $this->load->helper("comm_helper");
    }

    /**
     * acon 的首页面的展示
     */
	public function index()
	{
		$c_id = $this->input->get('c')?0:intval($this->input->get('c'));
        $blogList = $this->blog_model->getBlogList($c_id);
        foreach($blogList as $k=>$v)
        {
            $blogList[$k]["b_content"] = mSubStr($v["b_content"], 50)."......";
        }
        $data["blogList"] = $blogList;
        $this->load->vars($data);
		$this->load->view('app');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
