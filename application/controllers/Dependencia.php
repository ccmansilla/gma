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
		#filtros
		$fnumero = $this->input->get('numero');
		$fyear = $this->input->get('year');
		$fasunto = $this->input->get('asunto');

		if($fnumero != ''){
			$where .= " AND number = $fnumero";
		}
		if($fyear != ''){
			$where .= " AND year = $fyear";
		}
		if($fasunto != ''){
			$where .= " AND about LIKE '%$fasunto%'";
		}

		$data['fnumero'] = $fnumero;
		$data['fyear'] = $fyear;
		$data['fasunto'] = $fasunto;

		$limit = 10;
		$id_user = $this->session->id_user;
		$result = $this->orden_model->get_list_views_user($id_user, $limit, $from, $where);
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

		$config['base_url'] = base_url() . "dependencia/index/$type/";
		$config['total_rows'] = $result['count'];
		$config['per_page'] = $limit;
		#pega la busqueda
		$config['reuse_query_string'] = TRUE;

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
		#filtros
		$fnumero = $this->input->get('numero');
		$fyear = $this->input->get('year');
		$fasunto = $this->input->get('asunto');

		$where = '';
		if($fnumero != ''){
			$where = " numero = $fnumero";
		}
		if($fyear != ''){
			if($where != ''){
				$where .= " AND";
			}
			$where .= " year = $fyear";
		}
		if($fasunto != ''){
			if($where != ''){
				$where .= " AND";
			}
			$where .= " asunto LIKE '%$fasunto%'";
		}

		$data['fnumero'] = $fnumero;
		$data['fyear'] = $fyear;
		$data['fasunto'] = $fasunto;

		$result = $this->volante_model->get_list_enviados($id_user, $limit, $from);
		$data['volantes'] = $result['data'];
		$data['title'] = 'Volantes Enviados';
		$data['menu'] = getMenu($this->session->role);
		$data['menu_active'] = 'Volantes';

		#url
		$data['new_url'] = base_url('dependencia/volante_create');
		$data['edit_url'] = base_url('dependencia/volante_edit/');
		$data['del_url'] = base_url('dependencia/volante_delete/');

		#paginacion
		$this->load->library('pagination');

		$config['base_url'] = base_url('jefatura/volante_enviados/');
		$config['total_rows'] = $result['count'];
		$config['per_page'] = $limit;
		#pega la busqueda
		$config['reuse_query_string'] = TRUE;

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
		#filtros
		$fnumero = $this->input->get('numero');
		$fyear = $this->input->get('year');
		$fasunto = $this->input->get('asunto');

		$where = '';
		if($fnumero != ''){
			$where = " numero = $fnumero";
		}
		if($fyear != ''){
			if($where != ''){
				$where .= " AND";
			}
			$where .= " year = $fyear";
		}
		if($fasunto != ''){
			if($where != ''){
				$where .= " AND";
			}
			$where .= " asunto LIKE '%$fasunto%'";
		}

		$data['fnumero'] = $fnumero;
		$data['fyear'] = $fyear;
		$data['fasunto'] = $fasunto;

		$result = $this->volante_model->get_list_recibidos($id_user, $limit, $from, $where);
		$data['volantes'] = $result['data'];
		$data['title'] = 'Volantes Recibidos';
		$data['menu'] = getMenu($this->session->role);
		$data['menu_active'] = 'Volantes';

		#paginacion
		$this->load->library('pagination');

		#visto
		$this->load->helper('form');
		$data['action'] = 'dependencia/volante_view';

		$config['base_url'] = base_url('dependencia/volante_recibidos/');
		$config['total_rows'] = $result['count'];
		$config['per_page'] = $limit;
		#pega la busqueda
		$config['reuse_query_string'] = TRUE;

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
			$data['action'] = "dependencia/volante_create";
			$data['fecha'] = date('Y-m-d');
			$data['numero'] = $this->volante_model->next_number($this->session->id_user);
			$data['destinos'] = simple_to_associative($this->user_model->get_list_basic($this->session->id_user));
			$data['destino'] = '';

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
			
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'pdf|docx|xlsx|zip';
			$config['max_size']             = 10240;//archivo tamaño maximo 10mb
			$config['file_name'] = 'adj_'.$nombre;

			$adjunto = '';
			$archivo = '';

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('adjunto')){
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('volante/volante_form', $error);
			} else {
				$adjunto = $this->upload->data('file_name');
			}

			$config['file_name'] = $nombre;
			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('file')){
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('volante/volante_form', $error);
			}
			else
			{
				$archivo = $this->upload->data('file_name');
				$data = array('fecha' => $fecha, 'numero' => $numero, 'year' => $year, 'asunto' => $asunto,
								'enlace_archivo' => $archivo, 'enlace_adjunto' => $adjunto, 
								'id_user_origen' => $id_user_origen, 'id_user_destino' => $id_user_destino);
				$this->volante_model->insert($data);
				redirect('dependencia/volante_enviados');
			}			
		}
	}

	
	public function volante_edit($id){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fecha', 'Fecha', 'required');
		$this->form_validation->set_rules('numero', 'Numero', 'required');
		$this->form_validation->set_rules('asunto', 'Asunto', 'required');
		$this->form_validation->set_rules('destino', 'Destino', 'required');

		if ($this->form_validation->run() === FALSE){
			$data['title'] = 'Editar Volante Enviado';
			$data['menu'] = getMenu($this->session->role);
			$data['menu_active'] = 'Volantes';
			$data['action'] = "dependencia/volante_edit/$id";
			$data['destinos'] = simple_to_associative($this->user_model->get_list_basic($this->session->id_user));
			#buscar los datos del volante
			$volante = $this->volante_model->get($id);
			$data['fecha'] = $volante['fecha'];
			$data['numero'] = $volante['numero'];
			$data['destino'] = $volante['id_user_destino'];
			$data['asunto'] = $volante['asunto'];

			$this->load->view('templates/header', $data);
			$this->load->view('volante/volante_form', $data);
			$this->load->view('templates/footer');

		} else {
			
			$fecha = $this->input->post('fecha');
			$numero = $this->input->post('numero');
			$year = date("y", strtotime($fecha));
			$asunto = $this->input->post('asunto');

			$id_user_origen = $this->session->id_user;
			$id_user_destino = $this->input->post('destino');
			
			$nombre = 'vol_'.$id_user_origen.'_'.$year.'_'.$numero;
			$archivo = $nombre.'.pdf';

			$volante = $this->volante_model->get($id);
			$adjunto_anterior = $volante['enlace_adjunto'];
			$archivo_anterior = $volante['enlace_archivo'];

			$ext_archivo = explode(".", $archivo_anterior);
			$ext_archivo = $ext_archivo[1];
			
			$ext_adjunto = '';
			if($adjunto_anterior != ''){
				$ext_adjunto = explode(".", $adjunto_anterior);
				$ext_adjunto = $ext_adjunto[1];
			}

			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'pdf|docx|xlsx|zip';
			$config['max_size']             = 10240;//archivo tamaño maximo 10mb
			$config['file_name'] = 'adj_'.$nombre;

			$archivo = $nombre.'.'.$ext_archivo;
			$adjunto = 'adj_'.$nombre.'.'.$ext_adjunto;

			$this->load->library('upload', $config);
			if (!empty($_FILES['adjunto']['name'])) {		
				if($adjunto_anterior != ''){
					if(!unlink('./uploads/'.$adjunto_anterior)){	
						echo "No se pudo actualizar el archivo ".$adjunto_anterior;
						exit();
					}
				}		

				if (!$this->upload->do_upload('adjunto'))
				{
					$error = array('error' => $this->upload->display_errors());
					$this->load->view('volante/volante_form', $error);
				}
				else
				{
					$adjunto = $this->upload->data('file_name');
				}
			} else {
				if($adjunto_anterior != ''){
					$enlace_adjunto_anterior = './uploads/'.$adjunto_anterior;
					$enlace_adjunto = './uploads/'.$adjunto;
					if(!rename($enlace_adjunto_anterior, $enlace_adjunto)){
						echo "Error no se pudo renombrar archivo ".$enlace_adjunto_anterior." por ".$enlace_adjunto;
						exit();
					}
				} else {
					$adjunto = '';
				}
			}
			
			$config['file_name'] = $nombre;
			$this->upload->initialize($config);

			if (!empty($_FILES['file']['name'])) {
				if(!unlink('./uploads/'.$archivo_anterior)){	
					echo "No se pudo actualizar el archivo ".$archivo_anterior;
					exit();
				}

				if (!$this->upload->do_upload('file')){
					$error = array('error' => $this->upload->display_errors());
					$this->load->view('volante/volante_form', $error);
				}
				else
				{
					$upload_data = $this->upload->data();
					$data = array('fecha' => $fecha, 'numero' => $numero, 'year' => $year, 'asunto' => $asunto,
									'enlace_archivo' => $archivo, 'id_user_origen' => $id_user_origen, 
									'id_user_destino' => $id_user_destino, 'visto' => 0);
					$this->volante_model->update($id, $data);
					redirect('dependencia/volante_enviados');
				}
			} else {
				$enlace_archivo_anterior = './uploads/'.$archivo_anterior;
				$enlace_archivo = './uploads/'.$archivo;
				if(!rename($enlace_archivo_anterior, $enlace_archivo)){
					echo "Error no se pudo renombrar archivo ".$enlace_archivo_anterior." por ".$enlace_archivo;
					exit();
				}
				$data = array('fecha' => $fecha, 'numero' => $numero, 'year' => $year, 'asunto' => $asunto,
									'enlace_archivo' => $archivo, 'enlace_adjunto' => $adjunto,'id_user_origen' => $id_user_origen, 
									'id_user_destino' => $id_user_destino, 'visto' => 0);
				$this->volante_model->update($id, $data);
				redirect('dependencia/volante_enviados');
			}
		
		}	
	}

	public function volante_delete($id)
	{		
		$volante = $this->volante_model->get($id);
		$adjunto = $volante['enlace_adjunto'];
		$archivo = $volante['enlace_archivo'];
		if(!unlink('./uploads/'.$adjunto)){	
			echo "No se pudo borrar el adjunto";
			exit();
		}
		if(unlink('./uploads/'.$archivo)){	
			$this->volante_model->delete($id);
		} else {
			echo "No se pudo borrar el archivo";
			exit();
		}
		redirect('dependencia/volante_enviados');
	}
	
	public function volante_view($from = 0){
		$this->load->helper('form');
		$this->volante_model->set_view();
		redirect("dependencia/volante_recibidos");
	}

}
