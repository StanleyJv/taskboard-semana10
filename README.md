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

# 🗓️ Guía N.º 1 — Jueves

## Eloquent ORM y Migraciones en Laravel

Durante la primera guía se construyó la estructura de datos real del proyecto.

Se trabajó principalmente con:

- Migraciones.
- Modelos.
- MySQL.
- Eloquent ORM.
- Llaves foráneas.
- Tinker.

---

## 🗃️ Modelo `Comercio`

Archivo:

```text
app/Models/Comercio.php

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

Copia todo esto dentro de README.md:
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

# 🗓️ Guía N.º 1 — Jueves

## Eloquent ORM y Migraciones en Laravel

Durante la primera guía se construyó la estructura de datos real del proyecto.

Se trabajó principalmente con:

- Migraciones.
- Modelos.
- MySQL.
- Eloquent ORM.
- Llaves foráneas.
- Tinker.

---

## 🗃️ Modelo `Comercio`

Archivo:

```text
app/Models/Comercio.php

Campos principales de la tabla:
Campo	Descripción
id	Identificador del comercio
nombre_comercio	Nombre del negocio
rubro	Tipo de comercio
fecha_afiliacion	Fecha de afiliación
telefono	Número de teléfono
correo_contacto	Correo del comercio
created_at	Fecha de creación
updated_at	Última actualización


Las columnas telefono y correo_contacto fueron agregadas mediante una migración adicional.
💰 Modelo Transaccion
Archivo:
app/Models/Transaccion.php

La tabla contiene:
Campo	Descripción
id	Identificador de la transacción
comercio_id	Comercio relacionado
monto	Monto de la transacción
moneda	Moneda utilizada
cliente_nombre	Nombre del cliente
metodo_pago	Método utilizado
estado	Estado de la transacción
created_at	Fecha de creación
updated_at	Última actualización


La columna:
comercio_id

funciona como llave foránea hacia:
comercios.id

🔄 Modelo EventoTransaccion
Archivo:
app/Models/EventoTransaccion.php

Campos:
id
transaccion_id
estado_anterior
estado_nuevo
created_at
updated_at

transaccion_id funciona como llave foránea hacia la tabla transacciones.
🗓️ Guía N.º 2 — Viernes
Relaciones Eloquent y datos reales
Durante la segunda guía se conectaron formalmente los modelos mediante relaciones Eloquent.
🔗 Modelo de relaciones
┌───────────────┐
│   Comercio    │
└───────┬───────┘
        │ hasMany()
        ▼
┌───────────────┐
│  Transaccion  │
└───────┬───────┘
        │ hasMany()
        ▼
┌────────────────────┐
│ EventoTransaccion  │
└────────────────────┘

En sentido inverso:
EventoTransaccion
       │
       └── belongsTo()
              ↓
         Transaccion
              │
              └── belongsTo()
                     ↓
                  Comercio

🔗 Relaciones implementadas
Modelo	Relación	Modelo relacionado
Comercio	hasMany()	Transaccion
Transaccion	belongsTo()	Comercio
Transaccion	hasMany()	EventoTransaccion
EventoTransaccion	belongsTo()	Transaccion


🏪 Comercio → Transacciones
public function transacciones(): HasMany
{
    return $this->hasMany(Transaccion::class);
}

Esto permite consultar las transacciones de un comercio con:
$comercio->transacciones;

💳 Transaccion → Comercio
public function comercio(): BelongsTo
{
    return $this->belongsTo(Comercio::class);
}

Esto permite acceder al comercio de una transacción mediante:
$transaccion->comercio;

🧾 Transaccion → Eventos
public function eventos(): HasMany
{
    return $this->hasMany(EventoTransaccion::class);
}

🔄 EventoTransaccion → Transaccion
public function transaccion(): BelongsTo
{
    return $this->belongsTo(Transaccion::class);
}

