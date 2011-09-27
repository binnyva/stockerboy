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
	
	function adddesign($data)
	{
		$ptype  = trim($data['ptype']);
		$dname  = trim($data['dname']);
		$img  = trim($data['img']);
		
		$this->db->select('*');
        $this->db->from('design');
        $this->db->where('name',$dname);
        $result = $this->db->get();
		
        	if($result->num_rows() == 0) 
            {
                $designInfo = array( 'name'  => $dname,
									'product_id'  => $ptype,
									'img_name'  => $img
								 );
								   
                $this->db->set($designInfo);
                $this->db->insert('design');
				                
				return ($this->db->affected_rows() > 0) ? $this->db->insert_id(): false ;
	
            }
            else
            {
                return 'designname_already_taken';
            }
	}
	
	function get_producttype()
	{
		$this->db->select('*');
        $this->db->from('product');
        $result = $this->db->get();
		return $result;
	}
	
}