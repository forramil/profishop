<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile extends CI_Controller {

	function __construct() 
	{
        parent::__construct();
		$this->load->model('Mobilemodel');
		$this->load->model('Products_model');
		$this->load->model('Cart_model');
		$this->load->library("pagination");
		//$this->load->library('user_agent');
		//if($this->agent->is_browser()) redirect(base_url('main'),'refresh');
        if( is_login() == 1 ) return;
		if($this->uri->segment(2)==='login')  return; 
		else redirect('mobile/login'); 
		

    }

	
	function index() {
		$per_page = "3";
		$config = array();
        $config["base_url"] = base_url() . "mobile/catalog";
        $config["total_rows"] = $this->Products_model->count_products();
        $config["per_page"] = $per_page;
		$config['num_links'] = 2;
		$config['use_page_numbers'] = TRUE;
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;
        $config["uri_segment"] = 3;
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a class="current">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = FALSE;
		$config['prev_link'] = FALSE;
		$config['constant_num_links'] = TRUE;
		
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$page = intval($this->uri->segment(3));
        $page_num = ($page - 1)*$per_page;
        if ($page_num < 0) {
            $page_num = 0;
        }

		
		$data['products'] = $this->Products_model->list_product($per_page, $page_num);
		$data['cats_sub'] = $this->Products_model->cats_sub();
		$data['cats_main'] = $this->Products_model->cats_main();

		$data['cat'] = $this->Cart_model->get_cat();
		$data['nums'] = $this->Cart_model->selected_nums();
		$data['nums1'] = $this->Cart_model->selected_nums1();
		$this->load->view('mobile/header', $data);
		$this->load->view('mobile/left');
		$this->load->view('mobile/main', $data);
		$this->load->view('mobile/footer');	
	}
	
	public function category(){
		$id=$this->uri->segment(3);
		
		$per_page = "3";
		$config = array();
        $config["base_url"] = base_url() . 'mobile/category/'.$id.'/';
        $config["total_rows"] = $this->Products_model->count_products_category($id);
        $config["per_page"] = $per_page;
		$config['num_links'] = 2;
		$config['use_page_numbers'] = TRUE;
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;
        $config["uri_segment"] = 4;
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a class="current">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = FALSE;
		$config['prev_link'] = FALSE;
		$config['constant_num_links'] = TRUE;
		
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$page = intval($this->uri->segment(4));
        $page_num = ($page - 1)*$per_page;
        if ($page_num < 0) {
            $page_num = 0;
        }
		
		$data['products'] = $this->Products_model->list_category($id,$per_page, $page_num);
		$data['cats_sub'] = $this->Products_model->cats_sub();
		$data['cats_main'] = $this->Products_model->cats_main();

		$data['cat'] = $this->Cart_model->get_cat();
		$data['nums'] = $this->Cart_model->selected_nums();
		$data['nums1'] = $this->Cart_model->selected_nums1();
		$this->load->view('mobile/header', $data);
		$this->load->view('mobile/left');
		$this->load->view('mobile/main', $data);
		$this->load->view('mobile/footer');	
    }
	
	function search() {
		if($this->input->post('search-text') AND $this->input->post('search-type')) {
			$search_data = array(
											  "search-type"   => $this->input->post('search-type'),
											  "search-text"   => $this->input->post('search-text')
											  );
											  
			$this->session->set_userdata($search_data);
			$text = $this->input->post('search-text');
			$type = $this->input->post('search-type');
		} else {
			$text = $this->session->userdata('search-text');
			$type = $this->session->userdata('search-type');
		}
		$per_page = "3";
		$config = array();
        $config["base_url"] = base_url() . "mobile/search";
        $config["total_rows"] = $this->Products_model->count_products_search($text,$type);
        $config["per_page"] = $per_page;
		$config['num_links'] = 2;
		$config['use_page_numbers'] = TRUE;
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;
        $config["uri_segment"] = 3;
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a class="current">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = FALSE;
		$config['prev_link'] = FALSE;
		$config['constant_num_links'] = TRUE;
		
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$page = intval($this->uri->segment(3));
        $page_num = ($page - 1)*$per_page;
        if ($page_num < 0) {
            $page_num = 0;
        }

		
		$data['products'] = $this->Products_model->list_product_search($text, $type, $per_page, $page_num);
		$data['cats_sub'] = $this->Products_model->cats_sub();
		$data['cats_main'] = $this->Products_model->cats_main();

		$data['cat'] = $this->Cart_model->get_cat();
		$data['nums'] = $this->Cart_model->selected_nums();
		$data['nums1'] = $this->Cart_model->selected_nums1();
		$this->load->view('mobile/header', $data);
		$this->load->view('mobile/left');
		$this->load->view('mobile/main', $data);
		$this->load->view('mobile/footer');	
	}
	
	function cart() {
		if ($this->input->post('order')=='all') {
			$data['added'] = '1';
			$this->Cart_model->add_order($this->input->post('comment'));
		}
		
		if ($this->input->post('clear')=='all') {
			$this->Cart_model->clear();
		}
		if($this->input->post('group')) {
		$this->session->set_userdata('group', $this->input->post('group'));
		}
		$data['cats_sub'] = $this->Products_model->cats_sub();
		$data['cats_main'] = $this->Products_model->cats_main();
		$data['products'] = $this->Cart_model->list_order();
		$data['cat'] = $this->Cart_model->get_cat();
		$data['nums'] = $this->Cart_model->selected_nums();
		$this->load->view('mobile/header',$data);
		$this->load->view('mobile/left');
		if($this->session->userdata('group') == null OR $this->session->userdata('group') == "yes") {
		$this->load->view('mobile/order_list_group', $data);
		} else {
		$this->load->view('mobile/order_list', $data);
		}
		$this->load->view('mobile/footer');	
	}
	
	public function add_to_cart_char() {
		$char = $this->input->post('char');
		$num = $this->input->post('num');
		$number = $this->input->post('number');
		$this->Cart_model->add_char($num, $number, $char);
		$data = $this->Cart_model->get_cat();
		$data['allsumm'] = number_format($data['allsumm'],0);
		$allincart = $this->Cart_model->get_num($num);
		$data['allincart'] =$allincart['allincart'];
		$this->output->set_output(json_encode($data));
	}
	
	public function change_cart(){
        $num = $this->input->post('num');
	    $number = $this->input->post('number');
        $data['price'] = $this->Cart_model->change($num,$number);
		$data_temp = $this->Cart_model->get_cat();
        $data['allgoods'] = $data_temp['allgoods'];
        $data['allsumm'] = number_format($data_temp['allsumm'],0);
		$this->output->set_output(json_encode($data));
    }
	
	public function plus_cart(){
		$guid = $this->input->post('guid');
		$this->Cart_model->plus_cart($guid);
		$data = $this->Cart_model->get_cat();
		$number = $this->Cart_model->selected_nums();
		$data['number'] = $number[$guid];
		$data['allsumm'] = number_format($data['allsumm'],0);
		$this->output->set_output(json_encode($data));
    }
	
	function minus_cart(){
		$guid = $this->input->post('guid');
		$data['price'] =$this->Cart_model->minus_cart($guid);
		$data = $this->Cart_model->get_cat();
		$number = $this->Cart_model->selected_nums();
		$data['number'] = $number[$guid];
		$data['allsumm'] = number_format($data['allsumm'],0);
		$this->output->set_output(json_encode($data));
	}

	function profile() {
			if($this->input->post('ur_address') AND $this->input->post('fact_address') AND $this->input->post('inn') AND $this->input->post('kpp') AND $this->input->post('phone') AND $this->input->post('korr_schet') AND $this->input->post('bank_name') AND $this->input->post('bik') AND $this->input->post('rasch_schet') AND $this->input->post('contact_email') AND $this->input->post('site') AND $this->input->post('fulle_name')) {
			$data = array(
				'ur_address' => $this->input->post('ur_address'),
				'fact_address' => $this->input->post('fact_address'),
				'inn' => $this->input->post('inn'),
				'kpp' => $this->input->post('kpp'),
				'phone' => $this->input->post('phone'),
				'korr_schet' => $this->input->post('korr_schet'),
				'bank_name' => $this->input->post('bank_name'),
				'bik' => $this->input->post('bik'),
				'rasch_schet' => $this->input->post('rasch_schet'),
				'contact_email' => $this->input->post('contact_email'),
				'site' => $this->input->post('site'),
				'fulle_name' => $this->input->post('fulle_name')
			);
			$this->db->where('id', $this->session->userdata('id'));
			$this->db->update('opt_users', $data); 
		}
		$data['user'] = $this->Authmodel->info();
		$this->load->view('mobile/header', $data);
		$this->load->view('mobile/left');
		$this->load->view('mobile/profile', $data);
		$this->load->view('mobile/footer', $data);	
	}
	
	function login() {
		if( is_login() == 1 ) redirect('mobile');
		if($this->input->post('login') AND $this->input->post('password')) {
		$data['login'] = $this->input->post('login');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('login', 'Логин', 'required');
		$this->form_validation->set_rules('password', 'Пароль', 'required|min_length[3]');
		if ($this->form_validation->run() !== false){
		$userdata = $this->Authmodel->verify_user($this->input->post('login'), $this->input->post('password'));
		if ($userdata != false) {
				$session_data = array(
										  "login"   => $this->input->post('login'),
										  "guid"   => $userdata->guid,
										  "type_price" =>  $userdata->type_guid,
										  "hash" => md5($userdata->upassword.$this->config->item('password_hash'))
										  );
										  
				$this->session->set_userdata($session_data);
			redirect('/mobile');
		} 
		} 
		}
		$this->load->view('mobile/login', $data); 
	}
	
	function remind() {
		$this->load->view('user/remind');
	}
		
	function logout() {
		$this->session->sess_destroy();
		redirect('/mobile');
	}
}
