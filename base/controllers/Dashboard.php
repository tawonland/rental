<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Dany_Controller
{
    public function index()
    {
        $tema['title'] = 'Dashboard';
        $tema['tema'] = 'dashboard/index';
        $this->load->view('backend/theme', $tema);
    }
}
