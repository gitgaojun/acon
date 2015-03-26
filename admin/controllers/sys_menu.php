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



    }