<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->config->load('api', TRUE);
		$username = $this->config->item('api_name', 'api');
		$password= $this->config->item('api_pass', 'api');
		if (isset($_SERVER['PHP_AUTH_USER']) AND $_SERVER['PHP_AUTH_USER'] == $username AND $_SERVER['PHP_AUTH_PW'] == $password) {
			return;
		} else {
			header('WWW-Authenticate: Basic realm="Auth"');
			header('HTTP/1.0 401 Unauthorized');
			echo 'Ошибка авторизации';
			exit;
		} 
	}
	
	function index() {
		$data['version'] = '1.3';
		$this->load->view('api', $data);
    }
	
	private function error($text) {
		$this->output->set_status_header('500');
		$this->output->set_header('Content-Type: text/html; charset=utf-8'); 
		exit($text);
	}
	
	/* Currency */	
	function add_currency() {
		if($this->input->get('name', TRUE) == NULL) $this->error('Отсутствует параметр name');
		if($this->input->get('rate', TRUE) == NULL) $this->error('Отсутствует параметр rate');
		if($this->input->get('guid', TRUE) == NULL) $this->error('Отсутствует параметр guid');
		$test = $this->db->get_where('currency', array('guid' => $this->input->get('guid')));
		if($test->num_rows() >0) {
			$data = array(
				'name' => $this->input->get('name'),
				'rate' => $this->input->get('rate')
			);
		$this->db->where('guid', $this->input->get('guid'));
		$this->db->update('currency', $data);
		$this->output->set_output('ОК');	
		} else {
			$data = array(
				'name' => $this->input->get('name'),
				'rate' => $this->input->get('rate'),
				'guid' => $this->input->get('guid')
			);
			
			$this->db->insert('currency', $data); 
			$this->output->set_output('ОК');	
		}
	}
	
	function currency() {
	if($this->input->get('guid', TRUE) != NULL) {
		$result = $this->db->query('SELECT name, rate, guid FROM currency WHERE guid="'.$this->input->get('guid').'"')->row_array();
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		$this->output->set_output(json_encode($result));
	}  else {
		$result = $this->db->query('SELECT name, rate, guid FROM currency')->result_array();
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		$this->output->set_output(json_encode($result));
	}
	}
	
	function del_currency() {
	if($this->input->get('guid', TRUE) != NULL AND $this->input->get('guid', TRUE) != 'all') {
		$this->db->delete('currency', array('guid' => $this->input->get('guid'))); 
		$this->output->set_output('currency deleted');
	} else if($this->input->get('guid', TRUE) == 'all') {
		$this->db->empty_table('currency');
		$this->output->set_output('All currency deleted');
	}
	}
	/* END Currency */	
	
/* PRODUCTS */	
	function add_product() {
		if($this->input->get('name', TRUE) == NULL) $this->error('Отсутствует параметр name');
		if($this->input->get('category', TRUE) == NULL) $this->error('Отсутствует параметр category');
		if($this->input->get('guid', TRUE) == NULL) $this->error('Отсутствует параметр guid');
		$cat = $this->db->get_where('cathegory', array('guid' => $this->input->get('category')));
		if($cat->num_rows() == 0) { $this->error('Нет категории с данным guid < '.$this->input->get('category').' >'); }
		$test = $this->db->get_where('products', array('guid' => $this->input->get('guid')));
		if($test->num_rows() >0) {
			$data = array(
				'name' => $this->input->get('name'),
				'articule' => $this->input->get('articule'),
				'category' => $cat->row()->guid,
				'status' => $this->input->get('status'),
				'unit' => $this->input->get('unit')
			);
		$this->db->where('guid', $this->input->get('guid'));
		$this->db->update('products', $data);
		$this->output->set_output('ОК');		
		} else {
				$data = array(
					'name' => $this->input->get('name'),
					'articule' => $this->input->get('articule'),
					'category' => $cat->row()->guid,
					'guid' => $this->input->get('guid'),
					'status' => $this->input->get('status'),
					'unit' => $this->input->get('unit')
				);
				
		$this->db->insert('products', $data); 
		$this->output->set_output('ОК');	
		}
	}
	
	function products() {
	if($this->input->get('guid', TRUE) != NULL) {
		$result = $this->db->query('SELECT * FROM products WHERE guid="'.$this->input->get('guid').'"')->row_array();
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		$this->output->set_output(json_encode($result));
	}  else {
		$result = $this->db->query('SELECT * FROM products')->result_array();
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		$this->output->set_output(json_encode($result));
	}
	}
	
	function del_product() {
	if($this->input->get('guid', TRUE) != NULL AND $this->input->get('guid', TRUE) != 'all') {
		$this->db->delete('products', array('guid' => $this->input->get('guid'))); 
		$this->output->set_output('Product deleted');
	} else if($this->input->get('guid', TRUE) == 'all') {
		$this->db->empty_table('products');
		$this->output->set_output('All products deleted');
	}
	}
/* END PRODUCTS */	

