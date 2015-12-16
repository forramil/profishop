<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
		<meta name = "viewport" content = "width=device-width"> 
		<meta content="yes" name="apple-mobile-web-app-capable" /> <!-- как приложение воспринимает браузер -->
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<title>Profishop</title>
		<link rel="stylesheet" type="text/css" href="/css/mobile.css" />
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/mobile.js"></script>
	<link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
	<link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />

	
	<script type="text/javascript">
        var siteurl = '<?php echo base_url();?>';
    </script>
	
	<script type="text/javascript" src="/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js"></script>
	<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.5"></script>
	<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
    </head>
    <body>
            <header>
			<div class="top">
				<span class="logo">
					<a id="navbar" href="#menu">
						<span class="icon"></span>
						<span class="icon"></span>
						<span class="icon"></span>
					</a>
					<a id="profile" href="/mobile/profile">
						<img src="/img/mobile/profile.png" />
					</a>
				</span>
			</div>
            <div class="bottom">
				<ul>
						<li <?php if($this->uri->segment(1) == 'mobile' AND $this->uri->segment(2) == NULL OR $this->uri->segment(2) == 'catalog') echo 'class="active"'; ?>><a href="/mobile">Товары</a></li>
						<li <?php if($this->uri->segment(1) == 'mobile' AND $this->uri->segment(2) == 'cart') echo 'class="active"'; ?>><a href="/mobile/cart">Ваш заказ</a><span class="goods"><?php echo number_format($cat['allgoods'],0);?></span></li>
				</ul>
						<div id="ct_filter">
							<div class="text-holder">
								<form method="post" action="/mobile/search">
								<input name="search-text" class="search-text" type="text" aria-controls="ct" placeholder="Поиск...">
								<input name="search-type" class="search-type" type="hidden" value="all">
								</form>
							</div>	
							<div class="select-tab"></div>
							<div class="select-list">
								<a class="select-option selected" value="all" href="#">Все</a>
								<a class="select-option" value="articule" href="#">Артикул</a>
								<a class="select-option" value="name" href="#">Название</a>
								<a class="select-option" value="price" href="#">Цена</a>
							</div>
						</div>	
			</div>
			</header>