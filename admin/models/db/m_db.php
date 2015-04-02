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

        /**
         * 数据写入函数
         * @param string $tableName 表名
         * @param array $list 键、值对
         * @return bool
         */
        public function autoWrite($tableName = "", $list = array())
        {

            if(empty($list)){return false;}

            $list = $this->slashesArr($list);

            $keyStr = implode(",", array_keys($list));
            $valStr = implode(",", array_values($list));

            $sql = "insert into " . $tableName . " (" . $keyStr . ") " . " values ". " ( " . $valStr . " ) ";

            $result = $this->db->query($sql);
            return $result;
        }

        /**
         * 转义入库数据
         * @param $list array
         * @return mixed array
         */
        protected function slashesArr(&$list)
        {
            foreach($list as $k => $v)
            {
                $listArr["`" . addslashes($k) . "`"] = "'" . addslashes($v) . "'";
                if(is_array($v)){
                    $this->slashesArr($v);
                }
            }
            return $listArr;
        }


        public function delete($name="", $str="" )
        {
            $sql = "delete from " . $name . " " . " where " . $str;
            $result = $this->db->query($sql);
            return $result;
        }


    }