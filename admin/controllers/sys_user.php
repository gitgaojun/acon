<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/4/3
 * Time: 14:40
 */


    /**
     * 后台用户列表
     * Class sys_user
     */
    class sys_user extends AD_Controller
    {

        function __construct()
        {
            parent::__construct();
            $this->load->model("db/m_db");
            $this->load->model("sys/user_model");
        }

        /**
         * 用户列表展示页面
         */
        public function index()
        {
            P("sys_user/index-sel");
            $data["title"] = "后台用户列表";
            $list = $this->m_db->getAll("eload_sys_user");
            if(isset($list[0]))
            {
                $selList = $list;
            }else
            {
                $selList[0] = $list;
            }//用户数组
            $data["list"] = $selList;
            $this->load->vars($data);
            $this->load->view("sys_user");
        }


        /**
         * 用户信息详情页
         */
        public function sel()
        {
            P("sys_user/index-sel");
            $data["title"] = "用户信息";
            $attr = empty($this->input->get("attr")) ? 0 : intval($this->input->get("attr"));
            if($attr < 1)
            {
                $this->load->view("404");
                return ;
            }

            $list = $this->m_db->getAll("eload_sys_user", "u_id=".$attr );
            $data['list'] = $list[0];

            $this->load->vars($data);
            $this->load->view("sys_user_sel");
        }

        /**
         * 用户信息添加页面
         */
        public function add()
        {
            P("sys_user/index-add");
            $data['title'] = "添加新用户";
            $groupList = $this->m_db->getOne("eload_sys_group", "1=1", "g_id,g_name");
            if(!isset($groupList[0]))
            {
                $data["groupList"][0] = $groupList;
            }else{
                $data["groupList"] = $groupList;
            }
            $this->load->vars($data);
            $this->load->view("sys_user_add");
        }

        /**
         * 添加用户入库数据
         */
        public function into()
        {
            P("sys_user/index-add");
            $list["u_name"] = empty($this->input->post("u_name"))?"":trim($this->input->post("u_name"));
            $list["u_relname"] = empty($this->input->post("u_relname"))?"":trim($this->input->post("u_relname"));
            $list["u_pwd"] = empty($this->input->post("u_pwd"))?"":trim($this->input->post("u_pwd"));
            $list["u_group_id"] = empty($this->input->post("u_group_id"))?0:intval($this->input->post("u_group_id"));

            if($list["u_name"] == "" )
            {
                $this->result["status"] = false;
                $this->result["message"] = "名字为空";
                jsonBack($this->result);
            }
            if($list["u_relname"] == "" )
            {
                $this->result["status"] = false;
                $this->result["message"] = "全名为空";
                jsonBack($this->result);
            }
            if($list["u_pwd"] == "" )
            {
                $this->result["status"] = false;
                $this->result["message"] = "密码为空";
                jsonBack($this->result);
            }
            if($list["u_group_id"] == "" )
            {
                $this->result["status"] = false;
                $this->result["message"] = "所属系统组为空";
                jsonBack($this->result);
            }

            $result = $this->user_model->addColumnVal($list);
            if(is_string($result) || $result != "true")
            {
                $this->result["status"] = false;
                $this->result["message"] = $result;

            }

            jsonBack($this->result);
        }


        /**
         * 修改用户信息页面
         */
        public function update()
        {
            P("sys_user/index-add");
            $data['title'] = "修改用户信息";
            $groupList = $this->m_db->getOne("eload_sys_group", "1=1", "g_id,g_name");
            if(!isset($groupList[0]))
            {
                $data["groupList"][0] = $groupList;
            }else{
                $data["groupList"] = $groupList;
            }
            $u_id = empty($this->input->get("attr"))?0:intval($this->input->get("attr"));
            $list=$this->m_db->getAll("eload_sys_user", "u_id=".$u_id);
            $data["list"] = $list[0];

            $this->load->vars($data);
            $this->load->view("sys_user_update");
        }

        /**
         * 更新用户信息
         */
        public function flush()
        {
            P("sys_user/index-add");
            $u_id = empty($this->input->post("attr"))?0:intval($this->input->post("attr"));

            $isUid = $this->user_model->isUid($u_id);
            if($isUid)
            {
                $this->result["status"] = false;
                $this->result["message"] = "非法请求";//不存在的数据
            }

            $list["u_group_id"] = empty($this->input->post("u_group_id"))?0:intval($this->input->post("u_group_id"));
            $list["u_name"] = empty($this->input->post("u_name"))?'':trim($this->input->post("u_name"));
            $list["u_relname"] = empty($this->input->post("u_relname"))?'':trim($this->input->post("u_relname"));
            $list["u_pwd"] = empty($this->input->post("u_pwd"))?0:intval($this->input->post("u_pwd"));
            $list["u_addtime"] = date("Y-m-d H:i:s", time());
            $this->result["status"]= $this->m_db->autoUp("eload_sys_user", $list, "u_id=".$u_id);

            jsonBack($this->result);


        }

        /**
         * 删除用户信息
         */
        public function del()
        {
            P("sys_user/index-del");
            $u_id = empty($this->input->post("attr"))?0:intval($this->input->post("attr"));

            if($u_id < 0)
            {
                $this->result["status"] = false;
                $this->result["message"] = "不存在该条数据";
                jsonBack($this->result);
            }

            $this->result["status"] = $this->m_db->delete("eload_sys_user", "u_id='".$u_id."'");

            jsonBack($this->result);



        }


    }