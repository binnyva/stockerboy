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
class Crone extends Controller  {
    function Crone() {
        parent::Controller();
		$this->load->library('session');
        $this->load->library('user_auth');
		$this->load->helper('url');
        $this->load->helper('form');
		$this->load->model('crone_model');
    }
	
	function add_revenue()
	{
		$data['city'] = $this->crone_model->get_city();
		foreach($data['city']->result_array() as $rows) 
		{
			$date = date('Y-m-d');
			$ts = strtotime($date);
			$dow = date('w', $ts);
			$offset = $dow - 1;
			if ($offset < 0) $offset = 6;
			$ts = $ts - $offset*86400;
			$data['price'] = 0;
			$data['final_price'] = 0;
			for ($i = 0; $i < 7; $i++, $ts += 86400)
			{
				$data['date'] = date("Y-m-d", $ts);
				$data['city_id'] = $rows['id'];
				$data['sales'] = $this->crone_model->get_sales($data);
				foreach($data['sales']->result_array() as $row)
				{
					$data['price'] = $data['price'] + $row['price'] * $row['quantity'];
				}
			}
			if($data['price'] > 0)
			{
				$returnFlag = $this->crone_model->add_revenue($data);
			}
		}
	}
}
