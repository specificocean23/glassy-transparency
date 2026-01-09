<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\SpendingItem;
use App\Models\RevenueStream;
use App\Models\TimelineEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DataImportController extends Controller
{
    /**
     * Show the import interface
     */
    public function index()
    {
        return view('admin.import');
    }

    /**
     * Import budget data from Excel
     */
    public function importBudgets(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:xlsx,xls,csv',
            'sheet_type' => 'required|in:budgets,spending,revenue,timeline',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $file = $request->file('file');
            $spreadsheet = IOFactory::load($file->getPathname());
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            // Remove header row
            $headers = array_shift($rows);
            
            $imported = 0;
            $errors = [];

            switch ($request->sheet_type) {
                case 'budgets':
                    $imported = $this->importBudgetsData($rows, $headers, $errors);
                    break;
                case 'spending':
                    $imported = $this->importSpendingData($rows, $headers, $errors);
                    break;
                case 'revenue':
                    $imported = $this->importRevenueData($rows, $headers, $errors);
                    break;
                case 'timeline':
                    $imported = $this->importTimelineData($rows, $headers, $errors);
                    break;
            }

            if (count($errors) > 0) {
                return back()->with('warning', "Imported $imported records with " . count($errors) . " errors.")
                    ->with('errors_detail', $errors);
            }

            return back()->with('success', "Successfully imported $imported records!");
            
        } catch (\Exception $e) {
            return back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    /**
     * Import budget data
     */
    private function importBudgetsData($rows, $headers, &$errors)
    {
        $imported = 0;
        
        // Expected columns: Year, Category, Department, Allocated, Spent, Predicted, Status, Source, Notes
        foreach ($rows as $index => $row) {
            try {
                if (empty($row[0]) || empty($row[1])) {
                    continue; // Skip empty rows
                }

                Budget::create([
                    'year' => $row[0],
                    'category' => $row[1],
                    'department' => $row[2] ?? null,
                    'allocated_amount' => $this->parseAmount($row[3] ?? 0),
                    'spent_amount' => $this->parseAmount($row[4] ?? 0),
                    'predicted_amount' => $this->parseAmount($row[5] ?? null),
                    'status' => $row[6] ?? 'active',
                    'source' => $row[7] ?? null,
                    'notes' => $row[8] ?? null,
                ]);
                
                $imported++;
            } catch (\Exception $e) {
                $errors[] = "Row " . ($index + 2) . ": " . $e->getMessage();
            }
        }
        
        return $imported;
    }

    /**
     * Import spending items
     */
    private function importSpendingData($rows, $headers, &$errors)
    {
        $imported = 0;
        
        // Expected columns: Date, Title, Description, Amount, Category, Department, Vendor, Location, Status, Questionable
        foreach ($rows as $index => $row) {
            try {
                if (empty($row[0]) || empty($row[1])) {
                    continue;
                }

                SpendingItem::create([
                    'date' => $this->parseDate($row[0]),
                    'title' => $row[1],
                    'description' => $row[2] ?? null,
                    'amount' => $this->parseAmount($row[3]),
                    'category' => $row[4] ?? 'Other',
                    'department' => $row[5] ?? null,
                    'vendor' => $row[6] ?? null,
                    'location' => $row[7] ?? null,
                    'status' => $row[8] ?? 'completed',
                    'is_questionable' => $this->parseBoolean($row[9] ?? false),
                    'public_interest_score' => intval($row[10] ?? 50),
                ]);
                
                $imported++;
            } catch (\Exception $e) {
                $errors[] = "Row " . ($index + 2) . ": " . $e->getMessage();
            }
        }
        
        return $imported;
    }

    /**
     * Import revenue streams
     */
    private function importRevenueData($rows, $headers, &$errors)
    {
        $imported = 0;
        
        // Expected columns: Date, Title, Description, Amount, Source Type, Source Name, Category, Recurring, Frequency
        foreach ($rows as $index => $row) {
            try {
                if (empty($row[0]) || empty($row[1])) {
                    continue;
                }

                RevenueStream::create([
                    'date' => $this->parseDate($row[0]),
                    'title' => $row[1],
                    'description' => $row[2] ?? null,
                    'amount' => $this->parseAmount($row[3]),
                    'source_type' => $row[4] ?? 'tax',
                    'source_name' => $row[5] ?? 'Unknown',
                    'category' => $row[6] ?? null,
                    'is_recurring' => $this->parseBoolean($row[7] ?? false),
                    'frequency' => $row[8] ?? null,
                ]);
                
                $imported++;
            } catch (\Exception $e) {
                $errors[] = "Row " . ($index + 2) . ": " . $e->getMessage();
            }
        }
        
        return $imported;
    }

    /**
     * Import timeline events
     */
    private function importTimelineData($rows, $headers, &$errors)
    {
        $imported = 0;
        
        // Expected columns: Date, Title, Description, Type, Amount, Category, Department, Impact, Featured, Controversial
        foreach ($rows as $index => $row) {
            try {
                if (empty($row[0]) || empty($row[1])) {
                    continue;
                }

                TimelineEvent::create([
                    'event_date' => $this->parseDate($row[0]),
                    'title' => $row[1],
                    'description' => $row[2] ?? null,
                    'event_type' => $row[3] ?? 'expense',
                    'amount' => $this->parseAmount($row[4] ?? null),
                    'category' => $row[5] ?? null,
                    'department' => $row[6] ?? null,
                    'impact_level' => $row[7] ?? 'medium',
                    'is_featured' => $this->parseBoolean($row[8] ?? false),
                    'is_controversial' => $this->parseBoolean($row[9] ?? false),
                ]);
                
                $imported++;
            } catch (\Exception $e) {
                $errors[] = "Row " . ($index + 2) . ": " . $e->getMessage();
            }
        }
        
        return $imported;
    }

    /**
     * Parse amount from various formats
     */
    private function parseAmount($value)
    {
        if (empty($value) || $value === null) {
            return null;
        }

        // Remove currency symbols, spaces, and commas
        $cleaned = preg_replace('/[€$£,\s]/', '', $value);
        
        return floatval($cleaned);
    }

    /**
     * Parse date from various formats
     */
    private function parseDate($value)
    {
        if (empty($value)) {
            return now();
        }

        try {
            return \Carbon\Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return now()->format('Y-m-d');
        }
    }

    /**
     * Parse boolean values
     */
    private function parseBoolean($value)
    {
        if (is_bool($value)) {
            return $value;
        }

        $value = strtolower(trim($value));
        return in_array($value, ['yes', 'true', '1', 'y']);
    }

    /**
     * Download template Excel files
     */
    public function downloadTemplate($type)
    {
        $templates = [
            'budgets' => [
                'headers' => ['Year', 'Category', 'Department', 'Allocated Amount', 'Spent Amount', 'Predicted Amount', 'Status', 'Source', 'Notes'],
                'sample' => [2026, 'Health', 'HSE', 25000000, 15000000, 24500000, 'active', 'Budget 2026', 'Main health allocation'],
            ],
            'spending' => [
                'headers' => ['Date', 'Title', 'Description', 'Amount', 'Category', 'Department', 'Vendor', 'Location', 'Status', 'Questionable', 'Interest Score'],
                'sample' => ['2025-01-01', 'Bike Racks Dublin', 'Installation of two bike racks', 140000, 'Infrastructure', 'Transport', 'ABC Ltd', 'Dublin', 'completed', 'yes', 95],
            ],
            'revenue' => [
                'headers' => ['Date', 'Title', 'Description', 'Amount', 'Source Type', 'Source Name', 'Category', 'Recurring', 'Frequency'],
                'sample' => ['2024-06-15', 'Google Tax Settlement', 'Back taxes settlement', 15000000, 'settlement', 'Google', 'Corporate Tax', 'no', 'one-time'],
            ],
            'timeline' => [
                'headers' => ['Date', 'Title', 'Description', 'Event Type', 'Amount', 'Category', 'Department', 'Impact Level', 'Featured', 'Controversial'],
                'sample' => ['2025-12-01', 'Bike Rack Controversy', 'Excessive spending on bike infrastructure', 'expense', 140000, 'Infrastructure', 'Transport', 'high', 'yes', 'yes'],
            ],
        ];

        if (!isset($templates[$type])) {
            abort(404);
        }

        $template = $templates[$type];
        
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Add headers
        $sheet->fromArray([$template['headers']], null, 'A1');
        
        // Add sample row
        $sheet->fromArray([$template['sample']], null, 'A2');
        
        // Style headers
        $headerStyle = [
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E0E0E0']
            ]
        ];
        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->applyFromArray($headerStyle);
        
        // Auto-size columns
        foreach (range('A', $sheet->getHighestColumn()) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        
        $filename = "transparency_template_{$type}_" . date('Y-m-d') . ".xlsx";
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }
}