🧪 Pruebas con Laravel Tinker
Se utilizó Laravel Tinker para comprobar que las relaciones funcionaran correctamente.
Entrar a Tinker:
php artisan tinker

Buscar un comercio:
$comercio = App\Models\Comercio::find(1);

Crear una transacción desde la relación:
$comercio->transacciones()->create([
    'monto' => 45.00,
    'moneda' => 'USD',
    'cliente_nombre' => 'María López',
    'metodo_pago' => 'Tarjeta',
    'estado' => 'Iniciada',
]);

Consultar las transacciones:
$comercio->transacciones;

Comprobar la relación inversa:
$transaccion = App\Models\Transaccion::find(1);

$transaccion->comercio->nombre_comercio;

Resultado:
Café Amanecer

⚡ Eager Loading y problema N+1
Sin Eager Loading:
$transacciones = Transaccion::all();

foreach ($transacciones as $t) {
    $t->comercio->nombre_comercio;
}

Esto puede provocar múltiples consultas adicionales.
La solución utilizada fue:
$transacciones = Transaccion::with('comercio')->get();

De esta forma Laravel carga previamente los comercios relacionados.
🔍 Query Log
Para observar las consultas realizadas se utilizó:
DB::enableQueryLog();

Posteriormente:
count(DB::getQueryLog());

Esto permitió comprobar cómo cambia la cantidad de consultas al trabajar con y sin with().
🧭 Route Model Binding
Laravel permite obtener automáticamente un modelo desde un parámetro de ruta.
Ejemplo:
Route::get(
    '/transaccion/{transaccion}',
    [TransaccionController::class, 'show']
);

Controlador:
public function show(Transaccion $transaccion)
{
    return $transaccion->load('comercio');
}

Laravel busca automáticamente la transacción correspondiente.
🎮 Controladores
ComercioController
public function index()
{
    return Comercio::with('transacciones')->get();
}

public function show(Comercio $comercio)
{
    return $comercio->load('transacciones');
}

TransaccionController
public function index()
{
    return Transaccion::with('comercio')->get();
}

public function show(Transaccion $transaccion)
{
    return $transaccion->load('comercio');
}

EventoTransaccionController
public function index()
{
    return EventoTransaccion::with(
        'transaccion.comercio'
    )->get();
}

Esto permite obtener:
Evento
└── Transaccion
    └── Comercio

🌐 Rutas principales
Ruta	Acción
/taskboard	Mensaje principal
/acerca-de	Información del proyecto
/contacto	Información del estudiante
/comercios	Lista comercios con transacciones
/comercios/{comercio}	Detalle de comercio
/transacciones	Lista de transacciones con comercio
/transaccion/{transaccion}	Detalle de una transacción
/eventos-transaccion	Eventos con transacción y comercio
/estados	Estados disponibles
/transaccion/demo	Ejemplo de transacción


🗂️ Estructura principal
taskboard-semana6/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── ComercioController.php
│   │       ├── TransaccionController.php
│   │       └── EventoTransaccionController.php
│   │
│   └── Models/
│       ├── Comercio.php
│       ├── Transaccion.php
│       └── EventoTransaccion.php
│
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
│
├── public/
├── resources/
├── routes/
│   └── web.php
│
├── storage/
├── tests/
│
├── artisan
├── composer.json
├── composer.lock
└── README.md

🛠️ Tecnologías
Herramienta	Uso
Laravel	Framework principal
PHP 8.2	Lenguaje del proyecto
MySQL	Base de datos
Eloquent ORM	Acceso y relaciones entre datos
Composer	Gestión de dependencias
Artisan	CLI de Laravel
Tinker	Pruebas interactivas
DBeaver	Administración de MySQL
Git	Control de versiones
GitHub	Repositorio remoto


📋 Requisitos
Antes de ejecutar el proyecto se necesita:
- PHP 8.2 o superior.
- Composer.
- MySQL o MariaDB.
- Extensión pdo_mysql.
- Git.
- Un editor o IDE.