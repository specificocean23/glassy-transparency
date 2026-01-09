<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spending Explorer - Detailed Breakdown</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
            background: #f8fafc;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 100px 32px 60px;
        }

        .header-section {
            background: linear-gradient(135deg, #dc2626 0%, #f97316 100%);
            color: white;
            padding: 48px;
            border-radius: 16px;
            margin-bottom: 32px;
            text-align: center;
        }

        .search-filters {
            background: white;
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 32px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
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
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 16px;
            transition: all 200ms;
        }

        .search-input:focus {
            outline: none;
            border-color: #dc2626;
        }

        .filter-tags {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .filter-tag {
            padding: 8px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 20px;
            background: white;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 200ms;
        }

        .filter-tag:hover, .filter-tag.active {
            border-color: #dc2626;
            background: #dc2626;
            color: white;
        }

        .spending-grid {
            display: grid;
            gap: 20px;
        }

        .spending-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border-left: 6px solid #dc2626;
            transition: all 300ms;
            position: relative;
        }

        .spending-card:hover {
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
            transform: translateX(4px);
        }

        .spending-card.questionable {
            background: #fef2f2;
            border-left-color: #dc2626;
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
            color: #0f172a;
            flex: 1;
        }

        .card-amount {
            font-size: 32px;
            font-weight: 900;
            color: #dc2626;
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
            background: #dc2626;
            color: white;
        }

        .badge-category {
            background: #e0e7ff;
            color: #3730a3;
        }

        .badge-status {
            background: #dcfce7;
            color: #166534;
        }

        .badge-date {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-location {
            background: #fef3c7;
            color: #92400e;
        }

        .interest-bar {
            height: 6px;
            background: #e2e8f0;
            border-radius: 3px;
            overflow: hidden;
            margin-top: 12px;
        }

        .interest-fill {
            height: 100%;
            background: linear-gradient(90deg, #16a34a, #f59e0b, #dc2626);
            transition: width 300ms;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 32px;
        }

        .stat-box {
            background: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .stat-value {
            font-size: 32px;
            font-weight: 900;
            color: #dc2626;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
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
                        <p style="color: #475569; margin-bottom: 12px; line-height: 1.6;">
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
                        <div style="font-size: 14px; color: #64748b; margin-top: 8px;">
                            <strong>Vendor:</strong> {{ $item->vendor }}
                        </div>
                    @endif

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 12px;">
                        <span style="font-size: 13px; font-weight: 600; color: #64748b;">
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
                            <summary style="cursor: pointer; font-weight: 600; color: #475569;">View Justification</summary>
                            <p style="margin-top: 8px; padding: 12px; background: #f8fafc; border-radius: 8px; font-size: 14px; color: #475569;">
                                {{ $item->justification }}
                            </p>
                        </details>
                    @endif
                </div>
            @empty
                <div style="background: white; padding: 64px; border-radius: 12px; text-align: center;">
                    <div style="font-size: 80px; margin-bottom: 16px;">📊</div>
                    <h2 style="margin-bottom: 12px; font-size: 32px;">No Spending Items Yet</h2>
                    <p style="color: #64748b; font-size: 18px; margin-bottom: 24px;">
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
