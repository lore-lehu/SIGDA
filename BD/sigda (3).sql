-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-10-2024 a las 04:15:27
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
-- Base de datos: `sigda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

DROP TABLE IF EXISTS `archivos`;
CREATE TABLE IF NOT EXISTS `archivos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idproyecto` int(11) NOT NULL,
  `codigo` varchar(12) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `activo` varchar(2) DEFAULT NULL,
  `uc` varchar(30) DEFAULT NULL,
  `fc` datetime DEFAULT NULL,
  `um` varchar(30) DEFAULT NULL,
  `fm` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`id`, `idproyecto`, `codigo`, `nombre`, `activo`, `uc`, `fc`, `um`, `fm`) VALUES
(2, 2, 'DOCMB001', 'ARCHIVO MI BANCO 1', 'Si', 'maicolm', '2018-09-17 18:07:25', 'maicolm', '2024-10-18 11:43:16'),
(3, 2, 'DOCMB002', 'ARCHIVO MI BANCO 2', 'Si', 'gmedina', '2018-09-17 18:11:06', 'maicolm', '2024-10-18 11:43:32'),
(61, 60, 'PRU2001', 'ABCDE', 'Si', 'maicolm', '2024-10-18 14:40:57', NULL, NULL),
(62, 60, 'PRU2002', 'AAA MM PP', 'No', 'maicolm', '2024-10-18 14:41:20', NULL, NULL),
(63, 3, 'ITSI001', 'Archivo 1', 'Si', 'maicolm', '2024-10-18 14:44:47', NULL, NULL),
(64, 3, 'ITSI002', 'Archivo 2', 'Si', 'maicolm', '2024-10-18 14:47:42', NULL, NULL),
(65, 3, 'ITSI003', 'Archivo 3', 'No', 'maicolm', '2024-10-18 14:47:56', NULL, NULL),
(72, 62, 'AW10', 'CICLO 2', 'Si', 'maicolm', '2024-10-18 16:40:20', NULL, NULL),
(67, 2, 'DOCMB002', 'Prueba Mibanco abc', 'Si', 'maicolm', '2024-10-18 15:04:39', 'maicolm', '2024-10-21 11:50:44'),
(71, 62, 'AS001', 'CICLO 1 WA', 'Si', 'maicolm', '2024-10-18 16:40:09', 'maicolm', '2024-10-18 16:40:43'),
(69, 4, 'PAC02', 'PRUEBA PACIFICO', 'Si', 'maicolm', '2024-10-18 15:19:08', 'maicolm', '2024-10-18 15:27:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

DROP TABLE IF EXISTS `documentos`;
CREATE TABLE IF NOT EXISTS `documentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idproyecto` int(11) NOT NULL,
  `idarchivo` int(12) NOT NULL,
  `contenido` text,
  `uc` varchar(30) DEFAULT NULL,
  `fc` datetime DEFAULT NULL,
  `um` varchar(30) DEFAULT NULL,
  `fm` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id`, `idproyecto`, `idarchivo`, `contenido`, `uc`, `fc`, `um`, `fm`) VALUES
