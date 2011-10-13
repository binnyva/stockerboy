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
		
		$data = $this->db->query("SELECT SUM(quantity) AS sales FROM sale WHERE sale_on > '$last_sunday'")->row();
		return ($data->sales) ? $data->sales : 0;
	}
	
	function total_sales_last_week() {
		$last_sunday = date('Y-m-d', strtotime('last sunday')) . ' 00:00:00';
		$last_last_sunday = date('Y-m-d', strtotime('-2 weeks sunday')) . ' 00:00:00';
		
		$data = $this->db->query("SELECT SUM(quantity) AS sales FROM sale WHERE sale_on > '$last_last_sunday' AND sale_on < '$last_sunday'")->row();
		return ($data->sales) ? $data->sales : 0;
	}
	
	function total_revenue_this_week() {
		$last_sunday = date('Y-m-d', strtotime('last sunday')) . ' 00:00:00';
		
		$this->load->model('users_model');
		$user = $this->users_model->get_user($this->session->userdata('id'));
		$city_info = '';
		if($user->type == 'city') {
			$city_info = " AND city_id={$user->city_id}";
		}
		
		$data = $this->db->query("SELECT SUM(quantity * item.{$user->type}_cut) AS sales FROM sale 
			INNER JOIN item ON sale.item_id=item.id WHERE sale_on > '$last_sunday' $city_info")->row();
		
		return ($data->sales) ? $data->sales : 0;
	}
	
	function total_revenue_last_week() {
		$last_sunday = date('Y-m-d', strtotime('last sunday')) . ' 00:00:00';
		$last_last_sunday = date('Y-m-d', strtotime('-2 weeks sunday')) . ' 00:00:00';
		
		$this->load->model('users_model');
		$user = $this->users_model->get_user($this->session->userdata('id'));
		$city_info = '';
		if($user->type == 'city') {
			$city_info = " AND city_id={$user->city_id}";
		}
		
		$data = $this->db->query("SELECT SUM(quantity * item.{$user->type}_cut) AS sales FROM sale 
			INNER JOIN item ON sale.item_id=item.id WHERE sale_on > '$last_last_sunday' AND sale_on < '$last_sunday' $city_info")->row();
		return ($data->sales) ? $data->sales : 0;
	}
	
	function total_finance_this_week() {
		$last_sunday = date('Y-m-d', strtotime('last sunday')) . ' 00:00:00';
		
		$data = $this->db->query("SELECT SUM(quantity * item.national_cut) AS sales FROM sale 
			INNER JOIN item ON sale.item_id=item.id WHERE sale_on > '$last_sunday'")->row();
		
		return ($data->sales) ? $data->sales : 0;
	}
	
	function total_finance_last_week() {
		$last_sunday = date('Y-m-d', strtotime('last sunday')) . ' 00:00:00';
		$last_last_sunday = date('Y-m-d', strtotime('-2 weeks sunday')) . ' 00:00:00';
		
		$data = $this->db->query("SELECT SUM(quantity * item.national_cut) AS sales FROM sale 
			INNER JOIN item ON sale.item_id=item.id WHERE sale_on > '$last_last_sunday' AND sale_on < '$last_sunday'")->row();
		return ($data->sales) ? $data->sales : 0;
	}
	
	function leaderboard_sale() {
		$data = $this->db->query("SELECT name, SUM(quantity) AS sale FROM city 
			INNER JOIN sale ON sale.city_id=city.id GROUP BY sale.city_id ORDER BY sale DESC")->result();
		return $data;
	}
}
