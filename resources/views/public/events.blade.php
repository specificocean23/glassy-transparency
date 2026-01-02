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
            --bg: #f6f9ff;
            --panel: #ffffff;
            --ink: #0f172a;
            --subtle: #4b5563;
            --border: #e5e7eb;
            --card: #ffffff;
            --shadow: 0 24px 60px rgba(15,23,42,0.12);
            --accent: #f97316;
            --accent-soft: #ffedd5;
        }
        .dark {
            --bg: #0b0f1a;
            --panel: rgba(255,255,255,0.06);
            --ink: #e5e7eb;
            --subtle: #9ca3af;
            --border: rgba(255,255,255,0.12);
            --card: rgba(255,255,255,0.04);
            --shadow: 0 24px 80px rgba(0,0,0,0.28);
            --accent: #fb923c;
            --accent-soft: rgba(251,146,60,0.16);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Instrument Sans', system-ui, -apple-system, sans-serif;
            background:
                radial-gradient(circle at 20% 18%, rgba(251,146,60,0.16), transparent 30%),
                radial-gradient(circle at 82% 8%, rgba(244,114,182,0.14), transparent 28%),
                linear-gradient(160deg, #f6f9ff, #eef2ff 50%, #f6f9ff);
            color: var(--ink);
        }

        .wrap { max-width: 1240px; margin: 0 auto; padding: 32px 28px 64px; display: grid; gap: 28px; }

        .hero {
            padding: 32px;
            border-radius: 18px;
            background: linear-gradient(135deg, rgba(251,146,60,0.18), rgba(244,114,182,0.12));
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            display: grid;
            gap: 12px;
        }
        .hero h1 { margin: 0; font-size: 36px; letter-spacing: -0.7px; }
        .hero p { margin: 0; color: var(--subtle); max-width: 780px; line-height: 1.7; }
        .hero-tags { display: flex; flex-wrap: wrap; gap: 10px; }
        .hero-tag { padding: 8px 12px; border-radius: 10px; background: var(--accent-soft); color: var(--ink); font-weight: 700; font-size: 12px; }

        .section-header { display: flex; align-items: center; justify-content: space-between; gap: 12px; }
        .section-header h2 { margin: 0; font-size: 24px; letter-spacing: -0.4px; }
        .section-header .muted { color: var(--subtle); }

        .grid { display: grid; gap: 18px; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); }

        .event-card {
            padding: 24px;
            border-radius: 14px;
            border: 1px solid var(--border);
            background: var(--card);
            box-shadow: var(--shadow);
            display: grid;
            gap: 10px;
        }
        .event-date { font-size: 12px; font-weight: 800; letter-spacing: 0.12em; color: var(--subtle); text-transform: uppercase; }
        .event-card h3 { margin: 0; font-size: 19px; letter-spacing: -0.3px; }
        .event-card p { margin: 0; color: var(--subtle); line-height: 1.6; }
        .event-meta { display: flex; flex-wrap: wrap; gap: 10px; color: var(--subtle); font-weight: 700; }
        .event-link { font-weight: 700; color: var(--accent); }

        .footer { padding: 28px; text-align: center; color: var(--subtle); font-size: 13px; }
        .footer a { color: var(--ink); font-weight: 700; }

        @media (max-width: 720px) {
            .wrap { padding: 24px 16px 48px; }
            .hero { padding: 24px; }
            .hero h1 { font-size: 28px; }
        }
    </style>
</head>
<body>
    @include('components.nav-professional')
    <div class="wrap">
        <section class="hero">
            <p class="hero-tag" style="width: fit-content;">What's coming</p>
            <h1>Events</h1>
            <p>Town halls, hackathons, policy briefings, and training to build transparent budgets and climate data culture across Ireland.</p>
            <div class="hero-tags">
                <span class="hero-tag">Town halls</span>
                <span class="hero-tag">Hackathons</span>
                <span class="hero-tag">Training</span>
            </div>
        </section>

        <div class="section-header">
            <h2>Highlighted events</h2>
            <span class="muted">Dates, locations, registration</span>
        </div>

        <section class="grid">
            <div class="event-card">
                <div class="event-date">January 24–26</div>
                <h3>Dublin Transparency Hackathon</h3>
                <p>Build apps from budget data, €25K in prizes, mentorship from policy experts and data scientists.</p>
                <div class="event-meta">📍 Dublin Convention Centre · 📅 In-person</div>
                <a class="event-link" href="#event-1">Learn more →</a>
            </div>
            <div class="event-card">
                <div class="event-date">February 3</div>
                <h3>National Budget Policy Forum</h3>
                <p>Officials, civil society, and citizens co-design the 2025 budget process with live polling and Q&A.</p>
                <div class="event-meta">📍 Hybrid · 🕐 14:00–17:00 GMT</div>
                <a class="event-link" href="#event-2">Register →</a>
            </div>
            <div class="event-card">
                <div class="event-date">February 15</div>
                <h3>Energy Storage Pilot Showcase</h3>
                <p>Live battery systems, engineering deep-dives, and site tours in Limerick and Cork.</p>
                <div class="event-meta">📍 Limerick Energy Hub · 🕐 09:00–16:30</div>
                <a class="event-link" href="#event-3">Learn more →</a>
            </div>
            <div class="event-card">
                <div class="event-date">February 22</div>
                <h3>Youth Climate Leadership Summit</h3>
                <p>Voices under 30 demanding climate action with workshops, commitments, and networking.</p>
                <div class="event-meta">📍 Galway Civic Centre · 🕐 10:00–18:00</div>
                <a class="event-link" href="#event-4">Apply now →</a>
            </div>
            <div class="event-card">
                <div class="event-date">March 7</div>
                <h3>Civic Data Literacy Workshop</h3>
                <p>Read budgets, track emissions, and build citizen dashboards. Four 3-hour evening sessions.</p>
                <div class="event-meta">📍 Online · 🕐 18:00–21:00</div>
                <a class="event-link" href="#event-5">Register →</a>
            </div>
            <div class="event-card">
                <div class="event-date">March 14</div>
                <h3>Local Government Innovation Panel</h3>
                <p>Councils share transparency wins, discuss open data standards, and plan budget innovation.</p>
                <div class="event-meta">📍 Waterford County Hall · 🕐 09:00–14:00</div>
                <a class="event-link" href="#event-6">Details →</a>
            </div>
        </section>
    </div>

    <footer class="footer">
        Transparency.ie — join us at our next meetup. <a href="/transparency">Transparency</a> · <a href="/case-studies">Case Studies</a>
    </footer>
</body>
</html>
