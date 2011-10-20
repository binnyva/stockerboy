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
}