<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Energy Storage Technologies - Transparency.ie</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

        .panel {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 22px;
            box-shadow: var(--shadow), 0 1px 1px rgba(0,0,0,0.04);
            backdrop-filter: var(--blur);
        }
        .muted { color: var(--subtle); font-size: 14px; }
        h1, h2, h3, h4 { margin: 0; }
        h2 { font-size: 30px; line-height: 1.2; }
        h3 { font-size: 20px; }
        h4 { font-size: 17px; }
        .tag { font-size: 12px; text-transform: uppercase; letter-spacing: 0.08em; color: var(--subtle); }

        .hero { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; }
        .tech-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 18px; }
        .tech-card { border: 1px solid var(--border); border-radius: 14px; background: var(--card); padding: 18px; backdrop-filter: var(--blur); box-shadow: 0 14px 40px -28px rgba(0,0,0,0.25); transition: transform 150ms ease, border-color 150ms ease; }
        .tech-card:hover { transform: translateY(-2px); border-color: var(--accent); }
        .metrics { display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 10px; margin: 12px 0; }
        .metric { border: 1px solid var(--border); border-radius: 10px; padding: 10px; background: var(--panel); }
        .pill { padding: 6px 10px; border-radius: 999px; font-size: 12px; border: 1px solid var(--border); color: var(--ink); background: rgba(22,163,74,0.08); }
        :root.dark .pill { color: var(--ink); background: rgba(34,197,94,0.12); }
        .reveal { opacity: 0; transform: translateY(12px); transition: opacity 0.65s ease, transform 0.65s ease; }
        .reveal.revealed { opacity: 1; transform: translateY(0); }

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
                }, { threshold: 0.12 });
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
                    <a class="chip" href="/">Home</a>
                    <a class="chip" href="/events">Events</a>
                    <a class="chip" href="/case-studies">Case Studies</a>
                    <a class="chip" href="/campaigns">Campaigns</a>
                    <button type="button" class="chip" onclick="toggleTheme()">Toggle theme</button>
                </nav>
            </header>

            <section class="hero">
                <div class="panel reveal" style="background: linear-gradient(160deg, rgba(22,163,74,0.08), rgba(255,255,255,0.9));">
                    <p class="tag">Energy storage atlas</p>
                    <h2>Compare the technologies shaping Ireland's transition.</h2>
                    <p class="muted">No truncation, no cut-off text—full context for every advantage, trade-off, and local application.</p>
                    <div class="cta-row" style="margin-top: 12px;">
                        <a href="/metrics" class="btn">See impact metrics</a>
                        <a href="/events" class="chip ghost">Join live briefings →</a>
                    </div>
                </div>
                <div class="panel reveal" style="background: linear-gradient(145deg, rgba(22,163,74,0.12), rgba(14,165,233,0.12));">
                    <p class="tag">Why it matters</p>
                    <h3 style="margin-top: 6px;">Glassy, cohesive, people-first.</h3>
                    <p class="muted">We keep readability and accessibility first in both light and dark mode, so every stat stays intact on mobile and desktop.</p>
                    <div class="cta-row" style="margin-top: 10px;">
                        <a href="/" class="chip ghost">Back to homepage</a>
                        <a href="/campaigns" class="chip" style="border-color: var(--border);">Support a campaign</a>
                    </div>
                </div>
            </section>

            <section class="panel reveal">
                <div class="top" style="align-items: center; justify-content: space-between; gap: 10px; flex-wrap: wrap;">
                    <div>
                        <p class="tag">Technologies</p>
                        <h3>Full detail, no cut-offs</h3>
                        <p class="muted">Everything renders in full so you never lose a sentence on advantages or Irish applications.</p>
                    </div>
                    <a href="/metrics" class="chip ghost">View metrics →</a>
                </div>
                <div class="tech-grid" style="margin-top: 14px;">
                    @forelse($technologies as $tech)
                        <div class="tech-card reveal">
                            <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 10px;">
                                <div>
                                    <p class="tag">{{ $tech->category }}</p>
                                    <h3 style="margin-top: 4px;">{{ $tech->name }}</h3>
                                </div>
                                <span class="pill">Storage</span>
                            </div>

                            <div class="metrics">
                                <div class="metric">
                                    <p class="tag">Cost / kWh</p>
                                    <h4 style="color: var(--accent);">€{{ number_format($tech->cost_per_kwh) }}</h4>
                                </div>
                                <div class="metric">
                                    <p class="tag">Lifespan</p>
                                    <h4>{{ $tech->lifespan_years }} yrs</h4>
                                </div>
                                <div class="metric">
                                    <p class="tag">Efficiency</p>
                                    <h4>{{ $tech->efficiency_percent }}%</h4>
                                </div>
                            </div>

                            @if($tech->description)
                                <p class="muted" style="margin-top: 8px;">{{ $tech->description }}</p>
                            @endif

                            <div style="display: grid; gap: 10px; margin-top: 10px;">
                                @if($tech->advantages)
                                    <div>
                                        <p class="tag">Advantages</p>
                                        <p class="muted">{{ $tech->advantages }}</p>
                                    </div>
                                @endif
                                @if($tech->irish_applications)
                                    <div>
                                        <p class="tag">Irish applications</p>
                                        <p class="muted">{{ $tech->irish_applications }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="muted" style="text-align: center; width: 100%; padding: 24px 0;">No technologies available yet.</div>
                    @endforelse
                </div>
            </section>

            <section class="panel reveal" style="background: linear-gradient(110deg, rgba(22,163,74,0.12), rgba(14,165,233,0.08));">
                <div class="top" style="align-items: center; justify-content: space-between; gap: 10px; flex-wrap: wrap;">
                    <div>
                        <p class="tag">Keep exploring</p>
                        <h3>Budgets, cases, and campaigns</h3>
                        <p class="muted">Navigate across the platform without losing clarity—glassy panels keep the data legible in any mode.</p>
                    </div>
                    <div class="cta-row">
                        <a href="/case-studies" class="chip ghost">Case studies</a>
                        <a href="/campaigns" class="chip ghost">Campaigns</a>
                        <a href="/events" class="chip ghost">Events</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
