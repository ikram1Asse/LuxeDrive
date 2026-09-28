<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
class EmployeesSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            [
                'name' => 'Hassan El Amrani',
                'email' => 'hassan.elamrani@example.com',
                'phone' => '0611111111',
                'role' => 'employee',
                'job_title' => 'Salesperson',
                'hired_at' => '2022-05-15',
                'password' => 'employee123456',
            ],
            [
                'name' => 'Sara Benjelloun',
                'email' => 'sara.benjelloun@example.com',
                'phone' => '0622222222',
                'role' => 'employee',
                'job_title' => 'Advisor',
                'hired_at' => '2021-11-01',
                'password' => 'employee123456',
            ],
            [
                'name' => 'Yassine Kettani',
                'email' => 'yassine.kettani@example.com',
                'phone' => '0633333333',
                'role' => 'employee',
                'job_title' => 'Manager',
                'hired_at' => '2020-09-10',
                'password' => 'employee123456',
            ],
        ];

        foreach ($employees as $data) {
            User::updateOrCreate(['email' => $data['email']], $data);
        }
    }
}
