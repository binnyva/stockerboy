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

class Crone_model extends Model {
    function Crone_model() {
        parent::Model();
       
    }
	
	function get_city()
	{
		$this->db->select('*');
        $this->db->from('city');
        $result = $this->db->get();
		return $result;
	}
	
	function get_sales($data)
	{
		$this->db->select('sale.*,item.price');
        $this->db->from('sale');
		$this->db->join('item', 'sale.item_id = item.id' ,'join');
		$this->db->where('sale.city_id',$data['city_id']);
		$this->db->like('sale.sale_on',$data['date']." 00:00:00");
        $result = $this->db->get();
		return $result;
	}
	
	function add_revenue($data)
	{
		$city_id  = trim($data['city_id']);
		$price  = trim($data['price']);
		
		$revenueInfo = array( 'amount'  => $price,
							  'amount_to_pay'  => $price,
							  'city_id'  => $city_id,
							  'paid'  => '0',
							  'added_on'  => date('Y-m-d H:i:s'),
								 );
								   
		$this->db->set($revenueInfo);
		$this->db->insert('revenue');
						
		return ($this->db->affected_rows() > 0) ? $this->db->insert_id(): false ;
	}
}
