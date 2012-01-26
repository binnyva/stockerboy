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
		$this->load->view('sales/sales_add',$data);
		$this->load->view('layout/footer');
    }
    
    function report() {
		$data['title'] = 'Stocker Boy | Sales Report';
		$this->load->view('layout/header',$data);
		
		$city_id = $this->session->userdata('city_id');
		$user_type = $this->session->userdata('type');
		
		if($user_type == 'national') {
		$this->load->view('sales/report_header',$data);
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
		}
		$data['user_type'] = $user_type;
		$data['city_id'] = $city_id;
		
		if($user_type == 'national') $city_id = 0;
		$data['weekly_sales'] = $this->sales_model->get_weekly_sales_data($city_id);
		
		$this->load->view('sales/report', $data);
		$this->load->view('layout/footer');
    }
    
    function sales_report($from, $to) {
		$data['title'] = 'Stocker Boy | Sales Report';
		$this->load->view('layout/header',$data);
		
		$data['from'] = $from;
		$data['to'] = $to;
		$data['city_sales'] = $this->sales_model->get_city_sales_data($from, $to);
		
		$this->load->view('sales/sales_report', $data);
		$this->load->view('layout/footer');
    }
    
    function sales_report_city($city_id, $from, $to) {
		$data['title'] = 'Stocker Boy | Sales Report';
		$this->load->view('layout/header',$data);
		
		$data['from'] = $from;
		$data['to'] = $to;
		$data['sales_data'] = $this->sales_model->get_city_week_sales_data($city_id, $from, $to);
		
		$this->load->view('sales/sales_report_city', $data);
		$this->load->view('layout/footer');
    }
	
	function add_sales() {
		$codes = $this->input->post('items');
		$emails = $this->input->post('email');
		$phones = $this->input->post('phone');
		
		$message = $this->sales_model->make_sale($this->session->userdata('id'), $codes, $emails, $phones);
		
		if($message['success']) $this->session->set_flashdata("success", "Saved details of $message[success] sales.");
		if($message['error']) $this->session->set_flashdata('error', implode('<br />', $message['error']));

		redirect("sales/sales_view");
	}
	
	function leaderboard()
	{
		$value = $_REQUEST['value'];
		$data['value'] = $value;
		$this->load->view('sales/leaderboard_head');
		$data['details'] = $this->sales_model->get_cityNames();
		$data['slno'] = 1;
		foreach($data['details']->result_array() as $row) {
			$data['city_id'] = $row['id'];
			$data['city_name'] = $row['name']; 
			$data['sales'] = $this->sales_model->get_salesCount($data['city_id'],$value);
			$this->load->view('sales/leaderboard',$data);
			$data['slno']++;
		}
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
		$this->load->view('sales/report_header');
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
