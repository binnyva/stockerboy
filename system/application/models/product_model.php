<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 * An open source application development framework for PHP 4.3.2 or newer
 
 * @package		Stockerboy
 * @author		Rajesh
 * @copyright	Copyright (c) 2008 - 2010, OrisysIndia, LLP.
 * @link		http://orisysindia.com
 * @since		Version 1.0
 * @filesource
 */

class Product_model extends Model {

    function Product_model() {
        parent::Model();
        $this->ci = &get_instance();
       //$this->city_id = $this->ci->session->userdata('city_id');
        //$this->project_id = $this->ci->session->userdata('project_id');
    }
	
	/*
			Function to add product type
	*/
	
	function addproducttype($data)
	{
		$ptype  = trim($data['ptype']);
		
		$this->db->select('*');
        $this->db->from('product');
        $this->db->where('name',$ptype);
        $result = $this->db->get();
		
        	if($result->num_rows() == 0) 
            {
                $ptypeInfo = array( 'name'  => $ptype
								 );
								   
                $this->db->set($ptypeInfo);
                $this->db->insert('product');
				                
				return ($this->db->affected_rows() > 0) ? $this->db->insert_id(): false ;
	
            }
            else
            {
                return 'producttype_already_taken';
            }
	}
	
}