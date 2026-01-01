<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Energy Storage Technologies - Transparency.ie</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50">
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">Transparency.ie</h1>
            <ul class="flex gap-6 text-sm">
                <li><a href="/" class="text-slate-700 hover:text-blue-600">Home</a></li>
                <li><a href="/technologies" class="text-blue-600 font-semibold">Technologies</a></li>
                <li><a href="/events" class="text-slate-700 hover:text-blue-600">Events</a></li>
                <li><a href="/case-studies" class="text-slate-700 hover:text-blue-600">Case Studies</a></li>
                <li><a href="/campaigns" class="text-slate-700 hover:text-blue-600">Campaigns</a></li>
            </ul>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <h2 class="text-3xl font-bold mb-8">Energy Storage Technologies</h2>
        <p class="text-slate-600 mb-8 max-w-2xl">Compare different energy storage solutions for Ireland's renewable transition. Each technology has distinct characteristics suited to different applications and timeframes.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @forelse($technologies as $tech)
            <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-blue-600">
                <h3 class="text-xl font-bold mb-2">{{ $tech->name }}</h3>
                <p class="text-sm text-slate-500 mb-4">{{ $tech->category }}</p>

                <div class="grid grid-cols-3 gap-4 mb-6 py-4 bg-slate-50 rounded px-4">
                    <div>
                        <p class="text-xs text-slate-600">Cost/kWh</p>
                        <p class="text-lg font-bold text-blue-600">€{{ number_format($tech->cost_per_kwh) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-600">Lifespan</p>
                        <p class="text-lg font-bold">{{ $tech->lifespan_years }} yrs</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-600">Efficiency</p>
                        <p class="text-lg font-bold">{{ $tech->efficiency_percent }}%</p>
                    </div>
                </div>

                @if($tech->description)
                <p class="text-sm text-slate-700 mb-4">{{ $tech->description }}</p>
                @endif

                <div class="space-y-3 text-sm">
                    @if($tech->advantages)
                    <div>
                        <p class="font-semibold text-green-700">Advantages:</p>
                        <p class="text-slate-600">{{ substr($tech->advantages, 0, 100) }}...</p>
                    </div>
                    @endif

                    @if($tech->irish_applications)
                    <div>
                        <p class="font-semibold text-blue-700">Irish Applications:</p>
                        <p class="text-slate-600">{{ substr($tech->irish_applications, 0, 100) }}...</p>
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-2 text-center py-12">
                <p class="text-slate-500">No technologies available yet.</p>
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
