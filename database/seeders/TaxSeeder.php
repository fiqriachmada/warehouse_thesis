<?php

namespace Database\Seeders;

use App\Models\Tax;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $taxes = [
            [
                'id' => Uuid::uuid4()->toString(),
                'value' => 5
            ]
        ];

        foreach ($taxes as $key => $tax) {
            Tax::create($tax);
        }
    }
}
