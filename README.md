# 💳 TaskBoard — Semana 6

> Proyecto integrador de **Integración de Sistemas** desarrollado con Laravel, Eloquent ORM y MySQL.

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?logo=mysql&logoColor=white)
![Composer](https://img.shields.io/badge/Composer-2.x-885630?logo=composer&logoColor=white)
![GitHub](https://img.shields.io/badge/GitHub-Repositorio-181717?logo=github)

---

## 📖 Descripción

**TaskBoard** es una pasarela de pagos desarrollada como proyecto integrador de la asignatura **Integración de Sistemas**.

Durante la **Semana 6**, el proyecto dejó de trabajar únicamente con datos simulados y comenzó a utilizar información real almacenada en una base de datos **MySQL** mediante **Eloquent ORM**.

En esta semana se trabajó con:

- 🗃️ Migraciones de Laravel.
- 🧩 Modelos Eloquent.
- 🔗 Llaves foráneas.
- 🔄 Relaciones `hasMany()` y `belongsTo()`.
- ⚡ Eager Loading con `with()`.
- 🧭 Route Model Binding.
- 🧪 Laravel Tinker.
- 🛢️ MySQL y DBeaver.
- 📊 Comprobación del problema N+1.

---

## ✨ Características

- ✅ Conexión de Laravel con MySQL.
- ✅ Creación de tablas mediante migraciones.
- ✅ Uso de modelos Eloquent.
- ✅ Relaciones entre comercios, transacciones y eventos.
- ✅ Uso de `$fillable` para asignación masiva.
- ✅ Consultas reales a la base de datos.
- ✅ Route Model Binding.
- ✅ Uso de `with()` para cargar relaciones.
- ✅ Consulta de relaciones anidadas.
- ✅ Pruebas desde Laravel Tinker.
- ✅ Comprobación del problema N+1 mediante Query Log.

---

## 🗓️ Guía N.º 1 — Jueves

### Eloquent ORM y Migraciones en Laravel

Durante la primera guía se construyó la estructura de datos real del proyecto.

Se trabajó principalmente con migraciones, modelos, MySQL, Eloquent ORM, llaves foráneas y Tinker.

---

## 🗃️ Modelo `Comercio`

Archivo:

```text
app/Models/Comercio.php
```

Campos principales de la tabla:

| Campo | Descripción |
|---|---|
| `id` | Identificador del comercio |
| `nombre_comercio` | Nombre del negocio |
| `rubro` | Tipo de comercio |
| `fecha_afiliacion` | Fecha de afiliación |
| `telefono` | Número de teléfono |
| `correo_contacto` | Correo del comercio |
| `created_at` | Fecha de creación |
| `updated_at` | Última actualización |

Las columnas `telefono` y `correo_contacto` fueron agregadas mediante una migración adicional.

---

## 💰 Modelo `Transaccion`

Archivo:

```text
app/Models/Transaccion.php
```

| Campo | Descripción |
|---|---|
| `id` | Identificador de la transacción |
| `comercio_id` | Comercio relacionado |
| `monto` | Monto de la transacción |
| `moneda` | Moneda utilizada |
| `cliente_nombre` | Nombre del cliente |
| `metodo_pago` | Método utilizado |
| `estado` | Estado de la transacción |
| `created_at` | Fecha de creación |
| `updated_at` | Última actualización |

`comercio_id` funciona como llave foránea hacia `comercios.id`.

---

## 🔄 Modelo `EventoTransaccion`

Archivo:

```text
app/Models/EventoTransaccion.php
```

Campos principales:

```text
id
transaccion_id
estado_anterior
estado_nuevo
created_at
updated_at
```

`transaccion_id` funciona como llave foránea hacia la tabla `transacciones`.

---

## 🗓️ Guía N.º 2 — Viernes

### Relaciones Eloquent y datos reales

Durante la segunda guía se conectaron formalmente los modelos mediante relaciones Eloquent.

---

## 🔗 Modelo de relaciones

```text
Comercio
   │ hasMany()
   ▼
Transaccion
   │ hasMany()
   ▼
EventoTransaccion
```

En sentido inverso:

```text
EventoTransaccion
   │ belongsTo()
   ▼
Transaccion
   │ belongsTo()
   ▼
Comercio
```

### Relaciones implementadas

| Modelo | Relación | Modelo relacionado |
|---|---|---|
| `Comercio` | `hasMany()` | `Transaccion` |
| `Transaccion` | `belongsTo()` | `Comercio` |
| `Transaccion` | `hasMany()` | `EventoTransaccion` |
| `EventoTransaccion` | `belongsTo()` | `Transaccion` |

---

## 🏪 Comercio → Transacciones

```php
public function transacciones(): HasMany
{
    return $this->hasMany(Transaccion::class);
}
```

Esto permite consultar las transacciones de un comercio con:

```php
$comercio->transacciones;
```

---

## 💳 Transaccion → Comercio

```php
public function comercio(): BelongsTo
{
    return $this->belongsTo(Comercio::class);
}
```

Esto permite acceder al comercio de una transacción mediante:

```php
$transaccion->comercio;
```

---

## 🧾 Transaccion → Eventos

```php
public function eventos(): HasMany
{
    return $this->hasMany(EventoTransaccion::class);
}
```

---

## 🔄 EventoTransaccion → Transaccion

```php
public function transaccion(): BelongsTo
{
    return $this->belongsTo(Transaccion::class);
}
```

---

## 🧪 Pruebas con Laravel Tinker

Entrar a Tinker:

```bash
php artisan tinker
```

Buscar un comercio:

```php
$comercio = App\Models\Comercio::find(1);
```

Crear una transacción desde la relación:

```php
$comercio->transacciones()->create([
    'monto' => 45.00,
    'moneda' => 'USD',
    'cliente_nombre' => 'María López',
    'metodo_pago' => 'Tarjeta',
    'estado' => 'Iniciada',
]);
```

Comprobar la relación inversa:

```php
$transaccion = App\Models\Transaccion::find(1);
$transaccion->comercio->nombre_comercio;
```

Resultado:

```text
Café Amanecer
```

---

## ⚡ Eager Loading y problema N+1

Sin Eager Loading:

```php
$transacciones = Transaccion::all();

foreach ($transacciones as $t) {
    $t->comercio->nombre_comercio;
}
```

La solución utilizada fue:

```php
$transacciones = Transaccion::with('comercio')->get();
```

De esta forma Laravel carga previamente los comercios relacionados.

### 🔍 Query Log

```php
DB::enableQueryLog();
```

Después de ejecutar las consultas:

```php
count(DB::getQueryLog());
```

Esto permite observar la diferencia entre trabajar con y sin `with()`.

---

## 🧭 Route Model Binding

Ejemplo:

```php
Route::get('/transaccion/{transaccion}', [TransaccionController::class, 'show']);
```

Controlador:

```php
public function show(Transaccion $transaccion)
{
    return $transaccion->load('comercio');
}
```

Laravel obtiene automáticamente la transacción correspondiente al parámetro de la URL.

---

## 🎮 Controladores

### `ComercioController`

```php
public function index()
{
    return Comercio::with('transacciones')->get();
}

public function show(Comercio $comercio)
{
    return $comercio->load('transacciones');
}
```

### `TransaccionController`

```php
public function index()
{
    return Transaccion::with('comercio')->get();
}

public function show(Transaccion $transaccion)
{
    return $transaccion->load('comercio');
}
```

### `EventoTransaccionController`

```php
public function index()
{
    return EventoTransaccion::with('transaccion.comercio')->get();
}
```

Esto permite obtener:

```text
Evento
└── Transaccion
    └── Comercio
```

---

## 🌐 Rutas principales

| Ruta | Acción |
|---|---|
| `/taskboard` | Mensaje principal |
| `/acerca-de` | Información del proyecto |
| `/contacto` | Información del estudiante |
| `/comercios` | Lista de comercios con transacciones |
| `/comercios/{comercio}` | Detalle de un comercio |
| `/transacciones` | Lista de transacciones con comercio |
| `/transaccion/{transaccion}` | Detalle de una transacción |
| `/eventos-transaccion` | Eventos con transacción y comercio |
| `/estados` | Estados disponibles |
| `/transaccion/demo` | Ejemplo de transacción |

---

## 🗂️ Estructura principal

```text
taskboard-semana6/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── ComercioController.php
│   │       ├── TransaccionController.php
│   │       └── EventoTransaccionController.php
│   └── Models/
│       ├── Comercio.php
│       ├── Transaccion.php
│       └── EventoTransaccion.php
├── database/
│   └── migrations/
├── routes/
│   └── web.php
├── artisan
├── composer.json
└── README.md
```

---

## 🛠️ Tecnologías

| Herramienta | Uso |
|---|---|
| Laravel | Framework principal |
| PHP 8.2 | Lenguaje del proyecto |
| MySQL | Base de datos |
| Eloquent ORM | Acceso y relaciones entre datos |
| Composer | Gestión de dependencias |
| Artisan | CLI de Laravel |
| Tinker | Pruebas interactivas |
| DBeaver | Administración de MySQL |
| Git | Control de versiones |
| GitHub | Repositorio remoto |

---

## 📋 Requisitos

- PHP 8.2 o superior.
- Composer.
- MySQL o MariaDB.
- Extensión `pdo_mysql`.
- Git.
- Un editor o IDE.

---

## ⚙️ Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/StanleyJv/taskboard-semana6.git
cd taskboard-semana6
```

### 2. Instalar dependencias

```bash
composer install
```

### 3. Crear `.env`

En Windows:

```bash
copy .env.example .env
```

### 4. Generar la clave de Laravel

```bash
php artisan key:generate
```

### 5. Crear la base de datos

```sql
CREATE DATABASE taskboard
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
```

### 6. Configurar MySQL en `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=taskboard
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Ejecutar las migraciones

```bash
php artisan migrate
```

### 8. Levantar el servidor

```bash
php artisan serve
```

Abrir:

```text
http://127.0.0.1:8000
```

---

## ✅ Resultados de la Semana 6

- ✔ Laravel conectado a MySQL.
- ✔ Modelos Eloquent creados.
- ✔ Migraciones ejecutadas.
- ✔ Llaves foráneas implementadas.
- ✔ Relaciones `hasMany()` y `belongsTo()`.
- ✔ Uso de `$fillable`.
- ✔ Datos reales desde MySQL.
- ✔ Pruebas mediante Tinker.
- ✔ Eager Loading con `with()`.
- ✔ Route Model Binding.
- ✔ Consulta de relaciones anidadas.
- ✔ Comprobación del problema N+1.

---

## 👨‍💻 Autor

**Josthyn Stanley Cruz Vásquez**  
Ingeniería en Sistemas y Computación  
Universidad Pedagógica de El Salvador

**Asignatura:** Integración de Sistemas  
**Docente:** Ing. Oscar Armando Contreras  
**Ciclo:** 02-2026

---

<div align="center">

### 💳 TaskBoard · Semana 6

**Eloquent ORM · Migraciones · Relaciones · MySQL**

</div>
