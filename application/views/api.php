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
<p class="important">АПИ берет данные по guid, то есть если добавлять номенклатуру и в запросе указать category с guid несуществуещей категории в базе, метод вернет ошибку. </p>
<p class="important">Все цены с копейками добавляются через точку. Пример: Сто рублей три копейки будет равен 100.03</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th colspan="2">Порядок добавление данных</th>
</tr>
<tr>
	<td class="td"><strong>1</strong></td>
	<td class="td">Валюта</td>
</tr>
<tr>
	<td class="td"><strong>2</strong></td>
	<td class="td">Тип цены</td>
</tr>
<tr>
	<td class="td"><strong>3</strong></td>
	<td class="td">Пользователи</td>
</tr>
<tr>
	<td class="td"><strong>4</strong></td>
	<td class="td">Категории</td>
</tr>
<tr>
	<td class="td"><strong>5</strong></td>
	<td class="td">Номенклатура</td>
</tr>
<tr>
	<td class="td"><strong>6</strong></td>
	<td class="td">Название характеристик</td>
</tr>
<tr>
	<td class="td"><strong>7</strong></td>
	<td class="td">Характеристики</td>
</tr>
<tr>
	<td class="td"><strong>8</strong></td>
	<td class="td">Цены</td>
</tr>
<tr>
	<td class="td"><strong>9</strong></td>
	<td class="td">Остаток</td>
</tr>
<tr>
	<td class="td"><strong>10</strong></td>
	<td class="td">Заказы</td>
</tr>
</table>
<h1>Список методов:</h1>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>№</th>
	<th>Название метода</th>
	<th>Назначение метода</th>
</tr>
<tr>
	<td class="td" colspan="3" align="center"><strong>Валюта</strong></td>
</tr>
<tr>
	<td class="td"><strong>1</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#add_currency'; ?>">add_currency</a></strong></td>
	<td class="td">Добавление валюты</td>
</tr>
<tr>
	<td class="td"><strong>2</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#currency'; ?>">currency</a></strong></td>
	<td class="td">Вывод информации о валюте</td>
</tr>
<tr>
	<td class="td"><strong>3</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#del_currency'; ?>">del_currency</a></strong></td>
	<td class="td">Удаление валюты</td>
</tr>
<tr>
	<td class="td" colspan="3" align="center"><strong>Номенклатура</strong></td>
</tr>
<tr>
	<td class="td"><strong>4</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#add_product'; ?>">add_product</a></strong></td>
	<td class="td">Добавление номенклатуры</td>
</tr>
<tr>
	<td class="td"><strong>5</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#products'; ?>">products</a></strong></td>
	<td class="td">Вывод информации о номенклатуре</td>
</tr>
<tr>
	<td class="td"><strong>6</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#del_product'; ?>">del_product</a></strong></td>
	<td class="td">Удаление номенклатуры</td>
</tr>
<tr>
	<td class="td" colspan="3" align="center"><strong>Категории</strong></td>
</tr>
<tr>
	<td class="td"><strong>7</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#add_category'; ?>">add_category</a></strong></td>
	<td class="td">Добавление категорий</td>
</tr>
<tr>
	<td class="td"><strong>8</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#category'; ?>">category</a></strong></td>
	<td class="td">Вывод информации о категориях</td>
</tr>
<tr>
	<td class="td"><strong>9</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#del_category'; ?>">del_category</a></strong></td>
	<td class="td">Удаление категорий</td>
</tr>
<tr>
	<td class="td" colspan="3" align="center"><strong>Пользователи</strong></td>
</tr>
<tr>
	<td class="td"><strong>10</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#add_user'; ?>">add_user</a></strong></td>
	<td class="td">Добавление пользователя</td>
</tr>
<tr>
	<td class="td"><strong>11</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#users'; ?>">users</a></strong></td>
	<td class="td">Вывод информации о пользователях</td>
</tr>
<tr>
	<td class="td"><strong>12</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#password'; ?>">password</a></strong></td>
	<td class="td">Изменение пароля</td>
</tr>
<tr>
	<td class="td"><strong>13</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#balance'; ?>">balance</a></strong></td>
	<td class="td">Изменение баланса</td>
</tr>
<tr>
	<td class="td"><strong>14</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#del_user'; ?>">del_user</a></strong></td>
	<td class="td">Удаление пользователя</td>
</tr>
<tr>
	<td class="td" colspan="3" align="center"><strong>Тип цен</strong></td>
</tr>
<tr>
	<td class="td"><strong>15</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#add_type'; ?>">add_type</a></strong></td>
	<td class="td">Добавление типа цены</td>
</tr>
<tr>
	<td class="td"><strong>16</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#type'; ?>">type</a></strong></td>
	<td class="td">Вывод типа цены</td>
</tr>
<tr>
	<td class="td"><strong>17</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#del_type'; ?>">del_type</a></strong></td>
	<td class="td">Удаление типа цены</td>
</tr>
<tr>
	<td class="td" colspan="3" align="center"><strong>Характеристики</strong></td>
</tr>
<tr>
	<td class="td"><strong>18</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#add_char'; ?>">add_char</a></strong></td>
	<td class="td">Добавление характеристики</td>
</tr>
<tr>
	<td class="td"><strong>19</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#char'; ?>">char</a></strong></td>
	<td class="td">Вывод характеристики</td>
</tr>
<tr>
	<td class="td"><strong>20</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#del_char'; ?>">del_char</a></strong></td>
	<td class="td">Удаление характеристики</td>
</tr>
<tr>
	<td class="td" colspan="3" align="center"><strong>Свойства характеристик</strong></td>
</tr>
<tr>
	<td class="td"><strong>21</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#add_char_prop'; ?>">add_char_prop</a></strong></td>
	<td class="td">Добавление свойств характеристик</td>
</tr>
<tr>
	<td class="td"><strong>22</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#char_prop'; ?>">char_prop</a></strong></td>
	<td class="td">Вывод свойств характеристик</td>
</tr>
<tr>
	<td class="td"><strong>23</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#del_char_prop'; ?>">del_char_prop</a></strong></td>
	<td class="td">Удаление свойств характеристик</td>
</tr>
<tr>
	<td class="td" colspan="3" align="center"><strong>Типов свойств характеристик</strong></td>
</tr>
<tr>
	<td class="td"><strong>24</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#add_char_type'; ?>">add_char_type</a></strong></td>
	<td class="td">Добавление типов свойств характеристик</td>
</tr>
<tr>
	<td class="td"><strong>25</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#char_type'; ?>">char_type</a></strong></td>
	<td class="td">Вывод типов свойств характеристик</td>
</tr>
<tr>
	<td class="td"><strong>26</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#del_char_type'; ?>">del_char_type</a></strong></td>
	<td class="td">Удаление типов свойств характеристик</td>
</tr>
<tr>
	<td class="td" colspan="3" align="center"><strong>Остаток</strong></td>
</tr>
<tr>
	<td class="td"><strong>27</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#add_remain'; ?>">add_remain</a></strong></td>
	<td class="td">Добавление остатка</td>
