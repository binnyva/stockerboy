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

class Sales_model extends Model {

    function Sales_model() {
        parent::Model();
        $this->ci = &get_instance();
       //$this->city_id = $this->ci->session->userdata('city_id');
        //$this->project_id = $this->ci->session->userdata('project_id');
    }
	
	function get_items()
	{
		$this->db->select('*');
        $this->db->from('item');
		$this->db->order_by("code", "asc");
        $result = $this->db->get();
		return $result;
	}
	
	function addsales($data) {
		// First see if the item is there in the stock of this city
		$stock = $this->db->where(array('item_id'=>$data['item_code'], 'city_id'=>$data['city_id']))->get('stock')->row();
		
		if($stock and $stock->amount) { // We have that item in stock.
			$this->db->where('id', $stock->id)->update('stock', array('amount'=>($stock->amount - 1)));
	
			$this->db->insert('sale', array( 'item_id'  => $data['item_code'],
				'sold_by_user_id'  => $data['user_id'],
				'city_id'  => $data['city_id'],
				'approved'  => '1',
				'quantity'	=> 1,
				'sale_on'	=> date('Y-m-d H:i:s'),
				'approved_by_user_id'  => $data['user_id'],
				'email'  => $data['email'],
				'phone_number'  => $data['phone']
			));
			return $this->db->insert_id();
		} else {
			// Item not in stock.
			return false ;
		}
	}
	
	/// This will make a sale. Fuction is called from the common/sms_response and sales/add_sales places.
	function make_sale($user_id, $codes, $emails, $phones) {
		$this->load->library('sms');
		$this->load->library('email');
		$this->load->model('settings_model');
		$this->load->model('item_model');
		$this->load->model('users_model');
		
		$data['city_id'] = $this->users_model->get_users_city($user_id);
		$data['user_id'] = $user_id;
		$message = array('success'=>'0', 'error'=>array());
		
		$from_email = $this->ci->settings_model->get_setting_value('email_address');
		$sms_template = $this->ci->settings_model->get_setting_value('sale_sms_template');
		$email_template = $this->ci->settings_model->get_setting_value('sale_email_template');
		
		$count = 0;
		for($i=0; $i<count($codes); $i++) {
			$item_code = $codes[$i];
			if($item_code and $item_code != 'Item Code') {
				$data['item_code'] = $this->ci->item_model->get_id_by_code($item_code);
				if(!$data['item_code']) {
					$message['error'][] = "Invalid Item code '$item_code'.";
					continue;
				}
				
				$data['phone'] = $this->correct_phone_number($phones[$i]);
				$data['email'] = $emails[$i];
						
				$success = $this->addsales($data);
				if($success) {
					// Disabled for now. :TODO:
// 					$this->ci->sms->send('91'.$data['phone'], $sms_template);
// 					
// 					$this->ci->email->from($from_email, "Make A Difference");
// 					$this->ci->email->to($data['email']);
// 					$this->ci->email->subject('Dream Tee Purchase');
// 					$this->ci->email->message($email_template);
// 					$this->ci->email->send();
					
					$count++;
				} else {
					$message['error'][] = "Item '$item_code' not in stock.";
				}
			}
		}
		$message['success'] = "$count";
		
		return $message;
	}
	
	function get_city()
	{
		$this->db->select('*');
        $this->db->from('city');
		$this->db->order_by("name", "asc");
        $result = $this->db->get();
		return $result;
	}
	
	function get_sales_thisweek($city_id)
	{
			$date = date('Y-m-d');
			$ts = strtotime($date);
			$dow = date('w', $ts);
			$offset = $dow - 1;
			if ($offset < 0) $offset = 6;
			$ts = $ts - $offset*86400;
			$count = 0;
			$no = 0;
			for ($i = 0; $i < 7; $i++, $ts += 86400)
			{
				$dt = date("Y-m-d", $ts);
			
				$this->db->select('*');
				$this->db->from('sale');
				$this->db->where('city_id',$city_id);
				$this->db->like('sale_on',$dt);
				$counts = $this->db->get();
				$count = count($counts->result());
				$no = $no + $count;
				
			}
		return $no;
        
			
		//return count($count->result());
		
	}
	
