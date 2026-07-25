@extends('layouts.app')

@section('title', 'Employees')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h2 class="font-display text-2xl font-semibold">Employee Records</h2>
            <p class="text-[#6B7280] text-sm mt-1">{{ $employees->total() }} people on record</p>
        </div>

        <a href="{{ route('employees.create') }}"
            class="inline-flex items-center gap-2 bg-[#1C2230] text-white px-5 py-3 rounded-xl text-sm font-medium hover:bg-[#2A3142] transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Add Employee
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 flex items-center gap-3 bg-[#125D52]/10 text-[#125D52] px-4 py-3 rounded-xl text-sm font-medium">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('employees.index') }}" method="GET" class="mb-6">

        <input type="hidden" name="sort_field" value="{{ $sortField }}">
        <input type="hidden" name="sort_direction" value="{{ $sortDirection }}">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3">

            <div class="relative lg:col-span-4">
                <svg class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-[#6B7280]" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-4.35-4.35M17 11a6 6 0 1 1-12 0 6 6 0 0 1 12 0Z" />
                </svg>
                <input type="text" name="search" value="{{ $search }}" placeholder="Search by name or position..."
                    class="w-full border border-[#E4E1DA] rounded-xl pl-11 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1C2230]/10 focus:border-[#1C2230]">
            </div>

            <select name="gender" onchange="this.form.submit()"
                class="lg:col-span-2 w-full border border-[#E4E1DA] rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1C2230]/10 focus:border-[#1C2230] bg-white">
                <option value="">All Genders</option>
                <option value="Laki-laki" {{ $gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>

            <select name="education" onchange="this.form.submit()"
                class="lg:col-span-2 w-full border border-[#E4E1DA] rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1C2230]/10 focus:border-[#1C2230] bg-white">
                <option value="">All Education</option>
                @foreach (['SMA/SMK', 'D3', 'S1', 'S2'] as $edu)
                    <option value="{{ $edu }}" {{ $education == $edu ? 'selected' : '' }}>{{ $edu }}
                    </option>
                @endforeach
            </select>

            <select name="position" onchange="this.form.submit()"
                class="lg:col-span-2 w-full border border-[#E4E1DA] rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1C2230]/10 focus:border-[#1C2230] bg-white">
                <option value="">All Positions</option>
                @foreach ($positions as $pos)
                    <option value="{{ $pos }}" {{ $position == $pos ? 'selected' : '' }}>{{ $pos }}
                    </option>
                @endforeach
            </select>

            <div class="lg:col-span-2 flex gap-3">
                <button type="submit"
                    class="flex-1 bg-[#1C2230] text-white px-5 py-3 rounded-xl text-sm font-medium hover:bg-[#2A3142] transition">
                    Filter
                </button>

                <a href="{{ route('employees.index') }}"
                    class="flex-1 flex items-center justify-center px-5 py-3 rounded-xl border border-[#E4E1DA] text-sm font-medium hover:bg-[#F6F5F1] transition">
                    Reset
                </a>
            </div>

        </div>

    </form>

    <div class="bg-white rounded-2xl border border-[#E4E1DA] overflow-hidden">

        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-[#E4E1DA] text-left text-[#6B7280] uppercase text-xs tracking-wide">
                    <th class="px-6 py-4 font-medium">
                        <a href="{{ request()->fullUrlWithQuery(['sort_field' => 'name', 'sort_direction' => $sortField === 'name' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                            class="inline-flex items-center gap-1 hover:text-[#1C2230]">
                            Employee
                            @if ($sortField === 'name')
                                @if ($sortDirection === 'asc')
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5M5 12l7-7 7 7" />
                                    </svg>
                                @else
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M19 12l-7 7-7-7" />
                                    </svg>
                                @endif
                            @else
                                <svg class="w-3.5 h-3.5 text-[#C9C6BE]" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l4-4 4 4M8 15l4 4 4-4" />
                                </svg>
                            @endif
                        </a>
                    </th>

                    <th class="px-6 py-4 font-medium">Position</th>
                    <th class="px-6 py-4 font-medium">Gender</th>
                    <th class="px-6 py-4 font-medium">Education</th>

                    <th class="px-6 py-4 font-medium">
                        <a href="{{ request()->fullUrlWithQuery(['sort_field' => 'birth_date', 'sort_direction' => $sortField === 'birth_date' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                            class="inline-flex items-center gap-1 hover:text-[#1C2230]">
                            Birth Date
                            @if ($sortField === 'birth_date')
                                @if ($sortDirection === 'asc')
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5M5 12l7-7 7 7" />
                                    </svg>
                                @else
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 5v14M19 12l-7 7-7-7" />
                                    </svg>
                                @endif
                            @else
                                <svg class="w-3.5 h-3.5 text-[#C9C6BE]" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l4-4 4 4M8 15l4 4 4-4" />
                                </svg>
                            @endif
                        </a>
                    </th>

                    <th class="px-6 py-4 font-medium">
                        <a href="{{ request()->fullUrlWithQuery(['sort_field' => 'join_date', 'sort_direction' => $sortField === 'join_date' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                            class="inline-flex items-center gap-1 hover:text-[#1C2230]">
                            Join Date
                            @if ($sortField === 'join_date')
                                @if ($sortDirection === 'asc')
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5M5 12l7-7 7 7" />
                                    </svg>
                                @else
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 5v14M19 12l-7 7-7-7" />
                                    </svg>
                                @endif
                            @else
                                <svg class="w-3.5 h-3.5 text-[#C9C6BE]" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l4-4 4 4M8 15l4 4 4-4" />
                                </svg>
                            @endif
                        </a>
                    </th>

                    <th class="px-6 py-4 font-medium text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($employees as $employee)
                    @php
                        $initials = collect(explode(' ', $employee->name))
                            ->map(fn($n) => strtoupper($n[0] ?? ''))
                            ->take(2)
                            ->join('');
                        $isMale = $employee->gender === 'Laki-laki';
                    @endphp

                    <tr class="border-b border-[#E4E1DA] last:border-0 hover:bg-[#F6F5F1]/60 transition">

                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full flex items-center justify-center font-display font-semibold text-sm text-white shrink-0
                            {{ $isMale ? 'bg-[#125D52]' : 'bg-[#B8862B]' }}">
                                    {{ $initials }}
                                </div>
                                <div>
                                    <p class="font-medium">{{ $employee->name }}</p>
                                    <p class="text-xs text-[#6B7280] font-mono">
                                        ID-{{ str_pad($employee->id, 4, '0', STR_PAD_LEFT) }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-[#374151]">{{ $employee->position }}</td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                        {{ $isMale ? 'bg-[#125D52]/10 text-[#125D52]' : 'bg-[#B8862B]/10 text-[#B8862B]' }}">
                                {{ $employee->gender }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-[#374151]">{{ $employee->last_education }}</td>

                        <td class="px-6 py-4 font-mono text-[#374151]">
                            {{ \Carbon\Carbon::parse($employee->birth_date)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4 font-mono text-[#374151]">
                            {{ \Carbon\Carbon::parse($employee->join_date)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-4">
                                <a href="{{ route('employees.edit', $employee->id) }}"
                                    class="text-[#374151] hover:text-[#1C2230] font-medium text-sm">
                                    Edit
                                </a>

                                <button type="button"
                                    onclick="openDeleteModal('{{ $employee->id }}', '{{ addslashes($employee->name) }}')"
                                    class="text-[#B4423F] hover:text-[#8f312e] font-medium text-sm">
                                    Delete
                                </button>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-16">
                            @if ($search || $gender || $education || $position)
                                <p class="text-[#6B7280]">No employees match your filters.</p>
                                <a href="{{ route('employees.index') }}"
                                    class="text-[#125D52] font-medium text-sm hover:underline">
                                    Clear filters
                                </a>
                            @else
                                <p class="text-[#6B7280]">No employee data yet.</p>
                                <a href="{{ route('employees.create') }}"
                                    class="text-[#125D52] font-medium text-sm hover:underline">
                                    Add your first employee
                                </a>
                            @endif
                        </td>
                    </tr>
                @endempty
        </tbody>
    </table>

</div>

@if ($employees->hasPages())
    <div class="mt-6">
        {{ $employees->links() }}
    </div>
@endif

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 px-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm p-6">

        <div class="w-12 h-12 rounded-full bg-[#B4423F]/10 flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-[#B4423F]" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19 7l-.867 12.142A2 2 0 0 1 16.138 21H7.862a2 2 0 0 1-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3M4 7h16" />
            </svg>
        </div>

        <h3 class="font-display text-lg font-semibold mb-1">Delete employee?</h3>
        <p class="text-[#6B7280] text-sm mb-6">
            <span id="deleteName" class="font-medium text-[#1C2230]"></span> will be permanently removed from your
            records. This can't be undone.
        </p>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex gap-3">
                <button type="button" onclick="closeDeleteModal()"
                    class="flex-1 px-4 py-3 rounded-xl border border-[#E4E1DA] text-sm font-medium hover:bg-[#F6F5F1]">
                    Cancel
                </button>

                <button type="submit"
                    class="flex-1 px-4 py-3 rounded-xl bg-[#B4423F] text-white text-sm font-medium hover:bg-[#8f312e]">
                    Delete
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openDeleteModal(id, name) {
        document.getElementById('deleteName').innerText = name;
        document.getElementById('deleteForm').action = `/employees/${id}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>

@endsection
