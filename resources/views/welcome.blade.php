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
                --bg: #f5fff7;
                --panel: #ffffffd9;
                --subtle: #4a5b4f;
                --ink: #0d1b12;
                --accent: #16a34a;
                --accent-2: #0ea5e9;
                --border: #1641272b;
                --blur: blur(16px);
                --card: #ffffffeb;
                --shadow: 0 24px 70px -40px rgba(12, 179, 89, 0.55);
            }
            :root.dark {
                --bg: #06130b;
                --panel: #0d1f14d9;
                --subtle: #9fb1a5;
                --ink: #eef5ef;
                --accent: #22c55e;
                --accent-2: #38bdf8;
                --border: #1f3625;
                --card: #0f2519e6;
                --shadow: 0 24px 70px -40px rgba(56, 189, 148, 0.65);
            }
            * { box-sizing: border-box; }
            body {
                margin: 0;
                min-height: 100vh;
                font-family: 'Instrument Sans', system-ui, -apple-system, sans-serif;
                background:
                    radial-gradient(circle at 10% 20%, rgba(34, 197, 94, 0.08), transparent 32%),
                    radial-gradient(circle at 90% 10%, rgba(14, 165, 233, 0.08), transparent 28%),
                    linear-gradient(135deg, var(--bg), #ffffff);
                color: var(--ink);
            }
            a { color: inherit; text-decoration: none; }
            .page { position: relative; overflow: hidden; }
            .backdrop span {
                position: absolute;
                border-radius: 9999px;
                filter: blur(90px);
                opacity: 0.9;
            }
            .blob-1 { width: 360px; height: 360px; left: -140px; top: -140px; background: rgba(22, 163, 74, 0.28); }
            .blob-2 { width: 420px; height: 420px; right: -180px; bottom: -200px; background: rgba(14, 165, 233, 0.22); }
            :root.dark .blob-1 { background: rgba(34, 197, 94, 0.16); }
            :root.dark .blob-2 { background: rgba(14, 165, 233, 0.16); }

            .wrap {
                position: relative;
                max-width: 1200px;
                margin: 0 auto;
                padding: 32px 20px 48px;
                display: flex;
                flex-direction: column;
                gap: 28px;
            }
            header.top {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: space-between;
                gap: 14px;
            }
            .brand { display: flex; align-items: center; gap: 12px; }
            .brand-badge {
                width: 42px;
                height: 42px;
                border-radius: 50%;
                background: linear-gradient(145deg, rgba(22,163,74,0.25), rgba(14,165,233,0.25));
                border: 1px solid var(--border);
            }
            :root.dark .brand-badge { background: linear-gradient(145deg, rgba(34,197,94,0.3), rgba(56,189,248,0.25)); }
            .brand small { color: var(--subtle); }
            nav.links { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; }
            .chip {
                padding: 8px 14px;
                border: 1px solid transparent;
                border-radius: 10px;
                font-size: 14px;
                transition: border-color 160ms ease, color 160ms ease, background 160ms ease;
            }
            .chip:hover { border-color: var(--border); background: rgba(22, 163, 74, 0.06); }
            .btn {
                padding: 10px 16px;
                border-radius: 12px;
                border: 1px solid var(--accent);
                background: linear-gradient(135deg, var(--accent), #0ea34f);
                color: white;
                font-weight: 700;
                transition: transform 160ms ease, box-shadow 180ms ease, background 180ms ease;
                font-size: 14px;
                box-shadow: 0 12px 35px -18px rgba(16, 185, 129, 0.6);
            }
            .btn:hover { transform: translateY(-1px); box-shadow: 0 14px 35px -18px rgba(16, 185, 129, 0.8); }
            :root.dark .btn { background: linear-gradient(135deg, #16a34a, #22c55e); color: #06130b; }
            :root.dark .btn:hover { box-shadow: 0 14px 35px -18px rgba(34, 197, 94, 0.75); }
            .ghost { border: 1px solid var(--border); background: transparent; color: var(--ink); }
            :root.dark .ghost { border-color: var(--border); color: var(--ink); }

            .grid { display: grid; gap: 20px; }
            .hero { grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); }
            .panel {
                background: var(--panel);
                border: 1px solid var(--border);
                border-radius: 14px;
                padding: 22px;
                box-shadow: var(--shadow), 0 1px 1px rgba(0,0,0,0.04);
                backdrop-filter: var(--blur);
            }
            .stats { display: grid; gap: 12px; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); }
            .stat { border: 1px solid var(--border); border-radius: 10px; padding: 12px; background: var(--card); }
            .muted { color: var(--subtle); font-size: 14px; }
            h1, h2, h3, h4 { margin: 0; }
            h2 { font-size: 30px; line-height: 1.2; }
            h3 { font-size: 20px; }
            h4 { font-size: 17px; }

            .list { display: flex; flex-direction: column; gap: 12px; }
            .pillars { grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); }
            .routes { grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); }
            .timeline { grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); }

            .route-card, .pill-card, .timeline-card { border: 1px solid var(--border); border-radius: 12px; padding: 14px; background: var(--card); transition: border-color 150ms ease, transform 150ms ease; }
            .route-card:hover, .pill-card:hover, .timeline-card:hover { border-color: var(--accent); transform: translateY(-2px); }
            :root.dark .route-card:hover, :root.dark .pill-card:hover, :root.dark .timeline-card:hover { border-color: var(--accent); }

            .tag { font-size: 12px; text-transform: uppercase; letter-spacing: 0.08em; color: var(--subtle); }
            .reveal { opacity: 0; transform: translateY(12px); transition: opacity 0.65s ease, transform 0.65s ease; }
            .revealed { opacity: 1; transform: translateY(0); }

            .cta-row { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 14px; }

            @media (max-width: 640px) {
                .wrap { padding: 24px 16px 36px; }
                header.top { flex-direction: column; align-items: flex-start; }
                .brand { width: 100%; justify-content: space-between; }
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
                }, { threshold: 0.15 });
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
                        <div style="font-weight: 700; font-size: 18px;">Transparency.ie</div>
                        <div class="muted" style="font-size: 13px;">Power to the people</div>
                    </div>
                </div>
                <nav class="links">
                    <a class="chip" href="#insights">Insights</a>
                    <a class="chip" href="#pillars">Pillars</a>
                    <a class="chip" href="#routes">Explore</a>
                    <a class="chip" href="#timeline">Momentum</a>
                    <button type="button" class="chip" onclick="toggleTheme()">Toggle theme</button>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn">Log in</a>
                        @endauth
                    @endif
                </nav>
            </header>

            <section class="grid hero">
                <div class="panel reveal" style="background: linear-gradient(160deg, rgba(22,163,74,0.08), rgba(255,255,255,0.9));">
                    <p class="tag">Ireland's public ledger</p>
                    <h2>Power to the people: clarity on budgets, climate, and civic action.</h2>
                    <p class="muted">We mapped budgets, emissions, campaigns, and innovation work so communities can move from curiosity to action in seconds.</p>
                    <div class="stats">
                        <div class="stat">
                            <p class="tag">Open budgets</p>
                            <h3 style="color: var(--accent);">€104B</h3>
                            <p class="muted">Live totals across departments.</p>
                        </div>
                        <div class="stat">
                            <p class="tag">Impact metrics</p>
                            <h3 style="color: var(--accent);">32</h3>
                            <p class="muted">Emissions, sea levels, energy mix.</p>
                        </div>
                        <div class="stat">
                            <p class="tag">Active campaigns</p>
                            <h3 style="color: var(--accent);">14</h3>
                            <p class="muted">Policy pushes and citizen drives.</p>
                        </div>
                    </div>
                    <div class="cta-row">
                        <a href="/technologies" class="btn">Start exploring</a>
                        <a href="#routes" class="chip ghost">See what's inside ↓</a>
                        <a href="/campaigns" class="chip" style="border-color: var(--border);">Join a campaign</a>
                    </div>
                </div>
                <div class="panel reveal" style="background: linear-gradient(145deg, rgba(22,163,74,0.08), rgba(14,165,233,0.08)); border-color: var(--border);">
                    <p class="tag">Live momentum</p>
                    <div class="list">
                        <div>
                            <strong>Green Infrastructure push</strong>
                            <p class="muted">Budget tracking for EV charging, clean buses, and grid upgrades.</p>
                        </div>
                        <div>
                            <strong>Coastal resilience</strong>
                            <p class="muted">Sea-level and flood monitoring aligned with community projects.</p>
                        </div>
                        <div>
                            <strong>Innovation sprint</strong>
                            <p class="muted">VRFB vs Li-ion insights plus student innovation challenges.</p>
                        </div>
                    </div>
                    <div class="cta-row">
                        <a href="/events" class="btn">Events</a>
                        <a href="/metrics" class="chip ghost">Impact metrics</a>
                    </div>
                </div>
            </section>

            <section id="civic" class="panel reveal" style="background: linear-gradient(110deg, rgba(22,163,74,0.12), rgba(14,165,233,0.08));">
                <div class="top" style="align-items: center; justify-content: space-between; gap: 10px; flex-wrap: wrap;">
                    <div>
                        <p class="tag">Civic firepower</p>
                        <h3>Glassy, green, and people-first</h3>
                        <p class="muted">A cohesive surface that keeps every signal readable in both light and dark mode—no cut-off text, no hidden data.</p>
                    </div>
                    <a href="#routes" class="chip ghost">Explore routes →</a>
                </div>
            </section>

            <section id="insights" class="panel reveal">
                <div class="top" style="align-items: center; justify-content: space-between; gap: 10px; flex-wrap: wrap;">
                    <div>
                        <p class="tag">Signal board</p>
                        <h3>Quick intel</h3>
                    </div>
                    <a href="/metrics" class="chip ghost">View metrics →</a>
                </div>
                <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); margin-top: 12px; gap: 12px;">
                    <div class="route-card">
                        <p class="tag">Budgets</p>
                        <h4>Energy transition</h4>
                        <p class="muted">Follow allocations across Departments, Initiatives, and Spend.</p>
                    </div>
                    <div class="route-card">
                        <p class="tag">Climate</p>
                        <h4>Sea level + storms</h4>
                        <p class="muted">Visualise risk corridors and resilience investments in one pass.</p>
                    </div>
                    <div class="route-card">
                        <p class="tag">Community</p>
                        <h4>Citizen campaigns</h4>
                        <p class="muted">Case studies, petitions, and advocacy journeys you can join.</p>
                    </div>
                </div>
            </section>

            <section id="pillars" class="panel reveal">
                <div class="top" style="align-items: center; justify-content: space-between; gap: 10px; flex-wrap: wrap;">
                    <div>
                        <p class="tag">Four pillars</p>
                        <h3>Built for clarity</h3>
                    </div>
                    <a href="/case-studies" class="chip ghost">Case studies →</a>
                </div>
                <div class="grid pillars" style="margin-top: 12px;">
                    <div class="pill-card">
                        <h4>💰 Transparency Engine</h4>
                        <p class="muted">Track every budget line, department rollup, and spending allocation.</p>
                    </div>
                    <div class="pill-card">
                        <h4>🌍 Environmental Atlas</h4>
                        <p class="muted">Emissions, energy mix, and sea-level projections for each region.</p>
                    </div>
                    <div class="pill-card">
                        <h4>⚖️ Just Transition Forum</h4>
                        <p class="muted">Policy tracking, public consultations, and advocacy campaigns.</p>
                    </div>
                    <div class="pill-card">
                        <h4>💡 Innovation Spotlight</h4>
                        <p class="muted">Tech trials, storage showdowns, and student innovation challenges.</p>
                    </div>
                </div>
            </section>

            <section id="routes" class="panel reveal">
                <div class="top" style="align-items: center; justify-content: space-between; gap: 10px; flex-wrap: wrap;">
                    <div>
                        <p class="tag">Navigate</p>
                        <h3>Follow the journey</h3>
                    </div>
                    <a href="/campaigns" class="chip ghost">Campaigns →</a>
                </div>
                <div class="grid routes" style="margin-top: 12px;">
                    <a href="/technologies" class="route-card">
                        <p class="tag">Start</p>
                        <h4>Technologies</h4>
                        <p class="muted">Energy storage, grids, and climate tech.</p>
                    </a>
                    <a href="/events" class="route-card">
                        <p class="tag">Live</p>
                        <h4>Events</h4>
                        <p class="muted">Town halls, hackathons, policy briefings.</p>
                    </a>
                    <a href="/case-studies" class="route-card">
                        <p class="tag">Learn</p>
                        <h4>Case Studies</h4>
                        <p class="muted">Proof points from Irish communities.</p>
                    </a>
                    <a href="/campaigns" class="route-card">
                        <p class="tag">Act</p>
                        <h4>Campaigns</h4>
                        <p class="muted">Add your name, share, or fund.</p>
                    </a>
                </div>
            </section>

            <section id="timeline" class="panel reveal">
                <div class="top" style="align-items: center; justify-content: space-between; gap: 10px; flex-wrap: wrap;">
                    <div>
                        <p class="tag">Momentum</p>
                        <h3>Recent moves</h3>
                    </div>
                    <a href="/metrics" class="chip ghost">Full signal →</a>
                </div>
                <div class="grid timeline" style="margin-top: 12px;">
                    <div class="timeline-card">
                        <p class="tag">Jan</p>
                        <h4>Budget reroute</h4>
                        <p class="muted">Re-allocated funds to coastal resilience and grid storage pilots.</p>
                    </div>
                    <div class="timeline-card">
                        <p class="tag">Feb</p>
                        <h4>Community sprint</h4>
                        <p class="muted">New campaign nodes opened for west coast towns; metrics live.</p>
                    </div>
                    <div class="timeline-card">
                        <p class="tag">Mar</p>
                        <h4>Innovation track</h4>
                        <p class="muted">VRFB vs Li-ion study published; student submissions opened.</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
