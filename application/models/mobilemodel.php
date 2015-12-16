<?php

class Mobilemodel extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
	
	function settings($option) {
		$this->db->where('siteoption', $option);
		$description = $this->db->get('settings')->row();
		return $description->description;
	}
	
}