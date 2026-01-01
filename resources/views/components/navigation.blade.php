<!-- Navigation Component - Option 1 (Concise Pillar-Based with Hover Submenus) -->
<nav class="nav-wrapper">
	<div class="nav-container">
		<a class="nav-brand" href="/">
			<div class="nav-badge">✦</div>
			<div class="nav-brand-text">
				<div class="nav-brand-title">Transparency.ie</div>
				<div class="nav-brand-sub">Budgets • Climate • Civic</div>
			</div>
		</a>

		<div class="nav-primary">
			<div class="nav-pillar">
				<a href="/metrics" class="nav-pillar-link">
					<span class="nav-pillar-icon">💰</span>
					<span class="nav-pillar-name">Transparency</span>
					<span class="nav-indicator">▾</span>
				</a>
				<div class="nav-submenu">
					<a href="/metrics">Dashboards</a>
					<a href="/metrics#departments">Departments</a>
					<a href="/metrics#spending">Spending</a>
				</div>
			</div>

			<div class="nav-pillar">
				<a href="/metrics" class="nav-pillar-link">
					<span class="nav-pillar-icon">🌍</span>
					<span class="nav-pillar-name">Environment</span>
					<span class="nav-indicator">▾</span>
				</a>
				<div class="nav-submenu">
					<a href="/metrics#emissions">Emissions</a>
					<a href="/metrics#renewables">Renewables</a>
					<a href="/technologies">Energy Tech</a>
				</div>
			</div>

			<div class="nav-pillar">
				<a href="/campaigns" class="nav-pillar-link">
					<span class="nav-pillar-icon">⚖️</span>
					<span class="nav-pillar-name">Civic</span>
					<span class="nav-indicator">▾</span>
				</a>
				<div class="nav-submenu">
					<a href="/campaigns">Campaigns</a>
					<a href="/events">Events</a>
					<a href="/case-studies">Wins</a>
				</div>
			</div>

			<div class="nav-pillar">
				<a href="/technologies" class="nav-pillar-link">
					<span class="nav-pillar-icon">💡</span>
					<span class="nav-pillar-name">Innovation</span>
					<span class="nav-indicator">▾</span>
				</a>
				<div class="nav-submenu">
					<a href="/technologies">Tech</a>
					<a href="/case-studies">Case Studies</a>
					<a href="/events">Hackathons</a>
				</div>
			</div>
		</div>

		<div class="nav-secondary">
			<button class="nav-theme-toggle" onclick="toggleTheme()" title="Toggle theme">☀️</button>
			<a href="/dashboard" class="nav-btn ghost">Dashboard</a>
			@auth
				<a href="/logout" class="nav-btn">Sign Out</a>
			@else
				<a href="/login" class="nav-btn">Sign In</a>
			@endauth
		</div>
	</div>
</nav>

