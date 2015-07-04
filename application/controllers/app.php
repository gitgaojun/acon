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
		$c_id = $this->input->get('c');
		$c_page = $this->input->get('page');
		$c_id = empty($c_id)?1:intval($c_id);
		$c_page = empty($c_page)?1:intval($c_page);
		$c_page = $this->input->get('page')?intval($this->input->get('page')):1;
        $blogList = $this->blog_model->getBlogList( $c_id , $c_page );
        foreach($blogList['data'] as $k=>$v)
        {
            $blogList['data'][$k]["b_content"] = mSubStr($v["b_content"], 50)."......";
        }
		$data["blogList"] = $blogList['data'];
		$data['html_page'] = $blogList['html_page'];
        $this->load->vars($data);
		$this->load->view('app');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
