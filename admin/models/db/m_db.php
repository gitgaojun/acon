<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class m_db extends CI_Model
    {
        private $_db;
        
        function __construct()
        {
            $this->load->database();
        }

        /**
         * 获取所有的查选信息
         * @param string $tableName 表名
         * @param string $whereStr 查选条件
         * @return mixed
         *
         */
        public function getAll($tableName = "", $whereStr = "1=1")
        {
            $sql = "SELECT * FROM " . $tableName . " WHERE " . $whereStr;
            $result = $this->db->query($sql)->result_array();
            if(count($result) == 1){
                return $result[0];
            }
            return $result;
        }


    }