<!-- FOOTER V3: Sleek Minimalist with Accent Strip -->
<style>
    .footer-v3 {
        background: var(--panel);
        backdrop-filter: var(--blur);
        margin-top: 80px;
        position: relative;
    }
    .footer-v3::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent 0%, var(--border) 20%, var(--border) 80%, transparent 100%);
    }
    
    .footer-v3-wrap {
        max-width: 1320px;
        margin: 0 auto;
        padding: 80px 32px 40px;
    }
    
    .footer-v3-top {
        display: grid;
        grid-template-columns: 3fr 1fr 1fr 1fr 1fr;
        gap: 60px;
        margin-bottom: 60px;
    }
    
    .footer-v3-brand {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .footer-v3-logo {
        display: flex;
        align-items: center;
        gap: 12px;
        width: fit-content;
    }
    .footer-v3-logo-mark {
        width: 44px;
        height: 44px;
        border-radius: 6px;
        background: var(--card);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
    .footer-v3-logo-text {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    .footer-v3-logo-text small {
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: var(--subtle);
        font-weight: 600;
    }
    .footer-v3-logo-text strong {
        font-size: 16px;
        font-weight: 800;
        color: var(--ink);
    }
    
    .footer-v3-mission {
        font-size: 13px;
        line-height: 1.8;
        color: var(--subtle);
        max-width: 320px;
    }
    
    .footer-v3-col h5 {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        margin: 0 0 18px 0;
        color: var(--ink);
    }
    .footer-v3-col-links {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .footer-v3-link {
        font-size: 12px;
        color: var(--subtle);
        transition: color 160ms ease, padding-left 160ms ease;
        text-decoration: none;
        display: block;
    }
    .footer-v3-link:hover {
        color: var(--ink);
        padding-left: 4px;
    }
    
    .footer-v3-divider {
        height: 1px;
        background: var(--border);
        margin-bottom: 32px;
    }
    
    .footer-v3-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 32px;
    }
    .footer-v3-legal {
        font-size: 12px;
        color: var(--subtle);
        flex: 1;
        min-width: 200px;
    }
    .footer-v3-socials {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .footer-v3-social {
        width: 36px;
        height: 36px;
        border-radius: 6px;
        background: var(--card);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        cursor: pointer;
        transition: all 180ms ease;
        text-decoration: none;
        color: var(--ink);
    }
    .footer-v3-social:hover {
        background: var(--ink);
        color: var(--bg);
        border-color: var(--ink);
        transform: translateY(-1px);
    }

    @media (max-width: 1024px) {
        .footer-v3-top {
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
        }
    }
    
    @media (max-width: 768px) {
        .footer-v3-wrap {
            padding: 60px 16px 40px;
        }
        .footer-v3-top {
            grid-template-columns: 1fr 1fr 1fr;
            gap: 32px;
        }
        .footer-v3-brand {
            grid-column: 1 / -1;
        }
        .footer-v3-bottom {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<footer class="footer-v3">
    <div class="footer-v3-wrap">
        <div class="footer-v3-top">
            <div class="footer-v3-brand">
                <div class="footer-v3-logo">
                    <div class="footer-v3-logo-mark">🔍</div>
                    <div class="footer-v3-logo-text">
                        <small>Observatory</small>
                        <strong>Transparency.ie</strong>
                    </div>
                </div>
                <p class="footer-v3-mission">Ireland's public ledger. We believe in radical transparency, climate accountability, and civic power. Open budgets. Open climate data. Open action.</p>
                <div class="footer-v3-socials">
                    <a href="#" class="footer-v3-social" title="Twitter">𝕏</a>
                    <a href="#" class="footer-v3-social" title="GitHub">⚙️</a>
                    <a href="#" class="footer-v3-social" title="Email">✉️</a>
                </div>
            </div>

            <div class="footer-v3-col">
                <h5>Pillars</h5>
                <div class="footer-v3-col-links">
                    <a href="/metrics" class="footer-v3-link">Transparency</a>
                    <a href="/metrics" class="footer-v3-link">Environment</a>
                    <a href="/campaigns" class="footer-v3-link">Civic Forum</a>
                    <a href="/technologies" class="footer-v3-link">Innovation</a>
                </div>
            </div>

            <div class="footer-v3-col">
                <h5>Explore</h5>
                <div class="footer-v3-col-links">
                    <a href="/technologies" class="footer-v3-link">Technologies</a>
                    <a href="/events" class="footer-v3-link">Events</a>
                    <a href="/case-studies" class="footer-v3-link">Studies</a>
                    <a href="/campaigns" class="footer-v3-link">Campaigns</a>
                </div>
            </div>

            <div class="footer-v3-col">
                <h5>Legal</h5>
                <div class="footer-v3-col-links">
                    <a href="#" class="footer-v3-link">Privacy</a>
                    <a href="#" class="footer-v3-link">Terms</a>
                    <a href="#" class="footer-v3-link">Access</a>
                    <a href="#" class="footer-v3-link">Contact</a>
                </div>
            </div>

            <div class="footer-v3-col">
                <h5>Data</h5>
                <div class="footer-v3-col-links">
                    <a href="#" class="footer-v3-link">API Docs</a>
                    <a href="#" class="footer-v3-link">Datasets</a>
                    <a href="#" class="footer-v3-link">Updates</a>
                    <a href="#" class="footer-v3-link">Status</a>
                </div>
            </div>
        </div>

        <div class="footer-v3-divider"></div>

        <div class="footer-v3-bottom">
            <div class="footer-v3-legal">© 2026 Transparency.ie. Built in Ireland for Ireland. All rights reserved.</div>
        </div>
    </div>
</footer>
