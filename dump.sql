-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-11-2024 a las 02:52:41
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laravel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aromas`
--

DROP TABLE IF EXISTS `aromas`;
CREATE TABLE IF NOT EXISTS `aromas` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `aromas`
--

INSERT INTO `aromas` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, '(N/D)', '2024-11-10 13:11:44', '2024-11-10 13:24:12'),
(2, 'Lavanda', '2024-11-10 13:11:44', '2024-11-10 13:24:41'),
(3, 'Nag Champa', '2024-11-10 13:11:44', '2024-11-10 13:24:49'),
(4, 'Canela', '2024-11-10 13:11:44', '2024-11-10 13:24:59'),
(5, 'Mirra', '2024-11-10 13:11:44', '2024-11-10 13:25:08'),
(6, 'corrupti', '2024-11-10 13:11:44', '2024-11-10 13:11:44'),
(7, 'ab', '2024-11-10 13:11:44', '2024-11-10 13:11:44'),
(8, 'omnis', '2024-11-10 13:11:44', '2024-11-10 13:11:44'),
(9, 'quod', '2024-11-10 13:11:44', '2024-11-10 13:11:44'),
(10, 'dolor', '2024-11-10 13:11:44', '2024-11-10 13:11:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas`
--

DROP TABLE IF EXISTS `cajas`;
CREATE TABLE IF NOT EXISTS `cajas` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario_id` int NOT NULL,
  `monto_inicial` double NOT NULL,
  `comentario` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monto_final` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fecha_cierre` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellido`, `created_at`, `updated_at`) VALUES
