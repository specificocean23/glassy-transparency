#!/bin/bash

# Transparency.ie Setup Script
# Complete setup for the redesigned transparency platform

echo "🚀 Setting up Transparency.ie..."
echo ""

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    echo "❌ Error: This script must be run from the Laravel project root"
    exit 1
fi

echo "📦 Installing dependencies..."
# Use version that doesn't require GD extension
composer require phpoffice/phpspreadsheet:^1.29

echo ""
echo "🗄️  Running fresh migrations..."
php artisan migrate:fresh

echo ""
echo "🌱 Seeding sample data..."
php artisan db:seed --class=TransparencyDataSeeder

echo ""
echo "🎨 Building assets..."
npm install
npm run build

echo ""
echo "✅ Setup complete!"
echo ""
echo "📊 Available Pages:"
echo "   - Homepage (redesigned):      http://localhost:8000/"
echo "   - Timeline:                   http://localhost:8000/timeline"
echo "   - Spending Explorer:          http://localhost:8000/spending/explorer"
echo "   - Data Import:                http://localhost:8000/admin/import"
echo "   - Transparency Dashboard:     http://localhost:8000/transparency"
echo ""
echo "📥 Sample Data Created:"
php artisan tinker --execute="
echo '   - Budgets: ' . \App\Models\Budget::count() . ' records\n';
echo '   - Timeline Events: ' . \App\Models\TimelineEvent::count() . ' events\n';
echo '   - Spending Items: ' . \App\Models\SpendingItem::count() . ' items\n';
echo '   - Revenue Streams: ' . \App\Models\RevenueStream::count() . ' streams\n';
"
echo ""
echo "🎯 Next Steps:"
echo "   1. Start the dev server: php artisan serve"
echo "   2. Visit the homepage to see the new design"
echo "   3. Go to /admin/import to import your own data"
echo "   4. Download Excel templates and fill them with real data"
echo ""
echo "📖 Documentation: See TRANSPARENCY_REDESIGN.md for full details"
echo ""
