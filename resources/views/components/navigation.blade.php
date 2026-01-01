<!-- Navigation Component - Menu Option 1: Pillar-Based with Submenu -->
<nav class="nav-wrapper" x-data="{ open: false, submenu: null }">
    <div class="nav-container">
        <!-- Logo/Brand -->
        <div class="nav-brand">
            <a href="/">
                <div class="nav-badge"></div>
                <div>
                    <div class="nav-label">Public Observatory</div>
                    <div class="nav-title">Transparency.ie</div>
                </div>
            </a>
        </div>

        <!-- Primary Navigation - Pillar-Based -->
        <div class="nav-primary">
            <!-- Pillar 1: Transparency Engine -->
            <div class="nav-pillar" @mouseenter="submenu = 'transparency'" @mouseleave="submenu = null">
                <a href="/metrics" class="nav-pillar-link">
                    <span class="nav-pillar-icon">💰</span>
                    <span class="nav-pillar-name">Transparency</span>
                    <span class="nav-indicator">↓</span>
                </a>
                <div class="nav-submenu" v-show="submenu === 'transparency'">
                    <a href="/metrics">Budget Metrics</a>
                    <a href="/metrics#budgets">Spending Data</a>
                    <a href="/metrics#departments">By Department</a>
                </div>
            </div>

            <!-- Pillar 2: Environmental Atlas -->
            <div class="nav-pillar" @mouseenter="submenu = 'environment'" @mouseleave="submenu = null">
                <a href="/metrics" class="nav-pillar-link">
                    <span class="nav-pillar-icon">🌍</span>
                    <span class="nav-pillar-name">Environment</span>
                    <span class="nav-indicator">↓</span>
                </a>
                <div class="nav-submenu" v-show="submenu === 'environment'">
                    <a href="/metrics#emissions">Emissions</a>
                    <a href="/metrics#renewables">Renewables</a>
                    <a href="/metrics#climate">Climate Goals</a>
                </div>
            </div>

            <!-- Pillar 3: Civic Forum -->
            <div class="nav-pillar" @mouseenter="submenu = 'civic'" @mouseleave="submenu = null">
                <a href="/campaigns" class="nav-pillar-link">
                    <span class="nav-pillar-icon">⚖️</span>
                    <span class="nav-pillar-name">Civic Action</span>
                    <span class="nav-indicator">↓</span>
                </a>
                <div class="nav-submenu" v-show="submenu === 'civic'">
                    <a href="/campaigns">Active Campaigns</a>
                    <a href="/events">Upcoming Events</a>
                    <a href="/case-studies">Success Stories</a>
                </div>
            </div>

            <!-- Pillar 4: Innovation Lab -->
            <div class="nav-pillar" @mouseenter="submenu = 'innovation'" @mouseleave="submenu = null">
                <a href="/technologies" class="nav-pillar-link">
                    <span class="nav-pillar-icon">💡</span>
                    <span class="nav-pillar-name">Innovation</span>
                    <span class="nav-indicator">↓</span>
                </a>
                <div class="nav-submenu" v-show="submenu === 'innovation'">
                    <a href="/technologies">Tech Overview</a>
                    <a href="/technologies#storage">Energy Storage</a>
                    <a href="/technologies#grid">Grid Solutions</a>
                </div>
            </div>
        </div>

        <!-- Secondary Navigation -->
        <div class="nav-secondary">
            <button class="nav-theme-toggle" @click="toggleTheme()" title="Toggle dark/light mode">
                <span class="theme-icon">☀️</span>
                <span class="theme-icon-alt">🌙</span>
            </button>
            @auth
                <a href="/dashboard" class="nav-btn">Dashboard</a>
            @else
                <a href="/login" class="nav-btn">Sign In</a>
            @endauth
        </div>
    </div>
</nav>

<style>
    .nav-wrapper {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: var(--panel);
        border-bottom: 1px solid var(--border);
        backdrop-filter: var(--blur);
        box-shadow: 0 2px 16px rgba(0,0,0,0.04);
    }
    :root.dark .nav-wrapper {
        box-shadow: 0 2px 16px rgba(0,0,0,0.2);
    }

    .nav-container {
        max-width: 1320px;
        margin: 0 auto;
        padding: 12px 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 40px;
    }

    .nav-brand {
        flex-shrink: 0;
    }
    .nav-brand a {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        color: inherit;
    }
    .nav-badge {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--card);
        border: 2px solid var(--border);
        flex-shrink: 0;
    }
    .nav-label {
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: var(--subtle);
        font-weight: 600;
    }
    .nav-title {
        font-size: 18px;
        font-weight: 800;
        letter-spacing: -0.5px;
        color: var(--ink);
    }

    .nav-primary {
        display: flex;
        align-items: center;
        gap: 8px;
        flex: 1;
    }

    .nav-pillar {
        position: relative;
    }
    .nav-pillar-link {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 8px;
        border: 1px solid transparent;
        transition: all 160ms ease;
        color: inherit;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
    }
    .nav-pillar-link:hover {
        background: var(--card);
        border-color: var(--border);
    }
    .nav-pillar-icon {
        font-size: 16px;
    }
    .nav-pillar-name {
        font-size: 13px;
        font-weight: 700;
    }
    .nav-indicator {
        font-size: 11px;
        opacity: 0.6;
        transition: transform 200ms ease;
    }
    .nav-pillar:hover .nav-indicator {
        transform: translateY(2px);
    }

    .nav-submenu {
        position: absolute;
        top: 100%;
        left: 0;
        margin-top: 4px;
        background: var(--panel);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 8px;
        min-width: 200px;
        box-shadow: 0 16px 40px rgba(0,0,0,0.12);
        backdrop-filter: var(--blur);
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    :root.dark .nav-submenu {
        box-shadow: 0 16px 40px rgba(0,0,0,0.4);
    }
    .nav-submenu a {
        padding: 10px 12px;
        border-radius: 6px;
        font-size: 13px;
        color: var(--ink);
        text-decoration: none;
        transition: all 160ms ease;
    }
    .nav-submenu a:hover {
        background: var(--card);
        color: var(--ink);
        padding-left: 16px;
    }

    .nav-secondary {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }

    .nav-theme-toggle {
        position: relative;
        width: 40px;
        height: 40px;
        border: 1px solid var(--border);
        border-radius: 8px;
        background: var(--card);
        cursor: pointer;
        transition: all 160ms ease;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    .nav-theme-toggle:hover {
        border-color: var(--ink);
        background: var(--bg);
    }
    .theme-icon {
        display: none;
    }
    :root.dark .theme-icon {
        display: inline;
    }
    :root.dark .theme-icon-alt {
        display: none;
    }
    .theme-icon-alt {
        display: inline;
    }

    .nav-btn {
        padding: 10px 18px;
        border: 1.5px solid var(--ink);
        background: var(--ink);
        color: var(--bg);
        border-radius: 8px;
        font-weight: 700;
        font-size: 13px;
        text-decoration: none;
        transition: all 160ms ease;
    }
    .nav-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    :root.dark .nav-btn {
        color: var(--bg);
    }

    @media (max-width: 1024px) {
        .nav-container {
            gap: 20px;
            padding: 12px 20px;
        }
        .nav-primary {
            gap: 4px;
        }
        .nav-pillar-name {
            display: none;
        }
    }

    @media (max-width: 640px) {
        .nav-container {
            flex-wrap: wrap;
            gap: 8px;
        }
        .nav-brand {
            width: 100%;
        }
        .nav-primary {
            order: 3;
            width: 100%;
            gap: 4px;
        }
        .nav-pillar-link {
            padding: 8px 10px;
        }
    }
</style>
