-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 18-03-2020 a las 10:02:57
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mac_dtec`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `becarios`
--

DROP TABLE IF EXISTS `becarios`;
CREATE TABLE IF NOT EXISTS `becarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `informe_avance_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `informe_avance_id` (`informe_avance_id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fincas`
--

DROP TABLE IF EXISTS `fincas`;
CREATE TABLE IF NOT EXISTS `fincas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `codigo` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fincas`
--

INSERT INTO `fincas` (`id`, `nombre`, `codigo`) VALUES
(1, 'Ricardo Gómez', 'RG'),
(2, 'Francisco González', 'FG'),
(3, 'Marquesa Montenergro', 'MM'),
(4, 'Colonia Jaime', 'CJ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hitos`
--

DROP TABLE IF EXISTS `hitos`;
CREATE TABLE IF NOT EXISTS `hitos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto` text NOT NULL,
  `indicador` text NOT NULL,
  `unidad_medida` varchar(100) NOT NULL,
  `anio` varchar(4) NOT NULL,
  `esperado` int(11) NOT NULL,
  `alcanzado` int(11) NOT NULL,
  `medios_verificacion` text NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicadores`
--

DROP TABLE IF EXISTS `indicadores`;
CREATE TABLE IF NOT EXISTS `indicadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `codigo` varchar(5) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `indicadores`
--

