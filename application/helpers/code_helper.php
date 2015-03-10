<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


    class imageCode
    {
        private $imageWidth;
        private $imageHeight;
        private $backgroundColor;
        private $textColor;
        private $arcColor;
        private $textContent;

        public function set($imageWidth,$imageHeight){
            $this->imageWidth = $imageWidth;
            $this->imageHeight = $imageHeight;


        }

        public function getCodeImage(){
            header('Content-type:image/png');
            $im = imagecreate($this->imageWidth,$this->imageHeight) or die('image create filed');
            $this->backgroundColor=imagecoloralloatc($im,255,255,255);
            $this->textColor=imagecoloralloatc($im,rand(0,155),rand(0,155),rand(0,155));
            $this->ovalColor=imagecoloralloatc($im,rand(0,155),rand(0,155),rand(0,155));
            $textList= '0123456789abcdefjhijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            imagefilledarc($im,rand(0,$this->imageWidth),rand(0,$this->imageHeight),rand($this->imageWidth/5,$this->imageHeight/2),rand($this->imageHeight*2,$this->imageHeight*3),$this->arcColor,IMG_ARC_PIE );
            for($i=1;$i<5;$i++){
                $this->textContent[$i]=substr(rand(0,61),1);
            }
            for($i=1;$i<5;$i++){
                imagettftext($im,rand(6,12),rand(-30,30),$i*$this->imageWidth-6,2*$this->imageHeight,$this->textContent[$i],$this->textColor);
            }
            $image = imagepng($im);
            imagedestory($im);

            return $image;

        }


    }
