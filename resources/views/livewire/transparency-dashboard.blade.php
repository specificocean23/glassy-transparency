<div>
    <div class="grid-two">
        <div class="panel">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:10px; margin-bottom:10px;">
            <div>
                <strong>Spending vs Allowance</strong>
                <p class="muted" style="margin:4px 0 0;">Live view by year</p>
            </div>
            <span class="badge">Updated nightly</span>
        </div>
        <div class="list" style="gap:12px;">
            @php $maxAllowance = max(array_column($years, 'allocated')); @endphp
            @foreach($years as $row)
                @php
                    $percent = $maxAllowance > 0 ? round(($row['spent'] / $row['allocated']) * 100) : 0;
                    $barWidth = $maxAllowance > 0 ? round(($row['spent'] / $maxAllowance) * 100) : 0;
                @endphp
                <div style="border:1px solid var(--border); border-radius:10px; padding:10px 12px;">
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <strong>{{ $row['year'] }}</strong>
                        <span class="muted">€{{ number_format($row['spent']/1000000, 2) }}M / €{{ number_format($row['allocated']/1000000, 2) }}M</span>
                    </div>
                    <div style="background:#eef2ff; border-radius:999px; overflow:hidden; margin-top:8px; height:12px;">
                        <div style="width: {{ $barWidth }}%; background:#0f172a; height:100%;"></div>
                    </div>
                    <div class="muted" style="margin-top:6px; font-size:12px;">{{ $percent }}% of allowance</div>
                </div>
            @endforeach
        </div>
    </div>

        <div class="panel">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:10px; margin-bottom:10px;">
            <div>
                <strong>County Share & Population</strong>
                <p class="muted" style="margin:4px 0 0;">Proportional spend vs population</p>
            </div>
            <span class="badge">Balance view</span>
        </div>
        <div class="list" style="gap:12px;">
            @php
                $maxPopulation = max(array_column($counties, 'population'));
                $maxAllowance = max(array_column($counties, 'allowance'));
            @endphp
            @foreach($counties as $county)
                @php
                    $popShare = $maxPopulation > 0 ? round(($county['population'] / $maxPopulation) * 100) : 0;
                    $allowanceShare = $maxAllowance > 0 ? round(($county['allowance'] / $maxAllowance) * 100) : 0;
                @endphp
                <div style="border:1px solid var(--border); border-radius:10px; padding:10px 12px;">
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <strong>{{ $county['name'] }}</strong>
                        <span class="muted">Pop {{ number_format($county['population']) }}</span>
                    </div>
                    <div style="display:grid; gap:6px; margin-top:8px;">
                        <div style="display:flex; justify-content:space-between; font-size:12px;">
                            <span>Allowance</span>
                            <span class="muted">€{{ number_format($county['allowance']/1000000, 2) }}M</span>
                        </div>
                        <div style="background:#f1f5f9; border-radius:999px; overflow:hidden; height:10px;">
                            <div style="width: {{ $allowanceShare }}%; background:#0f172a; height:100%;"></div>
                        </div>
                        <div style="display:flex; justify-content:space-between; font-size:12px;">
                            <span>Population</span>
                            <span class="muted">{{ $popShare }}% of max</span>
                        </div>
                        <div style="background:#e2e8f0; border-radius:999px; overflow:hidden; height:10px;">
                            <div style="width: {{ $popShare }}%; background:#334155; height:100%;"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

    <div class="panel" style="margin-top:16px; display:grid; gap:8px;">
    <div style="display:flex; justify-content:space-between; align-items:center; gap:10px;">
        <div>
            <strong>Signals</strong>
            <p class="muted" style="margin:4px 0 0;">How close we are to allowances</p>
        </div>
        <span class="badge">Compliance {{ round($totals['compliance'] * 100) }}%</span>
    </div>
    <div class="stats-grid">
        <div class="stat-card">
            <span class="stat-label">Allowances</span>
            <span class="stat-value">€{{ number_format($totals['allocated']/1000000, 1) }}M</span>
            <span class="stat-trend">Baseline</span>
        </div>
        <div class="stat-card">
            <span class="stat-label">Spent</span>
            <span class="stat-value">€{{ number_format($totals['spent']/1000000, 1) }}M</span>
            <span class="stat-trend">{{ round(($totals['spent']/$totals['allocated']) * 100) }}% used</span>
        </div>
        <div class="stat-card">
            <span class="stat-label">Remaining</span>
            <span class="stat-value">€{{ number_format($totals['remaining']/1000000, 1) }}M</span>
            <span class="stat-trend warn">Buffer {{ round(($totals['remaining']/$totals['allocated']) * 100) }}%</span>
        </div>
        <div class="stat-card">
            <span class="stat-label">Run Rate</span>
            <span class="stat-value">€1.74M / mo</span>
            <span class="stat-trend">On track with alerting</span>
        </div>
    </div>
</div>
    
</div>
