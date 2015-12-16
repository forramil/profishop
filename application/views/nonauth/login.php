<!DOCTYPE html> 
<html>
<head>
    <title>Оптовый заказ</title>
	<link rel="stylesheet" type="text/css" href="/css/style.css" />
	<link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
	<link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js"></script>
	<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.5"></script>
	<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<style type="text/css">	
	.manager-list { width:100%; border-collapse: separate; border-spacing:0; font-family: Trebuchet MS, sans-serif!important; }
	.manager-list thead { 
    background: #cddde6; /* Old browsers */
    background: -moz-linear-gradient(top, #cddde6 0%, #adc6d5 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#cddde6), color-stop(100%,#adc6d5)); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, #cddde6 0%,#adc6d5 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top, #cddde6 0%,#adc6d5 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top, #cddde6 0%,#adc6d5 100%); /* IE10+ */
    background: linear-gradient(to bottom, #cddde6 0%,#adc6d5 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cddde6', endColorstr='#adc6d5',GradientType=0 ); /* IE6-9 */
    font-weight:bold;
	}
	.manager-list th {cursor: pointer;}
	.manager-list th, 
	.manager-list td { height:24px; padding:2px 5px; font-size:12px; text-align:left; vertical-align:middle; border:solid 1px #b0c7d5; border-left:none; }
	.manager-list td { border-top:none; }

	.manager-list th:first-child, 
	.manager-list td:first-child { border-left:solid 1px #b0c7d5; }

	.manager-list th:first-child { border-radius:4px 0 0 0; }
	.manager-list th:last-child { border-radius:0 4px 0 0; }
	.manager-list.archive-list th:first-child { border-radius:0; }
	.manager-list.archive-list th:last-child { border-radius:0; }

	.manager-list tr.selected { outline: 1px solid red;}
	.manager-list tr:last-child td:first-child { border-radius: 0 0 0 4px; -moz-outline-radius: 0 0 0 4px; }
	.manager-list tr:last-child td:last-child { border-radius:0 0 4px 0; -moz-outline-radius: 0 0 4px 0; }
	
	.manager-list a.sendmail { float: left; line-height: 10px; margin: 4px 15px 2px 15px; }
	.dataTables_filter {margin-bottom: 10px;}
	.paginate_enabled_previous, .paginate_enabled_next{ margin: 0 10px; font-weight: bold;}

</style>
	<script>
 function login_user() {
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('main/login_process'); ?>",
        data: $(".login-form").serialize(),
        //beforeSend : function(msg){ $("#submitbutton").html('<img src="<?php echo base_url('img/loading.gif'); ?>" />'); },
		beforeSend : function(msg){ $("#submitbutton").html('<input type="submit" class="submit" value="Войти" onclick="login_user()"/>'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            if(msg.substring(1,6) == 'table') {
                $.fancybox({
				helpers : {
					title: {
						type: 'inside'
				}
				},
				title : 'Выберите контрагента',
                content : msg
				});
				$('.manager-list').dataTable( {
				"oLanguage": {
					"sUrl": "js/ru_RU.txt"
				},
					"bLengthChange": false,
					"bFilter": true,
					//"bInfo": false,
					"iDisplayLength": 10,
					"aoData": [ null, { "bSearchable": false }, { "bSearchable": false },{ "bSearchable": false },{ "bSearchable": false } ]
				} );
                //$("#submitbutton").html('<input type="submit" class="submit" value="Войти" onclick="login_user()"/>');
            } 
            else
            { 
                $("#ajax").html(msg); 
            }
        }

    });

 }

 </script>
</head>
<body class="login-page">

	<div class="login-form-holder">
		<h1>Вход в программу</h1>
		<form class="login-form" action="" method="post">
			<div style="margin: 0 20px; "id="ajax"></div>
			<div class="login-holder">
				<?php if (isset($login)): ?>
					<input type="text" name="login" class="login" value="<?php echo $login; ?>" />
				<?php else: ?>
					<input type="text" name="login" class="login" value="" placeholder="Логин" />
				<?php endif; ?>
			</div>
			<div class="password-holder">
				<input type="password" name="password" class="password" value="" placeholder="Пароль" />
			</div>
			<a class="remind_but" href="/remind/">Забыли пароль?</a>
			<div id="submitbutton">
				<input name="submitbutton" type="submit" class="submit" value="Войти" onclick="login_user()"/>
			</div>
		</form>
	</div> 

</body>
</html>