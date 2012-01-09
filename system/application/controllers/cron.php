<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package         Stockerboy
 * @author          Rajesh
 * @copyright       Copyright (c) 2008 - 2010, OrisysIndia, LLP.
 * @link            http://orisysindia.com
 * @since           Version 1.0
 * @filesource
 */
class Cron extends Controller  {
    function Cron() {
        parent::Controller();
		$this->load->library('session');
        $this->load->library('user_auth');
		$this->load->helper('url');
        $this->load->helper('form');
		$this->load->model('revenue_model');
    }
	
	function add_revenue()
	{
		header("Content-type: text/plain");
		
		$all_sales = $this->revenue_model->get_new_sales();
		
		$sales_info = array();
		foreach($all_sales as $sale) {
			$price = $sale->price * $sale->quantity;
			
			if(isset($sales_info[$sale->city_id])) $sales_info[$sale->city_id] += $price;
			else $sales_info[$sale->city_id] = $price;
		}
		
		foreach($sales_info as $city_id => $amount) {
			print "City $city_id owes $amount\n";
			$this->revenue_model->add_revenue($city_id, $amount);
		}
		
	}
}
