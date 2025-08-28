<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Agent;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agents = [
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@company.com',
                'phone' => '081234567895',
                'department' => 'Customer Support',
                'role' => 'Senior Agent',
                'skills' => 'Technical Support, Customer Service, Problem Solving',
                'languages' => 'Indonesian, English',
                'shift_schedule' => 'Morning Shift (8 AM - 4 PM)',
                'status' => 'Active',
                'hire_date' => '2023-01-15'
            ],
            [
                'name' => 'Joko Widodo',
                'email' => 'joko.widodo@company.com',
                'phone' => '081234567896',
                'department' => 'Customer Support',
                'role' => 'Supervisor',
                'skills' => 'Team Management, Customer Service, Escalation',
                'languages' => 'Indonesian, English',
                'shift_schedule' => 'Day Shift (9 AM - 6 PM)',
                'status' => 'Active',
                'hire_date' => '2022-06-01'
            ],
            [
                'name' => 'Maya Indira',
                'email' => 'maya.indira@company.com',
                'phone' => '081234567897',
                'department' => 'Technical Support',
                'role' => 'Junior Agent',
                'skills' => 'Technical Troubleshooting, Software Support',
                'languages' => 'Indonesian, English',
                'shift_schedule' => 'Afternoon Shift (2 PM - 10 PM)',
                'status' => 'Active',
                'hire_date' => '2024-03-01'
            ],
            [
                'name' => 'Agus Setiawan',
                'email' => 'agus.setiawan@company.com',
                'phone' => '081234567898',
                'department' => 'Billing Support',
                'role' => 'Senior Agent',
                'skills' => 'Billing, Payment Processing, Financial Support',
                'languages' => 'Indonesian, English',
                'shift_schedule' => 'Morning Shift (8 AM - 4 PM)',
                'status' => 'Active',
                'hire_date' => '2023-08-15'
            ]
        ];

        foreach ($agents as $agentData) {
            Agent::create($agentData);
        }
    }
}
