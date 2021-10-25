<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dependencia extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$role = $this->session->role;
		if($role !== 'dependencia'){
			show_404();
		} else {
			$this->load->model(array('orden_model'));
			$this->load->helper(array('menu','functions'));
		}
	}

	public function index($type = 'od', $from = 0){
		$this->load->helper('form');
		
		$type = ($this->input->post('tipo') != null)? $this->input->post('tipo') : $type;
		$data['type'] = $type;
		$data['action'] = base_url(). 'dependencia/index/';
		$where = "type = '$type'";
		$limit = 2;
		$user = $this->session->id_user;
		$result = $this->orden_model->get_list($limit, $from, $where);
		$data['orders'] = $result['data'];
		$data['title'] = 'Lista Ordenes';
		$data['menu'] = getMenu($this->session->role);
		$data['menu_active'] = 'Ordenes';

		#paginacion
		$this->load->library('pagination');

		$config['base_url'] = base_url() . "dependencia/index/$type/";
		$config['total_rows'] = $result['count'];
		$config['per_page'] = $limit;

		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('templates/header', $data);
		$this->load->view('dependencia/orden_list', $data);
		$this->load->view('templates/footer');
	}

}