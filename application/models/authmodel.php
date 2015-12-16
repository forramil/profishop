<?php

class Authmodel extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
	function verify_user($login, $password) {
		$q = $this	->db
					->where('ulogin', $login)
					->where('upassword', $password)
					->limit(1)
					->get('users');
		if( $q->num_rows > 0 ){
			return $q->row();
		}
		return false;
	}
	
	function status_user($login, $password) {
		$q = $this	->db
					->where('ulogin', $login)
					->where('upassword', $password)
					->where('status', '1')
					->limit(1)
					->get('users');
		if( $q->num_rows > 0 ){
			return true;
		}
		return false;
	}
	
	function info() {
		$this->db->where('guid', $this->session->userdata('guid'));
		$user = $this->db->get('users');
		if($user->num_rows() > 0) {
			return $user->row(); }
		else $this->session->sess_destroy();
			redirect('/');
	}
	
	function user_data($login) {
        return $this->db->get_where('users',array('ulogin' => $login))->row();
    }
	
	function user_data_guid($guid) {
        return $this->db->get_where('users',array('guid' => $guid))->row();
    }
	
	function settings($option) {
		$this->db->where('siteoption', $option);
		$description = $this->db->get('settings')->row();
		return $description->description;
	}
	
	function manager($guid) {
	$users = $this->db->query('SELECT u.ulogin, u.upassword, u.guid, u.fulle_name, u.ur_address, m.manager_guid FROM user_manager m INNER JOIN users u ON m.user_guid=u.guid WHERE m.manager_guid="'.$guid.'" GROUP by u.guid')->result();
	return $users;
	}
	
	function check_manager($guid, $manager) {
		return $this->db->get_where('user_manager',array('user_guid' => $guid,'manager_guid' => $manager))->num_rows();
	}
	
	function new_password($chars_min=6, $chars_max=8, $use_upper_case=false, $include_numbers=false, $include_special_chars=false)
    {
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if($include_numbers) {
            $selection .= "1234567890";
        }
        if($include_special_chars) {
            $selection .= "!@\"#$%&[]{}?|";
        }

        $password = "";
        for($i=0; $i<$length; $i++) {
            $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];            
            $password .=  $current_letter;
        }                

        return $password;
    }
	
	function password_update($guid, $password) {
		return $this->db->query('UPDATE users SET upassword="'.$password.'" WHERE guid="'.$guid.'"');
	}
	
}