<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Efectivo', 'active' => true],
            ['name' => 'Transferencia', 'active' => true],
            ['name' => 'Mercadopago', 'active' => true],
            ['name' => 'Tarjeta Debito', 'active' => true],
            ['name' => 'Tarjeta Credito', 'active' => true]
        ];

        PaymentType::insert($types);
    }
}
