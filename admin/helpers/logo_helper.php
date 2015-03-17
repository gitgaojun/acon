<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    if(!function_exists("createLogo")){
        
        
        /**
         * 创建logo
         * @param 宽度                        int     $imageWidth
         * @param 长度                        int     $imageHeight
         * @param 网站英文名             string  $text
         */
        function createLogo($imageWidth,$imageHeight,$text){
            header("Content-type:image/png");
            $im = @imagecreate($imageWidth,$imageHeight) 
            or die('获取logo失败');
            $backgroundColor = imagecolorallocate($im,rand(125,255),rand(125,255),rand(125,255));
            $textColor = imagecolorallocate($im,rand(0,125),rand(0,125),rand(0,125));
            
            for($i=0;$i<strlen($text);$i++){
                imagettftext($im,rand(20,30),rand(-30,30),$i*$imageWidth/5+25,3*$imageHeight/4,$textColor,'define/font/ELEPHNT.TTF',$text[$i]);
            }
            imagepng($im);
            imagedestroy($im);
            
        }
    } 

