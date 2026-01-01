<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Metrics | {{ config('app.name', 'Transparency.ie') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
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

        .panel {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 40px;
            box-shadow: var(--shadow);
            backdrop-filter: var(--blur);
        }
        .grid { display: grid; gap: 24px; }
        .metrics { grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); }

        .muted { color: var(--subtle); font-size: 14px; line-height: 1.6; }
        h1, h2, h3 { margin: 0; letter-spacing: -0.5px; }
        h2 { font-size: 36px; font-weight: 800; line-height: 1.2; margin-bottom: 16px; }
        h3 { font-size: 18px; font-weight: 700; margin: 12px 0 8px 0; }
        .tag { font-size: 11px; text-transform: uppercase; letter-spacing: 0.15em; color: var(--subtle); font-weight: 600; }

        .metric-card {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 32px;
            background: var(--card);
            transition: all 200ms ease;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .metric-card:hover {
            border-color: var(--ink);
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
        }
        .metric-number {
            font-size: 32px;
            font-weight: 800;
            color: var(--ink);
        }
        .metric-change {
            font-size: 12px;
            color: #4CAF50;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .metric-change.negative { color: #f44336; }
        .metric-card p { margin: 0; }

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
                    <a class="chip" href="/">Home</a>
                    <a class="chip" href="/technologies">Technologies</a>
                    <a class="chip" href="/case-studies">Case Studies</a>
                    <a class="chip" href="/campaigns">Campaigns</a>
                    <a class="chip" href="/events">Events</a>
                    <button type="button" class="chip" onclick="toggleTheme()">☀️/🌙</button>
                </nav>
            </header>

            <section class="panel reveal">
                <p class="tag" style="margin-bottom: 12px;">The Numbers</p>
                <h2>Impact Metrics</h2>
                <p class="muted" style="font-size: 16px; max-width: 680px; line-height: 1.7;">Real-time tracking of budget transparency, climate progress, civic engagement, and technology adoption across Ireland's public sector.</p>
            </section>

            <section class="grid metrics reveal">
                <div class="metric-card reveal">
                    <p class="tag">Public Finance</p>
                    <h3>Total Budgets Mapped</h3>
                    <div class="metric-number">€104B</div>
                    <p class="metric-change">↑ €8.2B from 2022</p>
                    <p class="muted">Across 47 departments and agencies. Real-time spending data now live.</p>
                </div>

                <div class="metric-card reveal">
                    <p class="tag">Transparency</p>
                    <h3>Budget Data Points</h3>
                    <div class="metric-number">847K</div>
                    <p class="metric-change">↑ 34% adoption rate</p>
                    <p class="muted">Individual line items now queryable. Machine-readable APIs available.</p>
                </div>

                <div class="metric-card reveal">
                    <p class="tag">Climate</p>
                    <h3>Emissions Tracked</h3>
                    <div class="metric-number">32 Metrics</div>
                    <p class="metric-change">↓ 4.2% annual reduction</p>
                    <p class="muted">Public sector on track for 2030 carbon neutrality target.</p>
                </div>

                <div class="metric-card reveal">
                    <p class="tag">Climate</p>
                    <h3>Renewable Energy Mix</h3>
                    <div class="metric-number">52%</div>
                    <p class="metric-change">↑ 12% from 2020</p>
                    <p class="muted">Wind, solar, hydro, and biomass now dominant in grid. Storage pending.</p>
                </div>

                <div class="metric-card reveal">
                    <p class="tag">Engagement</p>
                    <h3>Active Campaigns</h3>
                    <div class="metric-number">14</div>
                    <p class="metric-change">18K supporters</p>
                    <p class="muted">Citizen-led advocacy from climate to transport to education equity.</p>
                </div>

                <div class="metric-card reveal">
                    <p class="tag">Engagement</p>
                    <h3>Community Members</h3>
                    <div class="metric-number">67K+</div>
                    <p class="metric-change">↑ 47% YoY growth</p>
                    <p class="muted">Active users engaging with budgets, events, and policy discussions monthly.</p>
                </div>

                <div class="metric-card reveal">
                    <p class="tag">Technology</p>
                    <h3>Energy Storage Pilots</h3>
                    <div class="metric-number">8</div>
                    <p class="metric-change">€34M invested</p>
                    <p class="muted">Battery systems now operational in Limerick, Cork, and Waterford.</p>
                </div>

                <div class="metric-card reveal">
                    <p class="tag">Technology</p>
                    <h3>Grid Innovation Projects</h3>
                    <div class="metric-number">23</div>
                    <p class="metric-change">↑ 6 launched this year</p>
                    <p class="muted">Smart metering, demand response, and microgrid experiments ongoing.</p>
                </div>

                <div class="metric-card reveal">
                    <p class="tag">Outreach</p>
                    <h3>Hackathons & Events</h3>
                    <div class="metric-number">12</div>
                    <p class="metric-change">2.4K participants</p>
                    <p class="muted">Nationwide events fostering civic data literacy and innovation.</p>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
