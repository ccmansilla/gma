<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent ::__construct();
        $this->load->model(array('user_model'));
        $this->load->helper('form');
        $this->load->library('form_validation', 'session');
    }

    public function index() {
        $this->load->view('login_form');
    }

    public function login() {
        $rules = array(
            array(
                'field' => 'nick',
                'label' => 'Usuario',
                'rules' => 'required|trim|min_length[3]',
                'errors' => array(
                    'required' => '%s requerido.'
                )
            ),
            array(
                'field' => 'pass',
                'label' => 'Contraseña',
                'rules' => 'required|trim|min_length[3]',
                'errors' => array(
                    'required' => '%s requerida.'
                )
            )
        );
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run() === FALSE){
            $this->load->view('login_form');
        } else {
            $nick = $this->input->post('nick', TRUE);
            $pass = $this->input->post('pass', TRUE);
            $user = $this->user_model->login($nick, $pass);
            if($user !== ''){
                $newdata = array(
                    'id_user' => $user->id,
					'name'  => $user->name,
                    'nick'  => $nick,
                    'role'  => $user->role,
                    'logged_in' => TRUE
                );                
                $this->session->set_userdata($newdata);
                if($user->role === 'admin'){
                    redirect('/admin');
                } elseif($user->role === 'jefatura') {
                    redirect('/jefatura');
                } elseif($user->role === 'dependencia'){
                    redirect('/dependencia');
                } else {
                    show_404();
                }
                
            } else {
                $data['nick'] = $nick;
                $data['pass'] = $pass;
                $data['msg'] = "Usuario o contraseña incorrecta!";
                $this->load->view('login_form', $data);
            }
        }
    }

    public function logout(){
        $this->session->unset_userdata(['id_user', 'num_taller', 'nick', 'rol', 'logged_in']);
        redirect('/');
    }

}