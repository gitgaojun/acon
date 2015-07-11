<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/4/8
 * Time: 10:45
 */


    class group_model extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model("db/m_db");
        }

        /**
         * 添加新的系统分组信息
         * @param array $list
         * @return string
         */
        public function addColumnVal( $list = array())
        {

            if($list["g_name"])
            {
                $isGname = $this->m_db->getOne("eload_sys_group","g_name='".$list["g_name"]."'");

                if(!empty($isGname))
                {
                    return "重名了";
                }

            }
            $tabName = "eload_sys_group";


            $result = $this->m_db->autoWrite($tabName, $list);


            return $result;
        }

    }