<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/4/3
 * Time: 14:40
 */


    /**
     * 后台用户列表
     * Class sys_user
     */
    class sys_user extends AD_Controller
    {

        function __construct()
        {
            parent::__construct();
            $this->load->model("db/m_db");
            $this->load->model("sys/user_model");
        }

        /**
         * 用户列表展示页面
         */
        public function index()
        {
            $data["title"] = "后台用户列表";
            $list = $this->m_db->getAll("eload_sys_user");
            if(isset($list[0]))
            {
                $selList = $list;
            }else
            {
                $selList[0] = $list;
            }//用户数组
            $data["list"] = $selList;
            $this->load->vars($data);
            $this->load->view("sys_user");
        }



        public function sel()
        {
            $data["title"] = "用户信息";
            $attr = empty($this->input->get("attr")) ? 0 : intval($this->input->get("attr"));
            if($attr < 1)
            {
                $this->load->view("404");
                return ;


            }


            $this->load->vars($data);
            $this->load->view("sys_sel");
        }


    }