![alt text](img/assets/logo.png)

# Gym Management System

Este proyecto es una aplicación PHP diseñada para gestionar las operaciones de un gimnasio, permitiendo la gestión de usuarios con roles de administrador y usuario estándar.

## Características

- **Registro y Autenticación de Usuarios**: Los usuarios pueden registrarse y autenticarse con roles de administrador y usuario.
- **Roles de Usuario**:
  - **Admin**: Tiene acceso a la gestión de socios y la configuración de citas.
  - **User**: Puede acceder a los servicios y reservar citas.
- **Gestión de Socios**: Los administradores pueden gestionar y visualizar los detalles de los socios.
- **Gestión de Citas**: Los usuarios pueden programar y administrar citas.
- **Visualización de Servicios, Noticias y Testimonios**: Información disponible tanto para usuarios como para visitantes.

## Demo

Puedes ver una demo en vivo de la aplicación aquí: [Gym Management System Demo](https://gsanchezcalvente.000.pe/)

**Credenciales de la demo**:
- **Usuario estándar**: 
  - **Usuario**: `user`
  - **Contraseña**: `user`
- **Administrador**: 
  - **Usuario**: `admin`
  - **Contraseña**: `admin`


## Archivos Principales

- **index.php**: Página de inicio que muestra información general sobre el gimnasio.
- **citas.php**: Sección para gestionar y programar citas.
- **noticias.php**: Sección para ver las últimas noticias y actualizaciones.
- **testimonios.php**: Sección para ver los testimonios de clientes.
- **servicios.php**: Sección para ver los servicios disponibles.
- **login.php**: Página de inicio de sesión.
- **socios.php**: Sección para gestionar los socios.
   
## Instalación y Configuración

1. **Requisitos**:
   - Servidor web (Apache o similar).
   - PHP 7.4 o superior.
   - Base de datos MySQL.

2. **Configuración**:
   - Clona este repositorio en tu servidor local o de producción.
   - Configura la conexión a la base de datos en el archivo `config.php`.
   - Importa el esquema de la base de datos desde el archivo `database.sql` (si se proporciona).

3. **Iniciar la Aplicación**:
   - Asegúrate de que tu servidor web esté ejecutándose.
   - Accede a `http://localhost/tu-proyecto` en tu navegador.

## Uso

- **Navegación**: El menú de navegación incluye enlaces a las secciones principales como Home, Servicios, Testimonios, Noticias y Citas.
- **Acceso de Administrador**: Si el usuario es un administrador, tendrá acceso a funcionalidades adicionales, como la gestión de socios.
- **Cerrar Sesión**: Los usuarios pueden cerrar sesión de manera segura usando el enlace de cierre de sesión.


## Capturas de Pantalla

![alt text](img/assets/github(2).png)
![alt text](img/assets/github.png)

## Créditos

- Desarrollado por: _Gonzalo Sanchez Calvente_

## Licencia

Este proyecto está licenciado bajo la [MIT License](LICENSE).