(1, 3, 65, 'Esto es una prueba...123456\n\nDOCUMENTO 1, 2, 3\n\nPrueba final - remoto', 'maicolm', '2024-10-18 23:19:15', 'maicolm', '2024-10-19 09:01:29'),
(11, 2, 67, 'Frase 1\n\nEl vídeo proporciona una manera eficaz para ayudarle a demostrar el punto. Cuando haga clic en Vídeo en línea, puede pegar el código para insertar del vídeo que desea agregar. También puede escribir una palabra clave para buscar en línea el vídeo que mejor se adapte a su documento.Para otorgar a su documento un aspecto profesional, Word proporciona encabezados, pies de página, páginas de portada y diseños de cuadro de texto que se complementan entre sí. Por ejemplo, puede agregar una portada coincidente, el encabezado y la barra lateral.\n\nFrase 2\n\nHaga clic en Insertar y elija los elementos que desee de las distintas galerías.Los temas y estilos también ayudan a mantener su documento coordinado. Cuando haga clic en Diseño y seleccione un tema nuevo, cambiarán las imágenes, gráficos y gráficos SmartArt para que coincidan con el nuevo tema. Al aplicar los estilos, los títulos cambian para coincidir con el nuevo tema. Ahorre tiempo en Word con nuevos botones que se muestran donde se necesiten.\n\nFrase 3\n\nPara cambiar la forma en que se ajusta una imagen en el documento, haga clic y aparecerá un botón de opciones de diseño junto a la imagen. Cuando trabaje en una tabla, haga clic donde desee agregar una fila o columna y, a continuación, haga clic en el signo más.La lectura es más fácil, también, en la nueva vista de lectura. Puede contraer partes del documento y centrarse en el texto que desee. Si necesita detener la lectura antes de llegar al final, Word le recordará dónde dejó la lectura, incluso en otros dispositivos.\n', 'maicolm', '2024-10-21 11:51:42', 'maicolm', '2024-10-22 14:13:13'),
(12, 2, 3, 'ESTE ES UN TEXTO DE PRUEBA - MIERCOLES\n\nEste es el contenido del documento\nbla bla bla\n\nSALUDOS\n\nUPN 2024-2', 'maicolm', '2024-10-23 10:05:53', 'maicolm', '2024-10-23 14:18:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

DROP TABLE IF EXISTS `historial`;
CREATE TABLE IF NOT EXISTS `historial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idproyecto` int(11) NOT NULL,
  `idarchivo` int(11) NOT NULL,
  `accion` varchar(200) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `fc` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `idproyecto`, `idarchivo`, `accion`, `usuario`, `fc`) VALUES
(1, 3, 65, 'Archivo editado', 'maicolm', '2024-10-19 00:09:22'),
(2, 3, 65, 'Archivo editado', 'maicolm', '2024-10-19 00:09:41'),
(3, 3, 65, 'Archivo editado', 'maicolm', '2024-10-19 00:18:41'),
(4, 3, 65, 'Archivo editado', 'maicolm', '2024-10-19 09:01:29'),
(5, 2, 67, 'Archivo editado', 'maicolm', '2024-10-21 11:52:24'),
(6, 2, 67, 'Archivo editado', 'maicolm', '2024-10-21 11:52:50'),
(7, 2, 67, 'Archivo editado', 'maicolm', '2024-10-22 14:13:13'),
(8, 2, 3, 'Archivo editado', 'maicolm', '2024-10-23 10:04:13'),
(9, 2, 3, 'Archivo editado', 'maicolm', '2024-10-23 10:06:12'),
(10, 2, 3, 'Imagen cargada', '', '2024-10-23 11:03:36'),
(11, 2, 3, 'Imagen cargada', 'maicolm', '2024-10-23 11:04:28'),
(12, 2, 3, 'Imagen cargada', 'maicolm', '2024-10-23 11:10:35'),
(13, 2, 3, 'Imagen cargada', 'maicolm', '2024-10-23 11:17:41'),
(14, 2, 3, 'Imagen 3_imagen_2.jpg eliminada', 'maicolm', '2024-10-23 11:21:31'),
(15, 2, 3, 'Imagen cargada', 'maicolm', '2024-10-23 11:22:34'),
(16, 2, 3, 'El archivo 3_imagen_5.jpg fue eliminado', 'maicolm', '2024-10-23 11:22:39'),
(17, 2, 3, 'El archivo 3_imagen_4.jpg fue eliminado', 'maicolm', '2024-10-23 11:23:20'),
(18, 2, 3, 'Archivo editado', 'maicolm', '2024-10-23 14:18:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

DROP TABLE IF EXISTS `proyectos`;
CREATE TABLE IF NOT EXISTS `proyectos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(12) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `activo` varchar(2) DEFAULT NULL,
  `uc` varchar(30) DEFAULT NULL,
  `fc` datetime DEFAULT NULL,
  `um` varchar(30) DEFAULT NULL,
  `fm` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `codigo`, `nombre`, `activo`, `uc`, `fc`, `um`, `fm`) VALUES
(1, 'PR001', 'PRUEBA 1', 'No', 'maicolm', '2018-09-17 18:07:03', 'maicolm', '2024-10-18 11:43:46'),
(2, 'MB001', 'MI BANCO los olivos', 'Si', 'maicolm', '2018-09-17 18:07:25', 'maicolm', '2024-10-21 11:49:49'),
(3, 'IT001', 'INTERBANK SAN ISIDRIO', 'Si', 'gmedina', '2018-09-17 18:11:06', 'mzamora', '2024-10-23 23:10:24'),
(4, 'PA001', 'PACÍFICO SEDE PRINCIPAL', 'Si', 'gmedina', '2018-09-17 18:11:29', 'maicolm', '2024-10-18 14:43:45'),
(62, '1212', 'UPN 2024-2', 'Si', 'maicolm', '2024-10-18 16:39:16', 'maicolm', '2024-10-18 16:39:28'),
(60, 'PR002', 'PRUEBA 2', 'No', 'maicolm', '2024-10-18 11:44:29', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

DROP TABLE IF EXISTS `sedes`;
CREATE TABLE IF NOT EXISTS `sedes` (
  `ids` varchar(255) NOT NULL,
  `nombresede` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `coordinador` varchar(255) DEFAULT NULL,
  `nivel` varchar(255) DEFAULT NULL,
  `minparticipantes` varchar(255) DEFAULT NULL,
  `metaanual` varchar(255) DEFAULT NULL,
  `metamensual` varchar(255) DEFAULT NULL,
  `metadiaria` varchar(255) DEFAULT NULL,
  `um` varchar(255) DEFAULT NULL,
  `fm` varchar(255) DEFAULT NULL,
  `FOCP` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `telfijo` varchar(255) DEFAULT NULL,
  `telmovil` varchar(255) DEFAULT NULL,
  `comentario` varchar(255) DEFAULT NULL,
  `uc` varchar(255) DEFAULT NULL,
  `fc` varchar(255) DEFAULT NULL,
  `idz` varchar(255) DEFAULT NULL,
  `responsable` varchar(255) DEFAULT NULL,
  `centro` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ids`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`ids`, `nombresede`, `estado`, `coordinador`, `nivel`, `minparticipantes`, `metaanual`, `metamensual`, `metadiaria`, `um`, `fm`, `FOCP`, `correo`, `telfijo`, `telmovil`, `comentario`, `uc`, `fc`, `idz`, `responsable`, `centro`) VALUES
