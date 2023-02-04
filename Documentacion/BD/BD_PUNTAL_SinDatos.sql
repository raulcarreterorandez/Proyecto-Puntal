-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql
-- Tiempo de generación: 18-01-2023 a las 08:26:02
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pruebas_puntal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `base`
--

CREATE TABLE `base` (
  `idPlaza` tinyint NOT NULL,
  `fechaEntrada` timestamp NOT NULL,
  `fechaSalida` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `numDocumento` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `direccion` varchar(40) NOT NULL,
  `tipoDocumento` varchar(30) NOT NULL,
  `observaciones` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `visto` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `embarcacion`
--

CREATE TABLE `embarcacion` (
  `matricula` varchar(20) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `eslora` int NOT NULL,
  `manga` int NOT NULL,
  `calado` int NOT NULL,
  `propulsion` varchar(30) NOT NULL,
  `id_cliente` varchar(20) NOT NULL,
  `id_plaza` tinyint DEFAULT NULL,
  `visto` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instalacion`
--

CREATE TABLE `instalacion` (
  `id` tinyint NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `nombrePuerto` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `estado` varchar(30) NOT NULL,
  `visto` tinyint(1) NOT NULL,
  `fechaDisposicion` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instalacionesUsuarios`
--

CREATE TABLE `instalacionesUsuarios` (
  `id` tinyint NOT NULL,
  `idInstalacion` tinyint NOT NULL,
  `idUsuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` tinyint NOT NULL,
  `texto` varchar(200) NOT NULL,
  `fecha/hora` timestamp NOT NULL,
  `leido` tinyint(1) NOT NULL,
  `idUsuarioOrigen` varchar(50) NOT NULL,
  `idUsuarioDestino` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muelle`
--

CREATE TABLE `muelle` (
  `id` tinyint NOT NULL,
  `idInstalacion` tinyint NOT NULL,
  `visto` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plaza`
--

CREATE TABLE `plaza` (
  `id` tinyint NOT NULL,
  `disponible` tinyint(1) NOT NULL,
  `visto` tinyint(1) NOT NULL,
  `puertoOrigen` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `puertoDestino` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `año` year NOT NULL,
  `idMuelle` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefono`
--

CREATE TABLE `telefono` (
  `numero` int NOT NULL,
  `idCliente` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transito`
--

CREATE TABLE `transito` (
  `idPlaza` tinyint NOT NULL,
  `fechaEntrada` timestamp NOT NULL,
  `fechaSalida` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tripulante`
--

CREATE TABLE `tripulante` (
  `numDocumento` varchar(20) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `nacionalidad` varchar(30) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `lugarNacimiento` varchar(40) NOT NULL,
  `paisNacimiento` varchar(40) NOT NULL,
  `tipoDocumento` varchar(10) NOT NULL,
  `fechaExpedicionDocumento` date NOT NULL,
  `fechaCaducidadDocumento` date NOT NULL,
  `id_plaza` tinyint NOT NULL,
  `id_embarcacion` varchar(20) NOT NULL,
  `visto` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombreUsuario` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nombreCompleto` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `habilitado` tinyint(1) NOT NULL,
  `perfil` varchar(20) NOT NULL,
  `idioma` varchar(20) NOT NULL,
  `visto` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `base`
--
ALTER TABLE `base`
  ADD PRIMARY KEY (`idPlaza`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`numDocumento`);

--
-- Indices de la tabla `embarcacion`
--
ALTER TABLE `embarcacion`
  ADD PRIMARY KEY (`matricula`),
  ADD UNIQUE KEY `id_plaza` (`id_plaza`),
  ADD KEY `R7` (`id_plaza`),
  ADD KEY `R8` (`id_cliente`);

--
-- Indices de la tabla `instalacion`
--
ALTER TABLE `instalacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `instalacionesUsuarios`
--
ALTER TABLE `instalacionesUsuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `RelacionInstalacion` (`idInstalacion`),
  ADD KEY `RelacionUsuario` (`idUsuario`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `R1` (`idUsuarioDestino`),
  ADD KEY `R2` (`idUsuarioOrigen`);

--
-- Indices de la tabla `muelle`
--
ALTER TABLE `muelle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `R3` (`idInstalacion`);

--
-- Indices de la tabla `plaza`
--
ALTER TABLE `plaza`
  ADD PRIMARY KEY (`id`),
  ADD KEY `R4` (`idMuelle`);

--
-- Indices de la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD PRIMARY KEY (`numero`),
  ADD KEY `R9` (`idCliente`);

--
-- Indices de la tabla `transito`
--
ALTER TABLE `transito`
  ADD PRIMARY KEY (`idPlaza`);

--
-- Indices de la tabla `tripulante`
--
ALTER TABLE `tripulante`
  ADD PRIMARY KEY (`numDocumento`),
  ADD KEY `R5` (`id_embarcacion`),
  ADD KEY `R6` (`id_plaza`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `base`
--
ALTER TABLE `base`
  MODIFY `idPlaza` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `instalacion`
--
ALTER TABLE `instalacion`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT de la tabla `instalacionesUsuarios`
--
ALTER TABLE `instalacionesUsuarios`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `muelle`
--
ALTER TABLE `muelle`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `plaza`
--
ALTER TABLE `plaza`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `transito`
--
ALTER TABLE `transito`
  MODIFY `idPlaza` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `base`
--
ALTER TABLE `base`
  ADD CONSTRAINT `R11` FOREIGN KEY (`idPlaza`) REFERENCES `plaza` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `embarcacion`
--
ALTER TABLE `embarcacion`
  ADD CONSTRAINT `Embarcacion-Cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`numDocumento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Embarcacion-Plaza` FOREIGN KEY (`id_plaza`) REFERENCES `plaza` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `instalacionesUsuarios`
--
ALTER TABLE `instalacionesUsuarios`
  ADD CONSTRAINT `Relacion-Instalacion` FOREIGN KEY (`idInstalacion`) REFERENCES `instalacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Relacion-Usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `Usuario-Destino` FOREIGN KEY (`idUsuarioDestino`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Usuario-Origen` FOREIGN KEY (`idUsuarioOrigen`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muelle`
--
ALTER TABLE `muelle`
  ADD CONSTRAINT `R3` FOREIGN KEY (`idInstalacion`) REFERENCES `instalacion` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `plaza`
--
ALTER TABLE `plaza`
  ADD CONSTRAINT `Plaza-Muelle` FOREIGN KEY (`idMuelle`) REFERENCES `muelle` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD CONSTRAINT `Telefono-Cliente` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`numDocumento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `transito`
--
ALTER TABLE `transito`
  ADD CONSTRAINT `R10` FOREIGN KEY (`idPlaza`) REFERENCES `plaza` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tripulante`
--
ALTER TABLE `tripulante`
  ADD CONSTRAINT `Tripulante-Embarcacion` FOREIGN KEY (`id_embarcacion`) REFERENCES `embarcacion` (`matricula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Tripulante-PlazaTransito` FOREIGN KEY (`id_plaza`) REFERENCES `transito` (`idPlaza`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
