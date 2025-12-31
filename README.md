# Transparency.ie - Dublin City Council Transparency Portal

A modern, open-source dashboard for tracking and displaying Dublin City Council spending, budget allocation, and social impact initiatives. Built with **Laravel 11**, **Vue.js 3**, **Tailwind CSS**, and designed for public transparency.

## ✅ Quick Start

No database setup required - the app includes demo data for instant use!

```bash
# Terminal 1: Start Laravel server
php artisan serve

# Terminal 2: Start Vite dev server (in another terminal)
npm run dev

# Then open http://localhost:8000 in your browser
```

Both servers must be running together for the app to work properly.

## Features

### 🏛️ Core Transparency Features
- **Budget Tracking**: Monitor annual budgets by department
- **Spending Transparency**: Detailed spending records with categories and vendors
- **Tax Money Tracking**: See where your local tax money goes
- **Initiative Monitoring**: Track local government initiatives and their outcomes

### 🌱 Green & Social Impact
- **Green Energy Initiatives**: Track renewable energy investments
- **Fossil Fuel Analysis**: Monitor and flag fossil fuel-related spending
- **Employment Metrics**: Track Irish workers employed in council initiatives
- **Homelessness Initiatives**: Monitor spending on homelessness solutions

### 📊 Public Dashboard
- Interactive visualizations of budget and spending data
- Real-time impact metrics
- Department-by-department breakdown
- Historical comparisons and trends

### 🔐 Admin Panel (Filament)
- Comprehensive data management interface
- Role-based access control
- Audit trails for all spending records
- Bulk import/export capabilities

### 🔗 Social Integration
- Integration with enjoydeise social media platform
- User authentication via social accounts
- Public sharing of transparency metrics

## Tech Stack

### Backend
- **Laravel 12** - PHP web framework
- **Filament 4** - Admin panel and UI components
- **Livewire 3** - Real-time reactive components
- **PostgreSQL/MySQL** - Database

### Frontend
- **Vue.js 3** - Interactive dashboard UI
- **Tailwind CSS** - Utility-first styling
- **Chart.js/ApexCharts** - Data visualization
- **Vite** - Build tool

### Integrations
- **Laravel Socialite** - Social authentication
- **AWS SDK** - File storage and cloud services

## Installation

### Requirements
- PHP 8.3+
- Composer
- Node.js 18+
- npm or yarn

**Note:** No database installation required! The application uses demo data and works instantly after setup.

### Setup (3 Simple Steps)

1. **Install Dependencies**
```bash
cd transparency_dot_ie
composer install
npm install
```

2. **Start Laravel Server** (Terminal 1)
```bash
php artisan serve
```
The server will start at `http://localhost:8000`

3. **Start Vite Dev Server** (Terminal 2)
```bash
npm run dev
```
Vite will start at `http://localhost:5173` and provide hot module reloading

**That's it!** Open http://localhost:8000 in your browser and the app will work with demo data.

### Optional: Production Build

When ready to deploy, build the frontend assets:
```bash
npm run build
```

This creates optimized assets in `public/build/` for production use.

## Project Structure

```
├── app/
│   ├── Models/
│   │   ├── Department.php
│   │   ├── Budget.php
│   │   ├── Spending.php
│   │   ├── Initiative.php
│   │   └── ImpactMetric.php
│   ├── Filament/
│   │   └── Resources/
│   │       ├── DepartmentResource.php
│   │       ├── BudgetResource.php
│   │       ├── SpendingResource.php
│   │       ├── InitiativeResource.php
│   │       └── ImpactMetricResource.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/DashboardController.php
│   │   │   ├── Api/TransparencyController.php
│   │   │   └── Auth/SocialController.php
│   │   └── Resources/
│   │       ├── DepartmentResource.php
│   │       ├── BudgetResource.php
│   │       └── SpendingResource.php
│
├── resources/
│   ├── js/
│   │   ├── components/
│   │   │   ├── Dashboard.vue
│   │   │   ├── SpendingChart.vue
│   │   │   ├── InitiativeCard.vue
│   │   │   └── MetricsDisplay.vue
│   │   ├── pages/
│   │   │   ├── Home.vue
│   │   │   ├── Departments.vue
│   │   │   ├── Spending.vue
│   │   │   ├── Initiatives.vue
│   │   │   └── ImpactMetrics.vue
│   │   └── App.vue
│   └── css/
│       └── app.css
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── routes/
│   ├── web.php
│   └── api.php
│
└── config/
    ├── filament.php
    ├── socialite.php
    └── app.php
```