</tr>
<tr>
	<td class="td"><strong>28</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#remain'; ?>">remain</a></strong></td>
	<td class="td">Вывод остатков</td>
</tr>
<tr>
	<td class="td"><strong>29</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#del_remain'; ?>">del_remain</a></strong></td>
	<td class="td">Удаление остатка</td>
</tr>
<tr>
	<td class="td"><strong>30</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#add_graph'; ?>">add_graph</a></strong></td>
	<td class="td">Добавление кол-ва остатка</td>
</tr>
<tr>
	<td class="td"><strong>31</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#graph'; ?>">graph</a></strong></td>
	<td class="td">Вывод кол-ва остатков</td>
</tr>
<tr>
	<td class="td"><strong>32</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#del_graph'; ?>">del_graph</a></strong></td>
	<td class="td">Удаление кол-ва остатка</td>
</tr>
<tr>
	<td class="td" colspan="3" align="center"><strong>Цены</strong></td>
</tr>
<tr>
	<td class="td"><strong>33</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#add_price'; ?>">add_price</a></strong></td>
	<td class="td">Добавление цен</td>
</tr>
<tr>
	<td class="td"><strong>34</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#prices'; ?>">prices</a></strong></td>
	<td class="td">Вывод цен</td>
</tr>
<tr>
	<td class="td"><strong>35</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#del_price'; ?>">del_price</a></strong></td>
	<td class="td">Удаление всех цен</td>
</tr>
<tr>
	<td class="td" colspan="3" align="center"><strong>Заказы</strong></td>
</tr>
<tr>
	<td class="td"><strong>36</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#add_order_main'; ?>">add_order_main</a></strong></td>
	<td class="td">Добавление общего заказа</td>
</tr>
<tr>
	<td class="td"><strong>37</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#add_order'; ?>">add_order</a></strong></td>
	<td class="td">Добавление подробного заказа</td>
</tr>
<tr>
	<td class="td"><strong>38</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#orders'; ?>">orders</a></strong></td>
	<td class="td">Вывод заказов</td>
</tr>
<tr>
	<td class="td"><strong>39</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#order_guid'; ?>">order_guid</a></strong></td>
	<td class="td">Задать Guid заказу</td>
</tr>
<tr>
	<td class="td"><strong>40</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#del_order'; ?>">del_order</a></strong></td>
	<td class="td">Удаление заказов по guid</td>
</tr>
<tr>
	<td class="td" colspan="3" align="center"><strong>Настройки</strong></td>
</tr>
<tr>
	<td class="td"><strong>41</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#add_setting'; ?>">add_setting</a></strong></td>
	<td class="td">Добавление или изменение настроек</td>
</tr>
<tr>
	<td class="td"><strong>42</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#setting'; ?>">setting</a></strong></td>
	<td class="td">Вывод настроек</td>
</tr>
<tr>
	<td class="td" colspan="3" align="center"><strong>О компании</strong></td>
</tr>
<tr>
	<td class="td"><strong>41</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#add_company'; ?>">add_company</a></strong></td>
	<td class="td">Изменение информации о компании</td>
</tr>
<tr>
	<td class="td"><strong>42</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#company'; ?>">company</a></strong></td>
	<td class="td">Вывод информации о компании</td>
</tr>
<tr>
	<td class="td" colspan="3" align="center"><strong>Изображения номенклатуры</strong></td>
</tr>
<tr>
	<td class="td"><strong>43</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#add_image'; ?>">add_image</a></strong></td>
	<td class="td">Загрузка изображения номенклатуры</td>
</tr>
<tr>
	<td class="td"><strong>44</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#images'; ?>">images</a></strong></td>
	<td class="td">Вывод информации о изображениях</td>
</tr>
<tr>
	<td class="td"><strong>45</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#del_image'; ?>">del_image</a></strong></td>
	<td class="td">Удаление изображений</td>
</tr>
<tr>
	<td class="td" colspan="3" align="center"><strong>Изображения номенклатуры</strong></td>
</tr>
<tr>
	<td class="td"><strong>46</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#add_manager'; ?>">add_manager</a></strong></td>
	<td class="td">Добавление менеджера к пользователю</td>
</tr>
<tr>
	<td class="td"><strong>47</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#managers'; ?>">managers</a></strong></td>
	<td class="td">Вывод информации о менеджерах</td>
</tr>
<tr>
	<td class="td"><strong>48</strong></td>
	<td class="td"><strong><a href="<?php echo base_url().'api/#del_manager'; ?>">del_manager</a></strong></td>
	<td class="td">Удаление менеджера</td>
</tr>
</table>
</div>

<div id="content"> 
<a name="add_currency"></a>
<h1>Метод add_currency</h1>
<p>Данный метод осуществляет добавление валюты.</p>
<p>Список параметров:</p>
<ul>
	<li>name - Название</li>
	<li>rate - Курс</li>
	<li>guid - GUID валюты</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Все параметры являются <kbd>ОБЯЗАТЕЛЬНЫМИ</kbd>. При отсутствие обязательных параметров метод вернет ответ "Отсутствуют данные!"</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>name</strong></td>
	<td class="td">Обозначение валюты</td>
</tr>
<tr>
	<td class="td"><strong>rate</strong></td>
	<td class="td">Курс валюты</td>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid валюты</td>
</tr>
</table>
<p>Пример использование метода: </br><var><?php echo base_url().'api/'; ?></var><dfn>add_currency?name=Обозначение&rate=Курс&guid=Guid_валюты</dfn></p>
</div>

<div id="content"> 
<a name="currency"></a>
<h1>Метод currency</h1>
<p>Данный метод осуществляет вывод информации о валюте или вывод всех валют.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - GUID валюты</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Если параметр guid не передан будут выведены <kbd>ВСЕ</kbd> валюты.</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid валюты</td>
</tr>
</table>
<p>Существуют два принципа использования: 
</br><strong>1.</strong> Вывод всех валют: <var><?php echo base_url().'api/'; ?></var><dfn>currency</dfn>
</br><strong>2.</strong> Вывод валюты по guid: <var><?php echo base_url().'api/'; ?></var><dfn>currency?guid=GUID</dfn>
</p>
</div>

<div id="content"> <!-- del_currency -->
<a name="del_currency"></a>
<h1>Метод del_currency</h1>
<p>Данный метод осуществляет удаление валюты или удаление всех валют.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - GUID валюты</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Параметр guid <kbd>ОБЯЗАТЕЛЬНЫЙ</kbd>.</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid валюты или all для удаления всех валют</td>
</tr>
</table>
<p>Существуют два принципа использования: 
</br><strong>1.</strong> Удаление всех валют: <var><?php echo base_url().'api/'; ?></var><dfn>del_currency?guid=all</dfn>
</br><strong>2.</strong> Удаление валюты по guid: <var><?php echo base_url().'api/'; ?></var><dfn>del_currency?guid=GUID</dfn>
</p>
</div>

