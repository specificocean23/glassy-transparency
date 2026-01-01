<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advocacy Campaigns - Transparency.ie</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50">
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">Transparency.ie</h1>
            <ul class="flex gap-6 text-sm">
                <li><a href="/" class="text-slate-700 hover:text-blue-600">Home</a></li>
                <li><a href="/technologies" class="text-slate-700 hover:text-blue-600">Technologies</a></li>
                <li><a href="/events" class="text-slate-700 hover:text-blue-600">Events</a></li>
                <li><a href="/case-studies" class="text-slate-700 hover:text-blue-600">Case Studies</a></li>
                <li><a href="/campaigns" class="text-blue-600 font-semibold">Campaigns</a></li>
            </ul>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <h2 class="text-3xl font-bold mb-8">Policy Change Campaigns</h2>
        <p class="text-slate-600 mb-8 max-w-2xl">Community-driven campaigns to accelerate Ireland's energy transition. Your voice matters.</p>

        <div class="space-y-6">
            @forelse($campaigns as $campaign)
            <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-orange-500">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold">{{ $campaign->title }}</h3>
                        <p class="text-slate-600 mt-2">{{ $campaign->goal }}</p>
                    </div>
                    <span class="px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-sm font-semibold">{{ ucfirst($campaign->status) }}</span>
                </div>

                @if($campaign->description)
                <p class="text-slate-700 mb-6">{{ $campaign->description }}</p>
                @endif

                <!-- Petition Progress Bar -->
                @if($campaign->petition_count && $campaign->target_signatures)
                <div class="mb-6">
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">Petition Signatures</span>
                        <span class="text-slate-600">{{ number_format($campaign->petition_count) }} / {{ number_format($campaign->target_signatures) }}</span>
                    </div>
                    <div class="w-full bg-slate-200 rounded-full h-4">
                        <div class="bg-gradient-to-r from-orange-400 to-red-500 h-4 rounded-full" style="width: {{ min(100, ($campaign->petition_count / $campaign->target_signatures) * 100) }}%"></div>
                    </div>
                    <p class="text-sm text-slate-600 mt-2">{{ round(($campaign->petition_count / $campaign->target_signatures) * 100) }}% complete</p>
                </div>
                @endif

                @if($campaign->call_to_action)
                <p class="text-sm text-slate-600 mb-4 bg-slate-50 p-3 rounded">
                    <strong>What you can do:</strong> {{ $campaign->call_to_action }}
                </p>
                @endif
            </div>
            @empty
            <div class="text-center py-12 bg-white rounded-lg">
                <p class="text-slate-500 text-lg">No active campaigns yet.</p>
            </div>
            @endforelse
        </div>
    </div>

    <footer class="bg-slate-900 text-white mt-12 py-8">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p>Transparency.ie - Making government spending visible, environmental impact tangible.</p>
        </div>
    </footer>
</body>
</html>
