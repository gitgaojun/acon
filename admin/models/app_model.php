<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app_model extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }
    
    public function getLogoImage(){
        $this->load->helper('logo_helper');
        
    }
    
}