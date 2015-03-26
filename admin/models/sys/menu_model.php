<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/3/25
 * Time: 11:09
 */

    class menu_model extends CI_Model
    {

        function __construct(){
            parent::__construct();
            $this->load->model("db/m_db");
        }

        /**
         * 查询菜单列表
         * @param $search
         * @return mixed
         */
        public function sel($search)
        {
            $sql = "select $search from `eload_sys_menu`";
            $result = $this->db->query($sql)->result_array();
            return $result;
        }



    }