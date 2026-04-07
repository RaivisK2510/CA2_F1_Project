<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Seasons - F1 Stats Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-red-600 text-white p-4 shadow-lg">
        <div class="container mx-auto">
            <a href="{{ route('f1.dashboard') }}" class="text-2xl font-bold">🏎️ F1 Stats Hub</a>
        </div>
    </nav>

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">📅 F1 Seasons</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($seasons as $season)
                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
                    <div class="mb-4">
                        <h3 class="text-2xl font-bold text-red-600">{{ $season->year }}</h3>
                        <p class="text-sm text-gray-600">{{ $season->description }}</p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 text-sm mb-4">
                        <div class="bg-gray-100 p-2 rounded">
                            <span class="font-semibold">🏁 Total Races:</span> {{ $season->total_races }}
                        </div>
                        <div class="bg-gray-100 p-2 rounded">
                            <span class="font-semibold">✅ Completed:</span> {{ $season->completed_races }}
                        </div>
                        <div class="bg-gray-100 p-2 rounded">
                            <span class="font-semibold">📊 Progress:</span> {{ $season->completion_percentage }}%
                        </div>
                        <div class="bg-gray-100 p-2 rounded">
                            <span class="font-semibold">📅 Status:</span> 
                            @if($season->is_active)
                                <span class="text-green-600 font-semibold">Active</span>
                            @else
                                <span class="text-gray-600">Completed</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="border-t pt-4">
                        <h4 class="font-semibold mb-2">Champions:</h4>
                        <div class="text-sm text-gray-600 space-y-1">
                            @if($season->championDriver)
                                <p>👨‍🏎️ Driver: {{ $season->championDriver->full_name }}</p>
                            @endif
                            @if($season->championTeam)
                                <p>🏭 Team: {{ $season->championTeam->name }}</p>
                            @endif
                            <p>📅 {{ $season->start_date->format('M d, Y') }} - {{ $season->end_date->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">No seasons found</p>
            @endforelse
        </div>
    </div>
</body>
</html>
