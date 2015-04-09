<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/4/9
 * Time: 13:52
 */

    if(!function_exists("createSysCache"))
    {
        /**
         * 创建后台系统缓存文件
         */
        function createSysCache()
        {

            global $sysCacheName;

            if(!is_dir(dirname($sysCacheName["sys_menu"])) || !file_exists($sysCacheName["sys_menu"]))
            {
                createMenuListFile($sysCacheName["sys_menu"]);
            }

            if(!is_dir(dirname($sysCacheName["sys_group"])) || !file_exists($sysCacheName["sys_group"]))
            {
                createGroupListFile($sysCacheName["sys_group"]);
            }

        }
    }

    if( !function_exists("createMenuListFile") )
    {
        /**
         * 后台菜单缓存列表
         * @param $cacheFile 文件名
         */
        function createMenuListFile($cacheFile)
        {
            include(APPPATH . "config/database.php");

            $link = mysqli_connect($db['acon']['hostname'],$db['acon']['username'],$db['acon']['password'],$db['acon']['database'])
             or die('mysql error:' . mysqli_errno());
            mysqli_query($link, 'set names utf8');

            $sql = 'select * from eload_sys_menu where 1 order by m_id';
            $result = mysqli_query($link, "$sql");
            if($result){
                while($row = $result->fetch_assoc()){
                    $result_arr[] = $row;
                }
            }
            $fileContent = "<?php "."\n";
            $fileContent .= "//".date("Y-m-d H:i:s", time()) . "\n";
            $fileContent .= "\$result=";
            $fileContent .= var_export($result_arr, true);
            $fileContent .= ";";
            if (!is_dir($dir = dirname($cacheFile))) {
                mkdir($dir, 0755, true);
            }
            file_put_contents($cacheFile, $fileContent, LOCK_EX);

        }
    }

    if( !function_exists("createGroupListFile") )
    {
        /**
         * 后台系统组缓存列表
         * @param $cacheFile 文件名
         */
        function createGroupListFile($cacheFile)
        {
            include(APPPATH . "config/database.php");

            $link = mysqli_connect($db['acon']['hostname'],$db['acon']['username'],$db['acon']['password'],$db['acon']['database'])
            or die('mysql error:' . mysqli_errno());
            mysqli_query($link, 'set names utf8');

            $sql = 'select * from eload_sys_group where 1 order by g_id';
            $result = mysqli_query($link, "$sql");
            if($result){
                while($row = $result->fetch_assoc()){
                    $result_arr[] = $row;
                }
            }
            $fileContent = "<?php "."\n";
            $fileContent .= "//".date("Y-m-d H:i:s", time()) . "\n";
            $fileContent .= "\$result=";
            $fileContent .= var_export($result_arr, true);
            $fileContent .= ";";
            if (!is_dir($dir = dirname($cacheFile))) {
                mkdir($dir, 0755, true);
            }
            file_put_contents($cacheFile, $fileContent, LOCK_EX);
        }
    }

