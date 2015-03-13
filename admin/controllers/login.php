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


         public function xx(){
             echo $this->session->userdata('adCodeText');exit;
         }


         /**
          * 验证登录信息
          */
         public function valiableLogin()
         {
            $this->load->model('adLogin');
            $adName = empty($this->input->post('adName'))?'':addslashes(trim($this->input->post('adName')));
            $adPsd = empty($this->input->post('adPsd'))?'':addslashes(trim($this->input->post('adPsd')));
            $adCode = empty($this->input->post('adCode'))?'':addslashes(trim($this->input->post('adCode')));
            
            if(strtolower($adCode) !== strtolower($this->session->userdata('adCodeText')))
            {
                $this->result['message']="验证码错误";
                $this->result['status'] = false;
            }else{
                $this->result['status'] = $this->adLogin->valiableLogin($adName,$adPsd)?true:false;
                if(!$this->result['status']) $this->result['message'] = '用户名或者密码错误';
            }
            //var_dump($this->result);
            echo json($this->result);
            exit;

         }


         /**
          * 验证码
          */
         public function adCode()
         {

            $this->load->helper('code_helper');
            codeImage(200,50,"adCodeText");
            $this->session->set_userdata('adCodeText',$_SESSION['adCodeText']);
            exit;

         }

    }















