<?php
class Volante_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_list($limit = 0, $offset = 0, $where = TRUE)
    {
        $offset = xss_clean($offset);
        $where = xss_clean($where);

        $this->db->from('volantes');
        $this->db->order_by('id', 'desc');
        $this->db->where($where);
        $result['data']  = $this->db->limit($limit, $offset)->get()->result_array();

        $this->db->from('volantes');
        $this->db->where($where);
        
        $result['count'] = $this->db->count_all_results();
        return $result;
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
}
