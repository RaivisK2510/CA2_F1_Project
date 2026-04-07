<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Drivers - F1 Stats Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-red-600 text-white p-4 shadow-lg">
        <div class="container mx-auto">
            <a href="{{ route('f1.dashboard') }}" class="text-2xl font-bold">🏎️ F1 Stats Hub</a>
        </div>
    </nav>

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">👨‍🏎️ F1 Drivers</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($drivers as $driver)
                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
                    <div class="flex items-center mb-4">
                        <div class="bg-red-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold mr-4">
                            {{ $driver->code }}
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">{{ $driver->full_name }}</h3>
                            <p class="text-sm text-gray-600">#{{ $driver->driver_number }} | {{ $driver->nationality }}</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <div class="bg-gray-100 p-2 rounded">
                            <span class="font-semibold">🏆 Championships:</span> {{ $driver->world_championships }}
                        </div>
                        <div class="bg-gray-100 p-2 rounded">
                            <span class="font-semibold">🏁 Wins:</span> {{ $driver->wins }}
                        </div>
                        <div class="bg-gray-100 p-2 rounded">
                            <span class="font-semibold">🥈 Podiums:</span> {{ $driver->podiums }}
                        </div>
                        <div class="bg-gray-100 p-2 rounded">
                            <span class="font-semibold">📊 Points:</span> {{ $driver->career_points }}
                        </div>
                    </div>
                    
                    <div class="mt-4 text-xs text-gray-500">
                        🎂 {{ $driver->date_of_birth->format('Y-m-d') }} | 🏁 Debut: {{ $driver->debut_year->format('Y') }}
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">No drivers found</p>
            @endforelse
        </div>
    </div>
</body>
</html>
