<?php 
class Main extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->library('user_agent');
		$this->load->library('form_validation');
		if($this->agent->is_mobile()) redirect(base_url('mobile'),'refresh');
		if( is_login() == 1 ){ redirect(base_url('user'),'refresh'); }
		if (!$this->migration->current())
		{
			show_error($this->migration->error_string());
			die();
		}
    }
	
	function index() {
		$this->login();
	}
	
	function login(){
		if($this->input->post('login')) {
		$data['login'] = $this->input->post('login');
		}
		$this->load->view('nonauth/login', $data); 
	}
	
	function login_process() {
		$this->config->load('api', TRUE);
		$num_users = $this->config->item('num_users', 'api');
		$this->form_validation->set_rules('login', 'Логин', 'required');
		$this->form_validation->set_rules('password', 'Пароль', 'required|min_length[3]');
		if ($this->form_validation->run() == FALSE) {
			$this->output->set_output('<ul>' . validation_errors('<li>','</li>') . '</ul>');
        }
        elseif( $this->Authmodel->verify_user($this->input->post('login'), $this->input->post('password')) == FALSE )
        {
            $this->output->set_output('Не правильный логин или пароль!');
        } 
		elseif( $this->Authmodel->status_user($this->input->post('login'), $this->input->post('password')) == FALSE )
        {
            $this->output->set_output('Ваша учетная запись заблокирована!');
        } 
		elseif( num_users() >= $num_users )
        {
			$this->output->set_output('Превышено число активных сессий!');
		}
		else 
		{
			$userdata = $this->Authmodel->verify_user($this->input->post('login'), $this->input->post('password'));
            
			if($userdata->manager == 0) {
				$session_data = array(
										  "login"   => $this->input->post('login'),
										  "guid"   => $userdata->guid,
										  "type_price" =>  $userdata->type_guid,
										  "hash" => md5($userdata->upassword.$this->config->item('password_hash'))
										  );
										  
				$this->session->set_userdata($session_data);
				
				echo '<script>location.href="'.base_url('user').'";</script>';
			} elseif($userdata->manager == 1) {
				$data['users'] = $this->Authmodel->manager($userdata->guid);
				$this->load->view('nonauth/manager', $data);
			}
        }
    }
	
	 function select_user() {
		if($this->Authmodel->check_manager($this->input->post('user'), $this->input->post('manager')) != FALSE ) {
			
			$userdata  = $this->Authmodel->user_data_guid($this->input->post('user')); 
			
			$session_data = array(
				"login"   => $userdata->ulogin,
				"guid"   => $userdata->guid,
				"type_price" =>  $userdata->type_guid,
				"manager" =>  $this->input->post('manager'),
				"hash" => md5($userdata->upassword.$this->config->item('password_hash'))
			);
										  
			$this->session->set_userdata($session_data);
			
			echo '<script>location.href="'.base_url('user').'";</script>'; 
		} else {
			echo '<script>location.href="'.base_url().'";</script>';
		}
	 }
/* Напоминание пароля */
	
	function remind(){
		$this->load->view('nonauth/remind'); 
	}
	
	function send_remind() {
		$password = $this->Authmodel->new_password();
		if($this->input->post('login')) {
			$userdata  = $this->Authmodel->user_data($this->input->post('login')); 
			$this->Authmodel->password_update($userdata->guid, $password);
		} elseif($this->input->post('inn')) {
			$userdata = $this->db->get_where('users',array('inn' => $this->input->post('inn')))->row();
			$this->Authmodel->password_update($userdata->guid, $password);
		}
			$text = 'Здраствуйте, '.$userdata->fulle_name.'.</br>';
			$text .= 'Ваш логин: '.$userdata->ulogin.'</br>';
			$text .= 'Ваш новый пароль: '.$password.'</br>';
			$this->load->library('email');
			$this->config->load('email', TRUE);
			$from = $this->config->item('smtp_user', 'email');
			$this->email->from($from, 'Система Profishop'); 
			$this->email->to($userdata->contact_email);
			$this->email->subject('Напоминание пароля');
			$this->email->message($text);
			$this->email->send(); 
			redirect('/', 'refresh');
	 }
	 
	 function registration() {
		$this->load->view('nonauth/registration'); 
	 }

}