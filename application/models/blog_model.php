<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/4/14
 * Time: 16:03
 */


    class blog_model extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function getCateList()
        {
            $sql = "select * from category order by c_id";
            $result = $this->db->query($sql)->result_array();
            //var_dump($result);exit;
            return $result;
        }


        /**
		 * 得到博客列表
		 * @author jun
		 * @param c_id int 分类id
		 * @param page int 当前页数
		 * @param pages int 每页条数
         * @return mixed
         */
        public function getBlogList($c_id, $page, $pages=10)
        {
			$offset = $pages*($page-1);//查询起始位置
			$this->db->select('SQL_CALC_FOUND_ROWS * ', false)->from('blog as b')->join('category as c', 'b.b_category_id=c.c_id');

			$this->load->library('page');
            if($c_id > 0)
            {
                $this->db->where(array('c.c_id'=>$c_id));
            }
            $this->db->limit($pages)->offset($offset);
            $result = $this->db->get()->result_array();

            $num = $this->db->query('select FOUND_ROWS()')->result_array();
			$num = (int)$num[0]['FOUND_ROWS()'];
			$getHtmlPage = $this->page->get_page($page, $num);
			return array('data'=>$result,'html_page'=>$getHtmlPage);
        }

        /**
         * 得到博客信息
         * @param $b_id
         * @return mixed
         */
        function getBlog($b_id)
        {
            $sql = "select * from blog as b inner join category as c on b.b_category_id=c.c_id where b_id='" . $b_id  . "'";
            $result = $this->db->query($sql)->result_array();

            return $result;
        }

    }
