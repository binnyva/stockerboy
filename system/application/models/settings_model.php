<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 * An open source application development framework for PHP 4.3.2 or newer
 * @package		madapp
 * @author		Rabeesh
 */
class Settings_model extends Model {
    function Settings_model() {
        // Call the Model constructor
        parent::Model();
        $this->ci = &get_instance();
    }
    /**
    * Function to getsettings
    * @author : Rabeesh
    * @param  : [$data]
    * @return : type: [Array]
    **/
    function getsettings() {
    	$settings = $this->db->orderby('name')->get('setting')->result();
    	return $settings;
    }
    /**
    * Function to addsetting
    * @author : Rabeesh
    * @param  : [$data]
    * @return : type: [Array]
    **/
    function addsetting($data) {
		$success = $this->db->insert('setting', 
			array(
				'name'			=>	$data['name'], 
				'value'	=>	$data['value'],
				'data'		=>	$data['data'],
			));
		return ($this->db->affected_rows() > 0 )? true :false;
		
    }
    /**
    * Function to editsetting
    * @author : Rabeesh
    * @param  : [$data]
    * @return : type: [Array]
    **/
    function editsetting($data,$settings_id) {
    	$this->db->where('id', $settings_id)->update('setting', $data);
		return ($this->db->affected_rows() > 0 )? true :false;
    }

	function get_settings($setting_id) {
    	return $this->db->where('id',$setting_id)->get('setting')->row_array();
    }
     /**
    * Function to deletesetting
    * @author : Rabeesh
    * @param  : [$data]
    * @return : type: [Array]
    **/
	function deletesetting($id)
	{
		$this->db->where('id', $id)->delete('setting');
	}
	
	function get_setting_value($name) {
		$setting = $this->db->where('name', $name)->get('setting')->row();
		
		return ($setting->value) ? $setting->value : $setting->data;
	}	
}
