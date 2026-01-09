<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline - All Major Events</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
            background: #f8fafc;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 100px 32px 60px;
        }

        .filters {
            background: white;
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 32px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 10px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            background: white;
            cursor: pointer;
            transition: all 200ms;
            font-weight: 600;
        }

        .filter-btn:hover, .filter-btn.active {
            border-color: #dc2626;
            background: #dc2626;
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
            background: linear-gradient(to bottom, #dc2626, #f97316);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 48px;
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            transition: all 300ms;
        }

        .timeline-item:hover {
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
            transform: translateX(8px);
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -52px;
            top: 28px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: white;
            border: 4px solid #dc2626;
            box-shadow: 0 0 0 4px white, 0 0 0 8px #dc2626;
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
            color: #0f172a;
        }

        .event-amount {
            font-size: 28px;
            font-weight: 900;
            white-space: nowrap;
        }

        .event-amount.expense {
            color: #dc2626;
        }

        .event-amount.income {
            color: #16a34a;
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
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-type {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-controversial {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-featured {
            background: #fef9c3;
            color: #854d0e;
        }

        .badge-impact {
            background: #fae8ff;
            color: #86198f;
        }
    </style>
</head>
<body>
    @include('components.nav-professional')

    <div class="container">
        <h1 style="font-size: 48px; font-weight: 900; margin-bottom: 16px;">📅 Timeline of Major Events</h1>
        <p style="font-size: 18px; color: #64748b; margin-bottom: 32px;">
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
                        <p style="color: #475569; line-height: 1.7; margin-bottom: 12px;">
                            {{ $event->description }}
                        </p>
                    @endif

                    @if($event->department)
                        <div style="font-size: 14px; color: #64748b;">
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
                    <p style="color: #64748b;">Import timeline data to start tracking major government events.</p>
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