(1, 'Kevin', 'Benavides', '2024-11-10 13:11:44', '2024-11-10 13:26:05'),
(2, 'Franco', 'Colapinto', '2024-11-10 13:11:44', '2024-11-10 13:26:16'),
(3, 'Marcos', 'Di Palma', '2024-11-10 13:11:44', '2024-11-10 13:26:24'),
(4, 'Eduardo', 'Wallenstein', '2024-11-10 13:11:44', '2024-11-10 13:26:39'),
(5, 'Garfield', 'Cranel', '2024-11-10 13:11:44', '2024-11-10 13:26:48'),
(7, 'Cliente', 'en local', '2024-11-10 17:15:25', '2024-11-10 17:15:25'),
(9, 'asld', 'editable', '2024-11-10 19:06:37', '2024-11-10 19:07:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

DROP TABLE IF EXISTS `compras`;
CREATE TABLE IF NOT EXISTS `compras` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `caja_id` int NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_detalles`
--

DROP TABLE IF EXISTS `compra_detalles`;
CREATE TABLE IF NOT EXISTS `compra_detalles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `compra_id` int NOT NULL,
  `marca_id` int NOT NULL,
  `proveedor_id` int NOT NULL,
  `producto_id` int NOT NULL,
  `aroma_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio_costo` double NOT NULL,
  `porcentaje_ganancia` int NOT NULL,
  `precio_venta` double NOT NULL,
  `cantidad` int NOT NULL,
  `stock_minimo` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historials`
--

DROP TABLE IF EXISTS `historials`;
CREATE TABLE IF NOT EXISTS `historials` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `compra_detalle_id` int NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad_movida` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

DROP TABLE IF EXISTS `marcas`;
CREATE TABLE IF NOT EXISTS `marcas` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Aromanza', '2024-11-10 13:11:44', '2024-11-10 13:22:56'),
(2, 'Iluminarte', '2024-11-10 13:11:44', '2024-11-10 13:23:06'),
(3, 'Triskel', '2024-11-10 13:11:44', '2024-11-10 13:23:15'),
(4, 'Goloka', '2024-11-10 13:11:44', '2024-11-10 13:23:38'),
(5, 'Sagrada Madre', '2024-11-10 13:11:44', '2024-11-10 13:23:49'),
(6, 'odio', '2024-11-10 13:11:44', '2024-11-10 13:11:44'),
(7, 'voluptatem', '2024-11-10 13:11:44', '2024-11-10 13:11:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_pagos`
--

DROP TABLE IF EXISTS `metodo_pagos`;
CREATE TABLE IF NOT EXISTS `metodo_pagos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `metodo_pagos`
--

INSERT INTO `metodo_pagos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Mercado', '2024-11-10 13:11:44', '2024-11-10 19:04:34'),
(2, 'Efectivo', '2024-11-10 13:11:44', '2024-11-10 13:25:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(21, '2014_10_12_000000_create_users_table', 1),
(22, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(23, '2019_08_19_000000_create_failed_jobs_table', 1),
(24, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(25, '2024_05_21_122513_create_compras_table', 1),
(26, '2024_05_21_122620_create_ventas_table', 1),
(27, '2024_05_21_122712_create_metodo_pagos_table', 1),
(28, '2024_05_21_123703_create_compra_detalles_table', 1),
(29, '2024_05_21_123722_create_venta_detalles_table', 1),
(30, '2024_05_21_123740_create_venta_pagos_table', 1),
(31, '2024_05_21_132437_create_marcas_table', 1),
(32, '2024_05_21_132448_create_cajas_table', 1),
(33, '2024_05_21_132459_create_clientes_table', 1),
(34, '2024_05_21_132514_create_aromas_table', 1),
(35, '2024_05_21_132530_create_productos_table', 1),
(36, '2024_05_21_132548_create_tiendas_table', 1),
(37, '2024_06_02_044514_create_proveedores_table', 1),
(38, '2024_07_17_125025_create_movimientos_caja_table', 1),
(39, '2024_09_25_022834_create_notifications_table', 1),
(40, '2024_10_06_212541_create_historials_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_caja`
--

DROP TABLE IF EXISTS `movimientos_caja`;
CREATE TABLE IF NOT EXISTS `movimientos_caja` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `caja_id` int NOT NULL,
  `tipo_movimiento` enum('Entrada','Salida') COLLATE utf8mb4_unicode_ci NOT NULL,
  `monto` double NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leida` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio_costo` int NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `codigo`, `precio_costo`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Cristales', NULL, 537, 'Piedras como cuarzo rosa (amor), amatista (protección y espiritualidad) y citrino (abundancia) son populares en el esoterismo. Cada cristal tiene propiedades específicas para equilibrar energías y mejorar aspectos emocionales y espirituales.', '2024-11-10 13:11:44', '2024-11-10 13:19:16'),
(2, 'Oráculo', NULL, 978, 'Juegos de cartas para la lectura y adivinación. El tarot clásico y otros oráculos (como cartas de ángeles) ayudan en la meditación y en la obtención de orientación espiritual.', '2024-11-10 13:11:44', '2024-11-10 13:20:45'),
(3, 'Sahumerio\r\n', NULL, 2050, 'Instrumentos utilizados para quemar resinas, hierbas o incienso en rituales de limpieza de energía. El humo generado ayuda a despejar energías negativas y equilibrar el ambiente.', '2024-11-10 13:11:44', '2024-11-10 13:21:32'),
(4, 'Aceites Esenciales', NULL, 1850, 'Aceites y esencias utilizados en aromaterapia para equilibrar emociones y energías. Los aceites como lavanda, romero y sándalo son populares para relajación, protección y enfoque espiritual.', '2024-11-10 13:11:44', '2024-11-10 13:22:05'),
(5, 'Pulseras', NULL, 749, 'Pulseras varias.', '2024-11-10 13:11:44', '2024-11-10 13:22:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'El rey del sahumerio', '2024-11-10 13:11:44', '2024-11-10 13:12:18'),
(2, 'Aromatizar Mayorista', '2024-11-10 13:11:44', '2024-11-10 13:12:40'),
(3, 'Grupo Utopía', '2024-11-10 13:11:44', '2024-11-10 13:12:59'),
(4, 'El Bazar Del Sahumerio', '2024-11-10 13:11:44', '2024-11-10 13:13:18'),
(5, 'Proveedor de prueba', '2024-11-10 18:31:29', '2024-11-10 18:31:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiendas`
--

DROP TABLE IF EXISTS `tiendas`;
CREATE TABLE IF NOT EXISTS `tiendas` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion_calle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion_numero` int NOT NULL,
  `localidad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departamento` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tiendas`
--

INSERT INTO `tiendas` (`id`, `nombre`, `telefono`, `email`, `direccion_calle`, `direccion_numero`, `localidad`, `departamento`, `created_at`, `updated_at`) VALUES
(1, 'Powlowski, Crooks and Zieme', '882456', 'jdickinson@yahoo.com', 'Hane Springs', 8480, 'Marcomouth', 'Virginia', '2024-11-10 13:11:44', '2024-11-10 13:11:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `abrio_caja` tinyint NOT NULL DEFAULT '0',
  `paginado` tinyint NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `abrio_caja`, `paginado`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Santiago', 'santimartinez944@gmail.com', '2024-11-10 13:11:44', 1, 5, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'n6k8KpjmWGpqLsKfSBVmTIPhP1Rk9UuN5Wb69RfdIN4Y1PV5ozOjH2yfAlu5', '2024-11-10 13:11:44', '2024-11-12 22:53:16'),
(2, 'Dean', 'deanrecaldekok@gmail.com', NULL, 0, 1, '$2y$10$F5K1CSViLNZ5amZsYV8Zau/3rTFvm8KnYDSq16iwDOjzJ6QQh9.Te', NULL, '2024-11-10 18:13:21', '2024-11-10 18:29:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `caja_id` int NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_detalles`
--

DROP TABLE IF EXISTS `venta_detalles`;
CREATE TABLE IF NOT EXISTS `venta_detalles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `venta_id` int NOT NULL,
  `compra_detalle_id` int NOT NULL,
  `cliente_id` int NOT NULL,
  `metodo_pago_id` int NOT NULL,
  `marca_id` int NOT NULL,
  `proveedor_id` int NOT NULL,
  `producto_id` int NOT NULL,
  `aroma_id` int NOT NULL,
  `precio_venta` double NOT NULL,
  `cantidad` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_pagos`
--

DROP TABLE IF EXISTS `venta_pagos`;
CREATE TABLE IF NOT EXISTS `venta_pagos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `venta_id` int NOT NULL,
  `metodo_pago_id` int NOT NULL,
  `monto` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
