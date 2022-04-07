<?php
class View_model extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function get($id){
        $this->db->where('id', $id);
        $query = $this->db->get('views');
        return $query->row_array();
    }

    public function insert($id_user){
        $data = array(
            'id_order' => xss_clean($this->input->post('id_order')),
            'id_user' => $id_user
        );
        return $this->db->insert('views', $data);
    }

}