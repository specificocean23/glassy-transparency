<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Campaigns | {{ config('app.name', 'Transparency.ie') }}</title>
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
        .campaigns { grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); }

        .muted { color: var(--subtle); font-size: 14px; line-height: 1.6; }
        h1, h2, h3 { margin: 0; letter-spacing: -0.5px; }
        h2 { font-size: 36px; font-weight: 800; line-height: 1.2; margin-bottom: 16px; }
        h3 { font-size: 20px; font-weight: 700; margin: 12px 0 8px 0; }
        .tag { font-size: 11px; text-transform: uppercase; letter-spacing: 0.15em; color: var(--subtle); font-weight: 600; }

        .campaign-card {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 32px;
            background: var(--card);
            transition: all 200ms ease;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .campaign-card:hover {
            border-color: var(--ink);
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
        }
        .campaign-progress {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 8px 0;
        }
        .progress-bar {
            flex: 1;
            height: 6px;
            background: var(--border);
            border-radius: 3px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            background: var(--ink);
            border-radius: 3px;
        }
        .progress-pct { font-size: 12px; font-weight: 600; color: var(--subtle); min-width: 40px; }
        .campaign-card a {
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
        @include('components.navigation')

        <div class="wrap">
                    <a class="chip" href="/metrics">Metrics</a>
                    <button type="button" class="chip" onclick="toggleTheme()">☀️/🌙</button>
                </nav>
            </header>

            <section class="panel reveal">
                <p class="tag" style="margin-bottom: 12px;">Civic Action</p>
                <h2>Campaigns</h2>
                <p class="muted" style="font-size: 16px; max-width: 680px; line-height: 1.7;">Join active campaigns, support policy change, and mobilize communities. Track progress, see impact, and make your voice heard.</p>
            </section>

            <section class="grid campaigns reveal">
                <div class="campaign-card reveal">
                @include('components.navigation')

                    <p class="tag">Active</p>
                    <h3>National Emissions Reduction Target</h3>
                    <p class="muted">Push for 2030 carbon neutrality across public sector. Track legislative progress, join advocacy, and see real-time impact.</p>
                    <div class="campaign-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 68%;"></div>
                        </div>
                        <div class="progress-pct">68%</div>
                    </div>
                    <p class="muted" style="font-size: 12px;">2,847 supporters</p>
                    <a href="#campaign-1">Join now →</a>
                </div>

                <div class="campaign-card reveal">
                    <p class="tag">Active</p>
                    <h3>Right to Energy Affordability</h3>
                    <p class="muted">Ensure no household pays more than 5% of income for heating, power, and water. Community-led advocacy and government negotiations.</p>
                    <div class="campaign-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 45%;"></div>
                        </div>
                        <div class="progress-pct">45%</div>
                    </div>
                    <p class="muted" style="font-size: 12px;">1,523 supporters</p>
                    <a href="#campaign-2">Join now →</a>
                </div>

                <div class="campaign-card reveal">
                    <p class="tag">Active</p>
                    <h3>Youth Climate Leadership Fund</h3>
                    <p class="muted">Allocate €50M to youth-led climate projects. Vote on fund priorities, mentor young innovators, drive systemic change.</p>
                    <div class="campaign-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 81%;"></div>
                        </div>
                        <div class="progress-pct">81%</div>
                    </div>
                    <p class="muted" style="font-size: 12px;">4,921 supporters</p>
                    <a href="#campaign-3">Join now →</a>
                </div>

                <div class="campaign-card reveal">
                    <p class="tag">Active</p>
                    <h3>Public Transport Equity Initiative</h3>
                    <p class="muted">Ensure affordable, accessible transit for rural and urban communities. Track budget allocation and service coverage data in real time.</p>
                    <div class="campaign-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 56%;"></div>
                        </div>
                        <div class="progress-pct">56%</div>
                    </div>
                    <p class="muted" style="font-size: 12px;">3,102 supporters</p>
                    <a href="#campaign-4">Join now →</a>
                </div>

                <div class="campaign-card reveal">
                    <p class="tag">Active</p>
                    <h3>Community Solar Cooperative Network</h3>
                    <p class="muted">Decentralize renewable energy through local co-ops. Share tech roadmaps, funding updates, and join pilot projects.</p>
                    <div class="campaign-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 72%;"></div>
                        </div>
                        <div class="progress-pct">72%</div>
                    </div>
                    <p class="muted" style="font-size: 12px;">2,456 supporters</p>
                    <a href="#campaign-5">Join now →</a>
                </div>

                <div class="campaign-card reveal">
                    <p class="tag">Active</p>
                    <h3>Open Budget Mandate for All Councils</h3>
                    <p class="muted">Require every local authority to publish real-time spending. Standardized data, citizen dashboards, democratic accountability.</p>
                    <div class="campaign-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 89%;"></div>
                        </div>
                        <div class="progress-pct">89%</div>
                    </div>
                    <p class="muted" style="font-size: 12px;">5,634 supporters</p>
                    <a href="#campaign-6">Join now →</a>
                </div>
            </section>
        </div>

        @include('components.footer-alt-1')
    </div>
</body>
</html>
