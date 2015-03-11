<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * 后台管理中心登录页面
     * @author jun
     *
     */
    class login extends MY_Controller
    {


         public function __construct() {
            parent::__construct();
            $this->load->model('adLogin');
         }


         /**
          * 登录页面默认展示信息
          */
         public function index()
         {
            $this->load->helper('code_helper');
            $this->load->view('login');
         }





         /**
          * 验证登录信息
          */
         public function valiableLogin()
         {
            $this->load->model('adLogin');
            $adName = empty($this->input->post('adName'))?'':addslashes(trim($this->input->post('adName')));
            $adPwd = empty($this->input->post('adPwd'))?'':addslashes(trim($this->input->post('adPwd')));
            $adCode = empty($this->input->post('adCode'))?'':addslashes(trim($this->input->post('adCode')));

            if($adCode !== $_SESSION['adCodeText'])
            {
                $result['msg']="验证码错误";
                $result['status'] = false;
            }else{
                $result['status'] = $this->adLogin->valiableLogin($adName,$adPwd);
                $result['status'] = 23;
            }
            
            echo json($result);
            exit;

         }


         /**
          * 验证码
          */
         public function adCode()
         {

            $this->load->helper('code_helper');
            codeImage(200,50,"adCodeText");
            exit;

         }

    }















