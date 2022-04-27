<?php
class Volante_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_list_enviados($id_user, $limit = 10, $offset = 0, $where = "")
    {
        $offset = xss_clean($offset);
        $where = xss_clean($where);

        $this->db->from('volantes v');
		$this->db->join('users u', "v.id_user_destino = u.id");
		if ($where != "") {
			//$this->db->where($where);
		} else {
			$this->db->where('id_user_origen', $id_user);
		}
        $this->db->order_by('v.id', 'desc');
        $result['data']  = $this->db->limit($limit, $offset)->get()->result_array();

        $this->db->from('volantes');
		if ($where != "") {
			$this->db->where($where);
		} else {
			$this->db->where('id_user_origen', $id_user);
		}
        $result['count'] = $this->db->count_all_results();
        return $result;
    }

	public function get_list_recibidos($id_user, $limit = 10, $offset = 0, $where = "")
    {
        $offset = xss_clean($offset);
        $where = xss_clean($where);

        $this->db->from('volantes v');
		$this->db->join('users u', "v.id_user_origen = u.id");
        $this->db->order_by('v.id', 'desc');
		if ($where != "") {
			//$this->db->where($where);
		} else {
			$this->db->where('id_user_destino', $id_user);
		}
        $result['data']  = $this->db->limit($limit, $offset)->get()->result_array();

        $this->db->from('volantes');
		if ($where != "") {
			$this->db->where($where);
		} else {
			$this->db->where('id_user_destino', $id_user);
		}
        $result['count'] = $this->db->count_all_results();
        return $result;
    }

	public function get($id)
    {
        $id = xss_clean($id);
        $this->db->where('id', $id);  
		$this->db->from('volantes');
        $result = $this->db->get()->result_array();
		return $result[0];
    }

    public function insert($data)
    {
        return $this->db->insert('volantes', $data);
    }

    public function update($id, $data)
    {
        $id = xss_clean($id);
        $this->db->where('id', $id);  
        $this->db->update('volantes', $data);
    }

    public function delete($id)
    {
            $id = xss_clean($id);
            $this->db->where('id', $id);
            $this->db->delete('volantes');
    }

	public function set_view(){
        $id = xss_clean($this->input->post('id_volante'));
		$data = array(
            'visto' => 1
        );
        $this->db->where('id', $id);  
        $this->db->update('volantes', $data);
    }
}
