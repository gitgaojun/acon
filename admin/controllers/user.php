<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 用户个人中心页面
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/4/18
 * Time: 14:04
 */


    class user extends AD_Controller
    {

        function __construct()
        {
            parent::__construct();
            $this->load->model("sys/user_model");
        }


        public function index()
        {
            $data["title"] = "个人中心";
            $adUser = $this->session->userdata('adUser');//管理员信息
            $uid = intval($adUser[0]["u_id"]);
            $data["userList"] = $this->user_model->getUser($uid);
            $this->load->vars($data);
            $this->load->view("user");
        }


    }