<div class="cabinet">
	<h1><img src="/img/mobile/profile.png" />Информация об учетной записи</h1>
	<div>
		<ul>
			<li><em>Логин</em><span><?=$user->ulogin?></span></li>
			<li><em>Пароль</em><span><?=$user->upassword?></span></li>
			<li><em>Ваша задолженость</em><span><?=$user->balance?> руб.</span></li>
		</ul>
	</div>
</div>

<div class="cabinet-one">
		<h1>Личные данные</h1>
		<form method="post">
			<span><label>Юр. адрес:</label><input class="" type="text" aria-controls="ct" name="ur_address" value='<?=$user->ur_address?>' disabled> </span>
			<span><label>Факт. адрес:</label><input class="" type="text" aria-controls="ct" name="fact_address" value='<?=$user->fact_address?>' disabled> </span>
			<span><label>ИНН:</label><input class="" type="text" aria-controls="ct" name="inn" value='<?=$user->inn?>' disabled> </span>
			<span><label>КПП:</label><input class="" type="text" aria-controls="ct" name="kpp" value='<?=$user->kpp?>' disabled> </span>
			<span><label>Телефон:</label><input class="" type="text" aria-controls="ct" name="phone" value='<?=$user->phone?>' disabled> </span>
			<span><label>Корр. счет: </label><input class="" type="text" aria-controls="ct" name="korr_schet" value='<?=$user->korr_schet?>' disabled> </span>
			<span><label>Назв. банка:</label><input class="" type="text" aria-controls="ct" name="bank_name" value='<?=$user->bank_name?>' disabled> </span>
			<span><label>БИК:</label><input class="" type="text" aria-controls="ct" name="bik" value='<?=$user->bik?>' disabled> </span>
			<span><label>Расч. счет:</label><input class="" type="text" aria-controls="ct" name="rasch_schet" value='<?=$user->rasch_schet?>' disabled> </span>
			<span><label>Элек. почта:</label><input class="" type="text" aria-controls="ct" name="contact_email" value='<?=$user->contact_email?>' disabled> </span>
			<span><label>Сайт:</label><input class="" type="text" aria-controls="ct" name="site" value='<?=$user->site?>' disabled> </span>
			<span><label>Ф.И.О: </label><input class="" type="text" aria-controls="ct" name="fulle_name" value='<?=$user->fulle_name?>' disabled> </span>
			<!--<span style="width: 492px"><input type="submit" class="submit" value="Изменить" /></span>-->
		</form>
	</div>