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
			$this->load->model(array('orden_model', 'user_model', 'view_model', 'volante_model'));
			$this->load->helper(array('menu', 'functions'));
		}
	}

    public function index($type = 'od', $from = 0)
	{
		$limit = 10;
		$data['type'] = $type;
		$data['from'] = $from;
		$where = "type = '$type'";
		$result = $this->orden_model->get_list($limit, $from, $where);
		$data['orders'] = $result['data'];		
		$data['title'] = 'Ordenes del Día';
		if($type == 'og'){
			$data['title'] = 'Ordenes de Guarnicion';
		} else {
			if($type == 'or'){
				$data['title'] = 'Ordenes Reservada';
			}
		}
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
			$config['max_size']             = 10240;//archivo tamaño maximo 10mb
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
			$config['max_size']             = 10240;//archivo tamaño maximo 10mb
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

	public function order_views($id_order){
		$users = $this->view_model->get_list_users($id_order);
		$this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($users));
	}

	public function volante_enviados($from = 0)
	{
		$limit = 10;
		$data['from'] = $from;
		$id_user = $this->session->id_user;
		$result = $this->volante_model->get_list_enviados($id_user, $limit, $from);
		$data['volantes'] = $result['data'];
		$data['title'] = 'Volantes Enviados';
		$data['menu'] = getMenu($this->session->role);
		$data['menu_active'] = 'Volantes';

		#url
		$data['new_url'] = base_url('jefatura/volante_create');
		$data['edit_url'] = base_url('jefatura/volante_edit/');
		$data['del_url'] = base_url('jefatura/volante_delete/');

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
		$data['title'] = 'Volantes Recibidos';
		$data['menu'] = getMenu($this->session->role);
		$data['menu_active'] = 'Volantes';

		#paginacion
		$this->load->library('pagination');

		#visto
		$this->load->helper('form');
		$data['action'] = 'jefatura/volante_view';

		$config['base_url'] = base_url('jefatura/volante_recibidos/');
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
		$this->form_validation->set_rules('asunto', 'Asunto', 'required');
		$this->form_validation->set_rules('destino', 'Destino', 'required');
		//$this->form_validation->set_rules('file', 'File', 'required');
		if ($this->form_validation->run() === FALSE)
		{

			$data['title'] = 'Nuevo Volante Enviado';
			$data['menu'] = getMenu($this->session->role);
			$data['menu_active'] = 'Volantes';
			$data['action'] = "jefatura/volante_create";
			$data['fecha'] = date('Y-m-d');
			$data['numero'] = $this->volante_model->next_number($this->session->id_user);
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
				$this->load->view('jefatura/volante_form', $error);
			}
			else
			{
				
				$upload_data = $this->upload->data();
				$data = array('fecha' => $fecha, 'numero' => $numero, 'year' => $year, 'asunto' => $asunto,
								'enlace_archivo' => $archivo, 'id_user_origen' => $id_user_origen, 
								'id_user_destino' => $id_user_destino);
				$this->volante_model->insert($data);
				redirect('jefatura/volante_enviados');
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
		redirect('jefatura/volante_enviados');
	}

	public function volante_view($from = 0){
		$this->load->helper('form');
		$this->volante_model->set_view();
		redirect("jefatura/volante_recibidos");
	}
}
