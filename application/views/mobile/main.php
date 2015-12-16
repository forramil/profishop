<article>
	<div class="items">
		<?php $i = 0; foreach($products as $one): ?>
			<?php $i++; ?>
		<div class="item" id="item-<?php echo $one->product_guid; ?>">
			<div>
				<span class="articule"><?php echo $one->articule;?></span>
				<span class="price"><?php echo $this->Products_model->get_price($one->product_guid);?> руб.</span>
			</div>
			<div>
				<span class="name"><?php echo $one->name; ?></span>
			</div>
			<div>
			
			<?php $test = $this->Products_model->test_char($one->product_guid);?> 
				<?php if($test['num'] == 3): ?>
					<a title='<?php echo $one->name; ?>' class="show-char local-link" href="#char-<?php echo $one->product_guid;?>">выбрать</a>
						<div style="display: none;">	
							<div id="char-<?php echo $one->product_guid;?>">	
								<table class="catalog-list char-table-inline">
									<thead>
										<tr>
											<?php foreach($this->Products_model->get_chars_name($one->product_guid) as $chars): $char_type[]= $chars->name; endforeach; ?>
											<th>
												<?php echo $char_type[0].'/'.$char_type[1].'/'.$char_type[2];  ?>
											</th>
											<th>Кол-во</th>
											<th><img style="display:inline-block; vertical-align:middle; margin-top:2px;" alt="" src="/img/warehouse-zoom-20.png" /></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($this->Products_model->get_char_three($one->product_guid) as $row): ?>
											<tr>
												<td>
													<?php echo $row->names; ?>
												</td>
												<td>
													<input id="pr<?php echo $one->product_guid; echo $row->char_guid; ?>" class="input_num" onDblClick="add_to_cart_enter_char('<?php echo $one->product_guid;?>', '<?php echo $row->char_guid; ?>',event);" type="text" name="" value="<?php if (array_key_exists($one->product_guid,$nums1)) { echo $nums1[$one->product_guid][$row->char_guid];} ?>" />
												</td>
												<td>
													<?php if($this->Authmodel->settings('show_graph') == 0){ ?>
														<?php echo $this->Products_model->get_remain_char_num($one->product_guid, $row->char_guid);?>
													<?php } else { ?>
													<?php $remain_char = $this->Products_model->get_remain_char($one->product_guid, $row->char_guid); ?>
													<ul class="remain_char" style="padding-top: <?php echo 17-$remain_char*2; ?>px; height: <?php echo $remain_char*2; ?>px;">
														<?php for($i=1; $i<=$remain_char; $i++) {echo '<li></li>'; }?>
													</ul>
												<?php } ?>													
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
								<div class="add-to-cart-buttons">
									<a class="add-to-cart-ok">OK</a>
									<a class="add-to-cart-cancel">Отмена</a>
								</div>
							</div>
						</div>
						<?php unset($chars2); unset($char_type); ?>
					<?php endif; ?>					
					<?php if($test['num'] == 2): ?>
						<a title='<?php echo $one->name; ?>' class="show-char local-link" href="#char-<?php echo $one->product_guid;?>">выбрать</a>
						<div style="display: none;">
							<div id="char-<?php echo $one->product_guid;?>">
								<table class="catalog-list char-table-inline">
									<thead>
										<tr>
												<th class="main_col" width="60">
													<?php foreach($this->Products_model->get_chars_name($one->product_guid) as $chars) { $char_type[]= $chars->name; } echo $char_type[0].'/'.$char_type[1]; ?>
												</th>
											<?php $chars2 = array(); $i=0;?>
											<?php foreach($this->Products_model->get_chars($one->product_guid, $char_type[1]) as $chars):  $i++;?>
												<th class="navi col<?php echo $i; if($i > 2) echo " hidden"?>">
													<?php $chars2[$i]['property'] = $chars->property; ?>
													<?php echo $chars->name ?>												
												</th>
											<?php endforeach; ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach($this->Products_model->get_chars($one->product_guid, $char_type[0]) as $chars): ?>
											<tr>
												<td class="main_col"> <?php echo $chars->name; ?></td>
												<?php $i=0; foreach($chars2 as $i=>$char2): ?>
													<td class="navi col<?php echo $i; if($i > 2) echo " hidden"?>">
														<?php $test2 = $this->Products_model->test_char2($one->product_guid, $chars->property, $char2['property']); if($test2 !=NULL): ?>
														<a id="minus" class="minus" href="#" onclick="char_minus('pr<?php echo $one->product_guid;  echo $test2->guid; ?>');" >-</a><input id="pr<?php echo $one->product_guid;  echo $test2->guid; ?>" class="input_num" onDblClick="add_to_cart_enter_char('<?php echo $one->product_guid;?>', '<?php echo $test2->guid; ?>',event);" type="text" name="" value="<?php if (array_key_exists($one->product_guid,$nums1)) { echo $nums1[$one->product_guid][$test2->guid];} ?>" /><a class="plus" href="#" onclick="char_plus('pr<?php echo $one->product_guid;  echo $test2->guid; ?>');" >+</a>
																											
															<?php $remain_char = $this->Products_model->get_remain_char($one->product_guid, $test2->guid); ?>
															<ul class="remain_char" style="padding-top: <?php echo 17-$remain_char*2; ?>px; height: <?php echo $remain_char*2; ?>px;">
																<?php if($remain_char>0): ?>
																	<?php for($j=0; $j<$remain_char; $j++): ?>
																		<li></li>
																	<?php endfor; ?>
																<?php endif; ?>
															</ul>
														<?php endif; ?>
													</td>
												<?php endforeach; ?>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
								<div class="add-to-cart-buttons">
									<div class="table-nav"><?php for($a=1; $a<=ceil($i/2); $a++) { ?>
										<a onclick="nav_char('<?php echo $one->product_guid;?>', '<?php echo $a*2; ?>');" class="circle circle<?php echo $a*2; if($a==1) echo " active"; ?>"> </a>
									<?php } ?></div>
									<a class="add-to-cart-ok" >OK</a>
									<a class="add-to-cart-cancel" >Отмена</a>
								</div>
							</div>
						</div>
						<?php unset($chars2); unset($char_type); ?>
					<?php endif; ?>
				
					<?php if($test['num']== 1): ?>
						<a title='<?php echo $one->name; ?>' class="show-char local-link" href="#char-<?php echo $one->product_guid;?>">выбрать</a>
						<div style="display: none;">	
							<div id="char-<?php echo $one->product_guid;?>">	
								<table class="catalog-list char-table-inline">
									<thead>
										<tr>
											<?php foreach($this->Products_model->get_chars_name($one->product_guid) as $chars): ?>
												<th>
													<?php echo $chars->name; $char_type[]= $chars->name; ?>
													
												</th>
											<?php endforeach; ?>
											<th>Кол-во</th>
											<th><img style="display:inline-block; vertical-align:middle; margin-top:2px;" alt="" src="/img/warehouse-zoom-20.png" /></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($this->Products_model->get_chars($one->product_guid, $char_type[0]) as $row): ?>
											<tr>
												<td>
													<?php echo $row->name; ?>
												</td>
												<td>
													<a class="minus" href="#" onclick="char_minus('pr<?php echo $one->product_guid; echo $row->char_guid; ?>');" >-</a><input id="pr<?php echo $one->product_guid; echo $row->char_guid; ?>" class="input_num" onDblClick="add_to_cart_enter_char('<?php echo $one->product_guid;?>', '<?php echo $row->char_guid; ?>',event);" type="text" name="" value="<?php if (array_key_exists($one->product_guid,$nums1)) { echo $nums1[$one->product_guid][$row->char_guid];} ?>" /><a class="plus" href="#" onclick="char_plus('pr<?php echo $one->product_guid; echo $row->char_guid; ?>');" >+</a>
												</td>
												<td>
													<?php $remain_char = $this->Products_model->get_remain_char($one->product_guid, $row->char_guid); ?>
													<ul class="remain_char" style="padding-top: <?php echo 17-$remain_char*2; ?>px; height: <?php echo $remain_char*2; ?>px;">
														<?php for($i=1; $i<=$remain_char; $i++) {echo '<li></li>'; }?>
													</ul>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
								<div class="add-to-cart-buttons">
									<a class="add-to-cart-ok">OK</a>
									<a class="add-to-cart-cancel">Отмена</a>
								</div>
							</div>
						</div>
						<?php unset($char_type); ?>
					<?php endif; ?>
					<?php if($test['num']== 0): ?>
					<!--<a class="show-char disabled">Выбрать</a>-->
					<?php endif; ?>
				
				
				<span <?php if($test['num']== 0) echo 'style="margin-left: 93px;"'; ?> class="remain"><ul><?php for($i=1; $i<=$this->Products_model->get_remain($one->product_guid); $i++): ?><li></li><?php endfor; ?></ul></span>
				<?php if($test['num'] > 0){ ?>
				<!--<span class="add"><a href="#" class="minus disabled" id="minus">-</a><div id="pr<?php echo $one->product_guid;?>"><?php if (array_key_exists($one->product_guid,$nums)) { echo $nums[$one->product_guid];} ?></div><a href="#" class="plus disabled" id="plus">+</a></span>-->
				<?php } else { ?>
				<span class="add"><a href="#" class="minus" id="minus" onclick="minus_cart('<?php echo $one->product_guid;?>');">-</a><div id="pr<?php echo $one->product_guid;?>"><?php if (array_key_exists($one->product_guid,$nums)) { echo $nums[$one->product_guid];} ?></div><a href="#" class="plus" id="plus" onclick="plus_cart('<?php echo $one->product_guid;?>');">+</a></span>
				<?php } ?>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
	
	<div class="pagination"> 
	<?php if($this->uri->segment(2) == 'category') {?>
			<ul>
		<?php if($this->uri->segment(4) == NULL OR $this->uri->segment(4) == '1') { ?>		
			<li class="first"><a class="current"></a></li>
			<li class="prev"><a class="current"></a></li>
		<?php } else { ?>
			<li class="first"><a href="<?php echo base_url(); ?>mobile/category/<?php echo $this->uri->segment(3) ?>"></a></li>
			<li class="prev"><a href="<?php echo base_url(); ?>mobile/category/<?php echo $this->uri->segment(3).'/'.($this->uri->segment(4)-1); ?>"></a></li>
		<?php } ?>
			<?php echo $this->pagination->create_links(); ?>
		<?php if($this->uri->segment(3) != NULL AND $this->uri->segment(4) == ceil($this->pagination->total_rows/$this->pagination->per_page)) { ?>		
			<li class="next"><a class="current"></a></li>
			<li class="last"><a class="current"></a></li>
		<?php } else { ?>
			<li class="next"><a href="<?php echo base_url(); ?>mobile/category/<?php echo $this->uri->segment(3).'/'.($this->uri->segment(4)+1); ?>"></a></li>
			<li class="last"><a href="<?php echo base_url(); ?>mobile/category/<?php echo $this->uri->segment(3).'/'.ceil($this->pagination->total_rows/$this->pagination->per_page); ?>"></a></li>
		<?php } ?>
		</ul>	
	<?php } else { ?>
		<ul>
		<?php if($this->uri->segment(3) == NULL OR $this->uri->segment(3) == '1' AND $this->uri->segment(1) == 'mobile') { ?>		
			<li class="first"><a class="current"></a></li>
			<li class="prev"><a class="current"></a></li>
		<?php } else { ?>
			<li class="first"><a href="<?php echo base_url(); ?>mobile/"></a></li>
			<li class="prev"><a href="<?php echo base_url(); ?>mobile/catalog/<?php echo ($this->uri->segment(3)-1); ?>"></a></li>
		<?php } ?>
			<?php echo $this->pagination->create_links(); ?>
		<?php if($this->uri->segment(2) == 'catalog' AND $this->uri->segment(3) == ceil($this->pagination->total_rows/$this->pagination->per_page)) { ?>		
			<li class="next"><a class="current"></a></li>
			<li class="last"><a class="current"></a></li>
		<?php } else { ?>
			<li class="next"><a href="<?php echo base_url(); ?>mobile/catalog/<?php echo ($this->uri->segment(3)+1); ?>"></a></li>
			<li class="last"><a href="<?php echo base_url(); ?>mobile/catalog/<?php echo ceil($this->pagination->total_rows/$this->pagination->per_page); ?>"></a></li>
		<?php } ?>
		</ul>
	<?php } ?>
	</div>
</article>
