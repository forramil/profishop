<?php 		
class Cart_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->load->model('Authmodel');
	} 
	
	function get_cat(){
		$query = $this->db->query('SELECT SUM(price_rur) as allsumm, SUM(number) as allgoods FROM order_products WHERE order_id = 0 AND user_guid="'.$this->session->userdata('guid').'"');
		return $query->row_array();
	}
	
	function get_num($guid){
		$query = $this->db->query('SELECT SUM(number) as allincart FROM order_products WHERE product_guid="'.$guid.'" and order_id = 0 AND user_guid="'.$this->session->userdata('guid').'"');
		return $query->row_array();
	}
	
	function selected_nums(){
		$data = $this->db->query('SELECT product_guid, sum(number) as number FROM order_products WHERE order_id = 0 AND user_guid="'.$this->session->userdata('guid').'" GROUP by product_guid')->result();
		if($data)foreach($data as $one){
				$selected[$one->product_guid] = $one->number;
			}
		
		return $selected;
	}
	
	function selected_nums1(){
		$data = $this->db->get_where('order_products',array(
					'user_guid'=>$this->session->userdata('guid'),
					'order_id'=>0
					))->result();
		if($data)foreach($data as $one){
				$selected[$one->product_guid][$one->char_guid] = $one->number;
			}
		
		return $selected;
	}
	
	function list_categories(){
		$products = $this->db->query('SELECT cathegory.guid, cathegory.name
					FROM order_products 		
					LEFT JOIN products ON order_products.product_guid = products.guid 
					LEFT JOIN cathegory ON cathegory.guid=products.category 
					LEFT JOIN characters ON characters.guid=order_products.char_guid
					WHERE order_products.order_id=0 AND order_products.user_guid="'.$this->session->userdata('guid').'" GROUP by cathegory.guid');
		
		return $products->result();	
	}
	
	function list_cat($id, $status = NULL){
		$cat = $this->db->query('SELECT * FROM cathegory WHERE guid="'.$id.'"')->row();
		if($cat->parent == '0') {
			$result = $cat->name;
		} else {
			$cat1 = $this->db->query('SELECT * FROM cathegory WHERE guid="'.$cat->parent.'"')->row();
			if($cat1->parent == '0') {
				if($status== NULL) {
					$result = $cat1->name.' > '.$cat->name;
				} else {
					$result = $cat1->name;
				}
			} else {
				$cat2 = $this->db->query('SELECT * FROM cathegory WHERE guid="'.$cat1->parent.'"')->row();
				if($cat2->parent == '0') {
						if($status== NULL) {
							$result = $cat2->name.' > '.$cat1->name.' > '.$cat->name;
						} else {
							$result = $cat2->name;
						}
				} else {
					$cat3 = $this->db->query('SELECT * FROM cathegory WHERE guid="'.$cat2->parent.'"')->row();
					if($cat3->parent == '0') {
						if($status== NULL) {
							$result = $cat3->name.' > '.$cat2->name.' > '.$cat1->name.' > '.$cat->name;
						} else {
							$result = $cat3->name;
						}
					} else {
						$cat4 = $this->db->query('SELECT * FROM cathegory WHERE guid="'.$cat3->parent.'"')->row();
						if($cat4->parent == '0') {
							if($status== NULL) {
							$result = $cat4->name.' > '.$cat3->name.' > '.$cat2->name.' > '.$cat1->name.' > '.$cat->name;
							} else {
							$result = $cat4->name;
							}
						} 
					}		
				}
			}
		}
		return $result;
	}
	
	function cat_price_one($id){
		$cat = $this->db->query('SELECT sum(order_products.price_rur) as pr, sum(order_products.number) as num FROM order_products
					LEFT JOIN products ON order_products.product_guid = products.guid 
					LEFT JOIN cathegory ON cathegory.guid=products.category 
					WHERE order_products.order_id=0 AND order_products.user_guid="'.$this->session->userdata('guid').'" AND cathegory.guid="'.$id.'"')->row();
		return $cat->pr/$cat->num;
	}
	
	function cat_price($id){
		$cat = $this->db->query('SELECT sum(order_products.price_rur) as num FROM order_products
					LEFT JOIN products ON order_products.product_guid = products.guid 
					LEFT JOIN cathegory ON cathegory.guid=products.category 
					WHERE order_products.order_id=0 AND order_products.user_guid="'.$this->session->userdata('guid').'" AND cathegory.guid="'.$id.'"')->row();
		return $cat->num;
	}
	
	function cat_num($id){
		$cat = $this->db->query('SELECT sum(order_products.number) as num FROM order_products
					LEFT JOIN products ON order_products.product_guid = products.guid 
					LEFT JOIN cathegory ON cathegory.guid=products.category 
					WHERE order_products.order_id=0 AND order_products.user_guid="'.$this->session->userdata('guid').'" AND cathegory.guid="'.$id.'"')->row();
		return $cat->num;
	}
	
	function get_price($product, $char) {
		if($char == NULL) $query = $this->db->query('SELECT price FROM prices WHERE product_guid="'.$product.'" AND char_guid="0" AND type_guid="'.$this->session->userdata('type_price').'"')->row();
		else $query = $this->db->query('SELECT price FROM prices WHERE product_guid="'.$product.'" AND char_guid="'.$char.'" AND type_guid="'.$this->session->userdata('type_price').'"')->row();
		return $query->price;
	}
	function get_char($guid) {
		$query = $this->db->query('SELECT p.name FROM characters c INNER JOIN characters_properties p ON c.property_guid=p.guid WHERE c.guid="'.$guid.'"');
		if($query->num_rows() > 1) { 
		$rows= $query->result();
		$array = '';
		foreach ($rows as $row) $name[]=$row->name;
		$array .= $name[0];
		$array .= ', '.$name[1];
		} else {
		$array = $query->row()->name;
		}
		return $array;
	}
	function list_order(){
		$products = $this->db->query('SELECT order_products.id as orderid, order_products.product_guid, order_products.order_id, order_products.char_guid,
					(select SUM(distinct order_products.number) from order_products DS where DS.id=orderid) as number,
					(select SUM(distinct order_products.price_rur) from order_products DS where orderid=DS.id) as price_rur,
					products.name, products.articule, prices.price, prices.type_guid, currency.rate as evro
					FROM order_products 
					LEFT JOIN products ON order_products.product_guid = products.guid 
					LEFT JOIN prices ON products.guid=prices.product_guid 
					LEFT JOIN characters ON characters.guid=order_products.char_guid
					LEFT JOIN currency ON currency.guid = prices.currency_guid
					WHERE order_products.order_id=0 AND order_products.user_guid="'.$this->session->userdata('guid').'" AND prices.type_guid="'.$this->session->userdata('type_price').'" GROUP BY products.guid, characters.guid ORDER BY `name` ASC');
		
		return $products->result();	
	}
	
	
	function list_order_id($id){
		$products = $this->db->query('SELECT order_products.id as orderid, order_products.product_guid, order_products.order_id, order_products.char_guid,
					(select SUM(distinct order_products.number) from order_products DS where DS.id=orderid) as number,
					(select SUM(distinct order_products.price_rur) from order_products DS where orderid=DS.id) as price_rur,
					products.name, products.articule, prices.price, prices.type_guid, currency.rate as evro
					FROM order_products 
					LEFT JOIN products ON order_products.product_guid = products.guid 
					LEFT JOIN prices ON products.guid=prices.product_guid 
					LEFT JOIN characters ON characters.guid=order_products.char_guid
					LEFT JOIN currency ON currency.guid = prices.currency_guid
					WHERE order_products.order_id="'.$id.'" AND order_products.user_guid="'.$this->session->userdata('guid').'" AND prices.type_guid="'.$this->session->userdata('type_price').'" GROUP BY products.guid, characters.guid ORDER BY `name` ASC');
		
		return $products->result();	
	}
	
	function list_orders($category){
				$products = $this->db->query('SELECT order_products.id as orderid, order_products.product_guid, order_products.order_id, order_products.char_guid,
					(select SUM(distinct order_products.number) from order_products DS where DS.id=orderid) as number,
					(select SUM(distinct order_products.price_rur) from order_products DS where orderid=DS.id) as price_rur,
					products.name, products.articule, prices.price, prices.type_guid, currency.rate as evro
					FROM order_products 
					LEFT JOIN products ON order_products.product_guid = products.guid
					LEFT JOIN cathegory ON cathegory.guid=products.category
					LEFT JOIN prices ON products.guid=prices.product_guid 
					LEFT JOIN characters ON characters.guid=order_products.char_guid
					LEFT JOIN currency ON currency.guid = prices.currency_guid
					WHERE cathegory.guid="'.$category.'" AND order_products.order_id=0 AND order_products.user_guid="'.$this->session->userdata('guid').'" AND prices.type_guid="'.$this->session->userdata('type_price').'" GROUP BY products.guid, characters.guid ORDER BY `name` ASC');
		
		return $products->result();	
	}
	
	function add_order($comment){
		$summ = $this->db->query('SELECT SUM(price_rur) as price FROM order_products WHERE order_id=0 AND user_guid="'.$this->session->userdata('guid').'"','result')->row_array();
		
		if($summ){
			$data = array(
					'user_guid'   => $this->session->userdata('guid'),
					'date'      => date('Y-m-d H:i:s'),
					'price_rur' => $summ['price'],
					'comment' 	=> $comment,
					'onsite' 	=> 1,
					'manager_guid' => $this->session->userdata('manager')
					);
			$this->db->insert('orders', $data); 
			$last_id = $this->db->insert_id();
			
			$data2 = array('order_id' => $last_id);
			$this->db->where('user_guid', $this->session->userdata('guid'));
			$this->db->where('order_id', '0');
			$update = $this->db->update('order_products', $data2); 
			
			$this->load->library('email');
			$data['client'] = $this->Authmodel->info();
			$data['company'] = $this->db->query('SELECT * FROM company')->row();
			$data['products'] = $this->Cart_model->list_order_id($last_id);
			$data['order_id'] = $last_id;
			$this->config->load('email', TRUE);
			$from = $this->config->item('smtp_user', 'email');
			$this->email->from($from, 'Система Profishop'); 
			$this->email->to($this->Authmodel->info()->contact_email);
			$this->email->subject('Уважаемый покупатель, вами размещен заказ');
			$this->email->message($this->load->view('user/report_email', $data, TRUE));
			$this->email->send(); 
			$this->email->from('test@profishop.us', 'Система Profishop');
			$this->email->to($data['company']->contact_email);
			$this->email->subject('Покупателем с '.$this->Authmodel->info()->fulle_name.' размещен заказ');
			$this->email->message($this->load->view('user/report_email', $data, TRUE));
			$this->email->send();
			return $update;
		}
	}
	
	function clear(){
		return $this->db->query('DELETE FROM order_products WHERE user_guid = "'.$this->session->userdata('guid').'" AND order_id = 0');
	}
	
	function add($num, $number){
		$product = $this->db->get_where('products', array('guid'=>$num))->row_array();
		if($number>0){
			$curs = $this->db->get('currency')->result();
			foreach($curs as $v)$cr[$v->name] = $v->rate;
			
				$check = $this->db->query('SELECT * FROM order_products WHERE order_id=0 AND product_guid="'.$product['guid'].'" AND user_guid="'.$this->session->userdata('guid').'" AND char_guid is NULL')->num_rows(); 
				if($check == 0){ 
					$pr = $this->db->query('SELECT prices.price as price, currency.rate as rate FROM prices LEFT JOIN currency ON prices.currency_guid=currency.guid WHERE prices.product_guid="'.$product['guid'].'" AND prices.type_guid="'.$this->session->userdata('type_price').'"')->row_array();
					$price = (double)$pr['price']*(int)$number*$pr['rate'];
					$data = array(
							'user_guid'   => $this->session->userdata('guid'),
							'product_guid'=> $product['guid'],
							'order_id'  => 0,
							'price_rur' => $price,
							'number'    => (int)$number,
							'char_guid' => NULL
							);
					return $this->db->insert('order_products', $data);
				} else {
					$orderid = $this->db->query('SELECT id FROM order_products WHERE order_id=0 AND product_guid="'.$product['guid'].'" AND char_guid is NULL AND user_guid="'.$this->session->userdata('guid').'"')->row_array();
					$pr = $this->db->query('SELECT prices.price as price, currency.rate as rate FROM prices LEFT JOIN currency ON prices.currency_guid=currency.guid WHERE prices.product_guid="'.$product['guid'].'" AND prices.type_guid="'.$this->session->userdata('type_price').'"')->row_array();
					$price = (double)$pr['price']*(int)$number*$pr['rate'];
					
					//$this->db->set('price_rur', 'price_rur+'.$price.'', FALSE);
					//$this->db->set('number', 'number+'.(int)$number.'', FALSE);
					$this->db->set('price_rur', $price, FALSE);
					$this->db->set('number', (int)$number, FALSE);
					
					$this->db->where('id', $orderid['id']);
					return $this->db->update('order_products', $data); 
				}
		} elseif($number <= 0){
			$orderid = $this->db->query('SELECT id FROM order_products WHERE order_id=0 AND product_guid="'.$product['guid'].'" AND char_guid is NULL AND user_guid="'.$this->session->userdata('guid').'"')->row_array();
			$this->db->delete('order_products', array('id' => $orderid['id'])); 
		}
	}
	
	
	function add_char($num, $number, $char){
		$product = $this->db->get_where('products', array('guid'=>$num))->row_array();
		if($number>0){
			$curs = $this->db->get('currency')->result();
			foreach($curs as $v)$cr[$v->name] = $v->rate;
			$check = $this->db->query('SELECT * FROM order_products WHERE order_id=0 AND product_guid="'.$product['guid'].'" AND user_guid="'.$this->session->userdata('guid').'" AND char_guid="'.$char.'"')->num_rows(); 
			if($check == 0){ 
				$pr = $this->db->query('SELECT prices.price as price, prices.char_guid, currency.rate as rate FROM prices LEFT JOIN currency ON prices.currency_guid=currency.guid WHERE prices.product_guid="'.$product['guid'].'" AND prices.char_guid="'.$char.'" AND prices.type_guid="'.$this->session->userdata('type_price').'"')->row_array();
				$price = (double)$pr['price']*(int)$number*$pr['rate'];
				$data = array(
						'user_guid'   => $this->session->userdata('guid'),
						'product_guid'=> $product['guid'],
						'order_id'  => 0,
						'price_rur' => $price,
						'number'    => (int)$number,
						'char_guid' => $pr['char_guid']
						);
				return $this->db->insert('order_products', $data);
			} else {
				$orderid = $this->db->query('SELECT id FROM order_products WHERE order_id=0 AND product_guid="'.$product['guid'].'" AND char_guid="'.$char.'" AND user_guid="'.$this->session->userdata('guid').'"')->row_array();
				$pr = $this->db->query('SELECT prices.price as price, prices.char_guid, currency.rate as rate FROM prices LEFT JOIN currency ON prices.currency_guid=currency.guid WHERE prices.product_guid="'.$product['guid'].'" AND prices.char_guid="'.$char.'" AND prices.type_guid="'.$this->session->userdata('type_price').'"')->row_array();
				$price = (double)$pr['price']*(int)$number*$pr['rate'];
				
				//$this->db->set('price_rur', 'price_rur+'.$price.'', FALSE);
				//$this->db->set('number', 'number+'.(int)$number.'', FALSE);
				$this->db->set('price_rur', $price, FALSE);
				$this->db->set('number', (int)$number, FALSE);
				
				$this->db->where('id', $orderid['id']);
				return $this->db->update('order_products', $data); 
			}
		} else return false;
	}
	
	function change($num,$number){
		$order = $this->db->get_where('order_products', array('id'=>$num))->row();
		$curs = $this->db->get('currency')->result();
	
		if($number <= 0){
			$this->db->delete('order_products', array('id' => $order->id)); 
		} else {
			if ($order->char_guid == null) {
				$pr = $this->db->query('SELECT prices.price as price, currency.rate as rate FROM prices LEFT JOIN currency ON prices.currency_guid=currency.guid WHERE prices.product_guid="'.$order->product_guid.'" AND prices.type_guid="'.$this->session->userdata('type_price').'"')->row_array();
				$price = (double)$pr['price']*(int)$number*$pr['rate'];
				$data = array(
						'price_rur' => $price,
						'number'    => (int)$number
						);
				$this->db->where('id', $order->id);
				$this->db->update('order_products', $data); 
			} else {
				$pr = $this->db->query('SELECT prices.price as price, prices.char_guid, currency.rate as rate FROM prices LEFT JOIN currency ON prices.currency_guid=currency.guid WHERE prices.product_guid="'.$order->product_guid.'" AND prices.char_guid="'.$order->char_guid.'" AND prices.type_guid="'.$this->session->userdata('type_price').'"')->row_array();
				$price = (double)$pr['price']*(int)$number*$pr['rate'];
				$data = array(
						'price_rur' => $price,
						'number'    => (int)$number
						);
				$this->db->where('id', $order->id);
				$this->db->update('order_products', $data); 
			}
		}
		
		return $price;
	}
	
	function plus_cart($guid){
		$product = $this->db->get_where('products', array('guid'=>$guid))->row_array();
		$curs = $this->db->get('currency')->result();
		foreach($curs as $v)$cr[$v->name] = $v->rate;
		$check = $this->db->query('SELECT * FROM order_products WHERE order_id=0 AND product_guid="'.$product['guid'].'" AND user_guid="'.$this->session->userdata('guid').'" AND char_guid is NULL')->num_rows(); 
				if($check == 0){ 
					$pr = $this->db->query('SELECT prices.price as price, currency.rate as rate FROM prices LEFT JOIN currency ON prices.currency_guid=currency.guid WHERE prices.product_guid="'.$product['guid'].'" AND prices.type_guid="'.$this->session->userdata('type_price').'"')->row_array();
					$price = (double)$pr['price']*$pr['rate'];
					$data = array(
							'user_guid'   => $this->session->userdata('guid'),
							'product_guid'=> $product['guid'],
							'order_id'  => 0,
							'price_rur' => $price,
							'number'    => 1,
							'char_guid' => NULL
							);
					return $this->db->insert('order_products', $data);
			} else {
				$orderid = $this->db->query('SELECT id FROM order_products WHERE order_id=0 AND product_guid="'.$product['guid'].'" AND char_guid is NULL AND user_guid="'.$this->session->userdata('guid').'"')->row_array();
				$pr = $this->db->query('SELECT prices.price as price, currency.rate as rate FROM prices LEFT JOIN currency ON prices.currency_guid=currency.guid WHERE prices.product_guid="'.$product['guid'].'" AND prices.type_guid="'.$this->session->userdata('type_price').'"')->row_array();
				$price = (double)$pr['price']*$pr['rate'];
				$this->db->set('price_rur', 'price_rur+'.$price.'', FALSE);
				$this->db->set('number', 'number+1', FALSE);
				$this->db->where('id', $orderid['id']);
				return $this->db->update('order_products', $data); 
			}
	}
	
	
	
	function minus_cart($guid){
		$product = $this->db->get_where('products', array('guid'=>$guid))->row_array();
		$curs = $this->db->get('currency')->result();
		foreach($curs as $v)$cr[$v->name] = $v->rate;
			$check = $this->db->query('SELECT * FROM order_products WHERE order_id=0 AND product_guid="'.$product['guid'].'" AND user_guid="'.$this->session->userdata('guid').'" AND char_guid is NULL')->row(); 
			if($check->number <= 1){ 
				$this->db->where('user_guid', $this->session->userdata('guid'));
				$this->db->where('order_id', '0');
				$this->db->where('product_guid', $product['guid']);
				$this->db->where('char_guid', null);
				$this->db->delete('order_products'); 
			} else {
				$orderid = $this->db->query('SELECT id FROM order_products WHERE order_id=0 AND product_guid="'.$product['guid'].'" AND char_guid is NULL AND user_guid="'.$this->session->userdata('guid').'"')->row_array();
				$pr = $this->db->query('SELECT prices.price as price, currency.rate as rate FROM prices LEFT JOIN currency ON prices.currency_guid=currency.guid WHERE prices.product_guid="'.$product['guid'].'" AND prices.type_guid="'.$this->session->userdata('type_price').'"')->row_array();
				$price = (double)$pr['price']*$pr['rate'];
				$this->db->set('price_rur', 'price_rur-'.$price.'', FALSE);
				$this->db->set('number', 'number-1', FALSE);
				$this->db->where('id', $orderid['id']);
				$this->db->where('product_guid', $product['guid']);
				return $this->db->update('order_products', $data); 
			}	
		return $price;
	}
	
}