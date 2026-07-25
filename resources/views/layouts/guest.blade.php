<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') · Employee Management</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .font-display {
            font-family: 'Space Grotesk', sans-serif;
        }
    </style>
</head>

<body class="bg-[#F6F5F1] text-[#1C2230] min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md">

        <div class="flex items-center justify-center gap-3 mb-8">
            <div class="w-10 h-10 rounded-lg bg-[#1C2230] flex items-center justify-center">
                <span class="font-display font-bold text-sm text-[#B8862B]">EM</span>
            </div>
            <div>
                <p class="font-display font-semibold leading-tight">Employee</p>
                <p class="text-xs text-[#6B7280] leading-tight">Management System</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-[#E4E1DA] p-8">
            @yield('content')
        </div>

    </div>

</body>

</html>
