<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transparency HQ | {{ config('app.name', 'Transparency.ie') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @livewireStyles
    <style>
        :root {
            --bg: #f4f7fb;
            --panel: #ffffff;
            --panel-strong: #f0f4ff;
            --subtle: #4b5563;
            --ink: #0f172a;
            --border: #e5e7eb;
            --card: #ffffff;
            --shadow: 0 24px 60px rgba(15,23,42,0.12);
            --accent: #0ea5e9;
            --accent-soft: #e0f2fe;
            --success: #10b981;
            --warning: #f59e0b;
            --glow: 0 0 40px rgba(14,165,233,0.18);
            --hero-start: #0ea5e9;
            --hero-end: #2563eb;
        }

        .dark {
            --bg: #0b0f1a;
            --panel: rgba(255,255,255,0.08);
            --panel-strong: rgba(255,255,255,0.14);
            --subtle: #9ca3af;
            --ink: #e5e7eb;
            --border: rgba(255,255,255,0.14);
            --card: rgba(255,255,255,0.06);
            --shadow: 0 24px 80px rgba(0,0,0,0.28);
            --accent: #7dd3fc;
            --accent-soft: rgba(125,211,252,0.24);
            --success: #34d399;
            --warning: #f59e0b;
            --glow: 0 0 60px rgba(125,211,252,0.16);
            --hero-start: #0b1326;
            --hero-end: #0f172a;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Instrument Sans', system-ui, -apple-system, sans-serif;
            background:
                radial-gradient(circle at 20% 20%, rgba(14,165,233,0.18), transparent 28%),
                radial-gradient(circle at 80% 0%, rgba(37,99,235,0.16), transparent 32%),
                linear-gradient(145deg, var(--hero-start), var(--hero-end) 50%, var(--hero-start));
            color: var(--ink);
        }

        a { color: inherit; text-decoration: none; }

        .wrap {
            position: relative;
            max-width: 1280px;
            margin: 0 auto;
            padding: 32px 28px 48px;
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        .hero {
            display: grid;
            gap: 18px;
            padding: 32px;
            background: linear-gradient(120deg, rgba(14,165,233,0.18), rgba(37,99,235,0.16));
            color: var(--ink);
            border-radius: 18px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            backdrop-filter: blur(20px);
        }

        .hero h1 { margin: 0; font-size: 38px; letter-spacing: -0.6px; }
        .hero p { margin: 0; color: #d1d5db; font-size: 16px; line-height: 1.6; max-width: 860px; }

        .hero-actions { display: flex; gap: 12px; flex-wrap: wrap; }
        .pill {
            padding: 10px 14px;
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.2);
            background: rgba(255,255,255,0.08);
            color: #f9fafb;
            font-weight: 700;
            letter-spacing: 0.01em;
        }
        .pill-alt { background: #f9fafb; color: #0f172a; border-color: #f9fafb; }

        .section {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(18px);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 18px;
        }

        .section-header h2 { margin: 0; font-size: 22px; letter-spacing: -0.4px; }
        .section-header .muted { font-size: 14px; color: var(--subtle); }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 14px;
        }

        .stat-card {
            padding: 18px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--card);
            box-shadow: var(--glow);
            display: grid;
            gap: 6px;
        }

        .stat-label { color: var(--subtle); text-transform: uppercase; letter-spacing: 0.12em; font-size: 11px; font-weight: 700; }
        .stat-value { font-size: 26px; font-weight: 800; letter-spacing: -0.5px; }
        .stat-trend { color: var(--success); font-weight: 700; font-size: 13px; }
        .stat-trend.warn { color: var(--warning); }

        .panel {
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 18px;
            background: var(--card);
            box-shadow: var(--glow);
            backdrop-filter: blur(12px);
        }

        .list { display: grid; gap: 10px; }

        .decision {
            padding: 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--card);
            display: grid;
            gap: 8px;
        }

        .decision strong { font-size: 15px; }
        .decision .meta { color: var(--subtle); font-size: 13px; display: flex; gap: 12px; flex-wrap: wrap; }

        .roster-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 14px; }

        details.roster-card {
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--card);
            padding: 14px 14px 8px;
            box-shadow: var(--glow);
            transition: border-color 160ms ease;
        }

        details.roster-card[open] { border-color: var(--ink); }

        details summary {
            list-style: none;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            font-weight: 700;
        }

        details summary::marker { display: none; }

        .badge {
            background: var(--accent-soft);
            color: var(--ink);
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            box-shadow: var(--glow);
        }

        .footer {
            padding: 26px;
            text-align: center;
            color: var(--subtle);
            font-size: 13px;
        }

        .footer a { color: var(--ink); font-weight: 700; }

        @media (max-width: 720px) {
            .hero { padding: 24px; }
            .hero h1 { font-size: 28px; }
            .section { padding: 18px; }
        }
    </style>
