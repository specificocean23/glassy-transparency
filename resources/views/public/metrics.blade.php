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

        .panel {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 40px;
            box-shadow: var(--shadow);
            backdrop-filter: var(--blur);
        }

        .muted { color: var(--subtle); font-size: 14px; line-height: 1.6; }
        h1, h2, h3 { margin: 0; letter-spacing: -0.5px; }
        h2 { font-size: 36px; font-weight: 800; line-height: 1.2; margin-bottom: 16px; }
        .tag { font-size: 11px; text-transform: uppercase; letter-spacing: 0.15em; color: var(--subtle); font-weight: 600; }

        .metrics-grid {
            display: grid;
            gap: 24px;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        }

        .metric-card {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 32px;
            background: var(--card);
            cursor: pointer;
            transition: all 200ms ease;
            position: relative;
        }
        .metric-card:hover {
            border-color: var(--ink);
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
        }

        .metric-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
        }
        .metric-title {
            font-size: 20px;
            font-weight: 700;
            margin: 8px 0 4px 0;
        }
        .metric-number {
            font-size: 40px;
            font-weight: 800;
            color: var(--ink);
            margin: 12px 0 4px 0;
        }
        .metric-change {
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 12px;
        }
        .metric-change.positive { color: #4CAF50; }
        .metric-change.negative { color: #f44336; }

        .expand-icon {
            flex-shrink: 0;
            font-size: 20px;
            transition: transform 300ms ease;
        }
        .metric-card.expanded .expand-icon {
            transform: rotate(180deg);
        }

        .metric-expanded {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: max-height 400ms ease, opacity 300ms ease, padding 400ms ease;
        }
        .metric-card.expanded .metric-expanded {
            max-height: 800px;
            opacity: 1;
            padding: 28px 0 0 0;
            margin-top: 28px;
            border-top: 1px solid var(--border);
        }

        .metric-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }
        .metric-tab {
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            background: var(--bg);
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 160ms ease;
        }
        .metric-tab:hover,
        .metric-tab.active {
            background: var(--ink);
            color: var(--bg);
            border-color: var(--ink);
        }

        .metric-chart {
            height: 240px;
            background: linear-gradient(180deg, var(--bg) 0%, rgba(0,0,0,0.02) 100%);
            border: 1px solid var(--border);
            border-radius: 8px;
            display: flex;
            align-items: flex-end;
            justify-content: space-around;
            padding: 16px;
            gap: 12px;
            margin-bottom: 20px;
        }
        .chart-bar {
            flex: 1;
            background: var(--ink);
            border-radius: 4px 4px 0 0;
            transition: all 200ms ease;
            position: relative;
            min-height: 20px;
        }
        .chart-bar:hover {
            opacity: 0.8;
            transform: scaleY(1.05);
        }
        .chart-bar-label {
            position: absolute;
            bottom: -24px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 11px;
            color: var(--subtle);
            white-space: nowrap;
        }

        .metric-sources {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 16px;
        }
        .metric-sources h4 {
            margin: 0 0 12px 0;
            font-size: 14px;
            font-weight: 700;
        }
        .source-item {
            padding: 8px 0;
            border-bottom: 1px solid var(--border);
            font-size: 13px;
        }
        .source-item:last-child {
            border-bottom: none;
        }
        .source-label { color: var(--subtle); font-weight: 600; }
        .source-value { color: var(--ink); margin-top: 2px; }
        .source-link { color: #4CAF50; text-decoration: none; margin-top: 2px; }
        .source-link:hover { text-decoration: underline; }

        .reveal { opacity: 0; transform: translateY(16px); transition: opacity 0.7s ease, transform 0.7s ease; }
        .revealed { opacity: 1; transform: translateY(0); }

        @media (max-width: 768px) {
            .wrap { padding: 24px 16px 40px; gap: 32px; }
            .panel { padding: 24px; }
            h2 { font-size: 28px; }
            .metric-chart { height: 180px; }
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
                // Reveal animations
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('revealed');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.1 });
                document.querySelectorAll('.reveal').forEach((el) => observer.observe(el));

                // Expandable metric cards
                document.querySelectorAll('.metric-card').forEach(card => {
                    card.addEventListener('click', function(e) {
                        // Don't expand if clicking a tab
                        if (e.target.closest('.metric-tab')) return;
                        this.classList.toggle('expanded');
                    });
                    
                    // Tab switching
                    const tabs = card.querySelectorAll('.metric-tab');
                    tabs.forEach(tab => {
                        tab.addEventListener('click', (e) => {
                            e.stopPropagation();
                            tabs.forEach(t => t.classList.remove('active'));
                            tab.classList.add('active');
                        });
                    });
                });
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
                <p class="muted" style="font-size: 16px; max-width: 680px; line-height: 1.7;">Click any metric to expand and explore detailed data, trends over time, and comprehensive sources. Real-time tracking of budget transparency, climate progress, civic engagement, and technology adoption.</p>
            </section>

            <div class="metrics-grid reveal">
                <!-- Metric 1: Total Budgets -->
                <div class="metric-card reveal">
                    <div class="metric-header">
                        <div style="flex: 1;">
                            <p class="tag">Public Finance</p>
                            <h3 class="metric-title">Total Budgets Mapped</h3>
                            <div class="metric-number">€104B</div>
                            <p class="metric-change positive">↑ €8.2B from 2022</p>
                            <p class="muted">Across 47 departments and agencies. Real-time spending data now live.</p>
                        </div>
                        <div class="expand-icon">▼</div>
                    </div>
                    
                    <div class="metric-expanded">
                        <div class="metric-tabs">
                            <div class="metric-tab active">Timeline</div>
                            <div class="metric-tab">By Department</div>
                            <div class="metric-tab">Sources</div>
                        </div>

                        <div class="metric-chart">
                            <div class="chart-bar" style="height: 30%;"><div class="chart-bar-label">2020</div></div>
                            <div class="chart-bar" style="height: 45%;"><div class="chart-bar-label">2021</div></div>
                            <div class="chart-bar" style="height: 62%;"><div class="chart-bar-label">2022</div></div>
                            <div class="chart-bar" style="height: 78%;"><div class="chart-bar-label">2023</div></div>
                            <div class="chart-bar" style="height: 88%;"><div class="chart-bar-label">2024</div></div>
                            <div class="chart-bar" style="height: 100%;"><div class="chart-bar-label">2025</div></div>
                        </div>

                        <div class="metric-sources">
                            <h4>Data Sources</h4>
                            <div class="source-item">
                                <div class="source-label">Primary Source</div>
                                <div class="source-value">Department of Finance Portal</div>
                                <div class="source-link"><a href="#">→ Visit source</a></div>
                            </div>
                            <div class="source-item">
                                <div class="source-label">Updated</div>
                                <div class="source-value">January 2026 (Real-time)</div>
                            </div>
                            <div class="source-item">
                                <div class="source-label">Methodology</div>
                                <div class="source-value">Aggregated from 47 government entities using standardized reporting</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metric 2: Budget Data Points -->
                <div class="metric-card reveal">
                    <div class="metric-header">
                        <div style="flex: 1;">
                            <p class="tag">Transparency</p>
                            <h3 class="metric-title">Budget Data Points</h3>
                            <div class="metric-number">847K</div>
                            <p class="metric-change positive">↑ 34% adoption rate</p>
                            <p class="muted">Individual line items now queryable. Machine-readable APIs available.</p>
                        </div>
                        <div class="expand-icon">▼</div>
                    </div>

                    <div class="metric-expanded">
                        <div class="metric-tabs">
                            <div class="metric-tab active">Growth</div>
                            <div class="metric-tab">Format</div>
                            <div class="metric-tab">Sources</div>
                        </div>

                        <div class="metric-chart">
                            <div class="chart-bar" style="height: 20%;"><div class="chart-bar-label">Q1 24</div></div>
                            <div class="chart-bar" style="height: 35%;"><div class="chart-bar-label">Q2 24</div></div>
                            <div class="chart-bar" style="height: 52%;"><div class="chart-bar-label">Q3 24</div></div>
                            <div class="chart-bar" style="height: 75%;"><div class="chart-bar-label">Q4 24</div></div>
                            <div class="chart-bar" style="height: 100%;"><div class="chart-bar-label">Q1 25</div></div>
                        </div>

                        <div class="metric-sources">
                            <h4>Data Sources</h4>
                            <div class="source-item">
                                <div class="source-label">Primary Source</div>
                                <div class="source-value">Transparency.ie Data API v2.0</div>
                                <div class="source-link"><a href="#">→ API Documentation</a></div>
                            </div>
                            <div class="source-item">
                                <div class="source-label">Format</div>
                                <div class="source-value">JSON, CSV, RDF, Open Data Portal</div>
                            </div>
                            <div class="source-item">
                                <div class="source-label">Validation</div>
                                <div class="source-value">Audited quarterly by independent data verifiers</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metric 3: Emissions Tracked -->
                <div class="metric-card reveal">
                    <div class="metric-header">
                        <div style="flex: 1;">
                            <p class="tag">Climate</p>
                            <h3 class="metric-title">Emissions Tracked</h3>
                            <div class="metric-number">32 Metrics</div>
                            <p class="metric-change negative">↓ 4.2% annual reduction</p>
                            <p class="muted">Public sector on track for 2030 carbon neutrality target.</p>
                        </div>
                        <div class="expand-icon">▼</div>
                    </div>

                    <div class="metric-expanded">
                        <div class="metric-tabs">
                            <div class="metric-tab active">Projections</div>
                            <div class="metric-tab">By Sector</div>
                            <div class="metric-tab">Sources</div>
                        </div>

                        <div class="metric-chart">
                            <div class="chart-bar" style="height: 100%;"><div class="chart-bar-label">2020</div></div>
                            <div class="chart-bar" style="height: 93%;"><div class="chart-bar-label">2021</div></div>
                            <div class="chart-bar" style="height: 88%;"><div class="chart-bar-label">2022</div></div>
                            <div class="chart-bar" style="height: 82%;"><div class="chart-bar-label">2023</div></div>
                            <div class="chart-bar" style="height: 76%;"><div class="chart-bar-label">2024</div></div>
                            <div class="chart-bar" style="height: 68%;"><div class="chart-bar-label">2025</div></div>
                        </div>

                        <div class="metric-sources">
                            <h4>Data Sources</h4>
                            <div class="source-item">
                                <div class="source-label">Primary Source</div>
                                <div class="source-value">EPA Ireland Emissions Reporting</div>
                                <div class="source-link"><a href="#">→ Visit EPA</a></div>
                            </div>
                            <div class="source-item">
                                <div class="source-label">Coverage</div>
                                <div class="source-value">32 tracked metrics across public sector, energy, transport, buildings</div>
                            </div>
                            <div class="source-item">
                                <div class="source-label">Verification</div>
                                <div class="source-value">Annual third-party audit by KPMG Ireland</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metric 4: Renewable Energy Mix -->
                <div class="metric-card reveal">
                    <div class="metric-header">
                        <div style="flex: 1;">
                            <p class="tag">Energy</p>
                            <h3 class="metric-title">Renewable Energy Mix</h3>
                            <div class="metric-number">52%</div>
                            <p class="metric-change positive">↑ 12% from 2020</p>
                            <p class="muted">Wind, solar, hydro, and biomass now dominant in grid. Storage pending.</p>
                        </div>
                        <div class="expand-icon">▼</div>
                    </div>

                    <div class="metric-expanded">
                        <div class="metric-tabs">
                            <div class="metric-tab active">Composition</div>
                            <div class="metric-tab">Regional</div>
                            <div class="metric-tab">Sources</div>
                        </div>

                        <div class="metric-chart">
                            <div class="chart-bar" style="height: 25%;"><div class="chart-bar-label">Wind</div></div>
                            <div class="chart-bar" style="height: 15%;"><div class="chart-bar-label">Solar</div></div>
                            <div class="chart-bar" style="height: 8%;"><div class="chart-bar-label">Hydro</div></div>
                            <div class="chart-bar" style="height: 4%;"><div class="chart-bar-label">Biomass</div></div>
                        </div>

                        <div class="metric-sources">
                            <h4>Data Sources</h4>
                            <div class="source-item">
                                <div class="source-label">Primary Source</div>
                                <div class="source-value">EirGrid Real-Time Grid Data</div>
                                <div class="source-link"><a href="#">→ Visit EirGrid</a></div>
                            </div>
                            <div class="source-item">
                                <div class="source-label">Updated</div>
                                <div class="source-value">Every 15 minutes (live)</div>
                            </div>
                            <div class="source-item">
                                <div class="source-label">Target</div>
                                <div class="source-value">80% renewables by 2030 (on track)</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metric 5: Active Campaigns -->
                <div class="metric-card reveal">
                    <div class="metric-header">
                        <div style="flex: 1;">
                            <p class="tag">Engagement</p>
                            <h3 class="metric-title">Active Campaigns</h3>
                            <div class="metric-number">14</div>
                            <p class="metric-change positive">18K supporters</p>
                            <p class="muted">Citizen-led advocacy from climate to transport to education equity.</p>
                        </div>
                        <div class="expand-icon">▼</div>
                    </div>

                    <div class="metric-expanded">
                        <div class="metric-tabs">
                            <div class="metric-tab active">Timeline</div>
                            <div class="metric-tab">Topics</div>
                            <div class="metric-tab">Sources</div>
                        </div>

                        <div class="metric-chart">
                            <div class="chart-bar" style="height: 35%;"><div class="chart-bar-label">Climate</div></div>
                            <div class="chart-bar" style="height: 25%;"><div class="chart-bar-label">Transport</div></div>
                            <div class="chart-bar" style="height: 20%;"><div class="chart-bar-label">Budget</div></div>
                            <div class="chart-bar" style="height: 15%;"><div class="chart-bar-label">Housing</div></div>
                            <div class="chart-bar" style="height: 10%;"><div class="chart-bar-label">Other</div></div>
                        </div>

                        <div class="metric-sources">
                            <h4>Data Sources</h4>
                            <div class="source-item">
                                <div class="source-label">Primary Source</div>
                                <div class="source-value">Transparency.ie Campaign Database</div>
                                <div class="source-link"><a href="/campaigns">→ Browse campaigns</a></div>
                            </div>
                            <div class="source-item">
                                <div class="source-label">Participants</div>
                                <div class="source-value">18,234 active civic participants</div>
                            </div>
                            <div class="source-item">
                                <div class="source-label">Success Rate</div>
                                <div class="source-value">8 campaigns won policy commitments in 2025</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metric 6: Community Members -->
                <div class="metric-card reveal">
                    <div class="metric-header">
                        <div style="flex: 1;">
                            <p class="tag">Growth</p>
                            <h3 class="metric-title">Community Members</h3>
                            <div class="metric-number">67K+</div>
                            <p class="metric-change positive">↑ 47% YoY growth</p>
                            <p class="muted">Active users engaging with budgets, events, and policy discussions monthly.</p>
                        </div>
                        <div class="expand-icon">▼</div>
                    </div>

                    <div class="metric-expanded">
                        <div class="metric-tabs">
                            <div class="metric-tab active">Growth</div>
                            <div class="metric-tab">Engagement</div>
                            <div class="metric-tab">Sources</div>
                        </div>

                        <div class="metric-chart">
                            <div class="chart-bar" style="height: 20%;"><div class="chart-bar-label">Q1 24</div></div>
                            <div class="chart-bar" style="height: 32%;"><div class="chart-bar-label">Q2 24</div></div>
                            <div class="chart-bar" style="height: 48%;"><div class="chart-bar-label">Q3 24</div></div>
                            <div class="chart-bar" style="height: 68%;"><div class="chart-bar-label">Q4 24</div></div>
                            <div class="chart-bar" style="height: 100%;"><div class="chart-bar-label">Q1 25</div></div>
                        </div>

                        <div class="metric-sources">
                            <h4>Data Sources</h4>
                            <div class="source-item">
                                <div class="source-label">Primary Source</div>
                                <div class="source-value">Transparency.ie User Analytics</div>
                            </div>
                            <div class="source-item">
                                <div class="source-label">Activity</div>
                                <div class="source-value">Monthly active users: 23,847 (35% of registered users)</div>
                            </div>
                            <div class="source-item">
                                <div class="source-label">Geographic</div>
                                <div class="source-value">Represented across all 32 Irish counties</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metric 7: Energy Storage Pilots -->
                <div class="metric-card reveal">
                    <div class="metric-header">
                        <div style="flex: 1;">
                            <p class="tag">Technology</p>
                            <h3 class="metric-title">Energy Storage Pilots</h3>
                            <div class="metric-number">8</div>
                            <p class="metric-change positive">€34M invested</p>
                            <p class="muted">Battery systems now operational in Limerick, Cork, and Waterford.</p>
                        </div>
                        <div class="expand-icon">▼</div>
                    </div>

                    <div class="metric-expanded">
                        <div class="metric-tabs">
                            <div class="metric-tab active">Projects</div>
                            <div class="metric-tab">Investment</div>
                            <div class="metric-tab">Sources</div>
                        </div>

                        <div class="metric-chart">
                            <div class="chart-bar" style="height: 30%;"><div class="chart-bar-label">Li-Ion</div></div>
                            <div class="chart-bar" style="height: 25%;"><div class="chart-bar-label">Flow</div></div>
                            <div class="chart-bar" style="height: 20%;"><div class="chart-bar-label">Gravity</div></div>
                            <div class="chart-bar" style="height: 15%;"><div class="chart-bar-label">Thermal</div></div>
                            <div class="chart-bar" style="height: 10%;"><div class="chart-bar-label">Other</div></div>
                        </div>

                        <div class="metric-sources">
                            <h4>Data Sources</h4>
                            <div class="source-item">
                                <div class="source-label">Primary Source</div>
                                <div class="source-value">Department of Energy Ireland</div>
                                <div class="source-link"><a href="#">→ Visit DOE</a></div>
                            </div>
                            <div class="source-item">
                                <div class="source-label">Scale</div>
                                <div class="source-value">40 MWh total capacity deployed nationally</div>
                            </div>
                            <div class="source-item">
                                <div class="source-label">Timeline</div>
                                <div class="source-value">Additional 120 MWh planned for 2026-2027</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metric 8: Grid Innovation Projects -->
                <div class="metric-card reveal">
                    <div class="metric-header">
                        <div style="flex: 1;">
                            <p class="tag">Technology</p>
                            <h3 class="metric-title">Grid Innovation Projects</h3>
                            <div class="metric-number">23</div>
                            <p class="metric-change positive">↑ 6 launched this year</p>
                            <p class="muted">Smart metering, demand response, and microgrid experiments ongoing.</p>
                        </div>
                        <div class="expand-icon">▼</div>
                    </div>

                    <div class="metric-expanded">
                        <div class="metric-tabs">
                            <div class="metric-tab active">Projects</div>
                            <div class="metric-tab">Maturity</div>
                            <div class="metric-tab">Sources</div>
                        </div>

                        <div class="metric-chart">
                            <div class="chart-bar" style="height: 40%;"><div class="chart-bar-label">Planning</div></div>
                            <div class="chart-bar" style="height: 35%;"><div class="chart-bar-label">Testing</div></div>
                            <div class="chart-bar" style="height: 20%;"><div class="chart-bar-label">Deployed</div></div>
                            <div class="chart-bar" style="height: 5%;"><div class="chart-bar-label">Scaling</div></div>
                        </div>

                        <div class="metric-sources">
                            <h4>Data Sources</h4>
                            <div class="source-item">
                                <div class="source-label">Primary Source</div>
                                <div class="source-value">EirGrid Innovation Programme</div>
                                <div class="source-link"><a href="#">→ Visit EirGrid</a></div>
                            </div>
                            <div class="source-item">
                                <div class="source-label">Focus Areas</div>
                                <div class="source-value">Smart meters (31% rollout), demand response, microgrids</div>
                            </div>
                            <div class="source-item">
                                <div class="source-label">Budget</div>
                                <div class="source-value">€18M allocated through 2027</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metric 9: Hackathons & Events -->
                <div class="metric-card reveal">
                    <div class="metric-header">
                        <div style="flex: 1;">
                            <p class="tag">Outreach</p>
                            <h3 class="metric-title">Hackathons & Events</h3>
                            <div class="metric-number">12</div>
                            <p class="metric-change positive">2.4K participants</p>
                            <p class="muted">Nationwide events fostering civic data literacy and innovation.</p>
                        </div>
                        <div class="expand-icon">▼</div>
                    </div>

                    <div class="metric-expanded">
                        <div class="metric-tabs">
                            <div class="metric-tab active">Timeline</div>
                            <div class="metric-tab">Types</div>
                            <div class="metric-tab">Sources</div>
                        </div>

                        <div class="metric-chart">
                            <div class="chart-bar" style="height: 35%;"><div class="chart-bar-label">2024</div></div>
                            <div class="chart-bar" style="height: 50%;"><div class="chart-bar-label">2025</div></div>
                            <div class="chart-bar" style="height: 30%;"><div class="chart-bar-label">2026</div></div>
                        </div>

                        <div class="metric-sources">
                            <h4>Data Sources</h4>
                            <div class="source-item">
                                <div class="source-label">Primary Source</div>
                                <div class="source-value">Transparency.ie Event Registry</div>
                                <div class="source-link"><a href="/events">→ View upcoming events</a></div>
                            </div>
                            <div class="source-item">
                                <div class="source-label">Participant Feedback</div>
                                <div class="source-value">92% satisfaction rating across all events</div>
                            </div>
                            <div class="source-item">
                                <div class="source-label">Outcomes</div>
                                <div class="source-value">18 startups, 8 new tools, 6 policy wins</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
