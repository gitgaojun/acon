<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class m_db extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
        }


        /**
         * 选择数据库
         * @param  $database 数据库名字
         */
        public function db_set_database($database='')
        {
            $this->load->database($database, TRUE);
        }
    }