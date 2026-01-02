<!DOCTYPE html>
<html><head><title>Test</title>
<style>
:root { --bg: #f8f8f8; --panel: #ffffff; --subtle: #666666; --ink: #1a1a1a; --border: #e0e0e0; --blur: blur(20px); --card: #ffffff; }
body { font-family: system-ui; background: var(--bg); color: var(--ink); margin: 0; }
</style>
</head>
<body>
@include('components.navigation')
<div style="padding: 100px 20px; text-align: center;">
<h1>Homepage Works!</h1>
<p>Navigation should be above.</p>
<a href="/dashboard">Dashboard</a> | <a href="/metrics">Metrics</a> | <a href="/admin">Admin</a>
</div>
@include('components.footer-alt-1')
</body></html>
