<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Оптовый заказ</title>
	<link rel="stylesheet" type="text/css" href="/css/style.css" />
    <script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('input[name="form"]').change(function(){
				var el = $(this).val();
				if (el==1){ 
					  $('.block1').removeClass('hidden');
					  $('.block2').addClass('hidden');
				}else {
					  $('.block2').removeClass('hidden');
					  $('.block1').addClass('hidden');
				}
			});
		}); /*end ready*/
	</script>
</head>

<body class="login-page">

	<div class="login-form-holder remind-form-holder">
		<h1>Напомнить пароль</h1>
		<div class="remind-form-radio">
			<label for="blue" class="blue">По логину</label>
			<input type="radio" checked name="form" value="1"/>
			
			<label for="cyan" class="cyan">По ИНН</label>
			<input type="radio" name="form" value="2"/>
		</div>
		<form class="login-form remind-form block1" action="/main/send_remind" method="post">
			<label>Логин</label><input name="login" type="text" />
			<div id="submitbutton">
				<input class="submit" type="submit" value="Отправить" name="submitbutton">
			</div>
		</form>
		<form class="login-form remind-form block2 hidden" action="/main/send_remind" method="post">
			<label>ИНН</label><input name="inn" type="text" />
			<div id="submitbutton">
				<input class="submit" type="submit" value="Отправить" name="submitbutton">
			</div>
		</form>
	</div> 

</body>
</html>