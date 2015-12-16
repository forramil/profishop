<html>
	<body style="margin:0; font-family:Trebuchet MS, sans-serif;">
		<div style="width:760px; padding:70px 20px; margin:auto; box-shadow:0 0 20px rgba(0,0,0,0.3); background:url(<?php print base_url(); ?>/img/report-head.png) 50% 0 no-repeat;">
			<?php if($company->address){ $company->address = str_replace(',', '<br>', $company->address); } ?> 
			<table style="width:100%; height:100px; margin: 0; border-collapse:separate; border-spacing:0 5px; border-top: dotted 3px #e4e1df;" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td style="padding: 0 10px 0 30px; vertical-align: middle; background: url(<?php print base_url(); ?>/img/arrow2.png) 0 50% no-repeat;"><span style="display:inline-block; width: 280px; font-size: 18px; font-weight:bold;"><?php print $company->name; ?></span></td>
					<td style="width:20px; padding:0 3px 0 0; border-right:dotted 3px #e4e1df; vertical-align: middle;"><img alt="" src="<?php print base_url(); ?>/img/seller.png" /></td>
					<td style="padding: 0 10px; border-right: dotted 3px #e4e1df; vertical-align: middle;"><span style="display:inline-block; width: 180px; min-height:30px; padding: 0 0 0 35px;  background: url(<?php print base_url(); ?>/img/home.png) 0 0 no-repeat; font-size: 12px;"><?php print($company->address ? $company->address : 'Адрес компании'); ?></span></td>
					<td style="padding: 0 0 0 10px; text-align:center;"><span style="display:inline-block; width:160px; padding: 0; text-align:center; font-size: 12px;"><a  target="_blank" href="<?php echo $this->Authmodel->settings('link_for_client_logo'); ?>"><img width="100" src="<?php base_url(); ?>/img/logoclient.png" /></a></span></td>
				</tr>
			</table>
			<table style="width:100%; margin: 0 auto 30px; background:#68B8CC;" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td style="padding:5px; vertical-align: middle" colspan="4"><div style="padding: 10px; background: #fff; font-size: 16px;vertical-align: middle; color: #000;"><?php print($company->slogan ? $company->slogan : 'Слоган компании'); ?></div></td>
				</tr>
				<tr>
					<td style="padding:20px 0;">
						<table style="background:#68B8CC; color:#fff; width: 100%; margin: 0;" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td style="width: 25%; white-space: nowrap; padding: 0 10px 0 20px; text-align: center; border-right:solid 1px #fff;"><span style="background:url(<?php print base_url(); ?>/img/white-id.png) 0 50% no-repeat; display:inline-block; padding:0 0 0 30px; line-height:20px; font-size:14px; vertical-align: middle;">ИНН: <?php print ($company->inn ? $company->inn : 'inn'); ?></span></td>
								<td style="width: 25%; white-space: nowrap; padding: 0 10px 0 20px; text-align: center; border-right:solid 1px #fff;"><span style="background:url(<?php print base_url(); ?>/img/white-phone.png) 0 50% no-repeat; font-size:12px; float: left; display:inline-block; padding:0 0 0 30px; line-height:20px; font-size:14px; vertical-align: middle;"><?php print ($company->contact_email ? $company->contact_email : 'contact_email'); ?></span></td>
								<td style="width: 25%; white-space: nowrap; padding: 0 10px 0 20px; text-align: center; border-right:solid 1px #fff;"><span style="background:url(<?php print base_url(); ?>/img/white-email.png) 0 50% no-repeat; display:inline-block; padding:0 0 0 30px; line-height:20px; font-size:14px; vertical-align: middle;"><?php print ($company->phone ? $company->phone : 'phone'); ?></span></td>
								<td style="width: 25%; white-space: nowrap; padding: 0 10px 0 20px; text-align: center; border-right:none;"><span style="background:url(<?php print base_url(); ?>/img/white-site.png) 0 50% no-repeat; display:inline-block; padding:0 0 0 30px; line-height:20px; font-size:14px; vertical-align: middle;"><?php print ($company->site ? $company->site : 'site'); ?></span></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>

			<?php if($client->fact_address){ $client->fact_address = str_replace(',', '<br>', $client->fact_address); } ?>

			<table style="width:100%; height:100px; margin: 0; border-collapse:separate; border-spacing:0 5px; border-top: dotted 3px #e4e1df;" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td style="padding: 0 10px 0 30px; vertical-align: middle; background: url(<?php print base_url(); ?>/img/arrow2.png) 0 50% no-repeat;"><span style="display:inline-block; width: 280px; font-size: 18px; font-weight:bold;"><?php print($client->fulle_name ? $client->fulle_name : 'Клиент'); ?></span></td>
					<td style="width:20px; padding:0 3px 0 0; border-right:dotted 3px #e4e1df; vertical-align: middle;"><img alt="" src="<?php print base_url(); ?>/img/client.png" /></td>
					<td style="padding: 0 10px; border-right: dotted 3px #e4e1df; vertical-align: middle;"><span style="display:inline-block; width: 180px; min-height:30px; padding: 0 0 0 35px;  background: url(<?php print base_url(); ?>/img/home.png) 0 0 no-repeat; font-size: 12px;"><?php print($client->fact_address ? $client->fact_address : 'Адрес'); ?></span></td>
					<td style="padding: 0 0 0 10px; text-align:center;"><span style="display:inline-block; width:160px; padding: 0; text-align:center; font-size: 12px;"><?php print($client->bank_name ? $client->bank_name : 'Название банка'); ?><br> 
							БИК: <?php print $client->bik; ?><br>
							К/с: <?php print $client->korr_schet; ?><br>
							Р/с: <?php print $client->rasch_schet; ?><br>
						</span></td>
				</tr>
			</table>

			<table style="width: 100%; margin: 0 auto 30px; border:solid 4px #d6d2ce;" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td style="padding:20px 0;">
						<table style="width: 100%; margin: 0; background:none; color:inherit;" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td style="border-right:solid 1px #000;">
									<span style="display:inline-block; padding:0 0 0 30px; line-height:20px; font-size:14px; vertical-align: middle;background:url(<?php print base_url(); ?>/img/black-id.png) 0 50% no-repeat;">ИНН: <?php print $client->inn; ?></span>
								</td>
								<td style="border-right:solid 1px #000;">
									<span style="display:inline-block; padding:0 0 0 30px; line-height:20px; font-size:14px; vertical-align: middle;background:url(<?php print base_url(); ?>/img/black-phone.png) 0 50% no-repeat;"><?php print ($client->contact_email ? $client->contact_email : 'contact_email'); ?></span>
								</td>
								<td style="border-right:solid 1px #000;">
									<span style="display:inline-block; padding:0 0 0 30px; line-height:20px; font-size:14px; vertical-align: middle;background:url(<?php print base_url(); ?>/img/black-email.png) 0 50% no-repeat;"><?php print ($client->phone ? $client->phone : 'phone'); ?></span>
								</td>
								<td style="border-right:none;">
									<span style="display:inline-block; padding:0 0 0 30px; line-height:20px; font-size:14px; vertical-align: middle;background:url(<?php print base_url(); ?>/img/black-site.png) 0 50% no-repeat;"><?php print ($client->site ? $client->site : 'site'); ?></span>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>

			<table style="width:100%; margin: 0 auto 20px; border-collapse:collapse;" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:200px; padding: 5px 10px; text-align: center; background:#68B8CC; color:#fff;">
						№ <?php echo $order_id;?> 
					</td>
					<td style="padding: 5px 10px; text-align: center; background:#CFDAD8;">
						Дата: <?php print date('d.m.Y', time()); ?> 
					</td>
				</tr>
			</table>

			<table style="width:100%; margin: 0 auto 30px; border-collapse:collapse;" border="0" cellpadding="0" cellspacing="0">
				<tr style="background:rgba(0, 0, 0, 0.63); font-size:16px; color:#fff; white-space:nowrap; font-weight:bold;">
					<td style="padding:5px 10px; text-align:center; border-left: none; border-right:solid 1px #ccc!important;">Арт.</td>
					<td style="padding:5px 10px; text-align:center; border-left:solid 1px #ccc!important; border-right:solid 1px #ccc!important;">Название</td>
					<?php if($this->Authmodel->settings('show_char') == 1): ?>
					<td style="padding:5px 10px; text-align:center; border-left:solid 1px #ccc!important; border-right:solid 1px #ccc!important;">Хар.</td>
					<?php endif; ?>
					<td style="padding:5px 10px; text-align:center; border-left:solid 1px #ccc!important; border-right:solid 1px #ccc!important;">Цена</td>
					<td style="padding:5px 10px; text-align:center; border-left:solid 1px #ccc!important; border-right:solid 1px #ccc!important;">Кол-во</td>
					<td style="padding:5px 10px; text-align:center; border-left:solid 1px #ccc!important; border-right: none;">Сумма</td>
				</tr>

						<?php foreach($products as $product): ?>
							<?php $i++; ?>
							<tr style="font-size:14px; <?php print($i%2==0 ? 'background:#EEEFEF;' : 'background:#fff;'); ?>">
								<td style="padding:10px; text-align:center; border-left: none; border-right: solid 1px #000; text-align:left;"><?php echo $product->articule;?></td>
								<td style="padding:10px; text-align:center; border-left: solid 1px #000; border-right: solid 1px #000; text-align:left;"><?php echo $product->name;?></td>
								<?php if($this->Authmodel->settings('show_char') == 1): ?>
								<td style="padding:10px; text-align:center; border-left: solid 1px #000; border-right: solid 1px #000;"><?php echo $this->Cart_model->get_char($product->char_guid); ?></td>
								<?php endif; ?>
								<td style="padding:10px; text-align:center; border-left: solid 1px #000; border-right: solid 1px #000;"><?php echo number_format($product->price*$product->evro,2);?></td>
								<td style="padding:10px; text-align:center; border-left: solid 1px #000; border-right: solid 1px #000;"><?php echo $product->number;?></td>
								<td style="padding:10px; text-align:center; border-left: solid 1px #000; border-right: none;"><?php echo number_format($product->price_rur,2); ?></td>                                
							</tr>
						<?php endforeach; ?>
				
				<?php $totalprice = $this->db->query('SELECT sum(price_rur) as total FROM `order_products` WHERE  order_id="'.$order_id.'" AND user_guid="'.$this->session->userdata('guid').'"')->row_array(); ?>
				<tr class="order-total">
					<td style="border: none; padding:10px; text-align:center; font-size:16px; color:#fff; font-weight:bold; white-space:nowrap;" colspan="4"></td>
					<td style="background:#68B8CC; border-left:solid 1px #ccc!important; border-right:solid 1px #ccc!important; padding:10px; text-align:center; font-size:16px; color:#fff; font-weight:bold; white-space:nowrap;">Итого:</td>
					<td style="background:#68B8CC; border-left:solid 1px #ccc!important; border-right:solid 1px #ccc!important; padding:10px; text-align:center; font-size:16px; color:#fff; font-weight:bold; white-space:nowrap;"><?php print number_format($totalprice['total']); ?> руб.</td>
				</tr>
				 
			</table>
			
			<div style="height: 1px; margin: 0 0 5px; border-bottom: dotted 3px #e4e1df;"></div>
			
			<table style="width:100%; margin: 0;" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:40%; padding:0 10px 0 40px; border-right: dotted 3px #e4e1df; line-height:40px; vertical-align:middle;">
						<h4>Счет для оплаты:</h4>
					</td>
					<td style="width:25%; padding:0 10px; line-height:40px; vertical-align:middle;">
						<h4>Условия оплаты:</h4>
					</td>
					<td style="width:35%; line-height:40px; vertical-align:middle;">
						Оплатить в течение 30 дней 
					</td>
				</tr>
				<tr>
					<td style="vertical-align:top; width:40%; padding:0 10px 0 40px; border-right: dotted 3px #e4e1df;">
						<?php print $company->bank_name; ?> 
						<br>БИК: <?php print $company->bik; ?>
						<br>К/с: <?php print $company->korr_schet; ?>
						<br>Р/с: <?php print $company->rasch_schet; ?>
					</td>
					<td style="vertical-align:top; width:25%; padding:0 10px;">
						<h4 style="margin:0; color:#6BB9CD; ">Подпись:</h4>
					</td>
					<td style="vertical-align:top; width:35%;">
						<img src="<?php print base_url(); ?>/img/signature.png" style="vertical-align: bottom;" />
					</td>
				</tr>
			</table>
			
		</div>
	</body>
</html>