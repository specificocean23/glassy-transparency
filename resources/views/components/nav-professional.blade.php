<!-- Transparency.ie Navigation - Monochrome Focus -->
<style>
    :root {
        --bg: #f5f5f5;
        --panel: #ffffff;
        --subtle: #757575;
        --ink: #1a1a1a;
        --border: #e0e0e0;
        --blur: blur(20px);
        --card: #ffffff;
        --shadow: 0 2px 8px rgba(0,0,0,0.08);
        --accent: #1e3a8a;
    }
    
    :root.dark {
        --bg: #0f172a;
        --panel: #1e293b;
        --subtle: #94a3b8;
        --ink: #f1f5f9;
        --border: #334155;
        --card: #293548;
        --shadow: 0 2px 8px rgba(0,0,0,0.3);
        --accent: #93c5fd;
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
    
    .nav-professional-engage-btn {
        padding: 9px 18px;
        border: 1.5px solid var(--accent);
        border-radius: 6px;
        background: var(--accent);
        color: white;
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
        white-space: nowrap;
    }
    
    .nav-professional-engage-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(30, 58, 138, 0.25);
        background: var(--accent);
        filter: brightness(1.1);
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
            display: none;
        }
        
        .nav-professional-link,
        .nav-professional-pillars-trigger {
            padding: 6px 10px;
            font-size: 12px;
        }
        
        .nav-professional-pillars-menu {
            min-width: 240px;
        }
        
        .nav-professional-engage-btn {
            padding: 8px 12px;
            font-size: 11px;
            white-space: nowrap;
        }
    }
</style>

<nav class="nav-professional">
    <div class="nav-professional-inner">
        <!-- Brand -->
        <a href="/" class="nav-professional-brand">
            <div class="nav-professional-badge">💰</div>
            <span>Transparency.ie</span>
        </a>
        
        <!-- Navigation Links - Focused on New Features -->
        <div class="nav-professional-links">
            <a href="/" class="nav-professional-link @if(request()->is('/')) active @endif">
                📊 Dashboard
            </a>
            
            <a href="/timeline" class="nav-professional-link @if(request()->is('timeline*')) active @endif">
                📅 Timeline
            </a>
            
            <a href="/spending/explorer" class="nav-professional-link @if(request()->is('spending*')) active @endif">
                🔍 Spending
            </a>

            <a href="/environment" class="nav-professional-link @if(request()->is('environment*')) active @endif">
                🌍 Environment
            </a>

            <a href="/waterford-council" class="nav-professional-link @if(request()->is('waterford-council*')) active @endif">
                🏛️ Waterford Council
            </a>
            
            <a href="/admin/import" class="nav-professional-link @if(request()->is('admin*')) active @endif">
                📥 Import Data
            </a>
        </div>
        
        <!-- Right Actions -->
        <div class="nav-professional-actions">
            <!-- Engage CTA Button -->
            <a href="https://enjoyumunster.vercel.app" target="_blank" class="nav-professional-engage-btn" title="Join the conversation on enjoymunster.ie">
                💬 Engage
            </a>
            
            <button type="button" class="nav-professional-theme-btn" onclick="toggleTheme()" title="Toggle light/dark mode">
                <span id="theme-toggle-icon">☀️</span>
            </button>
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
    });
</script>
