<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/4/17
 * Time: 10:22
 */

    class details extends MY_Controller
    {

        function __construct()
		{
            parent::__construct();
            $this->load->model("blog_model");
        }

        public function index()
		{
			$b_id = $this->input->get('b');
			$b_id = intval($b_id);
            $blogList = $this->blog_model->getBlog($b_id);
            $data["blogList"] = $blogList[0];
            $this->load->vars($data);
            $this->load->view("details");
        }
    }
