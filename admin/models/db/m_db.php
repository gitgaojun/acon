<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class m_db extends CI_Model
    {
        private $_db;
        
        function __construct()
        {
            $this->load->database();
        }


    }