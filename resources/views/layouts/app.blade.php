<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Transparency.ie'))</title>
    <meta name="description" content="@yield('description', 'Track government spending, monitor environmental progress, and engage in civic action for Ireland.')">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    @livewireStyles
    <style>
        :root {
            --bg: #f8f8f8;
            --bg-alt: #ffffff;
            --panel: #ffffff;
            --subtle: #666666;
            --subtle-light: #999999;
            --ink: #1a1a1a;
            --accent: #0ea5e9;
            --accent-dark: #0284c7;
            --accent-light: #e0f2fe;
            --border: #e0e0e0;
            --border-light: #f0f0f0;
            --blur: blur(20px);
            --card: #ffffff;
            --shadow: 0 20px 60px rgba(0,0,0,0.08);
            --shadow-sm: 0 4px 12px rgba(0,0,0,0.05);
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
        }
        
        :root.dark {
            --bg: #0f172a;
            --bg-alt: #1e293b;
            --panel: #1e293b;
            --subtle: #999999;
            --subtle-light: #666666;
            --ink: #f8fafc;
            --accent: #0ea5e9;
            --accent-dark: #0284c7;
            --accent-light: #082f49;
            --border: #334155;
            --border-light: #475569;
            --card: #1e293b;
            --shadow: 0 20px 60px rgba(0,0,0,0.4);
            --shadow-sm: 0 4px 12px rgba(0,0,0,0.2);
        }
        
        * { box-sizing: border-box; }
        html, body { margin: 0; min-height: 100vh; }
        body {
            font-family: 'Instrument Sans', system-ui, -apple-system, sans-serif;
            background: var(--bg);
            color: var(--ink);
            line-height: 1.6;
        }
        
        a { color: var(--accent); text-decoration: none; }
        a:hover { color: var(--accent-dark); }
        
        /* Layout Structure */
        #app { display: flex; flex-direction: column; min-height: 100vh; }
        nav { flex-shrink: 0; }
        main { flex-grow: 1; }
        footer { flex-shrink: 0; margin-top: auto; }
        
        /* Navigation */
        nav {
            background: var(--panel);
            border-bottom: 1px solid var(--border-light);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: var(--blur);
            box-shadow: var(--shadow-sm);
        }
        
        nav .nav-inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 32px;
            height: 72px;
        }
        
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            font-size: 20px;
            color: var(--ink);
            white-space: nowrap;
        }
        
        .nav-brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 800;
            font-size: 18px;
        }
        
        nav .nav-links {
            display: flex;
            align-items: center;
            gap: 2px;
            flex: 1;
        }
        
        nav .nav-links a {
            padding: 10px 16px;
            color: var(--subtle);
            font-weight: 500;
            font-size: 14px;
            transition: all 160ms ease;
            border-radius: 8px;
            position: relative;
        }
        
        nav .nav-links a:hover,
        nav .nav-links a.active {
            background: var(--accent-light);
            color: var(--accent-dark);
        }
        
        nav .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
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
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn:hover { transform: translateY(-1px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); }
        .btn-outline { border: 1.5px solid var(--border); background: transparent; color: var(--ink); }
        .btn-outline:hover { background: var(--card); border-color: var(--ink); }
        .btn-primary { background: var(--accent); border-color: var(--accent); color: white; }
        .btn-primary:hover { background: var(--accent-dark); border-color: var(--accent-dark); }
        
        .theme-toggle {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: var(--bg-alt);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--subtle);
            transition: all 160ms ease;
        }
        
        .theme-toggle:hover { border-color: var(--accent); color: var(--accent); }
        
        /* Main Content */
        main { padding: 60px 32px; max-width: 1400px; margin: 0 auto; width: 100%; }
        
        h1 { font-size: 44px; font-weight: 800; line-height: 1.2; margin: 0 0 16px; letter-spacing: -0.5px; }
        h2 { font-size: 36px; font-weight: 800; line-height: 1.2; margin: 0 0 16px; letter-spacing: -0.5px; }
        h3 { font-size: 22px; font-weight: 700; line-height: 1.3; margin: 0 0 12px; }
        h4 { font-size: 18px; font-weight: 700; line-height: 1.3; margin: 0 0 8px; }
        
        .page-header { margin-bottom: 48px; }
        .page-header-tag { font-size: 11px; text-transform: uppercase; letter-spacing: 0.15em; color: var(--subtle); font-weight: 600; margin-bottom: 8px; }
        .page-header p { color: var(--subtle); font-size: 16px; line-height: 1.6; max-width: 640px; margin: 0; }
        
        .muted { color: var(--subtle); }
        .subtle { color: var(--subtle-light); font-size: 13px; }
        
        .grid { display: grid; gap: 24px; }
        .grid-2 { grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); }
        .grid-3 { grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); }
        .grid-4 { grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); }
        
        .panel {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 40px;
            box-shadow: var(--shadow);
            backdrop-filter: var(--blur);
        }
        
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 32px;
            transition: all 200ms ease;
        }
        
        .card:hover { border-color: var(--accent); transform: translateY(-4px); box-shadow: 0 16px 40px rgba(14, 165, 233, 0.1); }
        
        .stat-card { padding: 28px; border: 1px solid var(--border); border-radius: 12px; background: var(--card); }
        .stat-number { font-size: 32px; font-weight: 800; color: var(--accent); margin: 8px 0; }
        .stat-label { font-size: 13px; text-transform: uppercase; letter-spacing: 0.1em; color: var(--subtle); font-weight: 600; }
        .stat-unit { font-size: 14px; color: var(--subtle-light); margin-top: 8px; }
        
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }
        
        .badge-primary { background: var(--accent-light); color: var(--accent-dark); }
        .badge-success { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .badge-warning { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
        .badge-danger { background: rgba(239, 68, 68, 0.1); color: var(--danger); }
        
        /* Footer */
        footer {
            background: var(--panel);
            border-top: 1px solid var(--border);
            padding: 60px 32px 40px;
            margin-top: 80px;
        }
        
        footer .footer-inner {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }
        
        footer h4 { font-size: 14px; margin-bottom: 16px; }
        footer a { color: var(--subtle); font-size: 14px; display: block; margin-bottom: 10px; transition: all 160ms ease; }
        footer a:hover { color: var(--accent); }
        
        .footer-brand {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        
        .footer-brand-text { color: var(--subtle); font-size: 14px; line-height: 1.6; }
        
        .footer-social {
            display: flex;
            gap: 12px;
            margin-top: 16px;
        }
        
        .social-link {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--subtle);
            transition: all 160ms ease;
        }
        
        .social-link:hover { border-color: var(--accent); color: var(--accent); background: var(--accent-light); }
        
        .footer-divider { max-width: 1400px; margin: 0 auto; padding-top: 32px; border-top: 1px solid var(--border); }
        .footer-bottom { max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; gap: 24px; flex-wrap: wrap; }
        .footer-bottom .subtle { margin: 0; }
        .footer-links { display: flex; gap: 24px; }
        
        /* Animations */
        @keyframes fadeIn { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in { animation: fadeIn 0.6s ease; }
        
        .reveal { opacity: 0; transform: translateY(16px); transition: opacity 0.7s ease, transform 0.7s ease; }
        .revealed { opacity: 1; transform: translateY(0); }
        
        /* Responsive */
        @media (max-width: 1024px) {
            nav .nav-inner { padding: 0 24px; gap: 24px; }
            main { padding: 40px 24px; }
            h1 { font-size: 32px; }
            h2 { font-size: 28px; }
            .panel { padding: 32px 24px; }
        }
        
        @media (max-width: 768px) {
            nav .nav-inner { flex-direction: column; height: auto; padding: 16px 24px; gap: 16px; }
            nav .nav-links { width: 100%; flex-direction: column; }
            nav .nav-links a { display: block; text-align: left; }
            main { padding: 32px 16px; }
            h1 { font-size: 24px; }
            h2 { font-size: 22px; }
            .grid-2, .grid-3, .grid-4 { grid-template-columns: 1fr; }
            .panel { padding: 24px; }
            footer .footer-inner { grid-template-columns: 1fr; gap: 32px; }
        }
    </style>
    @yield('styles')
</head>
<body>
    <div id="app">
        <!-- Navigation -->
        <nav>
            <div class="nav-inner">
                <a href="/" class="nav-brand">
                    <div class="nav-brand-icon">T</div>
                    <span>Transparency.ie</span>
                </a>
                <div class="nav-links">
                    <a href="/" class="@if(request()->is('/')) active @endif">Home</a>
                    <a href="/metrics" class="@if(request()->is('metrics*')) active @endif">Metrics</a>
                    <a href="/technologies" class="@if(request()->is('technologies*')) active @endif">Technologies</a>
                    <a href="/events" class="@if(request()->is('events*')) active @endif">Events</a>
                    <a href="/campaigns" class="@if(request()->is('campaigns*')) active @endif">Campaigns</a>
                    <a href="/case-studies" class="@if(request()->is('case-studies*')) active @endif">Studies</a>
                </div>
                <div class="nav-actions">
                    <a href="/admin" class="btn btn-primary">Dashboard</a>
                    <button class="theme-toggle" onclick="window.toggleTheme();">🌙</button>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer>
            <div class="footer-inner">
                <div class="footer-brand">
                    <h4>Transparency.ie</h4>
                    <p class="footer-brand-text">Making Irish government spending and environmental action transparent, measurable, and actionable for citizens.</p>
                    <div class="footer-social">
                        <a href="#" class="social-link" title="Twitter">𝕏</a>
                        <a href="#" class="social-link" title="LinkedIn">in</a>
                        <a href="#" class="social-link" title="GitHub">⚙</a>
                        <a href="#" class="social-link" title="Email">✉</a>
                    </div>
                </div>
                <div>
                    <h4>Explore</h4>
                    <a href="/metrics">Budget Metrics</a>
                    <a href="/technologies">Green Tech</a>
                    <a href="/events">Events</a>
                    <a href="/campaigns">Campaigns</a>
                </div>
                <div>
                    <h4>Learn</h4>
                    <a href="/case-studies">Case Studies</a>
                    <a href="#">Research</a>
                    <a href="#">API Docs</a>
                    <a href="#">Blog</a>
                </div>
                <div>
                    <h4>Resources</h4>
                    <a href="#">About Us</a>
                    <a href="#">Contact</a>
                    <a href="#">Privacy</a>
                    <a href="#">Terms</a>
                </div>
            </div>
            <div class="footer-divider">
                <div class="footer-bottom">
                    <p class="subtle">© 2026 Transparency.ie. Made with 💚 for Ireland.</p>
                    <div class="footer-links">
                        <a href="#" class="subtle">Privacy Policy</a>
                        <a href="#" class="subtle">Terms of Service</a>
                        <a href="#" class="subtle">Status</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @livewireScripts
    <script>
        (() => {
            const root = document.documentElement;
            const stored = localStorage.getItem('theme');
            // ALWAYS default to light mode unless explicitly stored as dark
            if (stored === 'dark') {
                root.classList.add('dark');
                document.querySelector('.theme-toggle').textContent = '☀';
            } else {
                root.classList.remove('dark');
                document.querySelector('.theme-toggle').textContent = '🌙';
            }
            window.toggleTheme = () => {
                const isDark = root.classList.toggle('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
                document.querySelector('.theme-toggle').textContent = isDark ? '☀' : '🌙';
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
</body>
</html>
