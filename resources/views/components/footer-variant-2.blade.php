<!-- Footer Variant 2: Glassy Wave Design -->
<style>
    .footer-v2 {
        position: relative;
        margin-top: 80px;
        padding: 60px 32px 32px;
        background: linear-gradient(180deg, transparent 0%, var(--panel) 40%);
        overflow: hidden;
    }
    .footer-v2::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 120px;
        background: var(--panel);
        clip-path: ellipse(70% 100% at 50% 100%);
        opacity: 0.6;
    }
    .footer-v2 .wave-divider {
        position: absolute;
        top: -80px;
        left: 0;
        right: 0;
        height: 100px;
        background: var(--panel);
        clip-path: polygon(0 50%, 10% 40%, 20% 50%, 30% 45%, 40% 50%, 50% 40%, 60% 50%, 70% 45%, 80% 50%, 90% 40%, 100% 50%, 100% 100%, 0 100%);
        border-top: 1px solid var(--border);
    }
    .footer-v2 .footer-inner {
        position: relative;
        max-width: 1320px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 48px;
    }
    .footer-v2 .footer-main {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1fr 1fr;
        gap: 48px;
    }
    .footer-v2 .brand-col {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .footer-v2 .brand-badge-footer {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        box-shadow: 0 8px 24px rgba(245, 87, 108, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }
    .footer-v2 .brand-name {
        font-size: 20px;
        font-weight: 800;
        margin-top: 8px;
    }
    .footer-v2 .brand-desc {
        font-size: 14px;
        color: var(--subtle);
        line-height: 1.7;
    }
    .footer-v2 .newsletter {
        margin-top: 16px;
        display: flex;
        gap: 8px;
    }
    .footer-v2 .newsletter-input {
        flex: 1;
        padding: 12px 16px;
        border: 1px solid var(--border);
        border-radius: 10px;
        background: var(--card);
        color: var(--ink);
        font-size: 14px;
        outline: none;
        transition: all 180ms ease;
    }
    .footer-v2 .newsletter-input:focus {
        border-color: #f093fb;
        box-shadow: 0 0 0 3px rgba(240, 147, 251, 0.1);
    }
    .footer-v2 .newsletter-btn {
        padding: 12px 20px;
        border: none;
        border-radius: 10px;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 180ms ease;
    }
    .footer-v2 .newsletter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 87, 108, 0.4);
    }
    .footer-v2 .footer-col h5 {
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        margin-bottom: 20px;
        color: var(--ink);
    }
    .footer-v2 .footer-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }
    .footer-v2 .footer-list-item {
        font-size: 14px;
        color: var(--subtle);
        transition: all 180ms ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .footer-v2 .footer-list-item:hover {
        color: #f093fb;
        transform: translateX(4px);
    }
    .footer-v2 .footer-list-item::before {
        content: '→';
        font-size: 12px;
        opacity: 0;
        transition: opacity 180ms ease;
    }
    .footer-v2 .footer-list-item:hover::before {
        opacity: 1;
    }
    .footer-v2 .footer-bar {
        padding-top: 32px;
        border-top: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }
    .footer-v2 .footer-meta {
        display: flex;
        align-items: center;
        gap: 24px;
        flex-wrap: wrap;
    }
    .footer-v2 .footer-meta-item {
        font-size: 13px;
        color: var(--subtle);
        cursor: pointer;
        transition: all 180ms ease;
    }
    .footer-v2 .footer-meta-item:hover {
        color: #f093fb;
    }
    .footer-v2 .heart {
        display: inline-block;
        animation: heartbeat 1.5s ease-in-out infinite;
    }
    @keyframes heartbeat {
        0%, 100% { transform: scale(1); }
        10%, 30% { transform: scale(1.1); }
        20%, 40% { transform: scale(1); }
    }
    
    @media (max-width: 1024px) {
        .footer-v2 .footer-main { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 640px) {
        .footer-v2 { padding: 40px 16px 24px; }
        .footer-v2 .footer-main { grid-template-columns: 1fr; gap: 32px; }
        .footer-v2 .footer-bar { flex-direction: column; text-align: center; }
    }
</style>

<footer class="footer-v2">
    <div class="wave-divider"></div>
    <div class="footer-inner">
        <div class="footer-main">
            <div class="brand-col">
                <div class="brand-badge-footer">🔍</div>
                <div class="brand-name">Transparency.ie</div>
                <p class="brand-desc">Mapping Ireland's public budgets, climate action, and civic engagement. Join 67K+ community members shaping policy.</p>
                <div class="newsletter">
                    <input type="email" placeholder="Your email" class="newsletter-input">
                    <button class="newsletter-btn">Subscribe</button>
                </div>
            </div>
            
            <div class="footer-col">
                <h5>Four Pillars</h5>
                <div class="footer-list">
                    <a href="/metrics" class="footer-list-item">Transparency Engine</a>
                    <a href="/metrics" class="footer-list-item">Environmental Atlas</a>
                    <a href="/campaigns" class="footer-list-item">Civic Forum</a>
                    <a href="/technologies" class="footer-list-item">Innovation Lab</a>
                </div>
            </div>
            
            <div class="footer-col">
                <h5>Platform</h5>
                <div class="footer-list">
                    <a href="/case-studies" class="footer-list-item">Case Studies</a>
                    <a href="/events" class="footer-list-item">Events</a>
                    <a href="/campaigns" class="footer-list-item">Campaigns</a>
                    <a href="/metrics" class="footer-list-item">Metrics</a>
                </div>
            </div>
            
            <div class="footer-col">
                <h5>Resources</h5>
                <div class="footer-list">
                    <a href="#" class="footer-list-item">API Documentation</a>
                    <a href="#" class="footer-list-item">Open Datasets</a>
                    <a href="#" class="footer-list-item">Community Forum</a>
                    <a href="#" class="footer-list-item">Contact Us</a>
                </div>
            </div>
        </div>
        
        <div class="footer-bar">
            <div class="footer-meta">
                <span class="footer-meta-item">© 2026 Transparency.ie</span>
                <span class="footer-meta-item">Privacy</span>
                <span class="footer-meta-item">Terms</span>
                <span class="footer-meta-item">Accessibility</span>
            </div>
            <div style="font-size: 13px; color: var(--subtle);">
                Made with <span class="heart">❤️</span> for Ireland
            </div>
        </div>
    </div>
</footer>
