-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-08-2017 a las 00:36:54
-- Versión del servidor: 5.7.19-0ubuntu0.16.04.1
-- Versión de PHP: 5.6.30-11+deb.sury.org~xenial+3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `coders`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `idusuario` int(11) NOT NULL,
  `idcontacto` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`idusuario`, `idcontacto`, `fecha`) VALUES
(4, 1, '2017-07-23'),
(5, 1, '2017-07-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `idnotificacion` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL COMMENT 'Quien envia la notificacion',
  `idcontacto` int(11) NOT NULL COMMENT 'A quien se le envia la notificacion',
  `mensaje` text NOT NULL,
  `fecha` date NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`idnotificacion`, `idusuario`, `idcontacto`, `mensaje`, `fecha`, `estatus`) VALUES
(1, 1, 4, 'HOLA', '2017-07-30', 1),
(2, 1, 4, 'ADIOS', '2017-07-30', 1),
(3, 1, 4, 'Hi', '2017-07-30', 1),
(4, 1, 4, 'HI', '2017-07-30', 1),
(5, 1, 5, 'PRUEBA', '2017-07-30', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

CREATE TABLE `publicacion` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `contenido` text NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `imagen` char(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`id`, `usuario`, `fecha`, `contenido`, `likes`, `imagen`) VALUES
(28, 1, '2017-07-02', 'xfgfdfdgdfffff', 1, '28.jpg'),
(29, 1, '2017-07-02', 'dkhfbdskfhskljdflds', 0, '29.jpg'),
(30, 1, '2017-07-02', 'eiorwuiwyriwour', 0, '30.jpg'),
(31, 1, '2017-07-02', 'nueva', 1, '31.jpg'),
(32, 1, '2017-07-02', 'nueva2', 0, '32.jpg'),
(33, 1, '2017-07-02', 'dhbvsadkfsdhs.s.', 0, '33.jpg'),
(34, 1, '2017-07-16', 'LOL', 0, '34.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `idsolicitud` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `idusuario` int(11) NOT NULL,
  `idcontacto` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '0' COMMENT '0=pendiente, 1=aceptado, 2 =rechazado'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`idsolicitud`, `fecha`, `idusuario`, `idcontacto`, `estatus`) VALUES
(5, '2017-07-23', 4, 1, 1),
(6, '2017-07-23', 5, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` char(50) NOT NULL,
  `password` char(50) NOT NULL,
  `fecha` date NOT NULL,
  `nombre` char(100) NOT NULL,
  `apellido` char(100) NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `fecha`, `nombre`, `apellido`, `imagen`) VALUES
(1, 'mcgalv@gmail.com', '123456', '2017-06-18', 'Gerardo', 'Lopez', '1.jpg'),
(4, 'morgan@gmail.com', '123456', '2017-07-16', 'Morgan', 'Viñal', ''),
(5, 'michael@gmail.com', '123456', '2017-07-23', 'Michael', 'Villanueva', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_likes`
--

CREATE TABLE `usuario_likes` (
  `idusuario` int(11) NOT NULL,
  `idpublicacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_likes`
--

INSERT INTO `usuario_likes` (`idusuario`, `idpublicacion`) VALUES
(1, 28),
(1, 31);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`idnotificacion`);

--
-- Indices de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`idsolicitud`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `idnotificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `idsolicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
