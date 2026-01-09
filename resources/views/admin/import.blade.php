<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Import - Transparency Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --bg: #f8fafc;
            --panel: #ffffff;
            --subtle: #64748b;
            --ink: #0f172a;
            --border: #e2e8f0;
            --accent: #1e3a8a;
            --accent-light: #3b82f6;
            --success: #16a34a;
            --warning: #ea580c;
            --danger: #dc2626;
        }

        :root.dark {
            --bg: #0f172a;
            --panel: #1e293b;
            --subtle: #cbd5e1;
            --ink: #f1f5f9;
            --border: #334155;
            --accent: #60a5fa;
            --accent-light: #93c5fd;
            --success: #4ade80;
            --warning: #fb923c;
            --danger: #ef4444;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: var(--bg);
            color: var(--ink);
            margin: 0;
            padding: 20px;
            transition: background-color 200ms ease, color 200ms ease;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .card {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            margin-bottom: 24px;
            transition: all 200ms ease;
        }

        :root.dark .card {
            box-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }

        .card:hover {
            border-color: var(--accent);
            box-shadow: 0 4px 12px rgba(30, 58, 138, 0.12);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
        }

        .template-card {
            border: 2px solid var(--border);
            border-radius: 8px;
            padding: 20px;
            background: var(--panel);
            transition: all 200ms ease;
            cursor: pointer;
        }

        .template-card:hover {
            border-color: var(--accent);
            box-shadow: 0 4px 12px rgba(30, 58, 138, 0.15);
            transform: translateY(-2px);
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 200ms ease;
            border: none;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: var(--accent);
            color: white;
            box-shadow: 0 2px 8px rgba(30, 58, 138, 0.2);
        }

        .btn-primary:hover {
            background: var(--accent-light);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30, 58, 138, 0.25);
        }

        .btn-success {
            background: var(--success);
            color: white;
            box-shadow: 0 2px 8px rgba(22, 163, 74, 0.2);
        }

        .btn-success:hover {
            background: #15803d;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(22, 163, 74, 0.25);
        }

        .upload-zone {
            border: 2px dashed var(--border);
            border-radius: 8px;
            padding: 48px;
            text-align: center;
            transition: all 200ms ease;
            background: var(--panel);
        }

        .upload-zone.dragover {
            border-color: var(--accent);
            background: rgba(30, 58, 138, 0.05);
        }

        :root.dark .upload-zone.dragover {
            background: rgba(96, 165, 250, 0.05);
        }

        .alert {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            border: 1px solid var(--border);
        }

        .alert-success {
            background: rgba(22, 163, 74, 0.1);
            color: var(--success);
            border-color: var(--success);
        }

        :root.dark .alert-success {
            background: rgba(74, 222, 128, 0.1);
            color: #86efac;
        }

        .alert-error {
            background: rgba(220, 38, 38, 0.1);
            color: var(--danger);
            border-color: var(--danger);
        }

        :root.dark .alert-error {
            background: rgba(239, 68, 68, 0.1);
            color: #fca5a5;
        }

        h1, h2, h3 {
            margin-top: 0;
            color: var(--ink);
        }

        h2 {
            margin-bottom: 16px;
        }

        p {
            color: var(--subtle);
        }

        .icon {
            font-size: 48px;
            margin-bottom: 16px;
        }

        select, input[type="file"] {
            background: var(--panel);
            color: var(--ink);
            border: 1px solid var(--border);
        }

        select:focus, input[type="file"]:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }

        :root.dark select:focus, :root.dark input[type="file"]:focus {
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
        }

        .pro-tips {
            background: rgba(234, 88, 12, 0.05);
            border: 1px solid var(--warning);
            border-radius: 8px;
            padding: 16px;
            margin-top: 24px;
        }

        :root.dark .pro-tips {
            background: rgba(251, 146, 60, 0.05);
        }

        .pro-tips strong {
            color: var(--warning);
        }

        ol, ul {
            line-height: 1.8;
            color: var(--subtle);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                margin-top: 60px;
            }

            .card {
                padding: 20px;
            }

            .upload-zone {
                padding: 32px 16px;
            }
        }
    </style>
</head>
<body>
    @include('components.nav-professional')

    <div class="container" style="margin-top: 80px;">
        <h1 style="font-size: 36px; margin-bottom: 8px;">📊 Data Import Center</h1>
        <p style="color: var(--subtle); margin-bottom: 32px;">Import budget, spending, revenue, and timeline data from Excel files</p>

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
            <p style="color: var(--subtle); margin-bottom: 24px;">Start by downloading a template with the correct format and sample data</p>
            
            <div class="grid">
                <div class="template-card" onclick="window.location.href='/admin/import/template/budgets'">
                    <div class="icon">💰</div>
                    <h3>Budget Template</h3>
                    <p style="color: var(--subtle); font-size: 14px;">Annual budgets with allocated, spent, and predicted amounts</p>
                    <button class="btn btn-primary" style="margin-top: 16px;">Download</button>
                </div>

                <div class="template-card" onclick="window.location.href='/admin/import/template/spending'">
                    <div class="icon">💸</div>
                    <h3>Spending Template</h3>
                    <p style="color: var(--subtle); font-size: 14px;">Individual spending items and transactions</p>
                    <button class="btn btn-primary" style="margin-top: 16px;">Download</button>
                </div>

                <div class="template-card" onclick="window.location.href='/admin/import/template/revenue'">
                    <div class="icon">💵</div>
                    <h3>Revenue Template</h3>
                    <p style="color: var(--subtle); font-size: 14px;">Income streams and revenue sources</p>
                    <button class="btn btn-primary" style="margin-top: 16px;">Download</button>
                </div>

                <div class="template-card" onclick="window.location.href='/admin/import/template/timeline'">
                    <div class="icon">📅</div>
                    <h3>Timeline Template</h3>
                    <p style="color: var(--subtle); font-size: 14px;">Major events and milestones</p>
                    <button class="btn btn-primary" style="margin-top: 16px;">Download</button>
                </div>
            </div>
        </div>

        <!-- Upload Data -->
        <div class="card">
            <h2>📤 Upload Data</h2>
            <p style="color: var(--subtle); margin-bottom: 24px;">Fill in the template and upload it here</p>

            <form action="{{ route('admin.import.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div style="margin-bottom: 24px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">Data Type</label>
                    <select name="sheet_type" required style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 16px;">
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
                    <p style="color: var(--subtle); margin-bottom: 16px;">or click to browse</p>
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
            <ol style="line-height: 1.8; color: var(--subtle);">
                <li><strong>Download</strong> the appropriate template above</li>
                <li><strong>Fill in</strong> your data following the sample row format</li>
                <li><strong>Keep</strong> the header row exactly as provided</li>
                <li><strong>Use</strong> consistent date formats (YYYY-MM-DD recommended)</li>
                <li><strong>Format</strong> amounts as numbers (commas and currency symbols will be stripped)</li>
                <li><strong>Select</strong> the data type matching your file</li>
                <li><strong>Upload</strong> and wait for confirmation</li>
            </ol>

            <div class="pro-tips">
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
