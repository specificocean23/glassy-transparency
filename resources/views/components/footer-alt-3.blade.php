<!--
FOOTER OPTION 3: Pillar-Integrated Design
Design Philosophy: 4 columns matching the 4 pillars from navigation
- Each pillar has its own footer section
- Cohesive visual system matching navigation
- Content organized by pillar responsibility
- Beautiful thematic organization
- Creates visual continuity from header to footer

Usage: @include('components.footer-alt-3')
-->
<footer class="footer-alt3">
    <div class="footer-container-alt3">
        <div class="footer-pillars-alt3">
            <!-- Pillar 1: Transparency Engine -->
            <div class="footer-pillar-alt3">
                <div class="pillar-head-alt3">
                    <span class="pillar-icon-alt3">💰</span>
                    <h3 class="pillar-title-alt3">Transparency Engine</h3>
                </div>
                <nav class="pillar-nav-alt3">
                    <a href="/metrics">Budget Metrics</a>
                    <a href="#spending">Spending Tracker</a>
                    <a href="#data">Open Data</a>
                    <a href="#api">API Access</a>
                </nav>
            </div>

            <!-- Pillar 2: Environmental Atlas -->
            <div class="footer-pillar-alt3">
                <div class="pillar-head-alt3">
                    <span class="pillar-icon-alt3">🌍</span>
                    <h3 class="pillar-title-alt3">Environmental Atlas</h3>
                </div>
                <nav class="pillar-nav-alt3">
                    <a href="#climate">Climate Data</a>
                    <a href="#emissions">Emissions Tracker</a>
                    <a href="/technologies">Energy Solutions</a>
                    <a href="#sustainability">Sustainability Goals</a>
                </nav>
            </div>

            <!-- Pillar 3: Civic Forum -->
            <div class="footer-pillar-alt3">
                <div class="pillar-head-alt3">
                    <span class="pillar-icon-alt3">⚖️</span>
                    <h3 class="pillar-title-alt3">Civic Forum</h3>
                </div>
                <nav class="pillar-nav-alt3">
                    <a href="/campaigns">Active Campaigns</a>
                    <a href="#community">Community Forum</a>
                    <a href="#engagement">Get Involved</a>
                    <a href="#policy">Policy Wins</a>
                </nav>
            </div>

            <!-- Pillar 4: Innovation Lab -->
            <div class="footer-pillar-alt3">
                <div class="pillar-head-alt3">
                    <span class="pillar-icon-alt3">💡</span>
                    <h3 class="pillar-title-alt3">Innovation Lab</h3>
                </div>
                <nav class="pillar-nav-alt3">
                    <a href="/case-studies">Case Studies</a>
                    <a href="/events">Hackathons & Events</a>
                    <a href="#research">Research</a>
                    <a href="#collaborate">Collaborate</a>
                </nav>
            </div>
        </div>

        <div class="footer-divider-alt3"></div>

        <div class="footer-bottom-alt3">
            <div class="footer-info-alt3">
                <div class="footer-brand-alt3">
                    <div class="footer-badge-alt3">💎</div>
                    <div class="footer-text-alt3">
                        <p class="footer-name-alt3">Transparency.ie</p>
                        <p class="footer-mission-alt3">Power to the people. Transparency for all.</p>
                    </div>
                </div>
                <p class="footer-copyright-alt3">© 2025 Public Observatory Ireland. All rights reserved.</p>
            </div>

            <div class="footer-footer-links-alt3">
                <a href="#privacy">Privacy</a>
                <a href="#terms">Terms</a>
                <a href="#accessibility">Accessibility</a>
                <a href="#contact">Contact</a>
            </div>

            <div class="footer-footer-socials-alt3">
                <a href="#twitter" title="Twitter">𝕏</a>
                <a href="#github" title="GitHub">⚙️</a>
                <a href="#email" title="Email">✉️</a>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer-alt3 {
        background: var(--panel);
        border-top: 1px solid var(--border);
        padding: 60px 0 40px;
        margin-top: 100px;
    }

    .footer-container-alt3 {
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 32px;
        display: flex;
        flex-direction: column;
        gap: 48px;
    }

    .footer-pillars-alt3 {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 32px;
    }

    .footer-pillar-alt3 {
        display: flex;
        flex-direction: column;
        gap: 16px;
        padding: 20px;
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 12px;
        transition: all 200ms ease;
    }

    .footer-pillar-alt3:hover {
        border-color: var(--ink);
        transform: translateY(-2px);
    }

    .pillar-head-alt3 {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
    }

    .pillar-icon-alt3 {
        font-size: 20px;
    }

    .pillar-title-alt3 {
        margin: 0;
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--ink);
    }

    .pillar-nav-alt3 {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .pillar-nav-alt3 a {
        font-size: 12px;
        color: var(--subtle);
        text-decoration: none;
        transition: all 160ms ease;
        font-weight: 500;
    }

    .pillar-nav-alt3 a:hover {
        color: var(--ink);
        padding-left: 4px;
    }

    .footer-divider-alt3 {
        height: 1px;
        background: var(--border);
        margin: 20px 0;
    }

    .footer-bottom-alt3 {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 32px;
    }

    .footer-info-alt3 {
        display: flex;
        flex-direction: column;
        gap: 16px;
        flex: 1;
    }

    .footer-brand-alt3 {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .footer-badge-alt3 {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: var(--card);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .footer-text-alt3 {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .footer-name-alt3 {
        margin: 0;
        font-size: 14px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .footer-mission-alt3 {
        margin: 0;
        font-size: 11px;
        color: var(--subtle);
        font-weight: 600;
    }

    .footer-copyright-alt3 {
        margin: 0;
        font-size: 12px;
        color: var(--subtle);
        line-height: 1.6;
    }

    .footer-footer-links-alt3 {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .footer-footer-links-alt3 a {
        font-size: 12px;
        color: var(--subtle);
        text-decoration: none;
        transition: color 160ms ease;
    }

    .footer-footer-links-alt3 a:hover {
        color: var(--ink);
    }

    .footer-footer-socials-alt3 {
        display: flex;
        gap: 12px;
    }

    .footer-footer-socials-alt3 a {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--card);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: all 160ms ease;
        text-decoration: none;
    }

    .footer-footer-socials-alt3 a:hover {
        background: var(--bg);
        border-color: var(--ink);
        transform: translateY(-2px);
    }

    @media (max-width: 1024px) {
        .footer-pillars-alt3 {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .footer-container-alt3 {
            padding: 0 20px;
        }

        .footer-bottom-alt3 {
            flex-direction: column;
            gap: 24px;
        }

        .footer-footer-links-alt3 {
            justify-content: center;
        }

        .footer-footer-socials-alt3 {
            justify-content: center;
        }
    }

    @media (max-width: 640px) {
        .footer-alt3 {
            padding: 40px 0 24px;
            margin-top: 60px;
        }

        .footer-container-alt3 {
            padding: 0 16px;
            gap: 32px;
        }

        .footer-pillars-alt3 {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .footer-pillar-alt3 {
            padding: 16px;
        }

        .pillar-title-alt3 {
            font-size: 12px;
        }

        .pillar-nav-alt3 a {
            font-size: 11px;
        }

        .footer-divider-alt3 {
            margin: 16px 0;
        }

        .footer-bottom-alt3 {
            text-align: center;
        }

        .footer-brand-alt3 {
            justify-content: center;
        }

        .footer-footer-links-alt3 {
            flex-wrap: wrap;
            justify-content: center;
        }
    }
</style>
