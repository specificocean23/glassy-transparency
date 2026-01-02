<!-- Footer Variant 3: Bold Card Grid -->
<style>
    .footer-v3 {
        margin-top: 80px;
        padding: 64px 32px 32px;
        background: var(--bg);
        border-top: 2px solid var(--ink);
    }
    :root.dark .footer-v3 {
        border-top: 2px solid var(--border);
    }
    .footer-v3 .footer-container {
        max-width: 1320px;
        margin: 0 auto;
    }
    .footer-v3 .footer-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
        margin-bottom: 48px;
    }
    .footer-v3 .footer-card {
        padding: 28px;
        border: 2px solid var(--ink);
        background: var(--panel);
        box-shadow: 6px 6px 0 var(--ink);
        transition: all 200ms ease;
    }
    :root.dark .footer-v3 .footer-card {
        box-shadow: 6px 6px 0 var(--border);
    }
    .footer-v3 .footer-card:hover {
        transform: translate(-3px, -3px);
        box-shadow: 9px 9px 0 var(--ink);
    }
    :root.dark .footer-v3 .footer-card:hover {
        box-shadow: 9px 9px 0 var(--border);
    }
    .footer-v3 .card-icon {
        font-size: 36px;
        margin-bottom: 16px;
    }
    .footer-v3 .card-title {
        font-size: 18px;
        font-weight: 900;
        text-transform: uppercase;
        margin-bottom: 12px;
        letter-spacing: 0.5px;
    }
    .footer-v3 .card-links {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .footer-v3 .card-link {
        font-size: 14px;
        font-weight: 600;
        color: var(--subtle);
        cursor: pointer;
        transition: all 150ms ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .footer-v3 .card-link:hover {
        color: var(--ink);
        transform: translateX(6px);
    }
    .footer-v3 .card-link::before {
        content: '▸';
        font-size: 12px;
    }
    .footer-v3 .footer-stat {
        padding: 24px;
        border: 2px solid var(--ink);
        background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
        box-shadow: 6px 6px 0 var(--ink);
        text-align: center;
    }
    :root.dark .footer-v3 .footer-stat {
        box-shadow: 6px 6px 0 var(--border);
    }
    .footer-v3 .stat-number {
        font-size: 32px;
        font-weight: 900;
        color: var(--ink);
        margin-bottom: 8px;
    }
    .footer-v3 .stat-label {
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: rgba(26, 26, 26, 0.7);
    }
    .footer-v3 .footer-end {
        margin-top: 48px;
        padding-top: 32px;
        border-top: 2px solid var(--ink);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 24px;
    }
    :root.dark .footer-v3 .footer-end {
        border-top: 2px solid var(--border);
    }
    .footer-v3 .footer-brand-end {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .footer-v3 .brand-box {
        width: 48px;
        height: 48px;
        border: 2px solid var(--ink);
        background: linear-gradient(135deg, #ff7675 0%, #fd79a8 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 900;
        box-shadow: 4px 4px 0 var(--ink);
    }
    :root.dark .footer-v3 .brand-box {
        box-shadow: 4px 4px 0 var(--border);
    }
    .footer-v3 .brand-text-end {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    .footer-v3 .brand-name-end {
        font-size: 18px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .footer-v3 .brand-tagline-end {
        font-size: 12px;
        color: var(--subtle);
        font-weight: 600;
    }
    .footer-v3 .footer-actions {
        display: flex;
        gap: 12px;
    }
    .footer-v3 .action-btn {
        padding: 10px 18px;
        border: 2px solid var(--ink);
        background: var(--panel);
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 150ms ease;
    }
    .footer-v3 .action-btn:hover {
        background: #ffeaa7;
        transform: translate(-2px, -2px);
        box-shadow: 4px 4px 0 var(--ink);
    }
    :root.dark .footer-v3 .action-btn:hover {
        box-shadow: 4px 4px 0 var(--border);
    }
    .footer-v3 .copyright-end {
        width: 100%;
        text-align: center;
        font-size: 12px;
        color: var(--subtle);
        margin-top: 24px;
        padding-top: 24px;
        border-top: 1px solid var(--border);
        font-weight: 600;
    }
    
    @media (max-width: 768px) {
        .footer-v3 { padding: 40px 16px 24px; }
        .footer-v3 .footer-cards { grid-template-columns: 1fr; }
        .footer-v3 .footer-end { flex-direction: column; }
    }
</style>

<footer class="footer-v3">
    <div class="footer-container">
        <div class="footer-cards">
            <div class="footer-card">
                <div class="card-icon">💰</div>
                <div class="card-title">Transparency</div>
                <div class="card-links">
                    <a href="/metrics" class="card-link">Budget Tracking</a>
                    <a href="/metrics" class="card-link">Department Rollups</a>
                    <a href="/metrics" class="card-link">Spending Data</a>
                </div>
            </div>
            
            <div class="footer-card">
                <div class="card-icon">🌍</div>
                <div class="card-title">Environment</div>
                <div class="card-links">
                    <a href="/metrics" class="card-link">Emissions Tracker</a>
                    <a href="/metrics" class="card-link">Renewable Energy</a>
                    <a href="/metrics" class="card-link">Climate Metrics</a>
                </div>
            </div>
            
            <div class="footer-card">
                <div class="card-icon">⚖️</div>
                <div class="card-title">Civic Action</div>
                <div class="card-links">
                    <a href="/campaigns" class="card-link">Active Campaigns</a>
                    <a href="/events" class="card-link">Upcoming Events</a>
                    <a href="/case-studies" class="card-link">Case Studies</a>
                </div>
            </div>
            
            <div class="footer-stat">
                <div class="stat-number">67K+</div>
                <div class="stat-label">Active Members</div>
            </div>
        </div>
        
        <div class="footer-end">
            <div class="footer-brand-end">
                <div class="brand-box">T</div>
                <div class="brand-text-end">
                    <div class="brand-name-end">Transparency.ie</div>
                    <div class="brand-tagline-end">Power to the people</div>
                </div>
            </div>
            
            <div class="footer-actions">
                <button class="action-btn">API</button>
                <button class="action-btn">Data</button>
                <button class="action-btn">Contact</button>
            </div>
            
            <div class="copyright-end">
                © 2026 Transparency.ie • Open Source • Community-Driven
            </div>
        </div>
    </div>
</footer>
