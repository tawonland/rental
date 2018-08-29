<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Dany_Controller
{
    public function __construct()
    {
        parent::__construct();

        error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
    }
    
    public function index()
    {

        $this->load->library('SessionManager');

        $this->check_session();

        $tema['title'] = 'Login';
        $tema['tema'] = 'loginv4/index';
        $this->load->view('frontend/theme',$tema);
    }

    function check_session()
    {
        //$sessions = $this->session->userdata();

        $isAuthenticated = SessionManager::isAuthenticated();
        $username = SessionManager::getUserName();
        
        if($isAuthenticated AND isset($username))
        {
            redirect('dashboard');
        }
    }

    function ceklogin()
    {
        
        if($this->validasi() === FALSE)
        {
            $this->session->set_flashdata('error', 'Login Gagal');
            redirect();
        }

        $this->load->model('Tlogin_model');

        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        $resolve = $this->_resolve_user_login($username, $password);

        if($resolve === FALSE){
            $this->session->set_flashdata('error', 'Username atau password salah');
            redirect();
        }

        $this->load->library('SessionManager');
        $index = SessionManager::INDEX;

        $user = $this->Tlogin_model->get_user($username);

        $create_session = array();
        $create_session[$index]['auth']['isauthenticated'] = TRUE;
        $create_session[$index]['auth']['username'] = $user->uname;
        $create_session[$index]['auth']['level']    = $user->level;


        $this->session->set_userdata($create_session);

        redirect('dashboard');


    }

    private function validasi($aneh = false)
    {
        
        $error = array(
            'required'      => 'Input %s tidak boleh kosong'
        );

        $this->form_validation->set_rules('username', 'Username', 'required', $error);
        $this->form_validation->set_rules('password', 'Password', 'required', $error);
        
        return $this->form_validation->run(); 
    }

    private function _resolve_user_login($username, $password)
    {
        $this->db->where('uname', $username);
        $hash = $this->db->get('tlogin')->row('pwd');

        return $this->_verify_password_hash($password,$hash);
    }

    private function _verify_password_hash($password, $hash)
    {
        return password_verify($password, $hash);
    }

}
