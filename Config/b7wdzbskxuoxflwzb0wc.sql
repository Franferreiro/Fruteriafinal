-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: b7wdzbskxuoxflwzb0wc-mysql.services.clever-cloud.com:3306
-- Generation Time: Jun 16, 2022 at 03:21 AM
-- Server version: 8.0.22-13
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `b7wdzbskxuoxflwzb0wc`
--

-- --------------------------------------------------------

--
-- Table structure for table `historico`
--

CREATE TABLE `historico` (
  `Id` int NOT NULL,
  `Id_usuario` int(5) UNSIGNED ZEROFILL NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo_operacion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `historico`
--

INSERT INTO `historico` (`Id`, `Id_usuario`, `tipo_operacion`) VALUES
(1, 00011, 'Login'),
(2, 00011, 'Modificación'),
(3, 00011, 'Login'),
(4, 00011, 'Modificación'),
(5, 00011, 'Modificación'),
(6, 00011, 'Modificación'),
(7, 00011, 'Modificación'),
(8, 00011, 'Modificación'),
(9, 00011, 'Modificación'),
(10, 00011, 'Modificación'),
(11, 00011, 'Modificación'),
(12, 00011, 'Modificación'),
(13, 00011, 'Modificación'),
(14, 00011, 'Modificación'),
(15, 00011, 'Modificación'),
(16, 00011, 'Modificación'),
(17, 00012, 'Login'),
(18, 00012, 'Modificación'),
(19, 00011, 'Login'),
(20, 00011, 'Login'),
(21, 00011, 'Modificación'),
(22, 00011, 'Modificación'),
(23, 00011, 'Modificación'),
(24, 00011, 'Modificación'),
(25, 00011, 'Login'),
(26, 00011, 'Login'),
(27, 00011, 'Login'),
(28, 00011, 'Login'),
(29, 00011, 'Modificación'),
(30, 00011, 'Login'),
(31, 00011, 'Modificación'),
(32, 00011, 'Modificación'),
(33, 00013, 'Login'),
(34, 00013, 'Modificación'),
(35, 00013, 'Modificación'),
(36, 00013, 'Modificación'),
(37, 00014, 'Registro'),
(38, 00014, 'Login'),
(39, 00014, 'Modificación'),
(40, 00014, 'Modificación'),
(41, 00014, 'Login'),
(42, 00014, 'Modificación'),
(43, 00014, 'Logout'),
(44, 00014, 'Login'),
(45, 00015, 'Registro'),
(46, 00015, 'Login'),
(47, 00015, 'Logout'),
(48, 00014, 'Login'),
(49, 00014, 'Login'),
(50, 00014, 'Reserva'),
(51, 00014, 'Reserva'),
(52, 00014, 'Reserva'),
(53, 00014, 'Reserva'),
(54, 00014, 'Logout'),
(55, 00014, 'Login'),
(56, 00014, 'Logout'),
(57, 00014, 'Login'),
(58, 00014, 'Logout'),
(59, 00014, 'Login'),
(60, 00014, 'Reserva'),
(61, 00014, 'Logout'),
(62, 00014, 'Login'),
(63, 00014, 'Logout'),
(64, 00014, 'Login'),
(65, 00014, 'Logout'),
(66, 00014, 'Login');

-- --------------------------------------------------------

--
-- Table structure for table `parcelas`
--

CREATE TABLE `parcelas` (
  `Id` int NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `precio` int NOT NULL,
  `metros` int NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parcelas`
--

INSERT INTO `parcelas` (`Id`, `tipo`, `precio`, `metros`, `imagen`, `descripcion`) VALUES
(1, 'tomates', 4, 400, 'img/tomatoes-5356__340.jpg', 'Puede que sea su brillante color, su delicioso sabor o su sorprende versatilidad, pero lo cierto es que nuestros tomates son un alimento con mucho «sex appeal». Escoge una de nuestras variedades, la que más te guste. Nosotros te proporcionamos las herramientas y utensilios necesarios para la actividad.'),
(2, 'cebollas', 3, 350, 'img/onion-3540502__340.jpg', 'La cebolla es un producto básico de la cocina que no debería faltar en el huerto familiar. Es una hortaliza adaptable a diferentes climas y sustratos, fácil de producir. Escoge la que más te guste dentro de nuestras variedades. Nosotros te proporcionamos las herramientas y utensilios necesarios para la actividad.'),
(3, 'patatas', 3, 600, 'img/patatas.webp', 'Las mejores patatas libes de químicos y adictivos, sembradas lo más naturalmente posible para que tu mismo las lleves del huerto a la cocina. Escoge la que más te guste dentro de nuestras variedades. Nosotros te proporcionamos las herramientas y utensilios necesarios para la actividad.'),
(4, 'lechugas', 4, 400, 'img/green-salad-1533956__340.jpg', 'Lechuga verde y fresca, todo lo que necesitas para una buena ensalada, añádele algunos de nuestros tomates y nuestras cebollas y será perfecta. Escoge la que más te guste dentro de nuestras variedades. Nosotros te proporcionamos las herramientas y utensilios necesarios para la actividad.'),
(5, 'frutas', 5, 950, 'img/fruits-1114060__340.webp', 'Recoge las frutas que quieras; desde manzanas, limones, melocotones o lo que más te apetezca, escoge a tu gusto y cerciónate de primera mano que están maduras y jugosas. Escoge las que más te gusten dentro de nuestras variedades. Nosotros te proporcionamos las herramientas y utensilios necesarios para la actividad.');

-- --------------------------------------------------------

--
-- Table structure for table `reservas`
--

CREATE TABLE `reservas` (
  `Id` int NOT NULL,
  `Id_parcela` int NOT NULL,
  `fecha` timestamp NOT NULL,
  `hora` int NOT NULL,
  `Id_usuario` int(5) UNSIGNED ZEROFILL NOT NULL,
  `estado` varchar(255) NOT NULL DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservas`
--

INSERT INTO `reservas` (`Id`, `Id_parcela`, `fecha`, `hora`, `Id_usuario`, `estado`) VALUES
(1, 1, '2022-06-16 00:00:00', 19, 00011, 'Pendiente'),
(2, 1, '2022-06-16 00:00:00', 20, 00011, 'Pendiente'),
(3, 1, '2022-06-16 00:00:00', 18, 00011, 'Pendiente'),
(4, 5, '2022-06-25 00:00:00', 19, 00014, 'Pendiente'),
(5, 4, '2022-06-30 00:00:00', 20, 00014, 'Pendiente'),
(6, 3, '2022-06-27 00:00:00', 20, 00014, 'Pendiente'),
(7, 3, '2022-06-27 00:00:00', 19, 00014, 'Pendiente'),
(8, 4, '2022-06-28 00:00:00', 20, 00014, 'Pendiente'),
(9, 2, '2022-06-27 00:00:00', 19, 00014, 'Pendiente');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `Id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Apellido` varchar(255) NOT NULL,
  `Correo` varchar(255) NOT NULL,
  `Telefono` int(9) UNSIGNED ZEROFILL NOT NULL,
  `Psw` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Rol` int NOT NULL,
  `Imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'img/anonimo.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`Id`, `Nombre`, `Apellido`, `Correo`, `Telefono`, `Psw`, `Rol`, `Imagen`) VALUES
(00009, 'fr', 'fr', 'fr@gmail.com', 123456789, '$2y$10$v/iaBoXg/aMdHfKo7Df9i.ZSgnLWJiZQvgRwknunLgay/dnFI3ziS', 2, 'img/anonimo.png'),
(00010, 'yy', 'yy', 'yy@gmail.com', 123456789, '$2y$10$kzps3pRiWDhcvyUiLpFXX.uAsyetWI63GDuqxvoHKWrWXX.8CdfGq', 2, 'img/anonimo.png'),
(00011, 'pablo', 'pablo', 'pabla@gmail.com', 650190811, '$2y$10$BtpdWBqbz.2s62lB26GA2OHYglxY5eo5jTQLHQA5cgXmrKq3PprtS', 2, 'img/imgperfil/e039a01443e2c676a806b679afb3bb23.png'),
(00012, 'ya', 'yoaa', 'yoaaa@gmail.com', 123654988, '$2y$10$DEomyrNCH2ZXefoLqrZSYeS2jVAF2PCHwmZKKD4CGen2EIbbhWbvq', 2, 'img/imgperfil/4079235a1073962fb997e61c19b15df7.jpg'),
(00013, 'yoyo', 'yoyoo', 'yoyo@gmail.com', 987654322, '$2y$10$Q87jaYCWaYloabjgbpKB.utsaKqLBZnstb1.So8Bnb32hozRQOnbe', 2, 'img/imgperfil/b083b6b757b2898434d36093d425824d.png'),
(00014, 'franiikk', 'ferreiroiikk', 'fra@gmail.com', 123456789, '$2y$10$SEs4oLNeViq9CIS8o0/YR..Q4dWK.zMtpsxJQbK9Pn88KpZhljDrK', 1, 'img/imgperfil/64e5621e87336222e57c440aacc6d4fc.jpg'),
(00015, 'gt', 'gt', 'frajj@gmail.com', 123456789, '$2y$10$rfnB1DJy4OUxBEvkeQ50V.fhjRm0qmYTl18OTiUCqUfEDjBBiGFba', 2, 'img/anonimo.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_usuario` (`Id_usuario`);

--
-- Indexes for table `parcelas`
--
ALTER TABLE `parcelas`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_reserva_usuario` (`Id_usuario`),
  ADD KEY `FK_reserva_parcela` (`Id_parcela`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Correounico` (`Correo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `historico`
--
ALTER TABLE `historico`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `parcelas`
--
ALTER TABLE `parcelas`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservas`
--
ALTER TABLE `reservas`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `historico`
--
ALTER TABLE `historico`
  ADD CONSTRAINT `FK_usuario_historico` FOREIGN KEY (`Id_usuario`) REFERENCES `usuarios` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `FK_reserva_parcela` FOREIGN KEY (`Id_parcela`) REFERENCES `parcelas` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reserva_usuario` FOREIGN KEY (`Id_usuario`) REFERENCES `usuarios` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