/* IMAGES */

	function add_image() {	
		$this->config->load('api', TRUE);
		$allow_upload = $this->config->item('allow_upload', 'api');
		if($allow_upload == TRUE) {
		if($this->input->post('product', TRUE) == NULL) $this->error('Отсутствует параметр product');
		if($this->input->post('name', TRUE) == NULL) $this->error('Отсутствует параметр name');
		if($this->input->post('guid', TRUE) == NULL) $this->error('Отсутствует параметр guid');
		$product = $this->db->get_where('products', array('guid' => $this->input->post('product')));
		if($product->num_rows() == 0) { $this->error('Нет продукта с данным guid < '.$this->input->post('product').' >'); }
	
		$encodedData = str_replace(' ','+',$this->input->post('uploadfile'));
		$decoded=base64_decode($encodedData);
		$file = uniqid() . '.png';
		file_put_contents('images/' .$file, $decoded);
		
		$test = $this->db->get_where('product_images', array('guid' => $this->input->post('guid')));
		if($test->num_rows() >0) {
			$data = array(
					'path' => $file,
					'product_guid' => $this->input->post('product'),
					'name' => $this->input->post('name')
				);
		$this->db->where('guid', $this->input->post('guid'));
		$this->db->update('product_images', $data);
		$this->output->set_output('ОК');		
		} else {
			$data = array(
					'guid' => $this->input->post('guid'),
					'path' => $file,
					'product_guid' => $this->input->post('product'),
					'name' => $this->input->post('name')
				);	
		$this->db->insert('product_images', $data); 
		$this->output->set_output('ОК');	
		}
		} else $this->error('Возможность загрузки изображений отключена');
	}
	
	function images() {
			$images = $this->db->query('SELECT * FROM product_images')->result_array();
			$this->output->set_header('Content-Type: application/json; charset=utf-8');
			$this->output->set_output(json_encode($images));
	}
	
	/* Delete all images*/
	function del_image() {
	if($this->input->get('guid', TRUE) == 'all') {
		$this->db->empty_table('product_images');
		
		if($handle = opendir('images/')) {
            while(false !== ($file = readdir($handle)))
                    if($file != "." && $file != "..") unlink('images/'.$file);
            closedir($handle);
		}
		$this->output->set_output('All images deleted');
	}
	}
	


/* END IMAGES */

/* CAT */	
	function add_category() {
		if($this->input->get('name', TRUE) == NULL) $this->error('Отсутствует параметр name');
		if($this->input->get('guid', TRUE) == NULL) $this->error('Отсутствует параметр guid');
		if($this->input->get('parent') == NULL OR $this->input->get('parent') == '0') { $parent = '0'; } else { $cat = $this->db->get_where('cathegory', array('guid' => $this->input->get('parent'))); 	if($cat->num_rows() == 0) { $this->error('Нет подкатегории с данным guid < '.$this->input->get('parent').' >'); } else { $parent=$cat->row()->guid; } }
		$test = $this->db->get_where('cathegory', array('guid' => $this->input->get('guid')));
		if($test->num_rows() >0) {
			$data = array(
				'name' => $this->input->get('name'),
				'parent' => $parent,
				'status' => $this->input->get('status')
			);
			
			$this->db->where('guid', $this->input->get('guid'));
			$this->db->update('cathegory', $data);
			$this->output->set_output('ОК');		
		} else {
			$data = array(
				'name' => $this->input->get('name'),
				'parent' => $parent,
				'guid' => $this->input->get('guid'),
				'status' => $this->input->get('status')
			);
			
			$this->db->insert('cathegory', $data); 
			$this->output->set_output('ОК');	
		}
	}
	
	function category() {
		if($this->input->get('guid', TRUE) != NULL) {
			$result = $this->db->query('SELECT * FROM cathegory WHERE guid="'.$this->input->get('guid').'"')->row_array();
			$this->output->set_header('Content-Type: application/json; charset=utf-8');
			$this->output->set_output(json_encode($result));
		}  else {
			$users = $this->db->query('SELECT * FROM cathegory')->result_array();
			$this->output->set_header('Content-Type: application/json; charset=utf-8');
			$this->output->set_output(json_encode($users));
		}
	}
	
	function del_category() {
		if($this->input->get('guid', TRUE) != NULL AND $this->input->get('guid', TRUE) != 'all') {
			$this->db->delete('cathegory', array('guid' => $this->input->get('guid'))); 
			$this->output->set_output('Cathegory deleted');
		} else if($this->input->get('guid', TRUE) == 'all') {
			$this->db->empty_table('cathegory');
			$this->output->set_output('All cathegorys deleted');
		}
	}
/* END CAT */	
	
