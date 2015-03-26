<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class login_model extends CI_Model
    {
    
        function __construct()
        {
            parent::__construct();
            $this->load->model('db/m_db');



        }


        /**
         * 验证用户登录信息,如果成功那么生成用户session::adUser信息
         * @param 用户名 $adName
         * @param 密码 $adPsd
         * @return boolean
         */
        public function valiableLogin($adName,$adPsd)
        {
            $sql = "select * from `eload_sys_user` where `u_name`='".$adName."' and `u_pwd`='".$adPsd."'";
            $adUser = $this->db->query($sql)->result_array();
            
            if(!empty($adUser))
            {
                //初始化后台用户信息
                $this->session->set_userdata("adUser", $adUser);
                return true;
            }else{
                return false;
            }


        }
        
        /**
         * 销毁adUser的session值,如果成功那么返回true
         * @param 前台给的识别字符正确的是admin $site
         * @return boolean
         */
        public function adOut($site){
            if($site==='admin'){
                $this->session->unset_userdata('adUser');
                return $this->session->userdata("adUser")?false:true;
                
            }else{
                return false;
            }
        }


    }