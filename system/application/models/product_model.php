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
	
	/*
		function to get product name
	*/
	
	function get_producttype()
	{
		$this->db->select('*');
        $this->db->from('product');
        $result = $this->db->get();
		return $result;
	}
	
	function get_designs_by_product($product_id) {
		return $this->db->select('*')->from('design')->where('product_id', $product_id)->get()->result();
	}
	function get_items_by_design($design_id) {
		return $this->db->select('*')->from('item')->where('design_id', $design_id)->get()->result();
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
	
	function get_itemcode()
	{
		$this->db->select('*');
        $this->db->from('item');
		$this->db->order_by("id", "desc");
		$this->db->limit(1,0);
        $result = $this->db->get();
		return $result;
	}
	
	
	function additemcode($data)
	{
		$ptype  = trim($data['ptype']);
		$code  = trim($data['item_code']);
		$design  = trim($data['design']);
		$size  = trim($data['size']);
		$color  = trim($data['color']);
		
		$sex  = trim($data['sex']);
		$mrp  = trim($data['mrp']);
		$national  = trim($data['national']);
		$city  = trim($data['city']);
		
		$itemInfo = array( 'code'  => $code,
							'product_id'  => $ptype,
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
	
	function get_item_details($pid)
	{
		$this->db->select('item.*,design.img_name');
		$this->db->from('item');
		$this->db->join('design', 'item.design_id = design.id' ,'join');		
		$this->db->where('item.product_id',$pid);
        $result = $this->db->get();
		return $result;
	}
	
	function get_itemCount($q)
	{
		$this->db->select('item.*,design.img_name');
		$this->db->from('item');
		$this->db->join('design', 'item.design_id = design.id' ,'join');
		$this->db->like('item.code', $q);
		$this->db->order_by("item.id", "desc");
		
		
		$count = $this->db->get();	
		return count($count->result());	
		
	}
	
	function get_itemNames($page,$q)
	{
			$num = PAGINATION_CONSTANT;
			$offset = PAGINATION_CONSTANT * $page;
			
			$this->db->select('item.*,design.img_name');
			$this->db->from('item');
			$this->db->join('design', 'item.design_id = design.id' ,'join');
			$this->db->like('item.code', $q);
			$this->db->limit($num,$offset);
			$this->db->order_by("item.id", "desc");

			$content = $this->db->get();
			return $content;	
			
	}
	
	function item_searchCount($data)
	{
		$this->db->select('item.*,design.img_name');
		$this->db->from('item');
		$this->db->join('design', 'item.design_id = design.id' ,'join');
		if($data['itemcode'] != "Item Code" && $data['product_type'] == "" && $data['design_select'] == "" && $data['color_select'] == "")
		{
			$this->db->where('item.code',$data['itemcode']);
		}
		elseif($data['itemcode'] != "Item Code" && $data['product_type'] != "" && $data['design_select'] == "" && $data['color_select'] == "")
		{
			$this->db->where('item.code',$data['itemcode']);
			$this->db->where('item.product_id',$data['product_type']);
		}
		elseif($data['itemcode'] != "Item Code" && $data['product_type'] != "" && $data['design_select'] != "" && $data['color_select'] == "")
		{
			$this->db->where('item.code',$data['itemcode']);
			$this->db->where('item.product_id',$data['product_type']);
			$this->db->where('item.design_id',$data['design_select']);
		}
		elseif($data['itemcode'] != "Item Code" && $data['product_type'] != "" && $data['design_select'] != "" && $data['color_select'] != "")
		{
			$this->db->where('item.code',$data['itemcode']);
			$this->db->where('item.product_id',$data['product_type']);
			$this->db->where('item.design_id',$data['design_select']);
			$this->db->where('item.size',$data['color_select']);
		}
		elseif($data['itemcode'] == "Item Code" && $data['product_type'] != "" && $data['design_select'] != "" && $data['color_select'] != "")
		{
			$this->db->where('item.product_id',$data['product_type']);
			$this->db->where('item.design_id',$data['design_select']);
			$this->db->where('item.size',$data['color_select']);
		}
		elseif($data['itemcode'] == "Item Code" && $data['product_type'] == "" && $data['design_select'] != "" && $data['color_select'] != "")
		{
			$this->db->where('item.design_id',$data['design_select']);
			$this->db->where('item.size',$data['color_select']);
		}
		elseif($data['itemcode'] == "Item Code" && $data['product_type'] == "" && $data['design_select'] == "" && $data['color_select'] != "")
		{
			$this->db->where('item.size',$data['color_select']);
		}
		elseif($data['itemcode'] == "Item Code" && $data['product_type'] != "" && $data['design_select'] == "" && $data['color_select'] == "")
		{
			$this->db->where('item.product_id',$data['product_type']);
		}
		elseif($data['itemcode'] == "Item Code" && $data['product_type'] == "" && $data['design_select'] != "" && $data['color_select'] == "")
		{
			$this->db->where('item.design_id',$data['design_select']);
		}
		elseif($data['itemcode'] == "Item Code" && $data['product_type'] != "" && $data['design_select'] != "" && $data['color_select'] == "")
		{
			$this->db->where('item.product_id',$data['product_type']);
			$this->db->where('item.design_id',$data['design_select']);
		}
		elseif($data['itemcode'] == "Item Code" && $data['product_type'] != "" && $data['design_select'] == "" && $data['color_select'] != "")
		{
			$this->db->where('item.product_id',$data['product_type']);
			$this->db->where('item.size',$data['color_select']);
		}
		
		$this->db->order_by("item.id", "desc");
		
		$count = $this->db->get();	
		return count($count->result());
	}
	
	function item_searchNames($data)
	{
		$this->db->select('item.*,design.img_name');
		$this->db->from('item');
		$this->db->join('design', 'item.design_id = design.id' ,'join');
		
		if($data['itemcode'] != "Item Code")
		{
			$this->db->where('item.code',$data['itemcode']);
		}
		
		if($data['product_type'] != "")
		{
			$this->db->where('item.product_id',$data['product_type']);
		}
		
		if($data['design_select'] != "")
		{
			$this->db->where('item.design_id',$data['design_select']);
		}
		if($data['size_select'] != "")
		{
			$this->db->where('item.size',$data['size_select']);
		}
		
		if($data['keyword'] && $data['keyword'] != "Enter Keyword")
		{
			$this->db->like('design.name',$data['keyword']);
		}
		
		$this->db->order_by("item.id", "desc");
		
		$content = $this->db->get();
		return $content;
	}
}
