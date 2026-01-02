<!-- Footer Variant 1: Elegant Minimalist -->
<style>
    .footer-v1 {
        margin-top: 80px;
        padding: 48px 32px 32px;
        background: var(--panel);
        border-top: 1px solid var(--border);
        backdrop-filter: blur(24px);
    }
    .footer-v1 .footer-content {
        max-width: 1320px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 40px;
        margin-bottom: 40px;
    }
    .footer-v1 .footer-brand {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .footer-v1 .footer-logo {
        font-size: 24px;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .footer-v1 .footer-tagline {
        font-size: 14px;
        color: var(--subtle);
        line-height: 1.6;
        max-width: 280px;
    }
    .footer-v1 .footer-section h4 {
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 16px;
        color: var(--ink);
    }
    .footer-v1 .footer-links {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .footer-v1 .footer-link {
        font-size: 14px;
        color: var(--subtle);
        transition: all 180ms ease;
        cursor: pointer;
    }
    .footer-v1 .footer-link:hover {
        color: #667eea;
        transform: translateX(4px);
    }
    .footer-v1 .footer-bottom {
        max-width: 1320px;
        margin: 0 auto;
        padding-top: 32px;
        border-top: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }
    .footer-v1 .copyright {
        font-size: 13px;
        color: var(--subtle);
    }
    .footer-v1 .social-links {
        display: flex;
        gap: 12px;
    }
    .footer-v1 .social-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        transition: all 180ms ease;
        cursor: pointer;
    }
    .footer-v1 .social-icon:hover {
        background: rgba(102, 126, 234, 0.1);
        border-color: #667eea;
        transform: translateY(-2px);
    }
    
    @media (max-width: 768px) {
        .footer-v1 { padding: 32px 16px 24px; }
        .footer-v1 .footer-content { grid-template-columns: 1fr; gap: 32px; }
        .footer-v1 .footer-bottom { flex-direction: column; text-align: center; }
    }
</style>

<footer class="footer-v1">
    <div class="footer-content">
        <div class="footer-brand">
            <div class="footer-logo">Transparency.ie</div>
            <p class="footer-tagline">Ireland's public observatory. Tracking budgets, climate action, and civic engagement. Power to the people.</p>
        </div>
        
        <div class="footer-section">
            <h4>Four Pillars</h4>
            <div class="footer-links">
                <a href="/metrics" class="footer-link">💰 Transparency Engine</a>
                <a href="/metrics" class="footer-link">🌍 Environmental Atlas</a>
                <a href="/campaigns" class="footer-link">⚖️ Civic Forum</a>
                <a href="/technologies" class="footer-link">💡 Innovation Lab</a>
            </div>
        </div>
        
        <div class="footer-section">
            <h4>Explore</h4>
            <div class="footer-links">
                <a href="/case-studies" class="footer-link">Case Studies</a>
                <a href="/campaigns" class="footer-link">Campaigns</a>
                <a href="/events" class="footer-link">Events</a>
                <a href="/metrics" class="footer-link">Metrics</a>
                <a href="/technologies" class="footer-link">Technologies</a>
            </div>
        </div>
        
        <div class="footer-section">
            <h4>Connect</h4>
            <div class="footer-links">
                <a href="#" class="footer-link">About Us</a>
                <a href="#" class="footer-link">Contact</a>
                <a href="#" class="footer-link">API Access</a>
                <a href="#" class="footer-link">Open Data</a>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="copyright">© 2026 Transparency.ie • Open source, community-driven</div>
        <div class="social-links">
            <a href="#" class="social-icon">𝕏</a>
            <a href="#" class="social-icon">🔗</a>
            <a href="#" class="social-icon">📧</a>
            <a href="#" class="social-icon">📱</a>
        </div>
    </div>
</footer>
