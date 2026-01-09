<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transparency.ie - Ireland's Public Spending Watchdog</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        :root {
            --bg: #f5f5f5;
            --panel: #ffffff;
            --subtle: #757575;
            --ink: #1a1a1a;
            --border: #e0e0e0;
            --accent: #1e3a8a;
            --accent-light: #3b82f6;
            --success: #16a34a;
            --warning: #f59e0b;
            --danger: #1e40af;
            --dark: #0f172a;
            --light: #f8fafc;
        }

        :root.dark {
            --bg: #0f172a;
            --panel: #1e293b;
            --subtle: #94a3b8;
            --ink: #f1f5f9;
            --border: #334155;
            --accent: #93c5fd;
            --accent-light: #60a5fa;
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
            line-height: 1.6;
        }

        .hero {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            color: white;
            padding: 80px 32px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(255,255,255,0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255,255,255,0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: clamp(32px, 6vw, 64px);
            font-weight: 900;
            margin-bottom: 20px;
            letter-spacing: -1px;
            text-shadow: 0 2px 20px rgba(0,0,0,0.2);
        }

        .hero p {
            font-size: clamp(16px, 3vw, 22px);
            margin-bottom: 32px;
            opacity: 0.95;
        }

        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 48px;
            flex-wrap: wrap;
            margin-top: 48px;
        }

        .hero-stat {
            text-align: center;
        }

        .hero-stat-value {
            font-size: 42px;
            font-weight: 900;
            display: block;
            margin-bottom: 8px;
        }

        .hero-stat-label {
            font-size: 14px;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 60px 32px;
        }

        .section {
            margin-bottom: 80px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 48px;
        }

        .section-title {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 12px;
            color: var(--dark);
        }

        .section-subtitle {
            font-size: 18px;
            color: #64748b;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            transition: all 300ms;
        }

        .card:hover {
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
            transform: translateY(-4px);
        }

        .grid {
            display: grid;
            gap: 24px;
        }

        .grid-2 {
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        }

        .grid-3 {
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        }

        .grid-4 {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }

        .chart-container {
            position: relative;
            height: 400px;
        }

        .spending-item {
            border-left: 4px solid var(--primary);
            padding: 20px;
            background: #fef2f2;
            border-radius: 8px;
            margin-bottom: 16px;
            transition: all 200ms;
        }

        .spending-item:hover {
            background: #fee2e2;
            transform: translateX(4px);
        }

        .spending-item-title {
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 8px;
            color: var(--dark);
        }

        .spending-item-amount {
            font-size: 24px;
            font-weight: 900;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .spending-item-meta {
            font-size: 14px;
            color: #64748b;
        }

        .timeline-event {
            position: relative;
            padding-left: 32px;
            margin-bottom: 32px;
        }

        .timeline-event::before {
            content: '';
            position: absolute;
            left: 0;
            top: 6px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: var(--accent);
            border: 4px solid white;
            box-shadow: 0 0 0 2px var(--accent);
        }

        .timeline-event::after {
            content: '';
            position: absolute;
            left: 7px;
            top: 22px;
            bottom: -32px;
            width: 2px;
            background: var(--border);
        }

        .timeline-event:last-child::after {
            display: none;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-danger {
            background: rgba(30, 58, 138, 0.1);
            color: var(--accent);
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-success {
            background: #dcfce7;
            color: #166534;
        }

        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }

        .btn {
            display: inline-block;
            padding: 14px 32px;
            border-radius: 8px;
            font-weight: 700;
            text-decoration: none;
            transition: all 200ms;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-primary {
            background: var(--accent);
            color: white;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(30, 58, 138, 0.2);
        }

        .btn-primary:hover {
            background: var(--accent-light);
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(30, 58, 138, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        .btn-outline {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(20px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.5);
        }

        .stat-card {
            text-align: center;
            padding: 24px;
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        /* Glassy effect for cards */
        .card {
            background: var(--panel) !important;
            border: 1px solid var(--border) !important;
            backdrop-filter: blur(10px) !important;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08) !important;
        }

        /* Time period selector buttons */
        .time-period-selector {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 24px;
        }

        .time-period-btn {
            padding: 10px 20px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: var(--panel);
            color: var(--ink);
            cursor: pointer;
            font-weight: 600;
            transition: all 200ms ease;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .time-period-btn:hover {
            background: var(--accent);
            color: white;
            border-color: var(--accent);
            box-shadow: 0 6px 20px rgba(30, 58, 138, 0.2);
            transform: translateY(-2px);
        }

        .time-period-btn.active {
            background: var(--accent);
            color: white;
            border-color: var(--accent);
            box-shadow: 0 8px 25px rgba(30, 58, 138, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .spending-item {
            padding: 24px;
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
            font-size: 48px;
            font-weight: 900;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .stat-card-label {
            font-size: 14px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .alert-box {
            background: #fff7ed;
            border: 2px solid var(--warning);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .alert-box h3 {
            color: #92400e;
            margin-bottom: 12px;
        }

        @media (max-width: 768px) {
            .grid-2, .grid-3, .grid-4 {
                grid-template-columns: 1fr;
            }

            .hero-stats {
                gap: 24px;
            }

            .container {
                padding: 40px 20px;
            }
        }

        .questionable-tag {
            background: var(--danger);
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    @include('components.nav-professional')

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>💰 Ireland's Public Spending Watchdog</h1>
            <p>Exposing Government Spending So Transparent, They Wish It Wasn't</p>
            
            <div style="margin-top: 32px;">
                <a href="#spending" class="btn btn-primary">View Spending</a>
                <a href="#timeline" class="btn btn-outline">See Timeline</a>
            </div>

            <div class="hero-stats">
                <div class="hero-stat">
                    <span class="hero-stat-value">€{{ number_format($stats['total_spent'] / 1000000, 1) }}M</span>
                    <span class="hero-stat-label">Total Tracked</span>
                </div>
                <div class="hero-stat">
                    <span class="hero-stat-value">{{ $stats['questionable_items'] }}</span>
                    <span class="hero-stat-label">Questionable Items</span>
                </div>
                <div class="hero-stat">
                    <span class="hero-stat-value">{{ $stats['timeline_events'] }}</span>
                    <span class="hero-stat-label">Major Events</span>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <!-- Budget Overview Section -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">📊 4-Year Budget Overview</h2>
                <p class="section-subtitle">Rolling view of actual spending vs. allocated budgets</p>
            </div>

            <!-- Time Period Selector -->
            <div class="time-period-selector">
                <button class="time-period-btn active" data-years="4" onclick="updateCharts(4)">📅 Last 4 Years</button>
                <button class="time-period-btn" data-years="3" onclick="updateCharts(3)">📊 Last 3 Years</button>
                <button class="time-period-btn" data-years="2" onclick="updateCharts(2)">📈 Last 2 Years</button>
                <button class="time-period-btn" data-years="1" onclick="updateCharts(1)">📌 Current Year</button>
            </div>

            <div class="grid grid-2">
                <div class="card">
                    <h3 style="margin-bottom: 20px;">Budget Trends</h3>
                    <div class="chart-container">
                        <canvas id="budgetChart"></canvas>
                    </div>
                </div>

                <div class="card">
                    <h3 style="margin-bottom: 20px;">Category Breakdown <span id="categoryYear">(2026)</span></h3>
                    <div class="chart-container">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
            </div>
        </section>

        <!-- Questionable Spending Section -->
        <section class="section" id="spending">
            <div class="section-header">
                <h2 class="section-title">🚨 Questionable Spending</h2>
                <p class="section-subtitle">Items that raise public interest concerns</p>
            </div>

            @if($questionableSpending->count() > 0)
                <div class="grid grid-2">
                    @foreach($questionableSpending->take(6) as $item)
                        <div class="spending-item">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">
                                <div class="spending-item-title">{{ $item->title }}</div>
                                <span class="questionable-tag">⚠️ Flagged</span>
                            </div>
                            <div class="spending-item-amount">€{{ number_format($item->amount, 0) }}</div>
                            <div class="spending-item-meta">
                                <strong>{{ $item->category }}</strong> 
                                @if($item->department) · {{ $item->department }} @endif
                                · {{ $item->date->format('M Y') }}
                            </div>
                            @if($item->description)
                                <p style="margin-top: 12px; font-size: 14px; color: #475569;">
                                    {{ Str::limit($item->description, 120) }}
                                </p>
                            @endif
                            <div style="margin-top: 12px;">
                                <span class="badge badge-danger">Interest Score: {{ $item->public_interest_score }}/100</span>
                                @if($item->location)
                                    <span class="badge badge-info">{{ $item->location }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="text-align: center; margin-top: 32px;">
                    <a href="/spending/explorer" class="btn btn-primary">View All Spending Items →</a>
                </div>
            @else
                <div class="alert-box">
                    <h3>No Questionable Items Yet</h3>
                    <p>Import data to start tracking spending items that warrant public scrutiny.</p>
                </div>
            @endif
        </section>

        <!-- Timeline Section -->
        <section class="section" id="timeline">
            <div class="section-header">
                <h2 class="section-title">📅 Major Events Timeline</h2>
                <p class="section-subtitle">Key spending decisions and revenue events</p>
            </div>

            <div class="grid grid-2">
                <div class="card">
                    <h3 style="margin-bottom: 24px;">Recent Events</h3>
                    @forelse($featuredEvents->take(5) as $event)
                        <div class="timeline-event">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">
                                <strong style="font-size: 16px;">{{ $event->title }}</strong>
                                @if($event->is_controversial)
                                    <span class="badge badge-danger">Controversial</span>
                                @endif
                            </div>
                            @if($event->amount)
                                <div style="font-size: 20px; font-weight: 800; color: var(--primary); margin-bottom: 4px;">
                                    {{ $event->formatted_amount }}
                                </div>
                            @endif
                            <div style="font-size: 13px; color: #64748b; margin-bottom: 8px;">
                                {{ $event->event_date->format('F j, Y') }} · {{ ucfirst($event->event_type) }}
                            </div>
                            <p style="font-size: 14px; color: #475569;">
                                {{ Str::limit($event->description, 150) }}
                            </p>
                        </div>
                    @empty
                        <p style="color: #64748b;">No timeline events yet. Import data to populate this section.</p>
                    @endforelse
                </div>

                <div class="card">
                    <h3 style="margin-bottom: 24px;">Major Revenue Streams</h3>
                    @forelse($majorRevenue as $revenue)
                        <div style="border-left: 4px solid var(--success); padding: 16px; background: #f0fdf4; border-radius: 8px; margin-bottom: 16px;">
                            <div style="font-weight: 700; margin-bottom: 4px;">{{ $revenue->title }}</div>
                            <div style="font-size: 24px; font-weight: 900; color: var(--success); margin-bottom: 4px;">
                                +€{{ number_format($revenue->amount, 0) }}
                            </div>
                            <div style="font-size: 13px; color: #166534;">
                                {{ $revenue->source_name }} · {{ ucfirst($revenue->source_type) }}
                            </div>
                        </div>
                    @empty
                        <p style="color: #64748b;">No revenue data yet. Import data to track government income.</p>
                    @endforelse
                </div>
            </div>

            <div style="text-align: center; margin-top: 32px;">
                <a href="/timeline" class="btn btn-primary">View Full Timeline →</a>
            </div>
        </section>

        <!-- Quick Stats Grid -->
        <section class="section">
            <div class="grid grid-4">
                <div class="card stat-card">
                    <div class="stat-card-value">{{ $stats['spending_items'] }}</div>
                    <div class="stat-card-label">Spending Items</div>
                </div>
                <div class="card stat-card">
                    <div class="stat-card-value">{{ $stats['timeline_events'] }}</div>
                    <div class="stat-card-label">Timeline Events</div>
                </div>
                <div class="card stat-card">
                    <div class="stat-card-value">{{ number_format(($stats['total_spent'] / $stats['total_allocated']) * 100, 1) }}%</div>
                    <div class="stat-card-label">Budget Utilized</div>
                </div>
                <div class="card stat-card">
                    <div class="stat-card-value">{{ $questionableSpending->count() }}</div>
                    <div class="stat-card-label">Items Flagged</div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="section" style="text-align: center;">
            <div class="card" style="background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%); color: white;">
                <h2 style="font-size: 32px; margin-bottom: 16px;">Get Involved</h2>
                <p style="font-size: 18px; margin-bottom: 32px; opacity: 0.95;">
                    Help us track government spending and hold officials accountable
                </p>
                <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                    <a href="/admin/import" class="btn" style="background: rgba(255,255,255,0.95); color: var(--accent); backdrop-filter: blur(10px);">Import Data</a>
                    <a href="/transparency" class="btn btn-outline" >Explore Dashboard</a>
                </div>
            </div>
        </section>
    </div>

    <script>
        let budgetChart = null;
        let categoryChart = null;
        const allYears = @json($years);
        const allBudgetsByYear = @json($allBudgetsByYear);
        const colorPalette = [
            '#1e3a8a', '#3b82f6', '#0ea5e9', '#06b6d4', 
            '#14b8a6', '#10b981', '#84cc16', '#eab308',
            '#f59e0b', '#f97316'
        ];

        function updateCharts(numYears) {
            document.querySelectorAll('.time-period-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            const selectedYears = allYears.slice(0, numYears);
            const budgetData = selectedYears.map(year => {
                const yearBudgets = @json($budgetSummary);
                return yearBudgets.find(b => b.year == year);
            }).filter(b => b);

            if (budgetChart) {
                budgetChart.data.labels = budgetData.map(b => b.year);
                budgetChart.data.datasets[0].data = budgetData.map(b => b.allocated);
                budgetChart.data.datasets[1].data = budgetData.map(b => b.spent);
                budgetChart.data.datasets[2].data = budgetData.map(b => b.predicted);
                budgetChart.update();
            }

            const mostRecentYear = selectedYears[0];
            const categoryData = allBudgetsByYear[mostRecentYear];
            
            if (categoryChart && categoryData) {
                const labels = categoryData.map(c => c.category);
                const data = categoryData.map(c => c.total);
                const colors = colorPalette.slice(0, labels.length);
                
                categoryChart.data.labels = labels;
                categoryChart.data.datasets[0].data = data;
                categoryChart.data.datasets[0].backgroundColor = colors;
                categoryChart.update();
                
                document.getElementById('categoryYear').textContent = '(' + mostRecentYear + ')';
            }
        }

        const budgetCtx = document.getElementById('budgetChart');
        if (budgetCtx) {
            budgetChart = new Chart(budgetCtx, {
                type: 'bar',
                data: {
                    labels: @json($budgetSummary->pluck('year')),
                    datasets: [
                        {
                            label: 'Allocated',
                            data: @json($budgetSummary->pluck('allocated')),
                            backgroundColor: 'rgba(117, 117, 117, 0.4)',
                            borderColor: 'rgba(117, 117, 117, 0.8)',
                            borderWidth: 2
                        },
                        {
                            label: 'Spent',
                            data: @json($budgetSummary->pluck('spent')),
                            backgroundColor: 'rgba(30, 58, 138, 0.7)',
                            borderColor: 'rgba(30, 58, 138, 1)',
                            borderWidth: 2
                        },
                        {
                            label: 'Predicted',
                            data: @json($budgetSummary->pluck('predicted')),
                            backgroundColor: 'rgba(59, 130, 246, 0.5)',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 2,
                            borderDash: [5, 5]
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top', labels: { color: 'var(--ink)', font: { weight: 600 } } },
                        tooltip: {
                            callbacks: { label: function(context) { return context.dataset.label + ': €' + (context.parsed.y / 1000000000).toFixed(2) + 'B'; } },
                            backgroundColor: 'rgba(0, 0, 0, 0.7)',
                            titleColor: '#fff',
                            bodyColor: '#fff'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { color: 'var(--subtle)', callback: function(value) { return '€' + (value / 1000000000).toFixed(0) + 'B'; } },
                            grid: { color: 'var(--border)' }
                        },
                        x: {
                            ticks: { color: 'var(--subtle)' },
                            grid: { display: false }
                        }
                    }
                }
            });
        }

        const categoryCtx = document.getElementById('categoryChart');
        if (categoryCtx) {
            categoryChart = new Chart(categoryCtx, {
                type: 'doughnut',
                data: {
                    labels: @json($categoryBreakdown->pluck('category')),
                    datasets: [{
                        data: @json($categoryBreakdown->pluck('total')),
                        backgroundColor: colorPalette,
                        borderWidth: 2,
                        borderColor: 'var(--panel)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'right', labels: { color: 'var(--ink)', font: { weight: 600 }, padding: 12 } },
                        tooltip: {
                            callbacks: { label: function(context) { const total = context.dataset.data.reduce((a, b) => a + b, 0); const percentage = ((context.parsed / total) * 100).toFixed(1); return context.label + ': €' + (context.parsed / 1000000000).toFixed(2) + 'B (' + percentage + '%)'; } },
                            backgroundColor: 'rgba(0, 0, 0, 0.7)',
                            titleColor: '#fff',
                            bodyColor: '#fff'
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>