<div id="content"> <!-- add_products -->
<a name="add_product"></a>
<h1>Метод add_product</h1>
<p>Данный метод осуществляет добавление номенклатуры.</p>
<p>Список параметров:</p>
<ul>
	<li>name - Название</li>
	<li>articule - Артикул</li>
	<li>category - GUID категории</li>
	<li>guid - GUID номенклатуры</li>
	<li>status - Статус(0 - выкл., 1 - вкл.)</li>
	<li>unit - Размерность</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Все параметры являются <kbd>ОБЯЗАТЕЛЬНЫМИ</kbd>. При отсутствие обязательных параметров метод вернет ответ "Отсутствуют данные!"</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>name</strong></td>
	<td class="td">Название номенклатуры</td>
</tr>
<tr>
	<td class="td"><strong>articule</strong></td>
	<td class="td">Артикул номенклатуры</td>
</tr>
<tr>
	<td class="td"><strong>category</strong></td>
	<td class="td">Guid категории</td>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid номенклатуры</td>
</tr>
<tr>
	<td class="td"><strong>status</strong></td>
	<td class="td">Статус, 0 или 1.</td>
</tr>
<tr>
	<td class="td"><strong>unit</strong></td>
	<td class="td">Размерность(шт., кг., см. и т.д.)</td>
</tr>
</table>
<p>Пример использование метода: </br><var><?php echo base_url().'api/'; ?></var><dfn>add_product?name=Название&articule=Артикул&category=Guid_категории&guid=Guid_номенклатуры&status=Статус&unit=Размерность</dfn></p>
</div>

<div id="content"> <!-- products -->
<a name="products"></a>
<h1>Метод products</h1>
<p>Данный метод осуществляет вывод информации о номенклатуре или вывод всех номенклатур.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - GUID номенклатуры</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Если параметр guid не передан будут выведены <kbd>ВСЕ</kbd> номенклатуры.</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid номенклатуры</td>
</tr>
</table>
<p>Существуют два принципа использования: 
</br><strong>1.</strong> Вывод всех номенклатур: <var><?php echo base_url().'api/'; ?></var><dfn>products</dfn>
</br><strong>2.</strong> Вывод номенклатуры по guid: <var><?php echo base_url().'api/'; ?></var><dfn>products?guid=GUID</dfn>
</p>
</div>

<div id="content"> <!-- del_product -->
<a name="del_product"></a>
<h1>Метод del_product</h1>
<p>Данный метод осуществляет удаление номенклатуры или удаление всех номенклатур.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - GUID номенклатуры</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Параметр guid <kbd>ОБЯЗАТЕЛЬНЫЙ</kbd>.</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid номенклатуры или all для удаления всех номенклатур</td>
</tr>
</table>
<p>Существуют два принципа использования: 
</br><strong>1.</strong> Удаление всех номенклатур: <var><?php echo base_url().'api/'; ?></var><dfn>del_product?guid=all</dfn>
</br><strong>2.</strong> Удаление номенклатуры по guid: <var><?php echo base_url().'api/'; ?></var><dfn>del_product?guid=GUID</dfn>
</p>
</div>

<div id="content"> <!-- add_category -->
<a name="add_category"></a>
<h1>Метод add_category</h1>
<p>Данный метод осуществляет добавление категории и подкатегорий.</p>
<p>Список параметров:</p>
<ul>
	<li>name - Название</li>
	<li>parent - Подкатегория, если нет равно 0</li>
	<li>guid - GUID категории</li>
	<li>status - Статус(0 - выкл., 1 - вкл.)</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Все параметры являются <kbd>ОБЯЗАТЕЛЬНЫМИ</kbd>. При отсутствие обязательных параметров метод вернет ответ "Отсутствуют данные!"</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>name</strong></td>
	<td class="td">Название категории</td>
</tr>
<tr>
	<td class="td"><strong>parent</strong></td>
	<td class="td">Guid подкатегории товара, либо 0 если подкатегории нет</td>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid категории</td>
</tr>
<tr>
	<td class="td"><strong>status</strong></td>
	<td class="td">Статус, 0 или 1.</td>
</tr>
</table>
<p>Пример использование метода: </br><var><?php echo base_url().'api/'; ?></var><dfn>add_category?name=Название&parent=Guid_подкатегории&guid=Guid_категории&status=Статус</dfn></p>
</div>


<div id="content"> <!-- category -->
<a name="category"></a>
<h1>Метод category</h1>
<p>Данный метод осуществляет вывод информации о категории или вывод всех категорий.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - GUID категории</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Если параметр guid не передан будут выведены <kbd>ВСЕ</kbd> категории.</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid категории</td>
</tr>
</table>
<p>Существуют два принципа использования: 
</br><strong>1.</strong> Вывод всех категорий: <var><?php echo base_url().'api/'; ?></var><dfn>category</dfn>
</br><strong>2.</strong> Вывод категории по guid: <var><?php echo base_url().'api/'; ?></var><dfn>category?guid=GUID</dfn>
</p>
</div>

<div id="content"> <!-- del_category -->
<a name="del_category"></a>
<h1>Метод del_category</h1>
<p>Данный метод осуществляет удаление категории или удаление всех категорий.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - GUID номенклатуры</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Параметр guid <kbd>ОБЯЗАТЕЛЬНЫЙ</kbd>.</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid категории или all для удаления всех категорий</td>
</tr>
</table>
<p>Существуют два принципа использования: 
</br><strong>1.</strong> Удаление всех категорий: <var><?php echo base_url().'api/'; ?></var><dfn>del_category?guid=all</dfn>
</br><strong>2.</strong> Удаление категории по guid: <var><?php echo base_url().'api/'; ?></var><dfn>del_category?guid=GUID</dfn>
</p>
</div>

<div id="content"> <!-- add_user -->
<a name="add_user"></a>
<h1>Метод add_user</h1>
<p>Данный метод осуществляет добавление пользователей.</p>
<p>Список параметров:</p>
<ul>
	<li>login - Логин</li>
	<li>pass - Пароль</li>
	<li>guid - GUID пользователя</li>
	<li>type_of_price_guid - Тип цены пользователя</li>
	<li>balance - Баланс пользователя</li>
	<li>ur_add - Юридический адрес</li>
	<li>fact_add - Фактический адрес</li>
	<li>inn - ИНН</li>
	<li>kpp - КПП</li>
	<li>phone - Телефон</li>
	<li>korr_schet - Счет какой то</li>
	<li>bank - Банк</li>
	<li>bik - Банк</li>
	<li>ras_sch - Расчетный счет</li>
	<li>email - Электронная почта</li>
	<li>site - Ссылка на сайт</li>
	<li>name - Ф.И.О.</li>
	<li>manager - тип пользователя (1 если менеджер, 0 если пользователь)</li>
	<li>status - статус пользователя (1 если активирован, 0 если заблокирован)</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Параметры <strong>login, pass, guid, type_of_price_guid</strong> являются <kbd>ОБЯЗАТЕЛЬНЫМИ</kbd>. При отсутствие обязательных параметров метод вернет ответ "Отсутствуют данные!"</p>
