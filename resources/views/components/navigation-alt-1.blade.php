<!--
NAVIGATION VARIATION 2: Minimalist Horizontal
Design Philosophy: Flat, clean, single-row layout with subtle accent highlighting
- All links in single horizontal line (no submenus)
- Accent color (soft emerald green) highlights active/hover states
- Modern and minimal aesthetic
- Very compact footprint
- Better for users who want quick navigation without dropdowns

Usage: @include('components.navigation-alt-1')
-->
<nav class="nav-wrapper-alt1" id="navAlt1">
    <div class="nav-container-alt1">
        <!-- Logo/Brand -->
        <a href="/" class="nav-brand-alt1">
            <div class="nav-icon-alt1">💎</div>
            <div>
                <div class="nav-label-alt1">Transparency.ie</div>
                <div class="nav-sublabel-alt1">Public Observatory</div>
            </div>
        </a>

        <!-- Primary Navigation - Flat Links -->
        <div class="nav-links-alt1">
            <a href="/" class="nav-link-alt1">Home</a>
            <a href="/metrics" class="nav-link-alt1">Metrics</a>
            <a href="/technologies" class="nav-link-alt1">Technologies</a>
            <a href="/case-studies" class="nav-link-alt1">Case Studies</a>
            <a href="/campaigns" class="nav-link-alt1">Campaigns</a>
            <a href="/events" class="nav-link-alt1">Events</a>
        </div>

        <!-- Secondary Navigation -->
        <div class="nav-actions-alt1">
            <button class="nav-theme-alt1" onclick="toggleThemeAlt1()">☀️</button>
            <a href="/dashboard" class="nav-btn-alt1 primary">Dashboard</a>
        </div>
    </div>
</nav>

<style>
    .nav-wrapper-alt1 {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: var(--panel);
        border-bottom: 2px solid var(--border);
        backdrop-filter: var(--blur);
    }

    .nav-container-alt1 {
        max-width: 1400px;
        margin: 0 auto;
        padding: 16px 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 48px;
    }

    .nav-brand-alt1 {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        color: inherit;
        flex-shrink: 0;
        transition: opacity 200ms ease;
    }

    .nav-brand-alt1:hover {
        opacity: 0.7;
    }

    .nav-icon-alt1 {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, #e8f5e9 0%, #f1f8f6 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 800;
    }

    :root.dark .nav-icon-alt1 {
        background: linear-gradient(135deg, #1b5e20 0%, #0d3818 100%);
    }

    .nav-label-alt1 {
        font-weight: 800;
        font-size: 16px;
        letter-spacing: -0.5px;
    }

    .nav-sublabel-alt1 {
        font-size: 11px;
        color: var(--subtle);
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    .nav-links-alt1 {
        display: flex;
        align-items: center;
        gap: 6px;
        flex: 1;
    }

    .nav-link-alt1 {
        padding: 8px 14px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        color: var(--ink);
        text-decoration: none;
        transition: all 160ms ease;
        border-bottom: 2px solid transparent;
    }

    .nav-link-alt1:hover {
        background: rgba(76, 175, 80, 0.08);
        border-bottom-color: #4CAF50;
        color: #4CAF50;
    }

    .nav-link-alt1.active {
        background: rgba(76, 175, 80, 0.1);
        border-bottom-color: #4CAF50;
        color: #4CAF50;
    }

    .nav-actions-alt1 {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }

    .nav-theme-alt1 {
        width: 38px;
        height: 38px;
        border: 1px solid var(--border);
        border-radius: 6px;
        background: var(--card);
        font-size: 16px;
        cursor: pointer;
        transition: all 160ms ease;
    }

    .nav-theme-alt1:hover {
        background: linear-gradient(135deg, #e8f5e9 0%, #f1f8f6 100%);
        border-color: #4CAF50;
    }

    :root.dark .nav-theme-alt1:hover {
        background: linear-gradient(135deg, #1b5e20 0%, #0d3818 100%);
    }

    .nav-btn-alt1 {
        padding: 10px 18px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 12px;
        text-decoration: none;
        transition: all 160ms ease;
        border: 1px solid transparent;
    }

    .nav-btn-alt1.primary {
        background: #4CAF50;
        color: white;
        border-color: #4CAF50;
    }

    .nav-btn-alt1.primary:hover {
        background: #45a049;
        box-shadow: 0 6px 20px rgba(76, 175, 80, 0.3);
        transform: translateY(-1px);
    }

    @media (max-width: 1024px) {
        .nav-container-alt1 {
            gap: 20px;
            padding: 12px 20px;
        }

        .nav-links-alt1 {
            gap: 4px;
        }

        .nav-link-alt1 {
            padding: 6px 10px;
            font-size: 12px;
        }
    }

    @media (max-width: 640px) {
        .nav-container-alt1 {
            gap: 12px;
            flex-wrap: wrap;
            padding: 12px 16px;
        }

        .nav-brand-alt1 {
            width: 100%;
        }

        .nav-links-alt1 {
            order: 3;
            width: 100%;
            gap: 2px;
            flex-wrap: wrap;
        }

        .nav-link-alt1 {
            padding: 4px 8px;
            font-size: 11px;
            flex: 1 0 auto;
            text-align: center;
        }

        .nav-icon-alt1 {
            width: 36px;
            height: 36px;
        }

        .nav-label-alt1 {
            font-size: 14px;
        }

        .nav-sublabel-alt1 {
            font-size: 9px;
        }

        .nav-actions-alt1 {
            gap: 8px;
        }
    }
</style>

<script>
function toggleThemeAlt1() {
    const root = document.documentElement;
    const isDark = root.classList.toggle('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    updateNavIcon();
}

function updateNavIcon() {
    const btn = document.querySelector('.nav-theme-alt1');
    if (btn) {
        const isDark = document.documentElement.classList.contains('dark');
        btn.textContent = isDark ? '🌙' : '☀️';
    }
}

// Set active link based on current page
document.addEventListener('DOMContentLoaded', () => {
    const currentPath = window.location.pathname;
    document.querySelectorAll('.nav-link-alt1').forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
    });
    updateNavIcon();
});
</script>
