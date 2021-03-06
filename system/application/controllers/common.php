<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package         MadApp
 * @author          Rabeesh
 * @copyright       Copyright (c) 2008 - 2010, OrisysIndia, LLP.
 * @link            http://orisysindia.com
 * @since           Version 1.0
 * @filesource
 */
class Common extends Controller {
   	function Common() {
        parent::Controller();
	}

	/// Handle the responses sent as the reply to the confirmation text here.
	function sms_response() {
		$this->load->model('sales_model');
		$this->load->model('users_model');
		$this->load->model('item_model');
		$this->load->library('sms');
		
		$debug = 1;
				
		$log = '';
		if($debug) print "<pre>";
		
		// SMS Number: 9220092200
		// http://localhost/Projects/MadSB/trunk/index.php/common/sms_response
		//			?msisdn=919746068565&timestamp=1234567&keyword=MSB&content=MSB+00001+binnyva@gmail.com+9746068565
		/// keyword=MSB&phonecode=9220092200&location=Delhi&carrier=Hutch&content=MSB 00001 9746068565 binnyva@gmail.com&msisdn=919873734741&timestamp=1318000798081
		$phone = preg_replace('/^91/', '', $_REQUEST['msisdn']); // Gupshup uses a 91 at the start. Remove that.
		$time = $_REQUEST['timestamp'];
		$keyword = strtolower($_REQUEST['keyword']);
		$content = $_REQUEST['content'];
		$log .= "From $phone at $time:";
		
		// Find the user with who sent the SMS - using the phone number.
		$user = reset($this->users_model->search_users(array('phone'=>$phone, 'city_id'=>0)));
		if(!$user) {
			$log .= "User Not Found!";
			$this->db->query("UPDATE setting SET data='".mysql_real_escape_string($log)."' WHERE name='temp'");
			return;
		}
		if($debug) print $content;
		$code = '';
		$email = '';
		$phone = '';
		if(preg_match('/\b([\w\_\.\-\+]+\@[\w\_\-]+\.[a-z\.]{2,5})\b/', $content, $matches)) {
			$email = $matches[0];
		}
		if(preg_match('/\b(\d{7,12})\b/', $content, $matches)) {
			$phone = $matches[1];
		}
		if(preg_match('/\b(\d{2,5})\b/', $content, $matches)) {
			$code = $matches[1];
		}
		
		if($debug) print "Email: $email\nPhone: $phone\nCode: $code\n";
		$log .= "Email: $email\nPhone: $phone\nCode: $code\n";
		
		$this->sales_model->make_sale($user->id, array($code), array($email), array($phone));
		
 		$this->db->query("UPDATE setting SET data='".mysql_real_escape_string($log)."' WHERE name='temp'");
	}

	function show() {
		print "<pre>";
		print $this->db->query("SELECT data FROM setting WHERE name='temp'")->row()->data;
		print "</pre>";
	}
	
	function test($text) {
		$this->load->library('sms');
		$this->sms->send('9746068565', $text);
	}
	
	function add_stock() {
		$designs = array(1,2,3);
		
		$item_template = array(
				'code' 			=> '',
				'product_id'	=> 1,
				'design_id'		=> '',
				'size'			=> '',
				'sex'			=> '',
				'color'			=> '',
				'price'			=> 350,
				'national_cut'	=> 200,
				'city_cut'		=> 150,
			);
		$all_sizes = array('S', 'M', 'L', 'XL');
		$all_sex = array('m', 'f');
		print '<pre>';
		$code_count = 1;
		foreach($designs as $design_id) {
			foreach($all_sex as $sex) {
				foreach($all_sizes as $size) {
					if($sex == 'f' and $size == 'XL') continue;
					$item = $item_template;
					
					$item['size'] = $size;
					$item['sex'] = $sex;
					$item['design_id'] = $design_id;
					$item['code'] = str_pad($code_count, 5, '0', STR_PAD_LEFT);
					$this->db->insert('item', $item);
					print_r($item);
					
					$code_count++;
				}
			}			
		}
	}
}
