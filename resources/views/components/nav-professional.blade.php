<!-- Professional Monochrome Navigation for Homepage -->
<style>
    :root {
        --bg: #f8f8f8;
        --panel: #ffffff;
        --subtle: #666666;
        --ink: #1a1a1a;
        --border: #e0e0e0;
        --blur: blur(20px);
        --card: #ffffff;
        --shadow: 0 20px 60px rgba(0,0,0,0.08);
    }
    
    :root.dark {
        --bg: #0a0a0a;
        --panel: #1a1a1a;
        --subtle: #999999;
        --ink: #f5f5f5;
        --border: #333333;
        --card: #242424;
        --shadow: 0 20px 60px rgba(0,0,0,0.4);
    }
    
    /* ===== Navigation Container ===== */
    .nav-professional {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: var(--panel);
        border-bottom: 1px solid var(--border);
        backdrop-filter: var(--blur);
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        padding: 0;
        margin: 0;
    }
    
    .nav-professional-inner {
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
    .nav-professional-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        color: var(--ink);
        font-weight: 800;
        font-size: 18px;
        letter-spacing: -0.5px;
        flex-shrink: 0;
        transition: all 200ms ease;
        white-space: nowrap;
    }
    
    .nav-professional-brand:hover {
        opacity: 0.7;
    }
    
    .nav-professional-badge {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--card);
        border: 2px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 900;
        flex-shrink: 0;
    }
    
    /* ===== Navigation Links ===== */
    .nav-professional-links {
        display: flex;
        align-items: center;
        gap: 4px;
        flex: 1;
        justify-content: center;
    }
    
    .nav-professional-link,
    .nav-professional-pillars-trigger {
        padding: 10px 16px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        color: var(--subtle);
        background: transparent;
        border: 1px solid transparent;
        cursor: pointer;
        transition: all 160ms ease;
        text-decoration: none;
        white-space: nowrap;
        position: relative;
    }
    
    .nav-professional-link:hover,
    .nav-professional-pillars-trigger:hover {
        color: var(--ink);
        background: var(--card);
        border-color: var(--border);
    }
    
    .nav-professional-link.active {
        background: var(--card);
        color: var(--ink);
        border-color: var(--border);
        font-weight: 700;
    }
    
    /* ===== Pillars Dropdown ===== */
    .nav-professional-pillars {
        position: relative;
    }
    
    .nav-professional-pillars-trigger {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .nav-professional-pillars-trigger::after {
        content: '▼';
        font-size: 10px;
        transition: transform 200ms ease;
    }
    
    .nav-professional-pillars.open .nav-professional-pillars-trigger::after {
        transform: rotateZ(-180deg);
    }
    
    .nav-professional-pillars-menu {
        position: absolute;
        top: calc(100% + 8px);
        left: 50%;
        transform: translateX(-50%);
        background: var(--panel);
        border: 1px solid var(--border);
        border-radius: 8px;
        min-width: 280px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        backdrop-filter: var(--blur);
        opacity: 0;
        pointer-events: none;
        transform: translateX(-50%) translateY(-12px);
        transition: all 200ms cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        z-index: 1001;
    }
    
    .nav-professional-pillars.open .nav-professional-pillars-menu {
        opacity: 1;
        pointer-events: all;
        transform: translateX(-50%) translateY(0);
    }
    
    .nav-professional-pillar-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 16px;
        border-bottom: 1px solid var(--border);
        text-decoration: none;
        color: var(--ink);
        transition: all 160ms ease;
    }
    
    .nav-professional-pillar-item:hover {
        background: var(--card);
        color: var(--ink);
        padding-left: 20px;
    }
    
    .nav-professional-pillar-item:last-child {
        border-bottom: none;
    }
    
    .nav-professional-pillar-icon {
        font-size: 20px;
        min-width: 24px;
        text-align: center;
        flex-shrink: 0;
    }
    
    .nav-professional-pillar-text {
        flex: 1;
    }
    
    .nav-professional-pillar-title {
        font-size: 13px;
        font-weight: 700;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .nav-professional-pillar-desc {
        font-size: 11px;
        color: var(--subtle);
        margin: 2px 0 0 0;
    }
    
    .nav-professional-pillar-item:hover .nav-professional-pillar-desc {
        color: var(--subtle);
    }
    
    /* ===== Right Actions ===== */
    .nav-professional-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }
    
    .nav-professional-theme-btn {
        padding: 8px 12px;
        border: 1px solid var(--border);
        border-radius: 6px;
        background: var(--card);
        color: var(--ink);
        font-size: 14px;
        cursor: pointer;
        transition: all 160ms ease;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
    }
    
    .nav-professional-theme-btn:hover {
        border-color: var(--ink);
        background: var(--panel);
    }
    
    .nav-professional-auth-btn {
        padding: 9px 18px;
        border: 1.5px solid var(--ink);
        border-radius: 6px;
        background: var(--ink);
        color: var(--panel);
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
        text-decoration: none;
        transition: all 160ms ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }
    
    .nav-professional-auth-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    /* ===== Responsive ===== */
    @media (max-width: 1024px) {
        .nav-professional-inner {
            padding: 0 24px;
            gap: 24px;
        }
        
        .nav-professional-link {
            padding: 8px 12px;
            font-size: 13px;
        }
    }
    
    @media (max-width: 768px) {
        .nav-professional-inner {
            padding: 0 16px;
            gap: 12px;
            height: 64px;
        }
        
        .nav-professional-brand {
            font-size: 16px;
            gap: 8px;
        }
        
        .nav-professional-badge {
            width: 36px;
            height: 36px;
            font-size: 16px;
        }
        
        .nav-professional-links {
            gap: 2px;
        }
        
        .nav-professional-link,
        .nav-professional-pillars-trigger {
            padding: 6px 10px;
            font-size: 12px;
        }
        
        .nav-professional-pillars-menu {
            min-width: 240px;
        }
        
        .nav-professional-auth-btn {
            padding: 8px 14px;
            font-size: 11px;
        }
    }
