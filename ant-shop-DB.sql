-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 01 2022 г., 03:44
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ant-shop-DB`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Category`
--

CREATE TABLE `Category` (
  `idCategory` int NOT NULL,
  `title` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Category`
--

INSERT INTO `Category` (`idCategory`, `title`) VALUES
(1, 'Сервиз'),
(2, 'Часы'),
(3, 'Лампы'),
(4, 'Шкатулки');

-- --------------------------------------------------------

--
-- Структура таблицы `Order`
--

CREATE TABLE `Order` (
  `idOrder` int NOT NULL,
  `user_id` int NOT NULL,
  `comment` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `product_order_id` int NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(25) NOT NULL,
  `address` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Order`
--

INSERT INTO `Order` (`idOrder`, `user_id`, `comment`, `date`, `product_order_id`, `username`, `email`, `address`) VALUES
(23, 5, '123124', '2022-11-29', 7, 'noname', 'bdg-75@mail.ru', 'Бурдейного 10'),
(24, 5, 'hi', '2022-11-29', 8, 'noname', 'bdg-75@mail.ru', 'Бурдейного 10'),
(25, 1, '', '2022-12-01', 3, 'Владимир', 'bdg-75@mail.ru', 'Бурдейного 10');

-- --------------------------------------------------------

--
-- Структура таблицы `Product`
--

CREATE TABLE `Product` (
  `idProduct` int NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` longtext NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `instock` tinyint NOT NULL,
  `category_id` int NOT NULL,
  `image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Product`
--

INSERT INTO `Product` (`idProduct`, `title`, `description`, `price`, `instock`, `category_id`, `image`) VALUES
(1, 'Лампа', 'Крутая антикварная лампа, хорошо светит, пользоваться можно', '670.00', 4, 1, 0x2e2e2f696d616765732f70726f647563745f312e6a7067),
(2, 'Парта', 'Антикварная парта, сидеть можно, места хватает', '400.00', 2, 1, 0x2e2e2f696d616765732f70726f647563745f322e6a7067),
(3, 'Часы', 'Какие-то маленькие часы, в рюкзак положить можно', '880.00', 2, 2, 0x2e2e2f696d616765732f70726f647563745f332e6a7067),
(4, 'Японская статуэтка', 'Древняя статуэтка, вместе с ней больше не будешь одинок', '310.00', 3, 2, 0x2e2e2f696d616765732f70726f647563745f342e6a7067),
(5, 'Кружка', 'Металлическая кружка, дырок нет - вода не капает', '500.00', 7, 3, 0x2e2e2f696d616765732f70726f647563745f352e6a7067),
(6, 'Вторая лампа', 'Другая лампа, но уже круче предыдущей', '310.00', 6, 3, 0x2e2e2f696d616765732f70726f647563745f362e6a7067),
(7, 'Ваза', 'Четкая ваза, как декор сойдет', '640.00', 5, 4, 0x2e2e2f696d616765732f70726f647563745f372e6a7067),
(8, 'Фруктовница', 'Фрукты положить можно', '220.00', 1, 4, 0x2e2e2f696d616765732f70726f647563745f382e6a7067);

-- --------------------------------------------------------

--
-- Структура таблицы `PurchaseProduct`
--

CREATE TABLE `PurchaseProduct` (
  `idPurchaseProduct` int NOT NULL,
  `product_id` int NOT NULL,
  `count` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `User`
--

CREATE TABLE `User` (
  `idUser` int NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(45) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `User`
--

INSERT INTO `User` (`idUser`, `username`, `email`, `password`, `phone`, `address`) VALUES
(1, 'Владимир', 'bdg-75@mail.ru', 'ec6a6536ca304edf844d1d248a4f08dc', '80293516134', '10 Burdeinogo str. apt.11'),
(2, 'Андрей', 'bdg-75@mail.ru', '1f32aa4c9a1d2ea010adcf2348166a04', '80293516134', '10 Burdeinogo str. apt.11'),
(3, 'Ростислав', 'bdg-75@mail.ru', 'c97cccbc3080944fc4b312467034fc84', '80293516134', '10 Burdeinogo str. apt.11'),
(4, 'test', 'bdg-75@mail.ru', 'fb469d7ef430b0baf0cab6c436e70375', '80293516134', '10 Burdeinogo str. apt.11'),
(5, 'noname', 'bdg-75@mail.ru', '4e3da2ae832730d1abbf10611df36ea6', '80293516134', '10 Burdeinogo str. apt.11'),
(8, 'qwerty', 'bdg-75@mail.ru', '9208a20086ebfef780143c1fa4262e79', '123142', '10 Burdeinogo str. apt.11'),
(9, 'okay', 'bdg-75@mail.ru', '2f7b52aacfbf6f44e13d27656ecb1f59', '80293516134', '10 Burdeinogo str. apt.11');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Индексы таблицы `Order`
--
ALTER TABLE `Order`
  ADD PRIMARY KEY (`idOrder`),
  ADD KEY `fk_Order_Product1_idx` (`product_order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`idProduct`),
  ADD KEY `category_id_idx` (`category_id`);

--
-- Индексы таблицы `PurchaseProduct`
--
ALTER TABLE `PurchaseProduct`
  ADD PRIMARY KEY (`idPurchaseProduct`),
  ADD KEY `product_id_idx` (`product_id`);

--
-- Индексы таблицы `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `password_UNIQUE` (`password`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Category`
--
ALTER TABLE `Category`
  MODIFY `idCategory` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Order`
--
ALTER TABLE `Order`
  MODIFY `idOrder` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `Product`
--
ALTER TABLE `Product`
  MODIFY `idProduct` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT для таблицы `PurchaseProduct`
--
ALTER TABLE `PurchaseProduct`
  MODIFY `idPurchaseProduct` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `User`
--
ALTER TABLE `User`
  MODIFY `idUser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Order`
--
ALTER TABLE `Order`
  ADD CONSTRAINT `product_order_id` FOREIGN KEY (`product_order_id`) REFERENCES `Product` (`idProduct`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `User` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Product`
--
ALTER TABLE `Product`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `Category` (`idCategory`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `PurchaseProduct`
--
ALTER TABLE `PurchaseProduct`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `Product` (`idProduct`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
