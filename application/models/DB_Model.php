<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/7/7
 * Time: 17:40
 */
/**
 * 封装常用的数据调用方法
 * 获取一个表中的一个字段数据
 * 获取一个表中的一行数据
 * 获取满足条件的查询语句
 * 更新数据
 * 插入数据
 * 添加数据
 */


    class DB_Model extends CI_Model
    {
        // 数据库操作对象
        private $_db;
        function __construct()
        {
            parent::__construct();
            $_db = $this->load->database();
        }


        /**
         * 获取一个表中的一个栏目的数据
         * @author jun
         * @param string $table  表名
         * @param string $field  栏目名
         * @return string
         */
        public function getOneField($table, $field)
        {
            $field_value = self::$_db->select($field)->from($table)->query()->result_array();
            if(empty($field_value))
                $result = '';
            else
                $result = $field_value[0][$field];
            return $result;
        }

        /**
         * 获取一个表中的满足条件的一行数据
         * @author jun
         * @param  string $table  表名
         * @param  string $field  栏目名
         * @param  array  $where  满足条件
         * @return array
         */
        public function getOne($table, $field, $where=array())
        {
            $field_array = self::$_db->select($field)->from($table)->where($where)->query()->result_array();
            if(empty($field_array))
                $result = array();
            else
                $result = $field_array[0];
            return $result;
        }




    }