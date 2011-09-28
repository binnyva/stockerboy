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

class Report_model extends Model {
    function Report_model() {
        parent::Model();
        $this->ci = &get_instance();
    }
	
	function total_sales_this_week() {
		$last_sunday = date('Y-m-d', strtotime('last sunday')) . ' 00:00:00';
		
		$data = $this->db->query("SELECT SUM(quantity) AS sales FROM Sale WHERE sale_on > '$last_sunday'")->row();
		return ($data->sales) ? $data->sales : 0;
	}
	
	function total_sales_last_week() {
		$last_sunday = date('Y-m-d', strtotime('last sunday')) . ' 00:00:00';
		$last_last_sunday = date('Y-m-d', strtotime('-2 weeks sunday')) . ' 00:00:00';
		
		$data = $this->db->query("SELECT SUM(quantity) AS sales FROM Sale WHERE sale_on > '$last_last_sunday' AND sale_on < '$last_sunday'")->row();
		return ($data->sales) ? $data->sales : 0;
	}
	
	function total_revenue_this_week() {
		$last_sunday = date('Y-m-d', strtotime('last sunday')) . ' 00:00:00';
		
		$data = $this->db->query("SELECT SUM(quantity * Item.price) AS sales FROM Sale INNER JOIN Item ON Sale.item_id=Item.id WHERE sale_on > '$last_sunday'")->row();
		
		return ($data->sales) ? $data->sales : 0;
	}
	
	function total_revenue_last_week() {
		$last_sunday = date('Y-m-d', strtotime('last sunday')) . ' 00:00:00';
		$last_last_sunday = date('Y-m-d', strtotime('-2 weeks sunday')) . ' 00:00:00';
		
		$data = $this->db->query("SELECT SUM(quantity * Item.price) AS sales FROM Sale INNER JOIN Item ON Sale.item_id=Item.id WHERE sale_on > '$last_last_sunday' AND sale_on < '$last_sunday'")->row();
		return ($data->sales) ? $data->sales : 0;
	}
	
	function total_finance_this_week() {
		$last_sunday = date('Y-m-d', strtotime('last sunday')) . ' 00:00:00';
		
		$data = $this->db->query("SELECT SUM(quantity * Item.national_cut) AS sales FROM Sale INNER JOIN Item ON Sale.item_id=Item.id WHERE sale_on > '$last_sunday'")->row();
		
		return ($data->sales) ? $data->sales : 0;
	}
	
	function total_finance_last_week() {
		$last_sunday = date('Y-m-d', strtotime('last sunday')) . ' 00:00:00';
		$last_last_sunday = date('Y-m-d', strtotime('-2 weeks sunday')) . ' 00:00:00';
		
		$data = $this->db->query("SELECT SUM(quantity * Item.national_cut) AS sales FROM Sale INNER JOIN Item ON Sale.item_id=Item.id WHERE sale_on > '$last_last_sunday' AND sale_on < '$last_sunday'")->row();
		return ($data->sales) ? $data->sales : 0;
	}
	
	function leaderboard_sale() {
		$data = $this->db->query("SELECT name, SUM(quantity) AS sale FROM City INNER JOIN Sale ON Sale.city_id=City.id GROUP BY Sale.city_id ORDER BY sale DESC")->result();
		return $data;
	}


}