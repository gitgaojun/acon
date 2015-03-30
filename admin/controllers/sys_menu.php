<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/3/25
 * Time: 9:42
 */

    /**
     * Class sys_menu
     * 系统菜单栏
     */
    class sys_menu extends AD_Controller
    {

        function __construct()
        {
            parent::__construct();
            $this->load->model("sys/menu_model");
            /* 封装的数据库操作 */
            $this->load->model("db/m_db");
        }

        /**
         * 菜单列表,读取缓存文件
         */
        public function index()
        {
            $data['title'] = "系统菜单栏";
            $data['menuList'] = $this->menu_model->sel("*");
            $this->load->vars($data);
            $this->load->view("sys_menu");

        }

        public function sel()
        {
            $m_id = empty($this->input->post("paramId"))?0:intval($this->input->post("paramId"));

            $this->result["data"]=$this->m_db->getAll("eload_sys_menu", "m_id=".$m_id);


            if(empty($this->result["data"]))
            {
                $this->result["status"] = false;
                $this->result['message'] = "获取数据失败";
            }else{
                $this->result["status"] = true;
            }

            jsonBack($this->result);
        }



    }