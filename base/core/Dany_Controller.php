<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dany_Controller extends CI_Controller
{
    public $data    = array();
    public $c_edit  = FALSE;

    public function __construct()
    {
        parent::__construct();

        $this->data['method'] = $this->router->fetch_method();
        $this->data['c_edit'] = $this->c_edit;
        $this->data['tema']   = 'inc_content_v';
    }

    public function set_flashdata($data, $value)
    {
    	return $this->session->set_flashdata($data, $value);
    }
}
