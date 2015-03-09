<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


    if(!function_exists('getCodeImage')){

        /**
         * 创建验证码类
         *
         */
        function getCodeImage()
        {
            header('Content-type:image/png');
            $imageWidth = 200;$imageHeight = 50;
            $codeList = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $im = @imagecreate($imageWidth,$imageHeight)
            or die("创建图像失败");
            $backgroundColor = imagecolorallocate($im,255,255,255);
            $filledarcColor = imagecolorallocate($im,rand(155,255),rand(155,255),rand(155,255));
            $textColor = imagecolorallocate($im,rand(0,155),rand(0,155),rand(0,155));
            for($i=1;$i<5;$i++){
                $textContent[$i]=substr($codeList,rand(0,61),1);

            }
            $j=2;
            while($j>0){
                imagefilledarc($im,rand(0,$imageWidth),rand(0,$imageHeight),rand($imageWidth/5,$imageWidth/3),rand($imageHeight*2,$imageHeight*3),
                rand(0,30),rand(0,30),$filledarcColor,IMG_ARC_PIE);
                $j--;
            }
            for($i=1;$i<5;$i++){
                imagettftext($im,rand(20,30),rand(-30,30),$i*$imageWidth/5-4,3*$imageHeight/4,$textColor,'BigCrump.ttf',$textContent[$i]);
            }


            $code['image'] = imagepng($im);//图像
            $code['text'] = $textContent;//code
            imagedestory($im);
            return $code;
        }
    }