/* USERS */
	function users() {
	if($this->input->get('guid', TRUE) != NULL) {
		$user = $this->db->query('SELECT * FROM users WHERE guid="'.$this->input->get('guid').'"')->row_array();
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		$this->output->set_output(json_encode($user));
	} else if($this->input->get('login', TRUE) != NULL) {
		$user = $this->db->query('SELECT * FROM users WHERE ulogin="'.$this->input->get('login').'"')->row_array();
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		$this->output->set_output(json_encode($user));
	} else {
		$users = $this->db->query('SELECT * FROM users')->result_array();
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		$this->output->set_output(json_encode($users));
	}
	}
	
	function password() {
		if($this->input->get('password', TRUE) == NULL) $this->error('Отсутствует параметр password');
		if($this->input->get('guid', TRUE) == NULL) $this->error('Отсутствует параметр guid');
		$data = array(
		 'upassword' => $this->input->get('password'),
		);
		$this->db->where('guid', $this->input->get('guid'));
		$this->db->update('users', $data); 
		$this->output->set_output('ОК');
	}
	
	function balance() {
		if($this->input->get('balance', TRUE) == NULL) $this->error('Отсутствует параметр balance');
		if($this->input->get('guid', TRUE) == NULL) $this->error('Отсутствует параметр guid');
		$data = array(
		 'balance' => $this->input->get('balance'),
		);
		$this->db->where('guid', $this->input->get('guid'));
		$this->db->update('users', $data); 
		$this->output->set_output('ОК');
	}
	
	function add_user() {
		if($this->input->get('login', TRUE) == NULL) $this->error('Отсутствует параметр login');
		if($this->input->get('pass', TRUE) == NULL) $this->error('Отсутствует параметр pass');
		if($this->input->get('type_of_price_guid', TRUE) == NULL) $this->error('Отсутствует параметр type_of_price_guid');
		$type = $this->db->get_where('type_of_prices', array('guid' => $this->input->get('type_of_price_guid')));
		if($type->num_rows() == 0) { $this->error('Нет типа цены с данным guid < '.$this->input->get('type_of_price_guid').' >'); }
		$test = $this->db->get_where('users', array('guid' => $this->input->get('guid')));
		if($test->num_rows() >0) {
			$data = array(
				'ulogin' => $this->input->get('login'),
				'upassword' => $this->input->get('pass'),
				'type_guid' => $type->row()->guid,
				'balance' => $this->input->get('balance'),
				'ur_address' => $this->input->get('ur_add'),
				'fact_address' => $this->input->get('fact_add'),
				'inn' => $this->input->get('inn'),
				'kpp' => $this->input->get('kpp'),
				'phone' => $this->input->get('phone'),
				'korr_schet' => $this->input->get('korr_schet'),
				'bank_name' => $this->input->get('bank'),
				'bik' => $this->input->get('bik'),
				'rasch_schet' => $this->input->get('ras_sch'),
				'contact_email' => $this->input->get('email'),
				'site' => $this->input->get('site'),
				'fulle_name' => $this->input->get('name'),
				'manager' => $this->input->get('manager'),
				'status' => $this->input->get('status')
			);
			
			$this->db->where('guid', $this->input->get('guid'));
			$this->db->update('users', $data);
			$this->output->set_output('ОК');		
		} else {
			$data = array(
				'ulogin' => $this->input->get('login'),
				'upassword' => $this->input->get('pass'),
				'guid' => $this->input->get('guid'),
				'type_guid' => $type->row()->guid,
				'balance' => $this->input->get('balance'),
				'ur_address' => $this->input->get('ur_add'),
				'fact_address' => $this->input->get('fact_add'),
				'inn' => $this->input->get('inn'),
				'kpp' => $this->input->get('kpp'),
				'phone' => $this->input->get('phone'),
				'korr_schet' => $this->input->get('korr_schet'),
				'bank_name' => $this->input->get('bank'),
				'bik' => $this->input->get('bik'),
				'rasch_schet' => $this->input->get('ras_sch'),
				'contact_email' => $this->input->get('email'),
				'site' => $this->input->get('site'),
				'fulle_name' => $this->input->get('name'),
				'manager' => $this->input->get('manager'),
				'status' => $this->input->get('status')
			);
			
			$this->db->insert('users', $data); 
			$this->output->set_output('ОК');
		}
	}
	
	function del_user() {
		if($this->input->get('guid', TRUE) != NULL AND $this->input->get('guid', TRUE) != 'all') {
			$this->db->delete('users', array('guid' => $this->input->get('guid'))); 
			$this->output->set_output('User deleted');
		} else if($this->input->get('guid', TRUE) == 'all') {
			$this->db->empty_table('users');
			$this->output->set_output('All users deleted');
		}
	}
