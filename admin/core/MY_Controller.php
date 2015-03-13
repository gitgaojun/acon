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