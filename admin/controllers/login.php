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
            $this->load->model('login_model');

             //销毁session
            $this->session->unset_userdata('adUser');
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
            $this->load->model('login_model');
            $adName = empty($this->input->post('adName'))?'':addslashes(trim($this->input->post('adName')));
            $adPsd = empty($this->input->post('adPsd'))?'':addslashes(trim($this->input->post('adPsd')));
            $adCode = empty($this->input->post('adCode'))?'':addslashes(trim($this->input->post('adCode')));
            
            if(strtolower($adCode) !== strtolower($this->session->userdata('adCodeText')))
            {
                $this->result['message']="验证码错误";
                $this->result['status'] = false;
            }else{
                $this->result['status'] = $this->login_model->valiableLogin($adName,$adPsd)?true:false;
                if(!$this->result['status']) $this->result['message'] = '用户名或者密码错误';
            }

            jsonBack($this->result);


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



         /**
          * 退出登录
          */
         public function loginOut()
         {
             $this->load->model('login_model');
             $site = empty($this->input->post('site'))?'':addslashes(trim($this->input->post('site')));
             $this->result['status'] = $this->login_model->adOut($site);
             if(!$this->result['status']){ $this->result['message'] = '退出系统失败,请联系管理员';}
             jsonBack($this->result);

         }         
         
         
         
    }















