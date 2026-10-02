
<div align="center">

# 💳 TaskBoard · Semana 6

### Eloquent ORM · Migraciones · Relaciones · MySQL

Proyecto desarrollado para la asignatura **Integración de Sistemas**  
Universidad Pedagógica de El Salvador

**Ciclo II - 2026**

---

</div>

## 📌 Sobre esta semana

Durante la Semana 6, TaskBoard dejó de trabajar únicamente con datos simulados y comenzó a utilizar una base de datos MySQL real mediante **Eloquent ORM**.

En esta etapa se construyeron y relacionaron los modelos principales del sistema:

```text
Comercio
   ↓
Transaccion
   ↓
EventoTransaccion

También se trabajó con migraciones, llaves foráneas, relaciones Eloquent, Route Model Binding y eager loading con with().
🗓️ Guía N.º 1 · Jueves
Eloquent ORM y Migraciones en Laravel
Durante la primera parte de la semana se trabajó en la estructura de datos del proyecto.
✅ Actividades realizadas
- Configuración de Laravel para trabajar con MySQL.
- Creación de la base de datos taskboard.
- Uso de migraciones.
- Creación del modelo Comercio.
- Creación del modelo Transaccion.
- Creación del modelo EventoTransaccion.
- Uso de llaves foráneas.
- Pruebas con Laravel Tinker.
- Uso de $fillable.
- Agregado de nuevas columnas mediante una migración adicional.
🗃️ Tabla comercios
La tabla principal de comercios contiene:
id
nombre_comercio
rubro
fecha_afiliacion
telefono
correo_contacto
created_at
updated_at

Las columnas telefono y correo_contacto fueron agregadas mediante una migración nueva, sin modificar la migración original.
💰 Tabla transacciones
La tabla de transacciones contiene:
id
comercio_id
monto
moneda
cliente_nombre
metodo_pago
estado
created_at
updated_at

La columna:
comercio_id

funciona como llave foránea hacia la tabla comercios.
🔄 Tabla eventos_transaccion
La tabla de eventos permite registrar cambios relacionados con una transacción.
id
transaccion_id
estado_anterior
estado_nuevo
created_at
updated_at

La columna:
transaccion_id

funciona como llave foránea hacia transacciones.
🗓️ Guía N.º 2 · Viernes
Relaciones Eloquent y Datos Reales
Durante la segunda parte de la semana se conectaron los modelos mediante relaciones Eloquent.
🔗 Relaciones implementadas
Comercio → Transacciones
public function transacciones(): HasMany
{
    return $this->hasMany(Transaccion::class);
}

Un comercio puede tener muchas transacciones.
Transaccion → Comercio
public function comercio(): BelongsTo
{
    return $this->belongsTo(Comercio::class);
}

Cada transacción pertenece a un comercio.
Transaccion → Eventos
public function eventos(): HasMany
{
    return $this->hasMany(EventoTransaccion::class);
}

Una transacción puede tener múltiples eventos.
EventoTransaccion → Transaccion
public function transaccion(): BelongsTo
{
    return $this->belongsTo(Transaccion::class);
}

Cada evento pertenece a una transacción.
🧩 Modelo de relaciones
┌──────────────┐
│   Comercio   │
└──────┬───────┘
       │ hasMany
       ▼
┌──────────────┐
│ Transaccion  │
└──────┬───────┘
       │ hasMany
       ▼
┌────────────────────┐
│ EventoTransaccion  │
└────────────────────┘

En sentido inverso:
EventoTransaccion
       │
       └── belongsTo → Transaccion
                           │
                           └── belongsTo → Comercio

⚡ Eager Loading y problema N+1
Se trabajó con:
Transaccion::with('comercio')->get();

El uso de with() permite cargar las relaciones de manera anticipada y reducir la cantidad de consultas realizadas a la base de datos.
Sin with():
1 consulta principal
+
consultas adicionales por cada relación

Con with():
1 consulta para transacciones
+
1 consulta para los comercios relacionados

🧭 Route Model Binding
También se implementó Route Model Binding.
Ejemplo:
Route::get('/transaccion/{transaccion}', [TransaccionController::class, 'show']);

Controlador:
public function show(Transaccion $transaccion)
{
    return $transaccion->load('comercio');
}

Laravel obtiene automáticamente el modelo correspondiente al parámetro recibido en la URL.
🌐 Rutas principales
/comercios
/comercios/{comercio}
/transacciones
/transaccion/{transaccion}
/eventos-transaccion

🧪 Pruebas realizadas
Se realizaron pruebas mediante Laravel Tinker para verificar las relaciones.
Ejemplo:
$comercio = App\Models\Comercio::find(1);

$comercio->transacciones()->create([
    'monto' => 45.00,
    'moneda' => 'USD',
    'cliente_nombre' => 'María López',
    'metodo_pago' => 'Tarjeta',
    'estado' => 'Iniciada',
]);

También se verificó la relación inversa:
$transaccion = App\Models\Transaccion::find(1);

$transaccion->comercio->nombre_comercio;

Resultado:
Café Amanecer

🔎 Consulta de eventos relacionados
El controlador de eventos utiliza:
EventoTransaccion::with('transaccion.comercio')->get();

Esto permite obtener:
Evento
└── Transaccion
    └── Comercio

en una misma respuesta JSON.
📁 Estructura principal
taskboard-semana6/
│
├── app/
│   │
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
│   └── migrations/
│
├── routes/
│   └── web.php
│
├── artisan
├── composer.json
└── README.md

🛠️ Tecnologías utilizadas
<p align="center">

PHP 8.2 · Laravel · Eloquent ORM · MySQL · Composer · Artisan · Tinker · Git · GitHub · DBeaver
</p>

▶️ Cómo ejecutar el proyecto
1. Clonar el repositorio
git clone https://github.com/StanleyJv/taskboard-semana6.git

2. Entrar al proyecto
cd taskboard-semana6

3. Instalar dependencias
composer install

4. Crear el archivo .env
copy .env.example .env

5. Generar la clave
php artisan key:generate

6. Configurar MySQL en .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=taskboard
DB_USERNAME=root
DB_PASSWORD=

7. Ejecutar migraciones
php artisan migrate

8. Levantar el servidor
php artisan serve

Luego abrir:
http://127.0.0.1:8000

✅ Resultados obtenidos
Durante la Semana 6 se logró:
✔ Conectar Laravel con MySQL
✔ Crear modelos Eloquent
✔ Crear migraciones
✔ Implementar llaves foráneas
✔ Definir relaciones hasMany y belongsTo
✔ Trabajar con datos reales
✔ Aplicar Route Model Binding
✔ Utilizar eager loading con with()
✔ Comprobar el problema N+1
✔ Consultar relaciones anidadas

<div align="center">

👨‍💻 Autor
Josthyn Stanley Cruz Vásquez
Ingeniería en Sistemas y Computación
Universidad Pedagógica de El Salvador
📘 Integración de Sistemas
Docente: Ing. Oscar Armando Contreras
Ciclo II - 2026
💳 TaskBoard · Semana 6
Eloquent • Migraciones • Relaciones • MySQL
</div>
```