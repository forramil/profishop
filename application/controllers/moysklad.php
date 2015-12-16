<?php 
class Moysklad extends CI_Controller {

	function __construct() {
        parent::__construct();
		if (!file_exists(APPPATH.'config/moysklad.php')) {
			exit('Настройки не заданы!');
		} else {
			$this->config->load('moysklad', TRUE);
			return;
		}
    }
	
	function index() {
		$this->get_currency();
		$this->get_type();
		$this->get_category();
		$this->get_users();
		$this->get_products();
		$this->get_remains();
		$this->orders();
		echo 'Success';
	}
		
	function testing() {
	$this->_testing('Employee', $this->config->item('employee', 'moysklad'));
	$this->_testing('Warehouse', $this->config->item('store', 'moysklad'));
	if($this->_testing('MyCompany', $this->config->item('company', 'moysklad')) == 'OK') echo 'asds';
	}
	
	function _testing($type = null, $uuid = null) {
		$url = 'https://online.moysklad.ru/exchange/rest/ms/xml/'.$type.'/'.$uuid;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_USERPWD, $this->config->item('login', 'moysklad').':'.$this->config->item('password', 'moysklad'));
		$result=curl_exec ($ch);
		$header_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
		curl_close ($ch);
		if($header_code =='401') {
			exit('Не правильный логин или пароль!');
		} elseif($header_code =='404') {
			echo 'Ошибка конфигурации '.$type.'<br>';		
		} elseif($header_code =='200') {
			echo 'OK';
		}
	}
	
	function get_currency() {
		$sock = fsockopen("ssl://online.moysklad.ru", 443, $errno, $errstr, 30);
		if (!$sock) die("$errstr ($errno)\n");
		fputs($sock, "GET /exchange/rest/ms/xml/Currency/list HTTP/1.0\r\n");
		fputs($sock, "Host: online.moysklad.ru\r\n");
		fputs($sock, "Authorization: Basic " . base64_encode($this->config->item('login', 'moysklad').":".$this->config->item('password', 'moysklad')) . "\r\n");
		fputs($sock, "Content-Type: application/xml \r\n");
		fputs($sock, "Accept: */*\r\n");
		fputs($sock, "Content-Length: ".strlen($body)."\r\n");
		fputs($sock, "Connection: close\r\n\r\n");
		fputs($sock, "$body");
		
		while ($str = trim(fgets($sock, 4096)));
		$body = "";
		while (!feof($sock))
		$body.= fgets($sock, 4096);
		fclose($sock);
		$xml = simplexml_load_string($body);
		foreach($xml->currency as $row) { 
				$this->db->query("INSERT INTO currency (name, rate, guid) VALUES ('".$row['name']."', '".$row['rate']."', '".$row->uuid."') ON duplicate KEY UPDATE guid='".$row->uuid."'");
		}
	}
	
	function get_type() {
		$sock = fsockopen("ssl://online.moysklad.ru", 443, $errno, $errstr, 30);
		if (!$sock) die("$errstr ($errno)\n");
		fputs($sock, "GET /exchange/rest/ms/xml/PriceType/list HTTP/1.0\r\n");
		fputs($sock, "Host: online.moysklad.ru\r\n");
		fputs($sock, "Authorization: Basic " . base64_encode($this->config->item('login', 'moysklad').":".$this->config->item('password', 'moysklad')) . "\r\n");
		fputs($sock, "Content-Type: application/xml \r\n");
		fputs($sock, "Accept: */*\r\n");
		fputs($sock, "Content-Length: ".strlen($body)."\r\n");
		fputs($sock, "Connection: close\r\n\r\n");
		fputs($sock, "$body");
		
		while ($str = trim(fgets($sock, 4096)));
		$body = "";
		while (!feof($sock))
		$body.= fgets($sock, 4096);
		fclose($sock);
		$xml = simplexml_load_string($body);
		foreach($xml->priceType  as $row) { 
				$currency = $this->db->query("SELECT * FROM currency LIMIT 1")->row();
				$this->db->query("INSERT INTO type_of_prices (guid, name, currency_guid) VALUES ('".$row->uuid."', '".$row['name']."', '".$currency->guid."') ON duplicate KEY UPDATE guid='".$row->uuid."'");
		}
	
	}
	
	function get_category() {
		$sock = fsockopen("ssl://online.moysklad.ru", 443, $errno, $errstr, 30);
		if (!$sock) die("$errstr ($errno)\n");
		fputs($sock, "GET /exchange/rest/ms/xml/GoodFolder/list HTTP/1.0\r\n");
		fputs($sock, "Host: online.moysklad.ru\r\n");
		fputs($sock, "Authorization: Basic " . base64_encode($this->config->item('login', 'moysklad').":".$this->config->item('password', 'moysklad')) . "\r\n");
		fputs($sock, "Content-Type: application/xml \r\n");
		fputs($sock, "Accept: */*\r\n");
		fputs($sock, "Content-Length: ".strlen($body)."\r\n");
		fputs($sock, "Connection: close\r\n\r\n");
		fputs($sock, "$body");
		
		while ($str = trim(fgets($sock, 4096)));
		$body = "";
		while (!feof($sock))
		$body.= fgets($sock, 4096);
		fclose($sock);
		$xml = simplexml_load_string($body);
		foreach($xml->goodFolder as $row) { 
			if($row['parentUuid'] == '') $parent = '0'; else $parent = $row['parentUuid'];
			$test = $this->db->get_where('cathegory', array('guid' => "$row->uuid"));
			if($test->num_rows() >0) {
				$this->db->query("UPDATE cathegory SET name='".$row['name']."', parent='".$parent."', status='1' WHERE guid='".$row->uuid."'");
			} else {
			$this->db->query("INSERT INTO cathegory (name, parent, guid, status) VALUES ('".$row['name']."', '".$parent."', '".$row->uuid."', '1')");
			}
		}
	}
	
	
	function get_users() {
		$sock = fsockopen("ssl://online.moysklad.ru", 443, $errno, $errstr, 30);
		if (!$sock) die("$errstr ($errno)\n");
		fputs($sock, "GET /exchange/rest/ms/xml/Company/list HTTP/1.0\r\n");
		fputs($sock, "Host: online.moysklad.ru\r\n");
		fputs($sock, "Authorization: Basic " . base64_encode($this->config->item('login', 'moysklad').":".$this->config->item('password', 'moysklad')) . "\r\n");
		fputs($sock, "Content-Type: application/xml \r\n");
		fputs($sock, "Accept: */*\r\n");
		fputs($sock, "Content-Length: ".strlen($body)."\r\n");
		fputs($sock, "Connection: close\r\n\r\n");
		fputs($sock, "$body");
		
		while ($str = trim(fgets($sock, 4096)));
		$body = "";
		while (!feof($sock))
		$body.= fgets($sock, 4096);
		fclose($sock);
		$xml = simplexml_load_string($body);
		foreach($xml->company as $row) { 
			if($row->contact['email'] != '') {
				$tags = $row->xpath('tags[tag="profishop"]');
				if(isset($tags[0])) { $status = '1'; } else { $status = '0';}
				$test = $this->db->get_where('users', array('guid' => "$row->uuid"));
				if($test->num_rows() >0) {
				$this->db->query("UPDATE users SET ulogin='".$row->contact['email']."', type_guid='".$row['priceTypeUuid']."', ur_address='".$row->requisite['legalAddress']."', fact_address='".$row->requisite['actualAddress']."', inn='".$row->requisite['inn']."', kpp='".$row->requisite['kpp']."', phone='".$row->contact['phones']."', korr_schet='".$row->bankAccount['correspondentAccount']."', bank_name='".$row->bankAccount['bankName']."', bik='".$row->bankAccount['bic']."', rasch_schet='".$row->bankAccount['accountNumber']."', contact_email='".$row->contact['email']."', fulle_name='".$row['name']."', status='".$status."'
				WHERE guid='".$row->uuid."'");
				} else {
				$this->db->query("INSERT INTO users (ulogin, upassword, guid, type_guid, balance, ur_address, fact_address, inn, kpp, phone, korr_schet, bank_name, bik, rasch_schet, contact_email, site, fulle_name, manager, status) 
				 VALUES ('".$row->contact['email']."', '123456', '".$row->uuid."', '".$row['priceTypeUuid']."', '0.00', '".$row->requisite['legalAddress']."', '".$row->requisite['actualAddress']."', '".$row->requisite['inn']."', '".$row->requisite['kpp']."', '".$row->contact['phones']."', '".$row->bankAccount['correspondentAccount']."', '".$row->bankAccount['bankName']."', '".$row->bankAccount['bic']."', '".$row->bankAccount['accountNumber']."', '".$row->contact['email']."', '', '".$row['name']."', 0, '".$status."') ON duplicate KEY UPDATE ulogin='".$row->contact['email']."'");
				}
			}
		}
	}
	
	function get_products() {
		$sock = fsockopen("ssl://online.moysklad.ru", 443, $errno, $errstr, 30);
		if (!$sock) die("$errstr ($errno)\n");
		fputs($sock, "GET /exchange/rest/ms/xml/Good/list HTTP/1.0\r\n");
		fputs($sock, "Host: online.moysklad.ru\r\n");
		fputs($sock, "Authorization: Basic " . base64_encode($this->config->item('login', 'moysklad').":".$this->config->item('password', 'moysklad')) . "\r\n");
		fputs($sock, "Content-Type: application/xml \r\n");
		fputs($sock, "Accept: */*\r\n");
		fputs($sock, "Content-Length: ".strlen($body)."\r\n");
		fputs($sock, "Connection: close\r\n\r\n");
		fputs($sock, "$body");
		
		while ($str = trim(fgets($sock, 4096)));
		$body = "";
		while (!feof($sock))
		$body.= fgets($sock, 4096);
		fclose($sock);
		$xml = simplexml_load_string($body);
		foreach($xml->good as $row) { 
			if($row->attribute['booleanValue'] =="true") {$status = '1';} else { $status = '0';}
			$test = $this->db->get_where('products', array('guid' => "$row->uuid"));
			if($test->num_rows() >0) {
				$this->db->query("UPDATE products SET name='".$this->db->escape_str($row['name'])."', articule='".$row['productCode']."', category='".$row['parentUuid']."', status='".$status."', unit='шт' WHERE guid='".$row->uuid."'");
			} else {
				$this->db->query('INSERT INTO products (name, articule, category, guid, status, unit) VALUES ("'.$this->db->escape_str($row['name']).'", "'.$row['productCode'].'", "'.$row['parentUuid'].'", "'.$row->uuid.'", "'.$status.'", "шт")');
			}
			foreach($row->salePrices->price as $price) {
				if($price['currencyUuid']) { $currency =  $price['currencyUuid'];} else {$currency = $this->db->query('SELECT * FROM currency WHERE rate < 1.1 LIMIT 1')->row(); $currency=$currency->guid;}
				$price_product = $price['value'];
				$total = $price_product/100;
				$test = $this->db->get_where('prices', array('guid' => "$price->uuid"));
				if($test->num_rows() >0) {
					$this->db->query("UPDATE prices SET currency_guid='".$currency."', price='".$total."', product_guid='".$row->uuid."', type_guid='".$price['priceTypeUuid']."', char_guid='0' WHERE guid='".$price->uuid."'");
				}else{
					$this->db->query('INSERT INTO prices (guid, currency_guid, price, product_guid, type_guid, char_guid) VALUES ("'.$price->uuid.'", "'.$currency.'", "'.$total.'", "'.$row->uuid.'", "'.$price['priceTypeUuid'].'", "0")');
				}
			}
		}
	}
	
	function orders() {
		$orders = $this->db->query('SELECT * FROM orders WHERE moysklad=0')->result();
		$hungry = '100';
		foreach($orders as $order) { 
			$body = '<?xml version="1.0" encoding="UTF-8" ?> 
				<customerOrder vatIncluded="true" applicable="true" payerVat="true" employeeUuid="'.$this->config->item('employee', 'moysklad').'" sourceStoreUuid="'.$this->config->item('store', 'moysklad').'" sourceAgentUuid="'.$order->user_guid.'" targetAgentUuid="'.$this->config->item('company', 'moysklad').'" name="PS-'.$order->id.'" >
				<uuid>'.$order->guid.'</uuid>
				<description>'.$order->comment.'</description>
				<sum sum="'.$order->price_rur*$hungry.'" sumInCurrency="'.$order->price_rur*$hungry.'"/>';
				$products =  $this->db->get_where('order_products', array('order_id' => $order->id))->result();
				foreach($products as $row) {
				$body .= '
				<customerOrderPosition goodUuid="'.$row->product_guid.'" quantity="'.$row->number.'.0" discount="0.0">
				<basePrice sumInCurrency="'.$row->price_rur*$hungry/$row->number.'" sum="'.$row->price_rur*$hungry/$row->number.'"/>
				<reserve>0.0</reserve>
				</customerOrderPosition>';
				}
				$body .='</customerOrder>';
			
			$sock = fsockopen("ssl://online.moysklad.ru", 443, $errno, $errstr, 30);
			 
			if (!$sock) die("$errstr ($errno)\n");
			 
			fputs($sock, "PUT /exchange/rest/ms/xml/CustomerOrder HTTP/1.0\r\n");
			fputs($sock, "Host: online.moysklad.ru\r\n");
			fputs($sock, "Authorization: Basic " . base64_encode($this->config->item('login', 'moysklad').":".$this->config->item('password', 'moysklad')) . "\r\n");
			fputs($sock, "Content-Type: application/xml \r\n");
			fputs($sock, "Accept: */*\r\n");
			fputs($sock, "Content-Length: ".strlen($body)."\r\n");
			fputs($sock, "Connection: close\r\n\r\n");
			fputs($sock, "$body");
			 
			while ($str = trim(fgets($sock, 4096)));
			
			print_r($body);
			 
			$body = "";
			 
			while (!feof($sock))
				$body.= fgets($sock, 4096);
			 
			fclose($sock);
			$xml = simplexml_load_string($body);
			$this->db->query('UPDATE orders SET moysklad=1 WHERE id='.$order->id); 
			if($xml->uuid) {
				$this->db->query('UPDATE orders SET guid="'.$xml->uuid.'" WHERE id='.$order->id); 
			}
			if($xml->message) {
				$text = date('d.m.Y H:i:s')." Товар: ".$order->product_guid." Пользователь: ".$order->user_guid." Ошибка: ".$xml->message."\n";
				$file = fopen("log.txt","a");
				fwrite($file, $text);
				fclose($file);
			}
		}
	}
	
	function get_remains() {
		$sock = fsockopen("ssl://online.moysklad.ru", 443, $errno, $errstr, 30);
		if (!$sock) die("$errstr ($errno)\n");
		fputs($sock, "GET /exchange/rest/stock/xml HTTP/1.0\r\n");
		fputs($sock, "Host: online.moysklad.ru\r\n");
		fputs($sock, "Authorization: Basic " . base64_encode($this->config->item('login', 'moysklad').":".$this->config->item('password', 'moysklad')) . "\r\n");
		fputs($sock, "Content-Type: application/xml \r\n");
		fputs($sock, "Accept: */*\r\n");
		fputs($sock, "Content-Length: ".strlen($body)."\r\n");
		fputs($sock, "Connection: close\r\n\r\n");
		fputs($sock, "$body");
		
		while ($str = trim(fgets($sock, 4096)));
		$body = "";
		while (!feof($sock))
		$body.= fgets($sock, 4096);
		fclose($sock);
		$xml = simplexml_load_string($body);
		foreach($xml->stockTO as $row) { 
			$test = $this->db->get_where('remains', array('product_guid' => "$row->goodRef['uuid']"));
			if($test->num_rows() >0) {
				$this->db->query("UPDATE remains SET remain='".$row['quantity']."' WHERE product_guid='".$row->goodRef['uuid']."'");
			} else {
				$this->db->query("REPLACE INTO remains (remain, product_guid, char_guid) VALUES ('".$row['quantity']."', '".$row->goodRef['uuid']."', '0')");
			}
		}
	}

}