<h2>Использование:</h2>
<p>Пример использование метода: </br><var><?php echo base_url().'api/'; ?></var><dfn>add_user?login=login&pass=pass&guid=guid&type_of_price_guid=type&balance=100.02&ur_add=ur_add&fact_add=fact_add&inn=inn&kpp=kpp&phone=phone&korr_schet=korr_schet&bank=bank&bik=bik&ras_sch=ras_sch&email=email&site=site&name=name&manager=0&status=1</dfn></p>
</div>


<div id="content"> <!-- users -->
<a name="users"></a>
<h1>Метод users</h1>
<p>Данный метод осуществляет вывод информации о пользователи или вывод всех пользователей.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - GUID пользователя</li>
	<li>login - Логин пользователя</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Если параметр guid или login не передан будут выведены <kbd>ВСЕ</kbd> пользователи.</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid пользователя</td>
</tr>
<tr>
	<td class="td"><strong>login</strong></td>
	<td class="td">Логин пользователя</td>
</tr>
</table>
<p>Существуют три принципа использования: 
</br><strong>1.</strong> Вывод всех пользователей: <var><?php echo base_url().'api/'; ?></var><dfn>users</dfn>
</br><strong>2.</strong> Вывод пользователя по guid: <var><?php echo base_url().'api/'; ?></var><dfn>users?guid=GUID</dfn>
</br><strong>2.</strong> Вывод пользователя по логину: <var><?php echo base_url().'api/'; ?></var><dfn>users?login=LOGIN</dfn>
</p>
</div>

<div id="content"> <!-- password -->
<a name="password"></a>
<h1>Метод password</h1>
<p>Данный метод осуществляет смену пароля у пользователя.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - GUID пользователя</li>
	<li>password - Новый пароль</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Все параметры являются <kbd>ОБЯЗАТЕЛЬНЫМИ</kbd>. При отсутствие обязательных параметров метод вернет ответ "Отсутствуют данные!"</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid пользователя</td>
</tr>
<tr>
	<td class="td"><strong>password</strong></td>
	<td class="td">Пароль пользователя</td>
</tr>
</table>
<p>Пример использование метода: </br><var><?php echo base_url().'api/'; ?></var><dfn>password?guid=GUID&password=Пароль</dfn></p>
</div>

<div id="content"> <!-- balance -->
<a name="balance"></a>
<h1>Метод balance</h1>
<p>Данный метод осуществляет смену баланса у пользователя.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - GUID пользователя</li>
	<li>balance - Баланс</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Все параметры являются <kbd>ОБЯЗАТЕЛЬНЫМИ</kbd>. При отсутствие обязательных параметров метод вернет ответ "Отсутствуют данные!"</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid пользователя</td>
</tr>
<tr>
	<td class="td"><strong>balance</strong></td>
	<td class="td">Баланс пользователя</td>
</tr>
</table>
<p>Пример использование метода: </br><var><?php echo base_url().'api/'; ?></var><dfn>balance?guid=GUID&balance=232.05</dfn></p>
</div>

<div id="content"> <!-- del_user -->
<a name="del_user"></a>
<h1>Метод del_user</h1>
<p>Данный метод осуществляет удаление пользователя или удаление всех пользователей.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - GUID пользователя</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Параметр guid <kbd>ОБЯЗАТЕЛЬНЫЙ</kbd>.</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid пользователя или all для удаления всех пользователей</td>
</tr>
</table>
<p>Существуют два принципа использования: 
</br><strong>1.</strong> Удаление всех пользователей: <var><?php echo base_url().'api/'; ?></var><dfn>del_user?guid=all</dfn>
</br><strong>2.</strong> Удаление пользователя по guid: <var><?php echo base_url().'api/'; ?></var><dfn>del_user?guid=GUID</dfn>
</p>
</div>

<div id="content"> <!-- add_type -->
<a name="add_type"></a>
<h1>Метод add_type</h1>
<p>Данный метод осуществляет добавление типа цены.</p>
<p>Список параметров:</p>
<ul>
	<li>name - Название</li>
	<li>valuta - GUID валюты</li>
	<li>guid - GUID типа цены</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Все параметры являются <kbd>ОБЯЗАТЕЛЬНЫМИ</kbd>. При отсутствие обязательных параметров метод вернет ответ "Отсутствуют данные!"</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>name</strong></td>
	<td class="td">Название</td>
</tr>
<tr>
	<td class="td"><strong>valuta</strong></td>
	<td class="td">Guid валюты</td>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid типа цены</td>
</tr>
</table>
<p>Пример использование метода: </br><var><?php echo base_url().'api/'; ?></var><dfn>add_type?name=Название&valuta=GUID_валюты&guid=guid</dfn></p>
</div>


<div id="content"> <!-- type -->
<a name="type"></a>
<h1>Метод type</h1>
<p>Данный метод осуществляет вывод информации о типах цен или вывод всех типов цен.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - GUID типа цены</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Если параметр guid не передан будут выведены <kbd>ВСЕ</kbd> типы цен.</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid типа цены</td>
</tr>
</table>
<p>Существуют два принципа использования: 
</br><strong>1.</strong> Вывод всех типов цен: <var><?php echo base_url().'api/'; ?></var><dfn>type</dfn>
</br><strong>2.</strong> Вывод типа цены по guid: <var><?php echo base_url().'api/'; ?></var><dfn>type?guid=GUID</dfn>
</p>
</div>

<div id="content"> <!-- del_type -->
<a name="del_type"></a>
<h1>Метод del_type</h1>
<p>Данный метод осуществляет удаление типа цены или удаление всех типов цен.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - Guid типа цены</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Параметр guid <kbd>ОБЯЗАТЕЛЬНЫЙ</kbd>.</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid типа цены или all для удаления всех типов цен</td>
</tr>
</table>
<p>Существуют два принципа использования: 
</br><strong>1.</strong> Удаление всех типов цен: <var><?php echo base_url().'api/'; ?></var><dfn>del_type?guid=all</dfn>
</br><strong>2.</strong> Удаление типа цены по guid: <var><?php echo base_url().'api/'; ?></var><dfn>del_type?guid=GUID</dfn>
</p>
</div>

<div id="content"> <!-- add_char -->
<a name="add_char"></a>
<h1>Метод add_char</h1>
<p>Данный метод осуществляет добавление характеристики.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - GUID характеристики</li>
	<li>property - GUID свойства характеристики</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Все параметры являются <kbd>ОБЯЗАТЕЛЬНЫМИ</kbd>. При отсутствие обязательных параметров метод вернет ответ "Отсутствуют данные!"</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>property</strong></td>
	<td class="td">GUID свойства характеристики</td>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid характеристики</td>
</tr>
</table>
<p>Пример использование метода: </br><var><?php echo base_url().'api/'; ?></var><dfn>add_char?property=Guid_property&guid=guid</dfn></p>
</div>


