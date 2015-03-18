<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class MY_Controller extends CI_Controller
    {
        function __construct(){
            parent::__construct();
            $this->load->helper('string_helper');//用来调用json函数，默认对中文不转码
            $this->load->library('session');

            //json返回数据的原型,默认为真
            $this->result=array('status'=>true,'message'=>'');
            
        }
    }
    
    /**
     * 给后台使用,同时判断用户是否登录
     * @author jun90610@gmail.com
     * @return string/void
     */
    class AD_Controller extends MY_Controller
    {
        function __construct(){
            parent::__construct();
            
            $this->validate();
        }
        
        
        public function validate()
        {
            $validate=empty($this->session->userdata('adUser'))?true:false;
            if($validate)
            {
                echo <<<js
			         <script>
                        window.location.href="/admin/index.php/login";
                    </script>
js;
                exit;
            }
        }
    }
    