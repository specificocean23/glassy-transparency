<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Environment | Transparency</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <style>
        :root {
            --bg: #f4f7fb;
            --panel: #ffffff;
            --ink: #0b1b2c;
            --subtle: #5b6470;
            --border: #e1e5ed;
            --card: #ffffff;
            --shadow: 0 24px 64px rgba(7, 48, 94, 0.12);
            --accent: #0ea5e9;
            --accent-soft: #e0f4ff;
            --hero-start: #d7ecff;
            --hero-end: #c4e3ff;
        }
        .dark {
            --bg: #060e18;
            --panel: rgba(255,255,255,0.06);
            --ink: #e8f2ff;
            --subtle: #9fb2c7;
            --border: rgba(255,255,255,0.12);
            --card: rgba(255,255,255,0.06);
            --shadow: 0 24px 80px rgba(0,0,0,0.32);
            --accent: #67e8f9;
            --accent-soft: rgba(103,232,249,0.16);
            --hero-start: #0a1b2b;
            --hero-end: #0b2435;
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Instrument Sans', system-ui, -apple-system, sans-serif;
            background:
                radial-gradient(circle at 16% 14%, rgba(14,165,233,0.16), transparent 30%),
                radial-gradient(circle at 80% 8%, rgba(103,232,249,0.12), transparent 26%),
                linear-gradient(170deg, var(--hero-start), var(--hero-end) 50%, var(--hero-start));
            color: var(--ink);
        }
        a { color: inherit; text-decoration: none; }

        .wrap { max-width: 1240px; margin: 0 auto; padding: 32px 28px 72px; display: grid; gap: 28px; }
        .hero { padding: 32px; border-radius: 18px; background: linear-gradient(135deg, rgba(14,165,233,0.12), rgba(103,232,249,0.12)); border: 1px solid var(--border); box-shadow: var(--shadow); display: grid; gap: 12px; }
        .hero h1 { margin: 0; font-size: 36px; letter-spacing: -0.7px; }
        .hero p { margin: 0; color: var(--subtle); max-width: 840px; line-height: 1.7; }
        .hero-tags { display: flex; flex-wrap: wrap; gap: 10px; }
        .hero-tag { padding: 8px 12px; border-radius: 10px; background: var(--accent-soft); color: var(--ink); font-weight: 700; font-size: 12px; }

        .grid { display: grid; gap: 14px; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); }
        .card { padding: 20px; border-radius: 14px; border: 1px solid var(--border); background: var(--card); box-shadow: var(--shadow); }
        .card h3 { margin: 0 0 4px 0; font-size: 16px; color: var(--accent); }
        .kpi { font-size: 26px; font-weight: 800; margin: 0 0 4px 0; }
        .muted { color: var(--subtle); font-size: 14px; line-height: 1.6; }

        .section { padding: 24px; border-radius: 16px; border: 1px solid var(--border); background: var(--panel); box-shadow: var(--shadow); }
        .section-header { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 12px; }
        .section-header h2 { margin: 0; font-size: 22px; letter-spacing: -0.3px; }
        .pill { padding: 8px 12px; border-radius: 999px; background: var(--accent-soft); color: var(--accent); font-weight: 700; font-size: 12px; }

        .columns { display: grid; gap: 14px; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); }
        .list { display: grid; gap: 10px; }
        .list-item { padding: 12px; border-radius: 12px; background: rgba(14,165,233,0.06); border: 1px solid var(--border); color: var(--ink); }

        .chart-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 14px; }
        .chart { padding: 18px; border-radius: 14px; border: 1px solid var(--border); background: var(--card); box-shadow: var(--shadow); min-height: 160px; position: relative; overflow: hidden; }
        .chart::before { content: ""; position: absolute; inset: 0; background: linear-gradient(90deg, rgba(14,165,233,0.08), rgba(103,232,249,0.04)); }
        .chart h4 { position: relative; margin: 0 0 8px 0; font-size: 14px; color: var(--accent); }
        .chart p { position: relative; margin: 0; color: var(--subtle); font-size: 13px; }

        .footer { text-align: center; color: var(--subtle); font-size: 13px; padding: 28px; }
        .footer a { color: var(--accent); font-weight: 700; }

        @media (max-width: 720px) {
            .wrap { padding: 24px 16px 56px; }
            .hero { padding: 24px; }
            .hero h1 { font-size: 28px; }
        }
    </style>
