@extends('layouts.app')

@section('title', 'Waterford Council Spending')

@section('styles')
<style>
    /* ===== Waterford Green Theme ===== */
    :root {
        --wf-green-dark: #1a472a;
        --wf-green-main: #2d6a4f;
        --wf-green-light: #40916c;
        --wf-green-pale: #52b788;
        --wf-green-mint: #74c69d;
        --wf-green-bg: #f1faee;
        --wf-text: #1a472a;
        --wf-border: #d9e8df;
        --wf-accent: #e63946;
    }
    
    :root.dark {
        --wf-green-dark: #0d2818;
        --wf-green-main: #1b4332;
        --wf-green-light: #2d6a4f;
        --wf-green-pale: #40916c;
        --wf-green-mint: #52b788;
        --wf-green-bg: #1a1a1a;
        --wf-text: #e8f5e9;
        --wf-border: #263238;
    }
    
    body {
        background: linear-gradient(135deg, var(--wf-green-bg) 0%, #fff 50%, var(--wf-green-bg) 100%);
    }
    
    :root.dark body {
        background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 50%, #0a0a0a 100%);
    }
    
    /* ===== Header Section ===== */
    .wf-header {
        background: linear-gradient(135deg, var(--wf-green-dark) 0%, var(--wf-green-main) 100%);
        color: #fff;
        padding: 60px 32px;
        margin: 0;
        border-bottom: 4px solid var(--wf-green-light);
        text-align: center;
    }
    
    .wf-header h1 {
        font-size: 48px;
        font-weight: 900;
        margin: 0 0 16px 0;
        letter-spacing: -1px;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }
    
    .wf-header p {
        font-size: 18px;
        opacity: 0.95;
        margin: 0;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    
    /* ===== Content Container ===== */
    .wf-container {
        max-width: 1300px;
        margin: 0 auto;
        padding: 60px 32px;
    }
    
    /* ===== Stats Cards ===== */
    .wf-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 24px;
        margin-bottom: 60px;
    }
    
    .wf-stat-card {
        background: var(--wf-green-bg);
        border: 2px solid var(--wf-green-light);
        border-radius: 12px;
        padding: 28px;
        text-align: center;
        transition: all 280ms ease;
        box-shadow: 0 2px 8px rgba(26, 71, 42, 0.1);
    }
    
    :root.dark .wf-stat-card {
        background: #252525;
        border-color: var(--wf-green-main);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }
    
    .wf-stat-card:hover {
        transform: translateY(-8px);
        border-color: var(--wf-green-pale);
        box-shadow: 0 12px 28px rgba(26, 71, 42, 0.15);
    }
    
    .wf-stat-icon {
        font-size: 32px;
        margin-bottom: 12px;
    }
    
    .wf-stat-amount {
        font-size: 28px;
        font-weight: 900;
        color: var(--wf-green-main);
        margin: 8px 0;
    }
    
    :root.dark .wf-stat-amount {
        color: var(--wf-green-pale);
    }
    
    .wf-stat-label {
        font-size: 14px;
        color: var(--wf-text);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    /* ===== Section Heading ===== */
    .wf-section-heading {
        font-size: 32px;
        font-weight: 900;
        color: var(--wf-green-main);
        margin: 48px 0 32px 0;
        padding-bottom: 16px;
        border-bottom: 4px solid var(--wf-green-light);
        display: inline-block;
    }
    
    :root.dark .wf-section-heading {
        color: var(--wf-green-mint);
        border-bottom-color: var(--wf-green-main);
    }
    
    /* ===== Spending Table ===== */
    .wf-table-container {
        background: var(--wf-green-bg);
        border: 2px solid var(--wf-border);
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 40px;
        box-shadow: 0 2px 8px rgba(26, 71, 42, 0.1);
    }
    
    :root.dark .wf-table-container {
        background: #252525;
        border-color: var(--wf-green-main);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }
    
    .wf-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .wf-table thead {
        background: linear-gradient(135deg, var(--wf-green-main), var(--wf-green-light));
        color: #fff;
    }
    
    :root.dark .wf-table thead {
        background: linear-gradient(135deg, var(--wf-green-dark), var(--wf-green-main));
    }
    
    .wf-table th {
        padding: 18px;
        text-align: left;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid var(--wf-green-pale);
    }
    
    .wf-table td {
        padding: 18px;
        border-bottom: 1px solid var(--wf-border);
        color: var(--wf-text);
    }
    
    :root.dark .wf-table td {
        border-bottom-color: var(--wf-green-main);
    }
    
    .wf-table tbody tr:hover {
        background: rgba(74, 193, 136, 0.05);
    }
    
    :root.dark .wf-table tbody tr:hover {
        background: rgba(74, 193, 136, 0.1);
    }
    
    .wf-table tbody tr:last-child td {
        border-bottom: none;
    }
    
    .wf-amount {
        font-weight: 700;
        color: var(--wf-green-main);
        font-size: 14px;
    }
    
    :root.dark .wf-amount {
        color: var(--wf-green-pale);
    }
    
    .wf-percentage {
        display: inline-block;
        padding: 4px 10px;
        background: var(--wf-green-light);
        color: #fff;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
    }
    
    /* ===== Chart Container ===== */
    .wf-chart-container {
        background: var(--wf-green-bg);
        border: 2px solid var(--wf-border);
        border-radius: 12px;
        padding: 32px;
        margin-bottom: 40px;
        box-shadow: 0 2px 8px rgba(26, 71, 42, 0.1);
    }
    
    :root.dark .wf-chart-container {
        background: #252525;
        border-color: var(--wf-green-main);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }
    
    /* ===== Bar Chart ===== */
    .wf-bar-chart {
        display: grid;
        gap: 24px;
    }
    
    .wf-chart-item {
        display: grid;
        grid-template-columns: 140px 1fr 120px;
        align-items: center;
        gap: 16px;
    }
    
    .wf-chart-label {
        font-size: 13px;
        font-weight: 600;
        color: var(--wf-text);
    }
    
    .wf-chart-bar {
        height: 32px;
        background: linear-gradient(90deg, var(--wf-green-light), var(--wf-green-pale));
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(26, 71, 42, 0.2);
        transition: all 200ms ease;
    }
    
    :root.dark .wf-chart-bar {
        box-shadow: 0 2px 6px rgba(74, 193, 136, 0.2);
    }
    
    .wf-chart-item:hover .wf-chart-bar {
        box-shadow: 0 4px 12px rgba(26, 71, 42, 0.3);
        transform: scaleY(1.1);
    }
    
    .wf-chart-value {
        font-weight: 700;
        color: var(--wf-green-main);
        text-align: right;
    }
    
    :root.dark .wf-chart-value {
        color: var(--wf-green-pale);
    }
    
    /* ===== Call to Action ===== */
    .wf-cta-section {
        background: linear-gradient(135deg, var(--wf-green-main), var(--wf-green-light));
        color: #fff;
        padding: 48px 32px;
        border-radius: 12px;
        text-align: center;
        margin: 60px 0;
        box-shadow: 0 8px 24px rgba(26, 71, 42, 0.2);
    }
    
    .wf-cta-section h2 {
        font-size: 28px;
        font-weight: 900;
        margin: 0 0 16px 0;
    }
    
    .wf-cta-section p {
        font-size: 16px;
        opacity: 0.95;
        margin: 0 0 24px 0;
    }
    
    .wf-cta-btn {
        display: inline-block;
        padding: 14px 32px;
        background: #fff;
        color: var(--wf-green-main);
        border: none;
        border-radius: 6px;
        font-weight: 700;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 200ms ease;
        text-decoration: none;
    }
    
    .wf-cta-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
    }
    
    /* ===== Footer Notes ===== */
    .wf-notes {
        background: var(--wf-green-bg);
        border-left: 4px solid var(--wf-green-light);
        padding: 24px;
        border-radius: 6px;
        margin-top: 40px;
        font-size: 14px;
        color: var(--wf-text);
    }
    
    :root.dark .wf-notes {
        background: #252525;
        border-left-color: var(--wf-green-main);
    }
    
    .wf-notes strong {
        color: var(--wf-green-main);
    }
    
    /* ===== Responsive ===== */
    @media (max-width: 768px) {
        .wf-header {
            padding: 40px 20px;
        }
        
        .wf-header h1 {
            font-size: 32px;
        }
        
        .wf-container {
            padding: 40px 20px;
        }
        
        .wf-section-heading {
            font-size: 24px;
        }
        
        .wf-stats {
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 16px;
        }
        
        .wf-stat-card {
            padding: 20px;
        }
        
        .wf-chart-item {
            grid-template-columns: 100px 1fr 80px;
            gap: 12px;
        }
        
        .wf-cta-section {
            padding: 32px 20px;
        }
        
        .wf-cta-section h2 {
            font-size: 22px;
        }
    }
</style>
@endsection

@section('content')
<!-- Header -->
<div class="wf-header">
    <h1>🏛️ Waterford Council Spending</h1>
    <p>Transparent financial overview of Waterford Council's budget allocation and spending initiatives</p>
</div>

<!-- Main Content -->
<div class="wf-container">
    <!-- Key Statistics -->
    <div class="wf-stats">
        <div class="wf-stat-card">
            <div class="wf-stat-icon">💰</div>
            <div class="wf-stat-amount">€287.5M</div>
            <div class="wf-stat-label">Total Budget</div>
        </div>
        <div class="wf-stat-card">
            <div class="wf-stat-icon">✅</div>
            <div class="wf-stat-amount">68%</div>
            <div class="wf-stat-label">Allocated</div>
        </div>
        <div class="wf-stat-card">
            <div class="wf-stat-icon">📊</div>
            <div class="wf-stat-amount">32%</div>
            <div class="wf-stat-label">Reserved</div>
        </div>
        <div class="wf-stat-card">
            <div class="wf-stat-icon">🏗️</div>
            <div class="wf-stat-amount">127</div>
            <div class="wf-stat-label">Projects Active</div>
        </div>
    </div>
    
    <!-- Spending by Department -->
    <h2 class="wf-section-heading">📈 Spending by Department</h2>
    <div class="wf-table-container">
        <table class="wf-table">
            <thead>
                <tr>
                    <th>Department</th>
                    <th>Budget Allocation</th>
                    <th>Spent</th>
                    <th>% of Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Infrastructure & Transport</strong></td>
                    <td class="wf-amount">€94.2M</td>
                    <td class="wf-amount">€68.5M</td>
                    <td><span class="wf-percentage">32.8%</span></td>
                </tr>
                <tr>
                    <td><strong>Education & Youth Services</strong></td>
                    <td class="wf-amount">€72.5M</td>
                    <td class="wf-amount">€51.3M</td>
                    <td><span class="wf-percentage">22.4%</span></td>
                </tr>
                <tr>
                    <td><strong>Social Services & Housing</strong></td>
                    <td class="wf-amount">€56.8M</td>
                    <td class="wf-amount">€42.1M</td>
                    <td><span class="wf-percentage">18.4%</span></td>
                </tr>
                <tr>
                    <td><strong>Environmental & Parks</strong></td>
                    <td class="wf-amount">€38.4M</td>
                    <td class="wf-amount">€28.9M</td>
                    <td><span class="wf-percentage">12.6%</span></td>
                </tr>
                <tr>
                    <td><strong>Health & Community</strong></td>
                    <td class="wf-amount">€25.6M</td>
                    <td class="wf-amount">€19.2M</td>
                    <td><span class="wf-percentage">8.4%</span></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Spending Breakdown Chart -->
    <h2 class="wf-section-heading">💵 Budget Allocation Breakdown</h2>
    <div class="wf-chart-container">
        <div class="wf-bar-chart">
            <div class="wf-chart-item">
                <div class="wf-chart-label">Infrastructure</div>
                <div class="wf-chart-bar" style="width: 100%; background: linear-gradient(90deg, #40916c, #52b788);"></div>
                <div class="wf-chart-value">32.8%</div>
            </div>
            <div class="wf-chart-item">
                <div class="wf-chart-label">Education</div>
                <div class="wf-chart-bar" style="width: 68%; background: linear-gradient(90deg, #40916c, #52b788);"></div>
                <div class="wf-chart-value">22.4%</div>
            </div>
            <div class="wf-chart-item">
                <div class="wf-chart-label">Social Services</div>
                <div class="wf-chart-bar" style="width: 56%; background: linear-gradient(90deg, #40916c, #52b788);"></div>
                <div class="wf-chart-value">18.4%</div>
            </div>
            <div class="wf-chart-item">
                <div class="wf-chart-label">Environment</div>
                <div class="wf-chart-bar" style="width: 38%; background: linear-gradient(90deg, #40916c, #52b788);"></div>
                <div class="wf-chart-value">12.6%</div>
            </div>
            <div class="wf-chart-item">
                <div class="wf-chart-label">Health</div>
                <div class="wf-chart-bar" style="width: 25%; background: linear-gradient(90deg, #40916c, #52b788);"></div>
                <div class="wf-chart-value">8.4%</div>
            </div>
        </div>
    </div>
    
    <!-- 2026 Key Initiatives -->
    <h2 class="wf-section-heading">🎯 2026 Key Initiatives</h2>
    <div class="wf-table-container">
        <table class="wf-table">
            <thead>
                <tr>
                    <th>Initiative</th>
                    <th>Department</th>
                    <th>Investment</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Waterford Greenway Extension</strong></td>
                    <td>Infrastructure</td>
                    <td class="wf-amount">€18.5M</td>
                    <td><span class="wf-percentage" style="background: #2d6a4f;">In Progress</span></td>
                </tr>
                <tr>
                    <td><strong>School Infrastructure Modernization</strong></td>
                    <td>Education</td>
                    <td class="wf-amount">€14.2M</td>
                    <td><span class="wf-percentage" style="background: #2d6a4f;">In Progress</span></td>
                </tr>
                <tr>
                    <td><strong>Sustainable Housing Program</strong></td>
                    <td>Social Services</td>
                    <td class="wf-amount">€12.8M</td>
                    <td><span class="wf-percentage" style="background: #74c69d;">Planned</span></td>
                </tr>
                <tr>
                    <td><strong>Smart City & Digital Innovation</strong></td>
                    <td>Infrastructure</td>
                    <td class="wf-amount">€8.6M</td>
                    <td><span class="wf-percentage" style="background: #74c69d;">Planned</span></td>
                </tr>
                <tr>
                    <td><strong>Climate Action & Green Spaces</strong></td>
                    <td>Environment</td>
                    <td class="wf-amount">€7.3M</td>
                    <td><span class="wf-percentage" style="background: #52b788;">Approved</span></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Call to Action -->
    <div class="wf-cta-section">
        <h2>Want more transparency?</h2>
        <p>Explore detailed budget documents, project timelines, and citizen engagement initiatives</p>
        <a href="/transparency-portal" class="wf-cta-btn">📊 View Full Portal</a>
    </div>
    
    <!-- Footnotes -->
    <div class="wf-notes">
        <p><strong>📌 Note:</strong> All figures are provisional estimates for the 2026 fiscal year. Data is updated quarterly. For detailed breakdowns and project-specific information, visit our <a href="/transparency-portal" style="color: var(--wf-green-light); text-decoration: none; font-weight: 700;">Transparency Portal</a>.</p>
    </div>
</div>
@endsection
