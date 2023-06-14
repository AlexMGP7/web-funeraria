-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-06-2023 a las 13:19:50
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `polizas_funerarias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cementerio`
--

CREATE TABLE `cementerio` (
  `Codigo` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Ubicacion` varchar(100) DEFAULT NULL,
  `Tipo` varchar(50) DEFAULT NULL,
  `EstadoCodigo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `Codigo` int(11) NOT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  `CodigoParroquia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `difunto`
--

CREATE TABLE `difunto` (
  `Codigo` int(11) NOT NULL,
  `Cedula` int(9) DEFAULT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `FechaDeceso` date DEFAULT NULL,
  `PartidaNacimiento` varchar(50) DEFAULT NULL,
  `CausaMuerte` varchar(100) DEFAULT NULL,
  `LugarDeceso` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `Codigo` int(11) NOT NULL,
  `Descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `Codigo` int(11) NOT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  `CodigoEstado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `Numero` int(11) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `NumeroPoliza` int(11) DEFAULT NULL,
  `Monto` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parroquias`
--

CREATE TABLE `parroquias` (
  `Codigo` int(11) NOT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  `CodigoMunicipio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `CedulaPersona` int(9) NOT NULL,
  `Tipo` enum('Natural','Juridica') NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Apellido` varchar(50) DEFAULT NULL,
  `Direccion` varchar(50) DEFAULT NULL,
  `Domicilio` varchar(50) DEFAULT NULL,
  `Telefono` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personajuridica`
--

CREATE TABLE `personajuridica` (
  `Rif` varchar(20) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `RazonSocial` varchar(100) DEFAULT NULL,
  `Direccion` varchar(50) DEFAULT NULL,
  `Telefono` varchar(50) DEFAULT NULL,
  `Correo` varchar(50) DEFAULT NULL,
  `CedulaRepresentante` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personanatural`
--

CREATE TABLE `personanatural` (
  `Cedula` int(9) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Apellido` varchar(50) DEFAULT NULL,
  `Direccion` varchar(50) DEFAULT NULL,
  `Telefono` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `polizasseguros`
--

CREATE TABLE `polizasseguros` (
  `Numero` int(11) NOT NULL,
  `FechaApertura` date DEFAULT NULL,
  `FechaCierre` date DEFAULT NULL,
  `CuotaAnual` decimal(10,2) DEFAULT NULL,
  `CuotaMensual` decimal(10,2) DEFAULT NULL,
  `Representante` varchar(100) DEFAULT NULL,
  `Cedula` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `serviciosfunerarios`
--

CREATE TABLE `serviciosfunerarios` (
  `Codigo` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Ubicacion` varchar(100) DEFAULT NULL,
  `Tipo` varchar(50) DEFAULT NULL,
  `CodigoPoliza` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `serviciosprestados`
--

CREATE TABLE `serviciosprestados` (
  `Codigo` int(11) NOT NULL,
  `CarroFunebre` decimal(10,2) DEFAULT NULL,
  `ServicioEnCasa` decimal(10,2) DEFAULT NULL,
  `Urna` decimal(10,2) DEFAULT NULL,
  `Capilla` decimal(10,2) DEFAULT NULL,
  `Cremacion` decimal(10,2) DEFAULT NULL,
  `OficioDeMisa` decimal(10,2) DEFAULT NULL,
  `TrasladoLocal` decimal(10,2) DEFAULT NULL,
  `TrasladoNacional` decimal(10,2) DEFAULT NULL,
  `TrasladoInternacional` decimal(10,2) DEFAULT NULL,
  `PreparacionDelDif` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `No_Identificacion` int(11) NOT NULL,
  `Login` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`No_Identificacion`, `Login`, `Password`) VALUES
(0, 'admin', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cementerio`
--
ALTER TABLE `cementerio`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `EstadoCodigo` (`EstadoCodigo`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `CodigoMunicipio` (`CodigoParroquia`);

--
-- Indices de la tabla `difunto`
--
ALTER TABLE `difunto`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `Cedula` (`Cedula`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `CodigoEstado` (`CodigoEstado`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`Numero`),
  ADD KEY `NumeroPoliza` (`NumeroPoliza`);

--
-- Indices de la tabla `parroquias`
--
ALTER TABLE `parroquias`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `CodigoMunicipio` (`CodigoMunicipio`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`CedulaPersona`);

--
-- Indices de la tabla `personajuridica`
--
ALTER TABLE `personajuridica`
  ADD PRIMARY KEY (`Rif`),
  ADD KEY `CedulaRepresentante` (`CedulaRepresentante`);

--
-- Indices de la tabla `personanatural`
--
ALTER TABLE `personanatural`
  ADD PRIMARY KEY (`Cedula`);

--
-- Indices de la tabla `polizasseguros`
--
ALTER TABLE `polizasseguros`
  ADD PRIMARY KEY (`Numero`),
  ADD KEY `CedulaPersona` (`Cedula`);

--
-- Indices de la tabla `serviciosfunerarios`
--
ALTER TABLE `serviciosfunerarios`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `NumeroPoliza` (`CodigoPoliza`);

--
-- Indices de la tabla `serviciosprestados`
--
ALTER TABLE `serviciosprestados`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`No_Identificacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cementerio`
--
ALTER TABLE `cementerio`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cementerio`
--
ALTER TABLE `cementerio`
  ADD CONSTRAINT `cementerio_ibfk_2` FOREIGN KEY (`EstadoCodigo`) REFERENCES `estados` (`Codigo`);

--
-- Filtros para la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD CONSTRAINT `ciudades_ibfk_1` FOREIGN KEY (`CodigoParroquia`) REFERENCES `parroquias` (`Codigo`);

--
-- Filtros para la tabla `difunto`
--
ALTER TABLE `difunto`
  ADD CONSTRAINT `difunto_ibfk_1` FOREIGN KEY (`Cedula`) REFERENCES `persona` (`CedulaPersona`);

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_ibfk_1` FOREIGN KEY (`CodigoEstado`) REFERENCES `estados` (`Codigo`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`NumeroPoliza`) REFERENCES `polizasseguros` (`Numero`);

--
-- Filtros para la tabla `parroquias`
--
ALTER TABLE `parroquias`
  ADD CONSTRAINT `parroquias_ibfk_1` FOREIGN KEY (`CodigoMunicipio`) REFERENCES `municipios` (`Codigo`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`CedulaPersona`) REFERENCES `polizasseguros` (`Cedula`);

--
-- Filtros para la tabla `personajuridica`
--
ALTER TABLE `personajuridica`
  ADD CONSTRAINT `personajuridica_ibfk_1` FOREIGN KEY (`CedulaRepresentante`) REFERENCES `persona` (`CedulaPersona`);

--
-- Filtros para la tabla `personanatural`
--
ALTER TABLE `personanatural`
  ADD CONSTRAINT `personanatural_ibfk_1` FOREIGN KEY (`Cedula`) REFERENCES `persona` (`CedulaPersona`);

--
-- Filtros para la tabla `serviciosfunerarios`
--
ALTER TABLE `serviciosfunerarios`
  ADD CONSTRAINT `serviciosfunerarios_ibfk_1` FOREIGN KEY (`CodigoPoliza`) REFERENCES `polizasseguros` (`Numero`);

--
-- Filtros para la tabla `serviciosprestados`
--
ALTER TABLE `serviciosprestados`
  ADD CONSTRAINT `serviciosprestados_ibfk_1` FOREIGN KEY (`Codigo`) REFERENCES `serviciosfunerarios` (`Codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
