<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
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

        Producto::create([
            'nombre' => 'Teclado Mecánico',
            'descripcion' => 'Teclado mecánico RGB con switches Cherry MX',
            'precio' => 150.00,
        ]);

        Producto::create([
            'nombre' => 'Monitor LG 27"',
            'descripcion' => 'Monitor 4K UltraHD con 144Hz',
            'precio' => 450.50,
        ]);

        Producto::create([
            'nombre' => 'Auriculares Sony',
            'descripcion' => 'Auriculares inalámbricos con cancelación de ruido',
            'precio' => 299.99,
        ]);
    }
}