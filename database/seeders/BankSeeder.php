<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $user = User::where('attribute', 'core')->first();

        $banks = [
            [
                'id' => Uuid::uuid4()->toString(),
                'user_id' => $user->id,
                'account_holder_name' => 'Mohamad Raihan Farras',
                'bank_account_number' => '0917272783',
                'bank_name' => 'BCA',
                'status' => 'primary'
            ]
        ];

        foreach ($banks as $key => $bank) {
            Bank::create($bank);
        }
    }
}
