<?php 		
	class Products_model extends CI_Model {
   
   function __construct() {
		parent::__construct();
		$this->load->model('Authmodel');
	} 
	
    function cats_sub(){
		$cats =  $this->db->query('SELECT * FROM cathegory WHERE status=1')->result();
		if($cats)foreach($cats as $v){
			$cats_sub[$v->parent][] = $v;
        }
        return $cats_sub;
    }
    
	function cats_main(){
		$cats =  $this->db->query('SELECT * FROM cathegory WHERE status=1 AND parent="0"')->result();
        return $cats;
    }
    
	function nav_list(){
        $cats =  $this->db->query('SELECT * FROM cathegory WHERE status=1 AND (parent is not null OR parent > 0)')->result();
        if($cats)foreach($cats as $v){
            $cats_sub[$v->parent][] = $v;
        }
		$cats =  $this->db->query('SELECT * FROM cathegory WHERE status=1 AND (parent is null OR parent = 0)')->result();
		$this->cats_main = $cats;
        $this->cats_sub = $cats_sub;
        
    }
	
	function count_products() {
		$products = $this->db->query('
			SELECT *
			FROM products 
			LEFT JOIN product_images ON product_images.product_guid=products.guid
			LEFT JOIN prices ON products.guid=prices.product_guid 
			LEFT JOIN cathegory ON cathegory.guid=products.category
			WHERE products.status !=0 AND cathegory.status=1 AND prices.type_guid="'.$this->session->userdata('type_price').'" GROUP BY products.guid');
        
	return $products->num_rows();
    }
    
	function list_product($limit, $start){
		$products = $this->db->query('
			SELECT 
				products.guid as product_guid, 
				products.name,
				products.articule,
				GROUP_CONCAT(product_images.path) as image_path, 
				product_images.name as image_name
			FROM products
			LEFT JOIN product_images ON product_images.product_guid=products.guid
			WHERE products.status !=0 
			GROUP BY products.guid LIMIT '.$start.','.$limit.'');
        
		return $products->result();	
    }
	
	function count_products_search($text,$type) {
		$where = '';
		switch($type){
			case 'all':
				$where[] = '(products.name like \'%'.$text.'%\' OR products.articule like \'%'.$text.'%\' OR `price` like \'%'.$text.'%\')';
			break;
			case 'articule':
				$where[] = ' `articule` like \'%'.$text.'%\'';
			break;
			case 'name':
				$where[] = ' products.name like \'%'.$text.'%\'';
			break;
			case 'price':
				$where[] = ' `price` like \'%'.$text.'%\'';
			break;
            }
		$products = $this->db->query('
			SELECT *
			FROM products 
			LEFT JOIN product_images ON product_images.product_guid=products.guid
			LEFT JOIN prices ON products.guid=prices.product_guid 
			LEFT JOIN cathegory ON cathegory.guid=products.category
			WHERE products.status !=0 AND cathegory.status=1'.($where?' AND '.implode(' AND ',$where):'').' AND prices.type_guid="'.$this->session->userdata('type_price').'" GROUP BY products.guid');
        
	return $products->num_rows();
    }
    
	function list_product_search($text, $type, $limit, $start){
		$where = '';
		switch($type){
			case 'all':
				$where[] = '(products.name like \'%'.$text.'%\' OR products.articule like \'%'.$text.'%\' OR `price` like \'%'.$text.'%\')';
			break;
			case 'articule':
				$where[] = ' `articule` like \'%'.$text.'%\'';
			break;
			case 'name':
				$where[] = ' products.name like \'%'.$text.'%\'';
			break;
			case 'price':
				$where[] = ' `price` like \'%'.$text.'%\'';
			break;
            }
        
		$products= $this->db->query('
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
			GROUP BY products.guid LIMIT '.$start.','.$limit.'');
        
		return $products->result();	
    }
	
	function count_products_category($cat) {
		$where = '';
        if($cat){
			$cat_guid = $this->db->query('SELECT guid FROM cathegory WHERE id = '.$cat.'')->row()->guid;
				$sub_cat = $this->db->query('SELECT GROUP_CONCAT(id) as `all`, GROUP_CONCAT(guid SEPARATOR "\",\"") as `allguid` FROM cathegory WHERE parent ="'.$cat_guid.'"')->row();
            if($sub_cat->all){
				$sub_cat1 = $this->db->query('SELECT GROUP_CONCAT(id) as `all`, GROUP_CONCAT(guid SEPARATOR "\",\"") as `allguid` FROM cathegory WHERE parent in("'.$sub_cat->allguid.'")')->row();
            }
            if($sub_cat1->all){
                $sub_cat2 = $this->db->query('SELECT GROUP_CONCAT(id) as `all`, GROUP_CONCAT(guid SEPARATOR "\",\"") as `allguid` FROM cathegory WHERE parent in("'.$sub_cat1->allguid.'")')->row();
            }
		    if($sub_cat2->all){
                $sub_cat3 = $this->db->query('SELECT GROUP_CONCAT(id) as `all`, GROUP_CONCAT(guid SEPARATOR "\",\"") as `allguid` FROM cathegory WHERE parent in("'.$sub_cat1->allguid.'")')->row();
            }
            $where[] = 'cathegory.id in ('.$cat.($sub_cat->all?','.$sub_cat->all:'').($sub_cat1->all?','.$sub_cat1->all:'').($sub_cat2->all?','.$sub_cat2->all:'').($sub_cat3->all?','.$sub_cat3->all:'').')';
        }
		$products = $this->db->query('
			SELECT *
			FROM products 
			LEFT JOIN product_images ON product_images.product_guid=products.guid 
			LEFT JOIN cathegory ON cathegory.guid=products.category
			LEFT JOIN prices ON products.guid=prices.product_guid 
			WHERE prices.type_guid="'.$this->Authmodel->info()->type_guid.'" AND cathegory.status=1'.($where?' AND '.implode(' AND ',$where):'').' 
			GROUP BY products.guid ORDER BY products.name ASC');
        
	return $products->num_rows();
    }

	function list_category($cat, $limit, $start){
		$where = '';
        if($cat){
			$cat_guid = $this->db->query('SELECT guid FROM cathegory WHERE id = '.$cat.'')->row()->guid;
				$sub_cat = $this->db->query('SELECT GROUP_CONCAT(id) as `all`, GROUP_CONCAT(guid SEPARATOR "\",\"") as `allguid` FROM cathegory WHERE parent ="'.$cat_guid.'"')->row();
            if($sub_cat->all){
				$sub_cat1 = $this->db->query('SELECT GROUP_CONCAT(id) as `all`, GROUP_CONCAT(guid SEPARATOR "\",\"") as `allguid` FROM cathegory WHERE parent in("'.$sub_cat->allguid.'")')->row();
            }
            if($sub_cat1->all){
                $sub_cat2 = $this->db->query('SELECT GROUP_CONCAT(id) as `all`, GROUP_CONCAT(guid SEPARATOR "\",\"") as `allguid` FROM cathegory WHERE parent in("'.$sub_cat1->allguid.'")')->row();
            }
		    if($sub_cat2->all){
                $sub_cat3 = $this->db->query('SELECT GROUP_CONCAT(id) as `all`, GROUP_CONCAT(guid SEPARATOR "\",\"") as `allguid` FROM cathegory WHERE parent in("'.$sub_cat1->allguid.'")')->row();
            }
            $where[] = 'cathegory.id in ('.$cat.($sub_cat->all?','.$sub_cat->all:'').($sub_cat1->all?','.$sub_cat1->all:'').($sub_cat2->all?','.$sub_cat2->all:'').($sub_cat3->all?','.$sub_cat3->all:'').')';
        }
		$products = $this->db->query('
			SELECT 
				products.guid as product_guid, 
				products.name, 
				GROUP_CONCAT(product_images.path) as image_path,
				product_images.name as image_name, 
				products.articule
			FROM products 
			LEFT JOIN product_images ON product_images.product_guid=products.guid 
			LEFT JOIN cathegory ON cathegory.guid=products.category
			LEFT JOIN prices ON products.guid=prices.product_guid 
			WHERE prices.type_guid="'.$this->Authmodel->info()->type_guid.'" AND cathegory.status=1'.($where?' AND '.implode(' AND ',$where):'').' 
			GROUP BY products.guid ORDER BY products.name ASC LIMIT '.$start.','.$limit.'');
		return $products->result();	

	}
	function get_price($guid) {
		$prices = $this->db->query('SELECT count(prices.price) as num, sum(prices.price) as price, currency.rate FROM prices LEFT JOIN currency ON currency.guid=prices.currency_guid WHERE prices.product_guid = "'.$guid.'" AND prices.type_guid="'.$this->session->userdata('type_price').'"')->row();
		return number_format($prices->price/$prices->num*$prices->rate,2);
	}
	
	function get_price_type($guid, $type) {
		$prices = $this->db->query('SELECT count(prices.price) as num, sum(prices.price) as price, currency.rate FROM prices LEFT JOIN currency ON currency.guid=prices.currency_guid WHERE prices.product_guid = "'.$guid.'" AND prices.type_guid="'.$type.'"');
		if($prices->num_rows() > 0)
		{
			$prices = $prices->row();
			$price = number_format($prices->price/$prices->num*$prices->rate,2);
		} 
		else $price = 0;
		return $price;
	}

	function get_remain($id) {
		$remain = $this->db->query('SELECT sum(remain) as remain FROM remains WHERE product_guid = "'.$id.'"')->row();
		$num = $remain->remain;
		if($num == true) {
			$sel = $this->db->query('SELECT number FROM remain_graph WHERE min<='.$num.' AND max>='.$num.'')->row();
			return $sel->number; 
		} else { 
			return '0'; 
		}
	}
	
	function get_remain_num($id) {
		$remain = $this->db->query('SELECT sum(remain) as remain FROM remains WHERE product_guid = "'.$id.'"')->row();
		return $remain->remain;
	}
	
	function get_remain_char($id, $char) {
		$remain = $this->db->query('SELECT remains.remain FROM remains LEFT JOIN characters ON remains.char_guid=characters.guid WHERE remains.product_guid = "'.$id.'" AND characters.guid="'.$char.'"')->row();
		$num = $remain->remain;
		if($num == true) {
			$sel = $this->db->query('SELECT number FROM remain_graph WHERE min<='.$num.' AND max>='.$num.'')->row();
			return $sel->number; 
		} else { 
			return '0'; 
		}
	}
	
	function get_remain_char_num($id, $char) {
		$remain = $this->db->query('SELECT remains.remain FROM remains LEFT JOIN characters ON remains.char_guid=characters.guid WHERE remains.product_guid = "'.$id.'" AND characters.guid="'.$char.'"')->row();
		return $remain->remain;
	}
	
	function get_chars_name($guid) {
		$chars = $this->db->query('
			SELECT t.name
			FROM prices p
			INNER JOIN characters c ON c.guid=p.char_guid
			INNER JOIN characters_properties pr ON pr.guid=c.property_guid 
			INNER JOIN characters_type t ON t.guid=pr.guid_char_type 
			WHERE p.product_guid = "'.$guid.'"
			GROUP by t.name ORDER by t.name ASC')->result();
		return $chars;
	}
	
	function test_char($guid) {
		$price =  $this->db->query('SELECT char_guid FROM prices WHERE product_guid = "'.$guid.'"')->row();
		$proverka = $this->db->query('SELECT * FROM characters WHERE guid = "'.$price->char_guid.'" GROUP by property_guid')->num_rows();
		//$proverka = $this->db->query('SELECT * FROM prices p INNER JOIN characters c ON c.guid=p.char_guid WHERE p.product_guid = "'.$guid.'" AND p.type_guid="'.$this->session->userdata('type_price').'" AND (p.char_guid !="0" OR p.char_guid!=NULL) GROUP by c.property_guid LIMIT 2')->num_rows();
		if($proverka == 0) { $num = "0"; $name = '';} 
		else if($proverka == 1) { $num = "1"; $name = $proverka; }
		else if($proverka == 2) { $num = "2"; $name = ''; }
		else if($proverka == 3) { $num = "3"; $name = ''; }
		$array = array('num' => $num, 'name' => $name);
		return $array;
	}
	
	function test_char2($id, $char1, $char2) {
		$test = $this->db->query('select t1.guid from prices p INNER JOIN characters t1 on p.char_guid=t1.guid left join characters t2 on t1.guid=t2.guid where p.product_guid="'.$id.'" AND t1.property_guid="'.$char1.'" AND t2.property_guid="'.$char2.'" group by t1.guid')->row();
		return $test;
	}
	
	
	function get_chars($id, $name) {
	$chars = $this->db->query('SELECT p.guid, pr.name, pr.guid as property, p.product_guid, p.char_guid FROM prices p INNER JOIN characters c ON p.char_guid=c.guid LEFT JOIN characters_properties pr ON pr.guid=c.property_guid LEFT JOIN characters_type t ON t.guid=pr.guid_char_type WHERE p.product_guid = "'.$id.'" AND t.name="'.$name.'" GROUP by pr.name ORDER by pr.name ASC')->result();
	return $chars;
	}
	
	function get_char_three($guid) {
	$chars = $this->db->query('SELECT GROUP_CONCAT(pr.name ORDER by t.name ASC SEPARATOR "/") as names, p.guid, pr.guid as property, p.char_guid FROM prices p INNER JOIN characters c ON p.char_guid=c.guid INNER JOIN characters_properties pr ON pr.guid=c.property_guid INNER JOIN characters_type t ON t.guid=pr.guid_char_type WHERE p.product_guid = "'.$guid.'" GROUP by c.guid')->result();
	return $chars;
	}
}