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
class Products extends Controller  {
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
    function products_view() {	
		$data['title'] = 'Stocker Boy | Products';
		
		/*if($this->input->post('city_id') and $this->user_auth->check_permission('change_city')) {
			$this->session->set_userdata('city_id', $this->input->post('city_id'));
		}*/
		
		$this->load->view('layout/header',$data);
		//$upcomming_classes = $this->class_model->get_upcomming_classes();
		//$this->load->view('dashboard/dashboard', array('upcomming_classes'=>$upcomming_classes));
		$data['product_type'] = $this->product_model->get_producttype();
		
		$this->load->view('products/products',$data);
		$this->load->view('layout/footer');
    }
	
	/*
		Function to add product type
	*/
	
	function add_product_type()
	{
		$data['ptype'] = $_REQUEST['ptype'];
		
		$returnFlag = $this->product_model->addproducttype($data);
		
		if($returnFlag != '' && $returnFlag != 'producttype_already_taken')
		{
			echo "Added";
		}
		else
		{
			echo "Product type already taken";
		}
	}
	
	function add_design()
	{
		$data['ptype'] = $_REQUEST['ptype'];
				
		$data['dname'] = $_REQUEST['dname'];
				
		$data['img'] = $_REQUEST['img'];
		
		
		
			$returnFlag = $this->product_model->adddesign($data);
			
			if($returnFlag != '' && $returnFlag != 'designname_already_taken')
			{
				echo "Added";
			}
			else
			{
				echo "Design name already taken";
			}
		
		
		
		
	}
}
