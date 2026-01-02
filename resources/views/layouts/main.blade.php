<html>
<head>
    <title>{{ $title ?? 'Transparency.ie' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <style>
        :root {
            --bg: #0a0a0a;
            --surface: rgba(30, 30, 46, 0.7);
            --surface-light: rgba(88, 86, 214, 0.15);
            --glass: rgba(255, 255, 255, 0.05);
            --text: #e0e0e0;
            --text-muted: #888;
            --accent: #58d6ff;
            --accent-alt: #b366ff;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        html, body {
            width: 100%;
            height: 100%;
            font-family: 'Instrument Sans', system-ui, sans-serif;
            background: linear-gradient(135deg, var(--bg) 0%, #1a1a2e 100%);
            color: var(--text);
            overflow-x: hidden;
        }
        
        /* Glass morphism effect */
        .glass {
            background: var(--surface);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
        }
        
        .glass-strong {
            background: var(--surface);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }
        
        .nav {
            position: sticky;
            top: 0;
            z-index: 100;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
            background: rgba(10, 10, 10, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(88, 214, 255, 0.1);
        }
        
        .nav-brand {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(90deg, var(--accent) 0%, var(--accent-alt) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            white-space: nowrap;
        }
        
        .nav-links {
            display: flex;
            gap: 2rem;
            flex: 1;
        }
        
        .nav-links a {
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text);
            transition: all 0.3s;
            padding: 0.5rem 1rem;
            border-radius: 6px;
        }
        
        .nav-links a:hover {
            color: var(--accent);
            background: var(--surface-light);
        }
        
        .nav-actions {
            display: flex;
            gap: 1rem;
            white-space: nowrap;
        }
        
        .btn {
            padding: 0.7rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-primary {
            background: linear-gradient(90deg, var(--accent) 0%, var(--accent-alt) 100%);
            color: #000;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(88, 214, 255, 0.3);
        }
        
        .btn-secondary {
            background: var(--surface);
            border: 1px solid rgba(88, 214, 255, 0.3);
            color: var(--text);
        }
        
        .btn-secondary:hover {
            border-color: var(--accent);
            color: var(--accent);
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, var(--accent) 0%, transparent 70%);
            border-radius: 50%;
            opacity: 0.1;
            filter: blur(60px);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 900px;
        }
        
        .hero h1 {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            line-height: 1.1;
            background: linear-gradient(90deg, #fff 0%, var(--accent) 50%, var(--accent-alt) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero p {
            font-size: 1.3rem;
            color: var(--text-muted);
            margin-bottom: 3rem;
        }
        
        .cta-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 4rem 0;
        }
        
        .feature-card {
            padding: 2.5rem;
            border-radius: 12px;
            transition: all 0.3s;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            background: rgba(88, 214, 255, 0.1);
        }
        
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .feature-card h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: var(--accent);
        }
        
        .feature-card p {
            color: var(--text-muted);
            line-height: 1.6;
        }
        
        .section {
            padding: 4rem 2rem;
            margin: 2rem 0;
        }
        
        .section h2 {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            text-align: center;
            background: linear-gradient(90deg, var(--accent) 0%, var(--accent-alt) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .footer {
            padding: 2rem;
            text-align: center;
            color: var(--text-muted);
            border-top: 1px solid rgba(88, 214, 255, 0.1);
            margin-top: 4rem;
        }
        
        @media (max-width: 768px) {
            .hero h1 { font-size: 2rem; }
            .hero p { font-size: 1rem; }
            .nav { flex-direction: column; gap: 1rem; }
            .nav-links { flex-direction: column; width: 100%; }
            .cta-buttons { flex-direction: column; }
            .btn { width: 100%; }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="nav">
        <a href="/" class="nav-brand">✦ Transparency.ie</a>
        <div class="nav-links">
            <a href="/">Home</a>
            <a href="/metrics">Transparency</a>
            <a href="/technologies">Innovation</a>
            <a href="/campaigns">Civic</a>
            <a href="/events">Events</a>
            <a href="/dashboard">Dashboard</a>
        </div>
        <div class="nav-actions">
            <a href="/admin" class="btn btn-primary">Admin Panel</a>
        </div>
    </nav>
    
    <!-- Content -->
    {{ $slot ?? '' }}
    
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2026 Transparency.ie - Government Budget & Environmental Monitoring</p>
            <p style="margin-top: 1rem; font-size: 0.9rem;">
                <a href="#" style="color: var(--accent); text-decoration: none;">Privacy</a> • 
                <a href="#" style="color: var(--accent); text-decoration: none;">Terms</a> • 
                <a href="#" style="color: var(--accent); text-decoration: none;">Contact</a>
            </p>
        </div>
    </footer>
</body>
</html>
