-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-08-2024 a las 08:05:02
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bienesraices_crud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE `propiedades` (
  `id` int(11) NOT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `descripcion` longtext DEFAULT NULL,
  `habitaciones` int(1) DEFAULT NULL,
  `WC` int(1) DEFAULT NULL,
  `estacionamiento` int(1) DEFAULT NULL,
  `creado` date DEFAULT NULL,
  `vendedorId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`id`, `titulo`, `precio`, `imagen`, `descripcion`, `habitaciones`, `WC`, `estacionamiento`, `creado`, `vendedorId`) VALUES
(1, 'Casa en la playa', 1200.00, '20f6d559de8fde66720ad8521e4bef7b.jpg', 'Casa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playa', 1, 2, 3, '2024-08-23', 1),
(2, 'Casa en la playa', 1200.00, 'ba4bf625994cbd105fd53860abd6813b.jpg', 'Casa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playa', 1, 2, 3, '2024-08-23', 1),
(3, 'Casa en la playa', 12200.00, 'b34a39fc5dc571b698d938758c91798d.jpg', 'Casa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playa', 1, 2, 3, '2024-08-23', 1),
(4, 'Casa en la playa', 120000.00, 'ea956ff71892b5eca9dc2c7e34f0e730', 'Casa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playa', 1, 2, 3, '2024-08-23', 1),
(5, 'Casa en la playa', 12000.00, 'bdc488be51bfe7f1a25b659ec6b88ed2', 'Casa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playa', 1, 2, 3, '2024-08-23', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedores`
--

CREATE TABLE `vendedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vendedores`
--

INSERT INTO `vendedores` (`id`, `nombre`, `apellido`, `telefono`) VALUES
(1, 'Miguel', 'Alcocer', '9992501358');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendedorId` (`vendedorId`);

--
-- Indices de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD CONSTRAINT `propiedades_ibfk_1` FOREIGN KEY (`vendedorId`) REFERENCES `vendedores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
