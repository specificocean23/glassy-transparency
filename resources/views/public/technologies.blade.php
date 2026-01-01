<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Technologies | {{ config('app.name', 'Transparency.ie') }}</title>
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
        .technologies { grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); }

        .muted { color: var(--subtle); font-size: 14px; line-height: 1.6; }
        h1, h2, h3 { margin: 0; letter-spacing: -0.5px; }
        h2 { font-size: 36px; font-weight: 800; line-height: 1.2; margin-bottom: 16px; }
        h3 { font-size: 20px; font-weight: 700; margin: 12px 0 8px 0; }
        .tag { font-size: 11px; text-transform: uppercase; letter-spacing: 0.15em; color: var(--subtle); font-weight: 600; }

        .tech-card {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 32px;
            background: var(--card);
            transition: all 200ms ease;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .tech-card:hover {
            border-color: var(--ink);
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
        }
        .tech-specs {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 12px;
            padding: 16px 0;
        }
        .tech-spec {
            padding: 12px;
            background: var(--bg);
            border-radius: 6px;
            border: 1px solid var(--border);
        }
        .tech-spec-label { font-size: 11px; text-transform: uppercase; letter-spacing: 0.1em; color: var(--subtle); font-weight: 600; margin-bottom: 4px; }
        .tech-spec-value { font-size: 16px; font-weight: 700; color: var(--ink); }
        .tech-details { padding: 16px; background: var(--bg); border-radius: 6px; border: 1px solid var(--border); }
        .tech-details p { margin: 6px 0; font-size: 13px; line-height: 1.5; }

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
        @include('components.navigation')

        <div class="wrap">

            <section class="panel reveal">
                <p class="tag" style="margin-bottom: 12px;">Energy Innovation</p>
                <h2>Technologies</h2>
                <p class="muted" style="font-size: 16px; max-width: 680px; line-height: 1.7;">Compare energy storage, grid innovation, and climate solutions being tested in Ireland. Real specs, deployment status, and community impact data.</p>
            </section>

            <section class="grid technologies reveal">
                <div class="tech-card reveal">
                    <div class="tag">Battery Storage</div>
                    <h3>Lithium-Ion Systems</h3>
                    <p class="muted">Grid-scale and distributed battery storage. Fast response, proven chemistry, dominant technology today.</p>
                    <div class="tech-specs">
                        <div class="tech-spec">
                            <div class="tech-spec-label">Cost/kWh</div>
                            <div class="tech-spec-value">€200–280</div>
                        </div>
                        <div class="tech-spec">
                            <div class="tech-spec-label">Lifespan</div>
                            <div class="tech-spec-value">10–15 years</div>
                        </div>
                        <div class="tech-spec">
                            <div class="tech-spec-label">Efficiency</div>
                            <div class="tech-spec-value">85–95%</div>
                        </div>
                    </div>
                    <div class="tech-details">
                        <p><strong>Advantages:</strong> Rapid response, scalable from kW to MW, proven supply chains, modular design.</p>
                        <p><strong>Challenges:</strong> Thermal management, recycling infrastructure, cost reduction slower than expected.</p>
                        <p><strong>Ireland:</strong> Operational at Limerick Energy Hub, Cork pilot in Phase 2. 40 MWh deployed nationally.</p>
                    </div>
                </div>

                <div class="tech-card reveal">
                    <div class="tag">Long-Duration Storage</div>
                    <h3>Flow Battery Systems</h3>
                    <p class="muted">Vanadium and other chemistries. Decouple power and duration, ideal for 4–12 hour storage windows.</p>
                    <div class="tech-specs">
                        <div class="tech-spec">
                            <div class="tech-spec-label">Cost/kWh</div>
                            <div class="tech-spec-value">€150–220</div>
                        </div>
                        <div class="tech-spec">
                            <div class="tech-spec-label">Lifespan</div>
                            <div class="tech-spec-value">20+ years</div>
                        </div>
                        <div class="tech-spec">
                            <div class="tech-spec-label">Efficiency</div>
                            <div class="tech-spec-value">70–80%</div>
                        </div>
                    </div>
                    <div class="tech-details">
                        <p><strong>Advantages:</strong> Independent scaling of power/duration, longer lifespan, no degradation.</p>
                        <p><strong>Challenges:</strong> Lower round-trip efficiency, larger footprint, developing supply chain.</p>
                        <p><strong>Ireland:</strong> Pilot at Waterford Engineering Hub (2 MWh). Testing vanadium redox for seasonal storage.</p>
                    </div>
                </div>

                <div class="tech-card reveal">
                    <div class="tag">Gravity Storage</div>
                    <h3>Mechanical Gravity Systems</h3>
                    <p class="muted">Lower cost for 6+ hour windows. Uses height potential to store energy, minimal degradation.</p>
                    <div class="tech-specs">
                        <div class="tech-spec">
                            <div class="tech-spec-label">Cost/kWh</div>
                            <div class="tech-spec-value">€50–120</div>
                        </div>
                        <div class="tech-spec">
                            <div class="tech-spec-label">Lifespan</div>
                            <div class="tech-spec-value">30–50 years</div>
                        </div>
                        <div class="tech-spec">
                            <div class="tech-spec-label">Efficiency</div>
                            <div class="tech-spec-value">75–85%</div>
                        </div>
                    </div>
                    <div class="tech-details">
                        <p><strong>Advantages:</strong> Extremely long lifespan, proven mechanical principles, minimal materials recycling needed.</p>
                        <p><strong>Challenges:</strong> Site-dependent (elevation), high capex, long commissioning times.</p>
                        <p><strong>Ireland:</strong> Feasibility studies for Irish hillsides. Cork proposal advanced to Phase 2 design.</p>
                    </div>
                </div>

                <div class="tech-card reveal">
                    <div class="tag">Grid Innovation</div>
                    <h3>Smart Meters & Demand Response</h3>
                    <p class="muted">Real-time consumption visibility and dynamic pricing. Shift demand peaks, reduce overall system stress.</p>
                    <div class="tech-specs">
                        <div class="tech-spec">
                            <div class="tech-spec-label">Rollout</div>
                            <div class="tech-spec-value">31% coverage</div>
                        </div>
                        <div class="tech-spec">
                            <div class="tech-spec-label">Response Time</div>
                            <div class="tech-spec-value">15–60 mins</div>
                        </div>
                        <div class="tech-spec">
                            <div class="tech-spec-label">Demand Shift</div>
                            <div class="tech-spec-value">8–15%</div>
                        </div>
                    </div>
                    <div class="tech-details">
                        <p><strong>Advantages:</strong> Low cost per household, immediate impact on peak demand, behavioral engagement.</p>
                        <p><strong>Challenges:</strong> Privacy concerns, behavior change fatigue, equity for low-income households.</p>
                        <p><strong>Ireland:</strong> 600K meters deployed. Dublin pilot shows 12% peak reduction. National rollout by 2026.</p>
                    </div>
                </div>

                <div class="tech-card reveal">
                    <div class="tag">Renewable Integration</div>
                    <h3>Hybrid Wind-Solar Farms</h3>
                    <p class="muted">Co-locate wind and solar on same grid connection. Smooth supply curve, reduce curtailment losses.</p>
                    <div class="tech-specs">
                        <div class="tech-spec">
                            <div class="tech-spec-label">Capacity Factor</div>
                            <div class="tech-spec-value">45–52%</div>
                        </div>
                        <div class="tech-spec">
                            <div class="tech-spec-label">Grid Stability</div>
                            <div class="tech-spec-value">+24%</div>
                        </div>
                        <div class="tech-spec">
                            <div class="tech-spec-label">Cost/MW</div>
                            <div class="tech-spec-value">€1.8–2.1M</div>
                        </div>
                    </div>
                    <div class="tech-details">
                        <p><strong>Advantages:</strong> Better land use, smoother generation, reduced curtailment, lower connection costs.</p>
                        <p><strong>Challenges:</strong> Complex permitting, transmission constraints, ecosystem impact assessment.</p>
                        <p><strong>Ireland:</strong> 5 hybrid projects in development. Galway West (80 MW wind + 40 MW solar) to begin 2025.</p>
                    </div>
                </div>

                <div class="tech-card reveal">
                    <div class="tag">Emerging Tech</div>
                    <h3>Green Hydrogen Production</h3>
                    <p class="muted">Electrolysis powered by renewables. Hard-to-abate sectors, seasonal storage, industry feedstock.</p>
                    <div class="tech-specs">
                        <div class="tech-spec">
                            <div class="tech-spec-label">Cost/kg H₂</div>
                            <div class="tech-spec-value">€4–6</div>
                        </div>
                        <div class="tech-spec">
                            <div class="tech-spec-label">Efficiency</div>
                            <div class="tech-spec-value">60–75%</div>
                        </div>
                        <div class="tech-spec">
                            <div class="tech-spec-label">Scale</div>
                            <div class="tech-spec-value">Emerging</div>
                        </div>
                    </div>
                    <div class="tech-details">
                        <p><strong>Advantages:</strong> Scalable, zero-carbon, usable for transport and industry, existing distribution networks.</p>
                        <p><strong>Challenges:</strong> Still expensive vs. grey hydrogen, water intensive, electrolyzer supply constraints.</p>
                        <p><strong>Ireland:</strong> €12M pilot at Shannon. Support for 10 projects. National hydrogen roadmap to 2030.</p>
                    </div>
                </div>
            </section>
        </div>

        @include('components.footer-alt-1')
    </div>
</body>
</html>
