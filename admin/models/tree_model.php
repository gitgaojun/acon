<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tree_model extends CI_Model{
    
    function __construct(){
        parent::__construct();
        $_db = $this->load->database("join");
    }


    public function getTreeList()
    {
        $result = array('status'=>false, 'code'=>'00001', "data"=>array());
        $treeList = $this->_db->query("select * from t_area");
        var_dump($treeList);exit;
    }
    
}