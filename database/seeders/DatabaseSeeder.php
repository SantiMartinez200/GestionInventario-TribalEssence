<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Aroma;
use \App\Models\Cliente;
use \App\Models\Marca;
use \App\Models\Producto;
use \App\Models\MetodoPago;
use \App\Models\Proveedor;
use \App\Models\Tienda;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)->create();
        Aroma::factory(10)->create();
        Cliente::factory(5)->create();
        Marca::factory(7)->create();
        Producto::factory(20)->create();
        MetodoPago::factory(2)->create();
        Proveedor::factory(4)->create();
        Tienda::factory(1)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
