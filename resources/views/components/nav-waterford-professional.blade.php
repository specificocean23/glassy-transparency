<!-- 🍀 Waterford Professional Navigation: Dropdown Pillars Menu with Green Theme -->
<style>
    /* ===== CSS Variables: Waterford Green Palette ===== */
    :root {
        /* Light Mode */
        --wf-green-dark: #1a472a;      /* Deep forest green */
        --wf-green-main: #2d6a4f;      /* Professional Waterford green */
        --wf-green-light: #40916c;     /* Accent green */
        --wf-green-pale: #52b788;      /* Light professional green */
        --wf-green-mint: #74c69d;      /* Very light green */
        --wf-green-bg: #f1faee;        /* Off-white with green tint */
        --wf-accent: #e63946;          /* Red accent for urgency/important */
        
        /* Text & UI */
        --wf-text-primary: #1a472a;
        --wf-text-secondary: #555;
        --wf-border: #d9e8df;
        --wf-shadow: 0 2px 8px rgba(26, 71, 42, 0.1);
        --wf-shadow-hover: 0 8px 24px rgba(26, 71, 42, 0.15);
    }
    
    :root.dark {
        /* Dark Mode */
        --wf-green-dark: #0d2818;
        --wf-green-main: #1b4332;
        --wf-green-light: #2d6a4f;
        --wf-green-pale: #40916c;
        --wf-green-mint: #52b788;
        --wf-green-bg: #1a1a1a;
        --wf-accent: #ff6b6b;
        
        --wf-text-primary: #e8f5e9;
        --wf-text-secondary: #b0bec5;
        --wf-border: #263238;
        --wf-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        --wf-shadow-hover: 0 8px 24px rgba(0, 0, 0, 0.4);
    }
    
    /* ===== Navigation Container ===== */
    .nav-waterford {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: linear-gradient(135deg, var(--wf-green-dark) 0%, var(--wf-green-main) 100%);
        border-bottom: 3px solid var(--wf-green-light);
        backdrop-filter: blur(12px);
        box-shadow: var(--wf-shadow);
        padding: 0;
        margin: 0;
    }
    
    .nav-waterford-inner {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 32px;
        height: 72px;
    }
    
    /* ===== Brand Section ===== */
    .nav-waterford-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        color: var(--wf-green-mint);
        font-weight: 800;
        font-size: 18px;
        letter-spacing: -0.5px;
        flex-shrink: 0;
        transition: all 200ms ease;
        white-space: nowrap;
    }
    
    .nav-waterford-brand:hover {
        color: #fff;
        transform: translateY(-2px);
    }
    
    .nav-waterford-badge {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--wf-green-pale), var(--wf-green-mint));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        font-weight: 900;
        box-shadow: 0 4px 12px rgba(26, 71, 42, 0.3);
        flex-shrink: 0;
    }
    
    :root.dark .nav-waterford-badge {
        box-shadow: 0 4px 12px rgba(74, 193, 136, 0.2);
    }
    
    /* ===== Navigation Links ===== */
    .nav-waterford-links {
        display: flex;
        align-items: center;
        gap: 4px;
        flex: 1;
        justify-content: center;
    }
    
    .nav-waterford-link,
    .nav-waterford-pillars-trigger {
        padding: 10px 18px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        color: var(--wf-green-mint);
        background: transparent;
        border: 2px solid transparent;
        cursor: pointer;
        transition: all 180ms ease;
        text-decoration: none;
        white-space: nowrap;
        position: relative;
    }
    
    .nav-waterford-link:hover,
    .nav-waterford-pillars-trigger:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: var(--wf-green-mint);
        color: #fff;
        transform: translateY(-1px);
    }
    
    .nav-waterford-link.active {
        background: var(--wf-green-light);
        border-color: var(--wf-green-pale);
        color: #fff;
        box-shadow: 0 2px 8px rgba(26, 71, 42, 0.2);
    }
    
    /* ===== Pillars Dropdown ===== */
    .nav-waterford-pillars {
        position: relative;
    }
    
    .nav-waterford-pillars-trigger {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .nav-waterford-pillars-trigger::after {
        content: '▼';
        font-size: 10px;
        transition: transform 200ms ease;
    }
    
    .nav-waterford-pillars.open .nav-waterford-pillars-trigger::after {
        transform: rotateZ(-180deg);
    }
    
    .nav-waterford-pillars-menu {
        position: absolute;
        top: calc(100% + 8px);
        left: 50%;
        transform: translateX(-50%);
        background: var(--wf-green-bg);
        border: 2px solid var(--wf-green-light);
        border-radius: 8px;
        min-width: 280px;
        box-shadow: var(--wf-shadow-hover);
        backdrop-filter: blur(12px);
        opacity: 0;
        pointer-events: none;
        transform: translateX(-50%) translateY(-12px);
        transition: all 200ms cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        z-index: 1001;
    }
    
    .nav-waterford-pillars.open .nav-waterford-pillars-menu {
        opacity: 1;
        pointer-events: all;
        transform: translateX(-50%) translateY(0);
    }
    
    .nav-waterford-pillar-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 16px;
        border-bottom: 1px solid var(--wf-border);
        text-decoration: none;
        color: var(--wf-text-primary);
        transition: all 160ms ease;
    }
    
    :root.dark .nav-waterford-pillar-item {
        color: var(--wf-text-primary);
    }
    
    .nav-waterford-pillar-item:hover {
        background: var(--wf-green-light);
        color: #fff;
        padding-left: 20px;
    }
    
    :root.dark .nav-waterford-pillar-item:hover {
        background: var(--wf-green-main);
        color: #fff;
    }
    
    .nav-waterford-pillar-item:last-child {
        border-bottom: none;
    }
    
    .nav-waterford-pillar-icon {
        font-size: 20px;
        min-width: 24px;
        text-align: center;
        flex-shrink: 0;
    }
    
    .nav-waterford-pillar-text {
        flex: 1;
    }
    
    .nav-waterford-pillar-title {
        font-size: 13px;
        font-weight: 700;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .nav-waterford-pillar-desc {
        font-size: 11px;
        color: var(--wf-text-secondary);
        margin: 2px 0 0 0;
    }
    
    :root.dark .nav-waterford-pillar-desc {
        color: var(--wf-text-secondary);
    }
    
    .nav-waterford-pillar-item:hover .nav-waterford-pillar-desc {
        color: rgba(255, 255, 255, 0.85);
    }
    
    /* ===== Right Actions ===== */
    .nav-waterford-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }
    
    .nav-waterford-theme-btn {
        padding: 8px 12px;
        border: 2px solid var(--wf-green-mint);
        border-radius: 6px;
        background: transparent;
        color: var(--wf-green-mint);
        font-size: 16px;
        cursor: pointer;
        transition: all 180ms ease;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
    }
    
    .nav-waterford-theme-btn:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: #fff;
        color: #fff;
        transform: scale(1.1);
    }
    
    .nav-waterford-auth-btn {
        padding: 9px 18px;
        border: 2px solid var(--wf-green-mint);
        border-radius: 6px;
        background: var(--wf-green-light);
        color: #fff;
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
        text-decoration: none;
        transition: all 180ms ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }
    
    .nav-waterford-auth-btn:hover {
        background: var(--wf-green-pale);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(26, 71, 42, 0.3);
    }
    
    :root.dark .nav-waterford-auth-btn:hover {
        box-shadow: 0 6px 16px rgba(74, 193, 136, 0.2);
    }
    
    /* ===== Responsive ===== */
    @media (max-width: 1024px) {
        .nav-waterford-inner {
            padding: 0 24px;
            gap: 24px;
        }
        
        .nav-waterford-link {
            padding: 8px 12px;
            font-size: 13px;
        }
    }
    
    @media (max-width: 768px) {
        .nav-waterford-inner {
            padding: 0 16px;
            gap: 12px;
            height: 64px;
        }
        
        .nav-waterford-brand {
            font-size: 16px;
            gap: 8px;
        }
        
        .nav-waterford-badge {
            width: 36px;
            height: 36px;
            font-size: 18px;
        }
        
        .nav-waterford-links {
            gap: 2px;
        }
        
        .nav-waterford-link,
        .nav-waterford-pillars-trigger {
            padding: 6px 10px;
            font-size: 12px;
        }
        
        .nav-waterford-pillars-menu {
            min-width: 240px;
        }
        
        .nav-waterford-auth-btn {
            padding: 8px 14px;
            font-size: 11px;
        }
    }
