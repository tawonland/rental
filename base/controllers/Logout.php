<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends Auth_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        
        SessionManager::destroy();
        $this->session->sess_destroy();

        redirect();
    }
    
}