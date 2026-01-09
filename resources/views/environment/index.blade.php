<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Environment Transparency</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        :root { --bg:#f8fafc; --panel:#fff; --subtle:#64748b; --ink:#0f172a; --border:#e2e8f0; --accent:#1e3a8a; --accent-light:#3b82f6; }
        :root.dark { --bg:#0f172a; --panel:#1e293b; --subtle:#cbd5e1; --ink:#f1f5f9; --border:#334155; --accent:#60a5fa; --accent-light:#93c5fd; }
        body { font-family: system-ui, -apple-system, sans-serif; background: var(--bg); color: var(--ink); }
        .container { max-width: 1400px; margin: 0 auto; padding: 80px 32px; }
        .header { text-align: center; margin-bottom: 24px; }
        .card { background: var(--panel); border:1px solid var(--border); border-radius:12px; padding:24px; box-shadow:0 1px 3px rgba(0,0,0,0.08); }
        .grid { display:grid; gap:24px; }
        .grid-2 { grid-template-columns: repeat(auto-fit, minmax(420px, 1fr)); }
        .selector { display:flex; justify-content:center; gap:12px; margin: 16px 0 24px; }
        .selector button { padding:10px 16px; border:1px solid var(--border); background: var(--panel); color: var(--ink); border-radius:8px; font-weight:600; }
        .selector button.active, .selector button:hover { background: var(--accent); color:#fff; border-color: var(--accent); }
    </style>
</head>
<body>
    @include('components.nav-professional')

    <div class="container">
        <div class="header">
            <h1 style="font-size:42px; font-weight:900;">🌍 Environment Transparency</h1>
            <p style="font-size:18px; color:var(--subtle)">Compare annual spending on Environment vs Fossil Fuel</p>
        </div>

        <div class="selector">
            @foreach($availableYears as $y)
                <a href="/environment?year={{ $y }}" class="btn-link">
                    <button class="{{ $selectedYear == $y ? 'active' : '' }}">{{ $y }}</button>
                </a>
            @endforeach
        </div>

        <div class="grid grid-2">
            <div class="card" style="height:420px;">
                <h3 style="margin-bottom:8px;">Environment vs Fossil Fuel (All Years)</h3>
                <div style="height:360px"><canvas id="envTrend"></canvas></div>
            </div>
            <div class="card" style="height:420px;">
                <h3 style="margin-bottom:8px;">Selected Year Breakdown ({{ $selectedYear }})</h3>
                <div style="height:360px"><canvas id="envPie"></canvas></div>
            </div>
        </div>

        <div class="card" style="margin-top:24px;">
            <h3 style="margin-bottom:8px;">Notes</h3>
            <p style="color:var(--subtle)">This view uses national budget categories 'Environment' and 'Fossil Fuel' to provide a clear comparison over time. Filters can be added to include other eco-positive/negative categories if desired.</p>
        </div>
    </div>

    <script>
        const envYears = @json($envByYear->pluck('year'));
        const envSpent = @json($envByYear->pluck('spent'));
        const fossilYears = @json($fossilByYear->pluck('year'));
        const fossilSpent = @json($fossilByYear->pluck('spent'));

        const trendCtx = document.getElementById('envTrend');
        if (trendCtx) {
            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: envYears,
                    datasets: [
                        { label: 'Environment', data: envSpent, borderColor: 'rgba(30,58,138,1)', backgroundColor: 'rgba(30,58,138,0.15)', tension: 0.3 },
                        { label: 'Fossil Fuel', data: fossilSpent, borderColor: 'rgba(147,197,253,1)', backgroundColor: 'rgba(147,197,253,0.2)', tension: 0.3 }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { labels: { color: 'var(--ink)' } } },
                    scales: {
                        y: { ticks: { color:'var(--subtle)', callback: v => '€' + (v/1000000000).toFixed(1) + 'B' }, grid:{ color:'var(--border)'} },
                        x: { ticks: { color:'var(--subtle)' }, grid:{ display:false } }
                    }
                }
            });
        }

        const pieCtx = document.getElementById('envPie');
        if (pieCtx) {
            const labels = @json($selectedEnv->pluck('category'));
            const data = @json($selectedEnv->pluck('spent'));
            new Chart(pieCtx, {
                type: 'doughnut',
                data: { labels, datasets: [{ data, backgroundColor: ['#1e3a8a','#93c5fd'] }] },
                options: { responsive:true, maintainAspectRatio:false, plugins:{ legend:{ position:'right', labels:{ color: 'var(--ink)'} } } }
            });
        }
    </script>
</body>
</html>
