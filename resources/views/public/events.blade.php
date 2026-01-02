<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Events | {{ config('app.name', 'Transparency.ie') }}</title>
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
        .events { grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); }

        .muted { color: var(--subtle); font-size: 14px; line-height: 1.6; }
        h1, h2, h3 { margin: 0; letter-spacing: -0.5px; }
        h2 { font-size: 36px; font-weight: 800; line-height: 1.2; margin-bottom: 16px; }
        h3 { font-size: 20px; font-weight: 700; margin: 12px 0 8px 0; }
        .tag { font-size: 11px; text-transform: uppercase; letter-spacing: 0.15em; color: var(--subtle); font-weight: 600; }

        .event-card {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 32px;
            background: var(--card);
            transition: all 200ms ease;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .event-card:hover {
            border-color: var(--ink);
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
        }
        .event-date {
            font-size: 12px;
            font-weight: 700;
            color: var(--ink);
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }
        .event-time {
            font-size: 14px;
            color: var(--subtle);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .event-location {
            font-size: 14px;
            color: var(--subtle);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .event-card a {
            color: var(--ink);
            font-weight: 600;
            font-size: 14px;
            margin-top: 8px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

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
                    <a class="chip" href="/metrics">Metrics</a>
                    <button type="button" class="chip" onclick="toggleTheme()">☀️/🌙</button>
                </nav>
            </header>

            <section class="panel reveal">
                <p class="tag" style="margin-bottom: 12px;">What's Coming</p>
                <h2>Events</h2>
                <p class="muted" style="font-size: 16px; max-width: 680px; line-height: 1.7;">Town halls, webinars, hackathons, and policy briefings. Connect with communities, learn best practices, and shape Ireland's transparency agenda.</p>
            </section>

            <section class="grid events reveal">
                <div class="event-card reveal">
                    <div class="event-date">January 24–26</div>
                    <h3>Dublin Transparency Hackathon</h3>
                    <p class="muted">Build tools and apps using public budget data. 48 hours, €25K in prizes, mentorship from policy experts and data scientists.</p>
                    <div class="event-time">📅 January 24–26, 2024</div>
                    <div class="event-location">📍 Dublin Convention Centre</div>
                    <a href="#event-1">Learn more →</a>
                </div>

                <div class="event-card reveal">
                    <div class="event-date">February 3</div>
                    <h3>National Budget Policy Forum</h3>
                    <p class="muted">Officials, civil society, and citizens co-design the 2025 budget process. Live-streamed, Q&A, interactive polling.</p>
                    <div class="event-time">🕐 14:00–17:00 GMT</div>
                    <div class="event-location">📍 Online + in-person (Cork)</div>
                    <a href="#event-2">Register →</a>
                </div>

                <div class="event-card reveal">
                    <div class="event-date">February 15</div>
                    <h3>Energy Storage Pilot Showcase</h3>
                    <p class="muted">See live battery storage systems in action. Engineering deep-dive, Q&A with project teams, site tours in Limerick and Cork.</p>
                    <div class="event-time">🕐 09:00–16:30 GMT</div>
                    <div class="event-location">📍 Limerick Energy Hub</div>
                    <a href="#event-3">Learn more →</a>
                </div>

                <div class="event-card reveal">
                    <div class="event-date">February 22</div>
                    <h3>Youth Climate Leadership Summit</h3>
                    <p class="muted">Voices under 30 demanding climate action. Keynotes, breakout workshops, government commitments, networking.</p>
                    <div class="event-time">🕐 10:00–18:00 GMT</div>
                    <div class="event-location">📍 Galway Civic Centre</div>
                    <a href="#event-4">Apply now →</a>
                </div>

                <div class="event-card reveal">
                    <div class="event-date">March 7</div>
                    <h3>Civic Data Literacy Workshop</h3>
                    <p class="muted">Learn to read budgets, track emissions, build citizen dashboards. No prior experience needed. Four 3-hour sessions.</p>
                    <div class="event-time">🕐 18:00–21:00 GMT (evenings)</div>
                    <div class="event-location">📍 Online</div>
                    <a href="#event-5">Register →</a>
                </div>

                <div class="event-card reveal">
                    <div class="event-date">March 14</div>
                    <h3>Local Government Innovation Panel</h3>
                    <p class="muted">Councils share transparency wins, discuss budget innovation, adopt open data standards. Annual assembly.</p>
                    <div class="event-time">🕐 09:00–14:00 GMT</div>
                    <div class="event-location">📍 Waterford County Hall</div>
                    <a href="#event-6">Details →</a>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
