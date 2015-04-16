<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/4/14
 * Time: 14:00
 */

    class blog_category extends AD_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model("blog_model");
            $this->load->model("db/m_db");
        }

        public function index()
        {
            $data["title"] = "博客分类列表";
            $data['list'] = $this->m_db->getAll("category", "","","order by c_id");
            $this->load->vars($data);
            $this->load->view("blog_category");
        }

        /**
         * 博客分类信息详情页
         */
        public function sel()
        {
            P("blog_category/index-sel");
            $data["title"] = "博客分类";
            $attr = empty($this->input->get("attr")) ? 0 : intval($this->input->get("attr"));
            if($attr < 1)
            {
                $this->load->view("404");
                return ;
            }

            $list = $this->m_db->getAll("category", "c_id=".$attr );
            //var_dump($list);exit;
            $data['list'] = $list[0];

            $this->load->vars($data);
            $this->load->view("blog_category_sel");
        }

        /**
         * 博客分类信息添加页面
         */
        public function add()
        {
            P("sys_user/index-add");
            $data['title'] = "添加新栏目";
            $groupList = $this->m_db->getOne("eload_sys_group", "1=1", "g_id,g_name");
            if(!isset($groupList[0]))
            {
                $data["groupList"][0] = $groupList;
            }else{
                $data["groupList"] = $groupList;
            }
            $this->load->vars($data);
            $this->load->view("blog_category_add");
        }

        /**
         * 添加博客分类入库数据
         */
        public function into()
        {
            P("blog_category/index-add");
            $list["c_name"] = empty($this->input->post("c_name"))?"":trim($this->input->post("c_name"));

            if($list["c_name"] == "" )
            {
                $this->result["status"] = false;
                $this->result["message"] = "名字为空";
                jsonBack($this->result);
            }


            $result = $this->blog_model->addColumnVal($list);
            if(is_string($result) || $result != "true")
            {
                $this->result["status"] = false;
                $this->result["message"] = $result;

            }

            jsonBack($this->result);
        }

        /**
         * 修改博客分类信息页面
         */
        public function update()
        {
            P("blog_category/index-add");
            $data['title'] = "修改博客分类信息";
            $cateList = $this->m_db->getOne("category", "1=1", "c_id,c_name");
            if(!isset($cateList[0]))
            {
                $data["cateList"][0] = $cateList;
            }else{
                $data["cateList"] = $cateList;
            }
            $c_id = empty($this->input->get("attr"))?0:intval($this->input->get("attr"));
            $list=$this->m_db->getAll("category", "c_id=".$c_id);
            $data["list"] = $list[0];

            $this->load->vars($data);
            $this->load->view("blog_category_update");
        }

        /**
         * 更新博客分类信息
         */
        public function flush()
        {
            P("blog_category/index-add");
            $c_id = empty($this->input->post("attr"))?0:intval($this->input->post("attr"));

            $isCid = $this->blog_model->isCid($c_id);
            if($isCid)
            {
                $this->result["status"] = false;
                $this->result["message"] = "非法请求";//不存在的数据
            }

            $list["c_name"] = empty($this->input->post("c_name"))?'':trim($this->input->post("c_name"));
            $list["c_time"] = date("Y-m-d H:i:s", time());
            $this->result["status"]= $this->m_db->autoUp("category", $list, "c_id=".$c_id);

            jsonBack($this->result);


        }

        /**
         * 删除用户信息
         */
        public function del()
        {
            P("blog_category/index-del");
            $c_id = empty($this->input->post("attr"))?0:intval($this->input->post("attr"));

            if($c_id < 0)
            {
                $this->result["status"] = false;
                $this->result["message"] = "不存在该条数据";
                jsonBack($this->result);
            }


            $this->result["status"] = $this->m_db->delete("category", "c_id='".$c_id."'");

            jsonBack($this->result);



        }

    }