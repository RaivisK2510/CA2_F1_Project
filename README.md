# F1 Stats Hub

A comprehensive Formula 1 statistics and data management application built with Laravel 10.

GIF HERE

# Authors:

Leonas Stanislovaitis - https://www.linkedin.com/in/leonas-stanislovaitis/

Raivis Krumins - https://www.linkedin.com/in/raivis-krumins/

## Features

- ✅ Complete CRUD functionality for F1 race results
- ✅ User authentication (Register, Login, Logout)
- ✅ Manage multiple seasons, circuits, drivers, and teams
- ✅ Track race results with positions and points
- ✅ User favorites/watchlist functionality
- ✅ Championship tracking and statistics
- ✅ Responsive Bootstrap UI
- ✅ Modern Laravel best practices
- ✅ Route model binding
- ✅ Form validation
- ✅ Database seeding with sample data

## Technology Stack

- **Laravel 10.x** - Modern PHP framework
- **MySQL** - Database
- **Bootstrap 5** - Frontend framework
- **Vite** - Asset bundling
- **Laravel UI** - Authentication scaffolding
- **Eloquent Sluggable** - Automatic slug generation

## Prerequisites

Before you begin, ensure you have the following installed:

- PHP 8.1 or higher
- Composer
- MySQL 5.7 or higher (or MariaDB)
- Node.js 16.x or higher
- NPM or Yarn

## Installation

Follow these steps to set up the project on your local machine:

### 1. Clone the repository

```bash
git clone <https://github.com/RaivisK2510/CA2_F1_Project>
cd CA2_F1_Project
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install JavaScript dependencies

```bash
npm install
```

### 4. Environment configuration

Copy the example environment file and configure it:

```bash
cp .env.example .env
```

Edit the `.env.example` file and configure your database settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=f1_stats_hub
DB_USERNAME=root
DB_PASSWORD=your_password
```

Then rename to .env and leave in root folder.

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Create database

Create a MySQL database that matches your `.env` configuration:

```sql
CREATE DATABASE f1_stats_hub CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Or using command line:

```bash
mysql -u root -p
CREATE DATABASE f1_stats_hub CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### 7. Run migrations

```bash
php artisan migrate
```

### 8. Seed the database

Populate the database with sample F1 data:

```bash
php artisan db:seed
```

### 9. Create storage link

The application stores uploaded files in the storage directory. Create a symbolic link:

```bash
php artisan storage:link
```

### 10. Build frontend assets

```bash
npm run dev
```

For production:

```bash
npm run build
```

### 11. Start the development server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Usage Guide

#### 1. Register a User Account

1. Visit `http://localhost:8000`
2. Click "Register" in the top navigation
3. Create your account with your email and password

#### 2. Explore the Data

1. After logging in, browse through Seasons, Circuits, Drivers, and Teams
2. View race results and championship statistics
3. Add races to your favorites

#### 3. Create and Manage Race Results

1. Change you user to an admin in your database
2. Navigate to the race results section
3. Click "Add Race Result"
4. Select a Season, Circuit, Driver, and Team
5. Enter the finishing position, points, and status
6. Click "Save"

#### 4. Explore the Code

Key files to examine:

- **Routes**: `routes/web.php` - Defines all application routes
- **Controllers**: `app/Http/Controllers/` - Handles application logic
- **Models**: `app/Models/` - Defines data structures and relationships
- **Migrations**: `database/migrations/` - Database schema definitions
- **Seeders**: `database/seeders/` - Sample data initialization
- **Views**: `resources/views/` - Frontend templates

## Project Structure

