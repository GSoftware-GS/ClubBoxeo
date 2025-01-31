<p align="center">
  <img src="img/assets/logo.png" alt="Logo" width="200">
</p>

# Gym Management System

Este proyecto es una aplicación PHP diseñada para gestionar las operaciones de un gimnasio, permitiendo la gestión de usuarios con roles de administrador y usuario estándar.

## Características

- **Registro y Autenticación de Usuarios**: Los usuarios pueden registrarse y autenticarse con roles de administrador y usuario.
- **Roles de Usuario**:
  - **Admin**: Tiene acceso a la gestión de socios y la configuración de citas.
  - **User**: Puede acceder a los servicios y reservar citas.
- **Gestión de Socios**: Los administradores pueden gestionar y visualizar los detalles de los socios.
- **Gestión de Citas**: Los usuarios pueden programar y administrar citas.
- **Gestión de Productos y Servicios**: Administración de productos disponibles en el gimnasio.
- **Noticias y Testimonios**: Sección para mostrar las últimas noticias y testimonios de clientes.

## Demo

Puedes ver una demo en vivo de la aplicación aquí: [Gym Management System Demo](https://gsanchezcalvente.000.pe/)

**Credenciales de la demo**:
- **Usuario Socio**: 
  - **Usuario**: `carlos`
  - **Contraseña**: `user`
- **Administrador**: 
  - **Usuario**: `admin`
  - **Contraseña**: `admin`

## Estructura del Proyecto

```
└── gsoftware-gs-clubboxeo/
    ├── README.md
    ├── index.php
    ├── login.php
    ├── logout.php
    ├── citas.php
    ├── socios.php
    ├── productos.php
    ├── servicios.php
    ├── noticias.php
    ├── testimonios.php
    ├── ajustes.php
    ├── api.php
    ├── noAccess.php
    ├── noticiasMundiales.php
    ├── src/
    │   ├── forms/
    │   ├── html/
    │   ├── includes/
    │   ├── js/
    │   ├── php/
    │   ├── sql/
    ├── styles/
```

## Instalación y Configuración

1. **Requisitos**:
   - Servidor web (Apache o similar).
   - PHP 7.4 o superior.
   - Base de datos MySQL.

2. **Configuración**:
   - Clona este repositorio en tu servidor local o de producción.
   - Configura la conexión a la base de datos en `src/php/conexion.php`.
   - Importa el esquema de la base de datos desde `src/sql/club.sql`.

3. **Iniciar la Aplicación**:
   - Asegúrate de que tu servidor web esté ejecutándose.
   - Accede a `http://localhost/tu-proyecto` en tu navegador.

## Uso

- **Navegación**: El menú de navegación incluye enlaces a las secciones principales como Home, Servicios, Testimonios, Noticias y Citas.
- **Acceso de Administrador**: Si el usuario es un administrador, tendrá acceso a funcionalidades adicionales, como la gestión de socios y productos.
- **Cerrar Sesión**: Los usuarios pueden cerrar sesión de manera segura usando el enlace de cierre de sesión.

## Capturas de Pantalla

<p align="center">
  <img src="img/assets/github(2).png" alt="Captura 1">
</p>

<p align="center">
  <img src="img/assets/github.png" alt="Captura 2">
</p>

## Créditos

- Desarrollado por: _Gonzalo Sánchez Calvente_

## Licencia

Este proyecto está licenciado bajo la [MIT License](LICENSE).