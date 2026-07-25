<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            [
                'name' => 'Ahmad Fauzan',
                'position' => 'Staff IT',
                'gender' => 'Laki-laki',
                'last_education' => 'S1',
                'birth_date' => '1998-03-12',
                'join_date' => now()->subDays(5),
            ],
            [
                'name' => 'Siti Nurhaliza',
                'position' => 'Staff Marketing',
                'gender' => 'Perempuan',
                'last_education' => 'S1',
                'birth_date' => '1995-07-24',
                'join_date' => now()->subDays(12),
            ],
            [
                'name' => 'Budi Santoso',
                'position' => 'Backend Developer',
                'gender' => 'Laki-laki',
                'last_education' => 'S1',
                'birth_date' => '1990-11-02',
                'join_date' => '2021-02-15',
            ],
            [
                'name' => 'Dewi Anggraini',
                'position' => 'UI/UX Designer',
                'gender' => 'Perempuan',
                'last_education' => 'D3',
                'birth_date' => '2000-01-18',
                'join_date' => '2023-06-01',
            ],
            [
                'name' => 'Rizky Pratama',
                'position' => 'Frontend Developer',
                'gender' => 'Laki-laki',
                'last_education' => 'S1',
                'birth_date' => '1999-09-05',
                'join_date' => now()->subDays(20),
            ],
            [
                'name' => 'Putri Wulandari',
                'position' => 'HR Staff',
                'gender' => 'Perempuan',
                'last_education' => 'S1',
                'birth_date' => '1993-04-27',
                'join_date' => '2020-08-10',
            ],
            [
                'name' => 'Eko Prasetyo',
                'position' => 'Office Boy',
                'gender' => 'Laki-laki',
                'last_education' => 'SMA/SMK',
                'birth_date' => '1985-12-15',
                'join_date' => '2018-01-20',
            ],
            [
                'name' => 'Ratna Sari',
                'position' => 'Finance Staff',
                'gender' => 'Perempuan',
                'last_education' => 'S1',
                'birth_date' => '1997-06-30',
                'join_date' => '2022-03-14',
            ],
            [
                'name' => 'Doni Kusuma',
                'position' => 'System Analyst',
                'gender' => 'Laki-laki',
                'last_education' => 'S2',
                'birth_date' => '1988-02-08',
                'join_date' => '2019-11-05',
            ],
            [
                'name' => 'Fitriani Lestari',
                'position' => 'Admin Staff',
                'gender' => 'Perempuan',
                'last_education' => 'SMA/SMK',
                'birth_date' => '2001-10-22',
                'join_date' => now()->subDays(2),
            ],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}
