-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost:3306
-- Время создания: Дек 16 2015 г., 10:17
-- Версия сервера: 5.1.73
-- Версия PHP: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `profishop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cathegory`
--

CREATE TABLE `cathegory` (
  `id` int(12) NOT NULL,
  `name` varchar(100) NOT NULL,
  `parent` varchar(36) NOT NULL,
  `guid` char(36) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `characters`
--

CREATE TABLE `characters` (
  `property_guid` varchar(36) NOT NULL DEFAULT '',
  `guid` varchar(36) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `characters_properties`
--

CREATE TABLE `characters_properties` (
  `name` varchar(99) DEFAULT NULL,
  `guid` varchar(36) NOT NULL,
  `guid_char_type` varchar(36) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `characters_type`
--

CREATE TABLE `characters_type` (
  `guid` varchar(36) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `company`
--

CREATE TABLE `company` (
  `name` varchar(150) NOT NULL,
  `address` varchar(180) NOT NULL,
  `director` varchar(200) NOT NULL,
  `inn` varchar(12) NOT NULL,
  `kpp` varchar(9) NOT NULL,
  `guid` varchar(36) NOT NULL,
  `rasch_schet` varchar(20) NOT NULL,
  `bank_name` varchar(99) NOT NULL,
  `bik` varchar(9) NOT NULL,
  `korr_schet` varchar(20) NOT NULL,
  `contact_email` varchar(30) NOT NULL,
  `site` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `slogan` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `currency`
--

CREATE TABLE `currency` (
  `name` varchar(10) DEFAULT NULL,
  `rate` double(10,4) DEFAULT NULL,
  `guid` char(36) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `version` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `user_guid` varchar(36) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `price_rur` double(50,5) DEFAULT NULL,
  `status_opt` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Поле предназчено для настройки видимости',
  `guid` char(36) NOT NULL,
  `comment` varchar(300) DEFAULT NULL,
  `onsite` int(1) DEFAULT NULL,
  `manager_guid` varchar(36) DEFAULT NULL,
  `moysklad` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_products`
--

CREATE TABLE `order_products` (
  `id` int(10) NOT NULL,
  `user_guid` varchar(36) DEFAULT NULL,
  `product_guid` varchar(36) DEFAULT NULL,
  `order_id` int(10) DEFAULT NULL,
  `price_rur` double(50,5) DEFAULT NULL,
  `number` int(10) DEFAULT NULL,
  `char_guid` varchar(36) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `prices`
--

CREATE TABLE `prices` (
  `guid` varchar(36) NOT NULL,
  `currency_guid` varchar(36) NOT NULL,
  `price` decimal(50,5) NOT NULL DEFAULT '0.00000',
  `product_guid` varchar(36) NOT NULL,
  `type_guid` varchar(36) NOT NULL,
  `char_guid` varchar(36) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `articule` varchar(25) DEFAULT NULL,
  `category` varchar(36) DEFAULT NULL,
  `guid` varchar(36) NOT NULL,
  `status` int(11) NOT NULL,
  `unit` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_images`
--

CREATE TABLE `product_images` (
  `id` int(15) NOT NULL,
  `guid` varchar(36) NOT NULL,
  `product_guid` varchar(36) NOT NULL,
  `path` text,
  `name` varchar(70) DEFAULT NULL,
  `poryadok` int(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `remains`
--

CREATE TABLE `remains` (
  `id` int(21) NOT NULL,
  `remain` int(210) NOT NULL,
  `product_guid` varchar(36) NOT NULL,
  `char_guid` varchar(36) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `remain_graph`
--

CREATE TABLE `remain_graph` (
  `id` int(11) NOT NULL,
  `number` int(10) NOT NULL,
  `min` int(210) NOT NULL,
  `max` int(210) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `session_id` varchar(40) NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) NOT NULL,
  `user_data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(210) NOT NULL,
  `siteoption` varchar(1000) NOT NULL,
  `description` varchar(120) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `type_of_prices`
--

CREATE TABLE `type_of_prices` (
  `guid` varchar(36) NOT NULL,
  `name` varchar(50) NOT NULL,
  `currency_guid` varchar(36) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `ulogin` varchar(100) NOT NULL,
  `upassword` varchar(50) NOT NULL,
  `guid` char(36) NOT NULL,
  `type_guid` varchar(36) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `ur_address` varchar(999) DEFAULT NULL,
  `fact_address` varchar(999) DEFAULT NULL,
  `inn` varchar(12) DEFAULT NULL,
  `kpp` varchar(9) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `korr_schet` varchar(20) DEFAULT NULL,
  `bank_name` varchar(99) DEFAULT NULL,
  `bik` varchar(9) DEFAULT NULL,
  `rasch_schet` varchar(20) DEFAULT NULL,
  `contact_email` varchar(55) DEFAULT NULL,
  `site` varchar(90) DEFAULT NULL,
  `fulle_name` varchar(200) DEFAULT NULL,
  `manager` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_manager`
--

CREATE TABLE `user_manager` (
  `id` int(11) NOT NULL,
  `user_guid` varchar(36) NOT NULL,
  `manager_guid` varchar(36) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cathegory`
--
ALTER TABLE `cathegory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guid` (`guid`);

--
-- Индексы таблицы `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`guid`,`property_guid`);

--
-- Индексы таблицы `characters_properties`
--
ALTER TABLE `characters_properties`
  ADD PRIMARY KEY (`guid`,`guid_char_type`);

--
-- Индексы таблицы `characters_type`
--
ALTER TABLE `characters_type`
  ADD PRIMARY KEY (`guid`);

--
-- Индексы таблицы `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`guid`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`product_guid`,`type_guid`,`char_guid`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guid` (`guid`);

--
-- Индексы таблицы `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guid` (`guid`);

--
-- Индексы таблицы `remains`
--
ALTER TABLE `remains`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Index 2` (`product_guid`,`char_guid`);

--
-- Индексы таблицы `remain_graph`
--
ALTER TABLE `remain_graph`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `type_of_prices`
--
ALTER TABLE `type_of_prices`
  ADD PRIMARY KEY (`guid`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`guid`),
  ADD UNIQUE KEY `guid` (`guid`),
  ADD UNIQUE KEY `ulogin` (`ulogin`);

--
-- Индексы таблицы `user_manager`
--
ALTER TABLE `user_manager`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cathegory`
--
ALTER TABLE `cathegory`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1636;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=564;
--
-- AUTO_INCREMENT для таблицы `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1229;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6942;
--
-- AUTO_INCREMENT для таблицы `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;
--
-- AUTO_INCREMENT для таблицы `remains`
--
ALTER TABLE `remains`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51716;
--
-- AUTO_INCREMENT для таблицы `remain_graph`
--
ALTER TABLE `remain_graph`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(210) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `user_manager`
--
ALTER TABLE `user_manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31815;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
