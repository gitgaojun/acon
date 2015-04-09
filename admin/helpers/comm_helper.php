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
            session_start();
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