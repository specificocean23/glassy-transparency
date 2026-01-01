#!/bin/bash
# Laravel Project Aliases for Transparency.ie
# Add these to your ~/.bashrc or ~/.zshrc or source this file directly

# Navigate to project
alias cdtrans='cd /home/shay/cyp_wri_code/transparency_dot_ie'

# Artisan shortcuts
alias a='php artisan'
alias serve='php artisan serve'
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

# Combined commands
alias start='php artisan serve & npm run dev'
alias restart='lsof -ti:8000 | xargs kill -9 2>/dev/null; sleep 1; php artisan serve'

echo "✅ Transparency.ie aliases loaded!"
echo "Quick start: cdtrans && serve"