</style>

<nav class="nav-waterford">
    <div class="nav-waterford-inner">
        <!-- Brand -->
        <a href="/" class="nav-waterford-brand">
            <div class="nav-waterford-badge">🍀</div>
            <span>Transparency.ie</span>
        </a>
        
        <!-- Navigation Links -->
        <div class="nav-waterford-links">
            <a href="/" class="nav-waterford-link @if(request()->is('/')) active @endif">
                🏠 Home
            </a>
            
            <!-- Pillars Dropdown -->
            <div class="nav-waterford-pillars">
                <button type="button" class="nav-waterford-pillars-trigger" data-wf-pillars-toggle>
                    📊 Pillars
                </button>
                <div class="nav-waterford-pillars-menu">
                    <a href="/transparency" class="nav-waterford-pillar-item">
                        <span class="nav-waterford-pillar-icon">💰</span>
                        <div class="nav-waterford-pillar-text">
                            <p class="nav-waterford-pillar-title">Transparency</p>
                            <p class="nav-waterford-pillar-desc">Budgets & spending tracking</p>
                        </div>
                    </a>
                    <a href="/metrics" class="nav-waterford-pillar-item">
                        <span class="nav-waterford-pillar-icon">🌍</span>
                        <div class="nav-waterford-pillar-text">
                            <p class="nav-waterford-pillar-title">Environment</p>
                            <p class="nav-waterford-pillar-desc">Climate & sustainability data</p>
                        </div>
                    </a>
                    <a href="/waterford" class="nav-waterford-pillar-item">
                        <span class="nav-waterford-pillar-icon">🏛️</span>
                        <div class="nav-waterford-pillar-text">
                            <p class="nav-waterford-pillar-title">Waterford</p>
                            <p class="nav-waterford-pillar-desc">Council spending & initiatives</p>
                        </div>
                    </a>
                    <a href="/innovation" class="nav-waterford-pillar-item">
                        <span class="nav-waterford-pillar-icon">💡</span>
                        <div class="nav-waterford-pillar-text">
                            <p class="nav-waterford-pillar-title">Innovation</p>
                            <p class="nav-waterford-pillar-desc">Technologies & trials</p>
                        </div>
                    </a>
                </div>
            </div>
            
            <a href="/case-studies" class="nav-waterford-link @if(request()->is('case-studies*')) active @endif">
                📚 Case Studies
            </a>
            
            <a href="/events" class="nav-waterford-link @if(request()->is('events*')) active @endif">
                🎯 Events
            </a>
        </div>
        
        <!-- Right Actions -->
        <div class="nav-waterford-actions">
            <button type="button" class="nav-waterford-theme-btn" onclick="toggleTheme()" title="Toggle light/dark mode">
                <span id="theme-toggle-icon">☀️</span>
            </button>
            
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/transparency') }}" class="nav-waterford-auth-btn">
                        👤 Transparency
                    </a>
                @else
                    <button type="button" class="nav-waterford-auth-btn" onclick="openEnjoydeiseLogin()">
                        🔐 Login
                    </button>
                @endauth
            @endif
        </div>
    </div>
