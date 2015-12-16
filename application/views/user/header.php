<!DOCTYPE html>
<html>
<head>
    <title>Оптовый заказ</title>
	
	<link rel="stylesheet" type="text/css" href="/css/style.css" />
	<link rel="stylesheet" type="text/css" href="/css/smoothness/jquery-ui-1.8.16.custom.css" />
		
	<link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
	<link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />

	
	<script type="text/javascript">
        var siteurl = '<?php echo base_url();?>';
    </script>
	
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/jquery-ui-1.9.1.custom.min.js"></script>
	<script type="text/javascript" src="/js/jquery.cookie.js"></script>
	<script type="text/javascript" src="/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js"></script>
	<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.5"></script>
	<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<script type="text/javascript" src="/js/main.js"></script>

</head>

<body>

	<div class="character_overlay"></div>
    <div class="hidden" id="dialog">
        Идет обработка....
    </div>
	
    <div class="wrapper clearfix">
	
        <div class="navigation-bar">
			<a title="Заказы" href="/archive" class="archive"></a>
			<a title="Выйти" href="/logout" class="logout"></a>
			<a title="Личный кабинет" href="/profile" class="profile"></a>
			<a title="Справка" href="<?php print $this->Authmodel->settings('help'); ?>" class="help"></a>
			<a title="Доставка" href="<?php print $this->Authmodel->settings('services'); ?>" class="services"></a>
		</div>
		
        <div class="main-frame clearfix">
		
		    <div class="main-column">
			
                <div class="navigation">
					<img class="navigation-arrow in-<?php print($this->uri->segment(1)); ?>" src="/img/navigation-arrow.png" alt="navigation-arrow" />
                    <a class="button <?php print(($this->uri->segment(1) == 'user' || $this->uri->segment(1) == 'catalog' || $this->uri->segment(1) == 'category') ? 'active' : ''); ?>" href="/user">Перечень товаров</a>
                    <a class="button <?php print($this->uri->segment(1) == 'cart' ? 'active' : ''); ?>" href="/cart/">Ваш заказ</a>
									
					<?php if($this->uri->segment(1) == 'cart'): ?>
						<a class="button <?php print(($this->session->userdata('group')=="yes" || $this->session->userdata('group') == null) ? '' : 'active'); ?>" href="#" onclick="document.order_group.submit();">Показать одним списком</a>
						<a class="button <?php print(($this->session->userdata('group')=="yes" || $this->session->userdata('group') == null) ? 'active' : ''); ?>" href="#" onclick="document.order_group.submit();">Группировать по категориям</a>
						<form method="post" action="" name="order_group">
							<input type="hidden" name="group" value="<?php print(($this->session->userdata('group')=="yes" || $this->session->userdata('group') == null) ? 'no' : 'yes'); ?>" />
						</form>
					<?php else: ?>
						<div id="ct_filter" class="dataTables_filter search-input-holder">
							<!--img class="combine-open" src="/img/combine-open.png" alt="" /-->
							<div class="text-holder">
								<form method="post" action="/search">
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
						<div id="ct_length" class="dataTables_length">
							<label>
							<select name="ct_length" size="1" aria-controls="ct" onchange="per_page(this);">
									<?php $numbs = array('10','25','50','100'); 
										foreach($numbs AS $num){
											$selected = (isset($_COOKIE['per_page']) && $num == $_COOKIE['per_page']) ? ' SELECTED' : '';
											echo '<option value="'.$num.'"'.$selected.'>'.$num.'</option>';
										}
									?>
							</select>
							</label>
					</div>
					<?php endif; ?>
				</div>
			
				<div class="content">
