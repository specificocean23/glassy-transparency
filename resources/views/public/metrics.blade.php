<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Metrics | {{ config('app.name', 'Transparency.ie') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
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
        h3 { font-size: 18px; font-weight: 700; margin: 12px 0 8px 0; }
        .tag { font-size: 11px; text-transform: uppercase; letter-spacing: 0.15em; color: var(--subtle); font-weight: 600; }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
        }

        .metric-card {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 32px;
            background: var(--card);
            transition: all 200ms ease;
            display: flex;
            flex-direction: column;
            gap: 16px;
            cursor: pointer;
            position: relative;
        }
        .metric-card:hover {
            border-color: var(--ink);
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
        }
        .metric-card.expanded {
            grid-column: 1 / -1;
            padding: 40px;
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
        
        .metric-expand-btn {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 32px;
            height: 32px;
            border-radius: 6px;
            border: 1px solid var(--border);
            background: var(--bg);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transition: all 160ms ease;
        }
        .metric-expand-btn:hover {
            border-color: var(--ink);
            background: var(--card);
        }
        .metric-card.expanded .metric-expand-btn { top: 24px; right: 24px; }

        .metric-content { display: block; }
        .metric-card.expanded .metric-content { display: none; }
        
        .metric-expanded { display: none; }
        .metric-card.expanded .metric-expanded { 
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }
        
        .metric-chart {
            height: 300px;
            position: relative;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 16px;
            background: var(--bg);
        }
        
        .metric-details {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }
        .metric-detail-section {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .metric-detail-section h4 {
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: var(--ink);
            margin: 0;
        }
        .metric-detail-section p {
            font-size: 13px;
            color: var(--subtle);
            line-height: 1.6;
            margin: 0;
        }
        
        .metric-source {
            padding: 14px;
            background: var(--bg);
            border-radius: 6px;
            border: 1px solid var(--border);
        }
        .metric-source-title {
            font-weight: 700;
            font-size: 11px;
            color: var(--ink);
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }
        .metric-source-link {
            font-size: 12px;
            color: var(--subtle);
            text-decoration: none;
            transition: color 160ms ease;
            display: inline-block;
        }
        .metric-source-link:hover { color: var(--ink); }

        .reveal { opacity: 0; transform: translateY(16px); transition: opacity 0.7s ease, transform 0.7s ease; }
        .revealed { opacity: 1; transform: translateY(0); }

        @media (max-width: 768px) {
            .wrap { padding: 24px 16px 40px; gap: 32px; }
            .panel { padding: 24px; }
            h2 { font-size: 28px; }
            header.top { gap: 16px; }
            nav.links { gap: 12px; }
            .metric-expanded {
                grid-template-columns: 1fr !important;
            }
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
            
            window.expandMetric = (id) => {
                const card = document.getElementById(`metric-${id}`);
                if (card) {
                    card.classList.toggle('expanded');
                    if (card.classList.contains('expanded')) {
                        setTimeout(() => {
                            const canvas = card.querySelector('canvas');
                            if (canvas && canvas.chartInstance === undefined) {
                                const ctx = canvas.getContext('2d');
                                try {
                                    const config = JSON.parse(canvas.dataset.chartConfig);
                                    canvas.chartInstance = new Chart(ctx, config);
                                } catch (e) {
                                    console.error('Chart config error:', e);
                                }
                            }
                        }, 100);
                    }
                }
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
                <p class="muted" style="font-size: 16px; max-width: 680px; line-height: 1.7;">Real-time tracking of budget transparency, climate progress, civic engagement, and technology adoption. Click any metric to explore historical trends, detailed charts, comprehensive data sources, and insights.</p>
            </section>

            <section class="metrics-grid reveal">
                <!-- Metric 1: Total Budgets -->
                <div id="metric-1" class="metric-card reveal" onclick="expandMetric('1')">
                    <button class="metric-expand-btn" onclick="event.stopPropagation(); expandMetric('1')">⬇️</button>
                    <div class="metric-content">
                        <p class="tag">Public Finance</p>
                        <h3>Total Budgets Mapped</h3>
                        <div class="metric-number">€104B</div>
                        <p class="metric-change">↑ €8.2B from 2022</p>
                        <p class="muted">Across 47 departments and agencies. Real-time spending data now live.</p>
                    </div>
                    <div class="metric-expanded">
                        <div class="metric-chart">
                            <canvas data-chart-config='{"type":"line","data":{"labels":["2019","2020","2021","2022","2023","2024","2025","2026"],"datasets":[{"label":"Budget Mapped (€B)","data":[45,52,68,95.8,104,108,112,116],"borderColor":"#1a1a1a","backgroundColor":"rgba(26,26,26,0.05)","borderWidth":2,"fill":true,"tension":0.4}]},"options":{"responsive":true,"maintainAspectRatio":false,"plugins":{"legend":{"display":true},"title":{"display":true,"text":"7-Year Budget Transparency Growth"}},"scales":{"y":{"beginAtZero":true}}}}'></canvas>
                        </div>
                        <div class="metric-details">
                            <button class="metric-expand-btn" onclick="event.stopPropagation(); expandMetric('1')">⬆️</button>
                            <div class="metric-detail-section">
                                <h4>Overview</h4>
                                <p>Total public sector budgets across all departments and agencies that have been mapped, digitized, and made publicly accessible through Transparency.ie platform.</p>
                            </div>
                            <div class="metric-detail-section">
                                <h4>Key Insights</h4>
                                <p>• Growth from €45B (2019) to €104B (2026) = 131% increase<br/>• Average YoY growth: €8.6B<br/>• Currently covers 93% of all government spending<br/>• Projection: €125B by 2027</p>
                            </div>
                            <div class="metric-detail-section">
                                <h4>Data Sources</h4>
                                <div class="metric-source">
                                    <div class="metric-source-title">Department of Finance</div>
                                    <a href="#" class="metric-source-link">gov.ie/finance ↗</a>
                                </div>
                                <div class="metric-source">
                                    <div class="metric-source-title">Transparency.ie DB</div>
                                    <a href="#" class="metric-source-link">data.transparency.ie ↗</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metric 2: Budget Data Points -->
                <div id="metric-2" class="metric-card reveal" onclick="expandMetric('2')">
                    <button class="metric-expand-btn" onclick="event.stopPropagation(); expandMetric('2')">⬇️</button>
                    <div class="metric-content">
                        <p class="tag">Granularity</p>
                        <h3>Budget Data Points</h3>
                        <div class="metric-number">847K</div>
                        <p class="metric-change">↑ 34% adoption</p>
                        <p class="muted">Individual line items queryable. APIs available.</p>
                    </div>
                    <div class="metric-expanded">
                        <div class="metric-chart">
                            <canvas data-chart-config='{"type":"bar","data":{"labels":["2022","2023","2024","2025","2026"],"datasets":[{"label":"Data Points (K)","data":[281,415,602,724,847],"backgroundColor":"rgba(26,26,26,0.1)","borderColor":"#1a1a1a","borderWidth":1}]},"options":{"responsive":true,"maintainAspectRatio":false}}'></canvas>
                        </div>
                        <div class="metric-details">
                            <button class="metric-expand-btn" onclick="event.stopPropagation(); expandMetric('2')">⬆️</button>
                            <div class="metric-detail-section">
                                <h4>Overview</h4>
                                <p>Granular budget line items broken down to department, function, and project level. Each data point represents a single budget allocation entry.</p>
                            </div>
                            <div class="metric-detail-section">
                                <h4>Key Insights</h4>
                                <p>• 281K (2022) → 847K (2026) = 201% growth<br/>• 34% agency adoption rate<br/>• API queries: +340% YoY<br/>• Avg citizen can track €12,286 personal tax spending</p>
                            </div>
                            <div class="metric-detail-section">
                                <h4>Data Sources</h4>
                                <div class="metric-source">
                                    <div class="metric-source-title">CSO Ireland</div>
                                    <a href="#" class="metric-source-link">cso.ie ↗</a>
                                </div>
                                <div class="metric-source">
                                    <div class="metric-source-title">API Analytics</div>
                                    <a href="#" class="metric-source-link">api.transparency.ie ↗</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metric 3: Emissions -->
                <div id="metric-3" class="metric-card reveal" onclick="expandMetric('3')">
                    <button class="metric-expand-btn" onclick="event.stopPropagation(); expandMetric('3')">⬇️</button>
                    <div class="metric-content">
                        <p class="tag">Climate</p>
                        <h3>Emissions Tracked</h3>
                        <div class="metric-number">32</div>
                        <p class="metric-change">↓ 4.2% annual</p>
                        <p class="muted">On track for 2030 carbon neutrality.</p>
                    </div>
                    <div class="metric-expanded">
                        <div class="metric-chart">
                            <canvas data-chart-config='{"type":"line","data":{"labels":["2020","2021","2022","2023","2024","2025","2026"],"datasets":[{"label":"Emissions (MtCO₂e)","data":[120,118,114,109,104,99.6,95.3],"borderColor":"#1a1a1a","backgroundColor":"rgba(26,26,26,0.05)","borderWidth":2,"fill":true,"tension":0.4}]},"options":{"responsive":true,"maintainAspectRatio":false}}'></canvas>
                        </div>
                        <div class="metric-details">
                            <button class="metric-expand-btn" onclick="event.stopPropagation(); expandMetric('3')">⬆️</button>
                            <div class="metric-detail-section">
                                <h4>Overview</h4>
                                <p>32 distinct climate metrics tracked across public sector: energy use, transport, waste, buildings, procurement, and supply chains.</p>
                            </div>
                            <div class="metric-detail-section">
                                <h4>Key Insights</h4>
                                <p>• 4.2% annual reduction = 51% by 2030<br/>• Renewable energy: 52%<br/>• Transport emissions: ↓18%<br/>• Building efficiency: +23%</p>
                            </div>
                            <div class="metric-detail-section">
                                <h4>Data Sources</h4>
                                <div class="metric-source">
                                    <div class="metric-source-title">EPA Ireland</div>
                                    <a href="#" class="metric-source-link">epa.ie ↗</a>
                                </div>
                                <div class="metric-source">
                                    <div class="metric-source-title">SEAI Energy</div>
                                    <a href="#" class="metric-source-link">seai.ie ↗</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metric 4: Renewable Mix -->
                <div id="metric-4" class="metric-card reveal" onclick="expandMetric('4')">
                    <button class="metric-expand-btn" onclick="event.stopPropagation(); expandMetric('4')">⬇️</button>
                    <div class="metric-content">
                        <p class="tag">Energy</p>
                        <h3>Renewable Mix</h3>
                        <div class="metric-number">52%</div>
                        <p class="metric-change">↑ 12% since 2020</p>
                        <p class="muted">Wind, solar, hydro dominant.</p>
                    </div>
                    <div class="metric-expanded">
                        <div class="metric-chart">
                            <canvas data-chart-config='{"type":"doughnut","data":{"labels":["Wind (28%)","Solar (15%)","Hydro (4%)","Biomass (5%)","Gas (35%)","Coal (10%)","Other (3%)"],"datasets":[{"data":[28,15,4,5,35,10,3],"backgroundColor":["#c0c0c0","#d4d4d4","#b0b0b0","#a0a0a0","#888888","#606060","#999999"]}]},"options":{"responsive":true,"maintainAspectRatio":false}}'></canvas>
                        </div>
                        <div class="metric-details">
                            <button class="metric-expand-btn" onclick="event.stopPropagation(); expandMetric('4')">⬆️</button>
                            <div class="metric-detail-section">
                                <h4>Overview</h4>
                                <p>Electricity generation from renewable sources including wind, solar, hydro, and biomass as primary clean energy.</p>
                            </div>
                            <div class="metric-detail-section">
                                <h4>Key Insights</h4>
                                <p>• 40% (2020) → 52% (2026)<br/>• Wind: 28%, fastest growing<br/>• Solar capacity doubled in 3 yrs<br/>• Target: 80% by 2030</p>
                            </div>
                            <div class="metric-detail-section">
                                <h4>Data Sources</h4>
                                <div class="metric-source">
                                    <div class="metric-source-title">EirGrid</div>
                                    <a href="#" class="metric-source-link">eirgrid.ie ↗</a>
                                </div>
                                <div class="metric-source">
                                    <div class="metric-source-title">IEA</div>
                                    <a href="#" class="metric-source-link">iea.org ↗</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metric 5: Active Campaigns -->
                <div id="metric-5" class="metric-card reveal" onclick="expandMetric('5')">
                    <button class="metric-expand-btn" onclick="event.stopPropagation(); expandMetric('5')">⬇️</button>
                    <div class="metric-content">
                        <p class="tag">Engagement</p>
                        <h3>Active Campaigns</h3>
                        <div class="metric-number">14</div>
                        <p class="metric-change">18K supporters</p>
                        <p class="muted">Citizen-led advocacy.</p>
                    </div>
                    <div class="metric-expanded">
                        <div class="metric-chart">
                            <canvas data-chart-config='{"type":"bar","data":{"labels":["Climate","Transport","Energy","Housing","Education","Water","Health","Other"],"datasets":[{"label":"Campaigns","data":[3,2,2,1,1,1,2,2],"backgroundColor":"rgba(26,26,26,0.1)","borderColor":"#1a1a1a","borderWidth":1}]},"options":{"responsive":true,"maintainAspectRatio":false}}'></canvas>
                        </div>
                        <div class="metric-details">
                            <button class="metric-expand-btn" onclick="event.stopPropagation(); expandMetric('5')">⬆️</button>
                            <div class="metric-detail-section">
                                <h4>Overview</h4>
                                <p>Active civic campaigns focused on policy change and accountability action across all sectors.</p>
                            </div>
                            <div class="metric-detail-section">
                                <h4>Key Insights</h4>
                                <p>• 14 active campaigns, 8 sectors<br/>• 18K active supporters<br/>• Avg duration: 18 months<br/>• Success rate: 42% policy change</p>
                            </div>
                            <div class="metric-detail-section">
                                <h4>Data Sources</h4>
                                <div class="metric-source">
                                    <div class="metric-source-title">Campaigns DB</div>
                                    <a href="#" class="metric-source-link">transparency.ie/campaigns ↗</a>
                                </div>
                                <div class="metric-source">
                                    <div class="metric-source-title">Analytics</div>
                                    <a href="#" class="metric-source-link">analytics.transparency.ie ↗</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metric 6: Community -->
                <div id="metric-6" class="metric-card reveal" onclick="expandMetric('6')">
                    <button class="metric-expand-btn" onclick="event.stopPropagation(); expandMetric('6')">⬇️</button>
                    <div class="metric-content">
                        <p class="tag">Community</p>
                        <h3>Members</h3>
                        <div class="metric-number">67K+</div>
                        <p class="metric-change">↑ 47% YoY</p>
                        <p class="muted">Active engaged users.</p>
                    </div>
                    <div class="metric-expanded">
                        <div class="metric-chart">
                            <canvas data-chart-config='{"type":"line","data":{"labels":["Q1 2024","Q2 2024","Q3 2024","Q4 2024","Q1 2025","Q2 2025","Q3 2025","Q1 2026"],"datasets":[{"label":"Members","data":[28000,36000,45000,55000,62000,67000,71000,75000],"borderColor":"#1a1a1a","backgroundColor":"rgba(26,26,26,0.05)","borderWidth":2,"fill":true,"tension":0.4}]},"options":{"responsive":true,"maintainAspectRatio":false}}'></canvas>
                        </div>
                        <div class="metric-details">
                            <button class="metric-expand-btn" onclick="event.stopPropagation(); expandMetric('6')">⬆️</button>
                            <div class="metric-detail-section">
                                <h4>Overview</h4>
                                <p>Total registered users actively engaged with platform data, campaigns, events, and policy discussions in past 30 days.</p>
                            </div>
                            <div class="metric-detail-section">
                                <h4>Key Insights</h4>
                                <p>• 28K (Q1 2024) → 67K (Q1 2026)<br/>• Monthly active: 48K<br/>• Engagement: 3.2x/week per user<br/>• Retention: 68%</p>
                            </div>
                            <div class="metric-detail-section">
                                <h4>Data Sources</h4>
                                <div class="metric-source">
                                    <div class="metric-source-title">User Analytics</div>
                                    <a href="#" class="metric-source-link">analytics.transparency.ie ↗</a>
                                </div>
                                <div class="metric-source">
                                    <div class="metric-source-title">Platform Metrics</div>
                                    <a href="#" class="metric-source-link">transparency.ie/metrics ↗</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metric 7: Storage Pilots -->
                <div id="metric-7" class="metric-card reveal" onclick="expandMetric('7')">
                    <button class="metric-expand-btn" onclick="event.stopPropagation(); expandMetric('7')">⬇️</button>
                    <div class="metric-content">
                        <p class="tag">Innovation</p>
                        <h3>Storage Pilots</h3>
                        <div class="metric-number">8</div>
                        <p class="metric-change">€34M invested</p>
                        <p class="muted">Operational systems.</p>
                    </div>
                    <div class="metric-expanded">
                        <div class="metric-chart">
                            <canvas data-chart-config='{"type":"bar","data":{"labels":["Limerick","Cork","Waterford","Dublin","Galway","Sligo"],"datasets":[{"label":"Investment (€M)","data":[8,6.5,4.2,3.8,3.5,2.4],"backgroundColor":"rgba(26,26,26,0.1)","borderColor":"#1a1a1a","borderWidth":1}]},"options":{"responsive":true,"maintainAspectRatio":false}}'></canvas>
                        </div>
                        <div class="metric-details">
                            <button class="metric-expand-btn" onclick="event.stopPropagation(); expandMetric('7')">⬆️</button>
                            <div class="metric-detail-section">
                                <h4>Overview</h4>
                                <p>Active energy storage pilot projects with total public sector investment deployed across Ireland.</p>
                            </div>
                            <div class="metric-detail-section">
                                <h4>Key Insights</h4>
                                <p>• €34M across 8 sites<br/>• 150 MWh capacity<br/>• Limerick hub leads: 8 MW<br/>• 92% uptime, 87% efficiency</p>
                            </div>
                            <div class="metric-detail-section">
                                <h4>Data Sources</h4>
                                <div class="metric-source">
                                    <div class="metric-source-title">SEAI Pilots</div>
                                    <a href="#" class="metric-source-link">seai.ie ↗</a>
                                </div>
                                <div class="metric-source">
                                    <div class="metric-source-title">Projects</div>
                                    <a href="#" class="metric-source-link">transparency.ie/tech ↗</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metric 8: Grid Innovation -->
                <div id="metric-8" class="metric-card reveal" onclick="expandMetric('8')">
                    <button class="metric-expand-btn" onclick="event.stopPropagation(); expandMetric('8')">⬇️</button>
                    <div class="metric-content">
                        <p class="tag">Technology</p>
                        <h3>Grid Projects</h3>
                        <div class="metric-number">23</div>
                        <p class="metric-change">↑ 6 this year</p>
                        <p class="muted">Smart & microgrids.</p>
                    </div>
                    <div class="metric-expanded">
                        <div class="metric-chart">
                            <canvas data-chart-config='{"type":"line","data":{"labels":["2022","2023","2024","2025","2026"],"datasets":[{"label":"Projects","data":[6,11,17,20,23],"borderColor":"#1a1a1a","backgroundColor":"rgba(26,26,26,0.05)","borderWidth":2,"fill":true,"tension":0.4}]},"options":{"responsive":true,"maintainAspectRatio":false}}'></canvas>
                        </div>
                        <div class="metric-details">
                            <button class="metric-expand-btn" onclick="event.stopPropagation(); expandMetric('8')">⬆️</button>
                            <div class="metric-detail-section">
                                <h4>Overview</h4>
                                <p>Active grid innovation research and pilot projects including smart meters, demand response, and microgrids.</p>
                            </div>
                            <div class="metric-detail-section">
                                <h4>Key Insights</h4>
                                <p>• 6 (2022) → 23 (2026)<br/>• €82M investment<br/>• 600K smart meters<br/>• 78% success rate</p>
                            </div>
                            <div class="metric-detail-section">
                                <h4>Data Sources</h4>
                                <div class="metric-source">
                                    <div class="metric-source-title">SEAI</div>
                                    <a href="#" class="metric-source-link">seai.ie ↗</a>
                                </div>
                                <div class="metric-source">
                                    <div class="metric-source-title">Registry</div>
                                    <a href="#" class="metric-source-link">transparency.ie/grid ↗</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metric 9: Events -->
                <div id="metric-9" class="metric-card reveal" onclick="expandMetric('9')">
                    <button class="metric-expand-btn" onclick="event.stopPropagation(); expandMetric('9')">⬇️</button>
                    <div class="metric-content">
                        <p class="tag">Outreach</p>
                        <h3>Events</h3>
                        <div class="metric-number">12</div>
                        <p class="metric-change">2.4K people</p>
                        <p class="muted">Data literacy programs.</p>
                    </div>
                    <div class="metric-expanded">
                        <div class="metric-chart">
                            <canvas data-chart-config='{"type":"bar","data":{"labels":["Hackathons","Webinars","Workshops","Conferences","Town Halls","Meetups"],"datasets":[{"label":"Events","data":[3,2,3,1,2,1],"backgroundColor":"rgba(26,26,26,0.1)","borderColor":"#1a1a1a","borderWidth":1}]},"options":{"responsive":true,"maintainAspectRatio":false}}'></canvas>
                        </div>
                        <div class="metric-details">
                            <button class="metric-expand-btn" onclick="event.stopPropagation(); expandMetric('9')">⬆️</button>
                            <div class="metric-detail-section">
                                <h4>Overview</h4>
                                <p>Public engagement events including hackathons, workshops, webinars, and conferences fostering civic data literacy.</p>
                            </div>
                            <div class="metric-detail-section">
                                <h4>Key Insights</h4>
                                <p>• 12 events, 2.4K participants<br/>• 800 developers (hackathons)<br/>• 94% workshop completion<br/>• 92% satisfaction</p>
                            </div>
                            <div class="metric-detail-section">
                                <h4>Data Sources</h4>
                                <div class="metric-source">
                                    <div class="metric-source-title">Events</div>
                                    <a href="#" class="metric-source-link">transparency.ie/events ↗</a>
                                </div>
                                <div class="metric-source">
                                    <div class="metric-source-title">Engagement</div>
                                    <a href="#" class="metric-source-link">analytics.transparency.ie ↗</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