```
CA2_F1_Project/
├── app/
│   ├── Http/
│   │   └── Controllers/              # Application logic
│   ├── Models/
│   │   ├── Championship.php          # Championship model
│   │   ├── Circuit.php               # Circuit model
│   │   ├── Driver.php                # Driver model
│   │   ├── Race.php                  # Race model
│   │   ├── RaceResult.php            # Race result model
│   │   ├── Season.php                # Season model
│   │   ├── Team.php                  # Team model
│   │   ├── Favorite.php              # Favorite model
│   │   └── User.php                  # User model
│   └── Policies/                     # Authorization policies
├── database/
│   ├── migrations/                   # Database schema
│   ├── factories/                    # Model factories for testing
│   └── seeders/                      # Database seeders
├── resources/
│   └── views/
│       ├── layouts/                  # Layout templates
│       ├── seasons/                  # Season views
│       ├── circuits/                 # Circuit views
│       ├── drivers/                  # Driver views
│       ├── teams/                    # Team views
│       ├── races/                    # Race views
│       ├── race-results/             # Race result views
│       └── auth/                     # Authentication views
└── routes/
    └── web.php                       # Route definitions
```

## Key Concepts to Learn

### 1. MVC Architecture

- **Models**: Data structure and business logic (`app/Models/`)
- **Views**: User interface templates (`resources/views/`)
- **Controllers**: Request handling and response logic (`app/Http/Controllers/`)

### 2. Eloquent ORM

The models demonstrate:
- Mass assignment with `$fillable`
- Relationships (hasMany, belongsTo, belongsToMany)
- Model events and traits

### 3. Route Model Binding

```php
Route::resource('races', RaceController::class);
```

This creates all CRUD routes automatically.

### 4. Authorization

Policies ensure users can only perform authorized actions.

### 5. Form Validation

Controllers implement validation rules for all input data.

### 6. Database Seeding

The seeders populate the database with realistic F1 data for development and testing.

## Common Tasks

### Adding a New Field to a Model

1. Create a migration:
   ```bash
   php artisan make:migration add_field_to_table
   ```

2. Edit the migration file to add the column

3. Run the migration:
   ```bash
   php artisan migrate
   ```

4. Add the field to the Model's `$fillable` array

5. Update the controller validation rules

6. Update the views to display/edit the new field

### Creating a Seeder

Create sample data for testing:

```bash
php artisan make:seeder YourSeeder
php artisan db:seed --class=YourSeeder
```

### Creating a Factory

Generate test data automatically:

```bash
php artisan make:factory YourFactory --model=YourModel
```

### Running Fresh Migrations with Seeding

Reset the database and repopulate with seed data:

```bash
php artisan migrate:fresh --seed
```

## Troubleshooting

### Storage link not working

If files don't display properly:

```bash
php artisan storage:link
```

Make sure the `storage/app/public` directory exists and is writable.

### Database connection errors

- Verify your `.env` database credentials
- Ensure MySQL is running
- Check that the database exists

### Permission errors

Make sure these directories are writable:

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### NPM/Node errors

If you encounter frontend build errors:

```bash
rm -rf node_modules package-lock.json
npm install
npm run dev
```

### Seeding issues

If seeders fail, try running migrations fresh first:

```bash
php artisan migrate:fresh
php artisan db:seed
```

## Extending the Application

Ideas for student projects:

1. **Advanced Statistics**: Create detailed championship standings and statistics views
2. **Race Calendar**: Build an interactive race calendar with filters
3. **Driver Profiles**: Enhance driver pages with career statistics and achievements
4. **Team Analysis**: Add team performance analysis and comparisons
5. **Search Functionality**: Implement full-text search across drivers, teams, and races
6. **API**: Create a RESTful API for the application
7. **Testing**: Add PHPUnit tests for controllers and models
8. **Admin Panel**: Create an admin dashboard with statistics
9. **Email Notifications**: Send notifications for race results
10. **Data Visualization**: Integrate charts for championship standings and statistics

## Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Bootcamp](https://bootcamp.laravel.com/)
- [Laracasts](https://laracasts.com/) - Video tutorials
- [Laravel Daily](https://laraveldaily.com/) - Tips and tutorials

## Contributing

Students are encouraged to fork this project and experiment! Share your improvements via pull requests.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Credits

Created as part of the Server Side Development module of Second Year Stage 2 of the Coumputing in Software Development at Dundalk Institute of Technology for grading in CA 2.

Based on modern Laravel practices and inspired by the Laravel community.

Leonas Stanislovaitis
D00280989@student.dkit.ie

Raivis Krumins
D00279149@student.dkit.ie
