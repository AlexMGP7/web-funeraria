-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-07-2023 a las 15:31:48
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

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

DROP TABLE IF EXISTS `cementerio`;
CREATE TABLE IF NOT EXISTS `cementerio` (
  `Tipo` varchar(45) NOT NULL,
  `Rif` int(11) NOT NULL,
  PRIMARY KEY (`Rif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
CREATE TABLE IF NOT EXISTS `ciudad` (
  `Codigo` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  `Parroquia_Codigo` int(11) NOT NULL,
  PRIMARY KEY (`Codigo`,`Parroquia_Codigo`),
  KEY `fk_Ciudad_Parroquia1` (`Parroquia_Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`Codigo`, `Descripcion`, `Parroquia_Codigo`) VALUES
(1, 'Porlamar', 1),
(11111, 'eeeee', 11111);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `difunto`
--

DROP TABLE IF EXISTS `difunto`;
CREATE TABLE IF NOT EXISTS `difunto` (
  `Codigo` int(11) NOT NULL,
  `Fecha de N.` datetime NOT NULL,
  `Fecha de D.` datetime NOT NULL,
  `Partida de N.` varchar(45) DEFAULT NULL,
  `Causa de M.` varchar(45) NOT NULL,
  `cedula` int(11) NOT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE IF NOT EXISTS `estado` (
  `Codigo` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`Codigo`, `Descripcion`) VALUES
(1, 'Amazonas'),
(2, 'Anzoátegui'),
(3, 'Apure'),
(4, 'Aragua'),
(5, 'Barinas'),
(6, 'Bolívar'),
(7, 'Carabobo'),
(8, 'Cojedes'),
(9, 'Delta Amacuro'),
(10, 'Falcón'),
(11, 'Guárico'),
(12, 'Lara'),
(13, 'Mérida'),
(14, 'Miranda'),
(15, 'Monagas'),
(16, 'Nueva Esparta'),
(17, 'Portuguesa'),
(18, 'Sucre'),
(19, 'Táchira'),
(20, 'Trujillo'),
(21, 'La Guaira'),
(22, 'Yaracuy'),
(23, 'Zulia'),
(24, 'Distrito Capital'),
(25, 'Dependencias Federales'),
(911, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_anual`
--

DROP TABLE IF EXISTS `factura_anual`;
CREATE TABLE IF NOT EXISTS `factura_anual` (
  `Numero` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Monto` varchar(45) NOT NULL,
  `Polizas_De_Seguro_Numero` int(11) NOT NULL,
  PRIMARY KEY (`Numero`),
  KEY `fk_Factura_Anual_Polizas_De_Seguro1` (`Polizas_De_Seguro_Numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funeraria`
--

DROP TABLE IF EXISTS `funeraria`;
CREATE TABLE IF NOT EXISTS `funeraria` (
  `Tipo` varchar(45) NOT NULL,
  `Rif` int(11) NOT NULL,
  PRIMARY KEY (`Rif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funeraria_has_servicios_prestados`
--

DROP TABLE IF EXISTS `funeraria_has_servicios_prestados`;
CREATE TABLE IF NOT EXISTS `funeraria_has_servicios_prestados` (
  `Funeraria_Rif` int(11) NOT NULL,
  `Servicios_Prestados_Codigo` int(11) NOT NULL,
  PRIMARY KEY (`Funeraria_Rif`,`Servicios_Prestados_Codigo`),
  KEY `fk_Funeraria_has_Servicios_Prestados_Servicios_Prestados1` (`Servicios_Prestados_Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

DROP TABLE IF EXISTS `municipio`;
CREATE TABLE IF NOT EXISTS `municipio` (
  `Codigo` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  `Estado_Codigo` int(11) NOT NULL,
  PRIMARY KEY (`Codigo`),
  KEY `fk_Municipio_Estado1` (`Estado_Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`Codigo`, `Descripcion`, `Estado_Codigo`) VALUES
(1, 'Maneiro', 16),
(11111, '3', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_mensuales`
--

DROP TABLE IF EXISTS `pagos_mensuales`;
CREATE TABLE IF NOT EXISTS `pagos_mensuales` (
  `Numero` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Monto` varchar(45) NOT NULL,
  `Polizas_De_Seguro_Numero` int(11) NOT NULL,
  PRIMARY KEY (`Numero`),
  KEY `fk_Pagos_Mensuales_Polizas_De_Seguro1` (`Polizas_De_Seguro_Numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parroquia`
--

DROP TABLE IF EXISTS `parroquia`;
CREATE TABLE IF NOT EXISTS `parroquia` (
  `Codigo` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  `Municipio_Codigo` int(11) NOT NULL,
  PRIMARY KEY (`Codigo`,`Municipio_Codigo`),
  KEY `fk_Parroquia_Municipio1` (`Municipio_Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `parroquia`
--

INSERT INTO `parroquia` (`Codigo`, `Descripcion`, `Municipio_Codigo`) VALUES
(1, 'Aguirre', 1),
(11111, 'aaaaaa', 11111);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE IF NOT EXISTS `persona` (
  `cedula` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Ciudad_Codigo` int(11) DEFAULT NULL,
  PRIMARY KEY (`cedula`),
  KEY `fk_Persona_Ciudad1` (`Ciudad_Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`cedula`, `nombre`, `Apellido`, `Ciudad_Codigo`) VALUES
(1, 'aee', 'aee', 1),
(30230460, 'Alexander', 'Gonzalez', 11111);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_juridica`
--

DROP TABLE IF EXISTS `persona_juridica`;
CREATE TABLE IF NOT EXISTS `persona_juridica` (
  `Rif` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Ciudad_Codigo` int(11) NOT NULL,
  PRIMARY KEY (`Rif`),
  KEY `fk_Persona_Juridica_Ciudad1` (`Ciudad_Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_natural`
--

DROP TABLE IF EXISTS `persona_natural`;
CREATE TABLE IF NOT EXISTS `persona_natural` (
  `Telefono` int(11) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `cedula` int(11) NOT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `polizas_de_seguro`
--

DROP TABLE IF EXISTS `polizas_de_seguro`;
CREATE TABLE IF NOT EXISTS `polizas_de_seguro` (
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
  `Cementerio_Rif` int(11) NOT NULL,
  PRIMARY KEY (`Numero`),
  KEY `fk_Polizas_De_Seguro_Difunto1` (`Difunto_cedula`),
  KEY `fk_Polizas_De_Seguro_Persona_Natural1` (`Persona_Natural_cedula`),
  KEY `fk_Polizas_De_Seguro_Usuario1` (`Usuario_cedula`),
  KEY `fk_Polizas_De_Seguro_Responsable_Juridico1` (`Responsable_Juridico_Rif`),
  KEY `fk_Polizas_De_Seguro_Cementerio1` (`Cementerio_Rif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `polizas_de_seguro_has_servicios_prestados`
--

DROP TABLE IF EXISTS `polizas_de_seguro_has_servicios_prestados`;
CREATE TABLE IF NOT EXISTS `polizas_de_seguro_has_servicios_prestados` (
  `Polizas_De_Seguro_Numero` int(11) NOT NULL,
  `Servicios_Prestados_Codigo` int(11) NOT NULL,
  PRIMARY KEY (`Polizas_De_Seguro_Numero`,`Servicios_Prestados_Codigo`),
  KEY `fk_Polizas_De_Seguro_has_Servicios_Prestados_Servicios_Presta1` (`Servicios_Prestados_Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsable_juridico`
--

DROP TABLE IF EXISTS `responsable_juridico`;
CREATE TABLE IF NOT EXISTS `responsable_juridico` (
  `Correo` varchar(45) NOT NULL,
  `Telefono` int(11) NOT NULL,
  `Razon S.` varchar(45) NOT NULL,
  `Rif` int(11) NOT NULL,
  PRIMARY KEY (`Rif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_prestados`
--

DROP TABLE IF EXISTS `servicios_prestados`;
CREATE TABLE IF NOT EXISTS `servicios_prestados` (
  `Codigo` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Login` varchar(45) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Telefono` varchar(25) NOT NULL,
  `cedula` int(11) NOT NULL,
  PRIMARY KEY (`cedula`),
  UNIQUE KEY `Id` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id`, `Login`, `Password`, `Telefono`, `cedula`) VALUES
(9, 'alexmgp7', '$2y$10$nS5/42AnelMeE.P3s9dEROceHrdXexb7Q.KyvJowHHpix.n5e3fTu', '04121118200', 30230460);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cementerio`
--
ALTER TABLE `cementerio`
  ADD CONSTRAINT `fk_Cementerio_Persona_Juridica1` FOREIGN KEY (`Rif`) REFERENCES `persona_juridica` (`Rif`);

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `fk_Ciudad_Parroquia1` FOREIGN KEY (`Parroquia_Codigo`) REFERENCES `parroquia` (`Codigo`);

--
-- Filtros para la tabla `difunto`
--
ALTER TABLE `difunto`
  ADD CONSTRAINT `fk_Difunto_Persona1` FOREIGN KEY (`cedula`) REFERENCES `persona` (`cedula`);

--
-- Filtros para la tabla `factura_anual`
--
ALTER TABLE `factura_anual`
  ADD CONSTRAINT `fk_Factura_Anual_Polizas_De_Seguro1` FOREIGN KEY (`Polizas_De_Seguro_Numero`) REFERENCES `polizas_de_seguro` (`Numero`);

--
-- Filtros para la tabla `funeraria`
--
ALTER TABLE `funeraria`
  ADD CONSTRAINT `fk_Funeraria_Persona_Juridica1` FOREIGN KEY (`Rif`) REFERENCES `persona_juridica` (`Rif`);

--
-- Filtros para la tabla `funeraria_has_servicios_prestados`
--
ALTER TABLE `funeraria_has_servicios_prestados`
  ADD CONSTRAINT `fk_Funeraria_has_Servicios_Prestados_Funeraria1` FOREIGN KEY (`Funeraria_Rif`) REFERENCES `funeraria` (`Rif`),
  ADD CONSTRAINT `fk_Funeraria_has_Servicios_Prestados_Servicios_Prestados1` FOREIGN KEY (`Servicios_Prestados_Codigo`) REFERENCES `servicios_prestados` (`Codigo`);

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `fk_Municipio_Estado1` FOREIGN KEY (`Estado_Codigo`) REFERENCES `estado` (`Codigo`);

--
-- Filtros para la tabla `pagos_mensuales`
--
ALTER TABLE `pagos_mensuales`
  ADD CONSTRAINT `fk_Pagos_Mensuales_Polizas_De_Seguro1` FOREIGN KEY (`Polizas_De_Seguro_Numero`) REFERENCES `polizas_de_seguro` (`Numero`);

--
-- Filtros para la tabla `parroquia`
--
ALTER TABLE `parroquia`
  ADD CONSTRAINT `fk_Parroquia_Municipio1` FOREIGN KEY (`Municipio_Codigo`) REFERENCES `municipio` (`Codigo`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_Persona_Ciudad1` FOREIGN KEY (`Ciudad_Codigo`) REFERENCES `ciudad` (`Codigo`);

--
-- Filtros para la tabla `persona_juridica`
--
ALTER TABLE `persona_juridica`
  ADD CONSTRAINT `fk_Persona_Juridica_Ciudad1` FOREIGN KEY (`Ciudad_Codigo`) REFERENCES `ciudad` (`Codigo`);

--
-- Filtros para la tabla `persona_natural`
--
ALTER TABLE `persona_natural`
  ADD CONSTRAINT `fk_Persona_Natural_Persona1` FOREIGN KEY (`cedula`) REFERENCES `persona` (`cedula`);

--
-- Filtros para la tabla `polizas_de_seguro`
--
ALTER TABLE `polizas_de_seguro`
  ADD CONSTRAINT `fk_Polizas_De_Seguro_Cementerio1` FOREIGN KEY (`Cementerio_Rif`) REFERENCES `cementerio` (`Rif`),
  ADD CONSTRAINT `fk_Polizas_De_Seguro_Difunto1` FOREIGN KEY (`Difunto_cedula`) REFERENCES `difunto` (`cedula`),
  ADD CONSTRAINT `fk_Polizas_De_Seguro_Persona_Natural1` FOREIGN KEY (`Persona_Natural_cedula`) REFERENCES `persona_natural` (`cedula`),
  ADD CONSTRAINT `fk_Polizas_De_Seguro_Responsable_Juridico1` FOREIGN KEY (`Responsable_Juridico_Rif`) REFERENCES `responsable_juridico` (`Rif`),
  ADD CONSTRAINT `fk_Polizas_De_Seguro_Usuario1` FOREIGN KEY (`Usuario_cedula`) REFERENCES `usuario` (`cedula`);

--
-- Filtros para la tabla `polizas_de_seguro_has_servicios_prestados`
--
ALTER TABLE `polizas_de_seguro_has_servicios_prestados`
  ADD CONSTRAINT `fk_Polizas_De_Seguro_has_Servicios_Prestados_Polizas_De_Seguro1` FOREIGN KEY (`Polizas_De_Seguro_Numero`) REFERENCES `polizas_de_seguro` (`Numero`),
  ADD CONSTRAINT `fk_Polizas_De_Seguro_has_Servicios_Prestados_Servicios_Presta1` FOREIGN KEY (`Servicios_Prestados_Codigo`) REFERENCES `servicios_prestados` (`Codigo`);

--
-- Filtros para la tabla `responsable_juridico`
--
ALTER TABLE `responsable_juridico`
  ADD CONSTRAINT `fk_Responsable_Juridico_Persona_Juridica1` FOREIGN KEY (`Rif`) REFERENCES `persona_juridica` (`Rif`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_Persona1` FOREIGN KEY (`cedula`) REFERENCES `persona` (`cedula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
