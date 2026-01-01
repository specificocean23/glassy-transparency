<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Case Studies - Transparency.ie</title>
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
                <li><a href="/case-studies" class="text-blue-600 font-semibold">Case Studies</a></li>
                <li><a href="/campaigns" class="text-slate-700 hover:text-blue-600">Campaigns</a></li>
            </ul>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <h2 class="text-3xl font-bold mb-8">Irish Renewable Energy Success Stories</h2>
        <p class="text-slate-600 mb-8 max-w-2xl">Learn from real projects showing Ireland's path to 80% renewable electricity by 2030.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @forelse($caseStudies as $case)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-green-500 h-2"></div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">{{ $case->title }}</h3>
                    @if($case->location)
                    <p class="text-sm text-slate-500 mb-4">📍 {{ $case->location }}</p>
                    @endif

                    @if($case->summary)
                    <p class="text-slate-700 mb-6">{{ $case->summary }}</p>
                    @endif

                    <div class="grid grid-cols-2 gap-4 mb-6 py-4 bg-slate-50 rounded px-4">
                        @if($case->jobs_created)
                        <div>
                            <p class="text-xs text-slate-600">Jobs Created</p>
                            <p class="text-lg font-bold text-blue-600">{{ number_format($case->jobs_created) }}</p>
                        </div>
                        @endif

                        @if($case->investment)
                        <div>
                            <p class="text-xs text-slate-600">Investment</p>
                            <p class="text-lg font-bold">€{{ number_format($case->investment / 1000000, 1) }}B</p>
                        </div>
                        @endif

                        @if($case->co2_reduced)
                        <div>
                            <p class="text-xs text-slate-600">CO2 Avoided</p>
                            <p class="text-lg font-bold text-green-600">{{ number_format($case->co2_reduced) }}t</p>
                        </div>
                        @endif
                    </div>

                    @if($case->full_content)
                    <details class="text-sm">
                        <summary class="cursor-pointer font-semibold text-blue-600 hover:text-blue-700">Read more</summary>
                        <p class="mt-3 text-slate-700">{{ $case->full_content }}</p>
                    </details>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-2 text-center py-12 bg-white rounded-lg">
                <p class="text-slate-500">No case studies available yet.</p>
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
