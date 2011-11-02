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
class Stock extends Controller  {
    function Stock() {
        parent::Controller();
		$this->load->library('session');
        $this->load->library('user_auth');
		$logged_user_id = $this->user_auth->logged_in();
		if(!$logged_user_id) {
			redirect('auth/login');
		}
		
		$this->load->helper('url');
		$this->load->helper('misc_helper');
        $this->load->helper('form');
		$this->load->model('stock_model');
		
    }
	
    /**
    * Function to Stock
    * @author : Rajesh
    * @param  : []
    * @return : type : []
    **/
    function stock_view() {	
		$data['title'] = 'Stocker Boy | Stock';
		$this->load->model('city_model');
		
		$all_cities = idNameFormat($this->city_model->get_all());
		$stock_data = $this->stock_model->get_all($this->session->userdata('city_id'));
		
		$dispatches = $this->stock_model->get_all_transits($this->session->userdata('city_id'), 'transit');
		$past_dispatches = $this->stock_model->get_all_transits($this->session->userdata('city_id'), 'past');
			
		$this->load->view('layout/header',$data);
		$this->load->view('stock/stock', array('all_cities'=>$all_cities, 'stock_data'=>$stock_data, 'dispatches'=>$dispatches, 'past_dispatches'=>$past_dispatches));
		$this->load->view('layout/footer');
	}
	
	function add_stock() {
		$item_code = $this->input->post('item_code');
		$amount = $this->input->post('amount');
		
		$this->load->model('item_model');
		$item_id = $this->item_model->get_id_by_code($item_code);
		
		if(!$item_id) {
			$this->session->set_flashdata('error', "Item code '$item_code' doesn't exist");
		} else {
			$this->stock_model->add_stock($item_id, $amount, $this->session->userdata('city_id'));
			$this->session->set_flashdata('success', "Items Added to stock");
		}
		
		redirect('stock/stock_view');
	}
	
	function add_dispatch() {
		$codes = $this->input->post('item_code');
		$amounts = $this->input->post('amount');
		
		$courier_number = $this->input->post('courier_number');
		$estimated_delivery_on = $this->input->post('estimated_delivery_on');
		$to_city_id = $this->input->post('to_city_id');
		
		$user_id = $this->session->userdata('id');
		$city_id = $this->session->userdata('city_id');
		
		$items = array();
		for($i=0;$i<count($codes); $i++) {
			$items[$codes[$i]] = $amounts[$i];
		}
		
		if($to_city_id == $city_id) {
			$this->session->set_flashdata('error', "You are trying to dispatch the items to yourself. Seriously?!");
			
		} else {
			$message = $this->stock_model->dispatch($user_id, $city_id, $to_city_id, $estimated_delivery_on, $courier_number, $items);
			if($message['success']) $this->session->set_flashdata('success', "$message[success] items Dispatched");
			if($message['error']) $this->session->set_flashdata('error', implode('<br />', $message['error']));
		}
		
		redirect('stock/stock_view');
	}
	
	function dispatch_details($transit_id) {
		$this->load->model('city_model');
		
		$details = $this->stock_model->get_transit($transit_id);
		$items = $this->stock_model->get_transit_items($transit_id);
		$all_cities = idNameFormat($this->city_model->get_all());
		
		$this->load->view('layout/header',array('title'=> 'Stocker Boy | Disptach Details'));
		$this->load->view('stock/dispatch_details', array('details'=>$details, 'items'=>$items, 'all_cities'=>$all_cities));
		$this->load->view('layout/footer');
	}
	
	function dispatch_received($transit_id) {
		$this->stock_model->set_received($transit_id);
		$this->session->set_flashdata('success', 'Dispatch marked as "Received"');
		redirect('stock/dispatch_details/'.$transit_id);
	}
	
	function dispatch_failed($transit_id) {
		$this->stock_model->set_failed($transit_id);
		$this->session->set_flashdata('success', 'Dispatch marked as "Failed"');
		redirect('stock/dispatch_details/'.$transit_id);
	}
	
}
