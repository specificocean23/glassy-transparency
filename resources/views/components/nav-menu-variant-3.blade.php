<!-- Navigation Variant 3: Compact Neo-Brutalist with Mega Menu -->
<style>
    .nav-v3 {
        position: relative;
        background: var(--panel);
        border: 2px solid var(--ink);
        border-radius: 0;
        padding: 16px 24px;
        box-shadow: 6px 6px 0 var(--ink);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
    }
    :root.dark .nav-v3 {
        box-shadow: 6px 6px 0 var(--border);
    }
    
    .nav-v3 .brand-section-v3 {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .nav-v3 .brand-badge-v3 {
        width: 48px;
        height: 48px;
        border: 2px solid var(--ink);
        background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 50%, #ff7675 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 900;
        box-shadow: 4px 4px 0 var(--ink);
    }
    :root.dark .nav-v3 .brand-badge-v3 {
        box-shadow: 4px 4px 0 var(--border);
    }
    .nav-v3 .brand-title-v3 {
        font-size: 22px;
        font-weight: 900;
        letter-spacing: -0.5px;
        text-transform: uppercase;
    }
    
    .nav-v3 .menu-section-v3 {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .nav-v3 .nav-btn-v3 {
        padding: 10px 18px;
        border: 2px solid var(--ink);
        background: var(--card);
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 150ms ease;
        cursor: pointer;
        position: relative;
    }
    .nav-v3 .nav-btn-v3:hover {
        background: #ffeaa7;
        transform: translate(-2px, -2px);
        box-shadow: 4px 4px 0 var(--ink);
    }
    :root.dark .nav-v3 .nav-btn-v3:hover {
        box-shadow: 4px 4px 0 var(--border);
    }
    .nav-v3 .nav-btn-v3.pillars-mega {
        background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
    }
    
    .nav-v3 .mega-menu {
        position: absolute;
        top: calc(100% + 12px);
        left: 0;
        right: 0;
        background: var(--panel);
        border: 2px solid var(--ink);
        padding: 32px;
        box-shadow: 8px 8px 0 var(--ink);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-20px);
        transition: all 250ms cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 1000;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
    }
    :root.dark .nav-v3 .mega-menu {
        box-shadow: 8px 8px 0 var(--border);
    }
    .nav-v3 .nav-btn-v3.pillars-mega:hover .mega-menu,
    .nav-v3 .mega-menu:hover {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    .nav-v3 .mega-card {
        padding: 20px;
        border: 2px solid var(--ink);
        background: var(--card);
        transition: all 150ms ease;
        cursor: pointer;
    }
    .nav-v3 .mega-card:hover {
        background: #ffeaa7;
        transform: translate(-3px, -3px);
        box-shadow: 6px 6px 0 var(--ink);
    }
    :root.dark .nav-v3 .mega-card:hover {
        box-shadow: 6px 6px 0 var(--border);
    }
    .nav-v3 .mega-icon {
        font-size: 36px;
        margin-bottom: 12px;
    }
    .nav-v3 .mega-title {
        font-size: 18px;
        font-weight: 900;
        margin-bottom: 8px;
        text-transform: uppercase;
    }
    .nav-v3 .mega-desc {
        font-size: 13px;
        color: var(--subtle);
        line-height: 1.5;
    }
    
    .nav-v3 .theme-btn-v3 {
        padding: 10px 14px;
        border: 2px solid var(--ink);
        background: var(--card);
        cursor: pointer;
        font-size: 18px;
        transition: all 150ms ease;
    }
    .nav-v3 .theme-btn-v3:hover {
        background: #fdcb6e;
        transform: translate(-2px, -2px);
        box-shadow: 4px 4px 0 var(--ink);
    }
    :root.dark .nav-v3 .theme-btn-v3:hover {
        box-shadow: 4px 4px 0 var(--border);
    }
    
    .nav-v3 .auth-btn-v3 {
        padding: 10px 20px;
        border: 2px solid var(--ink);
        background: linear-gradient(135deg, #ff7675 0%, #fd79a8 100%);
        color: white;
        font-weight: 900;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 150ms ease;
        text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.3);
    }
    .nav-v3 .auth-btn-v3:hover {
        transform: translate(-2px, -2px);
        box-shadow: 4px 4px 0 var(--ink);
    }
    :root.dark .nav-v3 .auth-btn-v3:hover {
        box-shadow: 4px 4px 0 var(--border);
    }
    
    @media (max-width: 768px) {
        .nav-v3 { padding: 16px; gap: 16px; }
        .nav-v3 .menu-section-v3 { flex-wrap: wrap; justify-content: center; }
        .nav-v3 .mega-menu { grid-template-columns: 1fr; }
    }
</style>

<nav class="nav-v3">
    <div class="brand-section-v3">
        <div class="brand-badge-v3">T</div>
        <div class="brand-title-v3">Transparency</div>
    </div>
    
    <div class="menu-section-v3">
        <a href="/" class="nav-btn-v3">Home</a>
        
        <div class="nav-btn-v3 pillars-mega">
            4 Pillars
            <div class="mega-menu">
                <a href="/metrics" class="mega-card">
                    <div class="mega-icon">💰</div>
                    <div class="mega-title">Transparency</div>
                    <div class="mega-desc">Track €104B in budgets across 47 departments</div>
                </a>
                <a href="/metrics" class="mega-card">
                    <div class="mega-icon">🌍</div>
                    <div class="mega-title">Environment</div>
                    <div class="mega-desc">32 climate metrics, emissions tracking</div>
                </a>
                <a href="/campaigns" class="mega-card">
                    <div class="mega-icon">⚖️</div>
                    <div class="mega-title">Civic Forum</div>
                    <div class="mega-desc">14 active campaigns, 18K supporters</div>
                </a>
                <a href="/technologies" class="mega-card">
                    <div class="mega-icon">💡</div>
                    <div class="mega-title">Innovation</div>
                    <div class="mega-desc">Energy storage, grid tech trials</div>
                </a>
            </div>
        </div>
        
        <a href="/case-studies" class="nav-btn-v3">Studies</a>
        <a href="/events" class="nav-btn-v3">Events</a>
        
        <button type="button" class="theme-btn-v3" onclick="toggleTheme()">☀️</button>
        
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="auth-btn-v3">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="auth-btn-v3">Login</a>
            @endauth
        @endif
    </div>
</nav>
