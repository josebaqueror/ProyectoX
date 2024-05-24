-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-05-2024 a las 19:09:37
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectox`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `usuario_id`, `fecha`, `total`) VALUES
(1, 1, '2024-04-30 04:40:25', 10062640.00),
(2, 1, '2024-05-04 19:51:16', 451010.00),
(3, 1, '2024-05-04 21:25:43', 2735810.00),
(4, 1, '2024-05-04 21:49:45', 2687020.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_compras`
--

CREATE TABLE `detalles_compras` (
  `id` int(11) NOT NULL,
  `compra_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles_compras`
--

INSERT INTO `detalles_compras` (`id`, `compra_id`, `producto_id`, `cantidad`, `precio`) VALUES
(1, 1, 5024, 1, 1129000.00),
(2, 1, 5024, 1, 1129000.00),
(3, 1, 5020, 1, 3099000.00),
(4, 1, 5020, 1, 3099000.00),
(5, 2, 5022, 1, 379000.00),
(6, 3, 5023, 1, 2299000.00),
(7, 4, 5024, 1, 1129000.00),
(8, 4, 5024, 1, 1129000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_usuario`
--

CREATE TABLE `perfil_usuario` (
  `id_usuario` int(5) NOT NULL,
  `perfil_usuario` int(1) NOT NULL,
  `nombre_perfil` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(5) NOT NULL,
  `nombre_producto` varchar(40) NOT NULL,
  `precio` varchar(9) NOT NULL,
  `referencia` varchar(10) NOT NULL,
  `cantidad_producto` int(3) NOT NULL,
  `imagen` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre_producto`, `precio`, `referencia`, `cantidad_producto`, `imagen`) VALUES
(1, 'All In One Lenovo Neo 30a\r\n', '3099000', '5020', 18, 'images/producto1.webp'),
(2, 'Antena Wi-fi Doble Banda Usb', '203000', '5021', 30, 'images/producto4.webp'),
(3, 'Monitor gamer LG 22', '379000', '5022', 50, 'images/producto2.webp'),
(4, 'Portatil Lenovo 15alc7 Ryzen 5', '2299000', '5023', 50, 'images/producto5.webp'),
(6, 'Monitor 29\'\' 21:9 Ultrawide Full Hd', '1129000', '5024', 50, 'images/producto3.webp'),
(7, 'Hp All In One 22', '1749000', '5025', 50, 'images/producto6.webp'),
(8, 'Portatil Lenovo Ryzen 5 5600h', '2800000', '5026', 50, 'images/producto7.webp'),
(9, 'Monitor Samsung 32 Curvo', '919000', '5027', 50, 'images/producto8.webp'),
(10, 'Monitor Gaming LG 27', '1300000', '5028', 50, 'images/producto9.webp'),
(11, 'Monitor Samsung 32 Ls', '830000', '5029', 50, 'images/producto10.webp'),
(12, 'Camara Web Full Hd Logitech C922', '289000', '5030', 30, 'images/producto11.webp'),
(13, 'Logitech Streamcam Plus Camara Web', '495000', '5031', 50, 'images/producto12.webp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(5) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `contrasena` varchar(12) NOT NULL,
  `perfil` int(1) NOT NULL,
  `role` enum('cliente','administrador') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `usuario`, `contrasena`, `perfil`, `role`) VALUES
(1, 'jose leonardo', 'josebaquero', 'Jose2024', 0, 'cliente'),
(6, '$nombre', '$usuario', '$contraseña', 0, 'cliente'),
(7, 'prueba', 'prueba1', '123456', 0, 'cliente'),
(9, '', '', '', 0, 'cliente'),
(10, 'angie ', 'prueba2', '123456789', 0, 'cliente'),
(11, 'prueba dsd', 'prueba5', '123456789', 0, 'cliente'),
(12, 'prueba dsdsd', 'prueba8', '123456789', 0, 'cliente'),
(14, 'prueba dsdss', 'prueba10', '123456789', 0, 'cliente'),
(15, 'nico', 'nicoc', '123456789', 0, 'cliente'),
(16, 'angie s', 'usuario', '12345', 0, 'cliente'),
(19, 'nicolas ', 'nicoc2', '123456', 0, 'cliente'),
(21, 'jose leond', 'admin5', '123456', 0, 'cliente'),
(22, 'kolok', 'adm12', '123456789', 0, 'cliente'),
(24, 'max', 'adm25', '12345', 0, 'cliente'),
(25, 'jesus', 'adm123', '12365', 0, 'cliente'),
(26, 'assaa', 'prueba236', '123456789', 0, 'cliente'),
(27, 'ssssssaa', 'prueba2s', '123456789', 0, 'cliente'),
(30, 'Ivan Ramirez', 'root', '123456', 0, 'administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_producto` int(5) NOT NULL,
  `nombre_producto` varchar(40) NOT NULL,
  `precio` varchar(9) NOT NULL,
  `cantidad_producto` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_producto`, `nombre_producto`, `precio`, `cantidad_producto`) VALUES
(1, 'Monitor gamer LG 22', '379000', 2),
(2, 'All In One Lenovo Neo 30a', '3099000', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalles_compras`
--
ALTER TABLE `detalles_compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compra_id` (`compra_id`);

--
-- Indices de la tabla `perfil_usuario`
--
ALTER TABLE `perfil_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detalles_compras`
--
ALTER TABLE `detalles_compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `perfil_usuario`
--
ALTER TABLE `perfil_usuario`
  MODIFY `id_usuario` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_producto` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_compras`
--
ALTER TABLE `detalles_compras`
  ADD CONSTRAINT `detalles_compras_ibfk_1` FOREIGN KEY (`compra_id`) REFERENCES `compras` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
