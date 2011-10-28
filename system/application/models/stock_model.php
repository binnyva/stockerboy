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

class Stock_model extends Model {

    function Stock_model() {
        parent::Model();
        $this->ci = &get_instance();
       //$this->city_id = $this->ci->session->userdata('city_id');
        //$this->project_id = $this->ci->session->userdata('project_id');
    }
	
	/**
    * Function to Search stock
    * @author : Rajesh
    * @param  : []
    * @return : type : []
    **/
	
	function get_Item($city,$code)
	{
		$this->db->select('stock.*,item.code,item.product_id,item.design_id,item.size,item.sex,item.color,item.national_cut,item.city_cut');
        $this->db->from('stock');
		$this->db->join('item' ,'item.id = stock.item_id','left');
		$this->db->where('item.code',$code);
		$this->db->where('stock.city_id',$city);
		
        $result = $this->db->get();
		return $result;
	}
	
	/**
    * Function to Search stock count
    * @author : Rajesh
    * @param  : []
    * @return : type : []
    **/
	
	function get_ItemCount($city,$code)
	{
		$this->db->select('stock.*,item.code,item.product_id,item.design_id,item.size,item.sex,item.color,item.national_cut,item.city_cut');
        $this->db->from('stock');
		$this->db->join('item' ,'item.id = stock.item_id','left');
		$this->db->where('item.code',$code);
		$this->db->where('stock.city_id',$city);
        
		$count = $this->db->get();	
		return count($count->result());
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
	
	function get_color()
	{
		$this->db->select('*');
        $this->db->from('color');
        $result = $this->db->get();
		return $result;
	}
	
	/**
    * Function to Search stock
    * @author : Rajesh
    * @param  : []
    * @return : type : []
    **/
	
	function get_Item1($data)
	{
		$this->db->select('stock.*,item.code,item.product_id,item.design_id,item.size,item.sex,item.color,item.national_cut,item.city_cut');
        $this->db->from('stock');
		$this->db->join('item' ,'item.id = stock.item_id','left');
		$this->db->where('item.design_id',$data['design']);
		$this->db->where('item.size',$data['size']);
		$this->db->where('item.sex',$data['sex']);
		$this->db->where('item.color',$data['color']);
		$this->db->where('stock.city_id',$data['city_id']);
		
        $result = $this->db->get();
		return $result;
	}
	
	/**
    * Function to Search stock count1
    * @author : Rajesh
    * @param  : []
    * @return : type : []
    **/
	
	function get_ItemCount1($data)
	{
		$this->db->select('stock.*,item.code,item.product_id,item.design_id,item.size,item.sex,item.color,item.national_cut,item.city_cut');
        $this->db->from('stock');
		$this->db->join('item' ,'item.id = stock.item_id','left');
		$this->db->where('item.design_id',$data['design']);
		$this->db->where('item.size',$data['size']);
		$this->db->where('item.sex',$data['sex']);
		$this->db->where('item.color',$data['color']);
		$this->db->where('stock.city_id',$data['city_id']);
        
		$count = $this->db->get();	
		return count($count->result());
	}
}