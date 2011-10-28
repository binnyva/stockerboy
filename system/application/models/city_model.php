<?php
class City_model extends Model {
    function City_model() {
        // Call the Model constructor
        parent::Model();
        
        $this->ci = &get_instance();
		$this->city_id = $this->ci->session->userdata('city_id');
    }
    
    function add_city($data) {
		$success = $this->db->insert('city', 
			array(
				'name'			=>	$data['name'], 
				'added_on'		=>	date('Y-m-d H:i:s')
			));
		
		return $success;
    }
    
    function edit_city($data) {
    	$this->db->where('id', $this->input->post('id'))->update('city', $data);
		return ($this->db->affected_rows() > 0) ? true : false;
    }
    
    function get_city($city_id) {
    	return $this->db->where('id',$city_id)->get('city')->row_array();
    }
    
    
	function get_all() {
		return $this->db->order_by('name')->get('city')->result();
	}

}
