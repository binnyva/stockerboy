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
		
		$log = '';
		print "<pre>";
		
		// http://localhost/Projects/MadSB/trunk/index.php/common/sms_response
		//			?msisdn=919746068565&timestamp=1234567&keyword=MSB&content=MSB+00001+binnyva@gmail.com+9746068565
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
		print $content;
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
		
		print "Email: $email\nPhone: $phone\nCode: $code\n";
		
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
}
