<!-- Navigation Menu V1: Minimalist Monochrome with Pillar Submenu -->
<style>
    .nav-v1 {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: var(--panel);
        border-bottom: 1px solid var(--border);
        backdrop-filter: var(--blur);
        box-shadow: var(--shadow);
    }
    .nav-v1-wrap {
        max-width: 1320px;
        margin: 0 auto;
        padding: 20px 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
    }
    .nav-v1-brand { display: flex; align-items: center; gap: 16px; }
    .nav-v1-badge {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--card);
        border: 2px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        cursor: pointer;
        transition: all 180ms ease;
    }
    .nav-v1-badge:hover { transform: scale(1.05); }
    .nav-v1-brand-text small { color: var(--subtle); font-size: 10px; text-transform: uppercase; letter-spacing: 0.15em; margin: 0; }
    .nav-v1-brand-text strong { font-weight: 800; font-size: 18px; margin: 2px 0 0 0; display: block; }
    
    .nav-v1-links {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    .nav-v1-link {
        padding: 8px 14px;
        border-radius: 6px;
        border: 1px solid transparent;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        transition: all 160ms ease;
        color: var(--ink);
        background: transparent;
        cursor: pointer;
        position: relative;
    }
    .nav-v1-link:hover {
        border-color: var(--border);
        background: var(--bg);
    }
    .nav-v1-link.active {
        border-color: var(--ink);
        background: var(--card);
    }
    
    /* Pillar Submenu */
    .nav-v1-pillars {
        position: relative;
    }
    .nav-v1-pillars-trigger {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .nav-v1-pillars-menu {
        position: absolute;
        top: 100%;
        left: 0;
        margin-top: 8px;
        background: var(--panel);
        border: 1px solid var(--border);
        border-radius: 8px;
        min-width: 240px;
        box-shadow: var(--shadow);
        backdrop-filter: var(--blur);
        opacity: 0;
        pointer-events: none;
        transform: translateY(-8px);
        transition: all 200ms ease;
        overflow: hidden;
    }
    .nav-v1-pillars:hover .nav-v1-pillars-menu {
        opacity: 1;
        pointer-events: all;
        transform: translateY(0);
    }
    .nav-v1-pillar-item {
        padding: 14px 16px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all 120ms ease;
        color: var(--ink);
        text-decoration: none;
    }
    .nav-v1-pillar-item:last-child { border-bottom: none; }
    .nav-v1-pillar-item:hover {
        background: var(--bg);
        padding-left: 20px;
    }
    .nav-v1-pillar-icon { font-size: 20px; }
    .nav-v1-pillar-text {
        flex: 1;
    }
    .nav-v1-pillar-text-title {
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin: 0;
    }
    .nav-v1-pillar-text-desc {
        font-size: 11px;
        color: var(--subtle);
        margin: 2px 0 0 0;
    }
    
    .nav-v1-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .nav-v1-toggle {
        padding: 8px 12px;
        border: 1px solid var(--border);
        border-radius: 6px;
        background: transparent;
        cursor: pointer;
        font-size: 14px;
        transition: all 160ms ease;
    }
    .nav-v1-toggle:hover {
        border-color: var(--ink);
        background: var(--card);
    }
    .nav-v1-btn {
        padding: 9px 16px;
        border-radius: 6px;
        border: 1.5px solid var(--ink);
        background: var(--ink);
        color: var(--bg);
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        cursor: pointer;
        transition: all 160ms ease;
    }
    .nav-v1-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    @media (max-width: 768px) {
        .nav-v1-wrap {
            padding: 16px 16px;
            gap: 12px;
            flex-wrap: wrap;
        }
        .nav-v1-links {
            order: 3;
            width: 100%;
            gap: 6px;
        }
        .nav-v1-link {
            padding: 6px 10px;
            font-size: 11px;
        }
        .nav-v1-pillars-menu {
            min-width: 200px;
        }
    }
</style>

<nav class="nav-v1">
    <div class="nav-v1-wrap">
        <a href="/" class="nav-v1-brand" style="text-decoration: none;">
            <div class="nav-v1-badge">🔍</div>
            <div class="nav-v1-brand-text">
                <small>Public Observatory</small>
                <strong>Transparency.ie</strong>
            </div>
        </a>

        <div class="nav-v1-links">
            <div class="nav-v1-pillars nav-v1-link">
                <span class="nav-v1-pillars-trigger">
                    📊 PILLARS <span style="font-size: 10px;">▼</span>
                </span>
                <div class="nav-v1-pillars-menu">
                    <a href="/metrics" class="nav-v1-pillar-item">
                        <span class="nav-v1-pillar-icon">💰</span>
                        <div class="nav-v1-pillar-text">
                            <p class="nav-v1-pillar-text-title">Transparency</p>
                            <p class="nav-v1-pillar-text-desc">Budgets & spending</p>
                        </div>
                    </a>
                    <a href="/metrics" class="nav-v1-pillar-item">
                        <span class="nav-v1-pillar-icon">🌍</span>
                        <div class="nav-v1-pillar-text">
                            <p class="nav-v1-pillar-text-title">Environment</p>
                            <p class="nav-v1-pillar-text-desc">Climate & emissions</p>
                        </div>
                    </a>
                    <a href="/campaigns" class="nav-v1-pillar-item">
                        <span class="nav-v1-pillar-icon">⚖️</span>
                        <div class="nav-v1-pillar-text">
                            <p class="nav-v1-pillar-text-title">Civic Forum</p>
                            <p class="nav-v1-pillar-text-desc">Campaigns & action</p>
                        </div>
                    </a>
                    <a href="/technologies" class="nav-v1-pillar-item">
                        <span class="nav-v1-pillar-icon">💡</span>
                        <div class="nav-v1-pillar-text">
                            <p class="nav-v1-pillar-text-title">Innovation Lab</p>
                            <p class="nav-v1-pillar-text-desc">Technologies & trials</p>
                        </div>
                    </a>
                </div>
            </div>

            <a href="/case-studies" class="nav-v1-link">📚 Case Studies</a>
            <a href="/events" class="nav-v1-link">🎯 Events</a>
        </div>

        <div class="nav-v1-actions">
            <button class="nav-v1-toggle" onclick="toggleTheme()">☀️/🌙</button>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-v1-btn">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="nav-v1-btn">Log In</a>
                @endauth
            @endif
        </div>
    </div>
</nav>
