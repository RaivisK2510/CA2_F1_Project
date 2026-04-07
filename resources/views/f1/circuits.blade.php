<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Circuits - F1 Stats Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-red-600 text-white p-4 shadow-lg">
        <div class="container mx-auto">
            <a href="{{ route('f1.dashboard') }}" class="text-2xl font-bold">🏎️ F1 Stats Hub</a>
        </div>
    </nav>

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">🏁 F1 Circuits</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($circuits as $circuit)
                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
                    <div class="mb-4">
                        <h3 class="text-xl font-bold">{{ $circuit->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $circuit->full_name }}</p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 text-sm mb-4">
                        <div class="bg-gray-100 p-2 rounded">
                            <span class="font-semibold">🌍 Country:</span> {{ $circuit->country }}
                        </div>
                        <div class="bg-gray-100 p-2 rounded">
                            <span class="font-semibold">🏙️ City:</span> {{ $circuit->city }}
                        </div>
                        <div class="bg-gray-100 p-2 rounded">
                            <span class="font-semibold">📏 Length:</span> {{ $circuit->length_km }} km
                        </div>
                        <div class="bg-gray-100 p-2 rounded">
                            <span class="font-semibold">🔄 Corners:</span> {{ $circuit->corners }}
                        </div>
                    </div>
                    
                    <div class="border-t pt-4">
                        <h4 class="font-semibold mb-2">Circuit Info:</h4>
                        <div class="text-sm text-gray-600 space-y-1">
                            <p>🏁 First GP: {{ $circuit->first_grand_prix }} | 🏆 Races: {{ $circuit->races_held }}</p>
                            <p>🔄 Direction: {{ $circuit->direction }} | 🚀 DRS Zones: {{ $circuit->drs_zones }}</p>
                            @if($circuit->lap_record_driver)
                                <p>🏃 Lap Record: {{ $circuit->lap_record_time }} by {{ $circuit->lap_record_driver }} ({{ $circuit->lap_record_year }})</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">No circuits found</p>
            @endforelse
        </div>
    </div>
</body>
</html>
