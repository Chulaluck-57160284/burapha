<?php

class Member extends CI_Controller {
    public function login()
    {
        $data['status'] = $this->input->get('status');
        $this->load->view('login/login_view.php', $data);
    }

    public function post_login() 
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');


        $this->ldap->connect();
        if($this->ldap->authenticate('' , $username, $password)) {
            $userdata = $this->ldap->get_data($username,$password);
            $this->session->set_userdata('username', $username);

            echo 'success';
        } else {
            echo 'error';
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('member/login');
    }
}