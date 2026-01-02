<div class="metrics-counter">
    @if(!empty($metrics))
        <div class="grid grid-3">
            @foreach($metrics as $index => $metric)
                <div class="stat-card reveal" wire:click="selectMetric({{ $index }})" 
                     style="cursor: pointer; @if($selectedMetric && $selectedMetric['id'] === $metric['id']) border: 2px solid var(--accent); @endif">
                    <div class="stat-label">{{ $metric['name'] ?? 'Metric' }}</div>
                    <div class="stat-number">{{ number_format($metric['value'] ?? 0, 1) }}</div>
                    <div class="stat-unit">{{ $metric['unit'] ?? '' }}</div>
                    <p class="subtle" style="margin-top: 12px;">{{ $metric['description'] ?? 'No description' }}</p>
                </div>
            @endforeach
        </div>
        
        @if($selectedMetric)
            <div class="panel reveal" style="margin-top: 40px;">
                <h3>{{ $selectedMetric['name'] ?? 'Metric Details' }}</h3>
                <p class="muted" style="font-size: 16px; line-height: 1.8; margin: 16px 0;">
                    {{ $selectedMetric['description'] ?? 'No details available' }}
                </p>
                <p class="subtle">
                    <strong>Unit:</strong> {{ $selectedMetric['unit'] ?? 'N/A' }}<br>
                    <strong>Last Updated:</strong> {{ $selectedMetric['updated_at'] ?? 'Unknown' }}
                </p>
            </div>
        @endif
    @else
        <div class="panel">
            <p class="muted">Loading metrics...</p>
        </div>
    @endif
</div>
