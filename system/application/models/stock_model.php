<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stock_model extends Model {

    function Stock_model() {
        parent::Model();
        $this->ci = &get_instance();
        $this->city_id = $this->ci->session->userdata('city_id');
        $this->user_id = $this->ci->session->userdata('id');
    }
	
	function add_stock($item_id, $amount, $city_id) {
		// See if the item is already there in the stock...
		$stock = $this->db->from('stock')->where(array('city_id'=>$city_id, 'item_id'=>$item_id))->row();
		
		if($stock) { // Stock exists. Update the row instead of inserting.
			$this->db->where('id',$stock->id)->update('stock', array('city_id'=>$city_id, 'item_id'=>$item_id));
			$stock_id = $stock->id;
			
		} else { // No such stock exists - insert it.
			$this->db->insert('stock', array(
				'city_id'	=> $city_id,
				'item_id'	=> $item_id,
				'amount'	=> $amount
			));
			$stock_id = $this->db->insert_id();
		}
		
		return $stock_id;
	}
	
	function dispatch($user_id, $city_id, $to_city_id, $estimated_delivery_on, $courier_number, $items) {
		$this->db->insert('transit', array(
			'from_city_id'	=> $city_id,
			'sent_by_user_id'=>$user_id,
			'to_city_id'	=> $to_city_id,
			'left_on'		=> date('Y-m-d H:i:s'),
			'courier_number'=> $courier_number,
			'estimated_delivery_on'=>$estimated_delivery_on
		));
		$transit_id = $this->db->insert_id();

		// Add items to the 'transit_item' table
		foreach($items as $item_id => $amount) {
			// Update 'stock' table
			$current_amount = $this->db->where(array('city_id'=>$city_id, 'item_id'=>$item_id))->get('stock')->row(); // First get current number of this item in the starting city.
			if($current_amount) {
				$current_amount = $current_amount->amount;
			
				if($current_amount - $amount >= 0) { // We have enough stock to make the delivery
					$current_amount = $current_amount - $amount;
				} else { // If not, empty the stock and transfer it.
					$amount = $current_amount;
					$current_amount = 0;
				}
				// Update the stock count.
				$this->db->update('stock', array('amount'=>$current_amount), array('city_id'=>$city_id, 'item_id'=>$item_id));
				
				// Now, put the items in the 'tansit_item' table...
				$this->db->insert('transit_item', array(
					'transit_id'	=> $transit_id,
					'item_id'		=> $item_id,
					'amount'		=> $amount
				));
			}
		}
		
		return $transit_id;
	}
	
	function get_all($city_id) {
		return $this->db->query("SELECT stock.id, item.code, stock.amount FROM stock INNER JOIN item ON stock.item_id=item.id WHERE stock.city_id=$city_id")->result();
	}
	
	function get_all_transits($city_id, $status='') {
		if($status == 'transit') $transit_status = "transit.status='transit'";
		else $transit_status = "transit.status != 'transit'";
		
		return $this->db->query("SELECT transit.id, transit.to_city_id, transit.from_city_id, transit.estimated_delivery_on, transit.reached_on, SUM(transit_item.amount) AS amount, transit.status
			FROM transit INNER JOIN transit_item ON transit_item.transit_id=transit.id 
			WHERE transit.to_city_id=$city_id AND $transit_status
			GROUP BY transit_item.transit_id")->result();
	}
	
	function get_transit($transit_id) {
		return $this->db->from('transit')->where('id', $transit_id)->get()->row();
	}
	
	function get_transit_items($transit_id) {
		return $this->db->query("SELECT item.code, transit_item.amount FROM transit_item INNER JOIN item ON transit_item.item_id=item.id WHERE transit_item.transit_id=$transit_id")->result();
	}
	
	function set_received($transit_id) {
		$this->db->where('id', $transit_id)->update('transit', array('status'=>'received', 'reached_on'=>date('Y-m-d H:i:s'), 'recived_by_user_id'=>$this->user_id));
	}
	
	function set_failed($transit_id) {
		$this->db->where('id', $transit_id)->update('transit', array('status'=>'failed', 'recived_by_user_id'=>$this->user_id));
	}
}
