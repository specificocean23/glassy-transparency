#!/bin/bash
# Railway PostgreSQL Setup Script
# Run this after getting your Railway credentials

echo "🚀 Setting up Waterford Council Transparency Portal for Railway"
echo ""

# Colors for output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Update .env with Railway credentials
echo -e "${BLUE}Step 1: Updating .env with Railway PostgreSQL credentials${NC}"
echo "Enter your Railway PostgreSQL credentials:"
echo ""

read -p "PostgreSQL Host [postgres-production-b2a7.up.railway.app]: " DB_HOST
DB_HOST=${DB_HOST:-postgres-production-b2a7.up.railway.app}

read -p "PostgreSQL Port [6969]: " DB_PORT
DB_PORT=${DB_PORT:-6969}

read -p "Database Name [transparency_ie]: " DB_DATABASE
DB_DATABASE=${DB_DATABASE:-transparency_ie}

read -p "Database Username [postgres]: " DB_USERNAME
DB_USERNAME=${DB_USERNAME:-postgres}

read -sp "Database Password: " DB_PASSWORD
echo ""

# Update .env file
sed -i.bak "s/DB_HOST=.*/DB_HOST=$DB_HOST/" .env
sed -i "s/DB_PORT=.*/DB_PORT=$DB_PORT/" .env
sed -i "s/DB_DATABASE=.*/DB_DATABASE=$DB_DATABASE/" .env
sed -i "s/DB_USERNAME=.*/DB_USERNAME=$DB_USERNAME/" .env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=$DB_PASSWORD/" .env

echo -e "${GREEN}✓ .env updated${NC}"
echo ""

# Test connection
echo -e "${BLUE}Step 2: Testing PostgreSQL connection${NC}"
PGPASSWORD=$DB_PASSWORD psql -h $DB_HOST -p $DB_PORT -U $DB_USERNAME -d $DB_DATABASE -c "SELECT 1" > /dev/null 2>&1

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✓ Successfully connected to PostgreSQL${NC}"
else
    echo -e "${YELLOW}⚠ Could not connect to PostgreSQL. Check your credentials.${NC}"
    exit 1
fi
echo ""

# Run migrations
echo -e "${BLUE}Step 3: Running database migrations${NC}"
php artisan migrate

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✓ Migrations completed${NC}"
else
    echo -e "${YELLOW}⚠ Migration failed. Check error messages above.${NC}"
    exit 1
fi
echo ""

# Seed data
echo -e "${BLUE}Step 4: Seeding demo data (Waterford Council & Irish Energy)${NC}"
php artisan db:seed

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✓ Database seeded with example data${NC}"
else
    echo -e "${YELLOW}⚠ Seeding failed. Check error messages above.${NC}"
    exit 1
fi
echo ""

# Display completion message
echo -e "${GREEN}🎉 Setup complete!${NC}"
echo ""
echo -e "${BLUE}Next steps:${NC}"
echo "1. Start local servers:"
echo "   Terminal 1: php artisan serve"
echo "   Terminal 2: npm run dev"
echo ""
echo "2. Visit: http://localhost:8000"
echo ""
echo "3. To deploy to Railway:"
echo "   - git push origin main (if using GitHub)"
echo "   - Or follow DEPLOY_TO_RAILWAY.md"
echo ""
echo -e "${YELLOW}Data Included:${NC}"
echo "  ✓ Waterford Council (6 departments, €12.2M budget)"
echo "  ✓ Irish Federal Energy (€2.5B energy spending)"
echo "  ✓ 4 major initiatives"
echo "  ✓ 20+ spending records"
echo ""
