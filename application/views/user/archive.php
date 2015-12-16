<div id="accordion2">
	<?php if($orders): ?> 
		<?php foreach($orders as $ord): ?>
			<h3 class="head">Заказ №<?php echo $ord->id; ?> на сумму <strong><?php echo number_format($ord->price_rur,2); ?></strong> руб., оформлен <?php echo $ord->date; ?><a target="_blank" style="margin: -7px 45px -7px 0; float: right;" href="/report_archive/<?php echo $ord->id; ?>">Печать</a></h3>
			<div class="block">
				<table id="ct2" class="catalog-list archive-list">
					<thead>
						<tr id="ct_sort">
							<th width="45">Артикул</th>
							<?php if($this->Authmodel->settings('show_char') == 1): ?>
							<th>Название</th>
							<?php endif; ?>
							<th>Название</th>
							<th>Характеристика</th>
							<th class="qty" width="30">Кол-во</th>
							<th class="total" width="90">Стоимость</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; ?>
						<?php if($archive): ?>
							<?php foreach($archive as $one): ?>
								<?php $i++; ?>
								<?php if ($ord->id == $one->order_id): ?>
									<tr <?php echo ($i%2 == 0 ? 'class="even"' : ''); ?> class="line<?php echo $one->product_id;?>">
										<td style="font-size: 12px;" width="45"><?php echo $one->articule;?></td>
										<td><?php echo $one->name;?></td>
										<?php if($this->Authmodel->settings('show_char') == 1): ?>
										<td><?php echo $this->Cart_model->get_char($one->char_guid); ?></td>
										<?php endif; ?>
										<td><?php echo $this->Cart_model->get_char($one->char_guid); ?></td>
										<td class="qty" width="30"><?php echo $one->number;?></td>
										<td class="total" width="90"><?php echo number_format($one->price_rur,2); ?></td>                                
									</tr>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>	
			</div>	
		<?php endforeach; ?>
	<?php endif; ?>
</div>
