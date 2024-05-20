<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Document\DocumentProcess;
use App\Models\Document\DocumentType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
        ]);

        DocumentProcess::insert([
            ['pro_nombre' => 'Ingeniería', 'pro_prefijo' => 'ING'],
            ['pro_nombre' => 'Administrativo', 'pro_prefijo' => 'ADM'],
            ['pro_nombre' => 'Ventas', 'pro_prefijo' => 'VTA'],
            ['pro_nombre' => 'Comercial', 'pro_prefijo' => 'COM'],
            ['pro_nombre' => 'Apoyo', 'pro_prefijo' => 'APO']
        ]);

        DocumentType::insert([
            ['tip_nombre' => 'Instructivo', 'tip_prefijo' => 'INS'],
            ['tip_nombre' => 'Guía', 'tip_prefijo' => 'GUI'],
            ['tip_nombre' => 'Manual', 'tip_prefijo' => 'MAN'],
            ['tip_nombre' => 'Contraro', 'tip_prefijo' => 'CON'],
            ['tip_nombre' => 'Planos', 'tip_prefijo' => 'PLA'],
        ]);
    }
}
