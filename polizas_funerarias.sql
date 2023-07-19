-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-07-2023 a las 03:16:19
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
  `Tipo` varchar(45) NOT NULL,
  `Rif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `Codigo` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  `Parroquia_Codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`Codigo`, `Descripcion`, `Parroquia_Codigo`) VALUES
(222, 'nuevaciudad', 111);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `difunto`
--

CREATE TABLE `difunto` (
  `Codigo` int(11) NOT NULL,
  `Fecha de N.` datetime NOT NULL,
  `Fecha de D.` datetime NOT NULL,
  `Partida de N.` varchar(45) DEFAULT NULL,
  `Causa de M.` varchar(45) NOT NULL,
  `cedula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `Codigo` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`Codigo`, `Descripcion`) VALUES
(5206, 'prueba1'),
(6301, 'Nueva Esparta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_anual`
--

CREATE TABLE `factura_anual` (
  `Numero` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Monto` varchar(45) NOT NULL,
  `Polizas_De_Seguro_Numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funeraria`
--

CREATE TABLE `funeraria` (
  `Tipo` varchar(45) NOT NULL,
  `Rif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funeraria_has_servicios_prestados`
--

CREATE TABLE `funeraria_has_servicios_prestados` (
  `Funeraria_Rif` int(11) NOT NULL,
  `Servicios_Prestados_Codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `Codigo` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  `Estado_Codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`Codigo`, `Descripcion`, `Estado_Codigo`) VALUES
(123, 'dffdsf', 5206),
(132, 'maneiro', 5206),
(321, 'maneiro', 6301);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_mensuales`
--

CREATE TABLE `pagos_mensuales` (
  `Numero` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Monto` varchar(45) NOT NULL,
  `Polizas_De_Seguro_Numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parroquia`
--

CREATE TABLE `parroquia` (
  `Codigo` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  `Municipio_Codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `parroquia`
--

INSERT INTO `parroquia` (`Codigo`, `Descripcion`, `Municipio_Codigo`) VALUES
(111, 'nueva', 132),
(1122, 'wwww', 321);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `cedula` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Ciudad_Codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_juridica`
--

CREATE TABLE `persona_juridica` (
  `Rif` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Ciudad_Codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_natural`
--

CREATE TABLE `persona_natural` (
  `Telefono` int(11) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `cedula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `polizas_de_seguro`
--

CREATE TABLE `polizas_de_seguro` (
  `Numero` int(11) NOT NULL,
  `Fecha de Apertura` datetime NOT NULL,
  `Fecha de Cierre` datetime NOT NULL,
  `Cuota anual` varchar(45) NOT NULL,
  `Cuota mensual` varchar(45) NOT NULL,
  `Observaciones` varchar(45) NOT NULL,
  `Polizas_De_Seguro_Persona_Natural_cedula` int(11) NOT NULL,
  `Difunto_cedula` int(11) NOT NULL,
  `Persona_Natural_cedula` int(11) NOT NULL,
  `Usuario_cedula` int(11) NOT NULL,
  `Responsable_Juridico_Rif` int(11) NOT NULL,
  `Cementerio_Rif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `polizas_de_seguro_has_servicios_prestados`
--

CREATE TABLE `polizas_de_seguro_has_servicios_prestados` (
  `Polizas_De_Seguro_Numero` int(11) NOT NULL,
  `Servicios_Prestados_Codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsable_juridico`
--

CREATE TABLE `responsable_juridico` (
  `Correo` varchar(45) NOT NULL,
  `Telefono` int(11) NOT NULL,
  `Razon S.` varchar(45) NOT NULL,
  `Rif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_prestados`
--

CREATE TABLE `servicios_prestados` (
  `Codigo` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `N. Identificacion` int(11) NOT NULL,
  `Login` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Telefono` int(11) NOT NULL,
  `cedula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cementerio`
--
ALTER TABLE `cementerio`
  ADD PRIMARY KEY (`Rif`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`Codigo`,`Parroquia_Codigo`),
  ADD KEY `fk_Ciudad_Parroquia1` (`Parroquia_Codigo`);

--
-- Indices de la tabla `difunto`
--
ALTER TABLE `difunto`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `factura_anual`
--
ALTER TABLE `factura_anual`
  ADD PRIMARY KEY (`Numero`),
  ADD KEY `fk_Factura_Anual_Polizas_De_Seguro1` (`Polizas_De_Seguro_Numero`);

--
-- Indices de la tabla `funeraria`
--
ALTER TABLE `funeraria`
  ADD PRIMARY KEY (`Rif`);

--
-- Indices de la tabla `funeraria_has_servicios_prestados`
--
ALTER TABLE `funeraria_has_servicios_prestados`
  ADD PRIMARY KEY (`Funeraria_Rif`,`Servicios_Prestados_Codigo`),
  ADD KEY `fk_Funeraria_has_Servicios_Prestados_Servicios_Prestados1` (`Servicios_Prestados_Codigo`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `fk_Municipio_Estado1` (`Estado_Codigo`);

--
-- Indices de la tabla `pagos_mensuales`
--
ALTER TABLE `pagos_mensuales`
  ADD PRIMARY KEY (`Numero`),
  ADD KEY `fk_Pagos_Mensuales_Polizas_De_Seguro1` (`Polizas_De_Seguro_Numero`);

--
-- Indices de la tabla `parroquia`
--
ALTER TABLE `parroquia`
  ADD PRIMARY KEY (`Codigo`,`Municipio_Codigo`),
  ADD KEY `fk_Parroquia_Municipio1` (`Municipio_Codigo`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`cedula`),
  ADD KEY `fk_Persona_Ciudad1` (`Ciudad_Codigo`);

--
-- Indices de la tabla `persona_juridica`
--
ALTER TABLE `persona_juridica`
  ADD PRIMARY KEY (`Rif`),
  ADD KEY `fk_Persona_Juridica_Ciudad1` (`Ciudad_Codigo`);

--
-- Indices de la tabla `persona_natural`
--
ALTER TABLE `persona_natural`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `polizas_de_seguro`
--
ALTER TABLE `polizas_de_seguro`
  ADD PRIMARY KEY (`Numero`),
  ADD KEY `fk_Polizas_De_Seguro_Difunto1` (`Difunto_cedula`),
  ADD KEY `fk_Polizas_De_Seguro_Persona_Natural1` (`Persona_Natural_cedula`),
  ADD KEY `fk_Polizas_De_Seguro_Usuario1` (`Usuario_cedula`),
  ADD KEY `fk_Polizas_De_Seguro_Responsable_Juridico1` (`Responsable_Juridico_Rif`),
  ADD KEY `fk_Polizas_De_Seguro_Cementerio1` (`Cementerio_Rif`);

--
-- Indices de la tabla `polizas_de_seguro_has_servicios_prestados`
--
ALTER TABLE `polizas_de_seguro_has_servicios_prestados`
  ADD PRIMARY KEY (`Polizas_De_Seguro_Numero`,`Servicios_Prestados_Codigo`),
  ADD KEY `fk_Polizas_De_Seguro_has_Servicios_Prestados_Servicios_Presta1` (`Servicios_Prestados_Codigo`);

--
-- Indices de la tabla `responsable_juridico`
--
ALTER TABLE `responsable_juridico`
  ADD PRIMARY KEY (`Rif`);

--
-- Indices de la tabla `servicios_prestados`
--
ALTER TABLE `servicios_prestados`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cedula`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cementerio`
--
ALTER TABLE `cementerio`
  ADD CONSTRAINT `fk_Cementerio_Persona_Juridica1` FOREIGN KEY (`Rif`) REFERENCES `persona_juridica` (`Rif`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `fk_Ciudad_Parroquia1` FOREIGN KEY (`Parroquia_Codigo`) REFERENCES `parroquia` (`Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `difunto`
--
ALTER TABLE `difunto`
  ADD CONSTRAINT `fk_Difunto_Persona1` FOREIGN KEY (`cedula`) REFERENCES `persona` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `factura_anual`
--
ALTER TABLE `factura_anual`
  ADD CONSTRAINT `fk_Factura_Anual_Polizas_De_Seguro1` FOREIGN KEY (`Polizas_De_Seguro_Numero`) REFERENCES `polizas_de_seguro` (`Numero`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `funeraria`
--
ALTER TABLE `funeraria`
  ADD CONSTRAINT `fk_Funeraria_Persona_Juridica1` FOREIGN KEY (`Rif`) REFERENCES `persona_juridica` (`Rif`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `funeraria_has_servicios_prestados`
--
ALTER TABLE `funeraria_has_servicios_prestados`
  ADD CONSTRAINT `fk_Funeraria_has_Servicios_Prestados_Funeraria1` FOREIGN KEY (`Funeraria_Rif`) REFERENCES `funeraria` (`Rif`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Funeraria_has_Servicios_Prestados_Servicios_Prestados1` FOREIGN KEY (`Servicios_Prestados_Codigo`) REFERENCES `servicios_prestados` (`Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `fk_Municipio_Estado1` FOREIGN KEY (`Estado_Codigo`) REFERENCES `estado` (`Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pagos_mensuales`
--
ALTER TABLE `pagos_mensuales`
  ADD CONSTRAINT `fk_Pagos_Mensuales_Polizas_De_Seguro1` FOREIGN KEY (`Polizas_De_Seguro_Numero`) REFERENCES `polizas_de_seguro` (`Numero`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `parroquia`
--
ALTER TABLE `parroquia`
  ADD CONSTRAINT `fk_Parroquia_Municipio1` FOREIGN KEY (`Municipio_Codigo`) REFERENCES `municipio` (`Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_Persona_Ciudad1` FOREIGN KEY (`Ciudad_Codigo`) REFERENCES `ciudad` (`Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona_juridica`
--
ALTER TABLE `persona_juridica`
  ADD CONSTRAINT `fk_Persona_Juridica_Ciudad1` FOREIGN KEY (`Ciudad_Codigo`) REFERENCES `ciudad` (`Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona_natural`
--
ALTER TABLE `persona_natural`
  ADD CONSTRAINT `fk_Persona_Natural_Persona1` FOREIGN KEY (`cedula`) REFERENCES `persona` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `polizas_de_seguro`
--
ALTER TABLE `polizas_de_seguro`
  ADD CONSTRAINT `fk_Polizas_De_Seguro_Cementerio1` FOREIGN KEY (`Cementerio_Rif`) REFERENCES `cementerio` (`Rif`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Polizas_De_Seguro_Difunto1` FOREIGN KEY (`Difunto_cedula`) REFERENCES `difunto` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Polizas_De_Seguro_Persona_Natural1` FOREIGN KEY (`Persona_Natural_cedula`) REFERENCES `persona_natural` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Polizas_De_Seguro_Responsable_Juridico1` FOREIGN KEY (`Responsable_Juridico_Rif`) REFERENCES `responsable_juridico` (`Rif`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Polizas_De_Seguro_Usuario1` FOREIGN KEY (`Usuario_cedula`) REFERENCES `usuario` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `polizas_de_seguro_has_servicios_prestados`
--
ALTER TABLE `polizas_de_seguro_has_servicios_prestados`
  ADD CONSTRAINT `fk_Polizas_De_Seguro_has_Servicios_Prestados_Polizas_De_Seguro1` FOREIGN KEY (`Polizas_De_Seguro_Numero`) REFERENCES `polizas_de_seguro` (`Numero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Polizas_De_Seguro_has_Servicios_Prestados_Servicios_Presta1` FOREIGN KEY (`Servicios_Prestados_Codigo`) REFERENCES `servicios_prestados` (`Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `responsable_juridico`
--
ALTER TABLE `responsable_juridico`
  ADD CONSTRAINT `fk_Responsable_Juridico_Persona_Juridica1` FOREIGN KEY (`Rif`) REFERENCES `persona_juridica` (`Rif`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_Persona1` FOREIGN KEY (`cedula`) REFERENCES `persona` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
