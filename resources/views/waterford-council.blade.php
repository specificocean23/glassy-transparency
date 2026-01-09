<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waterford Council – Transparency</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        :root { --bg:#f8fafc; --panel:#fff; --subtle:#64748b; --ink:#0f172a; --border:#e2e8f0; --accent:#1e3a8a; --accent-light:#3b82f6; }
        :root.dark { --bg:#0f172a; --panel:#1e293b; --subtle:#cbd5e1; --ink:#f1f5f9; --border:#334155; --accent:#60a5fa; --accent-light:#93c5fd; }
        body { font-family: system-ui, -apple-system, sans-serif; background: var(--bg); color: var(--ink); }
        .container { max-width: 1400px; margin: 0 auto; padding: 80px 32px; }
        .hero { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #1e3a8a 100%); color:#fff; padding: 48px; border-radius:16px; }
        .hero .value { font-size: 48px; font-weight: 900; }
        .grid { display:grid; gap:24px; }
        .grid-2 { grid-template-columns: repeat(auto-fit, minmax(420px, 1fr)); }
        .card { background: var(--panel); border:1px solid var(--border); border-radius:12px; padding:24px; box-shadow:0 1px 3px rgba(0,0,0,0.08); }
        .selector { display:flex; gap:12px; flex-wrap:wrap; margin-top:12px; }
        .selector a button { padding:10px 16px; border:1px solid var(--border); background:var(--panel); color:var(--ink); border-radius:8px; font-weight:600; }
        .selector a button.active, .selector a button:hover { background:var(--accent); color:#fff; border-color:var(--accent); }
        .list { display:grid; gap:16px; }
        .item { background: var(--panel); border:1px solid var(--border); border-left:6px solid var(--accent); border-radius:12px; padding:16px; }
        .item h4 { margin:0 0 6px; font-weight:800; }
        .badge { padding:4px 10px; border-radius:12px; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; }
        .badge-date { background: rgba(30,58,138,0.1); color: var(--accent); }
        .badge-category { background: rgba(96,165,250,0.2); color: #1e3a8a; }
        .badge-status { background: rgba(22,163,74,0.1); color: #166534; }
    </style>
</head>
<body>
    @include('components.nav-professional')

    <div class="container">
        <div class="hero">
            <h1 style="margin:0 0 8px;">🏛️ Waterford Council – Financial Transparency</h1>
            <p style="margin:0 0 16px;">Track spending by year with clear category breakdowns and itemized records.</p>
            <div style="display:flex; gap:24px; flex-wrap:wrap; align-items:center;">
                <div>
                    <div style="opacity:0.9;">Annual Allowance ({{ $selectedYear }})</div>
                    <div class="value">€{{ $allowance ? number_format($allowance, 0) : '—' }}</div>
                </div>
                <div>
                    <div style="opacity:0.9;">Total Spent ({{ $selectedYear }})</div>
                    <div class="value">€{{ number_format($totalSpent, 0) }}</div>
                </div>
            </div>
            <div class="selector">
                @foreach($availableYears as $y)
                    <a href="/waterford-council?year={{ $y }}"><button class="{{ $selectedYear == $y ? 'active' : '' }}">{{ $y }}</button></a>
                @endforeach
            </div>
        </div>

        <div class="grid grid-2" style="margin-top:24px;">
            <div class="card" style="height:420px;">
                <h3 style="margin-bottom:8px;">Category Breakdown ({{ $selectedYear }})</h3>
                <div style="height:360px"><canvas id="wfPie"></canvas></div>
            </div>
            <div class="card" style="height:420px;">
                <h3 style="margin-bottom:8px;">Allowance vs Spent ({{ $selectedYear }})</h3>
                <div style="height:360px"><canvas id="wfBar"></canvas></div>
            </div>
        </div>

        <div class="card" style="margin-top:24px;">
            <h3 style="margin-bottom:12px;">Itemized Spending ({{ $selectedYear }})</h3>
            <div style="display:flex; gap:8px; flex-wrap:wrap; margin-bottom:12px;">
                <button class="filter-tag" data-filter="all" style="padding:8px 12px; border:1px solid var(--border); background:var(--panel); border-radius:8px; font-weight:600;">All</button>
                <button class="filter-tag" data-filter="questionable" style="padding:8px 12px; border:1px solid var(--border); background:var(--panel); border-radius:8px; font-weight:600;">Questionable</button>
                <button class="filter-tag" data-filter="high-interest" style="padding:8px 12px; border:1px solid var(--border); background:var(--panel); border-radius:8px; font-weight:600;">High Interest</button>
                @foreach($categories->unique() as $category)
                    <button class="filter-tag" data-filter="category" data-value="{{ $category }}" style="padding:8px 12px; border:1px solid var(--border); background:var(--panel); border-radius:8px; font-weight:600;">{{ $category }}</button>
                @endforeach
            </div>
            <div class="list">
                @forelse($items as $item)
                    <div class="item" data-category="{{ $item->category }}" data-questionable="{{ $item->is_questionable ? 'true' : 'false' }}" data-interest="{{ $item->public_interest_score }}">
                        <h4>{{ $item->title }}</h4>
                        <div style="display:flex; gap:8px; flex-wrap:wrap; margin-bottom:8px;">
                            <span class="badge badge-category">{{ $item->category }}</span>
                            <span class="badge badge-date">{{ $item->date->format('M j, Y') }}</span>
                            <span class="badge badge-status">{{ ucfirst($item->status) }}</span>
                        </div>
                        <div style="display:flex; justify-content:space-between; align-items:center;">
                            <div style="color:var(--subtle);">{{ Str::limit($item->description ?? '', 160) }}</div>
                            <div style="font-weight:900; color:var(--accent);">€{{ number_format($item->amount, 0) }}</div>
                        </div>
                    </div>
                @empty
                    <div class="item" style="border-left-color:#ef4444;">
                        <h4>No Waterford items found for {{ $selectedYear }}</h4>
                        <div style="color:var(--subtle)">Import spending data or select a different year.</div>
                    </div>
                @endforelse
            </div>
            <div style="margin-top:16px;">{{ $items->links() }}</div>
        </div>
    </div>

    <script>
        const wfPieCtx = document.getElementById('wfPie');
        if (wfPieCtx) {
            const labels = @json($categoryBreakdown->pluck('category'));
            const data = @json($categoryBreakdown->pluck('total'));
            new Chart(wfPieCtx, {
                type: 'doughnut',
                data: { labels, datasets:[{ data, backgroundColor: ['#1e3a8a','#3b82f6','#60a5fa','#93c5fd','#bfdbfe','#c7d2fe','#a5b4fc'] }] },
                options: { responsive:true, maintainAspectRatio:false, plugins:{ legend:{ position:'right', labels:{ color:'var(--ink)'} } } }
            });
        }

        const wfBarCtx = document.getElementById('wfBar');
        if (wfBarCtx) {
            const allowance = @json($allowance);
            const spent = @json($totalSpent);
            new Chart(wfBarCtx, {
                type: 'bar',
                data: {
                    labels: ['Allowance', 'Spent'],
                    datasets: [{
                        label: '€ Amount',
                        data: [allowance || 0, spent],
                        backgroundColor: ['rgba(30,58,138,0.7)','rgba(147,197,253,0.7)'],
                        borderColor: ['rgba(30,58,138,1)','rgba(147,197,253,1)'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive:true,
                    maintainAspectRatio:false,
                    plugins: { legend: { labels: { color:'var(--ink)' } } },
                    scales: {
                        y: { beginAtZero:true, ticks:{ color:'var(--subtle)', callback: v => '€' + (v/1000000).toFixed(0) + 'M' }, grid:{ color:'var(--border)'} },
                        x: { ticks:{ color:'var(--subtle)' }, grid:{ display:false } }
                    }
                }
            });
        }
    </script>
    <script>
        const filterTags = document.querySelectorAll('.filter-tag');
        const cards = Array.from(document.querySelectorAll('.item'));
        filterTags.forEach(tag => {
            tag.addEventListener('click', () => {
                filterTags.forEach(t => t.classList.remove('active'));
                tag.classList.add('active');
                const filter = tag.dataset.filter;
                const value = tag.dataset.value;
                cards.forEach(card => {
                    let show = false;
                    if (filter === 'all') show = true;
                    else if (filter === 'questionable') show = card.dataset.questionable === 'true';
                    else if (filter === 'high-interest') show = parseInt(card.dataset.interest) >= 70;
                    else if (filter === 'category') show = card.dataset.category === value;
                    card.style.display = show ? 'block' : 'none';
                });
            });
        });
    </script>
</body>
</html>
