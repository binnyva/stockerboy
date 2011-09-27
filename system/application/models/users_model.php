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
		
		$query = $this->db->where('email', $username)->where('password',$password)->where('status','1')->get("User");
        if($query->num_rows() > 0) {
			$user = $query->first_row();
   			$memberCredentials['id'] = $user->id;
			$memberCredentials['email'] = $user->email;
			$memberCredentials['name'] = $user->name;
			$memberCredentials['city_id'] = $user->city_id;
			//$memberCredentials['permissions'] = $this->get_user_permissions($user->id);
			//$memberCredentials['groups'] = $this->get_user_groups($user->id);
			
            return $memberCredentials;
        
        } else {
           return false;
        }
    }
	
	
	function search_users($data) {
		$this->db->select('User.id,User.name,User.email,User.password,User.phone, City.name as city_name');
		$this->db->from('User');
		$this->db->join('City', 'City.id = User.city_id' ,'left');
		
		
		if(!isset($data['status'])) $data['status'] = 1;
		if($data['status'] !== false) $this->db->where('User.status', $data['status']); // Setting status as 'false' gets you even the deleted users
		
		
		if(isset($data['city_id']) and $data['city_id'] != 0) $this->db->where('User.city_id', $data['city_id']);
		else if(!isset($data['city_id'])) $this->db->where('User.city_id', $this->city_id);
		
		if(!empty($data['name'])) $this->db->like('User.name', $data['name']);
		if(!empty($data['phone'])) $this->db->where('User.phone', $data['phone']);
		if(!empty($data['email'])) $this->db->where('User.email', $data['email']);
		
		
		$this->db->orderby('User.name');
		
		$all_users = $this->db->get()->result();
		//echo $this->db->last_query();

		$return = array();
		/*foreach($all_users as $user) {
			// Get the batches for this User. An user can have two batches. That's why I don't do join to get this date.
			//$user->batches = colFormat($this->db->where('user_id',$user->id)->get('UserBatch')->result_array()); // :SLOW:
			
			// Gets the UserGroup of the users...
			if(!empty($data['get_user_groups'])) $user->groups = $this->get_user_groups_of_user($user->id);
			
			$return[$user->id] = $user;
		}*/
		return $return;
	}

}