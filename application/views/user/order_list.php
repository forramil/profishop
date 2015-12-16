<?php if($added): ?>
	<?php include(dirname(__FILE__).'/modal-window.php'); ?>
<?php endif; ?>

<table id="ct2" class="catalog-list">
	<thead>
		<tr id="ct_sort">
			<th>Арт.</th>
			<th>Название</th>
			<?php if($this->Authmodel->settings('show_char') == 1): ?>
			<th width="50">Характеристика</th>
			<?php endif; ?>			
			<th width="70">Цена</th>
			<th class="qty" width="50">Кол-во</th>
			<th class="total" width="90">Сумма</th>
			<th class="remove-row"></th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 0; ?>
		<?php if($products): ?>
			<?php foreach($products as $one): ?>
				<?php $i++; ?>
				<?php $evro = $one->evro; ?> 
				<tr <?php if($i%2 == 0) echo 'class="even"';?> id="line<?php echo $one->orderid;?>" class="line<?php echo $one->orderid;?>">
					<td><?php echo $one->articule;?></td>
					<td><?php echo $one->name;?></td>
					<?php if($this->Authmodel->settings('show_char') == 1): ?>
					<td width="50" id="char_<?php echo $one->orderid;?>"><?php echo $this->Cart_model->get_char($one->char_guid); ?></td>
					<?php endif; ?>	
					<td width="60"><?php echo $this->Cart_model->get_price($one->product_guid, $one->char_guid); ?></td>
					<td class="qty" width="50"><input onkeypress="change_cart_enter(this,'<?php echo $one->orderid;?>',event);" class="input_num" type="text" name="" value="<?php echo $one->number;?>" /></td>
					<td class="total" width="90"><span id="l_p<?php echo $one->orderid;?>"><?php echo number_format($one->price_rur,2); ?></span></td>                                
					<td class="remove-row"><a class="remove-row" order_id="<?php echo $one->orderid;?>" href="#" title="Удалить строку"><img alt="" src="/img/btn-close.png" /></a></td>				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>

<div class="table_summ">
	Общее количество: <span id="all_pos"><?php echo number_format($cat['allgoods'],2);?></span> | Сумма заказа: <span id="all_price"><?php echo number_format($cat['allsumm'],2);?> руб.</span> 
</div>

<?php if($i>0): ?>
	<div class="table_comment">
		<textarea onchange="comment();" onblur="if(!value)value=defaultValue" onfocus="if(value==defaultValue)value=''" class="comment_text" style="margin: 10px 0;" name="comment_text" cols="30" rows="3">Добавьте комментарий к заказу...</TEXTAREA><br>	</div>
<?php endif; ?>