</head>
<body>
    @include('components.nav-professional')
    <div class="wrap">
        <section class="hero">
            <p class="hero-tag" style="width: fit-content;">Environmental Pillar</p>
            <h1>Environment and Climate</h1>
            <p>Live sustainability signals, project tracking, and quick facts for councils and partners. Built to match the new light and dark theme system.</p>
            <div class="hero-tags">
                <span class="hero-tag">Emissions</span>
                <span class="hero-tag">Energy</span>
                <span class="hero-tag">Air Quality</span>
                <span class="hero-tag">Recycling</span>
            </div>
        </section>

        <section class="grid">
            <div class="card">
                <h3>CO2e Trend</h3>
                <div class="kpi">-7.4% YoY</div>
                <div class="muted">Citywide emissions index vs last year</div>
            </div>
            <div class="card">
                <h3>Renewables</h3>
                <div class="kpi">42% mix</div>
                <div class="muted">Grid contribution across public assets</div>
            </div>
            <div class="card">
                <h3>Air Quality</h3>
                <div class="kpi">AQI 38</div>
                <div class="muted">PM2.5 average this week</div>
            </div>
            <div class="card">
                <h3>Recycling</h3>
                <div class="kpi">61% rate</div>
                <div class="muted">Quarterly household diversion</div>
            </div>
        </section>

        <section class="section">
            <div class="section-header">
                <h2>Live Signals</h2>
                <span class="pill">Updated hourly</span>
            </div>
            <div class="chart-row">
                <div class="chart">
                    <h4>Energy Demand vs Renewables</h4>
                    <p>Public buildings draw 18.4 MW; renewables supplying 7.7 MW.</p>
                </div>
                <div class="chart">
                    <h4>Mobility</h4>
                    <p>32% trips active or public transport; peak congestion down 6% week over week.</p>
                </div>
                <div class="chart">
                    <h4>Water Quality</h4>
                    <p>Compliance 96.2%; alerts cleared in 3.1 hours avg.</p>
                </div>
            </div>
        </section>

        <section class="columns">
            <div class="section">
                <div class="section-header">
                    <h2>Projects</h2>
                    <span class="pill">9 active</span>
                </div>
                <div class="list">
                    <div class="list-item"><strong>Heat Pump Upgrade Wave</strong><br><span class="muted">Schools and libraries; 38% complete; EUR 2.1M allocated</span></div>
                    <div class="list-item"><strong>Solar on Council Roofs</strong><br><span class="muted">12 of 20 sites energized; 3.4 MW built</span></div>
                    <div class="list-item"><strong>Air Quality Micro-sensors</strong><br><span class="muted">46 of 60 units online; public map refreshed hourly</span></div>
                    <div class="list-item"><strong>eBus Pilot</strong><br><span class="muted">4 routes live; satisfaction 4.6/5 from surveys</span></div>
                </div>
            </div>
            <div class="section">
                <div class="section-header">
                    <h2>Policy and Commitments</h2>
                    <span class="pill">Council 2026</span>
                </div>
                <div class="list">
                    <div class="list-item"><strong>Net Zero 2035</strong><br><span class="muted">Interim -35% by 2027; tracking quarterly</span></div>
                    <div class="list-item"><strong>EV and Active Transport</strong><br><span class="muted">70 km protected lanes; 120 new chargers</span></div>
                    <div class="list-item"><strong>Green Procurement</strong><br><span class="muted">All tenders score climate impact; dashboard public</span></div>
                    <div class="list-item"><strong>Heat Resilience</strong><br><span class="muted">Cooling centers mapped; SMS alert opt-in live</span></div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="section-header">
                <h2>Notes and Next Data Drops</h2>
                <span class="pill">Roadmap</span>
            </div>
            <div class="columns">
                <div class="list-item"><strong>Open emissions API</strong><br><span class="muted">Scoped; beta keys in March.</span></div>
                <div class="list-item"><strong>Waste analytics revamp</strong><br><span class="muted">New sensors in Q2; routing insights to follow.</span></div>
                <div class="list-item"><strong>Public engagement</strong><br><span class="muted">Workshops for climate budget launch.</span></div>
            </div>
        </section>
    </div>

    <div class="footer">Transparency.ie - Environment pillar. <a href="/transparency">Transparency</a> | <a href="/waterford">Waterford</a></div>
</body>
</html>
