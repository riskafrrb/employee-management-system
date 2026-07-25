<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = Employee::count();

        $genderCounts = [
            'Laki-laki' => Employee::where('gender', 'Laki-laki')->count(),
            'Perempuan' => Employee::where('gender', 'Perempuan')->count(),
        ];

        $educationCounts = Employee::selectRaw('last_education, count(*) as total')
            ->groupBy('last_education')
            ->pluck('total', 'last_education');

        $ageBuckets = [
            '< 25'    => 0,
            '25 - 34' => 0,
            '35 - 44' => 0,
            '45 - 54' => 0,
            '55+'     => 0,
        ];

        $ages = [];

        $newThisMonth = Employee::whereMonth('join_date', now()->month)
            ->whereYear('join_date', now()->year)
            ->count();

        foreach (Employee::pluck('birth_date') as $birthDate) {
            $age = Carbon::parse($birthDate)->age;
            $ages[] = $age;

            if ($age < 25) {
                $ageBuckets['< 25']++;
            } elseif ($age < 35) {
                $ageBuckets['25 - 34']++;
            } elseif ($age < 45) {
                $ageBuckets['35 - 44']++;
            } elseif ($age < 55) {
                $ageBuckets['45 - 54']++;
            } else {
                $ageBuckets['55+']++;
            }
        }

        $averageAge = count($ages) > 0 ? round(array_sum($ages) / count($ages)) : 0;

        $latestEmployees = Employee::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalEmployees',
            'genderCounts',
            'educationCounts',
            'ageBuckets',
            'averageAge',
            'newThisMonth',
            'latestEmployees'
        ));
    }
}
