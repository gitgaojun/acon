<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/4/14
 * Time: 14:03
 */


    class blog_model extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
        }



        /**
         * 添加用户数据
         * @param array $list
         * @return string/bool
         */
        public function addColumnVal( $list = array())
        {
            if($list["c_name"])
            {
                $isUname = $this->m_db->getOne("category","c_name='".$list["c_name"]."'","count(*)");
                //var_dump($isUname["count(*)"]);exit;
                if(intval($isUname["count(*)"]) > 1)
                {
                    return "重名了";
                }

            }
            $tabName = "category";
            $list["c_time"] = date("Y-m-d H:i:s",time());

            $result = $this->m_db->autoWrite($tabName, $list);


            return $result;
        }

        /**
         * 判断c_id是否真确
         * @param $cId
         * @return bool
         */
        public function isCid($cId)
        {
            $List = $this->m_db->getAll("category", "c_id=".$cId);
            $result = empty($List)?false:true;
            return $result;
        }

        /**
         * 判断b_id是否真确
         * @param $cId
         * @return bool
         */
        public function isBid($bId)
        {
            $List = $this->m_db->getAll("blog", "b_id=".$bId);
            $result = empty($List)?false:true;
            return $result;
        }
    }