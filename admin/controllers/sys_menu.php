<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/3/25
 * Time: 9:42
 */

    /**
     * Class sys_menu
     * 系统菜单栏
     */
    class sys_menu extends AD_Controller
    {

        function __construct()
        {
            parent::__construct();
            $this->load->model("sys/menu_model");
            /* 封装的数据库操作 */
            $this->load->model("db/m_db");
        }

        /**
         * 菜单列表,读取缓存文件
         */
        public function index()
        {
            P("sys_menu/index-sel");
            $data['title'] = "系统菜单栏";
            $selList = $this->menu_model->sel("*");
            //合成菜单的管理数组
            $data["menuList"] = $this->menu_model->addLimb($selList);
            $this->load->vars($data);
            $this->load->view("sys_menu");

        }


        /**
         * 详情
         */
        public function sel()
        {
            P("sys_menu/index-sel");
            $m_id = empty($this->input->post("paramId"))?0:intval($this->input->post("paramId"));

            $this->result["data"]=$this->m_db->getAll("eload_sys_menu", "m_id=".$m_id);


            if(empty($this->result["data"]))
            {
                $this->result["status"] = false;
                $this->result['message'] = "获取数据失败";
            }else{
                $this->result["status"] = true;
            }

            jsonBack($this->result);
        }

        /**
         * 添加菜单页面
         */
        public function add()
        {
            P("sys_menu/index-add");
            $data['title'] = "添加菜单";
            $parentList = $this->m_db->getAll("eload_sys_menu"," `m_parent_id`='0'");
            if(in_array("0", $parentList)) $data['parentList'][0] = $parentList;
            $this->load->vars($data);
            $this->load->view("sys_menu_add");
        }

        /**
         * 添加菜单数据到库
         */
        public function into()
        {
            P("sys_menu/index-add");
            $list["m_parent_id"] = empty($this->input->post("m_parent_id"))?0:intval($this->input->post("m_parent_id"));
            $list["m_name"] = empty($this->input->post("m_name"))?'':trim($this->input->post("m_name"));
            $list["m_url"] = empty($this->input->post("m_url"))?'':trim($this->input->post("m_url"));
            $list["m_sort"] = empty($this->input->post("m_sort"))?0:intval($this->input->post("m_sort"));
            $list["m_dis"] = empty($this->input->post("m_dis"))?0:intval($this->input->post("m_dis"));

            if($list["m_name"] == '' )
            {
                $this->result["status"] = false;
                $this->result["message"] = "名字为空";
                jsonBack($this->result);
            }
            if($list["m_url"] == "" )
            {
                $this->result["status"] = false;
                $this->result["message"] = "链接为空";
                jsonBack($this->result);
            }

            $result = $this->menu_model->addColumnVal("eload_sys_menu", $list);
            if(is_string($result) || $result != "true")
            {
                $this->result["status"] = false;
                $this->result["message"] = $result;

            }
            jsonBack($this->result);
        }

        public function del()
        {
            P("sys_menu/index-del");
            $m_id = empty($this->input->post("attr"))?0:intval($this->input->post("attr"));

            if($m_id < 0)
            {
                $this->result["status"] = false;
                $this->result["message"] = "不存在该条数据";
                jsonBack($this->result);
            }

            $this->result["status"] = $this->m_db->delete("eload_sys_menu", "m_id=".$m_id);

            jsonBack($this->result);



        }

        public function update()
        {
            P("sys_menu/index-add");
            $data['title'] = "修改菜单";
            $m_id = empty($this->input->get("attr"))?0:intval($this->input->get("attr"));
            $data["list"]=$this->m_db->getAll("eload_sys_menu", "m_id=".$m_id);


            $this->load->vars($data);
            $this->load->view("sys_menu_update");
        }


        public function flush()
        {
            P("sys_menu/index-add");
            $m_id = empty($this->input->post("attr"))?0:intval($this->input->post("attr"));

            $isMid = $this->menu_model->isMid($m_id);
            if($isMid)
            {
                $this->result["status"] = false;
                $this->result["message"] = "非法请求";//不存在的数据
            }

            $list["m_parent_id"] = empty($this->input->post("m_parent_id"))?0:intval($this->input->post("m_parent_id"));
            $list["m_name"] = empty($this->input->post("m_name"))?'':trim($this->input->post("m_name"));
            $list["m_url"] = empty($this->input->post("m_url"))?'':trim($this->input->post("m_url"));
            $list["m_sort"] = empty($this->input->post("m_sort"))?0:intval($this->input->post("m_sort"));
            $list["m_dis"] = empty($this->input->post("m_dis"))?0:intval($this->input->post("m_dis"));
            $this->result["status"]= $this->m_db->autoUp("eload_sys_menu", $list, "m_id=".$m_id);

            jsonBack($this->result);


        }
    }