<!-- Navigation Variant 1: Glassy Gradient with Pillars Dropdown -->
<style>
    .nav-v1 {
        position: relative;
        background: var(--panel);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 16px 24px;
        backdrop-filter: blur(24px);
        box-shadow: var(--shadow);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
    }
    .nav-v1 .brand-section {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .nav-v1 .brand-badge-v1 {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: 2px solid rgba(102, 126, 234, 0.3);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.25);
    }
    :root.dark .nav-v1 .brand-badge-v1 {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: 2px solid rgba(102, 126, 234, 0.5);
    }
    .nav-v1 .brand-text { display: flex; flex-direction: column; gap: 2px; }
    .nav-v1 .brand-small { font-size: 11px; text-transform: uppercase; letter-spacing: 0.12em; color: var(--subtle); font-weight: 600; }
    .nav-v1 .brand-title { font-size: 24px; font-weight: 800; letter-spacing: -0.6px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    
    .nav-v1 .menu-section {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    .nav-v1 .nav-item {
        padding: 10px 18px;
        border: 1px solid var(--border);
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        transition: all 200ms ease;
        background: transparent;
        cursor: pointer;
        position: relative;
    }
    .nav-v1 .nav-item:hover {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.08);
        transform: translateY(-1px);
    }
    .nav-v1 .nav-item.has-dropdown::after {
        content: '▾';
        margin-left: 6px;
        font-size: 10px;
    }
    .nav-v1 .dropdown {
        position: absolute;
        top: calc(100% + 8px);
        left: 0;
        min-width: 240px;
        background: var(--panel);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 8px;
        backdrop-filter: blur(24px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 200ms ease;
        z-index: 1000;
    }
    .nav-v1 .nav-item:hover .dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    .nav-v1 .dropdown-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        border-radius: 8px;
        transition: all 150ms ease;
        text-decoration: none;
        color: var(--ink);
    }
    .nav-v1 .dropdown-item:hover {
        background: rgba(102, 126, 234, 0.12);
    }
    .nav-v1 .dropdown-icon {
        font-size: 20px;
        min-width: 24px;
        text-align: center;
    }
    .nav-v1 .dropdown-text {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    .nav-v1 .dropdown-title {
        font-size: 14px;
        font-weight: 600;
    }
    .nav-v1 .dropdown-desc {
        font-size: 12px;
        color: var(--subtle);
        line-height: 1.3;
    }
    .nav-v1 .theme-btn {
        padding: 10px 14px;
        border: 1px solid var(--border);
        border-radius: 10px;
        background: transparent;
        cursor: pointer;
        font-size: 18px;
        transition: all 200ms ease;
    }
    .nav-v1 .theme-btn:hover {
        background: rgba(102, 126, 234, 0.08);
        transform: rotate(180deg);
    }
    .nav-v1 .auth-btn {
        padding: 10px 20px;
        border-radius: 10px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: 700;
        font-size: 14px;
        border: none;
        cursor: pointer;
        transition: all 200ms ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }
    .nav-v1 .auth-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }
    
    @media (max-width: 768px) {
        .nav-v1 { padding: 16px; gap: 16px; }
        .nav-v1 .menu-section { width: 100%; justify-content: center; }
    }
</style>

<nav class="nav-v1">
    <div class="brand-section">
        <div class="brand-badge-v1"></div>
        <div class="brand-text">
            <div class="brand-small">Public Observatory</div>
            <div class="brand-title">Transparency.ie</div>
        </div>
    </div>
    
    <div class="menu-section">
        <a href="/" class="nav-item">Home</a>
        
        <div class="nav-item has-dropdown">
            Four Pillars
            <div class="dropdown">
                <a href="/metrics" class="dropdown-item">
                    <div class="dropdown-icon">💰</div>
                    <div class="dropdown-text">
                        <div class="dropdown-title">Transparency Engine</div>
                        <div class="dropdown-desc">Track budgets & spending</div>
                    </div>
                </a>
                <a href="/metrics" class="dropdown-item">
                    <div class="dropdown-icon">🌍</div>
                    <div class="dropdown-text">
                        <div class="dropdown-title">Environmental Atlas</div>
                        <div class="dropdown-desc">Climate & emissions data</div>
                    </div>
                </a>
                <a href="/campaigns" class="dropdown-item">
                    <div class="dropdown-icon">⚖️</div>
                    <div class="dropdown-text">
                        <div class="dropdown-title">Civic Forum</div>
                        <div class="dropdown-desc">Join campaigns & advocacy</div>
                    </div>
                </a>
                <a href="/technologies" class="dropdown-item">
                    <div class="dropdown-icon">💡</div>
                    <div class="dropdown-text">
                        <div class="dropdown-title">Innovation Lab</div>
                        <div class="dropdown-desc">Explore new technologies</div>
                    </div>
                </a>
            </div>
        </div>
        
        <a href="/case-studies" class="nav-item">Case Studies</a>
        <a href="/events" class="nav-item">Events</a>
        
        <button type="button" class="theme-btn" onclick="toggleTheme()">☀️</button>
        
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="auth-btn">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="auth-btn">Log in</a>
            @endauth
        @endif
    </div>
</nav>
