<!--
NAVIGATION VARIATION 3: Modern Card-Based Pillars
Design Philosophy: Pillar sections as distinct cards with inline menu toggles
- Each pillar appears as a clickable card/button
- When clicked, a mini-menu appears directly below
- More visual/modern than variation 1
- Better use of whitespace and visual hierarchy
- Slightly more colorful with subtle pillar branding

Usage: @include('components.navigation-alt-2')
-->
<nav class="nav-wrapper-alt2" x-data="{ activeMenu: null }">
    <div class="nav-container-alt2">
        <!-- Logo/Brand -->
        <a href="/" class="nav-brand-alt2">
            <div class="nav-badge-alt2">💎</div>
            <div class="nav-branding-alt2">
                <small>Public Observatory</small>
                <h1>Transparency.ie</h1>
            </div>
        </a>

        <!-- Primary Navigation - Card-Based Pillars -->
        <div class="nav-pillars-alt2">
            <!-- Pillar 1: Transparency Engine -->
            <div class="nav-pillar-card-alt2" @click="activeMenu = activeMenu === 'transparency' ? null : 'transparency'">
                <div class="pillar-header-alt2">
                    <span class="pillar-icon-alt2">💰</span>
                    <span class="pillar-name-alt2">Transparency</span>
                    <span class="pillar-indicator-alt2">›</span>
                </div>
                <div class="pillar-menu-alt2" x-show="activeMenu === 'transparency'">
                    <a href="/metrics">Budget Metrics</a>
                    <a href="#spending">Spending Data</a>
                    <a href="#departments">By Department</a>
                </div>
            </div>

            <!-- Pillar 2: Environmental Atlas -->
            <div class="nav-pillar-card-alt2" @click="activeMenu = activeMenu === 'environment' ? null : 'environment'">
                <div class="pillar-header-alt2">
                    <span class="pillar-icon-alt2">🌍</span>
                    <span class="pillar-name-alt2">Environment</span>
                    <span class="pillar-indicator-alt2">›</span>
                </div>
                <div class="pillar-menu-alt2" x-show="activeMenu === 'environment'">
                    <a href="#climate">Climate Data</a>
                    <a href="#energy">Energy Transition</a>
                    <a href="#emissions">Emissions Tracker</a>
                </div>
            </div>

            <!-- Pillar 3: Civic Forum -->
            <div class="nav-pillar-card-alt2" @click="activeMenu = activeMenu === 'civic' ? null : 'civic'">
                <div class="pillar-header-alt2">
                    <span class="pillar-icon-alt2">⚖️</span>
                    <span class="pillar-name-alt2">Civic Forum</span>
                    <span class="pillar-indicator-alt2">›</span>
                </div>
                <div class="pillar-menu-alt2" x-show="activeMenu === 'civic'">
                    <a href="/campaigns">Active Campaigns</a>
                    <a href="#forum">Community Forum</a>
                    <a href="#wins">Policy Wins</a>
                </div>
            </div>

            <!-- Pillar 4: Innovation Lab -->
            <div class="nav-pillar-card-alt2" @click="activeMenu = activeMenu === 'innovation' ? null : 'innovation'">
                <div class="pillar-header-alt2">
                    <span class="pillar-icon-alt2">💡</span>
                    <span class="pillar-name-alt2">Innovation</span>
                    <span class="pillar-indicator-alt2">›</span>
                </div>
                <div class="pillar-menu-alt2" x-show="activeMenu === 'innovation'">
                    <a href="/case-studies">Case Studies</a>
                    <a href="#apis">Open APIs</a>
                    <a href="/events">Hackathons</a>
                </div>
            </div>
        </div>

        <!-- Secondary Actions -->
        <div class="nav-actions-alt2">
            <button class="nav-theme-btn-alt2" onclick="toggleThemeAlt2()" title="Toggle theme">☀️</button>
            <button class="nav-cta-btn-alt2">Sign In</button>
        </div>
    </div>
</nav>

