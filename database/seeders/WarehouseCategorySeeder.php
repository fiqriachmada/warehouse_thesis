<?php

namespace Database\Seeders;

use App\Models\WarehouseCategory;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WarehouseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $warehouse_categories = [
            [
                'id' => Uuid::uuid4()->toString(),
                'category' => 'Operasional'
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'category' => 'Perlengkapan'
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'category' => 'Pemberangkatan'
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'category' => 'Musiman'
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'category' => 'Pabrik'
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'category' => 'Pokok'
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'category' => 'Distribusi'
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'category' => 'Ritel'
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'category' => 'Penyimpanan'
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'category' => 'Order Fullfillment'
            ]
        ];

        foreach ($warehouse_categories as $warehouse_category) {
            WarehouseCategory::create($warehouse_category);
        }
    }
}