</head>
<body>
    @include('components.nav-professional')
    <div class="wrap">
        <section class="hero">
            <div>
                <p class="pill">Transparency HQ</p>
                <h1>Spending, allowances, and decisions — live in one place.</h1>
            </div>
            <p>Budgets, spending velocity, county allocations, and ministerial calls in a single glassy hub. Data refreshes nightly; overruns trigger immediate alerts.</p>
            <div class="hero-actions">
                <a class="pill-alt" href="#dashboard">Open live dashboard →</a>
                <a class="pill" href="#roster">TD roster & insight →</a>
                <a class="pill" href="#decisions">Latest decisions →</a>
            </div>
        </section>

        <section class="section">
            <div class="section-header">
                <h2>Topline</h2>
                <span class="muted">Allowance vs spending across 2025–2027</span>
            </div>
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-label">Total Allowance</span>
                    <span class="stat-value">€33.2M</span>
                    <span class="stat-trend">€10.1M remaining</span>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Total Spent</span>
                    <span class="stat-value">€23.1M</span>
                    <span class="stat-trend">68% of allowance</span>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Run Rate</span>
                    <span class="stat-value">€1.74M / mo</span>
                    <span class="stat-trend warn">Track Q4 overruns</span>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Compliance</span>
                    <span class="stat-value">94%</span>
                    <span class="stat-trend">Minister approvals up to date</span>
                </div>
            </div>
        </section>

        <section id="dashboard" class="section">
            <div class="section-header">
                <h2>Live Transparency Dashboard</h2>
                <span class="muted">Spending vs allowance and county population signals</span>
            </div>
            <livewire:transparency-dashboard />
        </section>

        <section id="decisions" class="section">
            <div class="section-header">
                <h2>Ministerial Decisions</h2>
                <span class="muted">Latest calls and their impact</span>
            </div>
            <div class="list">
                <div class="decision">
                    <strong>€1.2M uplift for apprenticeship stipends</strong>
                    <div class="meta"><span>2026-05-24</span><span>Approved by Minister Byrne</span><span>Reason: cost-of-living pressure</span></div>
                    <span class="badge">Budget increase</span>
                </div>
                <div class="decision">
                    <strong>Hold on discretionary travel spend</strong>
                    <div class="meta"><span>2026-04-18</span><span>Issued by Minister Byrne</span><span>Reason: 9% over plan</span></div>
                    <span class="badge">Spending pause</span>
                </div>
                <div class="decision">
                    <strong>Data publication cadence set to weekly</strong>
                    <div class="meta"><span>2026-03-06</span><span>Signed by Minister Byrne</span><span>Reason: public transparency</span></div>
                    <span class="badge">Policy change</span>
                </div>
            </div>
        </section>

        <section id="roster" class="section">
            <div class="section-header">
                <h2>TD Roster</h2>
                <span class="muted">Expandable profiles with spend focus areas</span>
            </div>
            <div class="roster-grid">
                <details class="roster-card">
                    <summary>
                        <span>Aoife Kelleher — Waterford</span>
                        <span class="badge">Infrastructure</span>
                    </summary>
                    <p class="muted">Championing coastal resilience and transport electrification. Oversees €4.5M allocation with 96% on-plan.</p>
                    <p class="muted">Contacts: aoife.kelleher@oireachtas.ie • +353 51 555 0101</p>
                </details>
                <details class="roster-card">
                    <summary>
                        <span>Liam O'Connell — Dublin Bay</span>
                        <span class="badge">Education</span>
                    </summary>
                    <p class="muted">Leads apprenticeship reform and data publication cadence. Tracks €3.2M education allowance; variance +4%.</p>
                    <p class="muted">Contacts: liam.oconnell@oireachtas.ie • +353 1 555 1444</p>
                </details>
                <details class="roster-card">
                    <summary>
                        <span>Sarah Ní Chathasaigh — Galway</span>
                        <span class="badge">Climate</span>
                    </summary>
                    <p class="muted">Drives renewable build-out and storage pilots; €2.9M climate envelope, 88% committed, ramping wind-solar balance.</p>
                    <p class="muted">Contacts: sarah.nic@oireachtas.ie • +353 91 555 0909</p>
                </details>
                <details class="roster-card">
                    <summary>
                        <span>Eoin Gallagher — Cork</span>
                        <span class="badge">Health & Safety</span>
                    </summary>
                    <p class="muted">Oversees health procurement transparency; €3.7M allowance, enforcing procurement disclosures and zero-delay invoice tracking.</p>
                    <p class="muted">Contacts: eoin.gallagher@oireachtas.ie • +353 21 555 0707</p>
                </details>
            </div>
        </section>
    </div>

    <footer class="footer">
        Transparency.ie — unified dashboard and spending clarity. <a href="/case-studies">Case Studies</a> · <a href="/events">Events</a>
    </footer>

    @livewireScripts
</body>
</html>
