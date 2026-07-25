@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="mb-8">
        <h2 class="font-display text-2xl font-semibold">Overview</h2>
        <p class="text-[#6B7280] text-sm mt-1">A snapshot of your workforce composition.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 mb-8">

        <div class="bg-white rounded-2xl border border-[#E4E1DA] p-6">
            <p class="text-xs text-[#6B7280] uppercase tracking-wide mb-2">Total Employees</p>
            <p class="font-display text-3xl font-semibold">{{ $totalEmployees }}</p>
        </div>

        <div class="bg-white rounded-2xl border border-[#E4E1DA] p-6">
            <p class="text-xs text-[#6B7280] uppercase tracking-wide mb-2">Laki-laki</p>
            <p class="font-display text-3xl font-semibold text-[#125D52]">{{ $genderCounts['Laki-laki'] }}</p>
        </div>

        <div class="bg-white rounded-2xl border border-[#E4E1DA] p-6">
            <p class="text-xs text-[#6B7280] uppercase tracking-wide mb-2">Perempuan</p>
            <p class="font-display text-3xl font-semibold text-[#B8862B]">{{ $genderCounts['Perempuan'] }}</p>
        </div>

        <div class="bg-white rounded-2xl border border-[#E4E1DA] p-6">
            <p class="text-xs text-[#6B7280] uppercase tracking-wide mb-2">Average Age</p>
            <p class="font-display text-3xl font-semibold">{{ $averageAge }} <span
                    class="text-base font-normal text-[#6B7280]">yrs</span></p>
        </div>

        <div class="bg-white rounded-2xl border border-[#E4E1DA] p-6">
            <p class="text-xs text-[#6B7280] uppercase tracking-wide mb-2">New This Month</p>
            <p class="font-display text-3xl font-semibold text-[#125D52]">{{ $newThisMonth }}</p>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

        <div class="bg-white rounded-2xl border border-[#E4E1DA] p-6">
            <h3 class="font-display font-semibold mb-4">Gender Distribution</h3>
            <div class="max-w-[260px] mx-auto">
                <canvas id="genderChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-[#E4E1DA] p-6">
            <h3 class="font-display font-semibold mb-4">Last Education</h3>
            <canvas id="educationChart"></canvas>
        </div>

    </div>

    <div class="bg-white rounded-2xl border border-[#E4E1DA] p-6 mb-8">
        <h3 class="font-display font-semibold mb-4">Age Distribution</h3>
        <canvas id="ageChart"></canvas>
    </div>

    <div class="bg-white rounded-2xl border border-[#E4E1DA] overflow-hidden">
        <div class="px-6 py-4 border-b border-[#E4E1DA] flex items-center justify-between">
            <h3 class="font-display font-semibold">Recently Added</h3>
            <a href="{{ route('employees.index') }}" class="text-sm text-[#125D52] font-medium hover:underline">View all</a>
        </div>

        <table class="w-full text-sm">
            <tbody>
                @forelse($latestEmployees as $employee)
                    <tr class="border-b border-[#E4E1DA] last:border-0">
                        <td class="px-6 py-4 font-medium">{{ $employee->name }}</td>
                        <td class="px-6 py-4 text-[#6B7280]">{{ $employee->position }}</td>
                        <td class="px-6 py-4 text-[#6B7280]">{{ $employee->gender }}</td>
                        <td class="px-6 py-4 text-[#6B7280]">{{ $employee->last_education }}</td>
                        <td class="px-6 py-4 text-[#6B7280] font-mono">
                            {{ \Carbon\Carbon::parse($employee->birth_date)->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-6 py-8 text-center text-[#6B7280]">No employees added yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
    <script>
        new Chart(document.getElementById('genderChart'), {
            type: 'doughnut',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [{{ $genderCounts['Laki-laki'] }}, {{ $genderCounts['Perempuan'] }}],
                    backgroundColor: ['#125D52', '#B8862B'],
                    borderWidth: 0,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                cutout: '65%',
            }
        });

        new Chart(document.getElementById('educationChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($educationCounts->keys()) !!},
                datasets: [{
                    data: {!! json_encode($educationCounts->values()) !!},
                    backgroundColor: '#1C2230',
                    borderRadius: 6,
                    maxBarThickness: 40,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        new Chart(document.getElementById('ageChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($ageBuckets)) !!},
                datasets: [{
                    data: {!! json_encode(array_values($ageBuckets)) !!},
                    backgroundColor: '#125D52',
                    borderRadius: 6,
                    maxBarThickness: 50,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>

@endsection
