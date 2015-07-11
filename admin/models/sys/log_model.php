<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/4/13
 * Time: 18:14
 */

    class log_model extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model("db/m_db");
        }

        function getList()
        {
            $list = $this->m_db->getAll("eload_sys_log","","l_time desc");
            return $list;
        }
    }