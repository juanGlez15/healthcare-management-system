# 📋 API de Sistema de Salud - Documentación

## 📌 Información General

- **Base URL**: `http://127.0.0.1:8000/api`
- **Autenticación**: Laravel Sanctum (Bearer Token)
- **Formato de respuesta**: JSON
- **Versión**: 1.0

## 📁 Estructura de Endpoints

```
/api
├── /test                           # Endpoint de prueba
└── /med                           # Grupo principal médico
    ├── /auth                      # Autenticación
    │   ├── POST /login           # Iniciar sesión
    │   ├── POST /register        # Registrar usuario
    │   ├── POST /logout          # Cerrar sesión (protegido)
    │   └── GET /user-profile     # Perfil del usuario (protegido)
    └── /doctors                   # Gestión de doctores (protegido)
        ├── GET /                 # Listar todos los doctores
        ├── GET /{id}             # Obtener doctor específico
        └── PUT /profile          # Actualizar perfil de doctor
```

---

## 🔧 Headers Requeridos

### Para todas las peticiones:
```http
Content-Type: application/json
Accept: application/json
```

### Para rutas protegidas (adicional):
```http
Authorization: Bearer {tu_token_aquí}
```

---

## 🚀 Endpoints Públicos

### 🔍 **Test - Verificar API**

**GET** `/test`

Verifica que la API esté funcionando correctamente.

**Response:**
```json
{
  "message": "API is working!"
}
```

---

## 🔐 Autenticación

### 📝 **Registro de Usuario**

**POST** `/med/auth/register`

Registra un nuevo usuario en el sistema.

**Parámetros del body:**
| Campo | Tipo | Requerido | Descripción |
|-------|------|-----------|-------------|
| `name` | string | ✅ | Nombre completo del usuario (2-100 caracteres) |
| `email` | string | ✅ | Email único del usuario (máx. 100 caracteres) |
| `password` | string | ✅ | Contraseña (mínimo 6 caracteres) |
| `password_confirmation` | string | ✅ | Confirmación de contraseña (debe coincidir) |
| `user_type_id` | integer | ✅ | ID del tipo de usuario (1=doctor, 2=paciente) |

**Ejemplo de petición:**
```json
{
  "name": "Dr. Juan Pérez",
  "email": "juan.perez@hospital.com",
  "password": "password123",
  "password_confirmation": "password123",
  "user_type_id": 1
}
```

**Response exitosa (201):**
```json
{
  "message": "User successfully registered",
  "access_token": "1|eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
  "token_type": "Bearer",
  "user": {
    "id": 1,
    "name": "Dr. Juan Pérez",
    "email": "juan.perez@hospital.com",
    "user_type_id": 1,
    "created_at": "2025-08-25T07:00:00.000000Z",
    "updated_at": "2025-08-25T07:00:00.000000Z"
  }
}
```

**Errores posibles:**
- `400`: Error de validación
- `422`: Datos inválidos

---

### 🚪 **Iniciar Sesión**

**POST** `/med/auth/login`

Autentica un usuario y devuelve un token de acceso.

**Parámetros del body:**
| Campo | Tipo | Requerido | Descripción |
|-------|------|-----------|-------------|
| `email` | string | ✅ | Email del usuario |
| `password` | string | ✅ | Contraseña (mínimo 6 caracteres) |

**Ejemplo de petición:**
```json
{
  "email": "juan.perez@hospital.com",
  "password": "password123"
}
```

**Response exitosa (200):**
```json
{
  "access_token": "2|eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
  "token_type": "Bearer",
  "user": {
    "id": 1,
    "name": "Dr. Juan Pérez",
    "email": "juan.perez@hospital.com",
    "user_type_id": 1,
    "created_at": "2025-08-25T07:00:00.000000Z",
    "updated_at": "2025-08-25T07:00:00.000000Z",
    "user_type": {
      "id": 1,
      "name": "doctor",
      "description": "Doctor"
    }
  }
}
```

**Errores posibles:**
- `401`: Credenciales inválidas
- `422`: Error de validación

