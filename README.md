# ISPayment System (Laravel + Kai Admin)

A management system built with **Laravel** + **Kai Admin** for handling customers, transactions, vending machines, expense tracking, employee management, and sales dashboards/reports.

---

## 📷 Screenshot

![Image Alt](https://github.com/christian113781/laravel-ISPayment-sys/blob/c7203c6251402e33cbea7afe11f458814804a374/screenshot/screenshot.png)
*This is a sample dashboard view of the system.*

---

## Features

- Customer management (CRUD, contact info, history)  
- Transaction processing & record-keeping  
- Vending machine management (locations, status, inventory)  
- Expense tracking & categorization  
- Employee management (roles, profiles, access control)  
- Dashboard & sales reports (charts, summaries, analytics)  

---

## Requirements

- PHP ≥ 8.0 (or your target version)  
- Composer  
- A supported database (MySQL, PostgreSQL, etc.)  
- Node.js & NPM / Yarn (for frontend assets)  
- Web server (Apache, Nginx, etc.)  

---

## Installation / Setup Guide

Follow these steps to clone the project, configure it, and run it:

```bash
# 1. Clone the repo
git clone https://github.com/christian113781/laravel-ISPayment-sys.git

# 2. Go into the project directory
cd laravel-ISPayment-sys

# 3. Copy environment file
cp .env.example .env

# 4. Edit .env
#    - Set DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
#    - Set APP_NAME, APP_URL, etc.

# 5. Install PHP dependencies
composer install

# 6. Generate app key
php artisan key:generate

# 7. Run migrations
php artisan migrate

# 8. (Optional) Seed sample / default data
php artisan db:seed

# 9. Install JavaScript dependencies
npm install
# or
yarn

# 10. Build frontend assets
npm run dev
# or in production: npm run build / yarn build

# 11. Serve the application (for development)
php artisan serve
