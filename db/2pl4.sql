-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-06-2018 a las 02:55:01
-- Versión del servidor: 10.1.24-MariaDB
-- Versión de PHP: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `2pl4`
--
CREATE DATABASE IF NOT EXISTS `2pl4` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `2pl4`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

CREATE TABLE `mascotas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `raza` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `edad` int(11) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mascotas`
--

INSERT INTO `mascotas` (`id`, `id_usuario`, `raza`, `color`, `edad`, `tipo`) VALUES
(1, 2, 'Caniche', 'Negro', 5, 1000),
(2, 2, 'Siames', 'Gris', 3, 2000),
(3, 3, 'Ovejero Aleman', 'Marron', 8, 1000),
(4, 4, 'Bengala', 'Atigrado', 6, 2000),
(5, 3, 'Balines', 'Blanco', 1, 2000),
(6, 2, 'Boxer', 'Blanco', 7, 1000),
(7, 2, 'Caniche Toy', 'Blanco', 3, 1000),
(8, 6, 'Siames', 'Blanco', 2, 2000),
(9, 6, 'Labrador', 'Marron', 5, 1000),
(10, 7, 'Boxer', 'Negro', 2, 1000),
(11, 6, 'Caniche', 'Negro', 1, 1000),
(12, 6, 'Pug', 'Manchado', 2, 1000),
(13, 8, 'Boxer', 'Negro', 9, 1000),
(14, 8, 'Siames', 'Te con leche', 1, 2000),
(15, 9, 'Persa', 'Marron', 4, 2000),
(16, 9, 'Bobtail', 'Mestizo', 2, 2000),
(17, 9, 'Siberiano', 'Gris', 5, 2000),
(18, 9, 'Cornish Rex', 'Blanco', 1, 2000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id` int(11) NOT NULL,
  `id_mascota` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `id_mascota`, `fecha`, `estado`, `descripcion`) VALUES
(1, 9, '2018-06-29 03:41:48', 1, 'El perro tiene pulgas, muchas pulgas'),
(2, 8, '2018-06-30 00:30:47', 2, 'El gato tiene tos'),
(3, 8, '2018-07-05 20:31:03', 0, 'Lo atropello un auto'),
(4, 12, '2018-06-29 23:43:04', 1, 'Dificultad para caminar'),
(5, 11, '2018-07-03 17:46:11', 3, 'Caca liquida'),
(6, 14, '2018-07-05 00:00:09', 1, 'Muy mal comportamiento'),
(7, 13, '2018-06-29 00:00:35', 1, 'Problema en una pata'),
(8, 5, '2018-07-06 00:02:01', 1, 'No quiere comer'),
(9, 3, '2018-07-10 00:02:18', 1, 'Problema de cadera'),
(10, 1, '2018-07-20 00:03:10', 1, 'Dificultad para caminar'),
(11, 2, '2018-08-15 00:03:28', 1, 'Operacion de cadera'),
(12, 6, '2018-07-03 00:03:42', 1, 'Babea mucho'),
(13, 7, '2018-06-29 00:03:56', 1, 'Problemas de vista'),
(14, 15, '2018-06-28 18:07:02', 1, 'No quiere comer'),
(15, 16, '2018-06-28 19:07:19', 1, 'Problemas de movilidad'),
(16, 17, '2018-06-29 20:07:39', 1, ' '),
(17, 18, '2018-06-28 20:07:49', 3, 'Es muy feo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `mail`, `password`, `tipo`) VALUES
(1, 'Juan', 'Perez', 'juan@hotmail.com', '123', 10),
(2, 'Pedro', 'Gonzalez', 'pedro@hotmail.com', '123', 20),
(3, 'Alejandro', 'Martinez', 'amartinez@hotmail.com', '123', 20),
(4, 'Andate', 'Sampaoli', 'andate@hotmail.com', '123', 20),
(5, 'admin', 'admin', '2', '2', 10),
(6, 'Guillermo', 'Fink', '1', '1', 20),
(7, 'Lorenzo', 'Lamas', 'renegado@hotmail.com', '123', 20),
(8, 'test', 'test', 'test', '1', 20),
(9, 'Ricardo', 'Ruben', 'Rr@hotmail.com', '123', 20);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
