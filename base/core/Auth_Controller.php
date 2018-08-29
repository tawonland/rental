<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_Controller extends Dany_Controller
{
    public $data    = array();
    public $c_edit  = FALSE;

    public function __construct()
    {
        parent::__construct();
        
        $this->load->library('SessionManager');

        $this->check_session();

        $this->data['c_edit'] = $this->c_edit;
        $this->data['tema']   = 'inc_content_v';
    }

    function check_session()
    {
    	//$sessions = $this->session->userdata();

        $isAuthenticated = SessionManager::isAuthenticated();
        $username = SessionManager::getUserName();
        
        if(!$isAuthenticated AND !isset($username))
    	{
    		redirect();
    	}
    }
}