('1', 'Lima Norte', '1', '', '2', '', '', '', '', '', '15/4/2013 11:03:03', '', '', '', '', NULL, NULL, NULL, '', '', ''),
('2', 'Surquillo', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('3', 'Centro de Lima', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('4', 'Chimbote', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuario` varchar(15) NOT NULL,
  `nombrecompletor` varchar(50) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `clave` varchar(15) NOT NULL,
  `nivel` int(11) NOT NULL,
  `fechagrab` datetime NOT NULL,
  `usuariograb` varchar(30) NOT NULL,
  `idsede` varchar(3) DEFAULT NULL,
  `fechanac` datetime DEFAULT NULL,
  `estado` char(1) NOT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `um` varchar(15) DEFAULT NULL,
  `fm` datetime DEFAULT NULL,
  `nivelcall` char(1) DEFAULT NULL,
  `centro` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombrecompletor`, `usuario`, `clave`, `nivel`, `fechagrab`, `usuariograb`, `idsede`, `fechanac`, `estado`, `cargo`, `um`, `fm`, `nivelcall`, `centro`) VALUES
('10000001', 'Maicolm Rivera Zamudio', 'maicolm', '123456', 3, '2024-10-22 09:41:23', 'ccarrasco', '1', NULL, '1', 'Administrador', 'maicolm', '2024-10-23 14:44:42', NULL, NULL),
('10000002', 'CATALINA CARRASCO', 'ccarrasco', 'ccarrasco', 3, '2018-08-10 18:08:23', 'maicolm', '1', NULL, '1', 'Administrador', 'maicolm', '2024-10-18 11:49:23', NULL, NULL),
('10000003', 'LORENNA LEÓN', 'lleon', 'lleon', 3, '2023-03-23 11:18:00', 'maicolm', '66', NULL, '1', 'Administrador', 'ccarrasco', '2024-10-21 12:06:59', NULL, NULL),
('10000004', 'MARIANA ZAMORA RIOS', 'mzamora', 'mzamora', 2, '2023-03-24 14:30:49', 'maicolm', '06', NULL, '0', 'Operador', 'maicolm', '2024-10-18 11:50:55', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
