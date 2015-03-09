<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class adLogin extends CI_Model
    {

        function __construct()
        {
            $this->load->model('m_db');
            $this->m_db->db_set_database('acon',true);



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