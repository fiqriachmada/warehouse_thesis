<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            // TenantSeeder::class,
            WarehouseCategorySeeder::class,
            SubscriptionSeeder::class,
            CountrySeeder::class,
            TaxSeeder::class,
            // BankSeeder::class
        ]);
    }
}
