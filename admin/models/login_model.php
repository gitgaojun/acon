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
                //用户所在系统分组
                session_start();
                $_SESSION["powerId"] = $adUser[0]["u_group_id"];

                //更新用户信息
                if(!$this->updateUser($adName))
                {
                    return false;
                }

                /**
                 * 登录成功的时候检查缓存文件，没有就重写
                 */
                $this->load->helper("sys_helper");
                createSysCache();


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
        public function adOut($site)
        {
            if($site==='admin'){
                $this->session->unset_userdata('adUser');
                session_start();
                unset($_SESSION["powerId"]);//销毁系统组信息
                return $this->session->userdata("adUser")?false:true;
                
            }else{
                return false;
            }
        }


        protected function updateUser($u_name = '')
        {
            $lastTime = date("Y-m-d H:i:s");
            $ip = $_SERVER['REMOTE_ADDR'];
            $lastTime = addslashes($lastTime);
            $ip = addslashes($ip);

            $sql = "update `eload_sys_user` set `u_lasttime`='".$lastTime."', `u_ip`='".$ip."', `u_count`=`u_count`+1  where `u_name`='" .$u_name . "'";
            $status= $this->db->query($sql);
            return $status;
        }

    }