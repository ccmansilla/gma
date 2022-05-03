-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-05-2022 a las 13:44:37
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gma`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `type` enum('od','og','or') NOT NULL,
  `number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `date` date NOT NULL,
  `about` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `attached` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `type`, `number`, `year`, `date`, `about`, `file`, `attached`) VALUES
(21, 'od', 1, 22, '2022-04-29', 'prueba', 'od_22_1.pdf', 'adj_od_22_1.pdf'),
(29, 'od', 22, 22, '2022-05-03', '11', 'od_22_22.pdf', 'adj_od_22_22.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` enum('admin','jefatura','dependencia') NOT NULL,
  `name` varchar(60) NOT NULL,
  `nick` varchar(60) NOT NULL,
  `pass` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `nick`, `pass`) VALUES
(1, 'admin', 'Administrador', 'admin', '202cb962ac59075b964b07152d234b70'),
(2, 'dependencia', 'Departamento Ingenieria', 'deping', '202cb962ac59075b964b07152d234b70'),
(3, 'jefatura', 'Jefatura Grupo Mantenimiento', 'jefatura', '202cb962ac59075b964b07152d234b70'),
(5, 'dependencia', 'Electronica', 'electronica', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `views`
--

CREATE TABLE `views` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `views`
--

INSERT INTO `views` (`id_order`, `id_user`) VALUES
(29, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `volantes`
--

CREATE TABLE `volantes` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `numero` int(11) NOT NULL,
  `year` int(4) NOT NULL,
  `asunto` text DEFAULT NULL,
  `enlace_archivo` varchar(255) DEFAULT NULL,
  `enlace_adjunto` varchar(255) DEFAULT NULL,
  `id_user_origen` int(11) NOT NULL,
  `id_user_destino` int(11) NOT NULL,
  `visto` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `volantes`
--

INSERT INTO `volantes` (`id`, `fecha`, `numero`, `year`, `asunto`, `enlace_archivo`, `enlace_adjunto`, `id_user_origen`, `id_user_destino`, `visto`) VALUES
(4, '2022-04-25', 2, 22, '				prueba de volantes 		', 'vol_2_22_2.pdf', NULL, 2, 3, 0),
(7, '2022-04-20', 6, 22, '					6', 'vol_5_22_6.pdf', NULL, 5, 2, 0),
(8, '2022-04-27', 1, 22, '					sss', 'vol_3_22_1.pdf', NULL, 3, 2, 0),
(10, '2022-05-02', 22, 22, '	22	', '', 'adj_vol_3_22_22.pdf', 3, 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nick` (`nick`);

--
-- Indices de la tabla `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id_order`,`id_user`);

--
-- Indices de la tabla `volantes`
--
ALTER TABLE `volantes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `volantes`
--
ALTER TABLE `volantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `views`
--
ALTER TABLE `views`
  ADD CONSTRAINT `views_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
