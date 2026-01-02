<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\EnvironmentalMetric;

class MetricsCounter extends Component
{
    public $metrics = [];
    public $selectedMetric = null;

    public function mount()
    {
        $this->loadMetrics();
    }

    public function loadMetrics()
    {
        $this->metrics = EnvironmentalMetric::where('is_featured', true)->limit(6)->get()->toArray();
        if (!empty($this->metrics)) {
            $this->selectedMetric = $this->metrics[0];
        }
    }

    public function selectMetric($index)
    {
        if (isset($this->metrics[$index])) {
            $this->selectedMetric = $this->metrics[$index];
        }
    }

    public function render()
    {
        return view('livewire.metrics-counter');
    }
}
