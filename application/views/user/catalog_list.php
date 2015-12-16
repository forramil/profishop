<table id="ct" class="catalog-list">
    <thead>
        <tr id="ct_sort">
            <th width="30">Арт.</th>
            <th>Название</th>
			<?php if($this->Authmodel->settings('show_char') == 1): ?>
			<th width="80">Харак.</th>
			<?php endif; ?>
            <th width="65">Цена</th>
			<th width="65">Остаток</th>
			<th width="50">Кол-во</th>
			<th width="20"><img src="/img/icon-cart-list.png"/></th>
        </tr>
    </thead>
	<tbody>

		<?php $i = 0; foreach($products as $one): ?>
			<?php $i++; ?>
			<tr class="<?php print($i%2 == 0 ? 'odd' : 'even'); ?>">
				<td class="product-sku"><?php echo $one->articule;?></td>
				<td class="product-name" align="left">
					<?php if(!empty($one->image_path)): $images = explode(',', $one->image_path); ?>
						<span class="size" title="<?php echo $one->name; ?>"><?php $x=0; foreach($images as $image){$x++;?><a rel="group<?php echo $one->product_guid;?>" class="show-product-image local-link" href="/images/<?php echo $image;?>"><?php if($x ==1) echo $one->name; ?></a><?php } ?></span>
					<?php else: ?>
						<span class="size" title="<?php echo $one->name; ?>"><?php print $one->name; ?></span>
					<?php endif; ?>
				</td>
				
				<?php if($this->Authmodel->settings('show_char') == 1): ?>
				<td class="product-chars">
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
									<a class="button add-to-cart-ok">OK</a>
									<a class="button add-to-cart-cancel">Отмена</a>
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
												<th width="60">
													<?php foreach($this->Products_model->get_chars_name($one->product_guid) as $chars) { $char_type[]= $chars->name; } echo $char_type[0].'/'.$char_type[1]; ?>
												</th>
											<?php $chars2 = array(); $i=0;?>
											<?php foreach($this->Products_model->get_chars($one->product_guid, $char_type[1]) as $chars):  $i++;?>
												<th>
													<?php $chars2[$i]['property'] = $chars->property; ?>
													<?php echo $chars->name ?>												
												</th>
											<?php endforeach; ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach($this->Products_model->get_chars($one->product_guid, $char_type[0]) as $chars): ?>
											<tr>
												<td> <?php echo $chars->name; ?></td>
												<?php foreach($chars2 as $i=>$char2): ?>
													<td>
														<?php $test2 = $this->Products_model->test_char2($one->product_guid, $chars->property, $char2['property']); if($test2 !=NULL): ?>
															<input id="pr<?php echo $one->product_guid;  echo $test2->guid; ?>" class="input_num" onDblClick="add_to_cart_enter_char('<?php echo $one->product_guid;?>', '<?php echo $test2->guid; ?>',event);" type="text" name="" value="<?php if (array_key_exists($one->product_guid,$nums1)) { echo $nums1[$one->product_guid][$test2->guid];} ?>" />
															
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
									<a class="button add-to-cart-ok" >OK</a>
									<a class="button add-to-cart-cancel" >Отмена</a>
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
									<a class="button add-to-cart-ok">OK</a>
									<a class="button add-to-cart-cancel">Отмена</a>
								</div>
							</div>
						</div>
						<?php unset($char_type); ?>
					<?php endif; ?>
					
				</td>
				<?php endif ?>
			
				<td class="product-price" width="60"><?php echo $this->Products_model->get_price($one->product_guid);?></td>
				<td class="product-remain" width="50">
					<?php if($this->Authmodel->settings('show_graph') == 0){ ?>
						<?php echo $this->Products_model->get_remain_num($one->product_guid);?>
					<?php } else { ?>
					<ul class="remain">
					<?php for($i=1; $i<=$this->Products_model->get_remain($one->product_guid); $i++): ?>
						<li></li>
					<?php endfor; ?>
					</ul>
					<?php } ?>
				</td>
						
				<td class="qty" id="pr_<?php echo $one->product_guid;?>" width="30">
					<?php if($test['num'] > 0): ?>
						<?php if (array_key_exists($one->product_guid,$nums)) { echo $nums[$one->product_guid];} ?>
					<?php else: ?>
						<input id="pr<?php echo $one->product_guid;?>" class="input_num" onkeypress="add_to_cart_enter('<?php echo $one->product_guid;?>',event);" type="text" name="" value="<?php if (array_key_exists($one->product_guid,$nums)) { echo $nums[$one->product_guid];} ?>" />
					<?php endif; ?>
				</td>
				<td width="20" id="pr_c<?php echo $one->product_guid;?>"><a onclick="add_to_cart_enter('<?php echo $one->product_guid;?>',event);" href="javascript:void(0);"><img src="/img/icon-cart-list.png" /></a></td>
			</tr>
        <?php endforeach; ?>
    </tbody>
</table>

<ul class="pagination">
<?php if($this->uri->segment(1) != 'category') { ?>		
<li class="details">Страница <?php if($this->uri->segment(2)) {echo $this->uri->segment(2); } else { echo "1"; } ?> из <?php echo ceil($this->pagination->total_rows/$this->pagination->per_page); ?></li>			
<?php } else { ?>
<li class="details">Страница <?php if($this->uri->segment(3)) {echo $this->uri->segment(3); } else { echo "1"; } ?> из <?php echo ceil($this->pagination->total_rows/$this->pagination->per_page); ?></li>			
<?php } ?>
<?php echo $this->pagination->create_links(); ?>
</ul>
