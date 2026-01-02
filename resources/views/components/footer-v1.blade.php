<!-- FOOTER V1: Minimal Elegant with Pillars -->
<style>
    .footer-v1 {
        background: var(--panel);
        border-top: 1px solid var(--border);
        backdrop-filter: var(--blur);
        margin-top: 80px;
    }
    .footer-v1-wrap {
        max-width: 1320px;
        margin: 0 auto;
        padding: 60px 32px;
    }
    .footer-v1-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 48px;
        margin-bottom: 48px;
    }
    .footer-v1-col h3 {
        font-size: 14px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        margin: 0 0 20px 0;
        color: var(--ink);
    }
    .footer-v1-col-links {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .footer-v1-link {
        font-size: 13px;
        color: var(--subtle);
        transition: color 160ms ease;
        text-decoration: none;
    }
    .footer-v1-link:hover {
        color: var(--ink);
    }
    
    .footer-v1-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }
    .footer-v1-brand-badge {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--card);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    .footer-v1-brand-text small { color: var(--subtle); font-size: 11px; text-transform: uppercase; display: block; margin-bottom: 2px; }
    .footer-v1-brand-text strong { font-weight: 800; font-size: 16px; color: var(--ink); }
    
    .footer-v1-desc {
        font-size: 13px;
        color: var(--subtle);
        line-height: 1.6;
        max-width: 220px;
    }
    
    .footer-v1-divider {
        height: 1px;
        background: var(--border);
        margin-bottom: 32px;
    }
    
    .footer-v1-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 24px;
    }
    .footer-v1-credits {
        font-size: 12px;
        color: var(--subtle);
    }
    .footer-v1-socials {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .footer-v1-social {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--card);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        cursor: pointer;
        transition: all 160ms ease;
        text-decoration: none;
        color: var(--ink);
    }
    .footer-v1-social:hover {
        border-color: var(--ink);
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .footer-v1-wrap {
            padding: 40px 16px;
        }
        .footer-v1-grid {
            gap: 32px;
        }
        .footer-v1-bottom {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<footer class="footer-v1">
    <div class="footer-v1-wrap">
        <div class="footer-v1-grid">
            <div class="footer-v1-col">
                <div class="footer-v1-brand">
                    <div class="footer-v1-brand-badge">🔍</div>
                    <div class="footer-v1-brand-text">
                        <small>Observatory</small>
                        <strong>Transparency.ie</strong>
                    </div>
                </div>
                <p class="footer-v1-desc">Ireland's public ledger. Open budgets, climate action, civic power.</p>
                <div class="footer-v1-socials" style="margin-top: 20px;">
                    <a href="#" class="footer-v1-social" title="Twitter">𝕏</a>
                    <a href="#" class="footer-v1-social" title="GitHub">⚙️</a>
                    <a href="#" class="footer-v1-social" title="Email">✉️</a>
                </div>
            </div>

            <div class="footer-v1-col">
                <h3>Pillars</h3>
                <div class="footer-v1-col-links">
                    <a href="/metrics" class="footer-v1-link">💰 Transparency</a>
                    <a href="/metrics" class="footer-v1-link">🌍 Environment</a>
                    <a href="/campaigns" class="footer-v1-link">⚖️ Civic Forum</a>
                    <a href="/technologies" class="footer-v1-link">💡 Innovation</a>
                </div>
            </div>

            <div class="footer-v1-col">
                <h3>Explore</h3>
                <div class="footer-v1-col-links">
                    <a href="/technologies" class="footer-v1-link">Technologies</a>
                    <a href="/case-studies" class="footer-v1-link">Case Studies</a>
                    <a href="/campaigns" class="footer-v1-link">Campaigns</a>
                    <a href="/events" class="footer-v1-link">Events</a>
                </div>
            </div>

            <div class="footer-v1-col">
                <h3>Legal</h3>
                <div class="footer-v1-col-links">
                    <a href="#" class="footer-v1-link">Privacy Policy</a>
                    <a href="#" class="footer-v1-link">Terms of Service</a>
                    <a href="#" class="footer-v1-link">Accessibility</a>
                    <a href="#" class="footer-v1-link">Contact</a>
                </div>
            </div>
        </div>

        <div class="footer-v1-divider"></div>

        <div class="footer-v1-bottom">
            <div class="footer-v1-credits">
                © 2026 Transparency.ie. All rights reserved. Built for Ireland's civic future.
            </div>
        </div>
    </div>
</footer>
