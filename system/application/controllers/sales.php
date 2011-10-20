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
    function Sales() {
        parent::Controller();
		$this->load->library('session');
        $this->load->library('user_auth');
		$logged_user_id = $this->user_auth->logged_in();
		if(!$logged_user_id) {
			redirect('auth/login');
		}
		
		$this->load->helper('url');
        $this->load->helper('form');
		$this->load->model('sales_model');
		
    }
	
    /**
    * Function to Sales
    * @author : Rajesh
    * @param  : []
    * @return : type : []
    **/
    function sales_view() {	
		$data['title'] = 'Stocker Boy | Sales';
		
			
		$this->load->view('layout/header',$data);
		
		$data['item'] = $this->sales_model->get_items();
		
		$this->load->view('sales/sales_head');
		$city = $this->sales_model->get_city();
		foreach ( $city->result() as $row )
		{
			$data['city'] = $row->name;
			$this->load->view('sales/sales_chart_city',$data);
		}
		$this->load->view('sales/sales_chart_sales',$data);
			
		foreach ( $city->result() as $row )
		{
			$data['city_id'] = $row->id;
			$data['this_week_count'] = $this->sales_model->get_sales_thisweek($data['city_id']);
			$this->load->view('sales/sales_chart_sales_count',$data);
		}
		$this->load->view('sales/sales_chart_sales_count1');
		foreach ( $city->result() as $row )
		{
			$data['city_id'] = $row->id;
			$data['prev_week_count'] = $this->sales_model->get_sales_prevweek($data['city_id']);
			$this->load->view('sales/sales_chart_sales_count2',$data);
		}
		$this->load->view('sales/revenue_head');
		
		foreach ( $city->result() as $row )
		{
			$data['city'] = $row->name;
			$this->load->view('sales/revenue_chart_city',$data);
		}
		$this->load->view('sales/revenue_chart_revenue',$data);
			
		foreach ( $city->result() as $row )
		{
			$data['city_id'] = $row->id;
			$data['this_week_count'] = $this->sales_model->get_sales_thisweek($data['city_id']);
			$this->load->view('sales/revenue_chart_revenue_count',$data);
		}
		$this->load->view('sales/revenue_chart_revenue_count1');
		foreach ( $city->result() as $row )
		{
			$data['city_id'] = $row->id;
			$data['prev_week_count'] = $this->sales_model->get_sales_prevweek($data['city_id']);
			$this->load->view('sales/revenue_chart_revenue_count2',$data);
		}
		
		$this->load->view('sales/sales_add',$data);
		$this->load->view('layout/footer');
    }
	
	function add_sales() {
		$codes = $this->input->post('items');
		$emails = $this->input->post('email');
		$phones = $this->input->post('phone');
		
		$count = $this->sales_model->make_sale($this->session->userdata('id'), $codes, $emails, $phones);

		$this->session->set_flashdata("success", "Saved details of $count sales");
		redirect("sales/sales_view");
	}
	
	function leaderboard()
	{
		$value = $_REQUEST['value'];
		//$linkCount = $this->sales_model->get_cityCount($value);
		//$data['linkCounter'] = ceil($linkCount/PAGINATION_CONSTANT);
		//$data['currentPage'] = $page_no;
		$data['value'] = $value;
		$this->load->view('sales/leaderboard_head');
		$data['details'] = $this->sales_model->get_cityNames();
		$data['slno'] = 1;
		foreach($data['details']->result_array() as $row):
			
			$data['city_id'] = $row['id'];
			$data['city_name'] = $row['name']; 
			$data['sales'] = $this->sales_model->get_salesCount($data['city_id'],$value);
			$this->load->view('sales/leaderboard',$data);
			$data['slno']++;
		endforeach;
        
	}
	
	function leaderboard_wk()
	{
		$this->load->view('sales/leaderboard_head');
		$data['details'] = $this->sales_model->get_cityNames();
		$data['slno'] = 1;
		foreach($data['details']->result_array() as $row):
			
			$data['city_id'] = $row['id'];
			$data['city_name'] = $row['name']; 
			$data['sales'] = $this->sales_model->get_salesCountWk($data['city_id']);
			$this->load->view('sales/leaderboard',$data);
			$data['slno']++;
		endforeach;
        
	}
	
	function plot_sales_graph()
	{
		$this->load->view('sales/sales_head');
		$city = $this->sales_model->get_city();
		
		foreach ( $city->result() as $row )
		{
			$data['city'] = $row->name;
			$this->load->view('sales/sales_chart_city',$data);
		}
		$this->load->view('sales/sales_chart_sales',$data);
			
		foreach ( $city->result() as $row )
		{
			$data['city_id'] = $row->id;
			$data['this_week_count'] = $this->sales_model->get_sales_thisweek($data['city_id']);
			$this->load->view('sales/sales_chart_sales_count',$data);
		}
		$this->load->view('sales/sales_chart_sales_count1');
		foreach ( $city->result() as $row )
		{
			$data['city_id'] = $row->id;
			$data['prev_week_count'] = $this->sales_model->get_sales_prevweek($data['city_id']);
			$this->load->view('sales/sales_chart_sales_count2',$data);
		}
		$this->load->view('sales/sales_graph_footer');
		
	}
	
	
}
