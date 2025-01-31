DROP DATABASE IF EXISTS Club;
CREATE DATABASE Club;
USE Club;

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `codigo_socio` int(11) DEFAULT NULL,
  `codigo_servicio` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `codigo_socio`, `codigo_servicio`, `fecha`, `hora`) VALUES
(1, 2, 1, '2024-11-05', '10:00:00'),
(2, 3, 2, '2024-11-06', '15:00:00'),
(3, 3, 3, '2024-11-07', '12:30:00'),
(4, 2, 3, '2024-11-08', '14:00:00'),
(5, 2, 1, '2025-01-31', '15:38:00'),
(6, 2, 2, '2025-01-31', '16:02:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id_noticia` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `contenido` text NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `fecha_publicacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id_noticia`, `titulo`, `contenido`, `imagen`, `fecha_publicacion`) VALUES
(1, 'Nuevo ring de boxeo', 'Hemos instalado un nuevo ring de boxeo con las mejores condiciones para que nuestros socios puedan entrenar y competir al máximo nivel. El área está equipada con todas las medidas de seguridad y los mejores materiales para brindar una experiencia profesional. Ven y pruébalo con la ayuda de nuestros entrenadores certificados.', '/img/noticias/1.jpeg', '2024-10-20'),
(2, 'Clases de defensa personal', 'A partir del próximo mes, ofreceremos clases de defensa personal para todos los niveles. Aprenderás técnicas esenciales para protegerte y sentirte seguro. Las clases están diseñadas para mejorar tu confianza y reflejos, y serán impartidas por entrenadores experimentados en artes marciales y boxeo.', '/img/noticias/2.jpeg', '2024-11-02'),
(3, 'Horario de entrenamiento de verano', 'A partir del mes de junio, el club de boxeo adoptará un horario extendido de verano, abriendo desde las 6:00 am hasta las 11:00 pm de lunes a viernes, y de 8:00 am a 9:00 pm los fines de semana. Podrás aprovechar sesiones al aire libre para disfrutar del clima y mejorar tus habilidades de boxeo.', '/img/noticias/3.jpeg', '2024-05-01'),
(4, 'Entrenamiento de alta intensidad', 'Hemos incorporado nuevas rutinas de entrenamiento de alta intensidad, diseñadas para mejorar tu resistencia y velocidad en el ring. Con circuitos que incluyen ejercicios funcionales y trabajo con sacos pesados, estos entrenamientos son ideales para boxeadores que quieren llevar su físico al siguiente nivel.', '/img/noticias/4.jpeg', '2024-11-05'),
(5, 'Taller de nutrición deportiva', 'Anunciamos un taller de nutrición deportiva donde aprenderás cómo optimizar tu dieta para el rendimiento en el boxeo. Descubre cómo los alimentos adecuados pueden mejorar tu recuperación y fuerza. Los participantes recibirán planes de nutrición personalizados.', '/img/noticias/5.jpeg', '2024-11-12'),
(6, 'Torneo de resistencia y fuerza', 'Prepárate para nuestro primer torneo de resistencia y fuerza. Los competidores demostrarán su capacidad física en una serie de pruebas que incluyen rounds de sparring, golpes al saco y ejercicios de alta intensidad. Habrá premios especiales para los ganadores. Inscripciones abiertas en la recepción.', '/img/noticias/6.jpeg', '2024-12-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `imagen`) VALUES
(1, 'Proteinas 500G', 10.99, '1.jpg'),
(3, 'Anabolizantes', 60.99, '3.jpg'),
(4, 'Suplemento Pre-Workout 500G', 29.99, '4.jpg'),
(5, 'Bebida energetica', 4.99, '5.jpg'),
(8, 'Cafe colombiano', 9.99, '679a229a3efc3.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `codigo_servicio` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `duracion` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`codigo_servicio`, `descripcion`, `duracion`, `precio`) VALUES
(1, 'Entrenamiento de boxeo personal', 60, 50.00),
(2, 'Clases grupales de boxeo', 45, 30.00),
(3, 'Sesión de recuperación muscular', 30, 40.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

-- CREATE TABLE `socios` (
--   `id_socio` int(11) NOT NULL,
--   `nombre` varchar(100) NOT NULL,
--   `edad` int(11) DEFAULT NULL,
--   `contraseña` varchar(255) NOT NULL,
--   `usuario` varchar(50) NOT NULL,
--   `telefono` varchar(15) DEFAULT NULL,
--   `foto` varchar(255) DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `socios`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testimonios`
--

CREATE TABLE `testimonios` (
  `id_testimonio` int(11) NOT NULL,
  `autor` int(11) DEFAULT NULL,
  `contenido` text NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `testimonios`
--

INSERT INTO `testimonios` (`id_testimonio`, `autor`, `contenido`, `fecha`) VALUES
(1, 1, 'El mejor lugar para entrenar y aprender boxeo.', '2024-11-01'),
(2, 2, 'Las clases grupales son intensas y muy motivadoras.', '2024-10-25'),
(3, 3, 'La recuperación muscular me ayuda a mantenerme en forma para los combates.', '2024-10-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','socio','cliente') DEFAULT 'cliente',
  `foto` varchar(255) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `api_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `username`, `password`, `rol`,`foto`,`edad`, `email`, `api_key`) VALUES
(1, 'Administrador', 'admin', '$2y$10$YN16uMd1YnUYTlQB2sng9ui7jegJA6f6yUR88b0yMflJ/lmfnw1vW', 'admin','/img/usuarios/1.jpeg',24, 'admin@clubboxeo.com', 't7q7er9ye1F9OT2tKAcb38yewWoluINX'),
(2, 'Carlos Márquez', 'carlos', '$2y$10$7JYyre8/IG.Ij/XduMixlud2cw.kTHZVsy4fjav84IN8gdDm1FI8a', 'socio','/img/usuarios/2.jpeg',30, 'carlos@clubboxeo.com', '8wBYB7WcihyaB8c6gCR91Z876FUSxqXT'),
(3, 'José Rivera', 'jose', '$2y$10$7JYyre8/IG.Ij/XduMixlud2cw.kTHZVsy4fjav84IN8gdDm1FI8a', 'socio','/img/usuarios/3.jpeg',25, 'jose@clubboxeo.com', '8wBYB7WcihyaB8c6gCR91Z876FUSxqXT'),
(4, 'Miguel Santos', 'miguel', '$2y$10$7JYyre8/IG.Ij/XduMixlud2cw.kTHZVsy4fjav84IN8gdDm1FI8a', 'socio','/img/usuarios/4.jpeg',28, 'miguel@clubboxeo.com', '8wBYB7WcihyaB8c6gCR91Z876FUSxqXT');


-- INSERT INTO `socios` (`id_socio`, `nombre`, `edad`, `contraseña`, `usuario`, `telefono`, `foto`) VALUES
-- (1, 'Carlos Márquez', 30, 'golpefuerte123', 'cmarquez', '+34612345678', '/img/usuarios/1.jpeg'),
-- (2, 'José Rivera', 25, 'puñopoderoso456', 'jrivera', '+34622345678', '/img/usuarios/2.jpeg'),
-- (3, 'Miguel Santos', 28, 'boxeador789', 'msantos', '+34632345678', '/img/usuarios/3.jpeg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codigo_socio` (`codigo_socio`),
  ADD KEY `codigo_servicio` (`codigo_servicio`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id_noticia`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`codigo_servicio`);

--
-- Indices de la tabla `socios`
--
-- ALTER TABLE `socios`
--   ADD PRIMARY KEY (`id_socio`),
--   ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `testimonios`
--
ALTER TABLE `testimonios`
  ADD PRIMARY KEY (`id_testimonio`),
  ADD KEY `autor` (`autor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `codigo_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- --
-- -- AUTO_INCREMENT de la tabla `socios`
-- --
-- ALTER TABLE `socios`
--   MODIFY `id_socio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `testimonios`
--
ALTER TABLE `testimonios`
  MODIFY `id_testimonio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`codigo_socio`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`codigo_servicio`) REFERENCES `servicios` (`codigo_servicio`);

--
-- Filtros para la tabla `testimonios`
--
ALTER TABLE `testimonios`
  ADD CONSTRAINT `testimonios_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;



