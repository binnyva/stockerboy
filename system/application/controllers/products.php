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
		$data['design'] = $this->product_model->get_design();
		
		$this->load->view('products/product_searchhead',$data);
		$data['products'] = $this->product_model->get_producttype();
		foreach($data['products']->result_array() as $rows)
		{
			$data['pname'] = $rows['name'];
			$data['pid'] = $rows['id'];
			$data['item'] = $this->product_model->get_item_details($data['pid']);
			$this->load->view('products/product_searchresult',$data);
		}
		$this->load->view('products/product_add',$data);
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
	
	function add_size()
	{
		$data['ptype'] = $_REQUEST['ptype'];
		$data['design'] = $_REQUEST['design'];
		$data['size'] = $_REQUEST['size'];
		
		$returnFlag = $this->product_model->addsize($data);
		
		if($returnFlag != '' && $returnFlag != 'size_already_taken')
		{
			echo "Added";
		}
		else
		{
			echo "Size already taken";
		}
	}
	
	function add_color()
	{
		$data['ptype'] = $_REQUEST['ptype'];
		$data['design'] = $_REQUEST['design'];
		$data['color'] = $_REQUEST['color'];
		
		$returnFlag = $this->product_model->addcolor($data);
		
		if($returnFlag != '' && $returnFlag != 'color_already_taken')
		{
			echo "Added";
		}
		else
		{
			echo "Color already taken";
		}
	}
	
	function get_design()
	{
		$pid=$_REQUEST['pid'];
		$data= $this->product_model->get_designs($pid);
		$content['designs'] = $data->result_array();
		$this->load->view('products/design',$content);
	}
	
	function get_design_color()
	{
		$pid=$_REQUEST['pid'];
		$data= $this->product_model->get_designs($pid);
		$content['designs'] = $data->result_array();
		$this->load->view('products/design_color',$content);
	}
	
	function get_design_code()
	{
		$pid=$_REQUEST['pid'];
		$data= $this->product_model->get_designs($pid);
		$content['designs'] = $data->result_array();
		$this->load->view('products/design_code',$content);
	}
	
	function get_size_color()
	{
		$pid=$_REQUEST['pid'];
		$did=$_REQUEST['did'];
		$data= $this->product_model->get_size($pid,$did);
		$content['designs'] = $data->result_array();
		$data= $this->product_model->get_color($pid,$did);
		$content['colors'] = $data->result_array();
		$this->load->view('products/size_color',$content);
	}
	
	function succ($str) 
	{
       $chars = '0123456789abcdefghijklmnopqrstuvwxyz';
       $str = strtolower($str);

       $final_char_pos = strlen($str);
       $final_char = $str[$final_char_pos-1];

       $char_pos = strpos($chars, $final_char);

       if($char_pos!== false) {
               if($char_pos < 35) {
                       $final_char = $chars[$char_pos+1];
                       $str = substr($str, 0, $final_char_pos-1) . $final_char;
               } else {
                       $str = succ(substr($str, 0, $final_char_pos-1)) . '0'; // :RECURSION:
               }
       }

       return $str;
	}
	
	function add_itemcode()
	{
		$data['ptype'] = $_REQUEST['ptype'];
		
		//$data['item_code'] = $this->succ($rand);
		$data['design'] = $_REQUEST['design'];
		$data['color'] = $_REQUEST['color'];
		$data['size'] = $_REQUEST['size'];
		
		$data['sex'] = $_REQUEST['sex'];
		$data['mrp'] = $_REQUEST['mrp'];
		$data['national'] = $_REQUEST['national'];
		$data['city'] = $_REQUEST['city'];
		
		
		$item_code= $this->product_model->get_itemcode();
		
		if($item_code->num_rows() > 0)
		{
			foreach($item_code->result_array() as $rows)
			{
				echo $rows['code'];
				$data['item_code'] = $this->succ($rows['code']);
			}
		}
		else
		{
			$data['item_code'] = $this->succ('0000');
		}
		
		echo $data['item_code'];
		$returnFlag = $this->product_model->additemcode($data);
		
		if($returnFlag != '')
		{
			echo "Added";
		}
		else
		{
			echo "Error";
		}
	}
	
	function get_itemList()
	{
		$page_no = $_REQUEST['pageno'];
		$search_text = $_REQUEST['q'];
		$linkCount = $this->product_model->get_itemCount($search_text);
		$data['linkCounter'] = ceil($linkCount/PAGINATION_CONSTANT);
		$data['currentPage'] = $page_no;
		$data['search_query'] = $search_text;
		$data['item'] = $this->product_model->get_itemNames($page_no,$search_text);
        $this->load->view('products/itemList_view',$data);
	}
	
	function item_search()
	{
		$data['page_no'] = $_REQUEST['page_no'];
		$data['itemcode'] = $_REQUEST['itemcode'];
		$data['product_type'] = $_REQUEST['product_type'];
		$data['design_select'] = $_REQUEST['design_select'];
		$data['color_select'] = $_REQUEST['color_select'];

		$linkCount = $this->product_model->item_searchCount($data);
		$data['linkCounter'] = ceil($linkCount/PAGINATION_CONSTANT);
		$data['currentPage'] = $data['page_no'];
		$data['item'] = $this->product_model->item_searchNames($data);
        $this->load->view('products/itemSearch_view',$data);
	}
	
	
}
