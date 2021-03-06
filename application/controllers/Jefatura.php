<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jefatura extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$role = $this->session->role;
		if($role !== 'jefatura'){
			show_404();
		} else {
			$this->load->model(array('orden_model', 'user_model'));
			$this->load->helper(array('menu', 'functions'));
		}
	}

    public function index($from = 0)
	{
		$limit = 2;
		$result = $this->orden_model->get_list($limit, $from);
		$data['orders'] = $result['data'];
		$data['title'] = 'Lista Ordenes';
		$data['menu'] = getMenu($this->session->role);
		$data['menu_active'] = 'Ordenes';

		#paginacion
		$this->load->library('pagination');

		$config['base_url'] = base_url('jefatura/index/');
		$config['total_rows'] = $result['count'];
		$config['per_page'] = $limit;

		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links(); 

		$this->load->view('templates/header', $data);
		$this->load->view('jefatura/orden_list', $data);
		$this->load->view('templates/footer');
	}

   

	public function order_create()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('tipo', 'Tipo', 'required');
		$this->form_validation->set_rules('fecha', 'Fecha', 'required');
		$this->form_validation->set_rules('numero', 'Numero', 'required');
		$this->form_validation->set_rules('tema', 'Tema', 'required');
		//$this->form_validation->set_rules('file', 'File', 'required');

		if ($this->form_validation->run() === FALSE)
		{

			$data['title'] = 'Nueva Orden';
			$data['menu'] = getMenu($this->session->role);
			$data['menu_active'] = 'Ordenes';
			$data['action'] = "jefatura/order_create";
			$this->load->view('templates/header', $data);
			$this->load->view('jefatura/orden_form');
			$this->load->view('templates/footer');

		}
		else
		{
			$tipo = $this->input->post('tipo');
			$fecha = $this->input->post('fecha');
			$numero = $this->input->post('numero');
			$tema = $this->input->post('tema');
			$year = date("y", strtotime($fecha)); 
			
			$nombre = $tipo.'_'.$year.'_'.$numero;
			$archivo = $nombre.'.pdf';
			
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'pdf';
			$config['max_size']             = 10240;//archivo tama??o maximo 10mb
			$config['file_name'] = $nombre;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('file'))
			{
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('jefatura/orden_form', $error);
			}
			else
			{
				
				$upload_data = $this->upload->data();
				$data = array('type' => $tipo, 'date' => $fecha, 'number' => $numero, 'year' => $year, 'about' => $tema,'file' => $archivo);
				$this->orden_model->insert($data);
				redirect('jefatura/');
			}
			
		}
	}
	
	public function order_edit($id)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('tipo', 'Tipo', 'required');
		$this->form_validation->set_rules('fecha', 'Fecha', 'required');
		$this->form_validation->set_rules('numero', 'Numero', 'required');
		$this->form_validation->set_rules('tema', 'Tema', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$data['title'] = "Editar Orden";
			$data['menu'] = getMenu($this->session->role);	
			$data['menu_active'] = 'Ordenes';
			$data['action'] = "jefatura/order_edit/$id";
			$data['order'] = $this->orden_model->get($id);
			$this->load->view('templates/header', $data);
			$this->load->view('jefatura/orden_form');
			$this->load->view('templates/footer');

		}
		else
		{
			$tipo = $this->input->post('tipo');
			$fecha = $this->input->post('fecha');
			$numero = $this->input->post('numero');
			$tema = $this->input->post('tema');
			$year = date("y", strtotime($fecha)); 
			
			$nombre = $tipo.'_'.$year.'_'.$numero;
			$archivo = $nombre.'.pdf';
			
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'pdf';
			$config['max_size']             = 10240;//archivo tama??o maximo 10mb
			$config['file_name'] = $nombre;

			$this->load->library('upload', $config);
			
			$archivo_anterior = $this->orden_model->get_file($id);
			if(!unlink('./uploads/'.$archivo_anterior)){	
				echo "No se pudo actualizar el archivo";
				exit();
			}

			if ( ! $this->upload->do_upload('file'))
			{
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('orden_form', $error);
			}
			else
			{
				$upload_data = $this->upload->data();
				$data = array('date' => $fecha,'number' => $numero, 'year' => $year, 'about' => $tema,'file' => $archivo);
				$this->orden_model->update($id,$data);
				redirect('jefatura/');
			}
		}
	}

	public function order_delete($id)
	{
		$order = $this->orden_model->get($id);
		$archivo = $order['file'];
		if(unlink('./uploads/'.$archivo)){	
			$this->orden_model->delete($id);
		} else {
			echo "No se pudo borrar el archivo";
			exit();
		}
		redirect('jefatura/');
	}
}