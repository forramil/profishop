<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->library('user_agent');
		if($this->agent->is_mobile()) redirect(base_url('mobile'),'refresh');
		if( is_login() == 0 ){ redirect(base_url(),'refresh'); }
		$this->load->library("pagination");
		$this->load->model('Products_model');
		$this->load->model('Cart_model');
		$this->load->model('Archive_model');
    }

	
	public function index() {
		if (isset($_COOKIE['per_page']) ){ $per_page = $_COOKIE['per_page'];} else{$per_page = "10";}
		$config = array();
        $config["base_url"] = base_url() . "catalog";
        $config["total_rows"] = $this->Products_model->count_products();
        $config["per_page"] = $per_page;
		$config['use_page_numbers'] = TRUE;
		$config["uri_segment"] = 2;
		$config['num_links'] = 2;
		$config['first_link'] = 'Первая';
		$config['first_tag_open'] = '<li class="word">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Последняя';
		$config['last_tag_open'] = '<li class="word">';
		$config['last_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a class="current">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = 'Следующая';
		$config['next_tag_open'] = '<li class="word">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = 'Предыдущая';
		$config['prev_tag_open'] = '<li class="word">';
		$config['prev_tag_close'] = '</li>';
		$config['constant_num_links'] = TRUE;
		
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$page = intval($this->uri->segment(2));
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
		if(strstr($_SERVER['HTTP_USER_AGENT'],'iPad')) {
			$this->load->view('ipad/header', $data);
			$this->load->view('ipad/catalog_list', $data);
			$this->load->view('user/footer', $data);   
		} else {
			$this->load->view('user/header', $data);
			$this->load->view('user/catalog_list', $data);
			$this->load->view('user/footer', $data);                                        
		}
	}
	
	public function cart() {
		
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
		$this->load->view('user/header', $data);
		if($this->session->userdata('group') == null OR $this->session->userdata('group') == "yes") {
		$this->load->view('user/order_list_group', $data);
		} else {
		$this->load->view('user/order_list', $data);
		}
		$this->load->view('user/footer', $data);	
	}
	
	public function category(){
		$id=$this->uri->segment(2);
		
		
		if (isset($_COOKIE['per_page']) ){ $per_page = $_COOKIE['per_page'];} else{$per_page = "10";}
		$config = array();
        $config["base_url"] = base_url() . 'category/'.$id.'/';
        $config["total_rows"] = $this->Products_model->count_products_category($id);
        $config["per_page"] = $per_page;
		$config['use_page_numbers'] = TRUE;
        $config["uri_segment"] = 3;
		$config['num_links'] = 2;
		$config['first_link'] = 'Первая';
		$config['first_tag_open'] = '<li class="word">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Последняя';
		$config['last_tag_open'] = '<li class="word">';
		$config['last_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a class="current">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = 'Следующая';
		$config['next_tag_open'] = '<li class="word">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = 'Предыдущая';
		$config['prev_tag_open'] = '<li class="word">';
		$config['prev_tag_close'] = '</li>';
		$config['constant_num_links'] = TRUE;
		
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$page = intval($this->uri->segment(3));
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
		$this->load->view('user/header', $data);
		$this->load->view('user/catalog_list', $data);
		$this->load->view('user/footer', $data);	
    }
	
	public function search(){
		$where = '';
		if($this->input->post('search-text')){
		$search = $this->input->post('search-text');
		switch($this->input->post('search-type')){
			case 'all':
				$where[] = '(products.name like \'%'.$search.'%\' OR products.articule like \'%'.$search.'%\' OR `price` like \'%'.$search.'%\')';
			break;
			case 'articule':
				$where[] = ' `articule` like \'%'.$search.'%\'';
			break;
			case 'name':
				$where[] = ' products.name like \'%'.$search.'%\'';
			break;
			case 'price':
				$where[] = ' `price` like \'%'.$search.'%\'';
			break;
            }
        
		$data['products'] = $this->db->query('
			SELECT 
				products.guid as product_guid, 
				products.name, 
				product_images.path as image_path, 
				product_images.name as image_name, 
				products.articule,
				sum(remains.remain) as remain
			FROM products 
			LEFT JOIN product_images ON product_images.product_guid=products.guid
			LEFT JOIN prices ON products.guid=prices.product_guid 
			LEFT JOIN cathegory ON cathegory.guid=products.category
			LEFT JOIN remains ON remains.product_guid=products.guid
			WHERE cathegory.status=1'.($where?' AND '.implode(' AND ',$where):'').' 
			GROUP BY products.guid')->result();
		$data['cats_sub'] = $this->Products_model->cats_sub();
		$data['cats_main'] = $this->Products_model->cats_main();
		$data['cat'] = $this->Cart_model->get_cat();
		$data['nums'] = $this->Cart_model->selected_nums();
		$this->load->view('user/header', $data);
		$this->load->view('user/catalog_list', $data);
		$this->load->view('user/footer', $data);
		} else {
		redirect('/');
		}
    }
	
	public function report_html() {
		$data['client'] = $this->Authmodel->info();
		$data['company'] = $this->db->query('SELECT * FROM company')->row();
		$data['products'] = $this->Cart_model->list_order();
		$this->load->view('user/report_html', $data);
	}
	
	public function report_archive() {
		$data['id']=$this->uri->segment(2);
		$data['client'] = $this->Authmodel->info();
		$data['company'] = $this->db->query('SELECT * FROM company')->row();
		$data['order']=$this->Archive_model->report_order($data['id']);
		$data['products'] = $this->Archive_model->report($data['id']);
		$this->load->view('user/report_archive', $data);
	}
	
	public function archive(){
		$data['cats_sub'] = $this->Products_model->cats_sub();
		$data['cats_main'] = $this->Products_model->cats_main();
		$data['products'] = $this->Cart_model->list_order();
		$data['cat'] = $this->Cart_model->get_cat();
		$data['nums'] = $this->Cart_model->selected_nums();
		$data['archive'] = $this->Archive_model->get_archive(); 
		$data['orders'] = $this->Archive_model->get_orders(); 
		$this->load->view('user/header', $data);
		$this->load->view('user/archive', $data);
		$this->load->view('user/footer', $data);
    }
	
	public function add_to_cart() {
		$num = $this->input->post('num');
		$number = $this->input->post('number');
		$this->Cart_model->add($num, $number);
		$data = $this->Cart_model->get_cat();
		$data['allsumm'] = number_format($data['allsumm'],0);
		$this->output->set_output(json_encode($data));
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
		$data['cats_sub'] = $this->Products_model->cats_sub();
		$data['cats_main'] = $this->Products_model->cats_main();
		$data['cat'] = $this->Cart_model->get_cat();
		$data['user'] = $this->Authmodel->info();
		$this->load->view('user/profile', $data);
		$this->load->view('user/footer', $data);
	}
		
	function logout() {
		$this->session->sess_destroy();
		redirect('/');
	}
	
	function xml_products() {
	   $data['products'] = $this->Products_model->list_product(99999, 0);
	   echo header("Content-Type: text/xml");
	   $this->load->view('user/xml_products', $data);
	}

	function excel_products() {
		$type = $this->Authmodel->settings('typeprice');
		$this->load->model('Excelmodel');
		$this->Excelmodel->generate_qty($type);
	}

}