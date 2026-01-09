<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transparency Dashboard | {{ config('app.name', 'Transparency.ie') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <style>
        :root {
            --bg: #f8fafc;
            --panel: #ffffff;
            --ink: #0f172a;
            --ink-light: #64748b;
            --border: rgba(15,23,42,0.08);
            --accent: #0ea5e9;
            --accent-soft: #e0f2fe;
            --shadow: 0 1px 3px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 40px rgba(0,0,0,0.08);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Instrument Sans', system-ui, sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            color: var(--ink);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header */
        .header {
            background: var(--panel);
            border-radius: 16px;
            padding: 32px;
            box-shadow: var(--shadow-lg);
            margin-bottom: 24px;
            border: 1px solid var(--border);
        }

        .header h1 {
            font-size: 42px;
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 8px;
            background: linear-gradient(135deg, #0ea5e9, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header p {
            color: var(--ink-light);
            font-size: 16px;
            line-height: 1.6;
        }

        /* Controls Panel */
        .controls {
            background: var(--panel);
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--shadow-lg);
            margin-bottom: 24px;
            border: 1px solid var(--border);
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            align-items: center;
        }

        .control-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .control-group label {
            font-size: 13px;
            font-weight: 600;
            color: var(--ink-light);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .control-group select {
            padding: 10px 16px;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            color: var(--ink);
            background: white;
            cursor: pointer;
            transition: all 0.2s;
            min-width: 200px;
        }

        .control-group select:hover {
            border-color: var(--accent);
        }

        .control-group select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-soft);
        }

        .year-nav {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .year-btn {
            width: 40px;
            height: 40px;
            border: 2px solid var(--border);
            border-radius: 10px;
            background: white;
            cursor: pointer;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            font-weight: bold;
        }

        .year-btn:hover:not(:disabled) {
            border-color: var(--accent);
            background: var(--accent-soft);
        }

        .year-btn:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .year-display {
            font-size: 24px;
            font-weight: 800;
            color: var(--ink);
            min-width: 80px;
            text-align: center;
        }

        /* Filter Buttons */
        .filters {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 10px 16px;
            border: 2px solid var(--border);
            border-radius: 10px;
            background: white;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            color: var(--ink);
        }

        .filter-btn:hover {
            border-color: var(--accent);
            background: var(--accent-soft);
        }

        .filter-btn.active {
            background: var(--accent);
            border-color: var(--accent);
            color: white;
        }

        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 24px;
            margin-bottom: 24px;
        }

        @media (max-width: 1024px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        .chart-panel {
            background: var(--panel);
            border-radius: 16px;
            padding: 32px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
            min-height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #pieChartCanvas {
            max-height: 450px;
        }

        /* Legend */
        .legend-panel {
            background: var(--panel);
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
            max-height: 600px;
            overflow-y: auto;
        }

        .legend-panel h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 16px;
            color: var(--ink);
        }

        .legend-items {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 10px;
            background: var(--bg);
            transition: all 0.2s;
        }

        .legend-item:hover {
            background: var(--accent-soft);
            transform: translateX(4px);
        }

        .legend-color {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            flex-shrink: 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .legend-content {
            flex: 1;
            min-width: 0;
        }

        .legend-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 2px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .legend-amount {
            font-size: 16px;
            font-weight: 800;
            color: var(--accent);
        }

        .legend-amount.na {
            color: var(--ink-light);
            font-size: 14px;
            font-weight: 600;
        }

        /* Case Studies Section */
        .case-studies-section {
            background: var(--panel);
            border-radius: 16px;
            padding: 32px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
        }

        .case-studies-section h2 {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 24px;
            color: var(--ink);
        }

        .case-studies-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        .case-card {
            background: var(--bg);
            border: 2px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            transition: all 0.2s;
        }

        .case-card:hover {
            border-color: var(--accent);
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        .case-card h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--ink);
        }

        .case-card p {
            color: var(--ink-light);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 12px;
        }

        .case-meta {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .case-tag {
            padding: 4px 10px;
            border-radius: 6px;
            background: var(--accent-soft);
            color: var(--accent);
            font-size: 12px;
            font-weight: 600;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 24px;
        }

        .pagination a,
        .pagination span {
            padding: 10px 16px;
            border-radius: 8px;
            border: 2px solid var(--border);
            background: white;
            color: var(--ink);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }

        .pagination a:hover {
            border-color: var(--accent);
            background: var(--accent-soft);
        }

        .pagination .active {
            background: var(--accent);
            border-color: var(--accent);
            color: white;
        }
    </style>
</head>
<body>
    <x-nav-waterford-professional />

    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>💰 Transparency Dashboard</h1>
            <p>Explore government spending across Ireland by category, county, and year. Track investments in infrastructure, environment, housing, and public services.</p>
        </div>

        <!-- Controls -->
        <div class="controls">
            <!-- County Selector -->
            <div class="control-group">
                <label>County</label>
                <select id="countySelect" onchange="updateDashboard()">
                    @foreach($counties as $county)
                        <option value="{{ $county->slug }}" {{ $currentCounty->id === $county->id ? 'selected' : '' }}>
                            {{ $county->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Year Navigation -->
            <div class="control-group">
                <label>Year</label>
                <div class="year-nav">
                    <button class="year-btn" id="prevYear" onclick="changeYear(-1)">◀</button>
                    <span class="year-display" id="yearDisplay">{{ $year }}</span>
                    <button class="year-btn" id="nextYear" onclick="changeYear(1)" disabled>▶</button>
                </div>
            </div>

            <!-- Filters -->
            <div class="control-group">
                <label>Filters</label>
                <div class="filters">
                    <button class="filter-btn {{ !$filter ? 'active' : '' }}" onclick="setFilter(null)">All</button>
                    <button class="filter-btn {{ $filter === 'environmental-good' ? 'active' : '' }}" onclick="setFilter('environmental-good')">🌱 Good for Environment</button>
                    <button class="filter-btn {{ $filter === 'environmental-bad' ? 'active' : '' }}" onclick="setFilter('environmental-bad')">⚠️ Bad for Environment</button>
                    <button class="filter-btn {{ $filter === 'new-housing' ? 'active' : '' }}" onclick="setFilter('new-housing')">🏗️ New Housing</button>
                    <button class="filter-btn {{ $filter === 'current-housing' ? 'active' : '' }}" onclick="setFilter('current-housing')">🏠 Current Housing</button>
                </div>
            </div>
        </div>

        <!-- Dashboard Grid -->
        <div class="dashboard-grid">
            <!-- Pie Chart -->
            <div class="chart-panel">
                <canvas id="pieChartCanvas"></canvas>
            </div>

            <!-- Legend -->
            <div class="legend-panel">
                <h3>Spending Breakdown</h3>
                <div class="legend-items" id="legendItems">
                    @foreach($categories as $category)
                        @php
                            $record = $spendingRecords->firstWhere('financial_category_id', $category->id);
                            $amount = $record ? $record->amount : null;
                        @endphp
                        <div class="legend-item">
                            <div class="legend-color" style="background: {{ $category->color }}"></div>
                            <div class="legend-content">
                                <div class="legend-name">
                                    <span>{{ $category->icon }}</span>
                                    <span>{{ $category->name }}</span>
                                </div>
                                @if($amount !== null && $amount > 0)
                                    <div class="legend-amount">€{{ number_format($amount / 1000000, 1) }}M</div>
                                @else
                                    <div class="legend-amount na">N/A</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Case Studies -->
        <div class="case-studies-section">
            <h2>📚 Case Studies {{ $currentCounty->is_federal ? '(All Counties)' : '- ' . $currentCounty->name }}</h2>
            
            @if($caseStudies->count() > 0)
                <div class="case-studies-grid">
                    @foreach($caseStudies as $study)
                        <div class="case-card">
                            <h3>{{ $study->title }}</h3>
                            <p>{{ Str::limit($study->summary, 120) }}</p>
                            <div class="case-meta">
                                @if($study->category)
                                    <span class="case-tag">{{ $study->category }}</span>
                                @endif
                                @if($study->location)
                                    <span class="case-tag">📍 {{ $study->location }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    {{ $caseStudies->appends(request()->query())->links('pagination::simple-default') }}
                </div>
            @else
                <p style="color: var(--ink-light); text-align: center; padding: 40px;">No case studies available for this selection.</p>
            @endif
        </div>
    </div>

    <script>
        // Data from Laravel
        const categories = @json($categories);
        const spendingRecords = @json($spendingRecords);
        const currentYear = {{ $year }};
        const availableYears = @json($availableYears);

        // Chart instance
        let pieChart = null;

        // Initialize chart
        function initChart() {
            const ctx = document.getElementById('pieChartCanvas').getContext('2d');
            
            // Prepare data
            const data = [];
            const labels = [];
            const colors = [];
            const backgroundColors = [];

            spendingRecords.forEach(record => {
                if (record.amount > 0) {
                    const category = categories.find(c => c.id === record.financial_category_id);
                    if (category) {
                        labels.push(category.icon + ' ' + category.name);
                        data.push(parseFloat(record.amount));
                        colors.push(category.color);
                        backgroundColors.push(category.color);
                    }
                }
            });

            // Destroy existing chart
            if (pieChart) {
                pieChart.destroy();
            }

            // Create new chart
            pieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: backgroundColors,
                        borderWidth: 3,
                        borderColor: '#ffffff',
                        hoverBorderWidth: 4,
                        hoverBorderColor: '#0ea5e9',
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.parsed;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return context.label + ': €' + (value / 1000000).toFixed(1) + 'M (' + percentage + '%)';
                                }
                            },
                            backgroundColor: 'rgba(15, 23, 42, 0.9)',
                            titleFont: { size: 14, weight: 'bold' },
                            bodyFont: { size: 13 },
                            padding: 12,
                            cornerRadius: 8,
                        }
                    },
                    animation: {
                        animateRotate: true,
                        animateScale: true
                    }
                }
            });
        }

        // Update dashboard
        function updateDashboard() {
            const county = document.getElementById('countySelect').value;
            const year = document.getElementById('yearDisplay').textContent;
            const filter = new URLSearchParams(window.location.search).get('filter');
            
            let url = `/transparency?county=${county}&year=${year}`;
            if (filter) {
                url += `&filter=${filter}`;
            }
            
            window.location.href = url;
        }

        // Change year
        function changeYear(delta) {
            const currentYearIndex = availableYears.indexOf(currentYear);
            const newIndex = currentYearIndex - delta; // Note: years are in descending order
            
            if (newIndex >= 0 && newIndex < availableYears.length) {
                const newYear = availableYears[newIndex];
                document.getElementById('yearDisplay').textContent = newYear;
                updateDashboard();
            }
        }

        // Set filter
        function setFilter(filterValue) {
            const county = document.getElementById('countySelect').value;
            const year = document.getElementById('yearDisplay').textContent;
            
            let url = `/transparency?county=${county}&year=${year}`;
            if (filterValue) {
                url += `&filter=${filterValue}`;
            }
            
            window.location.href = url;
        }

        // Update year navigation buttons
        function updateYearButtons() {
            const currentYearIndex = availableYears.indexOf(currentYear);
            
            document.getElementById('prevYear').disabled = currentYearIndex >= availableYears.length - 1;
            document.getElementById('nextYear').disabled = currentYearIndex <= 0;
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            initChart();
            updateYearButtons();
        });
    </script>
</body>
</html>
