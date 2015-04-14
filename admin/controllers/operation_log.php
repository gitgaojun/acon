<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/4/13
 * Time: 16:24
 */


    class operation_log extends AD_Controller
    {
        function __construct()
        {

            parent::__construct();
            $this->load->model("sys/log_model");
            $this->load->model("db/m_db");
        }

        /**
         * 日志列表
         */
        public function index()
        {
            $data["title"] = "系统操作日志";
            $data["list"] = $this->log_model->getList();
            $this->load->vars($data);
            $this->load->view("operation_log");
        }
    }