<div id="content"> <!-- char -->
<a name="char"></a>
<h1>Метод char</h1>
<p>Данный метод осуществляет вывод информации о характеристики или вывод всех характеристик.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - GUID характеристики</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Если параметр guid не передан будут выведены <kbd>ВСЕ</kbd> характеристики.</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid характеристики</td>
</tr>
</table>
<p>Существуют два принципа использования: 
</br><strong>1.</strong> Вывод всех характеристик: <var><?php echo base_url().'api/'; ?></var><dfn>char</dfn>
</br><strong>2.</strong> Вывод характеристики по guid: <var><?php echo base_url().'api/'; ?></var><dfn>char?guid=GUID</dfn>
</p>
</div>

<div id="content"> <!-- del_char -->
<a name="del_char"></a>
<h1>Метод del_char</h1>
<p>Данный метод осуществляет удаление характеристики или удаление всех характеристик.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - Guid характеристики</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Параметр guid <kbd>ОБЯЗАТЕЛЬНЫЙ</kbd>.</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid характеристики или all для удаления всех характеристик</td>
</tr>
</table>
<p>Существуют два принципа использования: 
</br><strong>1.</strong> Удаление всех характеристик: <var><?php echo base_url().'api/'; ?></var><dfn>del_char?guid=all</dfn>
</br><strong>2.</strong> Удаление характеристики по guid: <var><?php echo base_url().'api/'; ?></var><dfn>del_char?guid=GUID</dfn>
</p>
</div>

<div id="content"> <!-- add_char_prop -->
<a name="add_char_prop"></a>
<h1>Метод add_char_prop</h1>
<p>Данный метод осуществляет добавление свойств характеристик.</p>
<p>Список параметров:</p>
<ul>
	<li>name - Название характеристики</li>
	<li>char_type - Guid Тип свойства</li>
	<li>guid - GUID</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Все параметры являются <kbd>ОБЯЗАТЕЛЬНЫМИ</kbd></p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>name</strong></td>
	<td class="td">Название</td>
</tr>
<tr>
	<td class="td"><strong>char_type</strong></td>
	<td class="td">Guid Тип свойства</td>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid</td>
</tr>
</table>
<p>Пример использование метода: </br><var><?php echo base_url().'api/'; ?></var><dfn>add_char_prop?name=Название1&char_type=Guid_type_char&guid=guid</dfn></p>
</div>


<div id="content"> <!-- char_prop -->
<a name="char_prop"></a>
<h1>Метод char_prop</h1>
<p>Данный метод осуществляет вывод информации о свойствах характеристик или вывод всех свойств характеристик.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - GUID свойства характеристик</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Если параметр guid не передан будут выведены <kbd>ВСЕ</kbd> свойства характеристик.</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid свойства характеристик</td>
</tr>
</table>
<p>Существуют два принципа использования: 
</br><strong>1.</strong> Вывод всех характеристик: <var><?php echo base_url().'api/'; ?></var><dfn>char_prop</dfn>
</br><strong>2.</strong> Вывод характеристики по guid: <var><?php echo base_url().'api/'; ?></var><dfn>char_prop?guid=GUID</dfn>
</p>
</div>

<div id="content"> <!-- del_char_prop -->
<a name="del_char_prop"></a>
<h1>Метод del_char_prop</h1>
<p>Данный метод осуществляет удаление свойств характеристик или удаление всех свойств характеристик.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - Guid свойства характеристики</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Параметр guid <kbd>ОБЯЗАТЕЛЬНЫЙ</kbd>.</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid свойства характеристики или all для удаления всех свойств характеристик</td>
</tr>
</table>
<p>Существуют два принципа использования: 
</br><strong>1.</strong> Удаление всех названий характеристик: <var><?php echo base_url().'api/'; ?></var><dfn>del_char_prop?guid=all</dfn>
</br><strong>2.</strong> Удаление названия характеристики по guid: <var><?php echo base_url().'api/'; ?></var><dfn>del_char_prop?guid=GUID</dfn>
</p>
</div>

<div id="content"> <!-- add_char_type -->
<a name="add_char_type"></a>
<h1>Метод add_char_type</h1>
<p>Данный метод осуществляет добавление типа свойств характеристик.</p>
<p>Список параметров:</p>
<ul>
	<li>name - Название типа характеристики</li>
	<li>guid - GUID</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Все параметры являются <kbd>ОБЯЗАТЕЛЬНЫМИ</kbd></p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>name</strong></td>
	<td class="td">Название</td>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid</td>
</tr>
</table>
<p>Пример использование метода: </br><var><?php echo base_url().'api/'; ?></var><dfn>add_char_type?name=Название&guid=guid</dfn></p>
</div>


<div id="content"> <!-- char_type -->
<a name="char_type"></a>
<h1>Метод char_type</h1>
<p>Данный метод осуществляет вывод информации о типе свойств характеристик или вывод всех типов свойств характеристик.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - GUID свойства характеристик</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Если параметр guid не передан будут выведены <kbd>ВСЕ</kbd> свойства характеристик.</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid свойства характеристик</td>
</tr>
</table>
<p>Существуют два принципа использования: 
</br><strong>1.</strong> Вывод всех характеристик: <var><?php echo base_url().'api/'; ?></var><dfn>char_type</dfn>
</br><strong>2.</strong> Вывод характеристики по guid: <var><?php echo base_url().'api/'; ?></var><dfn>char_type?guid=GUID</dfn>
</p>
</div>

<div id="content"> <!-- del_char_type -->
<a name="del_char_type"></a>
<h1>Метод del_char_type</h1>
<p>Данный метод осуществляет удаление типа свойств характеристик или удаление всех типов свойств характеристик.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - Guid типа свойства характеристики</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Параметр guid <kbd>ОБЯЗАТЕЛЬНЫЙ</kbd>.</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid типа свойства характеристики или all для удаления всех свойств характеристик</td>
</tr>
</table>
<p>Существуют два принципа использования: 
</br><strong>1.</strong> Удаление всех названий характеристик: <var><?php echo base_url().'api/'; ?></var><dfn>del_char_type?guid=all</dfn>
</br><strong>2.</strong> Удаление названия характеристики по guid: <var><?php echo base_url().'api/'; ?></var><dfn>del_char_type?guid=GUID</dfn>
</p>
</div>


<div id="content"> <!-- add_remain -->
<a name="add_remain"></a>
<h1>Метод add_remain</h1>
<p>Данный метод осуществляет добавление остатка.</p>
<p>Список параметров:</p>
<ul>
	<li>remain - Остаток(число)</li>
	<li>product - GUID номенклатуры</li>
	<li>char - GUID характеристики</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Все параметры, кроме <strong>char</strong> являются <kbd>ОБЯЗАТЕЛЬНЫМИ</kbd>. При отсутствие обязательных параметров метод вернет ответ "Отсутствуют данные!"</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>remain</strong></td>
	<td class="td">Остаток, число</td>
</tr>
<tr>
	<td class="td"><strong>product</strong></td>
	<td class="td">Guid номенклатуры</td>
</tr>
<tr>
	<td class="td"><strong>char</strong></td>
	<td class="td">Guid характеристики или 0 если ее нет или можно оставить пустым</td>
