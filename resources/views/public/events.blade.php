<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events - Transparency.ie</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50">
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">Transparency.ie</h1>
            <ul class="flex gap-6 text-sm">
                <li><a href="/" class="text-slate-700 hover:text-blue-600">Home</a></li>
                <li><a href="/technologies" class="text-slate-700 hover:text-blue-600">Technologies</a></li>
                <li><a href="/events" class="text-blue-600 font-semibold">Events</a></li>
                <li><a href="/case-studies" class="text-slate-700 hover:text-blue-600">Case Studies</a></li>
                <li><a href="/campaigns" class="text-slate-700 hover:text-blue-600">Campaigns</a></li>
            </ul>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <h2 class="text-3xl font-bold mb-8">Events & Competitions</h2>
        <p class="text-slate-600 mb-8 max-w-2xl">Upcoming events, scientific competitions, and public debates on Ireland's energy transition.</p>

        <div class="space-y-6">
            @forelse($events as $event)
            <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-green-600">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-2xl font-bold">{{ $event->title }}</h3>
                        <p class="text-sm text-slate-500 mt-1">{{ ucfirst($event->event_type) }}</p>
                    </div>
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">{{ ucfirst($event->status ?? 'upcoming') }}</span>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 py-4 bg-slate-50 rounded px-4">
                    <div>
                        <p class="text-xs text-slate-600">Start Date</p>
                        <p class="font-semibold">{{ $event->start_date?->format('M d, Y') }}</p>
                    </div>
                    @if($event->end_date)
                    <div>
                        <p class="text-xs text-slate-600">End Date</p>
                        <p class="font-semibold">{{ $event->end_date?->format('M d, Y') }}</p>
                    </div>
                    @endif
                    @if($event->location)
                    <div>
                        <p class="text-xs text-slate-600">Location</p>
                        <p class="font-semibold">{{ $event->location }}</p>
                    </div>
                    @endif
                    @if($event->max_participants)
                    <div>
                        <p class="text-xs text-slate-600">Capacity</p>
                        <p class="font-semibold">{{ $event->max_participants }} participants</p>
                    </div>
                    @endif
                </div>

                @if($event->description)
                <p class="text-slate-700 mb-4">{{ $event->description }}</p>
                @endif

                <div class="flex gap-4">
                    @if($event->registration_url)
                    <a href="{{ $event->registration_url }}" target="_blank" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Register</a>
                    @endif
                    @if($event->recording_url)
                    <a href="{{ $event->recording_url }}" target="_blank" class="px-4 py-2 bg-slate-200 text-slate-700 rounded hover:bg-slate-300">Watch Recording</a>
                    @endif
                </div>
            </div>
            @empty
            <div class="text-center py-12 bg-white rounded-lg">
                <p class="text-slate-500 text-lg">No events scheduled yet.</p>
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
