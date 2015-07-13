<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/4/16
 * Time: 17:57
 */

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
