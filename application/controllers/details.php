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
        {echo 3;exit;
            parent::__construct();
            $this->load->model("blog_model");

        }

        public function index()
        {
            $b_id = empty($this->input->get("b"))?0:intval($this->input->get("b"));
			echo 3;exit;

            $blogList = $this->blog_model->getBlog($b_id);

            $data["blogList"] = $blogList[0];

            $this->load->vars($data);
            $this->load->view("details");
        }
    }
