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


    }