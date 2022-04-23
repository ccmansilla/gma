<?php
class User_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get_list($limit = 0, $offset = 0, $where = '')
        {
                $query = $this->db->from('users');
                if($where !== ''){
                        $query->where($where);
                }
                if($limit > 0){
                        $query->limit($limit, $offset);
                        $result['data']  = $query->limit($limit, $offset)->get()->result_array();
                        $query = $this->db->from('users');
                        if($where !== ''){
                                $query->where($where);
                        }
                        $result['count'] = $query->count_all_results();
                        return $result;
                } else {
                        $result = $query->get()->result_array();
                        return $result;
                }
        }

	
        public function get_list_basic()
        {
                $query = $this->db->from('users');
		$query->select('id, name');
		$result = $query->get()->result_array();
		return $result;
        }

        public function get($id)
        {
                $this->db->where('id', $id);
                $query = $this->db->get('users');
                return $query->row_array();
        }

        public function insert()
        {
            $data = array(
                'role' => xss_clean($this->input->post('role')),
                'name' => xss_clean($this->input->post('name')),
                'nick' => xss_clean($this->input->post('nick')),
                'pass' => md5($this->input->post('pass'))
            );

            return $this->db->insert('users', $data);
        }

        public function update($id)
        {
                $data = array(
                        'role' => xss_clean($this->input->post('role')),
                        'name' => xss_clean($this->input->post('name')),
                        'nick' => xss_clean($this->input->post('nick'))
                    );

                if ($this->input->post('pass') !== "") {
                        $data ['pass'] = md5($this->input->post('pass'));
                }  
        
                $this->db->where('id', $id);    
                return $this->db->update('users', $data);

        }

        public function delete($id)
        {
                $this->db->where('id', $id);
                $this->db->delete('users');
        }

        public function login($nick, $pass)
        {
                $pass = md5($pass);
                $this->db->where('nick',xss_clean($nick));
                $this->db->where('pass',$pass);
                $rs = $this->db->get('users');
                if($rs->num_rows() > 0){
                        $row = $rs->result()[0];
                        return $row;
                } else {
                        return '';
                }
        }
}