</style>

<nav class="nav-professional">
    <div class="nav-professional-inner">
        <!-- Brand -->
        <a href="/" class="nav-professional-brand">
            <div class="nav-professional-badge">T</div>
            <span>Transparency.ie</span>
        </a>
        
        <!-- Navigation Links -->
        <div class="nav-professional-links">
            <a href="/" class="nav-professional-link @if(request()->is('/')) active @endif">
                🏠 Home
            </a>
            
            <!-- Pillars Dropdown -->
            <div class="nav-professional-pillars">
                <button type="button" class="nav-professional-pillars-trigger" data-pillars-toggle>
                    📊 Pillars
                </button>
                <div class="nav-professional-pillars-menu">
                    <a href="/transparency" class="nav-professional-pillar-item">
                        <span class="nav-professional-pillar-icon">💰</span>
                        <div class="nav-professional-pillar-text">
                            <p class="nav-professional-pillar-title">Transparency</p>
                            <p class="nav-professional-pillar-desc">Budgets & spending tracking</p>
                        </div>
                    </a>
                    <a href="/environment" class="nav-professional-pillar-item">
                        <span class="nav-professional-pillar-icon">🌍</span>
                        <div class="nav-professional-pillar-text">
                            <p class="nav-professional-pillar-title">Environment</p>
                            <p class="nav-professional-pillar-desc">Climate & sustainability data</p>
                        </div>
                    </a>
                    <a href="/waterford" class="nav-professional-pillar-item">
                        <span class="nav-professional-pillar-icon">🏛️</span>
                        <div class="nav-professional-pillar-text">
                            <p class="nav-professional-pillar-title">Waterford</p>
                            <p class="nav-professional-pillar-desc">Council spending & initiatives</p>
                        </div>
                    </a>
                    <a href="/technologies" class="nav-professional-pillar-item">
                        <span class="nav-professional-pillar-icon">💡</span>
                        <div class="nav-professional-pillar-text">
                            <p class="nav-professional-pillar-title">Innovation</p>
                            <p class="nav-professional-pillar-desc">Technologies & trials</p>
                        </div>
                    </a>
                </div>
            </div>
            
            <a href="/case-studies" class="nav-professional-link @if(request()->is('case-studies*')) active @endif">
                📚 Case Studies
            </a>
            
            <a href="/events" class="nav-professional-link @if(request()->is('events*')) active @endif">
                🎯 Events
            </a>
        </div>
        
        <!-- Right Actions -->
        <div class="nav-professional-actions">
            <button type="button" class="nav-professional-theme-btn" onclick="toggleTheme()" title="Toggle light/dark mode">
                <span id="theme-toggle-icon">☀️</span>
            </button>
            
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/transparency') }}" class="nav-professional-auth-btn">
                        👤 Transparency
                    </a>
                @else
                    <a href="{{ route('login') }}" class="nav-professional-auth-btn">
                        🔐 Login
                    </a>
                @endauth
            @endif
        </div>
    </div>
</nav>

<script>
    (() => {
        const root = document.documentElement;
        const icon = document.getElementById('theme-toggle-icon');
        const stored = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        const applyTheme = (mode) => {
            if (mode === 'dark') {
                root.classList.add('dark');
                if (icon) icon.textContent = '🌙';
            } else {
                root.classList.remove('dark');
                if (icon) icon.textContent = '☀️';
            }
        };

        applyTheme(stored || (prefersDark ? 'dark' : 'light'));

        window.toggleTheme = () => {
            const next = root.classList.contains('dark') ? 'light' : 'dark';
            localStorage.setItem('theme', next);
            applyTheme(next);
        };
    })();
</script>

<script>
    function updateThemeIcon() {
        const icon = document.getElementById('theme-toggle-icon');
        if (icon && document.documentElement.classList.contains('dark')) {
            icon.textContent = '🌙';
        } else if (icon) {
            icon.textContent = '☀️';
        }
    }
    
    // Update icon on load
    document.addEventListener('DOMContentLoaded', () => {
        updateThemeIcon();

        const pillars = document.querySelector('.nav-professional-pillars');
        const toggle = document.querySelector('[data-pillars-toggle]');
        const menu = pillars ? pillars.querySelector('.nav-professional-pillars-menu') : null;

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
</script>
