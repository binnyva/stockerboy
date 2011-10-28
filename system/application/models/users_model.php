<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 * An open source application development framework for PHP 4.3.2 or newer
 
 * @package		MadApp
 * @author		Rabeesh
 * @copyright	Copyright (c) 2008 - 2010, OrisysIndia, LLP.
 * @link		http://orisysindia.com
 * @since		Version 1.0
 * @filesource
 */

class Users_model extends Model {

    function Users_model() {
        parent::Model();
        $this->ci = &get_instance();
        $this->city_id = $this->ci->session->userdata('city_id');
        $this->project_id = $this->ci->session->userdata('project_id');
    }
    
    /**
    * Function to login
    * @author:Rabeesh 
    * @param :[$data]
    * @return: type: [Boolean, Array()]
    **/
	
	function login($data) {
      	$username= $data['username'];
        $password = $data['password'];
		
		$query = $this->db->where('email', $username)->where('password',$password)->where('status','1')->get("user");
        if($query->num_rows() > 0) {
			$user = $query->first_row();
   			$memberCredentials['id'] = $user->id;
			$memberCredentials['email'] = $user->email;
			$memberCredentials['name'] = $user->name;
			$memberCredentials['city_id'] = $user->city_id;
			$memberCredentials['type'] = $user->type;
			//$memberCredentials['permissions'] = $this->get_user_permissions($user->id);
			//$memberCredentials['groups'] = $this->get_user_groups($user->id);
			
            return $memberCredentials;
        
        } else {
           return false;
        }
    }
	
	
	function search_users($data) {
		$this->db->select('user.id,user.name,user.email,user.password,user.phone, city.name as city_name');
		$this->db->from('user');
		$this->db->join('city', 'city.id = user.city_id' ,'left');
		
		if(!isset($data['status'])) $data['status'] = 1;
		if($data['status'] !== false) $this->db->where('user.status', $data['status']); // Setting status as 'false' gets you even the deleted users
		
		
		if(isset($data['city_id']) and $data['city_id'] != 0) $this->db->where('user.city_id', $data['city_id']);
		else if(!isset($data['city_id'])) $this->db->where('user.city_id', $this->city_id);
		
		if(!empty($data['name'])) $this->db->like('user.name', $data['name']);
		if(!empty($data['phone'])) $this->db->where('user.phone', $data['phone']);
		if(!empty($data['email'])) $this->db->where('user.email', $data['email']);
		
		$this->db->orderby('user.name');
		
		$all_users = $this->db->get()->result();
		
		return $all_users;
	}
	
	function get_users_city($user_id) {
		return $this->db->select('city_id')->from('user')->where(array('id'=>$user_id))->get()->row()->city_id;
	}
	
	function get_user_type($user_id) {
		return $this->db->select('type')->from('user')->where(array('id'=>$user_id))->get()->row()->type;
	}
	
	function get_user($user_id) {
		return $this->db->select('type')->from('user')->where(array('id'=>$user_id))->get()->row();
	}
}
