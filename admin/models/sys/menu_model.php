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

    }