-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2020 a las 19:38:25
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `videoclub`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo`
--

CREATE TABLE `catalogo` (
  `numero_pelicula` int(11) NOT NULL,
  `nombre_pelicula` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_lanzamiento` int(11) DEFAULT NULL,
  `genero` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `origen` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alquilada` int(11) NOT NULL,
  `duracion` int(11) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `catalogo`
--

INSERT INTO `catalogo` (`numero_pelicula`, `nombre_pelicula`, `fecha_lanzamiento`, `genero`, `origen`, `alquilada`, `duracion`, `precio`) VALUES
(1, 'Dinocroc vs. Supergator', 2010, 'Terror', 'EEUU', 0, 87, 99),
(2, 'Malibu Shark Attack', 2009, 'Acción', 'Canadá', 0, 86, 23),
(3, 'La lavadora asesina', 1993, 'Terror', 'Italia', 0, 90, 55),
(4, 'Dragon Wars', 2007, 'Fantástico', 'Corea del Sur', 0, 107, 66),
(5, 'Death Tube', 2010, 'Terror', 'Japón', 1, 116, 1),
(6, 'Plump Fiction', 1997, 'Comedia', 'EEUU', 0, 153, 12),
(7, 'XP3D', 2011, 'Terror', 'España', 1, 90, 12),
(11, 'Princess of Mars', 2009, 'Fantástico', 'EEUU', 0, 90, 33),
(15, 'Yarasa Adam: Bedmen (Turkish Batman & Robin)', 1973, 'Comedia', 'Turquía', 1, 62, 2),
(19, 'Star Crash, choque de galaxias', 1978, 'Comedia', 'Italia', 0, 94, 5),
(25, 'Amphibious 3D, choque de galaxias', 2010, 'Terror', 'Holanda', 1, 86, 56),
(50, 'El gran dictador', 1940, 'Comedia', 'EEUU', 0, 124, 111),
(921, 'Porca Vita', 1991, 'Drama', 'Italia', 0, 99, 90),
(923, 'Ashes And Snow', 2005, 'Documental', 'EEUU', 0, 63, 67);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `numero_empleado` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` int(11) NOT NULL,
  `fecha_inicio` int(11) NOT NULL,
  `fecha_final` int(11) DEFAULT NULL,
  `horario` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salario` int(11) NOT NULL,
  `alias` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`numero_empleado`, `nombre`, `apellido`, `fecha_nacimiento`, `fecha_inicio`, `fecha_final`, `horario`, `salario`, `alias`, `clave`) VALUES
(121, 'Julia ', 'Montgomery', 1969, 1992, 1995, NULL, 0, 'July', 'soyyo'),
(201, 'Kelly', 'Jennings', 1928, 1952, 1996, NULL, 0, 'LeroyJeggins', 'LEEEEEEROOOOY'),
(202, 'Pepe', 'Oyuela', 2002, 2020, NULL, '10:00-15:00', 500, 'Pepito', 'PEPES'),
(233, 'Julio', 'McPato', 2001, 2020, NULL, '10:00-20:00', 2000, 'Pato', 'Quack'),
(422, 'Mario', 'Bros', 1992, 2019, NULL, '12:00-19:00', 1500, 'MarioBros', 'itsamemario'),
(912, 'Christopher P.', 'Stone', 1932, 2006, 2020, NULL, 0, 'Stoner', 'maria'),
(999, 'Donald ', 'Spencer', 1993, 2005, 0, '11:00-19:00', 999, 'D.Trump', 'MakeAmericaGreatAgain'),
(2223, 'Admin', 'Admino', 1000, 2000, 0, '00:00-23:00', 20000, 'Admin', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20201206182324', '2020-12-06 18:23:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Codigo` int(11) NOT NULL,
  `Alias` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Clave` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Codigo`, `Alias`, `Clave`, `Admin`) VALUES
(202, 'Pepito', 'PEPES', 0),
(233, 'Pato', 'Quack', 0),
(422, 'MarioBros', 'itsamemario', 1),
(999, 'D.Trump', 'MakeAmericaGreatAgain', 1),
(2223, 'Admin', 'admin', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `catalogo`
--
ALTER TABLE `catalogo`
  ADD PRIMARY KEY (`numero_pelicula`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`numero_empleado`),
  ADD KEY `alias` (`alias`),
  ADD KEY `clave` (`clave`);

--
-- Indices de la tabla `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `Alias` (`Alias`),
  ADD KEY `Clave` (`Clave`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `catalogo`
--
ALTER TABLE `catalogo`
  MODIFY `numero_pelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=924;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `numero_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2225;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2224;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_alias` FOREIGN KEY (`Alias`) REFERENCES `empleados` (`alias`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_clave` FOREIGN KEY (`Clave`) REFERENCES `empleados` (`clave`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_codigo` FOREIGN KEY (`Codigo`) REFERENCES `empleados` (`numero_empleado`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
