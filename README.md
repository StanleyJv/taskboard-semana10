# 🧩 TaskBoard — Semana 10

[![Laravel](https://img.shields.io/badge/Laravel-12-red?logo=laravel)](https://laravel.com/)
[![PHP](https://img.shields.io/badge/PHP-8.2-blue?logo=php)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-TaskBoard-blue?logo=mysql)](https://www.mysql.com/)
[![UPED](https://img.shields.io/badge/UPED-Integración_de_Sistemas-0B2E59)](#)

Proyecto desarrollado para la asignatura **Integración de Sistemas** de la **Universidad Pedagógica de El Salvador**, correspondiente a la **Semana 10**.

## 👨‍💻 Estudiante

**Josthyn Stanley Cruz Vásquez**  
Ingeniería en Sistemas y Computación  
Universidad Pedagógica de El Salvador

## 🎯 Objetivo de la semana

Durante la Semana 10 se reforzó el formulario **Nueva Transacción** mediante validaciones, mensajes de error personalizados y un proceso de refactorización hacia un **Form Request** de Laravel.

La funcionalidad principal del formulario se mantiene, pero ahora el código es más seguro, organizado y reutilizable.

## ✅ Jueves — Validación de formularios

Se implementaron reglas de validación directamente en `TransaccionController.php`.

### Reglas aplicadas

```php
'comercio_id' => 'required|exists:comercios,id',
'cliente_nombre' => 'required|string|min:3|max:255',
'monto' => 'required|numeric|min:0.01',
```

### Mensajes personalizados

```php
'cliente_nombre.required' => 'Debes indicar el nombre del cliente.',
'cliente_nombre.min' => 'El nombre del cliente es demasiado corto.',
'monto.required' => 'Debes indicar un monto.',
'monto.numeric' => 'El monto debe ser un número.',
'monto.min' => 'El monto debe ser mayor a cero.',
```

También se mejoró el formulario con:

- `@error` para mostrar mensajes debajo de cada campo.
- `old()` para conservar los datos escritos cuando ocurre un error.
- Validación de que el comercio exista realmente en la base de datos con `exists:comercios,id`.
- Reto adicional: mínimo de 3 caracteres para el nombre del cliente.

## ✅ Viernes — Form Request

Se creó:

```text
app/Http/Requests/GuardarTransaccionRequest.php
```

La validación fue trasladada desde el controlador hacia esta clase.

El Form Request contiene:

- `authorize()`
- `rules()`
- `messages()`
- `attributes()`

### authorize()

```php
public function authorize(): bool
{
    return true;
}
```

### rules()

```php
public function rules(): array
{
    return [
        'comercio_id' => 'required|exists:comercios,id',
        'cliente_nombre' => 'required|string|min:3|max:255',
        'monto' => 'required|numeric|min:0.01',
    ];
}
```

### attributes()

Se agregaron nombres amigables para los campos:

```php
'cliente_nombre' => 'nombre del cliente',
'monto' => 'monto de la transacción',
'comercio_id' => 'comercio',
```

## 🧹 Controlador más limpio

El método `store()` ahora utiliza:

```php
public function store(GuardarTransaccionRequest $request)
```

y ya no contiene una llamada directa a:

```php
$request->validate(...)
```

De esta forma, la validación queda separada del controlador y puede reutilizarse.

## 🔐 Seguridad y validación

Se comprobaron distintos escenarios:

- Cliente vacío.
- Monto vacío.
- Monto no numérico.
- Monto igual o menor que cero.
- Comercio inexistente (`9999`).
- Datos válidos.
- Nombre del cliente demasiado corto.

Laravel bloquea los datos inválidos antes de intentar guardarlos en MySQL.

## 🔁 Reutilización del Form Request

Como experimento se reutilizó `GuardarTransaccionRequest` en un método temporal para comprobar:

```php
$request->validated()
```

Esto permitió observar que Laravel devuelve únicamente los campos definidos dentro de `rules()`.

Después del experimento, el método y la ruta temporal fueron eliminados.

## 💳 Flujo final

El flujo del formulario queda así:

```text
Formulario Nueva Transacción
        ↓
GuardarTransaccionRequest
        ↓
Validación de reglas
        ↓
TransaccionController@store
        ↓
Eloquent / MySQL
        ↓
Redirección al comercio
        ↓
Mensaje de éxito
```

## 🛠️ Tecnologías

- Laravel 12
- PHP 8.2
- MySQL / MariaDB
- Blade
- Eloquent ORM
- Form Requests
- XAMPP
- Git
- GitHub

## ▶️ Ejecución del proyecto

```bash
php artisan serve
```

Luego abrir:

```text
http://127.0.0.1:8000/comercios
```

## 📂 Repositorio

```text
https://github.com/StanleyJv/taskboard-semana10
```

---

**Integración de Sistemas · Ciclo 02-2026 · UPED**
