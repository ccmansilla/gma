<?php
class Orden_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function get_list($limit = 0, $offset = 0, $where = '')
        {
            $offset = xss_clean($offset);
            $where = xss_clean($where);

            $this->db->from('orders');
            $this->db->order_by('number', 'desc');
            if ($where !== ''){
                    $this->db->where($where);
            } 
            $result['data']  = $this->db->limit($limit, $offset)->get()->result_array();

            $this->db->from('orders');
            if ($where !== ''){
                    $this->db->where($where);
            } 
            $result['count'] = $this->db->count_all_results();
            return $result;
        }

        public function get_list_views_user($id_user, $limit = 0, $offset = 0, $where = TRUE)
        {
            $offset = xss_clean($offset);
            $where = xss_clean($where);

            $this->db->select('*');
            $this->db->from('orders o');
            $this->db->join('views v', "o.id = v.id_order AND v.id_user = $id_user", 'left');
            $this->db->order_by('number', 'desc');
            $this->db->where($where); 
            $result['data']  = $this->db->limit($limit, $offset)->get()->result_array();

            $this->db->select('*');
            $this->db->from('orders o');
            $this->db->join('views v', "o.id = v.id_order AND v.id_user = $id_user", 'left');
            $this->db->where($where); 
            $result['count'] = $this->db->count_all_results();
            return $result;
        }

        public function get($id)
        {
            $id = xss_clean($id);
            $this->db->where('id', $id);
            $query = $this->db->get('orders');
            return $query->row_array();
        }
		
		public function get_file($id)
		{
			$order = $this->get($id);
			return $order['file'];
		}

        public function insert($data)
        {
            return $this->db->insert('orders', $data);
        }

        public function update($id, $data)
        {
            $id = xss_clean($id);
            $this->db->where('id', $id);  
            $this->db->update('orders', $data);
        }

         public function delete($id)
        {
                $id = xss_clean($id);
                $this->db->where('id', $id);
                $this->db->delete('orders');
        }
}