<style>
	.nav-wrapper {
		position: sticky;
		top: 0;
		z-index: 1000;
		background: rgba(255,255,255,0.9);
		border-bottom: 1px solid var(--border);
		backdrop-filter: var(--blur);
		box-shadow: 0 8px 30px rgba(0,0,0,0.06);
	}
	:root.dark .nav-wrapper {
		background: rgba(26,26,26,0.9);
		box-shadow: 0 8px 30px rgba(0,0,0,0.25);
	}

	.nav-container {
		max-width: 1320px;
		margin: 0 auto;
		padding: 10px 28px;
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 24px;
	}

	.nav-brand {
		display: flex;
		align-items: center;
		gap: 10px;
		text-decoration: none;
		color: inherit;
		flex-shrink: 0;
	}
	.nav-badge {
		width: 38px;
		height: 38px;
		border-radius: 50%;
		background: var(--card);
		border: 1.5px solid var(--border);
		display: grid;
		place-items: center;
		font-size: 16px;
		font-weight: 800;
	}
	.nav-brand-text { display: flex; flex-direction: column; gap: 2px; }
	.nav-brand-title { font-size: 16px; font-weight: 800; letter-spacing: -0.4px; }
	.nav-brand-sub { font-size: 11px; color: var(--subtle); }

	.nav-primary {
		display: flex;
		align-items: center;
		gap: 6px;
		flex: 1;
		min-width: 0;
	}
	.nav-pillar { position: relative; }
	.nav-pillar-link {
		display: inline-flex;
		align-items: center;
		gap: 6px;
		padding: 8px 12px;
		border-radius: 8px;
		border: 1px solid transparent;
		font-size: 13px;
		font-weight: 700;
		color: inherit;
		text-decoration: none;
		transition: all 140ms ease;
	}
	.nav-pillar-link:hover {
		background: var(--card);
		border-color: var(--border);
	}
	.nav-pillar-icon { font-size: 15px; }
	.nav-indicator { font-size: 12px; opacity: 0.6; transition: transform 160ms ease; }
	.nav-pillar:hover .nav-indicator { transform: translateY(2px); }

	.nav-submenu {
		position: absolute;
		top: 100%;
		left: 0;
		margin-top: 6px;
		background: var(--panel);
		border: 1px solid var(--border);
		border-radius: 10px;
		padding: 6px;
		min-width: 180px;
		box-shadow: 0 16px 40px rgba(0,0,0,0.12);
		opacity: 0;
		visibility: hidden;
		transform: translateY(-4px);
		transition: all 140ms ease;
		pointer-events: none;
	}
	.nav-pillar:hover .nav-submenu,
	.nav-pillar:focus-within .nav-submenu {
		opacity: 1;
		visibility: visible;
		transform: translateY(0);
		pointer-events: auto;
	}
	.nav-submenu a {
		display: block;
		padding: 10px;
		border-radius: 6px;
		font-size: 12px;
		font-weight: 600;
		color: var(--ink);
		text-decoration: none;
		transition: all 140ms ease;
	}
	.nav-submenu a:hover { background: var(--bg); padding-left: 12px; }

	.nav-secondary {
		display: flex;
		align-items: center;
		gap: 8px;
		flex-shrink: 0;
	}
	.nav-theme-toggle {
		width: 38px;
		height: 38px;
		border: 1px solid var(--border);
		border-radius: 8px;
		background: var(--card);
		font-size: 17px;
		cursor: pointer;
		transition: all 140ms ease;
		display: grid;
		place-items: center;
	}
	.nav-theme-toggle:hover { border-color: var(--ink); background: var(--bg); }

	.nav-btn {
		padding: 9px 14px;
		border-radius: 8px;
		border: 1.25px solid var(--ink);
		background: var(--ink);
		color: var(--bg);
		font-weight: 700;
		font-size: 12px;
		text-decoration: none;
		transition: all 140ms ease;
	}
	.nav-btn:hover { transform: translateY(-1px); box-shadow: 0 10px 24px rgba(0,0,0,0.12); }
	.nav-btn.ghost { background: transparent; color: var(--ink); }
	.nav-btn.ghost:hover { background: var(--card); }

	@media (max-width: 1024px) {
		.nav-container { gap: 14px; padding: 10px 18px; }
		.nav-primary { gap: 4px; }
		.nav-brand-title { font-size: 15px; }
		.nav-brand-sub { display: none; }
	}

	@media (max-width: 640px) {
		.nav-container { flex-wrap: wrap; gap: 10px; }
		.nav-brand { width: 100%; }
		.nav-primary { order: 3; width: 100%; flex-wrap: wrap; }
		.nav-pillar-link { padding: 8px 10px; font-size: 12px; }
		.nav-pillar-name { display: none; }
		.nav-secondary { width: 100%; justify-content: flex-start; }
	}
</style>

<script>
(() => {
	const updateNavThemeIcon = () => {
		const btn = document.querySelector('.nav-theme-toggle');
		if (!btn) return;
		btn.textContent = document.documentElement.classList.contains('dark') ? '🌙' : '☀️';
	};
	updateNavThemeIcon();
	window.addEventListener('storage', updateNavThemeIcon);
})();
</script>
