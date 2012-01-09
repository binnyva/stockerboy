<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Revenue extends Controller  {
    function Revenue() {
        parent::Controller();
		$this->load->model('revenue_model');
		$this->load->library('session');
        $this->load->library('user_auth');
        $logged_user_id = $this->user_auth->logged_in();
		if(!$logged_user_id) {
			redirect('auth/login');
		}
		
		$this->load->helper('url');
        $this->load->helper('form');
    }
	
	function index()
	{
		$user_type = $this->session->userdata('type');
		if($user_type == 'city') redirect('revenue/show_pending');
		
		
		$pending = $this->revenue_model->get_pending_payments();
		$sent_payments = $this->revenue_model->get_sent_payments();

		$this->load->view('layout/header',array('title'=>'Stocker Boy | Revenue | Amount Pending'));
		$this->load->view('revenue/index', array('pending'=>$pending, 'sent_payments'=>$sent_payments));
		$this->load->view('layout/footer');
	}
	
	function city_revenue() {
		$city_id = $this->session->userdata('city_id');
		
		$pending = $this->revenue_model->get_city_pending_payments($city_id);
		$sent_payments = $this->revenue_model->get_city_sent_payments($city_id);

		$this->load->view('layout/header',array('title'=>'Stocker Boy | Revenue | Pending Amount'));
		$this->load->view('revenue/city_revenue', array('pending'=>$pending, 'sent_payments'=>$sent_payments));
		$this->load->view('layout/footer');
	}
	
	function make_payment($revenue_id) {
		$revenue = $this->revenue_model->get_revenue_info($revenue_id);
		$city_id = $this->session->userdata('city_id');
		$user_id = $this->session->userdata('id');
		
		if($this->input->post('amount')) {
			if($revenue->amount_to_pay < $this->input->post('amount')) {
				$this->session->set_flashdata('error', 'You don\'t have to pay more than '.$revenue->amount_to_pay);
				redirect('revenue/make_payment/'.$revenue_id);
			}
			
			$this->revenue_model->make_payment($revenue_id, $city_id, $user_id, $this->input->post('amount'));
			
			$this->session->set_flashdata("success", "Payment sent.");
			redirect("revenue/city_revenue");
		}
		
		$this->load->view('layout/header',array('title'=>'Stocker Boy | Revenue | Pending Amount'));
		$this->load->view('revenue/make_payment', array('revenue'=>$revenue));
		$this->load->view('layout/footer');
	}
	
	function payment_received($payment_id) {
		$this->revenue_model->set_received($payment_id);
		$this->session->set_flashdata('success', 'Payment marked as "Received"');
		redirect('revenue/index');
	}
	
	function payment_failed($payment_id) {
		$this->revenue_model->set_failed($payment_id);
		$this->session->set_flashdata('success', 'Payment marked as "Failed"');
		redirect('revenue/index');
	}
}
