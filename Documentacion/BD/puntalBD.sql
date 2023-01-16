-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: database:3306
-- Tiempo de generación: 16-01-2023 a las 08:21:04
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `puntalBD`
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

--
-- Volcado de datos para la tabla `base`
--

INSERT INTO `base` (`idPlaza`, `fechaEntrada`, `fechaSalida`) VALUES
(1, '2023-01-11 07:36:47', '2023-01-11 07:36:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` tinyint NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `direccion` varchar(40) NOT NULL,
  `tipoDocumento` varchar(30) NOT NULL,
  `Observaciones` varchar(200) NOT NULL,
  `visto` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `apellidos`, `email`, `direccion`, `tipoDocumento`, `Observaciones`, `visto`) VALUES
(1, 'Luis', 'Corberán Izquierdo', 'luiscorberan@luis.com', 'Av/ Ausias March , 22', 'DNI', 'Es la primera inserción que hacemos. Es una prueba.', 0),
(3, 'Raúl', 'Carretero García', 'raulcarretero@raul.com', 'C/ Islas Canarias 5, 12', 'DNI', 'Hola me llamo raúl. Esto es una prueba.', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `embarcacion`
--

CREATE TABLE `embarcacion` (
  `id` tinyint NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `eslora` int NOT NULL,
  `manga` int NOT NULL,
  `calado` int NOT NULL,
  `propulsion` varchar(30) NOT NULL,
  `id_cliente` tinyint NOT NULL,
  `id_plaza` tinyint NOT NULL,
  `visto` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `embarcacion`
--

INSERT INTO `embarcacion` (`id`, `nombre`, `eslora`, `manga`, `calado`, `propulsion`, `id_cliente`, `id_plaza`, `visto`) VALUES
(1, 'María la Portuguesa', 20, 8, 5, 'Vela / Motor', 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instalacion`
--

CREATE TABLE `instalacion` (
  `id` tinyint NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `nombrePuerto` varchar(20) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `visto` tinyint(1) NOT NULL,
  `fechaDisposicion` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `instalacion`
--

INSERT INTO `instalacion` (`id`, `codigo`, `nombrePuerto`, `descripcion`, `estado`, `visto`, `fechaDisposicion`) VALUES
(1, 'RB-01', 'Ribadeo', 'Puerto deportivo de Ribadeo.', 'Bueno', 0, '2023-01-11 07:47:44'),
(2, 'RB-02', 'Ribeira', 'Puerto de Ribeira.', 'Bueno', 0, '2023-01-11 08:09:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instalacionesUsuarios`
--

CREATE TABLE `instalacionesUsuarios` (
  `id` tinyint NOT NULL,
  `idInstalacion` tinyint NOT NULL,
  `idUsuario` tinyint NOT NULL
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
  `idUsuarioOrigen` tinyint NOT NULL,
  `idUsuarioDestino` tinyint NOT NULL
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

--
-- Volcado de datos para la tabla `muelle`
--

INSERT INTO `muelle` (`id`, `idInstalacion`, `visto`) VALUES
(1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plaza`
--

CREATE TABLE `plaza` (
  `id` tinyint NOT NULL,
  `disponible` tinyint(1) NOT NULL,
  `visto` tinyint(1) NOT NULL,
  `puertoOrigen` varchar(20) NOT NULL,
  `puertoDestino` varchar(20) NOT NULL,
  `año` year NOT NULL,
  `idMuelle` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `plaza`
--

INSERT INTO `plaza` (`id`, `disponible`, `visto`, `puertoOrigen`, `puertoDestino`, `año`, `idMuelle`) VALUES
(1, 1, 0, '1', '2', 2023, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefono`
--

CREATE TABLE `telefono` (
  `numero` int NOT NULL,
  `idCliente` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `telefono`
--

INSERT INTO `telefono` (`numero`, `idCliente`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transito`
--

CREATE TABLE `transito` (
  `idPlaza` tinyint NOT NULL,
  `fechaEntrada` timestamp NOT NULL,
  `fechaSalida` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `transito`
--

INSERT INTO `transito` (`idPlaza`, `fechaEntrada`, `fechaSalida`) VALUES
(1, '2023-01-11 08:10:30', '2023-01-11 08:10:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tripulante`
--

CREATE TABLE `tripulante` (
  `id` tinyint NOT NULL,
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
  `id_embarcacion` tinyint NOT NULL,
  `visto` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tripulante`
--

INSERT INTO `tripulante` (`id`, `nombre`, `apellidos`, `nacionalidad`, `fechaNacimiento`, `lugarNacimiento`, `paisNacimiento`, `tipoDocumento`, `fechaExpedicionDocumento`, `fechaCaducidadDocumento`, `id_plaza`, `id_embarcacion`, `visto`) VALUES
(1, 'Juan', 'García García', 'española', '2023-01-11', 'Valencia', 'España', 'DNI', '2023-01-11', '2023-01-12', 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` tinyint NOT NULL,
  `nombreUsuario` varchar(20) NOT NULL,
  `contraseña` varchar(20) NOT NULL,
  `nombreCompleto` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `habilitado` tinyint(1) NOT NULL,
  `perfil` varchar(20) NOT NULL,
  `idioma` varchar(15) NOT NULL,
  `visto` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombreUsuario`, `contraseña`, `nombreCompleto`, `email`, `habilitado`, `perfil`, `idioma`, `visto`) VALUES
(2, 'LUISyALF', 'luisluis', 'Luis Corberán Izquierdo', 'luis@luis.com', 1, 'GuardaMuelles', 'Español', 0),
(3, 'RAUWCarretero', 'raulraul', 'Raúl Carretero García', 'raul@raul.com', 1, 'GuardaMuelles', 'Español', 0),
(4, 'JuanGuarnizo', 'juanjuan', 'Juan Saéz Guarnizo', 'juan@juan.com', 1, 'Administrativo', 'Inglés', 0);

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
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `embarcacion`
--
ALTER TABLE `embarcacion`
  ADD PRIMARY KEY (`id`),
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `R5` (`id_embarcacion`),
  ADD KEY `R6` (`id_plaza`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `base`
--
ALTER TABLE `base`
  MODIFY `idPlaza` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `embarcacion`
--
ALTER TABLE `embarcacion`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `instalacion`
--
ALTER TABLE `instalacion`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT de la tabla `telefono`
--
ALTER TABLE `telefono`
  MODIFY `numero` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `transito`
--
ALTER TABLE `transito`
  MODIFY `idPlaza` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tripulante`
--
ALTER TABLE `tripulante`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  ADD CONSTRAINT `R7` FOREIGN KEY (`id_plaza`) REFERENCES `plaza` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `R8` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `instalacionesUsuarios`
--
ALTER TABLE `instalacionesUsuarios`
  ADD CONSTRAINT `RelacionInstalacion` FOREIGN KEY (`idInstalacion`) REFERENCES `instalacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `RelacionUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `R1` FOREIGN KEY (`idUsuarioDestino`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `R2` FOREIGN KEY (`idUsuarioOrigen`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muelle`
--
ALTER TABLE `muelle`
  ADD CONSTRAINT `R3` FOREIGN KEY (`idInstalacion`) REFERENCES `instalacion` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `plaza`
--
ALTER TABLE `plaza`
  ADD CONSTRAINT `R4` FOREIGN KEY (`idMuelle`) REFERENCES `muelle` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD CONSTRAINT `R9` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `transito`
--
ALTER TABLE `transito`
  ADD CONSTRAINT `R10` FOREIGN KEY (`idPlaza`) REFERENCES `plaza` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tripulante`
--
ALTER TABLE `tripulante`
  ADD CONSTRAINT `R5` FOREIGN KEY (`id_embarcacion`) REFERENCES `embarcacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `R6` FOREIGN KEY (`id_plaza`) REFERENCES `plaza` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