</nav>

<script>
    // Theme Toggle
    function toggleTheme() {
        const html = document.documentElement;
        const isDark = html.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        updateThemeIcon();
    }
    
    function updateThemeIcon() {
        const icon = document.getElementById('theme-toggle-icon');
        if (document.documentElement.classList.contains('dark')) {
            icon.textContent = '🌙';
        } else {
            icon.textContent = '☀️';
        }
    }
    
    // Initialize theme on load
    document.addEventListener('DOMContentLoaded', () => {
        const theme = localStorage.getItem('theme') || 'light';
        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
        }
        updateThemeIcon();

        const pillars = document.querySelector('.nav-waterford-pillars');
        const toggle = document.querySelector('[data-wf-pillars-toggle]');
        const menu = pillars ? pillars.querySelector('.nav-waterford-pillars-menu') : null;

        if (pillars && toggle && menu) {
            const closeMenu = () => pillars.classList.remove('open');

            toggle.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                pillars.classList.toggle('open');
            });

            menu.addEventListener('click', (e) => e.stopPropagation());

            document.addEventListener('click', (e) => {
                if (!pillars.contains(e.target)) {
                    closeMenu();
                }
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    closeMenu();
                }
            });
        }
    });
    
    // Enjoydeise Login (placeholder - will integrate real OAuth)
    function openEnjoydeiseLogin() {
        // TODO: Replace with actual Enjoydeise OAuth flow
        alert('Enjoydeise login integration coming soon!');
        // window.location.href = '/auth/enjoydeise';
    }
</script>
