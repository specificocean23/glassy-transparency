<!--
FOOTER OPTION 2: Modern Grid
Design Philosophy: Organized 4-column layout with clear section categorization
- Product, Company, Resources, Legal sections
- Grid-based layout for easy scanning
- More comprehensive information architecture
- Professional corporate feel
- Responsive to 2 columns on mobile

Usage: @include('components.footer-alt-2')
-->
<footer class="footer-alt2">
    <div class="footer-container-alt2">
        <div class="footer-grid-alt2">
            <!-- Product Section -->
            <div class="footer-section-alt2">
                <h3 class="footer-section-title-alt2">Product</h3>
                <nav class="footer-section-nav-alt2">
                    <a href="/metrics">Metrics Dashboard</a>
                    <a href="/technologies">Technologies</a>
                    <a href="/case-studies">Case Studies</a>
                    <a href="/campaigns">Campaigns</a>
                    <a href="#apis">API Documentation</a>
                </nav>
            </div>

            <!-- Company Section -->
            <div class="footer-section-alt2">
                <h3 class="footer-section-title-alt2">Company</h3>
                <nav class="footer-section-nav-alt2">
                    <a href="#about">About Us</a>
                    <a href="#mission">Our Mission</a>
                    <a href="#team">Team</a>
                    <a href="#careers">Careers</a>
                    <a href="/events">Events & Hackathons</a>
                </nav>
            </div>

            <!-- Resources Section -->
            <div class="footer-section-alt2">
                <h3 class="footer-section-title-alt2">Resources</h3>
                <nav class="footer-section-nav-alt2">
                    <a href="#docs">Documentation</a>
                    <a href="#blog">Blog</a>
                    <a href="#data">Open Data</a>
                    <a href="#community">Community Forum</a>
                    <a href="#contact">Contact Us</a>
                </nav>
            </div>

            <!-- Legal Section -->
            <div class="footer-section-alt2">
                <h3 class="footer-section-title-alt2">Legal</h3>
                <nav class="footer-section-nav-alt2">
                    <a href="#privacy">Privacy Policy</a>
                    <a href="#terms">Terms of Service</a>
                    <a href="#cookies">Cookie Policy</a>
                    <a href="#security">Security</a>
                    <a href="#compliance">Compliance</a>
                </nav>
            </div>
        </div>

        <div class="footer-bottom-alt2">
            <div class="footer-branding-alt2">
                <div class="footer-badge-alt2">💎</div>
                <div>
                    <p class="footer-brand-name-alt2">Transparency.ie</p>
                    <p class="footer-tagline-alt2">Public Observatory | Power to the People</p>
                </div>
            </div>
            <p class="footer-copyright-alt2">© 2025 Public Observatory Ireland. All rights reserved.</p>
            <div class="footer-socials-alt2">
                <a href="#twitter">𝕏</a>
                <a href="#github">⚙️</a>
                <a href="#linkedin">💼</a>
                <a href="#email">✉️</a>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer-alt2 {
        background: var(--panel);
        border-top: 1px solid var(--border);
        padding: 64px 0 40px;
        margin-top: 100px;
    }

    .footer-container-alt2 {
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 32px;
        display: flex;
        flex-direction: column;
        gap: 48px;
    }

    .footer-grid-alt2 {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 40px;
    }

    .footer-section-alt2 {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .footer-section-title-alt2 {
        margin: 0;
        font-size: 14px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--ink);
    }

    .footer-section-nav-alt2 {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .footer-section-nav-alt2 a {
        font-size: 13px;
        color: var(--subtle);
        text-decoration: none;
        transition: all 160ms ease;
        font-weight: 500;
    }

    .footer-section-nav-alt2 a:hover {
        color: var(--ink);
        padding-left: 4px;
    }

    .footer-bottom-alt2 {
        border-top: 1px solid var(--border);
        padding-top: 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 32px;
    }

    .footer-branding-alt2 {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .footer-badge-alt2 {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--card);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .footer-brand-name-alt2 {
        margin: 0;
        font-size: 14px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .footer-tagline-alt2 {
        margin: 4px 0 0 0;
        font-size: 11px;
        color: var(--subtle);
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    .footer-copyright-alt2 {
        margin: 0;
        font-size: 12px;
        color: var(--subtle);
        flex: 1;
        text-align: center;
    }

    .footer-socials-alt2 {
        display: flex;
        gap: 12px;
    }

    .footer-socials-alt2 a {
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

    .footer-socials-alt2 a:hover {
        background: var(--bg);
        border-color: var(--ink);
        transform: translateY(-2px);
    }

    @media (max-width: 1024px) {
        .footer-grid-alt2 {
            grid-template-columns: repeat(2, 1fr);
            gap: 32px;
        }

        .footer-container-alt2 {
            padding: 0 20px;
        }

        .footer-bottom-alt2 {
            flex-wrap: wrap;
            gap: 16px;
        }
    }

    @media (max-width: 640px) {
        .footer-alt2 {
            padding: 40px 0 24px;
            margin-top: 60px;
        }

        .footer-container-alt2 {
            padding: 0 16px;
            gap: 32px;
        }

        .footer-grid-alt2 {
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .footer-bottom-alt2 {
            flex-direction: column;
            text-align: center;
        }

        .footer-copyright-alt2 {
            order: 2;
        }

        .footer-socials-alt2 {
            justify-content: center;
            order: 3;
        }
    }
</style>
