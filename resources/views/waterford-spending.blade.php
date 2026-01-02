<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Waterford | Transparency</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <style>
        :root {
            --bg: #f3f8f5;
            --panel: #ffffff;
            --ink: #0b1f16;
            --subtle: #4b5563;
            --border: #dfe7e2;
            --card: #ffffff;
            --shadow: 0 24px 60px rgba(12, 53, 32, 0.12);
            --accent: #2d6a4f;
            --accent-soft: #e1f2e7;
            --hero-start: #d9f2e5;
            --hero-end: #b8e3cc;
        }
        .dark {
            --bg: #06120d;
            --panel: rgba(255,255,255,0.06);
            --ink: #e3f6eb;
            --subtle: #9ca3af;
            --border: rgba(255,255,255,0.12);
            --card: rgba(255,255,255,0.05);
            --shadow: 0 24px 80px rgba(0,0,0,0.32);
            --accent: #7ae3a6;
            --accent-soft: rgba(122,227,166,0.16);
            --hero-start: #0a2e1c;
            --hero-end: #0c3a26;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Instrument Sans', system-ui, -apple-system, sans-serif;
            background:
                radial-gradient(circle at 12% 18%, rgba(45,106,79,0.18), transparent 30%),
                radial-gradient(circle at 82% 6%, rgba(16,185,129,0.16), transparent 28%),
                linear-gradient(160deg, var(--hero-start), var(--hero-end) 50%, var(--hero-start));
            color: var(--ink);
        }

        a { color: inherit; text-decoration: none; }

        .wrap { max-width: 1220px; margin: 0 auto; padding: 32px 28px 64px; display: grid; gap: 28px; }

        .hero {
            padding: 32px;
            border-radius: 18px;
            background: linear-gradient(135deg, rgba(45,106,79,0.16), rgba(16,185,129,0.12));
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            display: grid;
            gap: 12px;
        }
        .hero h1 { margin: 0; font-size: 36px; letter-spacing: -0.7px; }
        .hero p { margin: 0; color: var(--subtle); max-width: 820px; line-height: 1.7; }
        .hero-tags { display: flex; flex-wrap: wrap; gap: 10px; }
        .hero-tag { padding: 8px 12px; border-radius: 10px; background: var(--accent-soft); color: var(--ink); font-weight: 700; font-size: 12px; }

        .grid { display: grid; gap: 14px; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); }
        .card {
            padding: 20px;
            border-radius: 14px;
            border: 1px solid var(--border);
            background: var(--card);
            box-shadow: var(--shadow);
        }
        .card h3 { margin: 0 0 4px 0; font-size: 16px; color: var(--accent); }
        .kpi { font-size: 26px; font-weight: 800; margin: 0 0 4px 0; }
        .muted { color: var(--subtle); font-size: 14px; line-height: 1.6; }

        .section { padding: 24px; border-radius: 16px; border: 1px solid var(--border); background: var(--panel); box-shadow: var(--shadow); }
        .section-header { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 12px; }
        .section-header h2 { margin: 0; font-size: 22px; letter-spacing: -0.3px; }
        .pill { padding: 8px 12px; border-radius: 999px; background: var(--accent-soft); color: var(--accent); font-weight: 700; font-size: 12px; }

        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; border-bottom: 1px solid var(--border); text-align: left; }
        th { font-size: 12px; text-transform: uppercase; letter-spacing: 0.08em; color: var(--subtle); }
        td { color: var(--ink); }
        .status { padding: 6px 10px; border-radius: 10px; background: var(--accent-soft); color: var(--accent); font-weight: 700; font-size: 12px; }

        .columns { display: grid; gap: 14px; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); }
        .list { display: grid; gap: 10px; }
        .list-item { padding: 12px; border-radius: 12px; background: rgba(45,106,79,0.05); border: 1px solid var(--border); color: var(--ink); }

        .footer { text-align: center; color: var(--subtle); font-size: 13px; padding: 28px; }
        .footer a { color: var(--accent); font-weight: 700; }

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
            <p class="hero-tag" style="width: fit-content;">Waterford Council</p>
            <h1>Waterford | Council Transparency</h1>
            <p>Budgets, live projects, population signals, and recent articles - presented in a fresh green design with both light and dark modes.</p>
            <div class="hero-tags">
                <span class="hero-tag">Spending</span>
                <span class="hero-tag">Projects</span>
                <span class="hero-tag">Population</span>
                <span class="hero-tag">Articles</span>
            </div>
        </section>

        <section class="grid">
            <div class="card">
                <h3>Total Allocation 2026</h3>
                <div class="kpi">EUR 4.7M</div>
                <div class="muted">EUR 1.3M remaining</div>
            </div>
            <div class="card">
                <h3>YTD Spend</h3>
                <div class="kpi">EUR 3.4M</div>
                <div class="muted">72% of plan</div>
            </div>
            <div class="card">
                <h3>Major Projects</h3>
                <div class="kpi">11 active</div>
                <div class="muted">3 at risk, 8 on track</div>
            </div>
            <div class="card">
                <h3>Population</h3>
                <div class="kpi">127k</div>
                <div class="muted">Median age 38.2 | 68% employment</div>
            </div>
        </section>

        <section class="section">
            <div class="section-header">
                <h2>Spending Breakdown</h2>
                <span class="pill">Live overview</span>
            </div>
            <table>
                <thead>
                    <tr><th>Program</th><th>Budget</th><th>Spent</th><th>Status</th></tr>
                </thead>
                <tbody>
                    <tr><td>Housing and Homelessness</td><td>EUR 1.6M</td><td>EUR 1.05M (66%)</td><td><span class="status">On track</span></td></tr>
                    <tr><td>Transport and Roads</td><td>EUR 0.9M</td><td>EUR 0.48M (53%)</td><td><span class="status" style="background: rgba(230,57,70,0.15); color: #b91c1c;">Watch</span></td></tr>
                    <tr><td>Climate and Resilience</td><td>EUR 0.7M</td><td>EUR 0.51M (73%)</td><td><span class="status">On track</span></td></tr>
                    <tr><td>Digital Services</td><td>EUR 0.5M</td><td>EUR 0.22M (44%)</td><td><span class="status">On track</span></td></tr>
                    <tr><td>Community and Culture</td><td>EUR 0.3M</td><td>EUR 0.18M (60%)</td><td><span class="status">On track</span></td></tr>
                </tbody>
            </table>
        </section>

        <section class="columns">
            <div class="section">
                <div class="section-header">
                    <h2>Projects</h2>
                    <span class="pill">11 active</span>
                </div>
                <div class="list">
                    <div class="list-item"><strong>Greenway North Loop</strong><br><span class="muted">78% complete | Target Q2 2026 | EUR 650k allocated</span></div>
                    <div class="list-item"><strong>Flood Defenses: Tramore and Dungarvan</strong><br><span class="muted">64% complete | Coastal walls plus sensors | EUR 480k</span></div>
                    <div class="list-item"><strong>Procurement Transparency Pilot</strong><br><span class="muted">Planning | Public dashboard for all contracts above EUR 25k</span></div>
                    <div class="list-item"><strong>EV and Active Transport Lanes</strong><br><span class="muted">42% complete | Smart signals rollout | EUR 310k</span></div>
                </div>
            </div>
            <div class="section">
                <div class="section-header">
                    <h2>Population Signals</h2>
                    <span class="pill">Updated 2026</span>
                </div>
                <div class="list">
                    <div class="list-item"><strong>Youth (0-24)</strong><br><span class="muted">29% | apprenticeships and sport hubs</span></div>
                    <div class="list-item"><strong>Working Age (25-64)</strong><br><span class="muted">54% | transport and digital services</span></div>
                    <div class="list-item"><strong>Seniors (65+)</strong><br><span class="muted">17% | healthcare access and flood resilience</span></div>
                    <div class="list-item"><strong>Households</strong><br><span class="muted">48.3k households | 68% employment</span></div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="section-header">
                <h2>Articles and Updates</h2>
                <span class="pill">Recent</span>
            </div>
            <div class="columns">
                <div class="list-item"><strong>"Waterford approves coastal resilience fund"</strong><br><span class="muted">EUR 480k ring-fenced; milestones published weekly.</span></div>
                <div class="list-item"><strong>"Procurement dashboard to go public"</strong><br><span class="muted">All contracts above EUR 25k will be searchable.</span></div>
                <div class="list-item"><strong>"Greenway extension hits 78% completion"</strong><br><span class="muted">Final surfacing and lighting underway.</span></div>
            </div>
        </section>
    </div>

    <div class="footer">Transparency.ie - Waterford data hub. <a href="/transparency">Transparency</a> | <a href="/case-studies">Case Studies</a></div>
</body>
</html>
