<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 * An open source application development framework for PHP 4.3.2 or newer
 
 * @package		Stockerboy
 * @author		Rajesh
 * @copyright	Copyright (c) 2008 - 2010, OrisysIndia, LLP.
 * @link		http://orisysindia.com
 * @since		Version 1.0
 * @filesource
 */

class Sales_model extends Model {

    function Sales_model() {
        parent::Model();
        $this->ci = &get_instance();
       //$this->city_id = $this->ci->session->userdata('city_id');
        //$this->project_id = $this->ci->session->userdata('project_id');
    }
	
	function get_items()
	{
		$this->db->select('*');
        $this->db->from('item');
		$this->db->order_by("code", "asc");
        $result = $this->db->get();
		return $result;
	}
	
	function addsales($data)
	{
		$salesInfo = array( 'item_id'  => $data['item_code'],
							'sold_by_user_id'  => $data['user_id'],
							'city_id'  => $data['city_id'],
							'approved'  => '1',
							'approved_by_user_id'  => $data['user_id'],
							'email'  => $data['email'],
							'phone_number'  => $data['phone']
								 );
								   
		$this->db->set($salesInfo);
		$this->db->insert('sale');
						
		return ($this->db->affected_rows() > 0) ? $this->db->insert_id(): false ;
	}
	
	function get_city()
	{
		$this->db->select('*');
        $this->db->from('city');
		$this->db->order_by("name", "asc");
        $result = $this->db->get();
		return $result;
	}
	
	function get_sales_thisweek($city_id)
	{
			$date = date('Y-m-d');
			$ts = strtotime($date);
			$dow = date('w', $ts);
			$offset = $dow - 1;
			if ($offset < 0) $offset = 6;
			$ts = $ts - $offset*86400;
			$count = 0;
			$no = 0;
			for ($i = 0; $i < 7; $i++, $ts += 86400)
			{
				$dt = date("Y-m-d", $ts);
			
				$this->db->select('*');
				$this->db->from('sale');
				$this->db->where('city_id',$city_id);
				$this->db->like('sale_on',$dt);
				$counts = $this->db->get();
				$count = count($counts->result());
				$no = $no + $count;
				
			}
		return $no;
        
			
		//return count($count->result());
		
	}
	
	function get_sales_prevweek($city_id)
	{
		$dt = date('Y-m-d');
		$date = strtotime ( '-1 week' , strtotime ( $dt ) ) ;
		
		$ts = strtotime($date);
		$dow = date('w', $ts);
		$offset = $dow - 1;
		if ($offset < 0) $offset = 6;
		$ts = $ts - $offset*86400;
		$count = 0;
		$no = 0;
		for ($i = 0; $i < 7; $i++, $ts += 86400)
		{
			$dt = date("Y-m-d", $ts);
			$this->db->select('*');
			$this->db->from('sale');
			$this->db->where('city_id',$city_id);
			$this->db->like('sale_on',$dt);
			
			$counts = $this->db->get();
			$count = count($counts->result());
			$no = $no + $count;
		}
		return $no;
	}
	
	function get_cityCount($value)
	{
		$this->db->select('*');
		$this->db->from('city');
		$this->db->order_by("name", "asc");
		
				
		$count = $this->db->get();	
		return count($count->result());	
		
	}
	
	function get_cityNames()
	{
		$this->db->select('*');
		$this->db->from('city');
		$this->db->order_by("name", "asc");

		$content = $this->db->get();
		return $content;	
			
	}
	
	function get_salesCount($city_id,$value)
	{
		$this->db->select('*');
		$this->db->from('sale');
		$this->db->where('city_id',$city_id);
		if($value == 1)
		{
			$this->db->like('sale_on',date('Y-m-d'));
		}
		elseif($value == 2)
		{
			$ydy = date("Y-m-d", mktime(0, 0, 0, date("m"),date("d")-1,date("Y")));
			$this->db->like('sale_on',$ydy);
		}
		
			
		$count = $this->db->get();	
		return count($count->result());
	}
	
	function get_salesCountWk($city_id)
	{
		$date = date('Y-m-d');
			$ts = strtotime($date);
			$dow = date('w', $ts);
			$offset = $dow - 1;
			if ($offset < 0) $offset = 6;
			$ts = $ts - $offset*86400;
			$count = 0;
			$no = 0;
			for ($i = 0; $i < 7; $i++, $ts += 86400)
			{
				$dt = date("Y-m-d", $ts);
			
				$this->db->select('*');
				$this->db->from('sale');
				$this->db->where('city_id',$city_id);
				$this->db->like('sale_on',$dt);
				$counts = $this->db->get();
				$count = count($counts->result());
				$no = $no + $count;
				
			}
		return $no;
	}
}