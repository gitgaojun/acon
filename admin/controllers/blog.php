<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');




/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/4/14
 * Time: 17:26
 */

    class blog extends AD_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model("blog_model");
            $this->load->model("db/m_db");
        }

        public function index()
        {
            P("blog/index-sel");
            $data["title"] = "博客列表";
            $list = $this->m_db->getAll("blog", "","","order by b_id");

            foreach($list as $k=>$v)
            {
                if(strlen($v["b_content"]) > 49)
                {
                    $list[$k]["b_content"] = mSubStr($v["b_content"], 50)."......";
                }
            }
            $data['list'] = $list;
            $this->load->vars($data);
            $this->load->view("blog");
        }

        /**
         * 用户信息详情页
         */
        public function sel()
        {
            P("blog/index-sel");
            $data["title"] = "博客列表";
            $attr = empty($this->input->get("attr")) ? 0 : intval($this->input->get("attr"));
            if($attr < 1)
            {
                $this->load->view("404");
                return ;
            }

            $list = $this->m_db->getAll("blog", "b_id=".$attr );
            $data['list'] = $list[0];

            $this->load->vars($data);
            $this->load->view("blog_sel");
        }

        /**
         * 添加新博客页面
         */
        public function add()
        {
            P("blog/index-add");
            $data['title'] = "添加新博客";
            $categoryList = $this->m_db->getOne("category", "1=1", "c_id,c_name");
            if(!isset($categoryList[0]))
            {
                $data["categoryList"][0] = $categoryList;
            }else{
                $data["categoryList"] = $categoryList;
            }
            $this->load->vars($data);
            $this->load->view("blog_add");

        }

        public function insert()
        {
            P("blog/index-add");

            $list["b_category_id"] = empty($this->input->post("c_category_id"))?0:intval($this->input->post("c_category_id"));
            $list["b_title"] = empty($this->input->post("b_title"))?'':trim($this->input->post("b_title"));
            $list["b_content"] = empty($this->input->post("b_content"))?'':trim($this->input->post("b_content"));
            $list["b_time"] = date("Y-m-d H:i:s", time());
            $this->result["status"]= $this->m_db->autoWrite("blog", $list);

            jsonBack($this->result);
        }

        /**
         * 修改博客信息页面
         */
        public function update()
        {
            P("blog/index-add");
            $data['title'] = "修改博客信息";
            $categoryList = $this->m_db->getOne("category", "1=1", "c_id,c_name");
            if(!isset($categoryList[0]))
            {
                $data["categoryList"][0] = $categoryList;
            }else{
                $data["categoryList"] = $categoryList;
            }
            $b_id = empty($this->input->get("attr"))?0:intval($this->input->get("attr"));
            $list=$this->m_db->getAll("blog", "b_id=".$b_id);
            $data["list"] = $list[0];

            $this->load->vars($data);
            $this->load->view("blog_update");
        }

        /**
         * 更新博客信息
         */
        public function flush()
        {
            P("blog/index-add");
            $b_id = empty($this->input->post("attr"))?0:intval($this->input->post("attr"));

            $isBid = $this->blog_model->isBid($b_id);
            if($isBid)
            {
                $this->result["status"] = false;
                $this->result["message"] = "非法请求";//不存在的数据
            }

            $list["b_category_id"] = empty($this->input->post("c_category_id"))?0:intval($this->input->post("c_category_id"));
            $list["b_title"] = empty($this->input->post("b_title"))?'':trim($this->input->post("b_title"));
            $list["b_content"] = empty($this->input->post("b_content"))?'':trim($this->input->post("b_content"));
            $list["b_time"] = date("Y-m-d H:i:s", time());
            $this->result["status"]= $this->m_db->autoUp("blog", $list, "b_id=".$b_id);

            jsonBack($this->result);


        }


        /**
         * 删除博客信息
         */
        public function del()
        {
            P("blog/index-del");
            $b_id = empty($this->input->post("attr"))?0:intval($this->input->post("attr"));

            if($b_id < 0)
            {
                $this->result["status"] = false;
                $this->result["message"] = "不存在该条数据";
                jsonBack($this->result);
            }

            $this->result["status"] = $this->m_db->delete("blog", "b_id='".$b_id."'");

            jsonBack($this->result);



        }

    }