<?php
class View_model extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function get_list_users($id_order){
        $this->db->select('*');
        $this->db->from('views v');
        $this->db->join('users u', "v.id_user = u.id AND v.id_order = $id_order", 'left');
        $this->db->order_by('name', 'desc');
        $result  = $this->db->get()->result_array();
        return $result;
    }

    public function insert($id_user){
        $data = array(
            'id_order' => xss_clean($this->input->post('id_order')),
            'id_user' => $id_user
        );
        return $this->db->insert('views', $data);
    }

}