<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Environmental Metrics - Transparency.ie</title>
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
                <li><a href="/campaigns" class="text-slate-700 hover:text-blue-600">Campaigns</a></li>
            </ul>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <h2 class="text-3xl font-bold mb-8">Environmental Metrics</h2>
        <p class="text-slate-600 mb-8 max-w-2xl">Key environmental indicators tracking Ireland's progress toward carbon neutrality by 2050.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($metrics as $metric)
            <div class="bg-white rounded-lg shadow-lg p-6 border-t-4 border-green-500">
                <h3 class="text-lg font-bold mb-1">{{ $metric->title }}</h3>
                <p class="text-sm text-slate-500 mb-4">{{ $metric->metric_type }}</p>

                <div class="py-4 bg-gradient-to-r from-green-50 to-blue-50 rounded px-4 mb-4">
                    <p class="text-4xl font-bold text-green-600">{{ number_format($metric->value) }}</p>
                    <p class="text-sm text-slate-600 mt-1">{{ $metric->unit }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                    @if($metric->region)
                    <div>
                        <p class="text-slate-600">Region</p>
                        <p class="font-semibold">{{ $metric->region }}</p>
                    </div>
                    @endif
                    @if($metric->reference_year)
                    <div>
                        <p class="text-slate-600">Reference Year</p>
                        <p class="font-semibold">{{ $metric->reference_year }}</p>
                    </div>
                    @endif
                </div>

                @if($metric->data_source)
                <p class="text-xs text-slate-500 border-t pt-3">
                    <strong>Source:</strong> {{ $metric->data_source }}
                </p>
                @endif

                @if($metric->description)
                <p class="text-sm text-slate-700 mt-3">{{ $metric->description }}</p>
                @endif
            </div>
            @empty
            <div class="col-span-2 text-center py-12 bg-white rounded-lg">
                <p class="text-slate-500 text-lg">No featured metrics available yet.</p>
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
