<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/4/14
 * Time: 16:03
 */


    class blog_model extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function getCateList()
        {
            $sql = "select * from category order by c_id";
            $result = $this->db->query($sql)->result_array();
            //var_dump($result);exit;
            return $result;
        }


        /**
         * 得到博客列表
         * @return mixed
         */
        public function getBlogList($c_id)
        {
            if($c_id > 0)
            {
                $whereStr = "where c_id='" . $c_id  . "'";
            }else
            {
                $whereStr = "";
            }
            $sql = "select * from blog as b inner join category as c on b.b_category_id=c.c_id " . $whereStr;
            $result = $this->db->query($sql)->result_array();
            //var_dump($result);exit;
            return $result;
        }

        /**
         * 得到博客信息
         * @param $b_id
         * @return mixed
         */
        function getBlog($b_id)
        {
            $sql = "select * from blog as b inner join category as c on b.b_category_id=c.c_id where b_id='" . $b_id  . "'";
            $result = $this->db->query($sql)->result_array();

            return $result;
        }

    }