## Database Schema

### Departments
- Department information
- Annual budgets
- Contact details
- Active status

### Budgets
- Fiscal year allocation
- Department budget linking
- Spent amounts tracking

### Spendings
- Individual spending records
- Categories and vendors
- Transaction dates
- Green energy flags
- Homelessness initiative tags

### Initiatives
- Government initiatives and programs
- Budget and spending tracking
- Irish worker employment counts
- Outcomes documentation

### Impact Metrics
- Initiative-linked metrics
- Numeric, percentage, or text values
- Target comparisons
- Measurement dates

## API Endpoints

### Public Transparency API

```
GET  /api/departments              - List all departments
GET  /api/departments/{id}         - Department details & budget
GET  /api/spendings                - List spending records
GET  /api/spendings?month=12&year=2025 - Filtered spending
GET  /api/initiatives              - Active initiatives
GET  /api/initiatives/{id}/metrics - Initiative impact metrics
GET  /api/dashboard/stats          - Dashboard statistics
GET  /api/transparency/report      - Comprehensive report
```

### Admin API (Authenticated)

```
POST   /api/admin/spendings        - Create spending record
PUT    /api/admin/spendings/{id}   - Update spending
DELETE /api/admin/spendings/{id}   - Delete spending
POST   /api/admin/initiatives      - Create initiative
```

## Configuration

### Environment Variables

```env
# Database
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=transparency
DB_USERNAME=user
DB_PASSWORD=password

# Social Authentication
SOCIALITE_FACEBOOK_ID=
SOCIALITE_FACEBOOK_SECRET=

SOCIALITE_GOOGLE_ID=
SOCIALITE_GOOGLE_SECRET=

# AWS S3 (Optional)
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=eu-west-1
AWS_BUCKET=

# Filament
FILAMENT_DEFAULT_TIMEZONE=Europe/Dublin
```

## Development

### Running Tests
```bash
php artisan test
```

### Running Linter
```bash
./vendor/bin/pint
```

### Watching Frontend Assets
```bash
npm run dev
```

### Building for Production
```bash
composer install --no-dev --optimize-autoloader
npm run build
php artisan config:cache
php artisan route:cache
```

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## Data Categories for Tracking

### Spending Categories
- Personnel & Salaries
- Energy & Utilities
- Facilities & Maintenance
- Transportation
- Green Energy Investments
- Social Services
- Education & Training
- Healthcare
- Infrastructure
- Consultants & Contractors

### Initiative Categories
- Green Energy Transition
- Renewable Energy Projects
- Homelessness Prevention
- Local Employment Programs
- Community Development
- Healthcare Services
- Education Initiatives
- Environmental Protection

## Future Enhancements

- [ ] Real-time spending notifications
- [ ] AI-powered spending analysis
- [ ] Predictive budgeting models
- [ ] Mobile app for transparency viewing
- [ ] Multi-council comparison dashboard
- [ ] Community feedback integration
- [ ] Advanced data visualization
- [ ] Historical data archive (10+ years)
- [ ] Carbon footprint calculator
- [ ] Green jobs marketplace integration

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Support

For issues, questions, or suggestions, please open an issue on the GitHub repository.

## Contact

**Project:** Transparency.ie  
**Purpose:** Local government spending transparency and social impact tracking  
**Integration:** Linked to enjoydeise social platform

---

Built with ❤️ for transparent, accountable local governance.
