<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Import - Transparency Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --primary: #2563eb;
            --success: #16a34a;
            --warning: #f59e0b;
            --danger: #dc2626;
        }
        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: #f8fafc;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .card {
            background: white;
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 24px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
        }
        .template-card {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            transition: all 200ms;
            cursor: pointer;
        }
        .template-card:hover {
            border-color: var(--primary);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.1);
            transform: translateY(-2px);
        }
        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 200ms;
            border: none;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary {
            background: var(--primary);
            color: white;
        }
        .btn-primary:hover {
            background: #1d4ed8;
        }
        .btn-success {
            background: var(--success);
            color: white;
        }
        .upload-zone {
            border: 2px dashed #cbd5e1;
            border-radius: 8px;
            padding: 48px;
            text-align: center;
            transition: all 200ms;
        }
        .upload-zone.dragover {
            border-color: var(--primary);
            background: #eff6ff;
        }
        .alert {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
        }
        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        h1, h2, h3 {
            margin-top: 0;
        }
        .icon {
            font-size: 48px;
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
    @include('components.nav-professional')

    <div class="container" style="margin-top: 80px;">
        <h1 style="font-size: 36px; margin-bottom: 8px;">📊 Data Import Center</h1>
        <p style="color: #64748b; margin-bottom: 32px;">Import budget, spending, revenue, and timeline data from Excel files</p>

        @if(session('success'))
            <div class="alert alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                ✗ {{ session('error') }}
            </div>
        @endif

        <!-- Download Templates -->
        <div class="card">
            <h2>📥 Download Templates</h2>
            <p style="color: #64748b; margin-bottom: 24px;">Start by downloading a template with the correct format and sample data</p>
            
            <div class="grid">
                <div class="template-card" onclick="window.location.href='/admin/import/template/budgets'">
                    <div class="icon">💰</div>
                    <h3>Budget Template</h3>
                    <p style="color: #64748b; font-size: 14px;">Annual budgets with allocated, spent, and predicted amounts</p>
                    <button class="btn btn-primary" style="margin-top: 16px;">Download</button>
                </div>

                <div class="template-card" onclick="window.location.href='/admin/import/template/spending'">
                    <div class="icon">💸</div>
                    <h3>Spending Template</h3>
                    <p style="color: #64748b; font-size: 14px;">Individual spending items and transactions</p>
                    <button class="btn btn-primary" style="margin-top: 16px;">Download</button>
                </div>

                <div class="template-card" onclick="window.location.href='/admin/import/template/revenue'">
                    <div class="icon">💵</div>
                    <h3>Revenue Template</h3>
                    <p style="color: #64748b; font-size: 14px;">Income streams and revenue sources</p>
                    <button class="btn btn-primary" style="margin-top: 16px;">Download</button>
                </div>

                <div class="template-card" onclick="window.location.href='/admin/import/template/timeline'">
                    <div class="icon">📅</div>
                    <h3>Timeline Template</h3>
                    <p style="color: #64748b; font-size: 14px;">Major events and milestones</p>
                    <button class="btn btn-primary" style="margin-top: 16px;">Download</button>
                </div>
            </div>
        </div>

        <!-- Upload Data -->
        <div class="card">
            <h2>📤 Upload Data</h2>
            <p style="color: #64748b; margin-bottom: 24px;">Fill in the template and upload it here</p>

            <form action="{{ route('admin.import.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div style="margin-bottom: 24px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">Data Type</label>
                    <select name="sheet_type" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 16px;">
                        <option value="">Select data type...</option>
                        <option value="budgets">Budget Data</option>
                        <option value="spending">Spending Items</option>
                        <option value="revenue">Revenue Streams</option>
                        <option value="timeline">Timeline Events</option>
                    </select>
                </div>

                <div class="upload-zone" id="uploadZone">
                    <div class="icon">📁</div>
                    <h3>Drop your Excel file here</h3>
                    <p style="color: #64748b; margin-bottom: 16px;">or click to browse</p>
                    <input type="file" name="file" id="fileInput" accept=".xlsx,.xls,.csv" required style="display: none;">
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('fileInput').click()">
                        Choose File
                    </button>
                    <div id="fileName" style="margin-top: 16px; font-weight: 600; color: var(--success);"></div>
                </div>

                <button type="submit" class="btn btn-success" style="margin-top: 24px; width: 100%; font-size: 16px;">
                    🚀 Import Data
                </button>
            </form>
        </div>

        <!-- Instructions -->
        <div class="card">
            <h2>📖 Import Instructions</h2>
            <ol style="line-height: 1.8; color: #475569;">
                <li><strong>Download</strong> the appropriate template above</li>
                <li><strong>Fill in</strong> your data following the sample row format</li>
                <li><strong>Keep</strong> the header row exactly as provided</li>
                <li><strong>Use</strong> consistent date formats (YYYY-MM-DD recommended)</li>
                <li><strong>Format</strong> amounts as numbers (commas and currency symbols will be stripped)</li>
                <li><strong>Select</strong> the data type matching your file</li>
                <li><strong>Upload</strong> and wait for confirmation</li>
            </ol>

            <div style="background: #fff7ed; border: 1px solid #fdba74; border-radius: 8px; padding: 16px; margin-top: 24px;">
                <strong>💡 Pro Tips:</strong>
                <ul style="margin: 8px 0 0 0; padding-left: 20px;">
                    <li>Excel dates should be formatted as dates, not text</li>
                    <li>Mark questionable/controversial items with "yes", "true", or "1"</li>
                    <li>Leave optional columns empty if data is not available</li>
                    <li>Import creates new records - it doesn't update existing ones</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        const uploadZone = document.getElementById('uploadZone');
        const fileInput = document.getElementById('fileInput');
        const fileName = document.getElementById('fileName');

        // Drag and drop handlers
        uploadZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadZone.classList.add('dragover');
        });

        uploadZone.addEventListener('dragleave', () => {
            uploadZone.classList.remove('dragover');
        });

        uploadZone.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadZone.classList.remove('dragover');
            
            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                fileName.textContent = '📎 ' + e.dataTransfer.files[0].name;
            }
        });

        // File input change handler
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length) {
                fileName.textContent = '📎 ' + e.target.files[0].name;
            }
        });

        // Template card click handler
        document.querySelectorAll('.template-card button').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
            });
        });
    </script>
</body>
</html>
