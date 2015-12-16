<?php $domtree = new DOMDocument('1.0', 'UTF-8');
$xmlRoot = $domtree->createElement('products');
$xmlRoot = $domtree->appendChild($xmlRoot);
foreach($products as $one): 
	$product = $domtree->createElement('product');
	$product = $xmlRoot->appendChild($product);
	$product->appendChild($domtree->createElement('articule',$one->articule));
	$product->appendChild($domtree->createElement('name',$one->name));
	$product->appendChild($domtree->createElement('price', $this->Products_model->get_price($one->product_guid)));

	$test = $this->Products_model->test_char($one->product_guid);

	if($test['num'] == 3):
		$characters = $domtree->createElement('characters');
		$characters = $product->appendChild($characters);
		foreach($this->Products_model->get_chars_name($one->product_guid) as $chars): $char_type[]= $chars->name; endforeach;
		foreach($this->Products_model->get_char_three($one->product_guid) as $row): 
			$character = $domtree->createElement('character');
			$character = $characters->appendChild($character);
			$character->appendChild($domtree->createElement('type',$char_type[0].'/'.$char_type[1].'/'.$char_type[2]));
			$character->appendChild($domtree->createElement('value', $row->names));
		endforeach;
		unset($chars2); unset($char_type);
	endif;

	if($test['num'] == 2):
		$characters = $domtree->createElement('characters');
		$characters = $product->appendChild($characters);
		foreach($this->Products_model->get_chars_name($one->product_guid) as $chars) :
			$char_type[]= $chars->name;
		endforeach;
		foreach($this->Products_model->get_chars($one->product_guid, $char_type[1]) as $chars):  $i++;
			$chars2[$i]['property'] = $chars->property;
		endforeach;
		foreach($this->Products_model->get_chars($one->product_guid, $char_type[0]) as $chars):
				foreach($chars2 as $i=>$char2):
					$test2 = $this->Products_model->test_char2($one->product_guid, $chars->property, $char2['property']); if($test2 !=NULL):
						$character = $domtree->createElement('character');
						$character = $characters->appendChild($character); 
						$character->appendChild($domtree->createElement('type', $char_type[0].'/'.$char_type[1]));
						$character->appendChild($domtree->createElement('value',$chars->property.'/'.$char2['property']));
					endif;
				endforeach;
		endforeach;
		unset($chars2); unset($char_type);
	endif;

	if($test['num'] == 1):
		$characters = $domtree->createElement('characters');
		$characters = $product->appendChild($characters);
		foreach($this->Products_model->get_chars_name($one->product_guid) as $chars):
			$char_type[]= $chars->name;
		endforeach;
		foreach($this->Products_model->get_chars($one->product_guid, $char_type[0]) as $row):
			$character = $domtree->createElement('character');
			$character = $characters->appendChild($character);
			$character->appendChild($domtree->createElement('type', $char_type[0]));
			$character->appendChild($domtree->createElement('value', $row->name));
		 endforeach;
		unset($char_type);
	endif;


	$product->appendChild($domtree->createElement('remain',$this->Products_model->get_remain_num($one->product_guid)));
endforeach;
echo $domtree->saveXML();