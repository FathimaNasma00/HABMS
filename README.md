# HealthCare Booking System

## UI
https://tailwindcss.com/

## Setup
## Requirements

Ensure the following software is installed on your system:

- **PHP**: 8.1 or higher
- **Composer**: Dependency manager for PHP
- **Node.js**: 16.x or higher (if frontend assets are included)
- **Database**: MySQL, PostgreSQL, or other supported databases
- **Web Server**: Apache/Nginx

---

## Installation

1. **Clone the Repository**
   ```bash
   git clone <repository-url>
   cd <project-directory>
   ```

2. **Install Dependencies**
    - PHP dependencies:
      ```bash
      composer install
      ```
    - Node.js dependencies (if applicable):
      ```bash
      npm install
      ```

3. **Environment Configuration**
    - Copy `.env.example` to `.env`:
      ```bash
      cp .env.example .env
      ```
    - Update the `.env` file with your environment-specific variables:
        - Database settings (`DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`)
        - Application settings (`APP_URL`, `APP_ENV`, etc.)

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Set Directory Permissions**
   Ensure `storage` and `bootstrap/cache` are writable:
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```

6. **Run Migrations and Seeders (if required)**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

---

## Usage

1. **Run the Development Server**
   ```bash
   php artisan serve
   ```
   By default, the server will run at [http://localhost:8000](http://localhost:8000).

2. **Frontend Assets (Optional)**
   If the project includes frontend assets:
    - For development:
      ```bash
      npm run dev
      ```
    - For production:
      ```bash
      npm run build
      ```

---

## Additional Configuration

### Scheduler
```bash
php run-schedule.php
```

### Queues
If the project uses queues, configure the queue worker:
```bash
php artisan queue:work
```

Alternatively, use **Supervisor** or **Laravel Horizon** for queue management.

### Scheduler
Set up a cron job to run the scheduler:
```bash
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
```

---

## Troubleshooting

- **Clear Cache**
  ```bash
  php artisan cache:clear
  php artisan config:clear
  php artisan route:clear
  php artisan view:clear
  ```

- **Permissions Issue**
  Ensure the web server user owns the `storage` and `bootstrap/cache` directories:
  ```bash
  sudo chown -R www-data:www-data storage bootstrap/cache
  ```

---

## Laravel Folder Structure

A typical Laravel project folder structure is as follows:

```
project-root/
├── app/
│   ├── Console/
│   ├── Exceptions/
│   ├── Http/
│   │   ├── Controllers/
│   │   ├── Middleware/
│   ├── Models/
│   ├── Observers/
│   ├── Policies/
│   └── Providers/
├── bootstrap/
│   └── cache/
├── config/
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── lang/
├── public/
├── resources/
│   ├── css/
│   ├── js/
│   ├── views/
│   └── lang/
├── routes/
├── storage/
│   ├── app/
│   ├── framework/
│   └── logs/
├── tests/
│   ├── Feature/
│   └── Unit/
├── vendor/
├── .env
├── artisan
├── composer.json
├── package.json
├── phpunit.xml
└── webpack.mix.js
```

### Explanation of Key Directories and Files

#### **`app/`**
Contains the core business logic of the application:
- **`Console/`**: Custom Artisan commands.
- **`Exceptions/`**: Application's exception handling.
- **`Http/`**: HTTP-related components.
    - **`Controllers/`**: Controllers handling HTTP requests.
    - **`Middleware/`**: Middleware for request processing.
- **`Models/`**: Eloquent ORM models (database entities).
- **`Observers/`**: Logic for observing model events.
- **`Policies/`**: Authorization policies.
- **`Providers/`**: Service providers for binding classes into the container.

#### **`bootstrap/`**
Handles framework bootstrapping:
- **`cache/`**: Contains framework-generated files for optimization.

#### **`config/`**
Holds configuration files for various components like database, mail, queue, and more.

#### **`database/`**
Handles database-related tasks:
- **`factories/`**: Factories for generating model data.
- **`migrations/`**: Schema definitions for database structure.
- **`seeders/`**: Classes for populating the database with test data.

#### **`lang/`**
Localization files for supporting multiple languages.

#### **`public/`**
Web server's root directory containing:
- `index.php`: Entry point for the application.
- Assets (e.g., CSS, JS, images).

#### **`resources/`**
Frontend and backend resources:
- **`css/`** and **`js/`**: Frontend assets.
- **`views/`**: Blade templates for the application’s UI.
- **`lang/`**: Localization files for specific views.

#### **`routes/`**
Contains route definitions:
- **`web.php`**: Web routes.
- **`api.php`**: API routes.
- **`console.php`**: Console commands routes.
- **`channels.php`**: Event broadcasting routes.

#### **`storage/`**
Stores generated files:
- **`app/`**: Application files.
- **`framework/`**: Framework cache, sessions, and views.
- **`logs/`**: Application logs.

#### **`tests/`**
Contains test cases:
- **`Feature/`**: Tests larger units, such as controllers.
- **`Unit/`**: Tests individual classes or methods.

#### **`vendor/`**
Contains Composer dependencies (auto-managed by `composer install`).

---

This structure is designed to keep your application modular, organized, and scalable.