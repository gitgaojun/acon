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
            $arr = $result;unset($result);
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