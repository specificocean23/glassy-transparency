<?php

namespace App\Livewire;

use Livewire\Component;

class TransparencyDashboard extends Component
{
    public array $years = [
        ['year' => 2025, 'allocated' => 12000000, 'spent' => 9600000],
        ['year' => 2026, 'allocated' => 11000000, 'spent' => 8100000],
        ['year' => 2027, 'allocated' => 10200000, 'spent' => 4400000],
    ];

    public array $counties = [
        ['name' => 'Waterford', 'population' => 127000, 'allowance' => 4500000, 'spent' => 4200000],
        ['name' => 'Dublin', 'population' => 1480000, 'allowance' => 7600000, 'spent' => 5200000],
        ['name' => 'Cork', 'population' => 584000, 'allowance' => 5200000, 'spent' => 3700000],
        ['name' => 'Galway', 'population' => 282000, 'allowance' => 2600000, 'spent' => 1900000],
    ];

    public function getTotalsProperty(): array
    {
        $allocated = array_sum(array_column($this->years, 'allocated'));
        $spent = array_sum(array_column($this->years, 'spent'));
        $remaining = max($allocated - $spent, 0);

        return [
            'allocated' => $allocated,
            'spent' => $spent,
            'remaining' => $remaining,
            'compliance' => 0.94,
        ];
    }

    public function render()
    {
        return view('livewire.transparency-dashboard', [
            'totals' => $this->totals,
        ]);
    }
}