<style>
    .nav-wrapper-alt2 {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: var(--panel);
        border-bottom: 1px solid var(--border);
        backdrop-filter: var(--blur);
    }

    .nav-container-alt2 {
        max-width: 1320px;
        margin: 0 auto;
        padding: 16px 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
    }

    .nav-brand-alt2 {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        color: inherit;
        flex-shrink: 0;
    }

    .nav-badge-alt2 {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--card);
        border: 1.5px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .nav-branding-alt2 {
        display: flex;
        flex-direction: column;
    }

    .nav-branding-alt2 small {
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: var(--subtle);
        font-weight: 600;
    }

    .nav-branding-alt2 h1 {
        margin: 0;
        font-size: 18px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .nav-pillars-alt2 {
        display: flex;
        gap: 8px;
        flex: 1;
    }

    .nav-pillar-card-alt2 {
        position: relative;
        flex: 1;
    }

    .pillar-header-alt2 {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 8px;
        border: 1px solid var(--border);
        background: var(--card);
        cursor: pointer;
        transition: all 160ms ease;
    }

    .nav-pillar-card-alt2 .pillar-header-alt2:hover {
        background: var(--bg);
        border-color: var(--ink);
        transform: translateY(-1px);
    }

    .pillar-icon-alt2 {
        font-size: 16px;
    }

    .pillar-name-alt2 {
        font-size: 13px;
        font-weight: 700;
        flex: 1;
    }

    .pillar-indicator-alt2 {
        font-size: 18px;
        transition: transform 200ms ease;
    }

    .nav-pillar-card-alt2:has(.pillar-menu-alt2[style*="display"]) .pillar-indicator-alt2 {
        transform: rotate(90deg);
    }

    .pillar-menu-alt2 {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: var(--panel);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 8px;
        margin-top: 4px;
        display: none;
        flex-direction: column;
        gap: 2px;
        box-shadow: 0 12px 32px rgba(0,0,0,0.08);
        z-index: 1001;
    }

    .pillar-menu-alt2[style*="display: block"] {
        display: flex;
    }

    .pillar-menu-alt2 a {
        padding: 10px 12px;
        border-radius: 6px;
        font-size: 13px;
        color: var(--ink);
        text-decoration: none;
        transition: all 160ms ease;
    }

    .pillar-menu-alt2 a:hover {
        background: var(--bg);
        padding-left: 16px;
    }

    .nav-actions-alt2 {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }

    .nav-theme-btn-alt2 {
        width: 40px;
        height: 40px;
        border: 1px solid var(--border);
        border-radius: 8px;
        background: var(--card);
        font-size: 18px;
        cursor: pointer;
        transition: all 160ms ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .nav-theme-btn-alt2:hover {
        border-color: var(--ink);
        background: var(--bg);
    }

    .nav-cta-btn-alt2 {
        padding: 10px 18px;
        border: 1.5px solid var(--ink);
        background: var(--ink);
        color: var(--panel);
        border-radius: 8px;
        font-weight: 700;
        font-size: 13px;
        cursor: pointer;
        transition: all 160ms ease;
    }

    .nav-cta-btn-alt2:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    @media (max-width: 1024px) {
        .nav-container-alt2 {
            gap: 16px;
            padding: 12px 20px;
        }

        .nav-pillars-alt2 {
            gap: 6px;
        }

        .pillar-name-alt2 {
            font-size: 12px;
        }

        .pillar-icon-alt2 {
            font-size: 14px;
        }

        .pillar-header-alt2 {
            padding: 8px 10px;
        }
    }

    @media (max-width: 640px) {
        .nav-container-alt2 {
            flex-wrap: wrap;
            gap: 8px;
            padding: 12px 16px;
        }

        .nav-brand-alt2 {
            width: 100%;
        }

        .nav-pillars-alt2 {
            order: 3;
            width: 100%;
            gap: 4px;
        }

        .pillar-header-alt2 {
            padding: 6px 8px;
            flex: 1;
        }

        .pillar-name-alt2 {
            display: none;
        }

        .pillar-icon-alt2 {
            font-size: 16px;
        }
    }
</style>

<script>
function toggleThemeAlt2() {
    const root = document.documentElement;
    const isDark = root.classList.toggle('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    updateThemeIconAlt2();
}

function updateThemeIconAlt2() {
    const btn = document.querySelector('.nav-theme-btn-alt2');
    if (btn) {
        const isDark = document.documentElement.classList.contains('dark');
        btn.textContent = isDark ? '🌙' : '☀️';
    }
}

document.addEventListener('DOMContentLoaded', updateThemeIconAlt2);
</script>
