<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Revenue_model extends Model {
    function Revenue_model() {
        parent::Model();
       
    }
    
    function get_new_sales() {
		$this->db->select('sale.*,item.price');
        $this->db->from('sale');
		$this->db->join('item', 'sale.item_id = item.id' ,'join');
		$this->db->where('sale.added_to_revenue','0');
        $result = $this->db->get();
        
        // Make sure its not added again.
        $this->db->where('added_to_revenue','0')->update('sale', array('added_to_revenue'=>'1'));
		return $result->result();
    }
    

	function add_revenue($city_id, $amount)
	{
		$revenueInfo = array( 'amount'  		=> $amount,
							  'amount_to_pay'  	=> $amount,
							  'city_id'  		=> $city_id,
							  'paid'  			=> '0',
							  'added_on'		=> date('Y-m-d H:i:s'),
								 );
		$this->db->set($revenueInfo);
		$this->db->insert('revenue');
						
		return ($this->db->affected_rows() > 0) ? $this->db->insert_id(): false ;
	}
	
	
	function get_pending_payments() {
		$data = $this->db->select('revenue.*, city.name')->from('revenue')->join('city', 'revenue.city_id = city.id', 'inner')->where('paid','0')->get();
		if($data) return $data->result();
		return array();
	}
	
	function get_sent_payments() {
		$data = $this->db->select('payment.*, city.name')->from('payment')->join('city', 'payment.city_id = city.id', 'inner')->get();
		if($data) return $data->result();
		return array();
	}
	
	function get_city_pending_payments($city_id) {
		$data = $this->db->from('revenue')->where('paid','0')->where('city_id',$city_id)->get();
		if($data) return $data->result();
		return array();
	}

	function get_city_sent_payments($city_id) {
		$data = $this->db->from('payment')->where('city_id',$city_id)->get();
		if($data) return $data->result();
		return array();
	}
	
	function make_payment($revenue_id, $city_id, $user_id, $amount) {
		$this->db->insert('payment', array(
			'revenue_id'	=> $revenue_id,
			'amount_paid'	=> $amount,
			'city_id'		=> $city_id,
			'paid_by_user_id'=>$user_id,
			'paid_on'		=> date('Y-m-d H:i:s'),
			'status'		=> 'transit'
		));
	}
	
	function get_revenue_info($revenue_id) {
		$data = $this->db->from('revenue')->where('id',$revenue_id)->get();
		if($data) return $data->row();
		return array();
	}
	
	
	function set_received($payment_id) {
		$this->db->where('id',$payment_id)->update('payment', array('status'=>'received'));
		$payment_info = $this->db->from('payment')->where('id',$payment_id)->get();
		$payment = $payment_info->row();
		
		if($payment) {
			$revenue = $this->get_revenue_info($payment->revenue_id);
			
			$amount_to_pay = $revenue->amount_to_pay - $payment->amount_paid;
			$paid = ($amount_to_pay == 0) ? '1' : '0';
			
			$this->db->where('id', $payment->revenue_id)->update('revenue', array(
				'amount_to_pay'	=> $amount_to_pay,
				'paid'			=> $paid,
				'paid_on'		=> date('Y-m-d H:i:s')
			));
		}
	}
	
	function set_failed($payment_id) {
		$this->db->where('id',$payment_id)->update('payment', array('status'=>'failed')); // :-(
	}
	
}
