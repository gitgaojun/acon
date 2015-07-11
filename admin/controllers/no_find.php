<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/4/9
 * Time: 16:11
 */

    class no_find extends AD_Controller
    {
        function __construct()
        {
            parent::__construct();
        }

        public function index()
        {

            $this->load->view("no_find");
        }
    }