<!-- Navigation Variant 2: Minimalist Frosted Glass with Sidebar Pillars -->
<style>
    .nav-v2 {
        position: relative;
        background: rgba(255, 255, 255, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 20px;
        padding: 12px 20px;
        backdrop-filter: blur(30px) saturate(150%);
        -webkit-backdrop-filter: blur(30px) saturate(150%);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06), inset 0 1px 0 rgba(255, 255, 255, 0.6);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
    }
    :root.dark .nav-v2 {
        background: rgba(26, 26, 26, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.05);
    }
    
    .nav-v2 .brand-section-v2 {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .nav-v2 .brand-badge-v2 {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        box-shadow: 0 4px 16px rgba(245, 87, 108, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
    .nav-v2 .brand-title-v2 {
        font-size: 20px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }
    
    .nav-v2 .menu-section-v2 {
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .nav-v2 .nav-link-v2 {
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 500;
        transition: all 180ms cubic-bezier(0.4, 0, 0.2, 1);
        background: transparent;
        color: var(--ink);
        position: relative;
        cursor: pointer;
    }
    .nav-v2 .nav-link-v2:hover {
        background: rgba(240, 147, 251, 0.1);
    }
    .nav-v2 .nav-link-v2.pillars-btn::after {
        content: '●●●●';
        position: absolute;
        top: -4px;
        right: 4px;
        font-size: 6px;
        letter-spacing: 1px;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .nav-v2 .pillars-sidebar {
        position: fixed;
        right: -400px;
        top: 0;
        width: 360px;
        height: 100vh;
        background: var(--panel);
        backdrop-filter: blur(40px);
        border-left: 1px solid var(--border);
        box-shadow: -8px 0 40px rgba(0, 0, 0, 0.15);
        transition: right 300ms cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 9999;
        overflow-y: auto;
        padding: 32px 24px;
    }
    .nav-v2 .pillars-sidebar.open {
        right: 0;
    }
    .nav-v2 .sidebar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
    }
    .nav-v2 .sidebar-title {
        font-size: 24px;
        font-weight: 800;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .nav-v2 .close-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 1px solid var(--border);
        background: transparent;
        cursor: pointer;
        font-size: 20px;
        transition: all 180ms ease;
    }
    .nav-v2 .close-btn:hover {
        background: rgba(240, 147, 251, 0.1);
        transform: rotate(90deg);
    }
    .nav-v2 .pillar-card-v2 {
        padding: 20px;
        border: 1px solid var(--border);
        border-radius: 16px;
        background: var(--card);
        margin-bottom: 16px;
        transition: all 200ms ease;
        cursor: pointer;
    }
    .nav-v2 .pillar-card-v2:hover {
        border-color: #f093fb;
        transform: translateX(-4px);
        box-shadow: 0 8px 24px rgba(240, 147, 251, 0.15);
    }
    .nav-v2 .pillar-icon-v2 {
        font-size: 32px;
        margin-bottom: 12px;
    }
    .nav-v2 .pillar-title-v2 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 8px;
    }
    .nav-v2 .pillar-desc-v2 {
        font-size: 13px;
        color: var(--subtle);
        line-height: 1.5;
    }
    .nav-v2 .overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        opacity: 0;
        visibility: hidden;
        transition: all 300ms ease;
        z-index: 9998;
    }
    .nav-v2 .overlay.show {
        opacity: 1;
        visibility: visible;
    }
    
    .nav-v2 .theme-toggle-v2 {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 1px solid var(--border);
        background: transparent;
        cursor: pointer;
        font-size: 18px;
        transition: all 200ms ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .nav-v2 .theme-toggle-v2:hover {
        background: rgba(240, 147, 251, 0.1);
        transform: scale(1.1);
    }
    
    .nav-v2 .auth-btn-v2 {
        padding: 8px 18px;
        border-radius: 12px;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        font-weight: 600;
        font-size: 14px;
        border: none;
        cursor: pointer;
        transition: all 200ms ease;
        box-shadow: 0 4px 12px rgba(245, 87, 108, 0.3);
    }
    .nav-v2 .auth-btn-v2:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 87, 108, 0.4);
    }
    
    @media (max-width: 768px) {
        .nav-v2 { padding: 12px 16px; }
        .nav-v2 .menu-section-v2 { flex-wrap: wrap; justify-content: center; }
        .nav-v2 .pillars-sidebar { width: 100%; right: -100%; }
    }
</style>

<nav class="nav-v2">
    <div class="brand-section-v2">
        <div class="brand-badge-v2">🔍</div>
        <div class="brand-title-v2">Transparency.ie</div>
    </div>
    
    <div class="menu-section-v2">
        <a href="/" class="nav-link-v2">Home</a>
        <button type="button" class="nav-link-v2 pillars-btn" onclick="togglePillarsSidebar()">Pillars</button>
        <a href="/case-studies" class="nav-link-v2">Studies</a>
        <a href="/events" class="nav-link-v2">Events</a>
        <button type="button" class="theme-toggle-v2" onclick="toggleTheme()">☀️</button>
        
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="auth-btn-v2">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="auth-btn-v2">Log in</a>
            @endauth
        @endif
    </div>
    
    <div class="overlay" onclick="togglePillarsSidebar()"></div>
    <div class="pillars-sidebar">
        <div class="sidebar-header">
            <div class="sidebar-title">Four Pillars</div>
            <button type="button" class="close-btn" onclick="togglePillarsSidebar()">✕</button>
        </div>
        
        <a href="/metrics" class="pillar-card-v2">
            <div class="pillar-icon-v2">💰</div>
            <div class="pillar-title-v2">Transparency Engine</div>
            <div class="pillar-desc-v2">Track every euro in Ireland's public budgets. Real-time spending data across 47 departments.</div>
        </a>
        
        <a href="/metrics" class="pillar-card-v2">
            <div class="pillar-icon-v2">🌍</div>
            <div class="pillar-title-v2">Environmental Atlas</div>
            <div class="pillar-desc-v2">Monitor emissions, renewable energy mix, and climate action progress nationwide.</div>
        </a>
        
        <a href="/campaigns" class="pillar-card-v2">
            <div class="pillar-icon-v2">⚖️</div>
            <div class="pillar-title-v2">Civic Forum</div>
            <div class="pillar-desc-v2">Join campaigns, launch initiatives, and mobilize communities for systemic change.</div>
        </a>
        
        <a href="/technologies" class="pillar-card-v2">
            <div class="pillar-icon-v2">💡</div>
            <div class="pillar-title-v2">Innovation Lab</div>
            <div class="pillar-desc-v2">Explore energy storage, grid tech, and breakthrough innovations tested in Ireland.</div>
        </a>
    </div>
</nav>

<script>
function togglePillarsSidebar() {
    const sidebar = document.querySelector('.nav-v2 .pillars-sidebar');
    const overlay = document.querySelector('.nav-v2 .overlay');
    sidebar.classList.toggle('open');
    overlay.classList.toggle('show');
}
</script>
