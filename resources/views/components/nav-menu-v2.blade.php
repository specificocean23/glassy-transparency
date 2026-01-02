<!-- Navigation Menu V2: Colorful Gradient Accent (Subtle) -->
<style>
    .nav-v2 {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: linear-gradient(90deg, var(--panel) 0%, var(--panel) 100%);
        border-bottom: 2px solid transparent;
        border-image: linear-gradient(90deg, rgba(26,26,26,0.1), rgba(26,26,26,0.05), rgba(26,26,26,0.1)) 1;
        backdrop-filter: var(--blur);
    }
    :root.dark .nav-v2 {
        border-image: linear-gradient(90deg, rgba(245,245,245,0.15), rgba(245,245,245,0.08), rgba(245,245,245,0.15)) 1;
    }
    
    .nav-v2-wrap {
        max-width: 1320px;
        margin: 0 auto;
        padding: 18px 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 32px;
    }
    
    .nav-v2-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        flex-shrink: 0;
    }
    .nav-v2-badge {
        width: 44px;
        height: 44px;
        border-radius: 8px;
        background: linear-gradient(135deg, rgba(26,26,26,0.06), rgba(26,26,26,0.03));
        border: 1.5px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        cursor: pointer;
        transition: all 200ms cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .nav-v2-badge:hover {
        transform: scale(1.08) rotate(5deg);
        border-color: var(--ink);
    }
    
    .nav-v2-center {
        display: flex;
        align-items: center;
        gap: 28px;
        flex: 1;
        justify-content: center;
    }
    
    .nav-v2-section {
        position: relative;
    }
    .nav-v2-section-trigger {
        padding: 8px 12px;
        border-radius: 6px;
        border: 1px solid transparent;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: var(--ink);
        cursor: pointer;
        transition: all 160ms ease;
        background: transparent;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .nav-v2-section-trigger:hover {
        background: var(--bg);
        border-color: var(--border);
    }
    
    .nav-v2-menu {
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        margin-top: 12px;
        background: var(--panel);
        border: 1px solid var(--border);
        border-radius: 10px;
        min-width: 260px;
        box-shadow: var(--shadow);
        backdrop-filter: var(--blur);
        opacity: 0;
        pointer-events: none;
        transform: translateX(-50%) translateY(-8px);
        transition: all 200ms ease;
        overflow: hidden;
    }
    .nav-v2-section:hover .nav-v2-menu {
        opacity: 1;
        pointer-events: all;
        transform: translateX(-50%) translateY(0);
    }
    
    .nav-v2-item {
        padding: 16px 18px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 14px;
        transition: all 140ms ease;
        color: var(--ink);
        text-decoration: none;
    }
    .nav-v2-item:last-child { border-bottom: none; }
    .nav-v2-item:hover {
        background: var(--bg);
        padding-left: 24px;
    }
    .nav-v2-item-icon {
        font-size: 22px;
        min-width: 24px;
        text-align: center;
    }
    .nav-v2-item-label {
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }
    
    .nav-v2-right {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }
    .nav-v2-toggle {
        padding: 8px 12px;
        border: 1px solid var(--border);
        border-radius: 6px;
        background: transparent;
        cursor: pointer;
        font-size: 14px;
        transition: all 160ms ease;
    }
    .nav-v2-toggle:hover {
        border-color: var(--ink);
        background: var(--card);
    }
    .nav-v2-btn {
        padding: 10px 18px;
        border-radius: 6px;
        border: 1.5px solid var(--ink);
        background: var(--ink);
        color: var(--bg);
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        cursor: pointer;
        transition: all 160ms ease;
    }
    .nav-v2-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.18);
    }

    @media (max-width: 1024px) {
        .nav-v2-wrap {
            gap: 16px;
            padding: 16px 24px;
        }
        .nav-v2-center {
            gap: 16px;
        }
        .nav-v2-menu {
            min-width: 220px;
        }
    }
    
    @media (max-width: 768px) {
        .nav-v2-wrap {
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 12px 16px;
        }
        .nav-v2-center {
            order: 3;
            width: 100%;
            justify-content: flex-start;
            gap: 8px;
            margin-top: 8px;
        }
        .nav-v2-section-trigger {
            padding: 6px 10px;
            font-size: 11px;
        }
    }
</style>

<nav class="nav-v2">
    <div class="nav-v2-wrap">
        <a href="/" class="nav-v2-brand">
            <div class="nav-v2-badge">🔍</div>
        </a>

        <div class="nav-v2-center">
            <div class="nav-v2-section">
                <button class="nav-v2-section-trigger">
                    📊 PILLARS <span style="font-size: 10px; opacity: 0.6;">▼</span>
                </button>
                <div class="nav-v2-menu">
                    <a href="/metrics" class="nav-v2-item">
                        <span class="nav-v2-item-icon">💰</span>
                        <span class="nav-v2-item-label">Transparency</span>
                    </a>
                    <a href="/metrics" class="nav-v2-item">
                        <span class="nav-v2-item-icon">🌍</span>
                        <span class="nav-v2-item-label">Environment</span>
                    </a>
                    <a href="/campaigns" class="nav-v2-item">
                        <span class="nav-v2-item-icon">⚖️</span>
                        <span class="nav-v2-item-label">Civic Forum</span>
                    </a>
                    <a href="/technologies" class="nav-v2-item">
                        <span class="nav-v2-item-icon">💡</span>
                        <span class="nav-v2-item-label">Innovation</span>
                    </a>
                </div>
            </div>

            <a href="/case-studies" class="nav-v2-section-trigger" style="border: 1px solid transparent;">📚 Cases</a>
            <a href="/events" class="nav-v2-section-trigger" style="border: 1px solid transparent;">🎯 Events</a>
        </div>

        <div class="nav-v2-right">
            <button class="nav-v2-toggle" onclick="toggleTheme()">☀️/🌙</button>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-v2-btn">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="nav-v2-btn">Log In</a>
                @endauth
            @endif
        </div>
    </div>
</nav>
