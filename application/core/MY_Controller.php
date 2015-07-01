<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/4/17
 * Time: 9:29
 */


    class MY_Controller extends CI_Controller
    {

        function __construct(){
            parent::__construct();
            header('Content-type:text/html;charset:utf-8;');
            $this->getCateList();

            //json返回数据的原型,默认为真
            $this->result=array('status'=>true,'message'=>'','data'=>array());

            /*var_dump($this->router->fetch_directory());
            var_dump($this->router->fetch_class());
            var_dump($this->router->fetch_method());exit;*/



        }

        protected function getCateList()
        {
            include(APPPATH . "config/database.php");

            $link = mysqli_connect($db['acon']['hostname'],$db['acon']['username'],$db['acon']['password'],$db['acon']['database'])
            or die('mysql error:' . mysqli_connect_error());
            mysqli_query($link, 'set names utf8');

            $sql = 'select * from category where 1 order by c_id';
            $result = mysqli_query($link, "$sql") or printf("Errorcode: %d\n", mysqli_errno($link));
            if($result){
                while($row = $result->fetch_assoc()){
                    $result_arr[] = $row;
                }
            }
            $data["cateList"] = $result_arr;
            mysqli_close($link);
            $this->load->vars($data);
        }

    }
