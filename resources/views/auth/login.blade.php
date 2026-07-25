@extends('layouts.guest')

@section('title', 'Login')

@section('content')

    <h2 class="font-display text-xl font-semibold mb-1">Welcome back</h2>
    <p class="text-[#6B7280] text-sm mb-8">Sign in to access the employee dashboard.</p>

    <form action="{{ route('login') }}" method="POST" class="space-y-5">

        @csrf

        <div>
            <label class="block mb-2 text-sm font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@company.com"
                class="w-full border border-[#E4E1DA] rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1C2230]/10 focus:border-[#1C2230] @error('email') border-[#B4423F] @enderror">
            @error('email')
                <p class="mt-1.5 text-xs text-[#B4423F]">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium">Password</label>
            <input type="password" name="password" placeholder="••••••••"
                class="w-full border border-[#E4E1DA] rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1C2230]/10 focus:border-[#1C2230] @error('password') border-[#B4423F] @enderror">
            @error('password')
                <p class="mt-1.5 text-xs text-[#B4423F]">{{ $message }}</p>
            @enderror
        </div>

        <label class="flex items-center gap-2 text-sm text-[#6B7280]">
            <input type="checkbox" name="remember" class="rounded border-[#E4E1DA]">
            Remember me
        </label>

        <button
            class="w-full bg-[#1C2230] hover:bg-[#2A3142] text-white px-6 py-3 rounded-xl text-sm font-medium transition">
            Sign In
        </button>

    </form>


@endsection
