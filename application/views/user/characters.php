								<div class="characters">
								<a class="char_select" onclick="show_select(<?php echo $one->productsid;?>); return false;" href="#"><img src="/img/character.png" /></a>
								<div class="select character_all character_<?php echo $one->productsid;?>">	
								<a class="close_char" onclick="hide_select(<?php echo $one->productsid;?>); return false;" href="#"><img src="/img/close.png" /></a>
								
								<table>
								<thead>
								<tr>
								<?php foreach($this->Products_model->get_chars($one->productsid) as $chars) { ?>
								<th>
								<?php echo $chars->name_char1; ?>/<?php echo $chars->name_char2; ?>
								</th>
								<?php } ?>
								<?php foreach($this->Products_model->get_chars($one->productsid) as $chars) { ?>
								<th>
									<?php echo $chars->char2; ?>							
								</th>
								<?php } ?>
								</tr>
								</thead>
								
								<tbody>
								<?php foreach($this->Products_model->get_chars($one->productsid) as $chars) { ?>
								<?php $c = count($chars->char2); ?>							
								<tr>
								<td>
								<?php echo $chars->char1;?>
								</td>
								<?php for($i=0; $i<=$c; $i++) {?>															
								<td>
								Pusto
								</td>
								<?php } ?>
								</tr>
								<?php } ?>
								</tbody>
								
								</table>
								</div>
								</div>