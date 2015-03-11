<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    if( ! function_exists('json'))
    {
        /**
         * 封装json_encode函数，设置默认对中文不转码
         * @param array $arr
         * @param string $type
         * @throws 如果数组是空的，那么抛出一个异常
         */
        function json($arr=[],$type=false)
        {
            function emptyarr($x)
            {
                if(!empty($x)) throw new Exception('数组是个空的数组');
            }
            try {
                emptyarr($arr);    
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            if($type===false){
                return json_encode($arr,JSON_UNESCAPED_UNICODE);
            }else{
                return json_encode($arr,$type);
            }
        }
    }
