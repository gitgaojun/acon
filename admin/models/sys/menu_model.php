<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/3/25
 * Time: 11:09
 */

    class menu_model extends CI_Model
    {

        function __construct(){
            parent::__construct();
            $this->load->model("db/m_db");
        }


        /** 查询菜单列表
         * @param string $colName 查询栏
         * @param int $valName    查询值
         * @return mixed
         */
        public function sel($colName = "")
        {
            $sql = "select $colName from `eload_sys_menu` ";
            $result = $this->db->query($sql)->result_array();
            return $result;
        }

        /**
         * 生成菜单树形机构
         * @param array $arr
         * @return array
         */
        public function addLimb($arr = array())
        {
            $arrC = $arr;
            foreach($arr as $k=>$v)
            {
                foreach($arrC as $kk=>$vv)
                {
                    if($vv['m_parent_id'] == $v['m_id'])
                    {
                        $vv['limb'] = "|---";
                        $v['child'][]=$vv;
                    }
                }
                if($v["m_parent_id"] == 0) $result[]=$v;
            }unset($arrC);

            return $result;
        }

        /**
         * 添加菜单栏，菜单不能重名
         * @param string $name
         * @param array $list
         * @return string/true/false
         */
        public function addColumnVal($name="", $list = array())
        {
            $m_name = $list["m_name"];
            $result = $this->db->query("select m_name from $name where m_name=$m_name")->result_array();
            if(!empty($result))
            {
                foreach($result as $k=>$v)
                {
                    $nameList[] = $v["m_name"];
                }

                if(in_array($m_name, $nameList))
                {
                    return $m_name . "重名了";
                }
            }

            $result = $this->m_db->autoWrite($name, $list);


            return $result;
        }

        public function flush()
        {
            $m_id = empty($this->input->post("m_id"))?0:intval($this->input->post("m_id"));
            $list["m_parent_id"] = empty($this->input->post("m_parent_id"))?0:intval($this->input->post("m_parent_id"));
            $list["m_name"] = empty($this->input->post("m_name"))?'':trim($this->input->post("m_name"));
            $list["m_url"] = empty($this->input->post("m_url"))?'':trim($this->input->post("m_url"));
            $list["m_sort"] = empty($this->input->post("m_sort"))?0:intval($this->input->post("m_sort"));
            $list["m_dis"] = empty($this->input->post("m_dis"))?0:intval($this->input->post("m_dis"));
            $this->m_db->autoWrite("eload_sys_menu", $list, "m_id=".$m_id);
        }
    }