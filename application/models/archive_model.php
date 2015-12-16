<?php 		
	class Archive_model extends CI_Model {
   
   function __construct() {
	parent::__construct();
	$this->load->model('Authmodel');
	} 
	
	function get_orders(){
        $orders = $this->db->query('SELECT id, price_rur, date FROM orders WHERE user_guid="'.$this->Authmodel->info()->guid.'"'); 
	return $orders->result();
    }
	
	
	function get_archive(){
        $archive = $orders = $this->db->query('SELECT order_products.product_guid, order_products.order_id, order_products.price_rur, order_products.number, products.articule, products.name, order_products.char_guid FROM order_products LEFT JOIN products ON order_products.product_guid=products.guid  WHERE order_products.user_guid="'.$this->Authmodel->info()->guid.'" ORDER by order_products.order_id');
		return $archive->result();
	}
	
	function report($id){
		$products = $this->db->query('SELECT order_products.id as orderid, order_products.product_guid, order_products.order_id, order_products.char_guid,
					(select SUM(distinct order_products.number) from order_products DS where DS.id=orderid) as number,
					(select SUM(distinct order_products.price_rur) from order_products DS where orderid=DS.id) as price_rur,
					products.name, products.articule, prices.price, prices.type_guid, currency.rate as evro
					FROM order_products 
					LEFT JOIN products ON order_products.product_guid = products.guid 
					LEFT JOIN prices ON products.guid=prices.product_guid 
					LEFT JOIN characters ON characters.guid=order_products.char_guid
					LEFT JOIN currency ON currency.guid = prices.currency_guid
					WHERE order_products.user_guid="'.$this->session->userdata('guid').'" AND prices.type_guid="'.$this->session->userdata('type_price').'" AND order_products.order_id='.$id.' GROUP BY products.guid, characters.guid ORDER BY `name` ASC');
		
		return $products->result();	
	}
	
	function report_order($id){
        $order = $this->db->query('SELECT * FROM orders WHERE user_guid="'.$this->Authmodel->info()->guid.'" AND id='.$id);
		return $order->row();
	}

}