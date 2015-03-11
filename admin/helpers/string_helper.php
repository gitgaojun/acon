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
            try {
                if(empty($arr)) {
                    $debugStr = '数组是个空的数组,<br>';
                    $debugList = debug_backtrace();//用来追踪文件位置
                    //print_r($debugList);exit;
                    $debugStr .= '<stong style="color:red">文件错误位置'.$debugList[0]['file'].":".
                                $debugList[0]['line']."&nbsp;&nbsp;&nbsp;&nbsp;"."调用函数:".$debugList[0]['function']."报错".
                                '</stong><br><br>';
                    throw new Exception($debugStr);   
                }
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