</tr>
</table>
<p>Пример использование метода: </br><var><?php echo base_url().'api/'; ?></var><dfn>add_remain?remain=100&product=Guid_номенклатуры&char=Guid_характеристики</dfn></p>
</div>


<div id="content"> <!-- remain -->
<a name="remain"></a>
<h1>Метод remain</h1>
<p>Данный метод осуществляет вывод информации о всех остатках.</p>
<p>Список параметров:</p>
<ul>
	<li>Отстутствуют</li>
</ul>
<h2>Использование:</h2>
<p>Пример использование метода: <var><?php echo base_url().'api/'; ?></var><dfn>remain</dfn></p>
</div>

<div id="content"> <!-- del_remain -->
<a name="del_remain"></a>
<h1>Метод del_remain</h1>
<p>Данный метод осуществляет удаление всех остатков.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - Guid, т.к. данный параметр отсутствует у остатков, он применяется только чтобы удалить все остатки</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Параметр guid <kbd>ОБЯЗАТЕЛЬНЫЙ</kbd>.</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid, т.к. данный параметр отсутствует у остатков, он применяется только чтобы удалить все остатки</td>
</tr>
</table>
<p>Пример использование метода: <var><?php echo base_url().'api/'; ?></var><dfn>del_remain?guid=all</dfn></p>
</div>

<div id="content"> <!-- add_graph -->
<a name="add_graph"></a>
<h1>Метод add_graph</h1>
<p>Данный метод осуществляет добавление кол-ва остатка.</p>
<p>Список параметров:</p>
<ul>
	<li>number - Число от 1 до 10</li>
	<li>max - максимальное значение</li>
	<li>min - минимальное значение</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Все параметры являются <kbd>ОБЯЗАТЕЛЬНЫМИ</kbd>. При отсутствие обязательных параметров метод вернет ответ "Отсутствуют данные!"</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>number</strong></td>
	<td class="td">Число от 1 до 10</td>
</tr>
<tr>
	<td class="td"><strong>max</strong></td>
	<td class="td">максимальное значение</td>
</tr>
<tr>
	<td class="td"><strong>min</strong></td>
	<td class="td">минимальное значение</td>
</tr>
</table>
<p>Пример использование метода: </br><var><?php echo base_url().'api/'; ?></var><dfn>add_graph?number=1&max=0&min=9</dfn></p>
</div>


<div id="content"> <!-- graph -->
<a name="graph"></a>
<h1>Метод graph</h1>
<p>Данный метод осуществляет вывод информации о всех кол-вах остатках.</p>
<p>Список параметров:</p>
<ul>
	<li>Отстутствуют</li>
</ul>
<h2>Использование:</h2>
<p>Пример использование метода: <var><?php echo base_url().'api/'; ?></var><dfn>graph</dfn></p>
</div>

<div id="content"> <!-- del_graph -->
<a name="del_graph"></a>
<h1>Метод del_graph</h1>
<p>Данный метод осуществляет удаление всех кол-в остатков.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - Guid, т.к. данный параметр отсутствует у остатков, он применяется только чтобы удалить все кол-ва остатки</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Параметр guid <kbd>ОБЯЗАТЕЛЬНЫЙ</kbd>.</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid, т.к. данный параметр отсутствует у остатков, он применяется только чтобы удалить все кол-в остатки</td>
</tr>
</table>
<p>Пример использование метода: <var><?php echo base_url().'api/'; ?></var><dfn>del_graph?guid=all</dfn></p>
</div>

<div id="content"> <!-- add_price -->
<a name="add_price"></a>
<h1>Метод add_price</h1>
<p>Данный метод осуществляет добавление цены.</p>
<p>Список параметров:</p>
<ul>
	<li>price - Цена</li>
	<li>product - GUID номенклатуры</li>
	<li>type - GUID типа цены</li>
	<li>valuta - GUID валюты</li>
	<li>char - GUID характеристики</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Все параметры, кроме <strong>char</strong> являются <kbd>ОБЯЗАТЕЛЬНЫМИ</kbd>. При отсутствие обязательных параметров метод вернет ответ "Отсутствуют данные!"</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>price</strong></td>
	<td class="td">Цена</td>
</tr>
<tr>
	<td class="td"><strong>product</strong></td>
	<td class="td">Guid номенклатуры</td>
</tr>
<tr>
	<td class="td"><strong>type</strong></td>
	<td class="td">Guid типа цены</td>
</tr>
<tr>
	<td class="td"><strong>valuta</strong></td>
	<td class="td">Guid валюты</td>
</tr>
<tr>
	<td class="td"><strong>char</strong></td>
	<td class="td">Guid характеристики, если не будет указан, то выставиться 0, то есть без характеристики</td>
</tr>
</table>
<p>Пример использование метода: </br><var><?php echo base_url().'api/'; ?></var><dfn>add_price?price=150&product=GUID_номенклатуры&type=GUID_ТипЦены&valuta=GUID_Валюта&char=GUID_CHAR</dfn></p>
</div>

<div id="content"> <!-- prices -->
<a name="prices"></a>
<h1>Метод prices</h1>
<p>Данный метод осуществляет вывод всех цен.</p>
<p>Список параметров:</p>
<ul>
	<li>ОТСУТСТВУЮТ</li>
</ul>
<h2>Использование:</h2>
<p><strong>1.</strong> Вывод всех цен: <var><?php echo base_url().'api/'; ?></var><dfn>prices</dfn></p>
</div>

<div id="content"> <!-- del_price -->
<a name="del_price"></a>
<h1>Метод del_price</h1>
<p>Данный метод осуществляет удаление всех цен.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - Guid, т.к. данный параметр отсутствует у цен, он применяется только чтобы удалить все цены</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Параметр guid <kbd>ОБЯЗАТЕЛЬНЫЙ</kbd>.</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid, т.к. данный параметр отсутствует у цен, он применяется только чтобы удалить все цены</td>
</tr>
</table>
<p>Пример использование метода: <var><?php echo base_url().'api/'; ?></var><dfn>del_price?guid=all</dfn></p>
</div>

<div id="content"> <!-- add_order_main -->
<a name="add_order_main"></a>
<h1>Метод add_order_main</h1>
<p>Данный метод осуществляет добавление общего заказа. По данному заказу - добавляется более подробные заказы(какая номенклатура, какая характеристика, какое кол-во и т.д.)</p>
<p>Список параметров:</p>
<ul>
	<li>guid - guid общего заказа</li>
	<li>user - GUID пользователя</li>
	<li>comment - Комментарий</li>
	<li>status - Статус 0 или 1</li>
	<li>price - Общая цена заказа</li>
	<li>manager - Guid менеджера, если нету то пусто или 0</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Все параметры, кроме <strong>comment</strong> являются <kbd>ОБЯЗАТЕЛЬНЫМИ</kbd>. При отсутствие обязательных параметров метод вернет ответ "Отсутствуют данные!"</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">guid общего заказа, служит для добавления подробностей о заказе</td>
