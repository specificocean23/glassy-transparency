<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Transparency.ie') }} - Ireland's Public Ledger</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
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
        .ghost { border: 1px solid var(--border); background: transparent; }
        .ghost:hover { background: var(--card); }

        .panel {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 40px;
            box-shadow: var(--shadow);
            backdrop-filter: var(--blur);
        }
        .grid { display: grid; gap: 24px; }
        .hero { grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); }
        .pillars { grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); }
        .routes { grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); }

        .muted { color: var(--subtle); font-size: 14px; line-height: 1.6; }
        h1, h2, h3, h4 { margin: 0; letter-spacing: -0.5px; }
        h2 { font-size: 36px; font-weight: 800; line-height: 1.2; margin-bottom: 16px; }
        h3 { font-size: 22px; font-weight: 700; margin-bottom: 12px; }
        h4 { font-size: 18px; font-weight: 700; margin-bottom: 8px; }
        .tag { font-size: 11px; text-transform: uppercase; letter-spacing: 0.15em; color: var(--subtle); font-weight: 600; }

        .stat { border: 1px solid var(--border); border-radius: 8px; padding: 20px; background: var(--card); }
        .stat-number { font-size: 28px; font-weight: 800; color: var(--ink); margin: 8px 0; }
        .stat-label { font-size: 12px; text-transform: uppercase; letter-spacing: 0.1em; color: var(--subtle); }

        .pill-card { 
            border: 1px solid var(--border); 
            border-radius: 12px; 
            padding: 32px; 
            background: var(--card); 
            transition: all 200ms ease;
            min-height: 280px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .pill-card:hover { border-color: var(--ink); transform: translateY(-2px); box-shadow: 0 12px 30px rgba(0,0,0,0.12); }
        .pill-icon { font-size: 32px; margin-bottom: 4px; }
        .pill-card a { margin-top: auto; color: var(--ink); font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; gap: 6px; }
        .pill-card a:hover { opacity: 0.7; }

        .route-card { 
            border: 1px solid var(--border); 
            border-radius: 12px; 
            padding: 28px; 
            background: var(--card); 
            transition: all 200ms ease;
        }
        .route-card:hover { border-color: var(--ink); transform: translateY(-2px); box-shadow: 0 12px 30px rgba(0,0,0,0.12); }
        .route-card h4 { margin-top: 12px; }

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
    </style>
</head>
<body>
    @include('components.nav-professional')

    <main style="margin-top: 0;">
        <!-- Hero Section -->
        <section style="background: linear-gradient(135deg, var(--panel) 0%, var(--card) 100%); padding: 80px 32px; text-align: center; border-bottom: 1px solid var(--border); position: relative; overflow: hidden;">
            <div style="position: absolute; top: -50%; right: -20%; width: 600px; height: 600px; border-radius: 50%; background: radial-gradient(circle, var(--card) 0%, transparent 70%); opacity: 0.3; z-index: 0;"></div>
            <div style="position: relative; z-index: 1; max-width: 800px; margin: 0 auto;">
                <h1 style="font-size: clamp(32px, 8vw, 52px); font-weight: 900; letter-spacing: -1.5px; margin: 0 0 20px 0; line-height: 1.1;">Ireland's Public Ledger</h1>
                <p style="font-size: 18px; color: var(--subtle); margin: 0; line-height: 1.7;">Real-time transparency into government budgets, council spending, environmental initiatives, and civic engagement across Ireland.</p>
            </div>
        </section>

        <!-- Statistics Section -->
        <section style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; padding: 60px 32px; max-width: 1400px; margin: 0 auto; background: var(--bg);">
            <div style="background: var(--panel); border: 1px solid var(--border); border-radius: 12px; padding: 24px; text-align: center; transition: all 300ms ease; transform: translateY(0); opacity: 0; animation: revealStat 600ms ease forwards; animation-delay: 100ms;">
                <div style="font-size: 32px; font-weight: 900; margin-bottom: 8px;">€104B</div>
                <div style="font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: var(--subtle);">Public Budget Tracked</div>
            </div>
            <div style="background: var(--panel); border: 1px solid var(--border); border-radius: 12px; padding: 24px; text-align: center; transition: all 300ms ease; transform: translateY(0); opacity: 0; animation: revealStat 600ms ease forwards; animation-delay: 200ms;">
                <div style="font-size: 32px; font-weight: 900; margin-bottom: 8px;">32</div>
                <div style="font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: var(--subtle);">Active Metrics</div>
            </div>
            <div style="background: var(--panel); border: 1px solid var(--border); border-radius: 12px; padding: 24px; text-align: center; transition: all 300ms ease; transform: translateY(0); opacity: 0; animation: revealStat 600ms ease forwards; animation-delay: 300ms;">
                <div style="font-size: 32px; font-weight: 900; margin-bottom: 8px;">14</div>
                <div style="font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: var(--subtle);">Active Campaigns</div>
            </div>
            <div style="background: var(--panel); border: 1px solid var(--border); border-radius: 12px; padding: 24px; text-align: center; transition: all 300ms ease; transform: translateY(0); opacity: 0; animation: revealStat 600ms ease forwards; animation-delay: 400ms;">
                <div style="font-size: 32px; font-weight: 900; margin-bottom: 8px;">100%</div>
                <div style="font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: var(--subtle);">Open Source</div>
            </div>
            <style>
                @keyframes revealStat {
                    from {
                        opacity: 0;
                        transform: translateY(20px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
            </style>
        </section>

        <!-- Pillars Section -->
        <section style="padding: 80px 32px; background: var(--panel); border-bottom: 1px solid var(--border);">
            <div style="text-align: center; margin-bottom: 60px; max-width: 600px; margin-left: auto; margin-right: auto;">
                <h2 style="font-size: 36px; font-weight: 800; letter-spacing: -0.5px; margin: 0 0 12px 0;">Core Pillars</h2>
                <p style="font-size: 16px; color: var(--subtle); margin: 0; line-height: 1.6;">Four foundational platforms driving transparency and civic engagement across Ireland.</p>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 32px; max-width: 1400px; margin: 0 auto;">
                <a href="/metrics" style="background: var(--bg); border: 1px solid var(--border); border-radius: 12px; padding: 32px; text-decoration: none; color: inherit; transition: all 300ms ease; opacity: 0; animation: revealCard 600ms ease forwards; animation-delay: 100ms;" onmouseover="this.style.borderColor='var(--ink)'; this.style.boxShadow='var(--shadow)'; this.style.transform='translateY(-6px)';" onmouseout="this.style.borderColor='var(--border)'; this.style.boxShadow='none'; this.style.transform='translateY(0)';">
                    <span style="font-size: 48px; margin-bottom: 16px; display: block;">💰</span>
                    <h3 style="font-size: 20px; font-weight: 700; margin: 0 0 12px 0;">Transparency Engine</h3>
                    <p style="font-size: 14px; color: var(--subtle); margin: 0; line-height: 1.6;">Real-time budget tracking, spending analysis, and financial transparency for all public institutions.</p>
                </a>
                <a href="/metrics" style="background: var(--bg); border: 1px solid var(--border); border-radius: 12px; padding: 32px; text-decoration: none; color: inherit; transition: all 300ms ease; opacity: 0; animation: revealCard 600ms ease forwards; animation-delay: 200ms;" onmouseover="this.style.borderColor='var(--ink)'; this.style.boxShadow='var(--shadow)'; this.style.transform='translateY(-6px)';" onmouseout="this.style.borderColor='var(--border)'; this.style.boxShadow='none'; this.style.transform='translateY(0)';">
                    <span style="font-size: 48px; margin-bottom: 16px; display: block;">🌍</span>
                    <h3 style="font-size: 20px; font-weight: 700; margin: 0 0 12px 0;">Environmental Atlas</h3>
                    <p style="font-size: 14px; color: var(--subtle); margin: 0; line-height: 1.6;">Monitor climate initiatives, sustainability metrics, and environmental policy implementation.</p>
                </a>
                <a href="/waterford-spending" style="background: var(--bg); border: 1px solid var(--border); border-radius: 12px; padding: 32px; text-decoration: none; color: inherit; transition: all 300ms ease; opacity: 0; animation: revealCard 600ms ease forwards; animation-delay: 300ms;" onmouseover="this.style.borderColor='var(--ink)'; this.style.boxShadow='var(--shadow)'; this.style.transform='translateY(-6px)';" onmouseout="this.style.borderColor='var(--border)'; this.style.boxShadow='none'; this.style.transform='translateY(0)';">
                    <span style="font-size: 48px; margin-bottom: 16px; display: block;">🏛️</span>
                    <h3 style="font-size: 20px; font-weight: 700; margin: 0 0 12px 0;">Waterford Council</h3>
                    <p style="font-size: 14px; color: var(--subtle); margin: 0; line-height: 1.6;">Detailed spending breakdown, departmental budgets, and council initiatives in Waterford.</p>
                </a>
                <a href="/technologies" style="background: var(--bg); border: 1px solid var(--border); border-radius: 12px; padding: 32px; text-decoration: none; color: inherit; transition: all 300ms ease; opacity: 0; animation: revealCard 600ms ease forwards; animation-delay: 400ms;" onmouseover="this.style.borderColor='var(--ink)'; this.style.boxShadow='var(--shadow)'; this.style.transform='translateY(-6px)';" onmouseout="this.style.borderColor='var(--border)'; this.style.boxShadow='none'; this.style.transform='translateY(0)';">
                    <span style="font-size: 48px; margin-bottom: 16px; display: block;">💡</span>
                    <h3 style="font-size: 20px; font-weight: 700; margin: 0 0 12px 0;">Innovation Lab</h3>
                    <p style="font-size: 14px; color: var(--subtle); margin: 0; line-height: 1.6;">Emerging technologies, civic tech experiments, and governance innovation trials.</p>
                </a>
            </div>
            <style>
                @keyframes revealCard {
                    from {
                        opacity: 0;
                        transform: translateY(24px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
            </style>
        </section>

        <!-- Routes Section -->
        <section style="padding: 80px 32px; background: var(--bg); border-bottom: 1px solid var(--border);">
            <div style="text-align: center; margin-bottom: 60px; max-width: 600px; margin-left: auto; margin-right: auto;">
                <h2 style="font-size: 36px; font-weight: 800; letter-spacing: -0.5px; margin: 0 0 12px 0;">Explore Further</h2>
                <p style="font-size: 16px; color: var(--subtle); margin: 0; line-height: 1.6;">Dive deeper into specific areas of interest and engagement.</p>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; max-width: 1400px; margin: 0 auto;">
                <a href="/technologies" style="background: var(--panel); border: 1px solid var(--border); border-radius: 10px; padding: 24px; text-decoration: none; color: inherit; transition: all 250ms ease; opacity: 0; animation: revealRoute 600ms ease forwards; animation-delay: 100ms;" onmouseover="this.style.borderColor='var(--ink)'; this.style.backgroundColor='var(--card)'; this.style.boxShadow='var(--shadow)'; this.style.transform='translateY(-4px)';" onmouseout="this.style.borderColor='var(--border)'; this.style.backgroundColor='var(--panel)'; this.style.boxShadow='none'; this.style.transform='translateY(0)';">
                    <span style="font-size: 32px; margin-bottom: 12px; display: block;">🛠️</span>
                    <h4 style="font-size: 16px; font-weight: 700; margin: 0 0 8px 0;">Technologies</h4>
                    <p style="font-size: 13px; color: var(--subtle); margin: 0;">Explore the tech stack powering transparency initiatives.</p>
                </a>
                <a href="/events" style="background: var(--panel); border: 1px solid var(--border); border-radius: 10px; padding: 24px; text-decoration: none; color: inherit; transition: all 250ms ease; opacity: 0; animation: revealRoute 600ms ease forwards; animation-delay: 200ms;" onmouseover="this.style.borderColor='var(--ink)'; this.style.backgroundColor='var(--card)'; this.style.boxShadow='var(--shadow)'; this.style.transform='translateY(-4px)';" onmouseout="this.style.borderColor='var(--border)'; this.style.backgroundColor='var(--panel)'; this.style.boxShadow='none'; this.style.transform='translateY(0)';">
                    <span style="font-size: 32px; margin-bottom: 12px; display: block;">🎯</span>
                    <h4 style="font-size: 16px; font-weight: 700; margin: 0 0 8px 0;">Events</h4>
                    <p style="font-size: 13px; color: var(--subtle); margin: 0;">Upcoming webinars, workshops, and community engagement events.</p>
                </a>
                <a href="/case-studies" style="background: var(--panel); border: 1px solid var(--border); border-radius: 10px; padding: 24px; text-decoration: none; color: inherit; transition: all 250ms ease; opacity: 0; animation: revealRoute 600ms ease forwards; animation-delay: 300ms;" onmouseover="this.style.borderColor='var(--ink)'; this.style.backgroundColor='var(--card)'; this.style.boxShadow='var(--shadow)'; this.style.transform='translateY(-4px)';" onmouseout="this.style.borderColor='var(--border)'; this.style.backgroundColor='var(--panel)'; this.style.boxShadow='none'; this.style.transform='translateY(0)';">
                    <span style="font-size: 32px; margin-bottom: 12px; display: block;">📚</span>
                    <h4 style="font-size: 16px; font-weight: 700; margin: 0 0 8px 0;">Case Studies</h4>
                    <p style="font-size: 13px; color: var(--subtle); margin: 0;">Real-world examples of transparency in action.</p>
                </a>
                <a href="/dashboard" style="background: var(--panel); border: 1px solid var(--border); border-radius: 10px; padding: 24px; text-decoration: none; color: inherit; transition: all 250ms ease; opacity: 0; animation: revealRoute 600ms ease forwards; animation-delay: 400ms;" onmouseover="this.style.borderColor='var(--ink)'; this.style.backgroundColor='var(--card)'; this.style.boxShadow='var(--shadow)'; this.style.transform='translateY(-4px)';" onmouseout="this.style.borderColor='var(--border)'; this.style.backgroundColor='var(--panel)'; this.style.boxShadow='none'; this.style.transform='translateY(0)';">
                    <span style="font-size: 32px; margin-bottom: 12px; display: block;">📊</span>
                    <h4 style="font-size: 16px; font-weight: 700; margin: 0 0 8px 0;">Dashboard</h4>
                    <p style="font-size: 13px; color: var(--subtle); margin: 0;">Personalized analytics and custom data views.</p>
                </a>
            </div>
            <style>
                @keyframes revealRoute {
                    from {
                        opacity: 0;
                        transform: translateY(20px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
            </style>
        </section>

        <!-- CTA Section -->
        <section style="padding: 80px 32px; text-align: center; background: linear-gradient(135deg, var(--card) 0%, var(--panel) 100%); border-top: 1px solid var(--border);">
            <div style="max-width: 700px; margin: 0 auto;">
                <h2 style="font-size: 36px; font-weight: 800; margin: 0 0 16px 0; letter-spacing: -0.5px;">Join the Transparency Movement</h2>
                <p style="font-size: 16px; color: var(--subtle); margin: 0 0 32px 0; line-height: 1.6;">Be part of Ireland's commitment to open government and civic engagement. Start exploring data, contribute insights, or build with our APIs.</p>
                <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                    <a href="/dashboard" style="padding: 12px 28px; border-radius: 8px; font-weight: 700; font-size: 14px; text-decoration: none; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; background: var(--ink); color: var(--panel); border: 2px solid var(--ink); transition: all 200ms ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">Access Dashboard</a>
                    <a href="/waterford-spending" style="padding: 12px 28px; border-radius: 8px; font-weight: 700; font-size: 14px; text-decoration: none; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; background: transparent; color: var(--ink); border: 2px solid var(--ink); transition: all 200ms ease; cursor: pointer;" onmouseover="this.style.backgroundColor='var(--card)'; this.style.transform='translateY(-2px)';" onmouseout="this.style.backgroundColor='transparent'; this.style.transform='translateY(0)';">Learn More</a>
                </div>
            </div>
        </section>
    </main>

    <!-- Theme Toggle Script -->
    <script>
        const root = document.documentElement;
        
        // Check for saved theme preference or default to light
        const savedTheme = localStorage.getItem('theme-mode');
        if (savedTheme === 'dark') {
            root.classList.add('dark');
        }
        
        // Theme toggle function
        window.toggleTheme = function() {
            root.classList.toggle('dark');
            const isDark = root.classList.contains('dark');
            localStorage.setItem('theme-mode', isDark ? 'dark' : 'light');
            
            // Update icon
            const icon = document.getElementById('theme-toggle-icon');
            if (icon) {
                icon.textContent = isDark ? '🌙' : '☀️';
            }
        };
    </script>
</body>
</html>