/* TYPE OF PRICE */
	function add_type() {
		if($this->input->get('name', TRUE) == NULL) $this->error('Отсутствует параметр name');
		if($this->input->get('valuta', TRUE) == NULL) $this->error('Отсутствует параметр valuta');
		if($this->input->get('guid', TRUE) == NULL) $this->error('Отсутствует параметр guid');
		$valuta = $this->db->get_where('currency', array('guid' => $this->input->get('valuta')));
		if($valuta->num_rows() == 0) { $this->error('Нет валюты с данным guid < '.$this->input->get('valuta').' >'); }
		$test = $this->db->get_where('type_of_prices', array('guid' => $this->input->get('guid')));
		if($test->num_rows() >0) {
			$data = array(
				'name' => $this->input->get('name'),
				'currency_guid' => $valuta->row()->guid
			);
			
			$this->db->where('guid', $this->input->get('guid'));
			$this->db->update('type_of_prices', $data); 
			$this->output->set_output('ОК');	
		} else {
			$data = array(
				'guid' => $this->input->get('guid'),
				'name' => $this->input->get('name'),
				'currency_guid' => $valuta->row()->guid
			);
			
			$this->db->insert('type_of_prices', $data); 
			$this->output->set_output('ОК');
		}
	}
	
	function type() {
		if($this->input->get('id', TRUE) == NULL) {
			$result = $this->db->query('SELECT t.name, t.guid, c.guid as currency_guid FROM type_of_prices t LEFT JOIN currency c ON t.currency_guid=c.guid')->result_array();
			$this->output->set_header('Content-Type: application/json; charset=utf-8');
			$this->output->set_output(json_encode($result));
		} else {
			$result = $this->db->query('SELECT t.name, t.guid, c.guid as currency_guid FROM type_of_prices t LEFT JOIN currency c ON t.currency_guid=c.guid WHERE t.guid='.$this->input->get('guid'))->row_array();
			$this->output->set_header('Content-Type: application/json; charset=utf-8');
			$this->output->set_output(json_encode($result));
		}
	}
	
	function del_type() {
		if($this->input->get('guid', TRUE) != NULL AND $this->input->get('guid', TRUE) != 'all') {
			$this->db->delete('type_of_prices', array('guid' => $this->input->get('guid'))); 
			$this->output->set_output('Type of price deleted');
		} else if($this->input->get('guid', TRUE) == 'all') {
			$this->db->empty_table('type_of_prices');
			$this->output->set_output('All type of prices deleted');
		}
	}
	
		function add_char() {
		if($this->input->get('property', TRUE) == NULL) $this->error('Отсутствует параметр property');
		if($this->input->get('guid', TRUE) == NULL) $this->error('Отсутствует параметр guid');
		$test = $this->db->get_where('characters', array('guid' => $this->input->get('guid'), 'property_guid' => $this->input->get('property')));
		if($test->num_rows() >0) {
			$data = array(
				'property_guid' => $this->input->get('property'),
				'guid' => $this->input->get('guid')
			);
			$this->db->where('guid', $this->input->get('guid'));
			$this->db->where('property_guid', $this->input->get('property'));
			$this->db->update('characters', $data); 
			$this->output->set_output('ОК');	
		} else {		
			$data = array(
				'property_guid' => $this->input->get('property'),
				'guid' => $this->input->get('guid')
			);
			
			$this->db->insert('characters', $data); 
			$this->output->set_output('ОК');
		}
	}
	
	function char() {
	if($this->input->get('guid', TRUE) != NULL) {
		$user = $this->db->query('SELECT guid, property_guid FROM characters WHERE guid='.$this->input->get('guid'))->row_array();
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		$this->output->set_output(json_encode($user));
	}  else {
		$users = $this->db->query('SELECT guid, property_guid FROM characters')->result_array();
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		$this->output->set_output(json_encode($users));
	}
	}
	
	function del_char() {
	if($this->input->get('guid', TRUE) != NULL AND $this->input->get('guid', TRUE) != 'all') {
		$this->db->delete('characters', array('guid' => $this->input->get('guid'))); 
		$this->output->set_output('Character deleted');
	} else if($this->input->get('guid', TRUE) == 'all') {
		$this->db->empty_table('characters');
		$this->output->set_output('All characters deleted');
	}
	}
	
	function add_char_prop() {
		if($this->input->get('name', TRUE) == NULL) $this->error('Отсутствует параметр name');
		if($this->input->get('char_type', TRUE) == NULL) $this->error('Отсутствует параметр char_type');
		if($this->input->get('guid', TRUE) == NULL) $this->error('Отсутствует параметр guid');
		$test = $this->db->get_where('characters_properties', array('guid' => $this->input->get('guid')));
		if($test->num_rows() >0) {
			$data = array(
				'guid_char_type' => $this->input->get('char_type'),
				'name' => $this->input->get('name')
			);
			$this->db->where('guid', $this->input->get('guid'));
			$this->db->update('characters_properties', $data); 
			$this->output->set_output('ОК');	
		} else {		
			$data = array(
				'guid_char_type' => $this->input->get('char_type'),
				'name' => $this->input->get('name'),
				'guid' => $this->input->get('guid')
			);
			
			$this->db->insert('characters_properties', $data); 
			$this->output->set_output('ОК');
		}
	}
	
	function char_prop() {
	if($this->input->get('guid', TRUE) != NULL) {
		$user = $this->db->query('SELECT * FROM characters_properties WHERE guid='.$this->input->get('guid').'')->row_array();
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		$this->output->set_output(json_encode($user));
	}  else {
		$users = $this->db->query('SELECT * FROM characters_properties')->result_array();
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		$this->output->set_output(json_encode($users));
	}
	}
	
	function del_char_prop() {
	if($this->input->get('guid', TRUE) != NULL AND $this->input->get('guid', TRUE) != 'all') {
		$this->db->delete('characters_properties', array('guid' => $this->input->get('guid'))); 
		$this->output->set_output('Character deleted');
	} else if($this->input->get('guid', TRUE) == 'all') {
		$this->db->empty_table('characters_properties');
		$this->output->set_output('All characters deleted');
	}
	}
	
	function add_char_type() {
		if($this->input->get('name', TRUE) == NULL) $this->error('Отсутствует параметр name');
		if($this->input->get('guid', TRUE) == NULL) $this->error('Отсутствует параметр guid');
		$test = $this->db->get_where('characters_type', array('guid' => $this->input->get('guid')));
		if($test->num_rows() >0) {
			$data = array(
				'name' => $this->input->get('name')
			);
			$this->db->where('guid', $this->input->get('guid'));
			$this->db->update('characters_type', $data); 
			$this->output->set_output('ОК');	
		} else {		
			$data = array(
				'name' => $this->input->get('name'),
				'guid' => $this->input->get('guid')
			);
			
			$this->db->insert('characters_type', $data); 
			$this->output->set_output('ОК');
		}
	}
	
	function char_type() {
	if($this->input->get('guid', TRUE) != NULL) {
		$user = $this->db->query('SELECT * FROM characters_type WHERE guid='.$this->input->get('guid'))->row_array();
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		$this->output->set_output(json_encode($user));
	}  else {
		$users = $this->db->query('SELECT * FROM characters_type')->result_array();
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		$this->output->set_output(json_encode($users));
	}
	}
	
	function del_char_type() {
	if($this->input->get('guid', TRUE) != NULL AND $this->input->get('guid', TRUE) != 'all') {
		$this->db->delete('characters_type', array('guid' => $this->input->get('guid'))); 
		$this->output->set_output('Character deleted');
	} else if($this->input->get('guid', TRUE) == 'all') {
		$this->db->empty_table('characters_type');
		$this->output->set_output('All characters deleted');
	}
	}
	
	function add_remain() {
		if($this->input->get('product', TRUE) == NULL) $this->error('Отсутствует параметр product');
		if($this->input->get('remain', TRUE) == NULL) $this->error('Отсутствует параметр remain');
		$product = $this->db->get_where('products', array('guid' => $this->input->get('product')));
		if($product->num_rows() == 0) { $this->error('Нет номенклатуры с данным guid < '.$this->input->get('product').' >'); }
		$char = $this->db->get_where('characters', array('guid' => $this->input->get('char')));
		if($this->input->get('char')) { $char = $this->db->get_where('characters', array('guid' => $this->input->get('char'))); if($char->num_rows() == 0) { $this->error('Нет характеристики с данным guid < '.$this->input->get('char').' >');} else { $char = $char->row()->guid;} } else { $char = 0;}
		$test = $this->db->get_where('remains', array('product_guid' => $this->input->get('product'), 'char_guid' => $char));
		if($test->num_rows() >0) {
		$data = array(
				'remain' => $this->input->get('remain')
			);
			$this->db->where('product_guid', $this->input->get('product'));
			$this->db->where('char_guid', $char);
			$this->db->update('remains', $data); 
			$this->output->set_output('ОК');		
		} else {
		$data = array(
				'remain' => $this->input->get('remain'),
				'product_guid' => $product->row()->guid,
				'char_guid' => $char
			);
			
			$this->db->insert('remains', $data); 
			$this->output->set_output('ОК');
		}
	}
	
	function remain() {
		$result = $this->db->query('SELECT* FROM remains')->result_array();
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		$this->output->set_output(json_encode($result));
	}
	
	function del_remain() {
	if($this->input->get('guid', TRUE) == 'all') {
		$this->db->empty_table('remains');
		$this->output->set_output('All remains deleted');
	}
	}
	
	function add_graph() {
		if($this->input->get('number', TRUE) == NULL) $this->error('Отсутствует параметр number');
		if($this->input->get('min', TRUE) == NULL) $this->error('Отсутствует параметр min');
		if($this->input->get('max', TRUE) == NULL) $this->error('Отсутствует параметр max');
		$test = $this->db->get_where('remain_graph', array('number' => $this->input->get('number')));
		if($test->num_rows() >0) {
		$data = array(
				'min' => $this->input->get('min'),
				'max' => $this->input->get('max')
			);
			$this->db->where('number', $this->input->get('number'));
			$this->db->update('remain_graph', $data); 
			$this->output->set_output('ОК');		
		} else {
		$data = array(
				'number' => $this->input->get('number'),
				'max' => $this->input->get('max'),
				'min' => $this->input->get('min')
			);
			
			$this->db->insert('remain_graph', $data); 
			$this->output->set_output('ОК');
		}
	}
	
	function graph() {
		$result = $this->db->query('SELECT* FROM remain_graph')->result_array();
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		$this->output->set_output(json_encode($result));
	}
	
	function del_graph() {
	if($this->input->get('guid', TRUE) == 'all') {
		$this->db->empty_table('remain_graph');
		$this->output->set_output('All graph deleted');
	}
	}
	
	/* PRICE Полные тексты 	id 	currency_guid 	price 	product_guid 	type_of_price_id 	char_guid */
	function add_price() {
		if($this->input->get('type', TRUE) == NULL) $this->error('Отсутствует параметр type');
		if($this->input->get('valuta', TRUE) == NULL) $this->error('Отсутствует параметр valuta');
		if($this->input->get('price', TRUE) == NULL) $this->error('Отсутствует параметр price');
		if($this->input->get('product', TRUE) == NULL) $this->error('Отсутствует параметр product');

		$valuta = $this->db->get_where('currency', array('guid' => $this->input->get('valuta')));
		if($valuta->num_rows() == 0) { $this->error('Нет валюты с данным guid < '.$this->input->get('valuta').' >'); }
		$type = $this->db->get_where('type_of_prices', array('guid' => $this->input->get('type')));
		if($type->num_rows() == 0) { $this->error('Нет типа цены с данным guid < '.$this->input->get('type').' >'); }
		$product = $this->db->get_where('products', array('guid' => $this->input->get('product')));
		if($product->num_rows() == 0) { $this->error('Нет номенклатуры с данным guid < '.$this->input->get('product').' >'); }
		if($this->input->get('char')) { $char = $this->db->get_where('characters', array('guid' => $this->input->get('char'))); if($char->num_rows() == 0) { $this->error('Нет характеристики с данным guid < '.$this->input->get('char').' >');} else { $char = $char->row()->guid;} } else { $char = 0;}
		$test = $this->db->get_where('prices', array('product_guid' => $this->input->get('product'), 'type_guid' =>$this->input->get('type'), 'char_guid' => $char));
		if($test->num_rows() >0) {
			$data = array(
				'currency_guid' => $valuta->row()->guid,
				'price' => $this->input->get('price'),
				'product_guid' => $product->row()->guid,
				'type_guid' => $type->row()->guid,
				'char_guid' => $char
			);
			$this->db->where('product_guid', $this->input->get('product'));
			$this->db->where('type_guid', $this->input->get('type'));
			$this->db->where('char_guid', $char);
			$this->db->update('prices', $data); 
			$this->output->set_output('ОК');
		} else {
			$data = array(
				'currency_guid' => $valuta->row()->guid,
				'price' => $this->input->get('price'),
				'product_guid' => $product->row()->guid,
				'type_guid' => $type->row()->guid,
				'char_guid' => $char
			);
			
			$this->db->insert('prices', $data); 
			$this->output->set_output('ОК');
		}
	}
	
	function prices() {
			$result = $this->db->query('SELECT * FROM prices')->result_array();
			$this->output->set_header('Content-Type: application/json; charset=utf-8');
			$this->output->set_output(json_encode($result));
	}
	
	function del_price() {
		if($this->input->get('guid', TRUE) == 'all') {
			$this->db->empty_table('prices');
			$this->output->set_output('All prices deleted');
		}
	}
	
	/* ORDERS */
	
	function add_order_main() {
		if($this->input->get('price', TRUE) == NULL) $this->error('Отсутствует параметр price');
		if($this->input->get('user', TRUE) == NULL) $this->error('Отсутствует параметр user');
		if($this->input->get('guid', TRUE) == NULL) $this->error('Отсутствует параметр guid');
		
		$user = $this->db->get_where('users', array('guid' => $this->input->get('user')));
		if($user->num_rows() == 0) { $this->error('Нет пользователя с данным guid < '.$this->input->get('user').' >'); }
			$data = array(
				'user_guid' => $user->row()->guid,
				'price_rur' => $this->input->get('price'),
				'status_opt' => $this->input->get('status'),
				'guid' => $this->input->get('guid'),
				'comment' => $this->input->get('comment'),
				'manager_guid' => $this->input->get('manager')
			);
			
			$this->db->insert('orders', $data); 
			$this->output->set_output('ОК');

	}
	
	function add_order() {
		if($this->input->get('order', TRUE) == NULL) $this->error('Отсутствует параметр order');
		if($this->input->get('product', TRUE) == NULL) $this->error('Отсутствует параметр product');
		if($this->input->get('price', TRUE) == NULL) $this->error('Отсутствует параметр price');
		if($this->input->get('number', TRUE) == NULL) $this->error('Отсутствует параметр number');
		$order = $this->db->get_where('orders', array('guid' => $this->input->get('order')));
		if($order->num_rows() == 0) { $this->error('Нет заказа с данным guid < '.$this->input->get('order').' >'); }
		$product = $this->db->get_where('products', array('guid' => $this->input->get('product')));
		if($product->num_rows() == 0) { $this->error('Нет номенклатуры с данным guid < '.$this->input->get('product').' >'); }
		if($this->input->get('char')) { $char = $this->db->get_where('characters', array('guid' => $this->input->get('char'))); if($char->num_rows() == 0) { $this->error('Нет характеристики с данным guid < '.$this->input->get('char').' >');} else { $char = $char->row()->guid;} } else { $char = 0;}
			$data = array(
				'user_guid' => $order->row()->user_guid,
				'product_guid' => $product->row()->guid,
				'order_id' => $order->row()->id,
				'price_rur' => $this->input->get('price'),
				'number' => $this->input->get('number'),
				'char_guid' => $char
			);
			
			$this->db->insert('order_products', $data); 
			$this->output->set_output('ОК');
	}
	
	function orders() {
		if($this->input->get('last', TRUE) != NULL AND $this->input->get('id', TRUE) == NULL) {
			if($this->input->get('last')=='all') { 
			$orders = $this->db->query('SELECT id FROM orders WHERE guid=""')->result_array();
			$this->output->set_header('Content-Type: application/json; charset=utf-8');
			$this->output->set_output(json_encode($orders));
			} else {
			$last = int($this->input->get('last'));
			$orders = $this->db->query('SELECT id FROM orders WHERE guid="" ORDER BY id LIMIT '.$last.'')->result_array();
			$this->output->set_header('Content-Type: application/json; charset=utf-8');
			$this->output->set_output(json_encode($orders));
			}
		} else if($this->input->get('id', TRUE) != NULL AND $this->input->get('last', TRUE) == NULL) {
			$order_main = $this->db->query('SELECT guid as order_guid, price_rur as full_price,  DATE_FORMAT(date,"%d.%m.%Y %T") as date, comment, user_guid , manager_guid FROM orders WHERE id='.$this->input->get('id'))->row_array();
			$order_full = $this->db->query('SELECT product_guid, price_rur/number as price, number, char_guid FROM order_products WHERE order_id='.$this->input->get('id'))->result_array();
			$json = array ('order_guid' => $order_main['order_guid'], 'full_price' => $order_main['full_price'], 'date' => $order_main['date'], 'comment' => $order_main['comment'], 'user_guid' => $order_main['user_guid'], 'manager_guid' => $order_main['manager_guid'], 'rows' => $order_full);
			$this->output->set_header('Content-Type: application/json; charset=utf-8');
			$this->output->set_output(json_encode($json));
		} else {
			$users = $this->db->query("SELECT id, guid FROM orders")->result_array();
			$this->output->set_header('Content-Type: application/json; charset=utf-8');
			$this->output->set_output(json_encode($users));
		}
	}
	
	function order_guid() {
		if($this->input->get('id', TRUE) == NULL) $this->error('Отсутствует параметр id');
		if($this->input->get('guid', TRUE) == NULL) $this->error('Отсутствует параметр guid');
		$order = $this->db->get_where('orders', array('id' => $this->input->get('id')))->row();
		if(strlen($order->guid) > 20) { $this->error('У заказа с id < '.$this->input->get('id').' > уже есть guid!'); }
			$data = array(
			 'guid' => $this->input->get('guid', TRUE)
		   );
		$this->db->where('id', $this->input->get('id'));
		$this->db->update('orders', $data); 
		$this->output->set_output('ОК');
	}
	
	function del_order() {
		if($this->input->get('guid', TRUE) == NULL) $this->error('Отсутствует параметр guid');
		if($this->input->get('guid', TRUE) != NULL AND $this->input->get('guid', TRUE) != 'all') {
			$order = $this->db->get_where('orders', array('guid' => $this->input->get('guid')))->row();
			$this->db->delete('order_products', array('order_id' => $order->id));
			$this->db->delete('orders', array('guid' => $this->input->get('guid'))); 
			$this->output->set_output('Orders deleted');
			} else if($this->input->get('guid', TRUE) == 'all') {
		$this->db->empty_table('order_products');
		$this->db->empty_table('orders');
		$this->output->set_output('All orders deleted');
	}
	}
	
	function add_setting() {
		if($this->input->get('name', TRUE) == NULL) $this->error('Отсутствует параметр name');
		if($this->input->get('option', TRUE) == NULL) $this->error('Отсутствует параметр option');

		$test = $this->db->get_where('settings', array('siteoption' => $this->input->get('name')));
		if($test->num_rows() >0) {
		$data = array(
				'description' => $this->input->get('option')
			);
			$this->db->where('siteoption', $this->input->get('name'));
			$this->db->update('settings', $data); 
			$this->output->set_output('ОК');		
		} else {
		$data = array(
				'siteoption' => $this->input->get('name'),
				'description' => $this->input->get('option')
			);
			
			$this->db->insert('settings', $data); 
			$this->output->set_output('ОК');
		}
	}
	
	function setting() {
		if($this->input->get('name', TRUE) != NULL) {
			$user = $this->db->query('SELECT siteoption as name, description as option FROM settings WHERE siteoption='.$this->input->get('name'))->row_array();
			$this->output->set_header('Content-Type: application/json; charset=utf-8');
			$this->output->set_output(json_encode($user));
		}  else {
			$users = $this->db->query('SELECT siteoption as name, description as "option" FROM settings')->result_array();
			$this->output->set_header('Content-Type: application/json; charset=utf-8');
			$this->output->set_output(json_encode($users));
		}
	}
	
	function add_company() {
                $test = $this->db->get('company');
		if($test->num_rows() >0) {
		$row = $this->db->get('company')->row();
		$data = array(
				'name' => $this->input->get('name'),
				'address' => $this->input->get('address'),
				'director' => $this->input->get('director'),
				'inn' => $this->input->get('inn'),
				'kpp' => $this->input->get('kpp'),
				'guid' => $this->input->get('guid'),
				'rasch_schet' => $this->input->get('rasch_schet'),
				'bank_name' => $this->input->get('bank_name'),
				'bik' => $this->input->get('bik'),
				'korr_schet' => $this->input->get('korr_schet'),
				'contact_email' => $this->input->get('contact_email'),
				'site' => $this->input->get('site'),
				'phone' => $this->input->get('phone'),
				'slogan' => $this->input->get('slogan')
			);
			$this->db->where('guid', $row->guid);
			$this->db->update('company', $data); 
			$this->output->set_output('ОК');
                } else {
                  $data = array(
				'name' => $this->input->get('name'),
				'address' => $this->input->get('address'),
				'director' => $this->input->get('director'),
				'inn' => $this->input->get('inn'),
				'kpp' => $this->input->get('kpp'),
				'guid' => $this->input->get('guid'),
				'rasch_schet' => $this->input->get('rasch_schet'),
				'bank_name' => $this->input->get('bank_name'),
				'bik' => $this->input->get('bik'),
				'korr_schet' => $this->input->get('korr_schet'),
				'contact_email' => $this->input->get('contact_email'),
				'site' => $this->input->get('site'),
				'phone' => $this->input->get('phone'),
				'slogan' => $this->input->get('slogan')
			);
			$this->db->insert('company', $data); 
			$this->output->set_output('ОК');                    
                }	
	}
	
	function company() {
			$users = $this->db->query('SELECT * FROM company')->result_array();
			$this->output->set_header('Content-Type: application/json; charset=utf-8');
			$this->output->set_output(json_encode($users));
	}
	
	function add_manager() {
		if($this->input->get('manager', TRUE) == NULL) $this->error('Отсутствует параметр manager');
		if($this->input->get('user', TRUE) == NULL) $this->error('Отсутствует параметр user');
		$test = $this->db->get_where('users', array('guid' => $this->input->get('user')))->num_rows();
		if($test == 0) $this->error('Нет пользователя с данным guid');
		$test2 = $this->db->get_where('users', array('guid' => $this->input->get('manager')))->num_rows();
		if($test2 == 0) $this->error('Нет менеджера с данным guid');
		$data = array(
				'user_guid' => $this->input->get('user'),
				'manager_guid' => $this->input->get('manager')
			);
			
			$this->db->insert('user_manager', $data); 
			$this->output->set_output('ОК');
		
	}
	
	function managers() {
		$result = $this->db->query('SELECT* FROM user_manager')->result_array();
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		$this->output->set_output(json_encode($result));
	}
	
	function del_manager() {
	if($this->input->get('guid', TRUE) == 'all') {
		$this->db->empty_table('user_manager');
		$this->output->set_output('All managers deleted');
	}
	}
	
	function add_moysklad() {
		if($this->input->get('login', TRUE) == NULL) $this->error('Отсутствует параметр login');
		if($this->input->get('password', TRUE) == NULL) $this->error('Отсутствует параметр password');
		if($this->input->get('email', TRUE) == NULL) $this->error('Отсутствует параметр email');
		if($this->input->get('employee', TRUE) == NULL) $this->error('Отсутствует параметр employee');
		if($this->input->get('store', TRUE) == NULL) $this->error('Отсутствует параметр store');
		if($this->input->get('company', TRUE) == NULL) $this->error('Отсутствует параметр company');
		$txt = '<?php if(!defined(\'BASEPATH\')) exit(\'No direct script access allowed\');
		$config[\'login\'] 			= \''.$this->input->get('login').'\';
		$config[\'password\'] 	= \''.$this->input->get('password').'\';
		$config[\'email\'] 			= \''.$this->input->get('email').'\';
		$config[\'employee\']   	= \''.$this->input->get('employee').'\';
		$config[\'store\']   		= \''.$this->input->get('store').'\';
		$config[\'company\']   	= \''.$this->input->get('company').'\';
		?>	';
		$fp=fopen(FCPATH.'/application/config/moysklad.php', 'w');
		$test = fwrite($fp, $txt);
		fclose($fp);	
		if($test)	$this->output->set_output('ОК'); else $this->output->set_output('Ошибка записи в файл!');
	}
	
	function moysklad() {
		$this->config->load('moysklad', TRUE);
		$result['login'] 			= $this->config->item('login', 'moysklad');
		$result['password'] 		= $this->config->item('password', 'moysklad');
		$result['email'] 			= $this->config->item('email', 'moysklad');
		$result['employee']   	= $this->config->item('employee', 'moysklad');
		$result['store']   			= $this->config->item('store', 'moysklad');
		$result['company']   		= $this->config->item('company', 'moysklad');
		$this->output->set_output(json_encode($result));
	}
	
	function add_logo_from_profishop() {
		if($this->input->get('logo', TRUE) == NULL) $this->error('Отсутствует параметр logo');
		$content = file_get_contents('/var/www/vhosts/profishop.us/profishop.us/images/api/'.$this->input->get('logo'));
		$fp=fopen(FCPATH.'img/logo.png', 'w');
		$test = fwrite($fp, $content);
		fclose($fp);	
		if($test)	$this->output->set_output('ОК'); else $this->output->set_output('Ошибка записи в файл!');
	}
	
}