</tr>
<tr>
	<td class="td"><strong>user</strong></td>
	<td class="td">Guid пользователя</td>
</tr>
<tr>
	<td class="td"><strong>comment</strong></td>
	<td class="td">Комментарий к заказу</td>
</tr>
<tr>
	<td class="td"><strong>status</strong></td>
	<td class="td">Статус 0 или 1</td>
</tr>
<tr>
	<td class="td"><strong>price</strong></td>
	<td class="td">Общая цена заказа</td>
</tr>
</table>
<p>Пример использование метода: </br><var><?php echo base_url().'api/'; ?></var><dfn>add_order_main?guid=Guid&user=Guid_пользователя&comment=Комментарий&status=0_или_1&price=Общая_цена&manager=guid</dfn></p>
</div>

<div id="content"> <!-- add_order -->
<a name="add_order"></a>
<h1>Метод add_order</h1>
<p>Данный метод осуществляет добавление заказов по guid общего заказа.</p>
<p>Список параметров:</p>
<ul>
	<li>order - guid общего заказа, который мы добавили в методе add_order_main</li>
	<li>product - Комментарий</li>
	<li>price - Общая цена заказа</li>
	<li>number - Количество заказаной номенклатуры</li>
	<li>char - GUID характеристики</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Все параметры, кроме <strong>char</strong> являются <kbd>ОБЯЗАТЕЛЬНЫМИ</kbd>. При отсутствие обязательных параметров метод вернет ответ "Отсутствуют данные!"</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>order</strong></td>
	<td class="td">guid общего заказа, который мы добавили в методе add_order_main</td>
</tr>
<tr>
	<td class="td"><strong>product</strong></td>
	<td class="td">Guid номенклатуры</td>
</tr>
<tr>
	<td class="td"><strong>price</strong></td>
	<td class="td">Общая цена заказа</td>
</tr>
<tr>
	<td class="td"><strong>number</strong></td>
	<td class="td">Количество заказаной номенклатуры</td>
</tr>
<tr>
	<td class="td"><strong>char</strong></td>
	<td class="td">Guid пользователя</td>
</tr>
</table>
<p>Пример использование метода: </br><var><?php echo base_url().'api/'; ?></var><dfn>add_order?order=Guid_общего_заказа&product=Guid_номенклатуры&price=Цена&number=Кол-во&char=Guid_характеристики</dfn></p>
</div>

<div id="content"> <!-- orders -->
<a name="orders"></a>
<h1>Метод orders</h1>
<p>Данный метод осуществляет вывод короткой информации о заказе и вывод полный информации о заказе.</p>
<p>Список параметров:</p>
<ul>
	<li>id - Идентификатор заказа</li>
	<li>last - All или число для вывода кол-ва последних необработанных заказов</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Если параметр id не передан, будет выведет короткий список всех заказов.</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>id</strong></td>
	<td class="td">Идентификатор заказа, который можно получить открыв весь список заказов</td>
</tr>
<tr>
	<td class="td"><strong>last</strong></td>
	<td class="td">Guid последнего просмотреного заказа, если данный guid не найдет, система выведет 30 заказов с начала.</td>
</tr>
</table>
<p>Существуют три принципа использования: 
</br><strong>1.</strong> Вывод всех заказов: <var><?php echo base_url().'api/'; ?></var><dfn>orders</dfn>
</br><strong>2.</strong> Вывод необработанных заказов: <var><?php echo base_url().'api/'; ?></var><dfn>orders?last=all</dfn>
</br><strong>3.</strong> Вывод подробностей о заказе по id: <var><?php echo base_url().'api/'; ?></var><dfn>orders?id=Идентификатор</dfn>
</p>
<p class="important">Структура JSON ответа при выводе информации по id:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>order_guid</strong></td>
	<td class="td">Guid заказа</td>
</tr>
<tr>
	<td class="td"><strong>full_price</strong></td>
	<td class="td">Полная цена заказа</td>
</tr>
<tr>
	<td class="td"><strong>date</strong></td>
	<td class="td">Дата и время заказа</td>
</tr>
<tr>
	<td class="td"><strong>comment</strong></td>
	<td class="td">Комментарий к заказу</td>
</tr>
<tr>
	<td class="td"><strong>user_guid</strong></td>
	<td class="td">Guid контрагента</td>
</tr>
<tr>
	<td class="td"><strong>manager_guid</strong></td>
	<td class="td">Guid менеджера ( если заказ сделан не контрагентом ,а его менеджером)</td>
</tr>
<tr>
	<td class="td"><strong>rows</strong></td>
	<td class="td">Подробные данные о заказе</td>
</tr>
<tr>
	<td class="td"><strong>product_guid</strong></td>
	<td class="td">Guid номенклатуры</td>
</tr>
<tr>
	<td class="td"><strong>price</strong></td>
	<td class="td">Цена номенклатуры</td>
</tr>
<tr>
	<td class="td"><strong>number</strong></td>
	<td class="td">Количество заказаной номенклатуры</td>
</tr>
<tr>
	<td class="td"><strong>char_guid</strong></td>
	<td class="td">Guid характеристики</td>
</tr>
</table>
<!--<ul>
	<li>order_guid - Guid заказа</li>
	<li>full_price - Полная цена заказа</li>
	<li>date - Дата и время заказа</li>
	<li>comment - Комментарий к заказу</li>
	<li>user_guid - Guid пользователя </li>
	<li>rows - Подробные данные о заказе</li>
	<ul>
		<li>product_guid - Guid номенклатуры</li>
		<li>price - Цена номенклатуры</li>
		<li>number - Количество заказаной номенклатуры</li>
		<li>char_guid - Guid характеристики</li>
</ul>
</ul>-->
</div>

<div id="content"> <!-- order_guid -->
<a name="order_guid"></a>
<h1>Метод order_guid</h1>
<p>Данный метод задает guid заказу, у которого еще нет guid</p>
<p>Список параметров:</p>
<ul>
	<li>id - ID заказа</li>
	<li>guid - Guid заказа, который мы задаем</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Все параметры <kbd>ОБЯЗАТЕЛЬНЫЕ</kbd>.</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>id</strong></td>
	<td class="td">ID заказа, которому мы выстявляем Guid</td>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid заказа, который мы задаем</td>
</tr>
</table>
<p>Пример использование метода: <var><?php echo base_url().'api/'; ?></var><dfn>order_guid?id=12345&guid=GUID_заказа</dfn></p>
</div>

<div id="content"> <!-- del_order -->
<a name="del_order"></a>
<h1>Метод del_order</h1>
<p>Данный метод осуществляет удаление общего заказа и всех подробных заказов по guid и удаление всех заказов</p>
<p>Список параметров:</p>
<ul>
	<li>guid - Guid заказа или all для удаления всех заказов</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Параметр guid <kbd>ОБЯЗАТЕЛЬНЫЙ</kbd>.</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid заказа</td>
