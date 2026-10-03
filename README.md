# 🧩 TaskBoard — Semana 9

[![Laravel](https://img.shields.io/badge/Laravel-12-red?logo=laravel)](https://laravel.com/)
[![PHP](https://img.shields.io/badge/PHP-8.2-blue?logo=php)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-TaskBoard-blue?logo=mysql)](https://www.mysql.com/)
[![UPED](https://img.shields.io/badge/UPED-Integración_de_Sistemas-0B2E59)](#)

Proyecto desarrollado para la asignatura **Integración de Sistemas** de la **Universidad Pedagógica de El Salvador**, correspondiente a la **Semana 9**.

## 👨‍💻 Estudiante

**Josthyn Stanley Cruz Vásquez**  
Ingeniería en Sistemas y Computación  
Universidad Pedagógica de El Salvador

## 🎯 Objetivo de la semana

Durante esta semana se trabajó con formularios en Laravel, solicitudes **GET y POST**, protección **CSRF**, búsqueda de comercios y el registro real de nuevas transacciones utilizando Eloquent.

## ✅ Funcionalidades implementadas

- Formulario sandbox para practicar controles HTML.
- Campo de correo electrónico y opción de transacción recurrente.
- Buscador de comercios mediante método `GET`.
- Filtrado por nombre de comercio.
- Prueba deliberada del error **419 Page Expired**.
- Protección de formularios `POST` mediante `@csrf`.
- Formulario real **Nueva transacción**.
- Rutas con nombre `transacciones.create` y `transacciones.store`.
- Registro de transacciones mediante Eloquent.
- Redirección al comercio después del registro.
- Mensaje flash: **“Transacción registrada con éxito.”**
- Patrón **POST / Redirect / GET (PRG)** para evitar duplicados al recargar.
- Enlace **+ Nueva transacción** desde el panel de cada comercio.
- Experimento de seguridad sobre campos enviados desde el formulario.
- Conservación del diseño Blade utilizado en semanas anteriores.

## 🔎 Buscador GET

El panel de comercios permite realizar búsquedas utilizando una URL similar a:

```text
/comercios?buscar=cafe
```

El filtro se procesa en `ComercioController` utilizando `Request` y Eloquent.

## 🔐 Protección CSRF

Se realizó una prueba eliminando temporalmente `@csrf` de un formulario `POST`, provocando el error:

```text
419 | Page Expired
```

Posteriormente se restauró `@csrf`, comprobando que Laravel vuelve a procesar correctamente la solicitud.

## 💳 Nueva transacción

Ruta del formulario:

```text
/comercios/{comercio}/transacciones/nueva
```

El formulario permite registrar:

- Comercio
- Nombre del cliente
- Monto

Al guardar correctamente, Laravel redirige nuevamente al panel del comercio y muestra un mensaje de confirmación.

> Nota: el proyecto conserva un campo `metodo_pago` proveniente de la estructura desarrollada en semanas anteriores, por lo que se asigna internamente el valor `No especificado` al registrar desde el formulario de Semana 9.

## 🧪 Pruebas realizadas

- Visualización de todos los comercios sin filtro.
- Búsqueda de `cafe`.
- Búsqueda sin resultados con `xyz`.
- Persistencia del término de búsqueda al recargar.
- Error 419 al enviar POST sin `@csrf`.
- Envío correcto al restaurar `@csrf`.
- Registro real de una nueva transacción.
- Confirmación visual de la nueva transacción.
- Recarga posterior sin duplicar registros.
- Prueba de manipulación del campo `estado`.

## 🛠️ Tecnologías

- Laravel 12
- PHP 8.2
- MySQL / MariaDB
- Blade
- Eloquent ORM
- XAMPP
- Git y GitHub

## ▶️ Ejecución

```bash
php artisan serve
```

Luego abrir:

```text
http://127.0.0.1:8000/comercios
```

## 📂 Repositorio

```text
https://github.com/StanleyJv/taskboard-semana9
```

---

**Integración de Sistemas · Ciclo 02-2026 · UPED**
