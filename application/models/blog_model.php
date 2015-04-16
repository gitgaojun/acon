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


    }
