# Transparency.ie API Documentation

## Base URL
```
http://localhost:8000/api/v1
https://transparency.ie/api/v1
```

## Authentication
Currently, public endpoints do not require authentication. Admin endpoints will require API token authentication via `Authorization: Bearer {token}` header.

---

## Public Endpoints

### Dashboard Endpoints

#### 1. Get Dashboard Statistics
```
GET /dashboard/stats
```

**Response:**
```json
{
  "summary": {
    "total_allocated_budget": 10000000,
    "total_spent": 7500000,
    "remaining_budget": 2500000,
    "budget_utilization_percentage": 75.0
  },
  "departments": {
    "total_departments": 12,
    "average_budget_per_department": 833333.33
  },
  "initiatives": {
    "active_initiatives": 25,
    "irish_workers_employed": 150
  },
  "impact": {
    "green_energy_investment": 500000,
    "fossil_fuel_related_spending": 200000,
    "homelessness_initiatives_spending": 800000
  },
  "timestamp": "2025-12-31T22:30:00Z"
}
```

#### 2. Get Monthly Spending Trend
```
GET /dashboard/monthly-spending?year=2025
```

**Parameters:**
- `year` (integer, optional): Fiscal year (default: current year)

**Response:**
```json
{
  "year": 2025,
  "monthly_data": [
    {
      "month": 1,
      "month_name": "January",
      "amount_spent": 500000
    },
    ...
  ]
}
```

#### 3. Get Spending by Category
```
GET /dashboard/spending-by-category
```

**Response:**
```json
{
  "categories": [
    {
      "category": "Personnel & Salaries",
      "total": 3000000,
      "count": 250
    },
    {
      "category": "Energy & Utilities",
      "total": 1500000,
      "count": 180
    },
    ...
  ]
}
```

#### 4. Get Spending by Department
```
GET /dashboard/spending-by-department
```

**Response:**
```json
{
  "departments": [
    {
      "id": 1,
      "name": "Parks & Recreation",
      "budget": 2000000,
      "spent": 1500000,
      "remaining": 500000,
      "percentage_used": 75.0
    },
    ...
  ]
}
```

#### 5. Get Green Energy Impact
```
GET /dashboard/green-energy
```

**Response:**
```json
{
  "green_energy_investment": 500000,
  "fossil_fuel_spending": 200000,
  "green_initiatives_count": 8,
  "green_initiatives": [
    {
      "id": 1,
      "name": "Solar Panel Installation",
      "budget": 300000,
      "spent": 250000,
      "status": "active"
    },
    ...
  ],
  "green_to_fossil_ratio": 2.5
}
```

#### 6. Get Homelessness Initiatives Impact
```
GET /dashboard/homelessness
```

**Response:**
```json
{
  "total_homelessness_spending": 800000,
  "initiatives_count": 5,
  "irish_workers_employed": 45,
  "initiatives": [
    {
      "id": 2,
      "name": "Community Housing Program",
      "budget": 500000,
      "spent": 400000,
      "status": "active",
      "workers_employed": 30
    },
    ...
  ]
}
```

---

### Departments

#### 1. List All Departments
```
GET /departments?page=1&active=true
```

