<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends Controller {
   	function Api() {
        parent::Controller();
		$this->load->model('product_model');
	}
	
	
	function get_tee_list() {
		header("Content-type: text/json");
		$all_designs = $this->product_model->get_designs_by_product(1);
		
		$gender = array('m'=>'Male','f'=>'Female');
		$size = array('S'=>'Small','M'=>'Medium','L'=>'Large','XL'=>'Extra Large');
		$data = array();
		foreach($all_designs as $design) {
			$all_items = $this->product_model->get_items_by_design($design->id);
			
			
			foreach($all_items as $item) {
				$data['tee'.$item->code] = array(
					'title'	=> $design->name,
					'by'	=> '',
					'story' => '',
					'color'	=> $item->color,
					'size'	=> $item->size,
					'gender'=> $gender[$item->sex],
					'price'	=> $item->price,
					'image'	=> $design->img_name,
					'stock'	=> 10,
				);
			}
		}
		
		print json_encode($data);
		
	}


}
