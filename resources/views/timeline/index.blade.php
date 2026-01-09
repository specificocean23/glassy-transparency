<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline - All Major Events</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --bg: #f8fafc;
            --panel: #ffffff;
            --subtle: #64748b;
            --ink: #0f172a;
            --border: #e2e8f0;
            --accent: #1e3a8a;
            --accent-light: #3b82f6;
            --success: #16a34a;
            --warning: #ea580c;
            --danger: #dc2626;
        }

        :root.dark {
            --bg: #0f172a;
            --panel: #1e293b;
            --subtle: #cbd5e1;
            --ink: #f1f5f9;
            --border: #334155;
            --accent: #60a5fa;
            --accent-light: #93c5fd;
            --success: #4ade80;
            --warning: #fb923c;
            --danger: #ef4444;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
            background: var(--bg);
            color: var(--ink);
            margin: 0;
            padding: 0;
            transition: background-color 200ms ease, color 200ms ease;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 100px 32px 60px;
        }

        .filters {
            background: var(--panel);
            padding: 24px;
            border-radius: 12px;
            border: 1px solid var(--border);
            margin-bottom: 32px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        :root.dark .filters {
            box-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }

        .filter-btn {
            padding: 10px 20px;
            border: 2px solid var(--border);
            border-radius: 8px;
            background: var(--panel);
            color: var(--ink);
            cursor: pointer;
            transition: all 200ms ease;
            font-weight: 600;
        }

        .filter-btn:hover {
            border-color: var(--accent);
            background: var(--accent);
            color: white;
        }

        .filter-btn.active {
            border-color: var(--accent);
            background: var(--accent);
            color: white;
        }

        .timeline {
            position: relative;
            padding-left: 40px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 12px;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(to bottom, var(--accent), var(--accent-light));
        }

        .timeline-item {
            position: relative;
            margin-bottom: 48px;
            background: var(--panel);
            border: 1px solid var(--border);
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: all 300ms ease;
        }

        :root.dark .timeline-item {
            box-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }

        .timeline-item:hover {
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            transform: translateX(8px);
            border-color: var(--accent);
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -52px;
            top: 28px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--panel);
            border: 4px solid var(--accent);
            box-shadow: 0 0 0 4px var(--panel), 0 0 0 8px var(--accent);
            z-index: 10;
        }

        .event-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 12px;
            gap: 16px;
        }

        .event-title {
            font-size: 22px;
            font-weight: 800;
            color: var(--ink);
        }

        .event-amount {
            font-size: 28px;
            font-weight: 900;
            white-space: nowrap;
        }

        .event-amount.expense {
            color: var(--danger);
        }

        .event-amount.income {
            color: var(--success);
        }

        .event-meta {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 16px;
        }

        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .badge-date {
            background: rgba(30, 58, 138, 0.1);
            color: var(--accent);
        }

        :root.dark .badge-date {
            background: rgba(96, 165, 250, 0.2);
            color: #bfdbfe;
        }

        .badge-type {
            background: rgba(234, 88, 12, 0.1);
            color: var(--warning);
        }

        :root.dark .badge-type {
            background: rgba(251, 146, 60, 0.2);
            color: #fdba74;
        }

        .badge-controversial {
            background: rgba(220, 38, 38, 0.1);
            color: var(--danger);
        }

        :root.dark .badge-controversial {
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
        }

        .badge-featured {
            background: rgba(251, 191, 36, 0.1);
            color: #b45309;
        }

        :root.dark .badge-featured {
            background: rgba(251, 191, 36, 0.2);
            color: #fcd34d;
        }

        .badge-impact {
            background: rgba(147, 51, 234, 0.1);
            color: #7c3aed;
        }

        :root.dark .badge-impact {
            background: rgba(196, 181, 253, 0.2);
            color: #ddd6fe;
        }

        a {
            color: var(--accent);
            transition: opacity 200ms ease;
        }

        a:hover {
            opacity: 0.8;
        }

        .btn {
            padding: 12px 24px;
            background: var(--accent);
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
            transition: all 200ms ease;
        }

        .btn:hover {
            background: var(--accent-light);
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 80px 16px 40px;
            }

            .timeline {
                padding-left: 20px;
            }

            .timeline-item::before {
                left: -36px;
            }

            .event-header {
                flex-direction: column;
            }
        }
    </style>
    </style>
