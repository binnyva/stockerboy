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
		
			
		$this->load->view('layout/header',$data);
		
		$this->load->view('stock/stock');
		
		$this->load->view('layout/footer');
		
	}
	
	/**
    * Function to Search stock
    * @author : Rajesh
    * @param  : []
    * @return : type : []
    **/
	function search_item()
	{
		$code = $_REQUEST['code'];
		$city_id = $this->session->userdata('city_id');
		$data['item'] = $this->stock_model->get_Item($city_id,$code);
		//print_r($data['item']->result_array());
		$this->load->view('stock/item_display',$data);
	}
	
}
