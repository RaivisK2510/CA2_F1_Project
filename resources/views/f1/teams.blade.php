<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Teams - F1 Stats Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-red-600 text-white p-4 shadow-lg">
        <div class="container mx-auto">
            <a href="{{ route('f1.dashboard') }}" class="text-2xl font-bold">🏎️ F1 Stats Hub</a>
        </div>
    </nav>

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">🏭 F1 Teams</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($teams as $team)
                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-600 text-white rounded-lg w-12 h-12 flex items-center justify-center font-bold mr-4">
                            {{ $team->code }}
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">{{ $team->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $team->full_name }}</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 text-sm mb-4">
                        <div class="bg-gray-100 p-2 rounded">
                            <span class="font-semibold">🏆 Championships:</span> {{ $team->world_championships }}
                        </div>
                        <div class="bg-gray-100 p-2 rounded">
                            <span class="font-semibold">🏁 Wins:</span> {{ $team->race_wins }}
                        </div>
                        <div class="bg-gray-100 p-2 rounded">
                            <span class="font-semibold">🥈 Podiums:</span> {{ $team->podiums }}
                        </div>
                        <div class="bg-gray-100 p-2 rounded">
                            <span class="font-semibold">🚀 Poles:</span> {{ $team->pole_positions }}
                        </div>
                    </div>
                    
                    <div class="border-t pt-4">
                        <h4 class="font-semibold mb-2">Team Details:</h4>
                        <div class="text-sm text-gray-600 space-y-1">
                            <p>🌍 {{ $team->country }} | 🏢 {{ $team->headquarters }}</p>
                            <p>👨‍💼 {{ $team->team_chief }} | 🔧 {{ $team->technical_chief }}</p>
                            <p>🏎️ {{ $team->chassis }} | ⚡ {{ $team->power_unit }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">No teams found</p>
            @endforelse
        </div>
    </div>
</body>
</html>