</head>
<body>
    @include('components.nav-professional')

    <div class="container">
        <h1 style="font-size: 48px; font-weight: 900; margin-bottom: 16px;">📅 Timeline of Major Events</h1>
        <p style="font-size: 18px; color: var(--subtle); margin-bottom: 32px;">
            Comprehensive timeline of significant government spending and revenue events
        </p>

        <div class="filters">
            <button class="filter-btn active" data-filter="all">All Events</button>
            <button class="filter-btn" data-filter="expense">Expenses</button>
            <button class="filter-btn" data-filter="income">Income</button>
            <button class="filter-btn" data-filter="controversial">Controversial</button>
            <button class="filter-btn" data-filter="featured">Featured</button>
        </div>

        <div class="timeline">
            @forelse($events as $event)
                <div class="timeline-item" 
                     data-type="{{ $event->event_type }}" 
                     data-controversial="{{ $event->is_controversial ? 'true' : 'false' }}"
                     data-featured="{{ $event->is_featured ? 'true' : 'false' }}">
                    
                    <div class="event-header">
                        <div class="event-title">
                            @if($event->is_controversial) 🚨 @endif
                            @if($event->is_featured) ⭐ @endif
                            {{ $event->title }}
                        </div>
                        @if($event->amount)
                            <div class="event-amount {{ $event->event_type }}">
                                @if($event->event_type === 'income')+@else-@endif€{{ number_format($event->amount, 0) }}
                            </div>
                        @endif
                    </div>

                    <div class="event-meta">
                        <span class="badge badge-date">{{ $event->event_date->format('F j, Y') }}</span>
                        <span class="badge badge-type">{{ ucfirst($event->event_type) }}</span>
                        
                        @if($event->category)
                            <span class="badge" style="background: #e0e7ff; color: #3730a3;">
                                {{ $event->category }}
                            </span>
                        @endif

                        @if($event->is_controversial)
                            <span class="badge badge-controversial">Controversial</span>
                        @endif

                        @if($event->is_featured)
                            <span class="badge badge-featured">Featured</span>
                        @endif

                        @if($event->impact_level !== 'medium')
                            <span class="badge badge-impact">{{ ucfirst($event->impact_level) }} Impact</span>
                        @endif
                    </div>

                    @if($event->description)
                        <p style="color: var(--subtle); line-height: 1.7; margin-bottom: 12px;">
                            {{ $event->description }}
                        </p>
                    @endif

                    @if($event->department)
                        <div style="font-size: 14px; color: var(--subtle);">
                            <strong>Department:</strong> {{ $event->department }}
                        </div>
                    @endif

                    @if($event->source_url)
                        <a href="{{ $event->source_url }}" target="_blank" 
                           style="display: inline-block; margin-top: 12px; color: #dc2626; font-weight: 600; text-decoration: none;">
                            View Source →
                        </a>
                    @endif
                </div>
            @empty
                <div style="background: white; padding: 48px; border-radius: 12px; text-align: center;">
                    <div style="font-size: 64px; margin-bottom: 16px;">📭</div>
                    <h2 style="margin-bottom: 12px;">No Events Yet</h2>
                    <p style="color: var(--subtle);">Import timeline data to start tracking major government events.</p>
                    <a href="/admin/import" style="display: inline-block; margin-top: 24px; padding: 12px 24px; background: #dc2626; color: white; border-radius: 8px; text-decoration: none; font-weight: 700;">
                        Import Data
                    </a>
                </div>
            @endforelse
        </div>

        <div style="margin-top: 48px;">
            {{ $events->links() }}
        </div>
    </div>

    <script>
        // Filter functionality
        const filterBtns = document.querySelectorAll('.filter-btn');
        const timelineItems = document.querySelectorAll('.timeline-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const filter = btn.dataset.filter;
                
                // Update active state
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                // Filter items
                timelineItems.forEach(item => {
                    if (filter === 'all') {
                        item.style.display = 'block';
                    } else if (filter === 'controversial') {
                        item.style.display = item.dataset.controversial === 'true' ? 'block' : 'none';
                    } else if (filter === 'featured') {
                        item.style.display = item.dataset.featured === 'true' ? 'block' : 'none';
                    } else {
                        item.style.display = item.dataset.type === filter ? 'block' : 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>
