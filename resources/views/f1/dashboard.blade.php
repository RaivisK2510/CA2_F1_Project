<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Stats Hub - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .f1-red { background-color: #e10600; }
        .f1-dark { background-color: #1a1a1a; }
    </style>
</head>
<body class="bg-gray-100">
    <nav class="f1-red text-white p-4 shadow-lg">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold">🏎️ F1 Stats Hub</h1>
        </div>
    </nav>

    <div class="container mx-auto p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-700">Total Drivers</h3>
                <p class="text-3xl font-bold f1-red text-white mt-2">{{ $stats['total_drivers'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-700">Total Teams</h3>
                <p class="text-3xl font-bold text-blue-600 mt-2">{{ $stats['total_teams'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-700">Total Circuits</h3>
                <p class="text-3xl font-bold text-green-600 mt-2">{{ $stats['total_circuits'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-700">Total Seasons</h3>
                <p class="text-3xl font-bold text-purple-600 mt-2">{{ $stats['total_seasons'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-700">Active Seasons</h3>
                <p class="text-3xl font-bold text-orange-600 mt-2">{{ $stats['active_seasons'] }}</p>
            </div>
        </div>

        <!-- Latest Data -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Latest Drivers -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold mb-4 text-gray-800">🏁 Latest Drivers</h2>
                <div class="space-y-3">
                    @forelse($latestDrivers as $driver)
                        <div class="border-l-4 f1-red pl-4 py-2">
                            <h4 class="font-semibold">{{ $driver->full_name }}</h4>
                            <p class="text-sm text-gray-600">
                                🏎️ {{ $driver->code }} | 🏆 {{ $driver->world_championships }} Championships | 🏁 {{ $driver->wins }} Wins
                            </p>
                        </div>
                    @empty
                        <p class="text-gray-500">No drivers found</p>
                    @endforelse
                </div>
            </div>

            <!-- Latest Teams -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold mb-4 text-gray-800">🏭 Latest Teams</h2>
                <div class="space-y-3">
                    @forelse($latestTeams as $team)
                        <div class="border-l-4 border-blue-500 pl-4 py-2">
                            <h4 class="font-semibold">{{ $team->name }}</h4>
                            <p class="text-sm text-gray-600">
                                🏁 {{ $team->race_wins }} Wins | 🏆 {{ $team->world_championships }} Championships | 🌍 {{ $team->country }}
                            </p>
                        </div>
                    @empty
                        <p class="text-gray-500">No teams found</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="mt-8 bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4 text-gray-800">🔗 Quick Navigation</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('f1.drivers') }}" class="bg-red-500 text-white p-4 rounded-lg text-center hover:bg-red-600 transition">
                    👨‍🏎️ View All Drivers
                </a>
                <a href="{{ route('f1.teams') }}" class="bg-blue-500 text-white p-4 rounded-lg text-center hover:bg-blue-600 transition">
                    🏭 View All Teams
                </a>
                <a href="{{ route('f1.circuits') }}" class="bg-green-500 text-white p-4 rounded-lg text-center hover:bg-green-600 transition">
                    🏁 View All Circuits
                </a>
                <a href="{{ route('f1.seasons') }}" class="bg-purple-500 text-white p-4 rounded-lg text-center hover:bg-purple-600 transition">
                    📅 View All Seasons
                </a>
            </div>
        </div>
    </div>
</body>
</html>
