<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="/css/report-html.css" />
	</head>
	
	<body>
		<div class="wrapper">
			<?php

			if($company->address){
				$company->address = str_replace(',', '<br>', $company->address);
			}

			?> 

			<table class="basic-info basic-info-seller" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td class="name">
						<span><?php print $company->name; ?></span>
					</td>
					<td class="icon">
						<img alt="" src="<?php print base_url(); ?>/img/seller.png" />
					</td>
					<td class="address">
						<span><?php print($company->address ? $company->address : 'Адрес компании'); ?></span>
					</td>
					<td class="logo">
						<span><a  target="_blank" href="<?php echo $this->Authmodel->settings('link_for_client_logo'); ?>"><img width="100" src="<?php base_url(); ?>/img/logoclient.png" /></a></span>
					</td>
				</tr>
			</table>
			<table class="seller-details" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td class="slogan" colspan="4">
						<div class="slogan-inner"><?php print($company->slogan ? $company->slogan : 'Слоган компании'); ?></div>
					</td>
				</tr>
				<tr>
					<td class="contact-info">
						<table class="contact-info-inner" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td>
									<span class="inn">ИНН: <?php print ($company->inn ? $company->inn : 'inn'); ?></span>
								</td>
								<td>
									<span class="email"><?php print ($company->contact_email ? $company->contact_email : 'contact_email'); ?></span>
								</td>
								<td>
									<span class="phone"><?php print ($company->phone ? $company->phone : 'phone'); ?></span>
								</td>
								<td>
									<span class="site"><?php print ($company->site ? $company->site : 'site'); ?></span>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>



			<?php


			if($client->fact_address){
				$client->fact_address = str_replace(',', '<br>', $client->fact_address);
			}

			?>

			<table class="basic-info basic-info-customer" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td class="name">
						<span><?php print($client->fulle_name ? $client->fulle_name : 'Клиент'); ?></span>
					</td>
					<td class="icon">
						<img alt="" src="<?php print base_url(); ?>/img/client.png" />
					</td>
					<td class="address">
						<span><?php print($client->fact_address ? $client->fact_address : 'Адрес'); ?></span>
					</td>
					<td class="logo">
						<span>
							<?php print($client->bank_name ? $client->bank_name : 'Название банка'); ?><br> 
							БИК: <?php print $client->bik; ?><br>
							К/с: <?php print $client->korr_schet; ?><br>
							Р/с: <?php print $client->rasch_schet; ?><br>
						</span>
					</td>
				</tr>
			</table>

			<table class="customer-details" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td class="contact-info">
						<table class="contact-info-inner" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td>
									<span class="inn">ИНН: <?php print $client->inn; ?></span>
								</td>
								<td>
									<span class="email"><?php print ($client->contact_email ? $client->contact_email : 'contact_email'); ?></span>
								</td>
								<td>
									<span class="phone"><?php print ($client->phone ? $client->phone : 'phone'); ?></span>
								</td>
								<td>
									<span class="site"><?php print ($client->site ? $client->site : 'site'); ?></span>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>

			<table class="order-info" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td class="order-id">
						№ 0 
					</td>
					<td class="order-date">
						Дата: <?php print date('d.m.Y', time()); ?> 
					</td>
				</tr>
			</table>

			<table class="order" border="0" cellpadding="0" cellspacing="0">
				<tr class="header">
					<td>Арт.</td>
					<td>Название</td>
					<?php if($this->Authmodel->settings('show_char') == 1): ?>
						<td>Хар.</td>
					<?php endif; ?>
					<td>Цена</td>
					<td>Кол-во</td>
					<td>Сумма</td>
				</tr>

						<?php foreach($products as $product): ?>
							<?php $i++; ?>
							<tr class="product <?php print($i%2==0 ? 'odd' : 'even'); ?>">
								<td style="text-align:left;"><?php echo $product->articule;?></td>
								<td style="text-align:left;"><?php echo $product->name;?></td>
								<?php if($this->Authmodel->settings('show_char') == 1): ?>
								<td><?php echo $this->Cart_model->get_char($product->char_guid); ?></td>
								<?php endif; ?>
								<td><?php echo number_format($product->price*$product->evro,2);?></td>
								<td><?php echo $product->number;?></td>
								<td><?php echo number_format($product->price_rur,2); ?></td>                                
							</tr>
						<?php endforeach; ?>

				
				<?php $totalprice = $this->db->query('SELECT sum(price_rur) as total FROM `order_products` WHERE  order_id=0 AND user_guid="'.$this->session->userdata('guid').'"')->row_array(); ?>
				<tr class="order-total">
					<td colspan="4"></td>
					<td class="fill">Итого:</td>
					<td class="fill"><?php print number_format($totalprice['total']); ?> руб.</td>
				</tr>
				 
			</table>
			
			<div class="hr"></div>
			
			<table class="customer-bank-details" border="0" cellpadding="0" cellspacing="0">
				<tr class="top">
					<td class="left">
						<h4>Реквизиты для оплаты:</h4>
					</td>
					<td class="center">
						<h4>Условия оплаты:</h4>
					</td>
					<td class="right">
						Счёт действителен в течение трёх дней
					</td>
				</tr>
				<tr class="bottom">
					<td class="left">
						<?php print $company->bank_name; ?> 
						<br>БИК: <?php print $company->bik; ?>
						<br>К/с: <?php print $company->korr_schet; ?>
						<br>Р/с: <?php print $company->rasch_schet; ?>
					</td>
					<td class="center">
						<h4>Подпись:</h4>
					</td>
					<td class="right">
						<img src="<?php print base_url(); ?>/img/signature.png" style="vertical-align: bottom;" />
					</td>
				</tr>
			</table>
			
		</div>
	</body>
</html>