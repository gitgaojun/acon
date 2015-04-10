<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/4/8
 * Time: 10:40
 */

    class sys_group extends AD_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model("sys/group_model");
            $this->load->model("db/m_db");
        }

        public function index()
        {
            P("sys_group/index-sel");
            $data["title"] = "系统用户组列表";

            $list = $this->m_db->getAll("eload_sys_group");
            if(isset($list[0]))
            {
                $data["list"] = $list;
            }else
            {
                $data["list"][0] = $list;
            }
            $this->load->vars($data);
            $this->load->view("sys_group");
        }

        /**
         * 权限组详情
         */
        public function sel()
        {
            P("sys_group/index-sel");
            $data["title"] = "用户组信息";
            $attr = empty($this->input->get("attr")) ? 0 : intval($this->input->get("attr"));
            if($attr < 1)
            {
                $this->load->view("404");
                return ;
            }

            $data["menuList"] = $this->m_db->getAll("eload_sys_menu","m_parent_id<>0");

            //var_dump($data["menuList"]);exit;

            $data['list'] = $this->m_db->getAll("eload_sys_group", "g_id=".$attr );
            $data["powerArr"] = explode(";", $data["list"]["g_power"]);

            $this->load->vars($data);
            $this->load->view("sys_group_sel");
        }


        /**
         * 更新用户组信息
         */
        public function insert()
        {
            P("sys_group/index-add");
            $g_id = empty($this->input->post("g_id"))?0:intval($this->input->post("g_id"));
            $list["g_name"] = empty($this->input->post("g_name"))?"":addslashes(trim($this->input->post("g_name")));
            $list["g_desc"] = empty($this->input->post("g_desc"))?"":addslashes(trim($this->input->post("g_desc")));
            unset($_POST["g_id"],$_POST["g_name"],$_POST["g_desc"]);
            $list["g_power"] = "";
            if($g_id < 1)
            {
                $this->result["status"] = false;
                $this->result["message"] = "非法请求";
                jsonBack($this->result);
            }
            if($list["g_name"] == "")
            {
                $this->result["status"] = false;
                $this->result["message"] = "名字不能为空";
                jsonBack($this->result);
            }
            foreach($_POST as $k=>$v )
            {
                if($v=="on")
                {
                    $list["g_power"] .= $k.";" ;
                }
            }

            $this->result["status"]= $this->m_db->autoUp("eload_sys_group", $list, "g_id=".$g_id);

            jsonBack($this->result);
        }

        /**
         * 添加页面
         */
        public function add()
        {
            P("sys_group/index-add");
            $data["title"] = "添加系统组成员";
            $data["menuList"] = $this->m_db->getAll("eload_sys_menu","m_parent_id<>0");
            $this->load->vars($data);
            $this->load->view("sys_group_add");
        }

        /**
         * 插入数据
         */
        public function into()
        {
            P("sys_group/index-add");
            $list["g_name"] = empty($this->input->post("g_name"))?"":addslashes(trim($this->input->post("g_name")));
            $list["g_desc"] = empty($this->input->post("g_desc"))?"":addslashes(trim($this->input->post("g_desc")));
            unset($_POST["g_id"],$_POST["g_name"],$_POST["g_desc"]);
            $list["g_power"] = "";

            if($list["g_name"] == "")
            {
                $this->result["status"] = false;
                $this->result["message"] = "名字不能为空";
                jsonBack($this->result);
            }
            foreach($_POST as $k=>$v )
            {
                if($v=="on")
                {
                    $list["g_power"] .= $k.";" ;
                }
            }

            $result = $this->group_model->addColumnVal($list);
            if(is_string($result) || $result != "true")
            {
                $this->result["status"] = false;
                $this->result["message"] = $result;

            }

            jsonBack($this->result);
        }

        /**
         * 删除系统组信息
         */
        public function del()
        {
            P("sys_group/index-del");
            $g_id = empty($this->input->post("attr"))?0:intval($this->input->post("attr"));

            if($g_id < 0)
            {
                $this->result["status"] = false;
                $this->result["message"] = "不存在该条数据";
                jsonBack($this->result);
            }

            $this->result["status"] = $this->m_db->delete("eload_sys_group", "g_id='".$g_id."'");

            jsonBack($this->result);



        }
    }