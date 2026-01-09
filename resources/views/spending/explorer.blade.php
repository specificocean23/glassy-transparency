<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spending Explorer - Detailed Breakdown</title>
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
            max-width: 1400px;
            margin: 0 auto;
            padding: 100px 32px 60px;
        }

        .header-section {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #1e3a8a 100%);
            color: white;
            padding: 48px;
            border-radius: 16px;
            margin-bottom: 32px;
            text-align: center;
        }

        .search-filters {
            background: var(--panel);
            border: 1px solid var(--border);
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 32px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        :root.dark .search-filters {
            box-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }

        .search-box {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .search-input {
            flex: 1;
            min-width: 300px;
            padding: 14px 20px;
            border: 2px solid var(--border);
            border-radius: 8px;
            font-size: 16px;
            background: var(--panel);
            color: var(--ink);
            transition: all 200ms ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }

        :root.dark .search-input:focus {
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
        }

        .filter-tags {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .filter-tag {
            padding: 8px 16px;
            border: 2px solid var(--border);
            border-radius: 20px;
            background: var(--panel);
            color: var(--ink);
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 200ms ease;
        }

        .filter-tag:hover {
            border-color: var(--accent);
            background: var(--accent);
            color: white;
        }

        .filter-tag.active {
            border-color: var(--accent);
            background: var(--accent);
            color: white;
        }

        .spending-grid {
            display: grid;
            gap: 20px;
        }

        .spending-card {
            background: var(--panel);
            border: 1px solid var(--border);
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border-left: 6px solid var(--accent);
            transition: all 300ms ease;
            position: relative;
        }

        :root.dark .spending-card {
            box-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }

        .spending-card:hover {
            box-shadow: 0 10px 20px rgba(0,0,0,0.12);
            transform: translateX(4px);
            border-color: var(--accent);
        }

        .spending-card.questionable {
            background: var(--panel);
            border-left-color: var(--danger);
        }

        :root.dark .spending-card.questionable {
            background: var(--panel);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 12px;
            gap: 16px;
        }

        .card-title {
            font-size: 20px;
            font-weight: 800;
            color: var(--ink);
            flex: 1;
        }

        .card-amount {
            font-size: 32px;
            font-weight: 900;
            color: var(--accent);
            white-space: nowrap;
        }

        .card-meta {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-questionable {
            background: rgba(220, 38, 38, 0.15);
            color: var(--danger);
        }

        :root.dark .badge-questionable {
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
        }

        .badge-category {
            background: rgba(30, 58, 138, 0.1);
            color: var(--accent);
        }

        :root.dark .badge-category {
            background: rgba(96, 165, 250, 0.2);
            color: #bfdbfe;
        }

        .badge-status {
            background: rgba(22, 163, 74, 0.1);
            color: var(--success);
        }

        :root.dark .badge-status {
            background: rgba(74, 222, 128, 0.2);
            color: #86efac;
        }

        .badge-date {
            background: rgba(30, 58, 138, 0.1);
            color: var(--accent);
        }

        :root.dark .badge-date {
            background: rgba(96, 165, 250, 0.2);
            color: #bfdbfe;
        }

        .badge-location {
            background: rgba(234, 88, 12, 0.1);
            color: var(--warning);
        }

        :root.dark .badge-location {
            background: rgba(251, 146, 60, 0.2);
            color: #fdba74;
        }

        .interest-bar {
            height: 6px;
            background: var(--border);
            border-radius: 3px;
            overflow: hidden;
            margin-top: 12px;
        }

        .interest-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--success), var(--warning), var(--danger));
            transition: width 300ms ease;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 32px;
        }

        .stat-box {
            background: var(--panel);
            border: 1px solid var(--border);
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            transition: all 200ms ease;
        }

        :root.dark .stat-box {
            box-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }

        .stat-box:hover {
            border-color: var(--accent);
            box-shadow: 0 4px 12px rgba(30, 58, 138, 0.12);
        }

        .stat-value {
            font-size: 32px;
            font-weight: 900;
            color: var(--accent);
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 12px;
            color: var(--subtle);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        details {
            cursor: pointer;
        }

        details summary {
            cursor: pointer;
            font-weight: 600;
            color: var(--accent);
        }

        details p {
            margin-top: 8px;
            padding: 12px;
            background: rgba(30, 58, 138, 0.05);
            border-radius: 8px;
            font-size: 14px;
            color: var(--subtle);
        }

        :root.dark details p {
            background: rgba(96, 165, 250, 0.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 80px 16px 40px;
            }

            .card-header {
                flex-direction: column;
            }

            .search-box {
                flex-direction: column;
            }

            .search-input {
                min-width: auto;
            }
        }
    </style>
    </style>
</head>
<body>
    @include('components.nav-professional')

    <div class="container">
        <div class="header-section">
            <h1 style="font-size: 48px; font-weight: 900; margin-bottom: 12px;">🔍 Spending Explorer</h1>
            <p style="font-size: 20px; opacity: 0.95;">
                Detailed breakdown of every government spending item we track
            </p>
        </div>

        @php
            $total = $items->sum('amount');
            $avgAmount = $items->avg('amount');
            $questionableCount = $items->where('is_questionable', true)->count();
            $highInterest = $items->where('public_interest_score', '>=', 70)->count();
        @endphp

        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-value">{{ $items->total() }}</div>
                <div class="stat-label">Total Items</div>
            </div>
            <div class="stat-box">
                <div class="stat-value">€{{ number_format($total / 1000000, 1) }}M</div>
                <div class="stat-label">Total Amount</div>
            </div>
            <div class="stat-box">
                <div class="stat-value">{{ $questionableCount }}</div>
                <div class="stat-label">Questionable</div>
            </div>
            <div class="stat-box">
                <div class="stat-value">{{ $highInterest }}</div>
                <div class="stat-label">High Interest</div>
            </div>
        </div>

        <div class="search-filters">
            <div class="search-box">
                <input type="text" class="search-input" id="searchInput" placeholder="Search spending items...">
                <select class="search-input" style="flex: 0 0 200px;" id="sortSelect">
                    <option value="date-desc">Newest First</option>
                    <option value="date-asc">Oldest First</option>
                    <option value="amount-desc">Highest Amount</option>
                    <option value="amount-asc">Lowest Amount</option>
                    <option value="interest-desc">Most Interest</option>
                </select>
            </div>

            <div class="filter-tags">
                <button class="filter-tag active" data-filter="all">All Items</button>
                <button class="filter-tag" data-filter="questionable">Questionable Only</button>
                <button class="filter-tag" data-filter="high-interest">High Interest</button>
                @foreach($categories->unique() as $category)
                    <button class="filter-tag" data-filter="category" data-value="{{ $category }}">
                        {{ $category }}
                    </button>
                @endforeach
            </div>
        </div>

        <div class="spending-grid" id="spendingGrid">
            @forelse($items as $item)
                <div class="spending-card {{ $item->is_questionable ? 'questionable' : '' }}" 
                     data-category="{{ $item->category }}"
                     data-questionable="{{ $item->is_questionable ? 'true' : 'false' }}"
                     data-interest="{{ $item->public_interest_score }}"
                     data-amount="{{ $item->amount }}"
                     data-date="{{ $item->date->timestamp }}">
                    
                    <div class="card-header">
                        <div class="card-title">
                            @if($item->is_questionable) ⚠️ @endif
                            {{ $item->title }}
                        </div>
                        <div class="card-amount">€{{ number_format($item->amount, 0) }}</div>
                    </div>

                    @if($item->description)
                        <p style="color: var(--subtle); margin-bottom: 12px; line-height: 1.6;">
                            {{ Str::limit($item->description, 200) }}
                        </p>
                    @endif

                    <div class="card-meta">
                        @if($item->is_questionable)
                            <span class="badge badge-questionable">🚨 Questionable</span>
                        @endif
                        <span class="badge badge-category">{{ $item->category }}</span>
                        <span class="badge badge-date">{{ $item->date->format('M j, Y') }}</span>
                        <span class="badge badge-status">{{ ucfirst($item->status) }}</span>
                        
                        @if($item->location)
                            <span class="badge badge-location">📍 {{ $item->location }}</span>
                        @endif

                        @if($item->department)
                            <span class="badge" style="background: #f3e8ff; color: #6b21a8;">
                                {{ $item->department }}
                            </span>
                        @endif
                    </div>

                    @if($item->vendor)
                        <div style="font-size: 14px; color: var(--subtle); margin-top: 8px;">
                            <strong>Vendor:</strong> {{ $item->vendor }}
                        </div>
                    @endif

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 12px;">
                        <span style="font-size: 13px; font-weight: 600; color: var(--subtle);">
                            Public Interest Score
                        </span>
                        <span style="font-size: 16px; font-weight: 800; color: {{ $item->public_interest_score >= 70 ? '#dc2626' : '#64748b' }};">
                            {{ $item->public_interest_score }}/100
                        </span>
                    </div>
                    <div class="interest-bar">
                        <div class="interest-fill" style="width: {{ $item->public_interest_score }}%;"></div>
                    </div>

                    @if($item->justification)
                        <details style="margin-top: 12px;">
                            <summary style="cursor: pointer; font-weight: 600; color: var(--accent);">View Justification</summary>
                            <p style="margin-top: 8px; padding: 12px; background: rgba(30, 58, 138, 0.05); border-radius: 8px; font-size: 14px; color: var(--subtle);">
                                {{ $item->justification }}
                            </p>
                        </details>
                    @endif
                </div>
            @empty
                <div style="background: white; padding: 64px; border-radius: 12px; text-align: center;">
                    <div style="font-size: 80px; margin-bottom: 16px;">📊</div>
                    <h2 style="margin-bottom: 12px; font-size: 32px;">No Spending Items Yet</h2>
                    <p style="color: var(--subtle); font-size: 18px; margin-bottom: 24px;">
                        Import spending data to start tracking government expenditures.
                    </p>
                    <a href="/admin/import" style="display: inline-block; padding: 16px 32px; background: #dc2626; color: white; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 16px;">
                        Import Spending Data
                    </a>
                </div>
            @endforelse
        </div>

        <div style="margin-top: 48px;">
            {{ $items->links() }}
        </div>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const sortSelect = document.getElementById('sortSelect');
        const filterTags = document.querySelectorAll('.filter-tag');
        const cards = Array.from(document.querySelectorAll('.spending-card'));
        const grid = document.getElementById('spendingGrid');

        let currentFilter = 'all';
        let currentSort = 'date-desc';

        // Search functionality
        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase();
            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                card.style.display = text.includes(query) ? 'block' : 'none';
            });
        });

        // Filter functionality
        filterTags.forEach(tag => {
            tag.addEventListener('click', () => {
                filterTags.forEach(t => t.classList.remove('active'));
                tag.classList.add('active');

                const filter = tag.dataset.filter;
                const value = tag.dataset.value;

                cards.forEach(card => {
                    let show = false;

                    if (filter === 'all') {
                        show = true;
                    } else if (filter === 'questionable') {
                        show = card.dataset.questionable === 'true';
                    } else if (filter === 'high-interest') {
                        show = parseInt(card.dataset.interest) >= 70;
                    } else if (filter === 'category') {
                        show = card.dataset.category === value;
                    }

                    card.style.display = show ? 'block' : 'none';
                });
            });
        });

        // Sort functionality
        sortSelect.addEventListener('change', (e) => {
            const sort = e.target.value;
            const sortedCards = [...cards].sort((a, b) => {
                switch(sort) {
                    case 'date-desc':
                        return parseInt(b.dataset.date) - parseInt(a.dataset.date);
                    case 'date-asc':
                        return parseInt(a.dataset.date) - parseInt(b.dataset.date);
                    case 'amount-desc':
                        return parseFloat(b.dataset.amount) - parseFloat(a.dataset.amount);
                    case 'amount-asc':
                        return parseFloat(a.dataset.amount) - parseFloat(b.dataset.amount);
                    case 'interest-desc':
                        return parseInt(b.dataset.interest) - parseInt(a.dataset.interest);
                    default:
                        return 0;
                }
            });

            grid.innerHTML = '';
            sortedCards.forEach(card => grid.appendChild(card));
        });
    </script>
</body>
</html>
