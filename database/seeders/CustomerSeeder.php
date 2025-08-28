<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'name' => 'Ahmad Rizki',
                'email' => 'ahmad.rizki@email.com',
                'phone' => '081234567890',
                'address' => 'Jl. Sudirman No. 123',
                'city' => 'Jakarta',
                'state' => 'DKI Jakarta',
                'postal_code' => '12190',
                'country' => 'Indonesia',
                'customer_type' => 'VIP',
                'status' => 'Active',
                'communication_preference' => 'Email'
            ],
            [
                'name' => 'Sarah Putri',
                'email' => 'sarah.putri@email.com',
                'phone' => '081234567891',
                'address' => 'Jl. Thamrin No. 45',
                'city' => 'Jakarta',
                'state' => 'DKI Jakarta',
                'postal_code' => '10350',
                'country' => 'Indonesia',
                'customer_type' => 'Regular',
                'status' => 'Active',
                'communication_preference' => 'SMS'
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@email.com',
                'phone' => '081234567892',
                'address' => 'Jl. Gatot Subroto No. 67',
                'city' => 'Jakarta',
                'state' => 'DKI Jakarta',
                'postal_code' => '12930',
                'country' => 'Indonesia',
                'customer_type' => 'Premium',
                'status' => 'Active',
                'communication_preference' => 'Phone'
            ],
            [
                'name' => 'Dewi Sari',
                'email' => 'dewi.sari@email.com',
                'phone' => '081234567893',
                'address' => 'Jl. Rasuna Said No. 89',
                'city' => 'Jakarta',
                'state' => 'DKI Jakarta',
                'postal_code' => '12950',
                'country' => 'Indonesia',
                'customer_type' => 'New',
                'status' => 'Active',
                'communication_preference' => 'Email'
            ],
            [
                'name' => 'Rudi Hermawan',
                'email' => 'rudi.hermawan@email.com',
                'phone' => '081234567894',
                'address' => 'Jl. Kuningan No. 12',
                'city' => 'Jakarta',
                'state' => 'DKI Jakarta',
                'postal_code' => '12940',
                'country' => 'Indonesia',
                'customer_type' => 'Regular',
                'status' => 'Active',
                'communication_preference' => 'SMS'
            ]
        ];

        foreach ($customers as $customerData) {
            Customer::create($customerData);
        }
    }
}
