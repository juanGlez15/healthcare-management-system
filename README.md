# Healthcare Management System

Un sistema de gestión de salud construido con Laravel que permite la administración de doctores y pacientes con autenticación segura.

## 🚀 Características

- **Autenticación de usuarios** con Laravel Sanctum
- **Gestión de doctores** con perfiles especializados  
- **Gestión de pacientes** con información médica
- **API REST** completa y documentada
- **Base de datos SQLite** para desarrollo
- **Middleware de autenticación** personalizado

## 📋 Requisitos

- PHP >= 8.1
- Composer
- Node.js & NPM
- SQLite (para desarrollo)

## 🔧 Instalación

1. **Clona el repositorio**
   ```bash
   git clone https://github.com/juanGlez15/healthcare-management-system.git
   cd healthcare-management-system
   ```

2. **Instala las dependencias de PHP**
   ```bash
   composer install
   ```

3. **Copia el archivo de configuración**
   ```bash
   cp .env.example .env
   ```

4. **Genera la clave de aplicación**
   ```bash
   php artisan key:generate
   ```

5. **Ejecuta las migraciones y seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Inicia el servidor de desarrollo**
   ```bash
   php artisan serve
   ```

## 📚 API Endpoints

### Autenticación
- `POST /api/register` - Registrar nuevo usuario
- `POST /api/login` - Iniciar sesión
- `POST /api/logout` - Cerrar sesión

### Doctores
- `GET /api/doctors` - Listar doctores
- `GET /api/doctors/{id}` - Obtener doctor específico
- `POST /api/doctors` - Crear doctor
- `PUT /api/doctors/{id}` - Actualizar doctor
- `DELETE /api/doctors/{id}` - Eliminar doctor

Para más detalles, consulta el archivo `API_DOCUMENTATION.md`.

## 🗃️ Base de Datos

El sistema incluye las siguientes tablas principales:

- **users** - Usuarios del sistema
- **user_types** - Tipos de usuario (doctor/patient)
- **doctor_profiles** - Perfiles de doctores
- **patient_profiles** - Perfiles de pacientes

## 🛠️ Tecnologías Utilizadas

- **Laravel 11** - Framework PHP
- **Laravel Sanctum** - Autenticación API
- **SQLite** - Base de datos
- **PHP 8.1+** - Lenguaje de programación

## 👨‍💻 Desarrollo

Para contribuir al proyecto:

1. Fork el repositorio
2. Crea una nueva rama (`git checkout -b feature/nueva-caracteristica`)
3. Realiza tus cambios
4. Haz commit (`git commit -am 'Agrega nueva característica'`)
5. Push a la rama (`git push origin feature/nueva-caracteristica`)
6. Crea un Pull Request

## 📞 Contacto

- Desarrollador: Juan González
- Email: juanemiav1509@gmail.com
- GitHub: [@juanGlez15](https://github.com/juanGlez15)

---

⭐ ¡Dale una estrella al proyecto si te ha sido útil!

## Acerca de Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
