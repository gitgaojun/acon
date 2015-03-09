<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class adLogin extends CI_Model
    {
        const TABLE='eload_sys_admin';

        function __construct()
        {
            parent::__construct();
            $this->load->model('db');
            $this->db->d_set_db('acon');

        }


        public function valiableLogin($adName,$adPwd)
        {
            $sysAdminGroup = $this->db->select('*')->from(TABLE)->where("ad_name='".$adName."' and ad_pwd='".$adPwd."'")->get_query->result_array();
            if(!empty($sysAdminGroup))
            {
                $_SESSION['sysAdminGroup'] = $sysAdminGroup;
                return true;
            }else{
                return false;
            }


        }


    }