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
        $this->db->from('Product');
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
        $this->db->from('Design');
        $this->db->where('name',$dname);
        $result = $this->db->get();
		
        	if($result->num_rows() == 0) 
            {
                $designInfo = array( 'name'  => $dname,
									'product_id'  => $ptype,
									'img_name'  => $img
								 );
								   
                $this->db->set($designInfo);
                $this->db->insert('Design');
				                
				return ($this->db->affected_rows() > 0) ? $this->db->insert_id(): false ;
	
            }
            else
            {
                return 'designname_already_taken';
            }
	}
	
	/*
		function to get product name
	*/
	
	function get_producttype()
	{
		$this->db->select('*');
        $this->db->from('Product');
        $result = $this->db->get();
		return $result;
	}
	
	/*
		function to get design
	*/
	
	function get_design()
	{
		$this->db->select('*');
        $this->db->from('design');
        $result = $this->db->get();
		return $result;
	}
	
	function addsize($data)
	{
		$ptype  = trim($data['ptype']);
		$design  = trim($data['design']);
		$size  = trim($data['size']);
		
		$this->db->select('*');
        $this->db->from('size');
        $this->db->where('product_id',$ptype);
		$this->db->where('design_id',$design);
		$this->db->where('size',$size);
        $result = $this->db->get();
		
        	if($result->num_rows() == 0) 
            {
                $sizeInfo = array( 'product_id'  => $ptype,
									'design_id'  => $design,
									'size'  => $size
								 );
								   
                $this->db->set($sizeInfo);
                $this->db->insert('size');
				                
				return ($this->db->affected_rows() > 0) ? $this->db->insert_id(): false ;
	
            }
			else
            {
                return 'size_already_taken';
            }
            
	}
	
	function addcolor($data)
	{
		$ptype  = trim($data['ptype']);
		$design  = trim($data['design']);
		$color  = trim($data['color']);
		
		$this->db->select('*');
        $this->db->from('color');
        $this->db->where('product_id',$ptype);
		$this->db->where('design_id',$design);
		$this->db->where('color',$color);
        $result = $this->db->get();
		
        	if($result->num_rows() == 0) 
            {
                $colorInfo = array( 'product_id'  => $ptype,
									'design_id'  => $design,
									'color'  => $color
								 );
								   
                $this->db->set($colorInfo);
                $this->db->insert('color');
				                
				return ($this->db->affected_rows() > 0) ? $this->db->insert_id(): false ;
	
            }
			else
            {
                return 'color_already_taken';
            }
            
	}
	
	function get_designs($pid)
	{
		$this->db->select('*');
        $this->db->from('design');
		$this->db->where('product_id',$pid);
        $result = $this->db->get();
		return $result;
	}
	
	
	function get_size($pid,$did)
	{
		$this->db->select('*');
        $this->db->from('size');
		$this->db->where('product_id',$pid);
		$this->db->where('design_id',$did);
        $result = $this->db->get();
		return $result;
	}
	
	function get_color($pid,$did)
	{
		$this->db->select('*');
        $this->db->from('color');
		$this->db->where('product_id',$pid);
		$this->db->where('design_id',$did);
        $result = $this->db->get();
		return $result;
	}
	
	
	function additemcode($data)
	{
		$ptype  = trim($data['ptype']);
		$design  = trim($data['design']);
		$size  = trim($data['size']);
		$color  = trim($data['color']);
		
		$sex  = trim($data['sex']);
		$mrp  = trim($data['mrp']);
		$national  = trim($data['national']);
		$city  = trim($data['city']);
		
		$itemInfo = array( 'product_id'  => $ptype,
							'design_id'  => $design,
							'size'  => $size,
							'sex'  => $sex,
							'color'  => $color,
							'price'  => $mrp,
							'national_cut'  => $national,
							'city_cut'  => $city
						 );
								   
		$this->db->set($itemInfo);
		$this->db->insert('item');
						
		return ($this->db->affected_rows() > 0) ? $this->db->insert_id(): false ;
	
	}
}