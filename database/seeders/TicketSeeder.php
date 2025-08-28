<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\Customer;
use App\Models\Agent;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();
        $agents = Agent::all();

        $tickets = [
            [
                'customer_id' => $customers->first()->id,
                'subject' => 'Produk rusak saat dibuka',
                'description' => 'Saya baru saja membeli produk ABC dan saat dibuka sudah rusak. Mohon bantuan untuk penggantian atau refund.',
                'priority' => 'High',
                'status' => 'Open',
                'category' => 'Product Issue',
                'subcategory' => 'Damaged Product',
                'source' => 'Chat',
                'sentiment_score' => -0.6
            ],
            [
                'customer_id' => $customers->get(1)->id,
                'subject' => 'Informasi tentang layanan premium',
                'description' => 'Saya ingin tahu lebih detail tentang layanan premium yang ditawarkan. Apa saja benefitnya?',
                'priority' => 'Medium',
                'status' => 'Open',
                'category' => 'Inquiry',
                'subcategory' => 'Service Information',
                'source' => 'Email',
                'sentiment_score' => 0.3
            ],
            [
                'customer_id' => $customers->get(2)->id,
                'subject' => 'Masalah dengan billing bulanan',
                'description' => 'Tagihan bulanan saya tidak sesuai dengan yang seharusnya. Ada biaya tambahan yang tidak jelas.',
                'priority' => 'Urgent',
                'status' => 'In Progress',
                'category' => 'Billing Issue',
                'subcategory' => 'Incorrect Charges',
                'source' => 'Phone',
                'assigned_agent_id' => $agents->where('department', 'Billing Support')->first()->id,
                'sentiment_score' => -0.8
            ],
            [
                'customer_id' => $customers->get(3)->id,
                'subject' => 'Tidak bisa login ke aplikasi',
                'description' => 'Saya sudah mencoba login berkali-kali tapi selalu gagal. Password sudah benar.',
                'priority' => 'High',
                'status' => 'In Progress',
                'category' => 'Technical Issue',
                'subcategory' => 'Login Problem',
                'source' => 'Chat',
                'assigned_agent_id' => $agents->where('department', 'Technical Support')->first()->id,
                'sentiment_score' => -0.4
            ],
            [
                'customer_id' => $customers->get(4)->id,
                'subject' => 'Pertanyaan tentang fitur baru',
                'description' => 'Saya melihat ada fitur baru di aplikasi. Bagaimana cara menggunakannya?',
                'priority' => 'Low',
                'status' => 'Resolved',
                'category' => 'Inquiry',
                'subcategory' => 'Feature Guide',
                'source' => 'Chat',
                'sentiment_score' => 0.5,
                'resolved_at' => now()->subHours(2)
            ]
        ];

        foreach ($tickets as $ticketData) {
            Ticket::create($ticketData);
        }
    }
}
