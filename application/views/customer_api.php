<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Документация по API v<?php echo $version; ?></title>
<link rel='stylesheet' type='text/css' media='all' href='/css/api.css' />

<meta http-equiv='expires' content='-1' />
<meta http-equiv= 'pragma' content='no-cache' />
<meta name='robots' content='all' />

</head>
<body>

<!-- START NAVIGATION -->
<div id="nav"><div id="nav_inner"></div></div>
<div id="nav2"><a name="top">&nbsp;</a><a class="topnav" href="<?php echo base_url().'api/#top'; ?>">Наверх</a></div>
<div id="masthead">
<table cellpadding="0" cellspacing="0" border="0" style="width:100%">
<tr>
<td><h1>Документация по API v<?php echo $version; ?></h1></td>
</tr>
</table>
</div>
<!-- END NAVIGATION -->


<!-- START BREADCRUMB -->
<table cellpadding="0" cellspacing="0" border="0" style="width:100%">
<tr>
<td id="breadcrumb">
<a href="<?php echo base_url().'api'; ?>">Документация</a> &nbsp;&#8250;&nbsp;
API
</td>

</tr>
</table>
<!-- END BREADCRUMB -->

<br clear="all" />



<div id="content">
<h1>Описание API v<?php echo $version; ?>:</h1>
<p>Загрузка и выгрузка данных с использованием API осуществляется при помощи GET запросов. Вывод информации в формате JSON.</p>

<h1>Список методов:</h1>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>№</th>
	<th>Название метода</th>
	<th>Назначение метода</th>
</tr>
<tr>
	<td class="td" colspan="3" align="center"><strong>Заказы</strong></td>
</tr>
<tr>
	<td class="td"><strong>1</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#order'; ?>">order</a></strong></td>
	<td class="td">Заказ товаров и оформление заказа</td>
</tr>
<tr>
	<td class="td"><strong>2</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#info'; ?>">info</a></strong></td>
	<td class="td">Вывод данных заказа</td>
</tr>
</table>
</div>

<div id="content"> 
<a name="order"></a>
<h1>Метод order</h1>
<p>Данный метод осуществляет добавление товаров и оформление заказа.</p>
<p class="important">Метод работает с двумя разными типами данных, один служит для добавления товара в корзину, другой служит для оформления заказа</p>
<p>Добавление товаров:</p>
<ul>
	<li>articule - Артикул товара</li>
	<li>num - Количество товара</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Все параметры являются <kbd>ОБЯЗАТЕЛЬНЫМИ</kbd>. При отсутствие обязательных параметров метод вернет ответ "Отсутствуют данные!"</p>
<p>Пример использование метода: </br><var><?php echo base_url().'customer_api/'; ?></var><dfn>order?articule=12345678&name=100</dfn></p>
<br>
<p>Оформление заказа:</p>
<ul>
	<li>status - Статус - completed для оформления</li>
	<li>comment - Комментарий к заказу</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp;параметр status является <kbd>ОБЯЗАТЕЛЬНЫМ</kbd>. При отсутствие обязательных параметров метод вернет ответ "Отсутствуют данные!"</p>
<p>Пример использование метода: </br><var><?php echo base_url().'customer_api/'; ?></var><dfn>order?status=completed&comment=Комментарий к заказу</dfn></p>
</div>

<div id="content"> 
<a name="info"></a>
<h1>Метод info</h1>
<p>Вывод информации о заказе</p>
<p>Список параметров:</p>
<ul>
	<li>Отсутствуют</li>
</ul>
<p>Пример использование метода: </br><var><?php echo base_url().'customer_api/'; ?></var><dfn>info</dfn></p>
</div>

<div style="margin: 40px">
<hr />
	Api v<?php echo $version; ?> системы <a href="http://profishop.us" target="_blank">Profishop</a>.
</div>
</body>
</html>