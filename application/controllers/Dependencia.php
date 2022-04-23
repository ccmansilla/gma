<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dependencia extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$role = $this->session->role;
		if($role !== 'dependencia'){
			show_404();
		} else {
			$this->load->model(array('orden_model', 'view_model', 'volante_model', 'user_model'));
			$this->load->helper(array('menu','functions'));
		}
	}

	public function index($type = 'od', $from = 0){
		$this->load->helper('form');
		
		$type = ($this->input->post('tipo') != null)? $this->input->post('tipo') : $type;
		$data['type'] = $type;
		$data['from'] = $from;
		$data['action'] = base_url(). 'dependencia/index/';
		$where = "type = '$type'";
		$limit = 10;
		$id_user = $this->session->id_user;
		$result = $this->orden_model->get_list_views_user($id_user, $limit, $from, $where);
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

	public function view($type = 'od', $from = 0){
		$this->load->helper('form');
		$id_user = $this->session->id_user;
		$this->view_model->insert($id_user);
		redirect("dependencia/index/$type/$from");
	}

	public function volante_enviados($from = 0)
	{
		$limit = 10;
		$data['from'] = $from;
		$id_user = $this->session->id_user;
		$result = $this->volante_model->get_list_enviados($id_user, $limit, $from);
		$data['volantes'] = $result['data'];
		$data['title'] = 'Lista Volantes Enviados';
		$data['menu'] = getMenu($this->session->role);
		$data['menu_active'] = 'Volantes';
		$data['new_url'] = base_url('dependencia/volante_create');

		#paginacion
		$this->load->library('pagination');

		$config['base_url'] = base_url('jefatura/volante_enviados/');
		$config['total_rows'] = $result['count'];
		$config['per_page'] = $limit;

		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links(); 

		$this->load->view('templates/header', $data);
		$this->load->view('volante/volante_enviados', $data);
		$this->load->view('templates/footer');
	}

	public function volante_recibidos($from = 0)
	{
		$limit = 10;
		$data['from'] = $from;
		$id_user = $this->session->id_user;
		$result = $this->volante_model->get_list_recibidos($id_user, $limit, $from);
		$data['volantes'] = $result['data'];
		$data['title'] = 'Lista Volantes Recibidos';
		$data['menu'] = getMenu($this->session->role);
		$data['menu_active'] = 'Volantes';

		#paginacion
		$this->load->library('pagination');

		$config['base_url'] = base_url('dependencia/volante_recibidos/');
		$config['total_rows'] = $result['count'];
		$config['per_page'] = $limit;

		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links(); 

		$this->load->view('templates/header', $data);
		$this->load->view('volante/volante_recibidos', $data);
		$this->load->view('templates/footer');
	}

	public function volante_create(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fecha', 'Fecha', 'required');
		$this->form_validation->set_rules('numero', 'Numero', 'required');
		$this->form_validation->set_rules('year', 'Año', 'required');
		$this->form_validation->set_rules('asunto', 'Asunto', 'required');
		$this->form_validation->set_rules('destino', 'Destino', 'required');
		//$this->form_validation->set_rules('file', 'File', 'required');
		if ($this->form_validation->run() === FALSE)
		{

			$data['title'] = 'Nuevo Volante Enviado';
			$data['menu'] = getMenu($this->session->role);
			$data['menu_active'] = 'Volantes';
			$data['action'] = "dependencia/volante_create";
			$data['destinos'] = simple_to_associative($this->user_model->get_list_basic($this->session->id_user));

			$this->load->view('templates/header', $data);
			$this->load->view('volante/volante_form', $data);
			$this->load->view('templates/footer');

		}
		else
		{
			$fecha = $this->input->post('fecha');
			$numero = $this->input->post('numero');
			$year = date("y", strtotime($fecha)); 

			$asunto = $this->input->post('asunto');

			$id_user_origen = $this->session->id_user;
			$id_user_destino = $this->input->post('destino');
			
			$nombre = 'vol_'.$id_user_origen.'_'.$year.'_'.$numero;
			$archivo = $nombre.'.pdf';
			
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'pdf';
			$config['max_size']             = 10240;//archivo tamaño maximo 10mb
			$config['file_name'] = $nombre;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('file'))
			{
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('dependencia/volante_form', $error);
			}
			else
			{
				
				$upload_data = $this->upload->data();
				$data = array('fecha' => $fecha, 'numero' => $numero, 'year' => $year, 'asunto' => $asunto,
								'enlace_archivo' => $archivo, 'id_user_origen' => $id_user_origen, 
								'id_user_destino' => $id_user_destino);
				$this->volante_model->insert($data);
				redirect('dependencia/volante_enviados');
			}
			
		}
	}

	public function volante_delete($id)
	{
		$volante = $this->volante_model->get($id);
		$archivo = $volante['enlace_archivo'];
		if(unlink('./uploads/'.$archivo)){	
			$this->volante_model->delete($id);
		} else {
			echo "No se pudo borrar el archivo";
			exit();
		}
		redirect('dependencia/volante_enviados');
	}

}