---

## 🔒 Endpoints Protegidos

> **Nota**: Todos los endpoints siguientes requieren el header `Authorization: Bearer {token}`

### 🚪 **Cerrar Sesión**

**POST** `/med/auth/logout`

Revoca todos los tokens del usuario autenticado.

**Response exitosa (200):**
```json
{
  "message": "Successfully logged out"
}
```

---

### 👤 **Perfil del Usuario**

**GET** `/med/auth/user-profile`

Obtiene la información del usuario autenticado.

**Response exitosa (200):**
```json
{
  "id": 1,
  "name": "Dr. Juan Pérez",
  "email": "juan.perez@hospital.com",
  "user_type_id": 1,
  "created_at": "2025-08-25T07:00:00.000000Z",
  "updated_at": "2025-08-25T07:00:00.000000Z",
  "user_type": {
    "id": 1,
    "name": "doctor",
    "description": "Doctor"
  }
}
```

---

## 👩‍⚕️ Gestión de Doctores

### 📋 **Listar Todos los Doctores**

**GET** `/med/doctors`

Obtiene una lista de todos los doctores registrados con sus perfiles.

**Response exitosa (200):**
```json
[
  {
    "id": 1,
    "name": "Dr. Juan Pérez",
    "email": "juan.perez@hospital.com",
    "user_type_id": 1,
    "created_at": "2025-08-25T07:00:00.000000Z",
    "updated_at": "2025-08-25T07:00:00.000000Z",
    "user_type": {
      "id": 1,
      "name": "doctor",
      "description": "Doctor"
    },
    "doctor_profile": {
      "id": 1,
      "user_id": 1,
      "specialty": "Cardiología",
      "license_number": "12345",
      "education": "Universidad Nacional",
      "experience_years": 10,
      "bio": "Especialista en cardiología con 10 años de experiencia",
      "created_at": "2025-08-25T07:00:00.000000Z",
      "updated_at": "2025-08-25T07:00:00.000000Z"
    }
  }
]
```

---

### 👨‍⚕️ **Obtener Doctor Específico**

**GET** `/med/doctors/{id}`

Obtiene la información de un doctor específico por su ID.

**Parámetros de URL:**
| Parámetro | Tipo | Descripción |
|-----------|------|-------------|
| `id` | integer | ID del doctor |

**Ejemplo:** `GET /med/doctors/1`

**Response exitosa (200):**
```json
{
  "id": 1,
  "name": "Dr. Juan Pérez",
  "email": "juan.perez@hospital.com",
  "user_type_id": 1,
  "created_at": "2025-08-25T07:00:00.000000Z",
  "updated_at": "2025-08-25T07:00:00.000000Z",
  "user_type": {
    "id": 1,
    "name": "doctor",
    "description": "Doctor"
  },
  "doctor_profile": {
    "id": 1,
    "user_id": 1,
    "specialty": "Cardiología",
    "license_number": "12345",
    "education": "Universidad Nacional",
    "experience_years": 10,
    "bio": "Especialista en cardiología con 10 años de experiencia",
    "created_at": "2025-08-25T07:00:00.000000Z",
    "updated_at": "2025-08-25T07:00:00.000000Z"
  }
}
```

**Errores posibles:**
- `404`: Doctor no encontrado

---

### ✏️ **Actualizar Perfil de Doctor**

**PUT** `/med/doctors/profile`

Actualiza el perfil profesional del doctor autenticado.

> **Nota**: Solo usuarios con `user_type = "doctor"` pueden usar este endpoint.

**Parámetros del body:**
| Campo | Tipo | Requerido | Descripción |
|-------|------|-----------|-------------|
| `specialty` | string | 🔶 | Especialidad médica |
| `license_number` | string | 🔶 | Número de licencia médica |
| `education` | string | ❌ | Formación académica |
| `experience_years` | integer | ❌ | Años de experiencia |
| `bio` | string | ❌ | Biografía profesional |

> 🔶 = Opcional, pero requerido si se incluye (sometimes|required)

