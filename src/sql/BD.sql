DROP DATABASE IF EXISTS Club;
CREATE DATABASE Club;
USE Club;

-- Tabla de usuarios
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'user') DEFAULT 'user',
    email VARCHAR(100) NOT NULL
);


-- Tabla socio
CREATE TABLE socios (
    id_socio INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    edad INT,
    contraseña VARCHAR(255) NOT NULL,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    telefono VARCHAR(15),
    foto VARCHAR(255)
);

-- Tabla servicio
CREATE TABLE servicios (
    codigo_servicio INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(255) NOT NULL,
    duracion INT NOT NULL,
    precio DECIMAL(10, 2) NOT NULL
);

-- Tabla testimonio con ON DELETE CASCADE
CREATE TABLE testimonios (
    id_testimonio INT AUTO_INCREMENT PRIMARY KEY,
    autor INT,
    contenido TEXT NOT NULL,
    fecha DATE,
    FOREIGN KEY (autor) REFERENCES socios(id_socio) ON DELETE CASCADE
);

-- Tabla noticia
CREATE TABLE noticias (
    id_noticia INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    contenido TEXT NOT NULL,
    imagen VARCHAR(255),
    fecha_publicacion DATE
);

-- Tabla citas con ON DELETE CASCADE
CREATE TABLE citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_socio INT,
    codigo_servicio INT,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    FOREIGN KEY (codigo_socio) REFERENCES socios(id_socio) ON DELETE CASCADE,
    FOREIGN KEY (codigo_servicio) REFERENCES servicios(codigo_servicio)
);
-- Insertar un usuario administrador
INSERT INTO usuarios (nombre, username, password, rol, email)
VALUES ('Administrador', 'admin', 'admin', 'admin', 'admin@clubboxeo.com');

-- Insertar un usuario user
INSERT INTO usuarios (nombre, username, password, rol, email)
VALUES ('User', 'user', 'user', 'user', 'user@clubboxeo.com');

-- Insertar datos en la tabla socios
INSERT INTO socios (nombre, edad, contraseña, usuario, telefono, foto)
VALUES 
('Carlos Márquez', 30, 'golpefuerte123', 'cmarquez', '+34612345678', '/img/usuarios/1.jpeg'),
('José Rivera', 25, 'puñopoderoso456', 'jrivera', '+34622345678', '/img/usuarios/2.jpeg'),
('Miguel Santos', 28, 'boxeador789', 'msantos', '+34 632345678', '/img/usuarios/3.jpeg');

-- Insertar datos en la tabla servicios
INSERT INTO servicios (descripcion, duracion, precio)
VALUES 
('Entrenamiento de boxeo personal', 60, 50.00),
('Clases grupales de boxeo', 45, 30.00),
('Sesión de recuperación muscular', 30, 40.00);

-- Insertar datos en la tabla testimonios
INSERT INTO testimonios (autor, contenido, fecha)
VALUES 
(1, 'El mejor lugar para entrenar y aprender boxeo.', '2024-11-01'),
(2, 'Las clases grupales son intensas y muy motivadoras.', '2024-10-25'),
(3, 'La recuperación muscular me ayuda a mantenerme en forma para los combates.', '2024-10-15');

-- Insertar datos en la tabla noticias
INSERT INTO noticias (titulo, contenido, imagen, fecha_publicacion)
VALUES 
('Nuevo ring de boxeo', 
'Hemos instalado un nuevo ring de boxeo con las mejores condiciones para que nuestros socios puedan entrenar y competir al máximo nivel. El área está equipada con todas las medidas de seguridad y los mejores materiales para brindar una experiencia profesional. Ven y pruébalo con la ayuda de nuestros entrenadores certificados.', 
'/img/noticias/1.jpeg', 
'2024-10-20'),

('Clases de defensa personal', 
'A partir del próximo mes, ofreceremos clases de defensa personal para todos los niveles. Aprenderás técnicas esenciales para protegerte y sentirte seguro. Las clases están diseñadas para mejorar tu confianza y reflejos, y serán impartidas por entrenadores experimentados en artes marciales y boxeo.', 
'/img/noticias/2.jpeg', 
'2024-11-02'),

('Horario de entrenamiento de verano', 
'A partir del mes de junio, el club de boxeo adoptará un horario extendido de verano, abriendo desde las 6:00 am hasta las 11:00 pm de lunes a viernes, y de 8:00 am a 9:00 pm los fines de semana. Podrás aprovechar sesiones al aire libre para disfrutar del clima y mejorar tus habilidades de boxeo.', 
'/img/noticias/3.jpeg', 
'2024-05-01'),

('Entrenamiento de alta intensidad', 
'Hemos incorporado nuevas rutinas de entrenamiento de alta intensidad, diseñadas para mejorar tu resistencia y velocidad en el ring. Con circuitos que incluyen ejercicios funcionales y trabajo con sacos pesados, estos entrenamientos son ideales para boxeadores que quieren llevar su físico al siguiente nivel.', 
'/img/noticias/4.jpeg', 
'2024-11-05'),

('Taller de nutrición deportiva', 
'Anunciamos un taller de nutrición deportiva donde aprenderás cómo optimizar tu dieta para el rendimiento en el boxeo. Descubre cómo los alimentos adecuados pueden mejorar tu recuperación y fuerza. Los participantes recibirán planes de nutrición personalizados.', 
'/img/noticias/5.jpeg', 
'2024-11-12'),

('Torneo de resistencia y fuerza', 
'Prepárate para nuestro primer torneo de resistencia y fuerza. Los competidores demostrarán su capacidad física en una serie de pruebas que incluyen rounds de sparring, golpes al saco y ejercicios de alta intensidad. Habrá premios especiales para los ganadores. Inscripciones abiertas en la recepción.', 
'/img/noticias/6.jpeg', 
'2024-12-01');

-- Insertar datos en la tabla citas
INSERT INTO citas (codigo_socio, codigo_servicio, fecha, hora)
VALUES 
(1, 1, '2024-11-05', '10:00:00'),
(2, 2, '2024-11-06', '15:00:00'),
(3, 3, '2024-11-07', '12:30:00'),
(1, 3, '2024-11-08', '14:00:00');
