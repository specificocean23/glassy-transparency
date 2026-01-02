#!/bin/bash
# Laravel Project Aliases for Transparency.ie
# Add these to your ~/.bashrc or ~/.zshrc or source this file directly

# ============================================
# PORT ALLOCATION (No Clashing)
# ============================================
# 8001 - Laravel Backend (PHP Artisan Serve)
# 5173 - Vite Frontend Dev Server (HMR)
# 6379 - Redis (local)
# 5432 - PostgreSQL (local, if used)
# ============================================

# Navigate to project
alias cdtrans='cd /home/shay/cyp_wri_code/transparency_dot_ie'

# Artisan shortcuts
alias a='php artisan'
alias serve='php artisan serve --port=8003'
alias tinker='php artisan tinker'

# Database commands
alias fresh='php artisan migrate:fresh'
alias freshseed='php artisan migrate:fresh --seed'
alias migrate='php artisan migrate'
alias rollback='php artisan migrate:rollback'
alias seed='php artisan db:seed'
alias dbtest='php artisan tinker --execute="echo \"DB: Connected ✓\" . PHP_EOL; echo \"Redis: \" . (Illuminate\Support\Facades\Redis::connection()->ping() ? \"Connected ✓\" : \"Failed\") . PHP_EOL;"'

# Cache management
alias cc='php artisan config:clear && php artisan cache:clear && php artisan view:clear'
alias co='php artisan config:cache && php artisan route:cache && php artisan view:cache'

# Quick data check
alias dbcount='php artisan tinker --execute="echo \"Departments: \" . App\Models\Department::count() . PHP_EOL; echo \"Budgets: \" . App\Models\Budget::count() . PHP_EOL; echo \"Initiatives: \" . App\Models\Initiative::count() . PHP_EOL; echo \"Spending: \" . App\Models\Spending::count() . PHP_EOL;"'

# Laravel logs
alias logs='tail -f storage/logs/laravel.log'
alias logsclr='echo "" > storage/logs/laravel.log'

# Composer shortcuts
alias ci='composer install'
alias cu='composer update'
alias cr='composer require'
alias cda='composer dump-autoload'

# NPM shortcuts
alias ni='npm install'
alias dev='npm run dev'
alias build='npm run build'

# Git shortcuts (optional)
alias gs='git status'
alias ga='git add .'
alias gc='git commit -m'
alias gp='git push'
alias gl='git pull'

# Combined commands with proper port isolation
alias start='php artisan serve --port=8001 & npm run dev'
alias restart='lsof -ti:8001 | xargs kill -9 2>/dev/null; sleep 1; php artisan serve --port=8001'

# Port management
alias killports='echo "Cleaning ports 8001, 5173..." && lsof -ti:8001 | xargs kill -9 2>/dev/null; lsof -ti:5173 | xargs kill -9 2>/dev/null; echo "✅ Ports cleaned"'

# Display active ports
alias checkports='echo "=== Active Development Ports ===" && lsof -i -P -n | grep -E ":(8001|5173|6379|5432)" || echo "No active development ports"'

echo "✅ Transparency.ie aliases loaded!"
echo "📍 Port Configuration:"
echo "   - Backend: http://localhost:8001 (php artisan serve)"
echo "   - Frontend: http://localhost:5173 (Vite HMR)"
echo "   - Redis: 6379"
echo "   - PostgreSQL: 5432"
echo ""
echo "Quick start: cdtrans && serve"
echo "Kill all: killports"
echo "Check ports: checkports"