**Parameters:**
- `page` (integer, optional): Pagination page (default: 1)
- `active` (boolean, optional): Filter by active status

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "name": "Parks & Recreation",
      "slug": "parks-recreation",
      "description": "Department responsible for...",
      "head_name": "John Doe",
      "email": "john@council.ie",
      "phone": "+353-1-234-5678",
      "annual_budget": 2000000,
      "is_active": true,
      "created_at": "2025-01-01T00:00:00Z"
    },
    ...
  ],
  "meta": {
    "current_page": 1,
    "total": 12,
    "per_page": 15
  }
}
```

#### 2. Get Department Details with Budget
```
GET /departments/{id}
```

**Response:**
```json
{
  "department": {
    "id": 1,
    "name": "Parks & Recreation",
    "slug": "parks-recreation",
    "description": "...",
    "head_name": "John Doe",
    "email": "john@council.ie",
    "phone": "+353-1-234-5678",
    "annual_budget": 2000000,
    "is_active": true,
    "created_at": "2025-01-01T00:00:00Z"
  },
  "financial_summary": {
    "total_budget": 2000000,
    "total_spent": 1500000,
    "remaining": 500000,
    "utilization_percentage": 75.0
  },
  "initiatives": [
    {
      "id": 1,
      "name": "Park Renovation 2025",
      "description": "...",
      "category": "community_development",
      "budget": 500000,
      "spent": 400000,
      "status": "active"
    },
    ...
  ],
  "recent_spendings": [
    {
      "id": 100,
      "category": "Maintenance",
      "vendor_name": "ABC Contractors",
      "description": "Park grass cutting",
      "amount": 5000,
      "transaction_date": "2025-12-30",
      "status": "approved"
    },
    ...
  ]
}
```

---

### Spendings

#### 1. List Spending Records
```
GET /spendings?page=1&category=Personnel&month=12&year=2025&green_energy=false&fossil_fuel=false&homelessness=false
```

**Parameters:**
- `page` (integer, optional): Pagination page
- `category` (string, optional): Filter by category
- `department_id` (integer, optional): Filter by department
- `month` (integer, optional): Filter by month (1-12)
- `year` (integer, optional): Filter by year
- `green_energy` (boolean, optional): Show only green energy spendings
- `fossil_fuel` (boolean, optional): Show only fossil fuel spendings
- `homelessness` (boolean, optional): Show only homelessness initiative spendings

**Response:**
```json
{
  "data": [
    {
      "id": 100,
      "budget_id": 1,
      "department_id": 1,
      "category": "Personnel & Salaries",
      "vendor_name": "Payroll Services",
      "description": "Monthly employee salaries",
      "amount": 250000,
      "status": "approved",
      "transaction_date": "2025-12-15",
      "document_reference": "INV-2025-12-001",
      "tags": ["salaries", "payroll"],
      "is_fossil_fuel_related": false,
      "is_green_energy": false,
      "supports_homelessness_initiative": false,
      "created_at": "2025-12-15T10:00:00Z"
    },
    ...
  ],
  "meta": {
    "current_page": 1,
    "total": 2500,
    "per_page": 25,
    "total_amount": 6250000
  }
}
```

---

### Initiatives

#### 1. List All Initiatives
```
GET /initiatives?page=1&category=green_energy&status=active
```

**Parameters:**
- `page` (integer, optional): Pagination page
- `category` (string, optional): Filter by category
- `status` (string, optional): Filter by status (planning, active, completed, paused)

**Response:**
```json
{
  "data": [
    {
      "id": 5,
      "department_id": 1,
      "name": "Solar Panel Installation",
      "slug": "solar-panel-installation",
      "description": "Install solar panels on all council buildings",
      "category": "green_energy",
      "budget": 300000,
      "spent": 250000,
      "remaining": 50000,
      "start_date": "2024-01-01",
      "end_date": "2025-12-31",
      "status": "active",
      "irish_workers_employed": 25,
      "outcomes": "50% of council buildings now powered by renewable energy",
      "created_at": "2024-01-01T00:00:00Z"
    },
    ...
  ],
  "meta": {
    "current_page": 1,
    "total": 45,
    "per_page": 15
  }
}
```

#### 2. Get Initiative Details with Metrics
```
GET /initiatives/{id}
```

**Response:**
```json
{
  "initiative": {
    "id": 5,
    "department_id": 1,
    "name": "Solar Panel Installation",
    "slug": "solar-panel-installation",
    "description": "Install solar panels on all council buildings",
    "category": "green_energy",
    "budget": 300000,
    "spent": 250000,
    "remaining": 50000,
    "start_date": "2024-01-01",
    "end_date": "2025-12-31",
    "status": "active",
    "irish_workers_employed": 25,
    "outcomes": "50% of council buildings now powered by renewable energy",
    "created_at": "2024-01-01T00:00:00Z"
  },
  "metrics": [
    {
      "id": 1,
      "initiative_id": 5,
      "metric_name": "Buildings with Solar Panels",
      "metric_type": "numeric",
      "value": "45",
      "unit": "buildings",
      "target_value": 85,
      "measurement_date": "2025-12-31",
      "notes": "Progress on schedule"
    },
    {
      "id": 2,
      "initiative_id": 5,
      "metric_name": "Renewable Energy Percentage",
      "metric_type": "percentage",
      "value": "50",
      "unit": "%",
      "target_value": 100,
      "measurement_date": "2025-12-31",
      "notes": "On track to exceed targets"
    }
  ],
  "summary": {
    "budget": 300000,
    "spent": 250000,
    "remaining": 50000,
    "status": "active",
    "irish_workers_employed": 25
  }
}
```

---

### Reports

#### 1. Get Comprehensive Transparency Report
```
GET /report?year=2025
```

**Parameters:**
- `year` (integer, optional): Fiscal year (default: current year)

**Response:**
```json
{
  "year": 2025,
  "generated_at": "2025-12-31T22:30:00Z",
  "summary": {
    "total_departments": 12,
    "total_budget": 10000000,
    "total_spending": 7500000,
    "active_initiatives": 25
  },
  "financial_breakdown": {
    "by_department": [
      {
        "name": "Parks & Recreation",
        "total_spent": 1500000
      },
      ...
    ],
    "by_category": [
      {
        "category": "Personnel & Salaries",
        "total": 3000000
      },
      ...
    ],
    "by_month": [
      {
        "month": 1,
        "amount": 500000
      },
      ...
    ]
  },
  "impact_metrics": {
    "green_energy_investment": {
      "total_investment": 500000,
      "initiatives_count": 8
    },
    "homelessness_initiatives": {
      "total_spending": 800000,
      "initiatives_count": 5,
      "workers_employed": 45
    },
    "irish_employment": {
      "total_irish_workers_employed": 150,
      "by_initiative": [
        {
          "name": "Solar Panel Installation",
          "irish_workers_employed": 25
        },
        ...
      ]
    }
  }
}
```

---

## Error Responses

### 400 Bad Request
```json
{
  "message": "Invalid parameters",
  "errors": {
    "month": ["The month field must be between 1 and 12."]
  }
}
```

### 404 Not Found
```json
{
  "message": "Resource not found"
}
```

### 500 Internal Server Error
```json
{
  "message": "Internal server error",
  "error": "Error details here"
}
```

---

## Response Headers

All responses include standard headers:
```
Content-Type: application/json
X-Request-ID: unique-id
X-Powered-By: Laravel
```

---

## Rate Limiting (Future Implementation)

Rate limits will be implemented with:
- 60 requests per minute per IP (public endpoints)
- 1000 requests per hour per API token (authenticated endpoints)

Response headers:
```
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
X-RateLimit-Reset: 1609459200
```

---

## Pagination

All list endpoints support pagination:
```json
{
  "data": [...],
  "meta": {
    "current_page": 1,
    "total": 100,
    "per_page": 15,
    "last_page": 7
  }
}
```

Add `?page=X` to the URL to navigate pages.

---

## Data Categories

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
- green_energy
- renewable_energy
- homelessness
- homelessness_prevention
- local_employment
- community_development
- healthcare_services
- education_initiatives
- environmental_protection

---

## Examples Using cURL

### Get All Statistics
```bash
curl http://localhost:8000/api/v1/dashboard/stats
```

### Get Green Energy Data
```bash
curl http://localhost:8000/api/v1/dashboard/green-energy
```

### Filter Spending by Green Energy
```bash
curl "http://localhost:8000/api/v1/spendings?green_energy=true&page=1"
```

### Get Department Details
```bash
curl http://localhost:8000/api/v1/departments/1
```

### Get Initiative with Metrics
```bash
curl http://localhost:8000/api/v1/initiatives/5
```

### Get Annual Report
```bash
curl "http://localhost:8000/api/v1/report?year=2025"
```

---

## Integration with enjoydeise Platform

The API is designed to integrate seamlessly with the enjoydeise social media platform:

1. User authentication can be bridged via OAuth
2. Dashboard statistics can be shared to social feeds
3. Initiatives can be promoted through social channels
4. Public transparency reports can be published to followers

Contact the enjoydeise development team for integration specifics.

---

## Support

For API questions or issues:
- GitHub Issues: [Repository URL]
- Email: support@transparency.ie
- Documentation: https://transparency.ie/docs
