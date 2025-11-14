# Práctica 2: Modelo, Migraciones y Seeders en Laravel

## 📋 Descripción del Proyecto

Este es un proyecto educativo de Laravel 12 que implementa el patrón fundamental de desarrollo con bases de datos: **Base de Datos → Modelo → Migraciones → Seeders → Controlador → Vista**.

El objetivo es demostrar cómo funciona el flujo completo de una solicitud HTTP en Laravel, incluyendo la gestión de datos en una base de datos relacional (MySQL), usando Eloquent ORM, migraciones para crear tablas y seeders para poblarlas con datos de prueba.

---

## 🎯 Características Principales

### Tabla de Productos
- **Descripción**: Base de datos con tabla `productos` que almacena información de productos
- **Campos**: 
  - `id` (Primary Key)
  - `nombre` (String) - Nombre del producto
  - `descripcion` (Text) - Descripción detallada
  - `precio` (Decimal) - Precio del producto
  - `timestamps` - Fechas de creación y actualización

### Ruta Dinámica: `/productos`
- **Descripción**: Muestra una lista de todos los productos desde la base de datos
- **Controlador**: `ProductoController@index()`
- **Modelo**: `Producto` (Eloquent ORM)
- **Vista**: `resources/views/productos.blade.php`
- **Ejemplo**: `/productos` → Tabla con todos los productos almacenados

---

## 📁 Estructura del Proyecto

```
Practica2/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── PaginaController.php         # Controlador de Práctica 1
│   │       └── ProductoController.php       # Controlador de productos
│   └── Models/
│       └── Producto.php                     # Modelo Eloquent de Producto
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   └── YYYY_MM_DD_HHMMSS_create_productos_table.php  # Migración de productos
│   └── seeders/
│       ├── DatabaseSeeder.php               # Seeder principal
│       └── ProductoSeeder.php               # Seeder de productos
├── resources/
│   └── views/
│       ├── welcome.blade.php                # Página de inicio
│       ├── bienvenida.blade.php             # Vista estática (Práctica 1)
│       ├── saludo.blade.php                 # Vista dinámica (Práctica 1)
│       └── productos.blade.php              # Vista de lista de productos
├── routes/
│   └── web.php                              # Definición de rutas
├── .gitignore                               # Configuración de Git
├── composer.json                            # Dependencias PHP
├── .env.example                             # Ejemplo de variables de entorno
└── README.md                                # Este archivo
```

---

## 🚀 Instalación y Configuración

### Requisitos
- PHP 8.2 o superior
- Composer
- MySQL 5.7 o superior

### Pasos de Instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/edgardangel/Practica2.git
   cd Practica2
   ```

2. **Instalar dependencias**
   ```bash
   composer install
   ```

3. **Configurar archivo .env**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configurar la base de datos** (si aún no existe)
   - Crea una base de datos MySQL llamada `Practica2`
   - Asegúrate de que los credenciales en `.env` sean correctos:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=Practica2
     DB_USERNAME=root
     DB_PASSWORD=
     ```

5. **Ejecutar migraciones**
   ```bash
   php artisan migrate
   ```

6. **Ejecutar seeders para poblar datos**
   ```bash
   php artisan db:seed
   ```

7. **Iniciar el servidor de desarrollo**
   ```bash
   php artisan serve
   ```

El servidor estará disponible en: `http://localhost:8000`

---

## 🧪 Pruebas de las Rutas

### Acceder a la página de inicio
```
http://localhost:8000/
```

### Acceder a la ruta de bienvenida (Práctica 1)
```
http://localhost:8000/bienvenida
```

### Acceder a la ruta de saludos dinámicos (Práctica 1)
```
http://localhost:8000/saludo/Juan
http://localhost:8000/saludo/María
http://localhost:8000/saludo/Carlos
```

### Acceder a la lista de productos (Práctica 2)
```
http://localhost:8000/productos
```

---

## 💻 Detalles Técnicos

### Modelo (app/Models/Producto.php)
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'precio'];
}
```

### Migración (database/migrations/*_create_productos_table.php)
```php
public function up(): void
{
    Schema::create('productos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->text('descripcion');
        $table->decimal('precio', 8, 2);
        $table->timestamps();
    });
}
```

### Seeder (database/seeders/ProductoSeeder.php)
```php
public function run(): void
{
    Producto::create([
        'nombre' => 'Laptop Dell',
        'descripcion' => 'Laptop de alto rendimiento con procesador Intel i7',
        'precio' => 1200.00,
    ]);

    Producto::create([
        'nombre' => 'Mouse Logitech',
        'descripcion' => 'Mouse inalámbrico ergonómico',
        'precio' => 45.99,
    ]);

    // Más productos...
}
```

### Controlador (app/Http/Controllers/ProductoController.php)
```php
<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\View\View;

class ProductoController extends Controller
{
    public function index(): View
    {
        $productos = Producto::all();
        return view('productos', ['productos' => $productos]);
    }
}
```

### Rutas (routes/web.php)
```php
use App\Http\Controllers\ProductoController;

Route::get('/productos', [ProductoController::class, 'index']);
```

### Vista (resources/views/productos.blade.php)
```blade
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->descripcion }}</td>
                <td>${{ number_format($producto->precio, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
```

---

## 📸 Capturas de Pantalla

### Página de Inicio
![Página de Inicio](./screenshots/01-inicio.png)


### Detalle de la Tabla de Productos
![Tabla de Productos](./screenshots/02-tabla-productos.png)

---

## 📚 Conceptos Aprendidos

1. **Base de Datos**: Conexión y configuración de MySQL
2. **Migraciones**: Creación de tablas usando el sistema de migraciones de Laravel
3. **Modelos Eloquent**: ORM para interactuar con la base de datos
4. **Seeders**: Población de datos de prueba en la base de datos
5. **Controladores**: Lógica de negocio que consulta datos de la BD
6. **Vistas Dinámicas**: Templates Blade que iteran sobre colecciones de datos
7. **Relaciones BD**: Estructura de tablas y campos
8. **Blade Templating**: Sintaxis `@foreach` para iterar sobre arrays de objetos

---

## 🔧 Configuración de Git

El archivo `.gitignore` está configurado para excluir:
- `/vendor` - Directorio de dependencias Composer
- `.env` - Variables de entorno
- `/node_modules` - Dependencias npm
- `/storage/logs` - Archivos de logs
- `/public/storage` - Almacenamiento público
- Archivos de caché y temporales
- Directorios de IDE (.vscode, .idea, etc.)

---

## 📝 Notas

- El proyecto utiliza **Blade**, el motor de plantillas de Laravel
- Las vistas están en `resources/views/` con extensión `.blade.php`
- Los controladores se ubican en `app/Http/Controllers/`
- Las rutas se definen en `routes/web.php`
- El modelo Eloquent `Producto` facilita las consultas a la tabla `productos`
- Las migraciones permiten versionarla estructura de la BD
- Los seeders automatizan la población de datos de prueba
- Para más información, consulta la [Documentación oficial de Laravel](https://laravel.com/docs)

---

## 🎓 Relación con Práctica 1

Esta práctica construye sobre los conceptos de la Práctica 1:
- **Práctica 1**: Rutas → Controlador → Vista (sin BD)
- **Práctica 2**: BD → Modelo → Migraciones → Seeders → Controlador → Vista (con datos persistentes)

Ambas prácticas demuestran el patrón MVC (Model-View-Controller) en Laravel, siendo la Práctica 2 una extensión que incluye la capa de persistencia de datos.
