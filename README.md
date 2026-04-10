# Automated Conference Planning Platform

A Laravel-based web application for managing conferences, registrations, speakers, sessions, check-ins, announcements, and event materials.

## Features

- Conference creation and management
- Public conference registration pages
- Custom registration fields
- Registration confirmation and attendee portal
- Speaker management
- Session scheduling
- Session materials upload and access
- Attendee check-in desk
- Announcements and notification logs
- Admin dashboard powered by Filament

## Tech Stack

- Laravel 12
- PHP 8.2+
- Filament
- SQLite
- Vite
- Tailwind CSS
- Blade templates

## Installation

Clone the repository:

```bash
git clone https://github.com/johnkibuna/automated-conference-planning-platform.git
cd automated-conference-planning-platform
```

Install PHP dependencies:

```bash
composer install
```

Install JavaScript dependencies:

```bash
npm install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Create the MySql database :

```bash
CREATE DATABASE your_database_name;
```

Update .env :

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=your_password
```

Run the database migrations:

```bash
php artisan migrate
```

Link storage:

```bash
php artisan storage:link
```

Build frontend assets:

```bash
npm run build
```

## Running The Project

Start the Laravel development server:

```bash
php artisan serve
```

In another terminal, start Vite:

```bash
npm run dev
```

Then open:

```text
http://localhost:8000
```

## Admin Panel

The admin dashboard is available at:

```text
http://localhost:8000/admin
```

Create an admin user with:

```bash
php artisan make:filament-user
```

## Main Pages

- Home page: `/`
- Conference registration: `/conferences/{conference}/register`
- Attendee portal: `/conferences/{conference}/my-event/{registrationCode}`
- Check-in desk: `/conferences/{conference}/check-in`
- Admin panel: `/admin`

## Project Purpose

This system helps event organizers manage the full conference workflow, from setting up conferences and sessions to registering attendees, checking them in, and sharing event materials.

## Author

John Kibuna

## License

This project is open-source and available under the MIT license.
```
