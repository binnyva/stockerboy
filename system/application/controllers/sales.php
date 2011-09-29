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
class Sales extends Controller  {
    function Products() {
        parent::Controller();
		$this->load->library('session');
        $this->load->library('user_auth');
		$logged_user_id = $this->user_auth->logged_in();
		if(!$logged_user_id) {
			redirect('auth/login');
		}
		
		$this->load->helper('url');
        $this->load->helper('form');
		$this->load->model('product_model');
		//$this->load->model('class_model');
		//$this->load->model('kids_model');
		//$this->load->model('level_model');
    }
	
    /**
    * Function to products
    * @author : Rajesh
    * @param  : []
    * @return : type : []
    **/
    function sales_view() {	
		$data['title'] = 'Stocker Boy | Sales';
		
		/*if($this->input->post('city_id') and $this->user_auth->check_permission('change_city')) {
			$this->session->set_userdata('city_id', $this->input->post('city_id'));
		}*/
		
		$this->load->view('layout/header',$data);
		//$upcomming_classes = $this->class_model->get_upcomming_classes();
		//$this->load->view('dashboard/dashboard', array('upcomming_classes'=>$upcomming_classes));
				
		$this->load->view('sales/sales');
		$this->load->view('layout/footer');
    }
	
	
}
