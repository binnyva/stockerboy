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
class Dashboard extends Controller  {
    function Dashboard() {
        parent::Controller();
		$this->load->library('session');
        $this->load->library('user_auth');
		$logged_user_id = $this->user_auth->logged_in();
		if(!$logged_user_id) {
			redirect('auth/login');
		}
		
		$this->load->helper('url');
        $this->load->helper('form');
    }
	
    /**
    * Function to dashboard
    * @author : Rajesh
    * @param  : []
    * @return : type : []
    **/
    function dashboard_view() {	
		$data['title'] = 'Stocker Boy | Dashboard';
		$this->load->model('Report_Model', 'report_model');
		
		$this->load->view('layout/header',$data);
		
		$data['total_sales'] = $this->report_model->total_sales_this_week();
		$data['total_sales_last_week'] = $this->report_model->total_sales_last_week();
		$data['total_revenue'] = $this->report_model->total_revenue_this_week();
		$data['total_revenue_last_week'] = $this->report_model->total_revenue_last_week();
		$data['total_finance'] = $this->report_model->total_finance_this_week();
		$data['total_finance_last_week'] = $this->report_model->total_finance_last_week();
		$data['leaderboard_sale'] = $this->report_model->leaderboard_sale();
		
		$this->load->view('dashboard/dashboard', $data);
		$this->load->view('layout/footer');
    }
}