</tr>
</table>
<p>Пример использование метода: <var><?php echo base_url().'api/'; ?></var><dfn>del_order?guid=GUID_заказа</dfn></p>
<p>Для удаления всех заказов: <var><?php echo base_url().'api/'; ?></var><dfn>del_order?guid=all</dfn></p>
</div>

<div id="content"> <!-- add_setting -->
<a name="add_setting"></a>
<h1>Метод add_setting</h1>
<p>Данный метод осуществляет добавление или изменение настроек</p>
<p>Список названий настроек:</p>
<ul>
	<li>help - Ссылка на страницу справки</li>
	<li>services - Ссылка на страницу доставки</li>
	<li>link_for_client_logo - Ссылка логотипа заказчика</li>
	<li>show_char - 0 не показывать, 1 показывать</li>
	<li>show_graph - 0 показыть цифрами, 1 показывать картинками</li>
</ul>
<p>Список параметров:</p>
<ul>
	<li>name - название настройки</li>
	<li>option - значение настройки</li>
</ul>
<h2>Использование:</h2>
<p>Пример использование метода: <var><?php echo base_url().'api/'; ?></var><dfn>add_setting?name=help&option=www.google.com</dfn></p>
</div>

<div id="content"> <!-- add_company -->
<a name="add_company"></a>
<h1>Метод add_company</h1>
<p>Данный метод осуществляет изменение информации о компании</p>
<p>Список параметров:</p>
<ul>
	<li>name - название</li>
	<li>address - адрес</li>
	<li>director - Ф.И.О директора</li>
	<li>inn - инн</li>
	<li>kpp - кпп</li>
	<li>guid - гуид</li>
	<li>rasch_schet - расчетный счет</li>
	<li>bank_name - название банка</li>
	<li>bik - бик</li>
	<li>korr_schet - кор счет</li>
	<li>contact_email - емаил</li>
	<li>site - сайт</li>
	<li>phone - телефон</li>
	<li>slogan - слоган</li>
</ul>
<h2>Использование:</h2>
<p>Пример использование метода: <var><?php echo base_url().'api/'; ?></var><dfn>add_company?name=name&address=Адрес&director=ФИО&inn=ИНН&kpp=КПП&guid=www.google.com&rasch_schet=счет&bank_name=банк&bik=бик&korr_schet=счет&contact_email=емаил&site=www.google.com&phone=телефон&slogan=слоган</dfn></p>
</div>

<div id="content"> <!-- company -->
<a name="company"></a>
<h1>Метод company</h1>
<p>Данный метод осуществляет вывод информации о компании</p>
<p>Список параметров:</p>
<ul>
	<li>Отсутствуют</li>
</ul>
<h2>Использование:</h2>
<p>Пример: <var><?php echo base_url().'api/'; ?></var><dfn>company</dfn></p>
</div>

<div id="content"> <!-- add_image -->
<a name="add_image"></a>
<h1>Метод add_image</h1>
<p>Данный метод осуществляет загрузку изображений номенклатуры.</p>
<p class="important">Данные посылаются через POST запрос!</p>
<p>Список параметров:</p>
<ul>
	<li>uploadfile - Отправляемый файл</li>
	<li>guid - GUID изображения</li>
	<li>product - GUID номенклатуры</li>
	<li>name - Описание к изображению</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Все параметры являются <kbd>ОБЯЗАТЕЛЬНЫМИ</kbd>. При отсутствие обязательных параметров метод вернет ответ "Отсутствуют данные!"</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>uploadfile</strong></td>
	<td class="td">Отправляемый файл</td>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">Guid изображения</td>
</tr>
<tr>
	<td class="td"><strong>product</strong></td>
	<td class="td">Guid номенклатуры</td>
</tr>
<tr>
	<td class="td"><strong>name</strong></td>
	<td class="td">Описание к изображению</td>
</tr>
</table>
</div>

<div id="content"> <!-- images -->
<a name="images"></a>
<h1>Метод images</h1>
<p>Данный метод осуществляет вывод информации о всех изображениях</p>
<p>Список параметров:</p>
<ul>
	<li>Отсутствуют</li>
</ul>
<h2>Использование:</h2>
<p>Пример: <var><?php echo base_url().'api/'; ?></var><dfn>images</dfn></p>
</div>

<div id="content"> <!-- del_image -->
<a name="del_image"></a>
<h1>Метод del_image</h1>
<p>Данный метод осуществляет удаление всех изображений номенклатуры.</p>
<p>Список параметров:</p>
<ul>
	<li>guid - ALL для удаления всех</li>
</ul>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">all для удаления всех изображений</td>
</tr>
</table>
<h2>Использование:</h2>
<p>Пример использование метода: <var><?php echo base_url().'api/'; ?></var><dfn>del_image?guid=all</dfn></p>
</div>

<div id="content"> <!-- add_manager -->
<a name="add_manager"></a>
<h1>Метод add_manager</h1>
<p>Данный метод осуществляет добавление менеджера к пользователю.</p>
<p>Список параметров:</p>
<ul>
	<li>user - GUID пользователя</li>
	<li>manager - GUID менеджера</li>
</ul>
<p class="important"><strong>Важно:</strong>&nbsp; Все параметры являются <kbd>ОБЯЗАТЕЛЬНЫМИ</kbd>. При отсутствие обязательных параметров метод вернет ответ "Отсутствуют данные!"</p>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>user</strong></td>
	<td class="td">GUID пользователя</td>
</tr>
<tr>
	<td class="td"><strong>manager</strong></td>
	<td class="td">GUID менеджера</td>
</tr>
</table>
<h2>Использование:</h2>
<p>Пример использование метода: <var><?php echo base_url().'api/'; ?></var><dfn>add_manager?user=guid&manager=guid</dfn></p>
</div>

<div id="content"> <!-- managers -->
<a name="managers"></a>
<h1>Метод managers</h1>
<p>Данный метод осуществляет вывод информации о менеджерах</p>
<p>Список параметров:</p>
<ul>
	<li>Отсутствуют</li>
</ul>
<h2>Использование:</h2>
<p>Пример: <var><?php echo base_url().'api/'; ?></var><dfn>managers</dfn></p>
</div>

<div id="content"> <!-- del_manager -->
<a name="del_manager"></a>
<h1>Метод del_manager</h1>
<p>Данный метод осуществляет удаление всех менеджеров</p>
<p>Список параметров:</p>
<ul>
	<li>guid - ALL для удаления всех</li>
</ul>
<h2>Использование:</h2>
<p>Описание параметров:</p>
<table cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
<tr>
	<th>Параметр</th>
	<th>Описание</th>
</tr>
<tr>
	<td class="td"><strong>guid</strong></td>
	<td class="td">all для удаления всех менеджеров</td>
</tr>
</table>
<h2>Использование:</h2>
<p>Пример использование метода: <var><?php echo base_url().'api/'; ?></var><dfn>del_manager?guid=all</dfn></p>
</div>

<div style="margin: 40px">
<hr />
	Api v<?php echo $version; ?> системы <a href="http://profishop.us" target="_blank">Profishop</a>.
</div>
</body>
</html>