<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_api extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		/*if(is_login() == 0) {
			unset($_SERVER['PHP_AUTH_USER']); 
			unset($_SERVER['PHP_AUTH_PW']);  
		}*/
		if($this->Authmodel->verify_user($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) == FALSE) {
			header('WWW-Authenticate: Basic realm="Auth"');
			header('HTTP/1.0 401 Unauthorized');
			echo 'Ошибка авторизации';
			exit;
		} else {
			$userdata = $this->Authmodel->verify_user($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);
			$session_data = array(
				"login"   => $_SERVER['PHP_AUTH_USER'],
				"guid"   => $userdata->guid,
				"type_price" =>  $userdata->type_guid,
				"hash" => md5($userdata->upassword.$this->config->item('password_hash'))
			);
			$this->session->set_userdata($session_data);
			return;
		} 
	}
	
	function index() {
		$data['version'] = '1.0';
		$this->load->view('customer_api', $data);
    }
	
	private function error($text) {
		$this->output->set_status_header('500');
		$this->output->set_header('Content-Type: text/html; charset=utf-8'); 
		exit($text);
	}
	
	function order() {
		$this->load->model('Cart_model');
		if($this->input->get('status', TRUE) == 'completed') {
			$this->load->model('Cart_model');
			$this->Cart_model->add_order($this->input->get('comment'));
			$this->output->set_output('ОК');
		} else {
		if($this->input->get('articule', TRUE) == NULL) $this->error('Отсутствует параметр articule');
		if($this->input->get('num', TRUE) == NULL) $this->error('Отсутствует параметр num');
		
		$product = $this->db->get_where('products', array('articule'=>$this->input->get('articule')))->row();
		$this->Cart_model->add($product->guid, $this->input->get('num'));
		$this->output->set_output('ОК');
		}
	}
	
	function info() {
			$order = $this->db->query('SELECT p.articule, p.name, o.price_rur/o.number as price, o.number FROM order_products o LEFT JOIN products p ON o.product_guid=p.guid WHERE o.order_id=0 AND o.user_guid="'.$this->session->userdata('guid').'"')->result_array();
			$this->output->set_header('Content-Type: application/json; charset=utf-8');
			$this->output->set_output(json_encode($order));
	}
}