<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Case Studies | {{ config('app.name', 'Transparency.ie') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <style>
        :root {
            --bg: #0b1326;
            --panel: rgba(255,255,255,0.06);
            --panel-strong: rgba(255,255,255,0.08);
            --ink: #0f172a;
            --ink-strong: #0b1326;
            --subtle: #4b5563;
            --border: rgba(15,23,42,0.14);
            --card: #ffffff;
            --shadow: 0 24px 60px rgba(15,23,42,0.16);
            --accent: #0ea5e9;
            --accent-soft: #e0f2fe;
        }
        .dark {
            --bg: #030712;
            --panel: rgba(255,255,255,0.06);
            --panel-strong: rgba(255,255,255,0.12);
            --ink: #e5e7eb;
            --ink-strong: #ffffff;
            --subtle: #9ca3af;
            --border: rgba(255,255,255,0.12);
            --card: rgba(255,255,255,0.04);
            --shadow: 0 24px 80px rgba(0,0,0,0.3);
            --accent: #38bdf8;
            --accent-soft: rgba(56,189,248,0.16);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Instrument Sans', system-ui, -apple-system, sans-serif;
            background:
                radial-gradient(circle at 20% 20%, rgba(56,189,248,0.2), transparent 30%),
                radial-gradient(circle at 75% 10%, rgba(14,165,233,0.18), transparent 28%),
                linear-gradient(160deg, #f7fbff, #eef2ff 40%, #f7fbff);
            color: var(--ink);
        }

        .dark body { background: #030712; }

        a { color: inherit; text-decoration: none; }

        .wrap { max-width: 1240px; margin: 0 auto; padding: 32px 28px 64px; display: grid; gap: 28px; }

        .hero {
            padding: 32px;
            border-radius: 18px;
            background: linear-gradient(135deg, rgba(14,165,233,0.16), rgba(99,102,241,0.14));
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            display: grid;
            gap: 12px;
        }
        .hero h1 { margin: 0; font-size: 38px; letter-spacing: -0.8px; color: var(--ink-strong); }
        .hero p { margin: 0; max-width: 780px; color: var(--subtle); line-height: 1.7; }
        .hero-tags { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 6px; }
        .hero-tag { padding: 8px 12px; border-radius: 10px; background: var(--accent-soft); color: var(--ink); font-weight: 700; font-size: 12px; }

        .grid { display: grid; gap: 18px; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); }

        .case-card {
            padding: 26px;
            border-radius: 14px;
            border: 1px solid var(--border);
            background: var(--card);
            box-shadow: var(--shadow);
            display: grid;
            gap: 12px;
            position: relative;
            overflow: hidden;
        }
        .case-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(14,165,233,0.04), rgba(37,99,235,0.03));
            opacity: 0;
            transition: opacity 160ms ease;
        }
        .case-card:hover::after { opacity: 1; }
        .case-card h3 { margin: 0; font-size: 20px; letter-spacing: -0.3px; position: relative; z-index: 1; }
        .case-card p { margin: 0; color: var(--subtle); line-height: 1.6; position: relative; z-index: 1; }
        .case-meta { display: flex; gap: 10px; flex-wrap: wrap; position: relative; z-index: 1; }
        .case-meta span { padding: 6px 10px; border-radius: 999px; background: var(--accent-soft); font-size: 12px; font-weight: 700; color: var(--ink); }
        .case-link { font-weight: 700; color: var(--accent); display: inline-flex; align-items: center; gap: 6px; position: relative; z-index: 1; }

        .section-header { display: flex; align-items: center; justify-content: space-between; gap: 12px; }
        .section-header h2 { margin: 0; font-size: 24px; letter-spacing: -0.4px; }
        .section-header .muted { color: var(--subtle); }

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
            <p class="hero-tag" style="width: fit-content;">Real-world proof points</p>
            <h1>Case Studies</h1>
            <p>Community projects, local innovations, and the lessons learned from publishing spend, climate data, and civic outcomes across Ireland.</p>
            <div class="hero-tags">
                <span class="hero-tag">Transparency in action</span>
                <span class="hero-tag">Climate & energy</span>
                <span class="hero-tag">Civic outcomes</span>
            </div>
        </section>

        <div class="section-header">
            <h2>Projects with measurable impact</h2>
            <span class="muted">Stories, budgets, outcomes</span>
        </div>

        <section class="grid">
            <div class="case-card">
                <div class="case-meta"><span>2023</span><span>Cork</span><span>Energy</span></div>
                <h3>Cork City's Renewable Energy Pivot</h3>
                <p>Tracked €8.2M in energy infrastructure, accelerated to 47% renewable power in 18 months, and published monthly spend data.</p>
                <a class="case-link" href="#case-1">Read story →</a>
            </div>
            <div class="case-card">
                <div class="case-meta"><span>2022–2023</span><span>Dublin</span><span>Transport</span></div>
                <h3>Dublin Cycle Lane Coalition</h3>
                <p>Citizens and council published transparent spend, delivered 22km of protected lanes, and reduced collisions 14% year-on-year.</p>
                <a class="case-link" href="#case-2">Read story →</a>
            </div>
            <div class="case-card">
                <div class="case-meta"><span>2023</span><span>Waterford</span><span>Environment</span></div>
                <h3>Water Quality Alliance</h3>
                <p>Mapped €3.8M water initiatives, identified gaps, and aligned regional councils with weekly transparency dashboards.</p>
                <a class="case-link" href="#case-3">Read story →</a>
            </div>
            <div class="case-card">
                <div class="case-meta"><span>2023</span><span>Galway</span><span>Community</span></div>
                <h3>Galway Youth Funding Transparency</h3>
                <p>Public dashboard unlocked €2.1M for youth hubs; spend tracked with open-source tooling and quarterly public reviews.</p>
                <a class="case-link" href="#case-4">Read story →</a>
            </div>
            <div class="case-card">
                <div class="case-meta"><span>2022–2023</span><span>Limerick</span><span>Innovation</span></div>
                <h3>Limerick Energy Storage Trial</h3>
                <p>Battery storage pilot published live performance, proving 4-hour storage extends solar value 3x and cut curtailment 28%.</p>
                <a class="case-link" href="#case-5">Read story →</a>
            </div>
            <div class="case-card">
                <div class="case-meta"><span>2023</span><span>Belfast</span><span>Governance</span></div>
                <h3>Belfast Budget Co-design Forum</h3>
                <p>Participatory budget allocating €4.2M to community priorities with 78% civic satisfaction and open procurement records.</p>
                <a class="case-link" href="#case-6">Read story →</a>
            </div>
        </section>
    </div>

    <footer class="footer">
        Transparency.ie — building open budgets. <a href="/transparency">Transparency</a> · <a href="/events">Events</a>
    </footer>
</body>
</html>
