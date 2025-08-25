<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About This Project

This is the backend application for BioRecordHub, built with Laravel. It provides the API endpoints and authentication for the frontend application.  

Features include:

- RESTful API routes for your application.
- Laravel Sanctum for SPA authentication.
- Database migrations and seeding for quick setup.
- Public storage linking for user-uploaded files.

## Requirements

- PHP >= 8.x
- Composer
- MySQL or another supported database
- Node.js (optional, if using Laravel Mix)
- Laravel CLI (optional)

## Installation

1. Clone the repository:

```bash
git clone https://github.com/Sebastian2702/BioRecordHub_Backend.git
cd your-backend-repo
```

2. Install PHP dependencies:

```bash
composer install
```

3. Copy .env.example to .env:

```bash
cp .env.example .env
```

4. Generate the application key:

```bash
php artisan key:generate
```

5. Configuration, Edit the .env file with your environment settings:

DB_CONNECTION= biorecordhub

DB_HOST= database_ip

DB_PORT= database_port

DB_DATABASE=your_database

DB_USERNAME=your_user

DB_PASSWORD=your_password

FRONTEND_URL= your_frontend_url

SANCTUM_STATEFUL_DOMAINS= your_frontend_url

6. Storage, Make the storage folder publicly accessible, run this command:

```bash
php artisan storage:link
```

7. Run the migrations

```bash
php artisan migrate
```

8. Seed the database:

```bash
php artisan db:seed
```

9. Start the development server:

```bash
php artisan serve
```





