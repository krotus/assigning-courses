-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 20-04-2016 a las 19:06:14
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `assigning_courses`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `name` char(50) NOT NULL,
  `cost_hour` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `cost_hour`) VALUES
(1, 'Informàtic', '40.00'),
(2, 'Transportista', '20.00'),
(3, 'Administratiu', '25.00'),
(4, 'Comptable', '30.00'),
(5, 'Gerent', '60.00'),
(6, 'Altres', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL,
  `comment` char(125) NOT NULL,
  `id_user` int(11) NOT NULL,
  `published` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `comment`, `id_user`, `published`) VALUES
(1, 'comentari de prova', 1, '2016-04-19 12:40:50'),
(2, 'torna a ser una prova final?', 1, '2016-04-19 13:05:41'),
(3, 'torna a ser una prova final?', 1, '2016-04-19 13:06:07'),
(4, 'torna a ser una prova final?', 1, '2016-04-19 13:07:17'),
(5, 'torna a ser una prova final?', 1, '2016-04-19 13:07:56'),
(6, 'asdf', 1, '2016-04-19 13:12:47'),
(7, 'torna a ser una prova, possiblement la definitiva... (?)', 1, '2016-04-19 13:13:09'),
(8, '"<?= $user->getUsername() ?>"', 1, '2016-04-19 13:14:49'),
(9, 'wtf', 1, '2016-04-19 13:15:35'),
(10, 'wtf', 1, '2016-04-19 13:16:20'),
(11, 'wtf', 1, '2016-04-19 13:16:29'),
(12, 'wtf', 1, '2016-04-19 13:16:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL,
  `name` char(50) NOT NULL,
  `hours` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `id_theme` int(11) NOT NULL,
  `id_enterprise` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `courses`
--

INSERT INTO `courses` (`id`, `name`, `hours`, `start_date`, `id_theme`, `id_enterprise`) VALUES
(1, 'Programació JAVA', 11, '2016-03-30', 1, 1),
(2, 'Programació PHP', 90, '2016-03-02', 1, 1),
(3, 'Curs Ioga', 22, '2016-03-31', 8, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `course_employee`
--

CREATE TABLE IF NOT EXISTS `course_employee` (
  `id` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `id_employee` int(11) NOT NULL,
  `improvement` tinyint(1) NOT NULL,
  `join_date` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `course_employee`
--

INSERT INTO `course_employee` (`id`, `id_course`, `id_employee`, `improvement`, `join_date`) VALUES
(1, 1, 1, 1, '2016-03-31'),
(2, 2, 1, 1, '2016-03-31'),
(5, 1, 21, 0, '2016-04-03'),
(7, 2, 21, 0, '2016-04-03'),
(8, 3, 21, 0, '2016-04-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL,
  `name` char(50) NOT NULL,
  `surname` char(50) DEFAULT NULL,
  `id_category` int(11) NOT NULL,
  `dni` char(9) NOT NULL,
  `email` char(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`id`, `name`, `surname`, `id_category`, `dni`, `email`) VALUES
(1, 'Andreu', 'Sala Egea', 1, '79273943G', 'andreus.sala@gmail.com'),
(21, 'asdf', 'asdfasdf', 3, '53654338F', 'asdf@asdf.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enterprise`
--

CREATE TABLE IF NOT EXISTS `enterprise` (
  `id` int(11) NOT NULL,
  `name` char(50) NOT NULL,
  `region` char(50) NOT NULL,
  `city` char(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `enterprise`
--

INSERT INTO `enterprise` (`id`, `name`, `region`, `city`) VALUES
(1, 'Empresa S.L.', 'ES', 'Barcelona');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `themes`
--

CREATE TABLE IF NOT EXISTS `themes` (
  `id` int(11) NOT NULL,
  `name` char(50) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `themes`
--

INSERT INTO `themes` (`id`, `name`, `id_category`) VALUES
(1, 'Software', 1),
(2, 'Hardware', 1),
(3, 'Ofimàtica', 3),
(4, 'Seguretat Laboral', 2),
(5, 'Comptabilitat', 4),
(6, 'Relacions Públiques', 5),
(7, 'Macramé', 6),
(8, 'Ioga', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` char(50) NOT NULL,
  `password` char(40) NOT NULL,
  `id_enterprise` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `id_enterprise`) VALUES
(1, 'admin', 'a4cbb2f3933c5016da7e83fd135ab8a48b67bf61', 1),
(2, 'god', '3f86be8cbe1fa89a27d47b9254cd3317bcd8d4df', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_theme` (`id_theme`),
  ADD KEY `id_enterprise` (`id_enterprise`);

--
-- Indices de la tabla `course_employee`
--
ALTER TABLE `course_employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_course` (`id_course`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_category_2` (`id_category`),
  ADD KEY `id_category_3` (`id_category`);

--
-- Indices de la tabla `enterprise`
--
ALTER TABLE `enterprise`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_enterprise` (`id_enterprise`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `course_employee`
--
ALTER TABLE `course_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `enterprise`
--
ALTER TABLE `enterprise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`id_theme`) REFERENCES `themes` (`id`),
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`id_enterprise`) REFERENCES `enterprise` (`id`);

--
-- Filtros para la tabla `course_employee`
--
ALTER TABLE `course_employee`
  ADD CONSTRAINT `course_employee_ibfk_2` FOREIGN KEY (`id_employee`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_employee_ibfk_3` FOREIGN KEY (`id_course`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_enterprise`) REFERENCES `enterprise` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
