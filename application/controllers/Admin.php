<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            if($this->session->role !== 'admin'){
                show_404();
            } else {
                $this->load->model(array('user_model'));
                $this->load->helper(array('functions','menu'));
            }
        }

        public function index($from = 0)
        {
            $limit = 2;
            $result = $this->user_model->get_list($limit, $from);
            $data['users'] = $result['data'];
            $data['title'] = 'Usuarios';
            $data['menu'] = getMenu($this->session->role);
			$data['menu_active'] = 'Usuarios';

            #paginacion
            $this->load->library('pagination');

            $config['base_url'] = base_url('admin/index/');
            $config['total_rows'] = $result['count'];
            $config['per_page'] = $limit;

            $this->pagination->initialize($config);

            $data['pagination'] = $this->pagination->create_links(); 

            $this->load->view('templates/header', $data);
            $this->load->view('admin/user_list', $data);
            $this->load->view('templates/footer');
        }

        public function user_create()
        {
            $this->load->helper('form');
            $this->load->library('form_validation');
            
            $rules = array(
				array(
                    'field' => 'name',
                    'label' => 'Escuadron',
                    'rules' => 'required|trim|min_length[3]',
                    'errors' => array(
                        'required' => 'El %s es requerido.',
						'min_length' => 'El %s tiene que contener un minimo de 3 caracteres.'
                    )
                ),
                array(
                    'field' => 'nick',
                    'label' => 'Usuario',
                    'rules' => 'required|trim|min_length[3]',
                    'errors' => array(
                        'required' => 'El %s es requerido.',
						'min_length' => 'El %s tiene que contener un minimo de 3 caracteres.'
                    )
                ),
                array(
                    'field' => 'pass',
                    'label' => 'Contraseña',
                    'rules' => 'required|trim|min_length[3]',
                    'errors' => array(
                        'required' => 'La %s es requerida.',
						'min_length' => 'El %s tiene que contener un minimo de 3 caracteres.'
                    )
                )
            );

            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run() === FALSE)
            {
                $data['title'] = 'Nuevo Usuario';
                $data['menu'] = getMenu($this->session->role);
				$data['menu_active'] = 'Usuarios';
                $data['action'] = "admin/user_create";
                $this->load->view('templates/header', $data);
                $this->load->view('admin/user_form');
                $this->load->view('templates/footer');
            }
            else
            {
                $this->user_model->insert();
                redirect('admin');
            }
        }

        public function user_edit($id)
        {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('role', 'Rol', 'required');
            $this->form_validation->set_rules('name', 'Escuadron', 'required');
            $this->form_validation->set_rules('nick', 'Usuario', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                $data['title'] = "Editar Usuario";
                $data['menu'] = getMenu($this->session->role);	
				$data['menu_active'] = 'Usuarios';
                $data['action'] = "admin/user_edit/$id";
                $data['user'] = $this->user_model->get($id);
                $this->load->view('templates/header', $data);
                $this->load->view('admin/user_form');
                $this->load->view('templates/footer');

            }
            else
            {
                $this->user_model->update($id);
                redirect('admin');
            }
        }

        public function user_delete($id)
        {
            $this->user_model->delete($id);
            redirect('admin');
        }

}
