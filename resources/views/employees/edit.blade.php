@extends('layouts.app')

@section('title', 'Edit Employee')

@section('content')

    <div class="max-w-2xl">

        <a href="{{ route('employees.index') }}"
            class="inline-flex items-center gap-2 text-sm text-[#6B7280] hover:text-[#1C2230] mb-6">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Employees
        </a>

        <div class="bg-white rounded-2xl border border-[#E4E1DA] p-8">

            <h2 class="font-display text-xl font-semibold mb-1">Edit Employee</h2>
            <p class="text-[#6B7280] text-sm mb-8">Update {{ $employee->name }}'s record below.</p>

            <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="space-y-5">

                @csrf
                @method('PUT')

                <div>
                    <label class="block mb-2 text-sm font-medium">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $employee->name) }}"
                        class="w-full border border-[#E4E1DA] rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1C2230]/10 focus:border-[#1C2230] @error('name') border-[#B4423F] @enderror">
                    @error('name')
                        <p class="mt-1.5 text-xs text-[#B4423F]">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium">Position</label>
                    <input type="text" name="position" value="{{ old('position', $employee->position) }}"
                        class="w-full border border-[#E4E1DA] rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1C2230]/10 focus:border-[#1C2230] @error('position') border-[#B4423F] @enderror">
                    @error('position')
                        <p class="mt-1.5 text-xs text-[#B4423F]">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Gender</label>
                        <select name="gender"
                            class="w-full border border-[#E4E1DA] rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1C2230]/10 focus:border-[#1C2230] @error('gender') border-[#B4423F] @enderror">
                            <option value="">Select</option>
                            <option {{ old('gender', $employee->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option {{ old('gender', $employee->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>
                        @error('gender')
                            <p class="mt-1.5 text-xs text-[#B4423F]">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium">Last Education</label>
                        <select name="last_education"
                            class="w-full border border-[#E4E1DA] rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1C2230]/10 focus:border-[#1C2230] @error('last_education') border-[#B4423F] @enderror">
                            <option value="">Select</option>
                            @foreach (['SMA/SMK', 'D3', 'S1', 'S2'] as $edu)
                                <option {{ old('last_education', $employee->last_education) == $edu ? 'selected' : '' }}>
                                    {{ $edu }}</option>
                            @endforeach
                        </select>
                        @error('last_education')
                            <p class="mt-1.5 text-xs text-[#B4423F]">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Birth Date</label>
                        <input type="date" name="birth_date"
                            value="{{ old('birth_date', \Carbon\Carbon::parse($employee->birth_date)->format('Y-m-d')) }}"
                            class="w-full border border-[#E4E1DA] rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1C2230]/10 focus:border-[#1C2230] @error('birth_date') border-[#B4423F] @enderror">
                        @error('birth_date')
                            <p class="mt-1.5 text-xs text-[#B4423F]">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium">Join Date</label>
                        <input type="date" name="join_date"
                            value="{{ old('join_date', \Carbon\Carbon::parse($employee->join_date)->format('Y-m-d')) }}"
                            class="w-full border border-[#E4E1DA] rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1C2230]/10 focus:border-[#1C2230] @error('join_date') border-[#B4423F] @enderror">
                        @error('join_date')
                            <p class="mt-1.5 text-xs text-[#B4423F]">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button
                        class="bg-[#1C2230] hover:bg-[#2A3142] text-white px-6 py-3 rounded-xl text-sm font-medium transition">
                        Update Employee
                    </button>
                    <a href="{{ route('employees.index') }}"
                        class="px-6 py-3 rounded-xl border border-[#E4E1DA] text-sm font-medium hover:bg-[#F6F5F1]">
                        Cancel
                    </a>
                </div>

            </form>

        </div>

    </div>

@endsection
