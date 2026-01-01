<!--
FOOTER OPTION 1: Minimalist Clean
Design Philosophy: Single-line elegant footer with centered links and social icons
- Minimal, zen-like approach
- All content in single horizontal line
- Centered alignment with clear hierarchy
- Simple yet sophisticated
- Glassy background matching design system

Usage: @include('components.footer-alt-1')
-->
<footer class="footer-alt1">
    <div class="footer-container-alt1">
        <div class="footer-content-alt1">
            <div class="footer-section-alt1">
                <a href="/" class="footer-brand-link-alt1">Transparency.ie</a>
                <span class="footer-divider-alt1">•</span>
            </div>
            
            <div class="footer-links-alt1">
                <a href="#about">About</a>
                <a href="#contact">Contact</a>
                <a href="#privacy">Privacy</a>
                <a href="#terms">Terms</a>
                <a href="#accessibility">Accessibility</a>
            </div>

            <span class="footer-divider-alt1">•</span>

            <div class="footer-social-alt1">
                <a href="#twitter" title="Twitter">𝕏</a>
                <a href="#github" title="GitHub">⚙️</a>
                <a href="#email" title="Email">✉️</a>
            </div>
        </div>

        <div class="footer-meta-alt1">
            <p>© 2025 Public Observatory Ireland. Built for transparency. Power to the people.</p>
        </div>
    </div>
</footer>

<style>
    .footer-alt1 {
        background: var(--panel);
        border-top: 1px solid var(--border);
        padding: 32px 0;
        margin-top: 80px;
    }

    .footer-container-alt1 {
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 32px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        text-align: center;
    }

    .footer-content-alt1 {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .footer-section-alt1,
    .footer-links-alt1,
    .footer-social-alt1 {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .footer-brand-link-alt1 {
        font-weight: 800;
        font-size: 14px;
        text-decoration: none;
        color: var(--ink);
        transition: opacity 200ms ease;
    }

    .footer-brand-link-alt1:hover {
        opacity: 0.6;
    }

    .footer-links-alt1 a,
    .footer-social-alt1 a {
        font-size: 13px;
        color: var(--subtle);
        text-decoration: none;
        transition: all 160ms ease;
    }

    .footer-links-alt1 a:hover {
        color: var(--ink);
    }

    .footer-social-alt1 a {
        font-size: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--card);
        border: 1px solid var(--border);
    }

    .footer-social-alt1 a:hover {
        background: var(--bg);
        border-color: var(--ink);
    }

    .footer-divider-alt1 {
        color: var(--border);
        font-size: 16px;
    }

    .footer-meta-alt1 {
        font-size: 12px;
        color: var(--subtle);
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .footer-alt1 {
            padding: 24px 0;
            margin-top: 60px;
        }

        .footer-container-alt1 {
            padding: 0 20px;
            gap: 16px;
        }

        .footer-content-alt1 {
            gap: 12px;
        }

        .footer-links-alt1,
        .footer-social-alt1 {
            gap: 12px;
        }

        .footer-divider-alt1 {
            display: none;
        }
    }

    @media (max-width: 480px) {
        .footer-container-alt1 {
            padding: 0 16px;
        }

        .footer-content-alt1 {
            flex-direction: column;
            gap: 12px;
        }

        .footer-links-alt1 {
            flex-wrap: wrap;
            justify-content: center;
        }

        .footer-links-alt1 a {
            font-size: 12px;
        }
    }
</style>
