<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_model extends Model {

    function Product_model() {
        parent::Model();
        $this->ci = &get_instance();
    }
	
	function get_id_by_code($code) {
		return $this->db->where('code', $code)->get('item')->row()->id;
	}
}