# Customer Management Website

A customer management website built with **Laravel** for BCS3453 Integrated Application Development Framework, Assignment 2.

It stores customer records in a MySQL database, fills the table with 100 fake customers generated with **Faker**, and shows them in a table with filters by gender and birthday.

**Author:** Adeeb Irfaan (CB23061)

## Features

- 100 fake customer records generated with a Laravel Factory, Faker and a Seeder
- Customer table with Name, Email, Address, Phone Number, Gender and Birthday
- Filter by **gender** (Male or Female)
- Filter by **birthday** (customers born after the year 2000)
- Both filters can be combined
- 10 customers per page, with pagination
- Works on desktop and phone screens

## Built with

- Laravel 13 (PHP 8.3)
- MySQL (through XAMPP)
- Blade templates and plain CSS
- FakerPHP

## Getting started

### Requirements

- PHP 8.3 or newer
- Composer
- MySQL (for example from XAMPP)

### Installation

1. Clone the repository and open the folder:
   ```bash
   git clone <repository-url>
   cd customer-app
   ```

2. Install the PHP packages:
   ```bash
   composer install
   ```

3. Create the environment file and an app key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   On Windows Command Prompt, use `copy .env.example .env` instead of `cp`.

4. Start MySQL and create a database named `customer_db` (for example in phpMyAdmin).
   The connection settings in `.env` are:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=customer_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Create the tables and generate the 100 customers:
   ```bash
   php artisan migrate --seed
   ```
   To start again with fresh data at any time:
   ```bash
   php artisan migrate:fresh --seed
   ```

6. Start the server:
   ```bash
   php artisan serve
   ```
   Open http://127.0.0.1:8000 in your browser.

## Pages and filters

All pages use the same route, `/customers`. Filters are added to the URL:

| Page | URL |
|---|---|
| All customers | `/customers` |
| Male customers | `/customers?gender=Male` |
| Female customers | `/customers?gender=Female` |
| Born after 2000 | `/customers?birthday=after2000` |
| Female and born after 2000 | `/customers?gender=Female&birthday=after2000` |
| Next page | add `&page=2` (or `?page=2`) |

"Born after 2000" means born in 2001 or later.

## Project structure (MVC)

```
app/
├── Http/Controllers/
│   └── CustomerController.php      Controller: reads the filters, queries the data, returns the view
└── Models/
    └── Customer.php                Model: fillable fields, birthday date cast, gender() and bornAfter() filters

database/
├── migrations/
│   └── ..._create_customers_table.php   Creates the customers table
├── factories/
│   └── CustomerFactory.php              Faker data for one customer
└── seeders/
    ├── CustomerSeeder.php               Creates 100 customers
    └── DatabaseSeeder.php               Runs CustomerSeeder

resources/views/
├── layouts/
│   └── app.blade.php                    Shared page layout (head and top bar)
└── customers/
    ├── index.blade.php                  Filter form and customer table
    └── partials/
        └── pagination.blade.php         Page links

routes/
└── web.php                              Route for /customers

public/css/
└── app.css                              Styles
```

## Database table: `customers`

| Column | Type | Description |
|---|---|---|
| `id` | big integer | Primary key, auto increment |
| `name` | string | Customer name |
| `email` | string, unique | Email address |
| `address` | text | Full address |
| `phoneNumber` | string | Phone number, stored as text to keep `+`, `-` and brackets |
| `gender` | enum (`Male`, `Female`) | Customer gender |
| `birthday` | date | Date of birth |
| `created_at`, `updated_at` | timestamp | Added by Laravel |
