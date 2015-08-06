<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: jun90610@gmail.com
 * Date: 2015/7/31
 * Time: 14:48
 */

class tree extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {

        $this->load->view('tree');
    }

    /**
     * 返回树形菜单
     * @author jun
     * @time 2015-7-31
     * @return json
     */
    function tree()
    {
        $this->load->model("tree_model");
        $tree = $this->tree_model->getTreeList();
        exit(json_encode($tree));
    }


}