INSERT INTO `indicadores` (`id`, `nombre`, `codigo`, `categoria_id`) VALUES
(1, 'Articulación con instituciones píblicas', 'AIP', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicadores_categorias`
--

DROP TABLE IF EXISTS `indicadores_categorias`;
CREATE TABLE IF NOT EXISTS `indicadores_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `codigo` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `indicadores_categorias`
--

INSERT INTO `indicadores_categorias` (`id`, `nombre`, `codigo`) VALUES
(1, 'Dimensión Socio Cultural', 'ISC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infomes_hitos`
--

DROP TABLE IF EXISTS `infomes_hitos`;
CREATE TABLE IF NOT EXISTS `infomes_hitos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `informe_id` int(11) NOT NULL,
  `universidad` varchar(100) NOT NULL,
  `proyecto` varchar(100) NOT NULL,
  `componente` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `informe_id` (`informe_id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes`
--

DROP TABLE IF EXISTS `informes`;
CREATE TABLE IF NOT EXISTS `informes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('comun','plantilla') NOT NULL,
  `periodo` enum('mensual','anual') NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes_avances`
--

DROP TABLE IF EXISTS `informes_avances`;
CREATE TABLE IF NOT EXISTS `informes_avances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `informe_id` int(11) NOT NULL,
  `anio` varchar(4) NOT NULL,
  `codigo_proyecto` int(11) NOT NULL,
  `universidad` varchar(100) NOT NULL,
  `proyecto` varchar(100) NOT NULL,
  `componente` int(11) NOT NULL,
  `director_proyecto_id` int(11) NOT NULL,
  `periodo_informe` datetime NOT NULL,
  `fecha_ita` datetime NOT NULL,
  `resultados_pa` text NOT NULL,
  `grado_avance` text NOT NULL,
  `analisis_casual` text NOT NULL,
  `ajustes` text NOT NULL,
  `sintesis` text NOT NULL,
  `avance_transferencia` text NOT NULL,
  `presupuesto_estado` text NOT NULL,
  `acciones_gastos` text NOT NULL,
  `comentarios` text NOT NULL,
  `anexos` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `director_proyecto_id` (`director_proyecto_id`),
  KEY `informe_id` (`informe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes_avances_becarios`
--

DROP TABLE IF EXISTS `informes_avances_becarios`;
CREATE TABLE IF NOT EXISTS `informes_avances_becarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `informe_avance_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `informe_avance_id` (`informe_avance_id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes_comunes`
--

DROP TABLE IF EXISTS `informes_comunes`;
CREATE TABLE IF NOT EXISTS `informes_comunes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `informe_id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `informe_id` (`informe_id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes_comunes_imagenes`
--

DROP TABLE IF EXISTS `informes_comunes_imagenes`;
CREATE TABLE IF NOT EXISTS `informes_comunes_imagenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `informe_comun_id` int(11) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `informe_comun_id` (`informe_comun_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes_indicadores`
--

DROP TABLE IF EXISTS `informes_indicadores`;
CREATE TABLE IF NOT EXISTS `informes_indicadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `informe_id` int(11) NOT NULL,
  `indicador_id` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indicador_id` (`indicador_id`),
  KEY `informe_id` (`informe_id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

DROP TABLE IF EXISTS `notas`;
CREATE TABLE IF NOT EXISTS `notas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenido` text NOT NULL,
  `fecha` datetime NOT NULL,
  `tipo_nota_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_nota_id` (`tipo_nota_id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE IF NOT EXISTS `permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Administrador', 'Administrador del sistema'),
(2, 'Director', 'Director del proyecto'),
(3, 'Responsable componente', 'Responsable del componente'),
(4, 'PAF', 'PAF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_permisos`
--

DROP TABLE IF EXISTS `roles_permisos`;
CREATE TABLE IF NOT EXISTS `roles_permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_id` int(11) NOT NULL,
  `permiso_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permiso_id` (`permiso_id`),
  KEY `rol_id` (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_notas`
--

DROP TABLE IF EXISTS `tipo_notas`;
CREATE TABLE IF NOT EXISTS `tipo_notas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_notas`
--

INSERT INTO `tipo_notas` (`id`, `descripcion`) VALUES
(1, 'Solicitud de Viáticos'),
(2, 'Permisos de salida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `domicilio` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rol_id` int(11) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `rol_id` (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `domicilio`, `rol_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, 1, NULL, '$2y$10$u1fwrSBwcxJQ3KIKVpH2S.Y5yAPF8LTQ1u6Fj2Aklfecb1VFnT1YO', 's0xgLNUQ63MBnIBVdkrW195N4HTUdMBSXbkacHAZGBqG5ZOKsyZDHQJeqdN0', '2020-03-15 23:46:53', '2020-03-15 23:46:53'),
(2, 'Karina Herrera', 'karinaherrera@gmail.com', NULL, 1, NULL, '$2y$10$Qh4iWBvcO7jb8nmg2h6wkuYAuINsBcQMnqQ40ouTqQ5YFb4Z0.Cni', NULL, '2020-03-16 16:58:07', '2020-03-16 16:58:07');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `becarios`
--
ALTER TABLE `becarios`
  ADD CONSTRAINT `becarios_ibfk_1` FOREIGN KEY (`informe_avance_id`) REFERENCES `informes_avances` (`id`),
  ADD CONSTRAINT `becarios_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `hitos`
--
ALTER TABLE `hitos`
  ADD CONSTRAINT `hitos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `indicadores`
--
ALTER TABLE `indicadores`
  ADD CONSTRAINT `indicadores_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `indicadores_categorias` (`id`);

--
-- Filtros para la tabla `infomes_hitos`
--
ALTER TABLE `infomes_hitos`
  ADD CONSTRAINT `infomes_hitos_ibfk_1` FOREIGN KEY (`informe_id`) REFERENCES `informes` (`id`),
  ADD CONSTRAINT `infomes_hitos_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `informes`
--
ALTER TABLE `informes`
  ADD CONSTRAINT `informes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `informes_avances`
--
ALTER TABLE `informes_avances`
  ADD CONSTRAINT `informes_avances_ibfk_1` FOREIGN KEY (`director_proyecto_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `informes_avances_ibfk_2` FOREIGN KEY (`informe_id`) REFERENCES `informes` (`id`);

--
-- Filtros para la tabla `informes_avances_becarios`
--
ALTER TABLE `informes_avances_becarios`
  ADD CONSTRAINT `informes_avances_becarios_ibfk_1` FOREIGN KEY (`informe_avance_id`) REFERENCES `informes_avances` (`id`),
  ADD CONSTRAINT `informes_avances_becarios_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `informes_comunes`
--
ALTER TABLE `informes_comunes`
  ADD CONSTRAINT `informes_comunes_ibfk_1` FOREIGN KEY (`informe_id`) REFERENCES `informes` (`id`),
  ADD CONSTRAINT `informes_comunes_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `informes_comunes_imagenes`
--
ALTER TABLE `informes_comunes_imagenes`
  ADD CONSTRAINT `informes_comunes_imagenes_ibfk_1` FOREIGN KEY (`informe_comun_id`) REFERENCES `informes_comunes` (`id`);

--
-- Filtros para la tabla `informes_indicadores`
--
ALTER TABLE `informes_indicadores`
  ADD CONSTRAINT `informes_indicadores_ibfk_1` FOREIGN KEY (`indicador_id`) REFERENCES `indicadores` (`id`),
  ADD CONSTRAINT `informes_indicadores_ibfk_2` FOREIGN KEY (`informe_id`) REFERENCES `informes` (`id`),
  ADD CONSTRAINT `informes_indicadores_ibfk_3` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`tipo_nota_id`) REFERENCES `tipo_notas` (`id`),
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  ADD CONSTRAINT `roles_permisos_ibfk_1` FOREIGN KEY (`permiso_id`) REFERENCES `permisos` (`id`),
  ADD CONSTRAINT `roles_permisos_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
