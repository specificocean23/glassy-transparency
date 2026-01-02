<!-- FOOTER V2: Bold Modular with Stat Cards -->
<style>
    .footer-v2 {
        background: var(--panel);
        border-top: 1px solid var(--border);
        backdrop-filter: var(--blur);
        margin-top: 80px;
    }
    .footer-v2-wrap {
        max-width: 1320px;
        margin: 0 auto;
        padding: 60px 32px;
    }
    
    .footer-v2-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 24px;
        margin-bottom: 60px;
    }
    .footer-v2-stat {
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 24px;
        background: var(--card);
        text-align: center;
    }
    .footer-v2-stat-number {
        font-size: 28px;
        font-weight: 800;
        color: var(--ink);
        margin-bottom: 8px;
    }
    .footer-v2-stat-label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: var(--subtle);
        font-weight: 600;
    }
    
    .footer-v2-content {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 48px;
        margin-bottom: 48px;
    }
    
    .footer-v2-brand {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        margin-bottom: 24px;
    }
    .footer-v2-badge {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        background: linear-gradient(135deg, var(--bg), rgba(26,26,26,0.02));
        border: 1.5px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }
    .footer-v2-brand-text small { font-size: 11px; text-transform: uppercase; letter-spacing: 0.1em; color: var(--subtle); display: block; margin-bottom: 4px; }
    .footer-v2-brand-text strong { font-size: 18px; font-weight: 800; color: var(--ink); }
    
    .footer-v2-desc {
        font-size: 13px;
        color: var(--subtle);
        line-height: 1.7;
        max-width: 280px;
    }
    
    .footer-v2-col h4 {
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        margin: 0 0 18px 0;
        color: var(--ink);
    }
    .footer-v2-col-links {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .footer-v2-link {
        font-size: 12px;
        color: var(--subtle);
        transition: color 160ms ease;
        text-decoration: none;
    }
    .footer-v2-link:hover {
        color: var(--ink);
    }
    
    .footer-v2-divider {
        height: 1px;
        background: var(--border);
        margin-bottom: 32px;
    }
    
    .footer-v2-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 24px;
    }
    .footer-v2-copyright {
        font-size: 12px;
        color: var(--subtle);
    }
    .footer-v2-badges {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .footer-v2-badge-sm {
        font-size: 18px;
        cursor: pointer;
        transition: transform 160ms ease;
    }
    .footer-v2-badge-sm:hover {
        transform: scale(1.15);
    }

    @media (max-width: 1024px) {
        .footer-v2-content {
            grid-template-columns: 1fr 1fr 1fr;
            gap: 36px;
        }
    }
    
    @media (max-width: 768px) {
        .footer-v2-wrap {
            padding: 40px 16px;
        }
        .footer-v2-stats {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 40px;
        }
        .footer-v2-stat {
            padding: 16px;
        }
        .footer-v2-stat-number {
            font-size: 22px;
        }
        .footer-v2-content {
            grid-template-columns: 1fr 1fr;
            gap: 28px;
        }
        .footer-v2-footer {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<footer class="footer-v2">
    <div class="footer-v2-wrap">
        <div class="footer-v2-stats">
            <div class="footer-v2-stat">
                <div class="footer-v2-stat-number">€104B</div>
                <div class="footer-v2-stat-label">Open Budgets</div>
            </div>
            <div class="footer-v2-stat">
                <div class="footer-v2-stat-number">32</div>
                <div class="footer-v2-stat-label">Impact Metrics</div>
            </div>
            <div class="footer-v2-stat">
                <div class="footer-v2-stat-number">67K+</div>
                <div class="footer-v2-stat-label">Community Members</div>
            </div>
            <div class="footer-v2-stat">
                <div class="footer-v2-stat-number">14</div>
                <div class="footer-v2-stat-label">Active Campaigns</div>
            </div>
        </div>

        <div class="footer-v2-content">
            <div>
                <div class="footer-v2-brand">
                    <div class="footer-v2-badge">🔍</div>
                    <div class="footer-v2-brand-text">
                        <small>Public Observatory</small>
                        <strong>Transparency.ie</strong>
                    </div>
                </div>
                <p class="footer-v2-desc">Ireland's public ledger. Open budgets, climate action, civic power—one dashboard at a time.</p>
                <div class="footer-v2-badges" style="margin-top: 24px;">
                    <a href="#" class="footer-v2-badge-sm" title="Twitter">𝕏</a>
                    <a href="#" class="footer-v2-badge-sm" title="GitHub">⚙️</a>
                    <a href="#" class="footer-v2-badge-sm" title="Email">✉️</a>
                    <a href="#" class="footer-v2-badge-sm" title="LinkedIn">💼</a>
                </div>
            </div>

            <div>
                <h4>Pillars</h4>
                <div class="footer-v2-col-links">
                    <a href="/metrics" class="footer-v2-link">💰 Transparency</a>
                    <a href="/metrics" class="footer-v2-link">🌍 Environment</a>
                    <a href="/campaigns" class="footer-v2-link">⚖️ Civic Forum</a>
                    <a href="/technologies" class="footer-v2-link">💡 Innovation</a>
                </div>
            </div>

            <div>
                <h4>Sections</h4>
                <div class="footer-v2-col-links">
                    <a href="/technologies" class="footer-v2-link">Technologies</a>
                    <a href="/events" class="footer-v2-link">Events</a>
                    <a href="/case-studies" class="footer-v2-link">Case Studies</a>
                    <a href="/campaigns" class="footer-v2-link">Campaigns</a>
                </div>
            </div>

            <div>
                <h4>Legal</h4>
                <div class="footer-v2-col-links">
                    <a href="#" class="footer-v2-link">Privacy</a>
                    <a href="#" class="footer-v2-link">Terms</a>
                    <a href="#" class="footer-v2-link">Accessibility</a>
                    <a href="#" class="footer-v2-link">Contact</a>
                </div>
            </div>
        </div>

        <div class="footer-v2-divider"></div>

        <div class="footer-v2-footer">
            <div class="footer-v2-copyright">© 2026 Transparency.ie. Built to empower Ireland's civic future.</div>
        </div>
    </div>
</footer>
