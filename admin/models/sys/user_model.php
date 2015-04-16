<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/4/3
 * Time: 15:04
 */

    /**
     * 用户列表数据层
     * Class user_model
     */
    class user_model extends CI_Model
    {

        function __construct()
        {
            parent::__construct();
            $this->load->model("db/m_db");

        }

        /**
         * 添加用户数据
         * @param array $list
         * @return string/bool
         */
        public function addColumnVal( $list = array())
        {
            if($list["u_name"])
            {
                $isUname = $this->m_db->getOne("eload_sys_user","u_name='".$list["u_name"]."'","count(*)");
                if(intval($isUname["count(*)"]) > 1)
                {
                    return "重名了";
                }

            }
            $tabName = "eload_sys_user";
            $list["u_addtime"] = date("Y-m-d H:i:s",time());
            $list["u_lasttime"] = date("Y-m-d H:i:s",time());
            $list["u_ip"] = $_SERVER['REMOTE_ADDR'];


            $result = $this->m_db->autoWrite($tabName, $list);


            return $result;
        }


        /**
         * 判断u_id是否真确
         * @param $uId
         * @return bool
         */
        public function isUid($uId)
        {
            $List = $this->m_db->getAll("eload_sys_user", "u_id=".$uId);
            $result = empty($List)?false:true;
            return $result;
        }


    }