-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-07-2017 a las 09:18:28
-- Versión del servidor: 5.7.18-0ubuntu0.16.04.1
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
(28, 1, '2017-07-02', 'xfgfdfdgdfffff', 0, '28.jpg'),
(29, 1, '2017-07-02', 'dkhfbdskfhskljdflds', 0, '29.jpg'),
(30, 1, '2017-07-02', 'eiorwuiwyriwour', 0, '30.jpg'),
(31, 1, '2017-07-02', 'nueva', 0, '31.jpg'),
(32, 1, '2017-07-02', 'nueva2', 0, '32.jpg'),
(33, 1, '2017-07-02', 'dhbvsadkfsdhs.s.', 0, '33.jpg');

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
  `apellido` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `fecha`, `nombre`, `apellido`) VALUES
(1, 'mcgalv@gmail.com', '123456', '2017-06-18', 'Gerardo', 'Lopez'),
(2, 'glopzvega@gmail.com', '123456', '2017-06-18', 'Gerardo', 'Lopez'),
(3, 'gerardolopez@uhipocrates.edu.mx', '123456', '2017-06-18', 'Gerardo', 'Lopez');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `publicacion`
--
ALTER TABLE `publicacion`
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
-- AUTO_INCREMENT de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
