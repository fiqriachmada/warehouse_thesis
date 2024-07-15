<?php

namespace Database\Seeders;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('level', 'tenant')->get();
        $faker = Faker::create();

        foreach ($users as $key => $tenant) {
            Tenant::create(
                [
                    'id' => Uuid::uuid4()->toString(),
                    'user_id' => $tenant->id,
                    'name' => 'Tenant 001',
                    'npwp' =>  $faker->numberBetween(1000000000000000, 9999999999999999),
                    'email' => $faker->unique()->safeEmail,
                    'phone' => $faker->phoneNumber,
                    'pob' => 'Surabaya',
                    'dob' => now(),
                    'gender' => 'male',
                    'address' => 'Jl. Arief Rahman Hakim No.100, Klampis Ngasem, Kec. Sukolilo, Surabaya, Jawa Timur 60117'
                ]
            );
        }
    }
}