**Ejemplo de petición:**
```json
{
  "specialty": "Cardiología Intervencionista",
  "license_number": "CMP-12345",
  "education": "Universidad Nacional Mayor de San Marcos - Medicina, Especialización en Cardiología",
  "experience_years": 15,
  "bio": "Cardiólogo con 15 años de experiencia especializado en procedimientos intervencionistas."
}
```

**Response exitosa (200):**
```json
{
  "message": "Doctor profile updated successfully",
  "profile": {
    "id": 1,
    "user_id": 1,
    "specialty": "Cardiología Intervencionista",
    "license_number": "CMP-12345",
    "education": "Universidad Nacional Mayor de San Marcos - Medicina, Especialización en Cardiología",
    "experience_years": 15,
    "bio": "Cardiólogo con 15 años de experiencia especializado en procedimientos intervencionistas.",
    "created_at": "2025-08-25T07:00:00.000000Z",
    "updated_at": "2025-08-25T07:00:00.000000Z"
  }
}
```

**Errores posibles:**
- `400`: Error de validación
- `403`: Usuario no es doctor

---

## 🚨 Códigos de Estado HTTP

| Código | Significado | Descripción |
|--------|-------------|-------------|
| `200` | OK | Operación exitosa |
| `201` | Created | Recurso creado exitosamente |
| `400` | Bad Request | Error de validación en los datos enviados |
| `401` | Unauthorized | Token inválido o credenciales incorrectas |
| `403` | Forbidden | Acceso denegado (permisos insuficientes) |
| `404` | Not Found | Recurso no encontrado |
| `422` | Unprocessable Entity | Error de validación específico |
| `500` | Internal Server Error | Error interno del servidor |

---

## 🔧 Ejemplos de Uso con cURL

### Registro:
```bash
curl -X POST http://127.0.0.1:8000/api/med/auth/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Dr. Ana García",
    "email": "ana.garcia@hospital.com",
    "password": "password123",
    "password_confirmation": "password123",
    "user_type_id": 1
  }'
```

### Login:
```bash
curl -X POST http://127.0.0.1:8000/api/med/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "ana.garcia@hospital.com",
    "password": "password123"
  }'
```

### Obtener perfil (con token):
```bash
curl -X GET http://127.0.0.1:8000/api/med/auth/user-profile \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer tu_token_aquí"
```

---

## 📱 Configuración para Postman/Thunder Client

### Variables de entorno recomendadas:
```
base_url: http://127.0.0.1:8000/api
token: (actualizar después del login)
```

### Collection Structure:
```
📁 API Salud
├── 📄 Test API
├── 📁 Auth
│   ├── 📄 Register
│   ├── 📄 Login
│   ├── 📄 Logout
│   └── 📄 User Profile
└── 📁 Doctors
    ├── 📄 List All Doctors
    ├── 📄 Get Doctor by ID
    └── 📄 Update Doctor Profile
```

---

## ⚠️ Notas Importantes

1. **Tokens**: Los tokens de Sanctum no expiran automáticamente, pero se revocan al hacer logout
2. **CORS**: La API está configurada para aceptar peticiones de diferentes dominios
3. **Validación**: Todos los campos son validados según las reglas especificadas
4. **Base de Datos**: Se requiere tener las migraciones ejecutadas con `php artisan migrate:fresh --seed`
5. **Tipos de Usuario**: 
   - ID 1: Doctor
   - ID 2: Paciente (para futuras implementaciones)

---

## 🔄 Flujo de Trabajo Típico

1. **Registrar usuario**: `POST /med/auth/register`
2. **Obtener token**: `POST /med/auth/login`
3. **Usar token** en todas las peticiones protegidas
4. **Actualizar perfil** (si es doctor): `PUT /med/doctors/profile`
5. **Consultar datos**: `GET /med/doctors` o `GET /med/auth/user-profile`
6. **Cerrar sesión**: `POST /med/auth/logout`

---

*Documentación generada el 25 de agosto de 2025*