	function get_sales_prevweek($city_id)
	{
		$dt = date('Y-m-d');
		$date = strtotime ( '-1 week' , strtotime ( $dt ) ) ;
		
		$ts = strtotime($date);
		$dow = date('w', $ts);
		$offset = $dow - 1;
		if ($offset < 0) $offset = 6;
		$ts = $ts - $offset*86400;
		$count = 0;
		$no = 0;
		for ($i = 0; $i < 7; $i++, $ts += 86400)
		{
			$dt = date("Y-m-d", $ts);
			$this->db->select('*');
			$this->db->from('sale');
			$this->db->where('city_id',$city_id);
			$this->db->like('sale_on',$dt);
			
			$counts = $this->db->get();
			$count = count($counts->result());
			$no = $no + $count;
		}
		return $no;
	}
	
	function get_cityCount($value)
	{
		$this->db->select('*');
		$this->db->from('city');
		$this->db->order_by("name", "asc");
		
				
		$count = $this->db->get();	
		return count($count->result());	
		
	}
	
	function get_cityNames()
	{
		$this->db->select('*');
		$this->db->from('city');
		$this->db->order_by("name", "asc");

		$content = $this->db->get();
		return $content;	
			
	}
	
	function get_salesCount($city_id,$value)
	{
		$this->db->select('*');
		$this->db->from('sale');
		$this->db->where('city_id',$city_id);
		if($value == 1)
		{
			$this->db->like('sale_on',date('Y-m-d'));
		}
		elseif($value == 2)
		{
			$ydy = date("Y-m-d", mktime(0, 0, 0, date("m"),date("d")-1,date("Y")));
			$this->db->like('sale_on',$ydy);
		}
			
		$count = $this->db->get();	
		return count($count->result());
	}
	
	function get_salesCountWk($city_id)
	{
		$date = date('Y-m-d');
			$ts = strtotime($date);
			$dow = date('w', $ts);
			$offset = $dow - 1;
			if ($offset < 0) $offset = 6;
			$ts = $ts - $offset*86400;
			$count = 0;
			$no = 0;
			for ($i = 0; $i < 7; $i++, $ts += 86400)
			{
				$dt = date("Y-m-d", $ts);
			
				$this->db->select('*');
				$this->db->from('sale');
				$this->db->where('city_id',$city_id);
				$this->db->like('sale_on',$dt);
				$counts = $this->db->get();
				$count = count($counts->result());
				$no = $no + $count;
				
			}
		return $no;
	}
	
	function get_weekly_sales_data($city_id=0) {
		$where = '';
		if($city_id) $where = 'WHERE city_id='.$city_id;
		
		$sales = $this->db->query("SELECT id, sale_on FROM sale $where ORDER BY sale_on")->result();
				
		$data = array();
		$first_day = date('w', strtotime(date('Y').'-01-01'));
		foreach($sales as $s) {
			$week = date('W', strtotime($s->sale_on));
			if(!isset($data[$week])) {
				$weekday_str = strtotime(date('Y', strtotime($s->sale_on)).'W'.$week.$first_day);
				$data[$week] = array(
					'week'	=> date('M j', $weekday_str + (60 * 60 * 24)) . ' - ' . date('M j', $weekday_str + (60 * 60 * 24  * 7)),
					'sales'	=> 0,
					'from'	=> date('Y-m-d', $weekday_str + (60 * 60 * 24)),
					'to'	=> date('Y-m-d', $weekday_str + (60 * 60 * 24  * 7)),
				);
			}
			
			$data[$week]['sales']++;
			
		}
		
		return $data;
	}
	
	function get_city_sales_data($from, $to) {
		return $this->db->query("SELECT COUNT(*) AS sales, sale.city_id, city.name 
			FROM sale INNER JOIN city ON sale.city_id=city.id 
			WHERE sale.sale_on BETWEEN '$from 00:00:00' AND '$to 23:59:59'
			GROUP BY sale.city_id")->result();
	}
	
	
	function get_city_week_sales_data($city_id, $from, $to) {
		return $this->db->query("SELECT COUNT(*) AS sales, item.code, item.size, item.sex,item.color, item.price
			FROM sale INNER JOIN item ON sale.item_id=item.id
			WHERE sale.sale_on BETWEEN '$from 00:00:00' AND '$to 23:59:59'
			GROUP BY sale.item_id ORDER BY sales DESC")->result();
	}
	
	/// Changes the phone number format from +91976068565 to 9746068565. Remove the 91 at the starting.
	function correct_phone_number($phone) {
		if(strlen($phone) > 10) {
			return preg_replace('/^\+?91\D?/', '', $phone);
		}
		return $phone;
	}
}