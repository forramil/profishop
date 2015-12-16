<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    function is_login() {
        $CI =& get_instance();
        
		$CI->load->model("Authmodel");
		
		$username = $CI->session->userdata('login');
		$userhash = $CI->session->userdata('hash');
		
		if($username == '' || $userhash == '')
		{
			return 0;	
		}
		else
		{
			$userdata  = $CI->Authmodel->user_data($username);                
    		$hash_db  = md5($userdata->upassword.$CI->config->item('password_hash'));
			
			if( $userhash != $hash_db ) {
				return 0;
			} else {
				return 1;
			}
		}
	}
	
	function num_users() {
        $CI =& get_instance();
        
		// $users = $CI->db->query('SELECT count(session_id) as number FROM sessions WHERE last_activity >= UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 3 MINUTE)) AND user_data LIKE "%guid%"')->row();
		$users = $CI->db->query('SELECT count(session_id) as number FROM sessions WHERE user_data LIKE "%guid%"')->row();
		
		return $users->number;
	}
    
?>