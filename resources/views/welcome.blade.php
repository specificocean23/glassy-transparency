<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Transparency.ie') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
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
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Instrument Sans', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, var(--bg) 0%, var(--bg) 100%);
            color: var(--ink);
        }
        a { color: inherit; text-decoration: none; }
        .page { position: relative; overflow: hidden; }
        .backdrop span {
            position: absolute;
            border-radius: 9999px;
            filter: blur(100px);
            opacity: 0.04;
        }
        .blob-1 { width: 400px; height: 400px; left: -150px; top: -150px; background: var(--ink); }
        .blob-2 { width: 500px; height: 500px; right: -200px; bottom: -200px; background: var(--ink); }

        .wrap {
            position: relative;
            max-width: 1320px;
            margin: 0 auto;
            padding: 40px 32px 60px;
            display: flex;
            flex-direction: column;
            gap: 48px;
        }
        header.top {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding-bottom: 20px;
        }
        .brand { display: flex; align-items: center; gap: 16px; }
        .brand-badge {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--card);
            border: 2px solid var(--border);
        }
        .brand small { color: var(--subtle); font-size: 12px; text-transform: uppercase; letter-spacing: 0.1em; }
        .brand-title { font-weight: 800; font-size: 22px; letter-spacing: -0.5px; }
        nav.links { display: flex; flex-wrap: wrap; align-items: center; gap: 16px; }
        .chip {
            padding: 10px 16px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            transition: all 160ms ease;
            background: transparent;
            cursor: pointer;
        }
        .chip:hover { border-color: var(--ink); background: var(--card); }
        .btn {
            padding: 11px 20px;
            border-radius: 8px;
            border: 1.5px solid var(--ink);
            background: var(--ink);
            color: var(--bg);
            font-weight: 700;
            transition: all 180ms ease;
            font-size: 13px;
            cursor: pointer;
        }
        .btn:hover { transform: translateY(-1px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); }
        :root.dark .btn { color: var(--bg); }
        .ghost { border: 1px solid var(--border); background: transparent; }
        .ghost:hover { background: var(--card); }

        .panel {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 40px;
            box-shadow: var(--shadow);
            backdrop-filter: var(--blur);
        }
        .grid { display: grid; gap: 24px; }
        .hero { grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); }
        .pillars { grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); }
        .routes { grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); }

        .muted { color: var(--subtle); font-size: 14px; line-height: 1.6; }
        h1, h2, h3, h4 { margin: 0; letter-spacing: -0.5px; }
        h2 { font-size: 36px; font-weight: 800; line-height: 1.2; margin-bottom: 16px; }
        h3 { font-size: 22px; font-weight: 700; margin-bottom: 12px; }
        h4 { font-size: 18px; font-weight: 700; margin-bottom: 8px; }
        .tag { font-size: 11px; text-transform: uppercase; letter-spacing: 0.15em; color: var(--subtle); font-weight: 600; }

        .stat { border: 1px solid var(--border); border-radius: 8px; padding: 20px; background: var(--card); }
        .stat-number { font-size: 28px; font-weight: 800; color: var(--ink); margin: 8px 0; }
        .stat-label { font-size: 12px; text-transform: uppercase; letter-spacing: 0.1em; color: var(--subtle); }

        .pill-card { 
            border: 1px solid var(--border); 
            border-radius: 12px; 
            padding: 32px; 
            background: var(--card); 
            transition: all 200ms ease;
            min-height: 280px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .pill-card:hover { border-color: var(--ink); transform: translateY(-2px); box-shadow: 0 12px 30px rgba(0,0,0,0.12); }
        .pill-icon { font-size: 32px; margin-bottom: 4px; }
        .pill-card a { margin-top: auto; color: var(--ink); font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; gap: 6px; }
        .pill-card a:hover { opacity: 0.7; }

        .route-card { 
            border: 1px solid var(--border); 
            border-radius: 12px; 
            padding: 28px; 
            background: var(--card); 
            transition: all 200ms ease;
        }
        .route-card:hover { border-color: var(--ink); transform: translateY(-2px); box-shadow: 0 12px 30px rgba(0,0,0,0.12); }
        .route-card h4 { margin-top: 12px; }

        .reveal { opacity: 0; transform: translateY(16px); transition: opacity 0.7s ease, transform 0.7s ease; }
        .revealed { opacity: 1; transform: translateY(0); }

        @media (max-width: 768px) {
            .wrap { padding: 24px 16px 40px; gap: 32px; }
            .panel { padding: 24px; }
            h2 { font-size: 28px; }
            header.top { gap: 16px; }
            nav.links { gap: 12px; }
        }
    </style>
    <script>
        (() => {
            const root = document.documentElement;
            const stored = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (stored === 'dark' || (!stored && prefersDark)) {
                root.classList.add('dark');
            }
            window.toggleTheme = () => {
                const isDark = root.classList.toggle('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
            };
            window.addEventListener('DOMContentLoaded', () => {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('revealed');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.1 });
                document.querySelectorAll('.reveal').forEach((el) => observer.observe(el));
            });
        })();
    </script>
