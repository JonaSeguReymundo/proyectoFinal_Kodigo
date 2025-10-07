# 📋 AppWebCanvan - Sistema Kanban

Un sistema de gestión de proyectos estilo Kanban desarrollado con Laravel, que permite organizar tareas en tableros con columnas personalizables. Ideal para equipos de desarrollo, marketing y gestión de recursos humanos.

## ✨ Características

- **📊 Tableros Kanban**: Crea y gestiona múltiples tableros de proyecto
- **🗂️ Columnas Personalizables**: Organiza el flujo de trabajo con columnas como "Por hacer", "En progreso", "Terminado"
- **✅ Gestión de Tareas**: Crea, edita y elimina tareas con información detallada
- **👥 Asignación de Responsables**: Asigna tareas a miembros específicos del equipo
- **📅 Fechas y Prioridades**: Control de fechas límite y niveles de prioridad
- **📈 Seguimiento de Progreso**: Monitorea el avance de cada tarea
- **🎨 Interfaz Colorida**: Columnas con colores distintivos para mejor organización
- **📚 API REST Completa**: Endpoints RESTful para todas las operaciones
- **📖 Documentación Swagger**: Interfaz interactiva para probar la API

## 🛠️ Tecnologías Utilizadas

- **Backend**: Laravel 11.x
- **Base de Datos**: MySQL
- **Documentación API**: Swagger/OpenAPI (L5-Swagger)
- **ORM**: Eloquent
- **Arquitectura**: API REST

## 📋 Prerrequisitos

Antes de instalar, asegúrate de tener:

- **PHP** >= 8.2
- **Composer** (gestor de dependencias de PHP)
- **MySQL** >= 8.0 
- **XAMPP** (recomendado) o servidor web compatible
- **Git** (opcional, para clonar el repositorio)

## 🚀 Instalación

### 1. Clonar el repositorio (o descargar el ZIP)
```bash
git clone <URL_DEL_REPOSITORIO>
cd AppWebCanvan
```

### 2. Instalar dependencias de PHP
```bash
composer install
```

### 3. Configurar variables de entorno
Copia el archivo `.env.example` a `.env` y configura tu base de datos:
```bash
cp .env.example .env
```

Edita el archivo `.env` con tus datos de MySQL:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_app
DB_USERNAME=root
DB_PASSWORD=tu_password_mysql
```

### 4. Generar clave de aplicación
```bash
php artisan key:generate
```

### 5. Ejecutar migraciones y seeders
```bash
php artisan migrate:fresh --seed
```

### 6. Generar documentación Swagger
```bash
php artisan l5-swagger:generate
```

## ▶️ Ejecución

### 1. Iniciar servicios necesarios
- **XAMPP**: Inicia Apache y MySQL
- O asegúrate de que tu servidor MySQL esté corriendo

### 2. Iniciar servidor Laravel
```bash
php artisan serve
```

El servidor estará disponible en: `http://127.0.0.1:8000`

### 3. Acceder a la documentación API
Visita: `http://127.0.0.1:8000/api/documentation`

## 📊 Datos de Prueba

El sistema incluye datos de ejemplo con:

### 👥 Usuarios de Prueba
- **Administrador**: admin@kanban.com
- **Developer**: developer@kanban.com  
- **Project Manager**: pm@kanban.com

### 📋 Tableros Incluidos
1. **Desarrollo Web Laravel** - Gestión de desarrollo de software
2. **Marketing Digital** - Campañas y estrategias de marketing
3. **Gestión de Recursos Humanos** - Procesos de RRHH

### ✅ Tareas de Ejemplo
- 16 tareas distribuidas en diferentes estados
- Responsables asignados realistas
- Fechas y prioridades variadas
- Niveles de progreso del 0% al 100%

## 🌐 API Endpoints

### Tableros (Boards)
- `GET /api/boards` - Listar todos los tableros
- `POST /api/boards` - Crear nuevo tablero
- `GET /api/boards/{id}` - Obtener tablero específico
- `PUT /api/boards/{id}` - Actualizar tablero
- `DELETE /api/boards/{id}` - Eliminar tablero

### Columnas (Columns)
- `GET /api/columns` - Listar todas las columnas
- `POST /api/columns` - Crear nueva columna
- `GET /api/columns/{id}` - Obtener columna específica
- `PUT /api/columns/{id}` - Actualizar columna
- `DELETE /api/columns/{id}` - Eliminar columna

### Tareas (Tasks)
- `GET /api/tasks` - Listar todas las tareas
- `POST /api/tasks` - Crear nueva tarea
- `GET /api/tasks/{id}` - Obtener tarea específica
- `PUT /api/tasks/{id}` - Actualizar tarea
- `DELETE /api/tasks/{id}` - Eliminar tarea

## 🧪 Probar la API

### Opción 1: Swagger UI (Recomendado)
1. Ve a `http://127.0.0.1:8000/api/documentation`
2. Selecciona cualquier endpoint
3. Haz clic en "Try it out"
4. Completa los parámetros necesarios
5. Haz clic en "Execute"

### Opción 2: cURL o Postman
```bash
# Obtener todos los tableros
curl http://127.0.0.1:8000/api/boards

# Crear un nuevo tablero
curl -X POST http://127.0.0.1:8000/api/boards \
  -H "Content-Type: application/json" \
  -d '{"nombre": "Mi Tablero", "descripcion": "Descripción del tablero"}'
```

## 🔧 Comandos Útiles

```bash
# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Ver todas las rutas
php artisan route:list

# Ejecutar seeders específicos
php artisan db:seed --class=BoardSeeder

# Regenerar documentación Swagger
php artisan l5-swagger:generate
```

## 📁 Estructura del Proyecto

```
AppWebCanvan/
├── app/
│   ├── Http/Controllers/    # Controladores de la API
│   └── Models/             # Modelos Eloquent
├── database/
│   ├── migrations/         # Migraciones de base de datos
│   └── seeders/           # Datos de prueba
├── routes/
│   └── api.php            # Rutas de la API
└── storage/docs/          # Documentación Swagger generada
```

## 🤝 Contribuir

1. Fork del repositorio
2. Crear rama feature (`git checkout -b feature/AmazingFeature`)
3. Commit cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Crear Pull Request

## 📝 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalle.

## 📞 Contacto

**Proyecto Final Kodigo** - Sistema Kanban Laravel

**Documentación API**: http://127.0.0.1:8000/api/documentation

---



*Desarrollado como proyecto final para Kodigo - Academia de Programación*
