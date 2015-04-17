<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/4/9
 * Time: 15:39
 */

    if( !function_exists("power_examination"))
    {
        /**
         * 用户权限检查
         * @param $powerParem
         */
        function P( $powerParam ){
            global $sysCacheName;
            //session_start();
            //用户所属系统组

            $groupId = $_SESSION["powerId"];
            //$groupListCache = file_get_contents($sysCacheName["sys_group"]);
            include($sysCacheName["sys_group"]);
            $groupListCache = $result;unset($result);

            $powerList = "";
            foreach($groupListCache as $k => $v)
            {
                if(intval($v['g_id']) === intval($groupId) )
                {
                    $powerList = $v["g_power"];
                }
            }
            $powerArr = explode(";", $powerList);
            //var_dump($powerArr,$powerParam);exit;
            $result = in_array($powerParam, $powerArr);

            if( !$result )
            {
                echo <<<js
                        <script>
                        window.location.href="/admin/index.php/no_find/index";
                        </script>
js;

            }

        }
    }


    if( !function_exists("getSysMenuList"))
    {
        /**
         * 计算出登录用户可视的目录数组
         * @return array
         */
        function getSysMenuList()
        {
            global $sysCacheName;
            include($sysCacheName["sys_menu"]);
            $arr = $result;unset($result);//var_dump($arr);exit;
            include($sysCacheName["sys_group"]);
            $gArr = $result;unset($result);
            session_start();
            $groupId = $_SESSION["powerId"];

            $arrC = $arr;

            $powerList = "";
            foreach($gArr as $k => $v)
            {
                if(intval($v['g_id']) === intval($groupId) )
                {
                    $powerList = $v["g_power"];
                }
            }
            $powerArr = explode(";", $powerList);
            //var_dump($powerArr,$powerParam);exit;
            //$resultGroup = in_array($powerParam, $powerArr);

            foreach($arr as $k=>$v)
            {
                foreach($arrC as $kk=>$vv)
                {
                    if($vv['m_parent_id'] == $v['m_id'])
                    {
                        if(in_array($vv["m_url"]."-sel", $powerArr))
                        {
                            $v['child'][]=$vv;
                        }

                    }
                }
                if( ($v["m_parent_id"] == 0) && (isset($v["child"])) )
                {
                    $result[]=$v;
                }
            }unset($arrC);
            //var_dump($result);exit;
            return $result;

        }




    }


    if(!function_exists("mSubStr"))
    {
        /**
         * 截取字符串
         * @param $str
         * @param $length
         * @return string
         */
        function mSubStr($str, $length)
        {
            if($length < strlen($str))
            {
                for($i = 0; $i < $length-1; $i++)
                {
                    if(chr($str[$i]) > 128)//当大于128说明是中文的，要顺延
                    {
                        $i++;
                    }
                    $j = $i;
                }
                $str = substr($str, 0, $j);
            }
            return $str;
        }
    }


    if(!function_exists("writeLog"))
    {
        /**
         * 日常操作日志
         * @param string $l_info
         */
        function writeLog($l_info="")
        {
            $list["l_info"] = addslashes(trim($l_info));
            $list["l_type"] = "日常操作";
            $list["l_user"] = $_SESSION["u_name"];
            $list["l_time"] = date("Y-m-d H:i:s", time());
            include(APPPATH . "config/database.php");

            $link = mysqli_connect($db['acon']['hostname'],$db['acon']['username'],$db['acon']['password'],$db['acon']['database'])
            or die('mysql error:' . mysqli_errno());
            mysqli_query($link, 'set names utf8');

            $sql = 'insert into eload_sys_log (`l_time`, `l_user` , `l_type` , `l_info`) values("'.$list["l_time"].'" , "'.$list["l_user"].'", "'.$list["l_type"].'", "'.$list["l_info"].'")';

            mysqli_query($link, "$sql");

        }
    }