</head>
<body>
    <div class="page">
        <div class="backdrop">
            <span class="blob-1"></span>
            <span class="blob-2"></span>
        </div>

        <div class="wrap">
            <header class="top">
                <div class="brand">
                    <div class="brand-badge"></div>
                    <div>
                        <small>Public Observatory</small>
                        <div class="brand-title">Transparency.ie</div>
                    </div>
                </div>
                <nav class="links">
                    <a class="chip" href="#pillars">Pillars</a>
                    <a class="chip" href="#routes">Navigate</a>
                    <a class="chip" href="/case-studies">Case Studies</a>
                    <a class="chip" href="/campaigns">Campaigns</a>
                    <a class="chip" href="/events">Events</a>
                    <button type="button" class="chip" onclick="toggleTheme()">☀️/🌙</button>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn">Log in</a>
                        @endauth
                    @endif
                </nav>
            </header>

            <section class="panel reveal">
                <div class="tag" style="margin-bottom: 12px;">Ireland's Public Ledger</div>
                <h2>Clarity on budgets, climate impact, and civic action.</h2>
                <p class="muted" style="font-size: 16px; max-width: 680px; line-height: 1.7; margin-bottom: 32px;">We mapped €104B in budgets, 32 environmental metrics, and 14 active civic campaigns so communities can move from curiosity to action in seconds. Power to the people.</p>
                
                <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 20px; margin-bottom: 32px;">
                    <div class="stat">
                        <p class="stat-label">Open Budgets</p>
                        <div class="stat-number">€104B</div>
                        <p class="muted">Live across departments</p>
                    </div>
                    <div class="stat">
                        <p class="stat-label">Impact Metrics</p>
                        <div class="stat-number">32</div>
                        <p class="muted">Climate & emissions</p>
                    </div>
                    <div class="stat">
                        <p class="stat-label">Active Campaigns</p>
                        <div class="stat-number">14</div>
                        <p class="muted">Citizen-led drives</p>
                    </div>
                </div>

                <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <a href="/technologies" class="btn">Explore Technologies</a>
                    <a href="#routes" class="chip ghost">See all sections ↓</a>
                </div>
            </section>

            <section id="pillars" class="panel reveal">
                <div style="margin-bottom: 28px;">
                    <p class="tag">Four Pillars</p>
                    <h2>How we organize transparency.</h2>
                    <p class="muted" style="max-width: 640px;">Each pillar represents a core function—tracking budgets, measuring climate impact, fostering civic engagement, and testing innovation. Together, they create clarity.</p>
                </div>
                <div class="grid pillars">
                    <div class="pill-card reveal">
                        <div class="pill-icon">💰</div>
                        <h3>Transparency Engine</h3>
                        <p class="muted">Budget allocations, department rollups, spending per initiative. Follow every euro across Ireland's public sector.</p>
                        <a href="/metrics">View metrics →</a>
                    </div>
                    <div class="pill-card reveal">
                        <div class="pill-icon">🌍</div>
                        <h3>Environmental Atlas</h3>
                        <p class="muted">Emissions tracking, energy mix analysis, sea-level projections. See climate action budgeted by region and timeline.</p>
                        <a href="/metrics">View metrics →</a>
                    </div>
                    <div class="pill-card reveal">
                        <div class="pill-icon">⚖️</div>
                        <h3>Civic Forum</h3>
                        <p class="muted">Campaigns, consultations, and advocacy. Join or launch civic initiatives and track their progress in real time.</p>
                        <a href="/campaigns">Browse campaigns →</a>
                    </div>
                    <div class="pill-card reveal">
                        <div class="pill-icon">💡</div>
                        <h3>Innovation Lab</h3>
                        <p class="muted">Energy storage trials, grid innovations, student challenges. See where breakthrough tech gets tested first in Ireland.</p>
                        <a href="/technologies">Explore tech →</a>
                    </div>
                </div>
            </section>

            <section id="routes" class="panel reveal">
                <div style="margin-bottom: 28px;">
                    <p class="tag">Navigate the Platform</p>
                    <h2>Find what matters to you.</h2>
                    <p class="muted" style="max-width: 640px;">Each section unlocks a different view—start with technologies, join live events, study case studies from real communities, or launch a campaign.</p>
                </div>
                <div class="grid routes">
                    <a href="/technologies" class="route-card reveal">
                        <div class="tag">Energy</div>
                        <h4>Technologies</h4>
                        <p class="muted">Compare storage solutions, grid tech, and climate innovations being tested in Ireland.</p>
                    </a>
                    <a href="/events" class="route-card reveal">
                        <div class="tag">Live</div>
                        <h4>Events</h4>
                        <p class="muted">Upcoming town halls, hackathons, policy briefings, and community action events.</p>
                    </a>
                    <a href="/case-studies" class="route-card reveal">
                        <div class="tag">Learn</div>
                        <h4>Case Studies</h4>
                        <p class="muted">Real community projects, lessons learned, and proof points from across Ireland.</p>
                    </a>
                    <a href="/campaigns" class="route-card reveal">
                        <div class="tag">Act</div>
                        <h4>Campaigns</h4>
                        <p class="muted">Join civic campaigns, sign petitions, fund projects, or launch your own initiative.</p>
                    </a>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
