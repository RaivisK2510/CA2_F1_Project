# Laravel Blog Boilerplate

A modern, full-featured CRUD blog application built with Laravel 10, designed as a boilerplate for students to learn and build upon.

## Features

- ✅ Complete CRUD functionality for blog posts
- ✅ User authentication (Register, Login, Logout)
- ✅ Post ownership & authorization policies
- ✅ Image upload support for post featured images
- ✅ Automatic slug generation from post titles
- ✅ Responsive Bootstrap UI
- ✅ Modern Laravel best practices
- ✅ Route model binding
- ✅ Form validation
- ✅ Pagination support

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
git clone <your-repository-url>
cd 26blog
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

Edit the `.env` file and configure your database settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Create database

Create a MySQL database that matches your `.env` configuration:

```sql
CREATE DATABASE blog_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Or using command line:

```bash
mysql -u root -p
CREATE DATABASE blog_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### 7. Run migrations

```bash
php artisan migrate
```

### 8. Create storage link

The application stores uploaded images in the storage directory. Create a symbolic link:

```bash
php artisan storage:link
```

### 9. Build frontend assets

```bash
npm run dev
```

For production:

```bash
npm run build
```

### 10. Start the development server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Usage Guide

### For Students

This boilerplate provides a solid foundation for learning Laravel and building your own blog application. Here's how to get started:

#### 1. Register a User Account

1. Visit `http://localhost:8000`
2. Click "Register" in the top navigation
3. Create your account

#### 2. Create Your First Post

1. After logging in, click "Create New Post"
2. Fill in the title and description
3. Optionally upload a featured image
4. Click "Create Post"

#### 3. Explore the Code

Key files to study:

- **Routes**: `routes/web.php` - Defines all application routes
- **Controller**: `app/Http/Controllers/PostController.php` - Handles blog logic
- **Model**: `app/Models/Post.php` - Defines post data structure and relationships
- **Migration**: `database/migrations/*_create_posts_table.php` - Database schema
- **Policy**: `app/Policies/PostPolicy.php` - Authorization rules
- **Views**: `resources/views/posts/` - Frontend templates

## Project Structure

```
26blog/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── PostController.php      # Main blog controller
│   ├── Models/
│   │   ├── Post.php                    # Post model with relationships
│   │   └── User.php                    # User model
│   └── Policies/
│       └── PostPolicy.php              # Post authorization logic
├── database/
│   └── migrations/
│       └── *_create_posts_table.php    # Posts table schema
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php           # Main layout template
│       ├── posts/
│       │   ├── index.blade.php         # List all posts
│       │   ├── create.blade.php        # Create post form
│       │   ├── edit.blade.php          # Edit post form
│       │   └── show.blade.php          # Single post view
│       └── auth/                       # Authentication views
└── routes/
    └── web.php                         # Route definitions
```

## Key Concepts to Learn

### 1. MVC Architecture

- **Models**: Data structure and business logic (`app/Models/Post.php`)
- **Views**: User interface templates (`resources/views/posts/*.blade.php`)
- **Controllers**: Request handling and response logic (`app/Http/Controllers/PostController.php`)

### 2. Eloquent ORM

The Post model demonstrates:
- Mass assignment with `$fillable`
- Relationships (belongsTo User)
- Model events and traits

### 3. Route Model Binding

```php
Route::resource('posts', PostController::class);
```

This creates all CRUD routes automatically.

### 4. Authorization

The `PostPolicy` ensures users can only edit/delete their own posts.

### 5. Form Validation

See the `store()` and `update()` methods in `PostController` for validation examples.

### 6. File Uploads

The controller handles image uploads and stores them in the `storage/app/public` directory.

## Common Tasks

### Adding a New Field to Posts

1. Create a migration:
   ```bash
   php artisan make:migration add_excerpt_to_posts_table
   ```

2. Edit the migration file to add the column

3. Run the migration:
   ```bash
   php artisan migrate
   ```

4. Add the field to the Post model's `$fillable` array

5. Update the controller validation rules

6. Update the views to display/edit the new field

### Creating a Seeder

Create fake data for testing:

```bash
php artisan make:seeder PostSeeder
php artisan db:seed --class=PostSeeder
```

### Creating a Factory

Generate test data:

```bash
php artisan make:factory PostFactory --model=Post
```

## Troubleshooting

### Storage link not working

If uploaded images don't display:

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

## Extending the Application

Ideas for student projects:

1. **Add Comments**: Create a Comment model and allow users to comment on posts
2. **Categories**: Implement post categories and filtering
3. **Tags**: Add tagging functionality to posts
4. **Search**: Implement full-text search for posts
5. **Rich Text Editor**: Integrate TinyMCE or similar for formatted content
6. **API**: Create a RESTful API for the blog
7. **Testing**: Add PHPUnit tests for controllers and models
8. **Admin Panel**: Create an admin dashboard with statistics
9. **Email Notifications**: Send notifications when posts are published
10. **Social Sharing**: Add social media share buttons

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

Created as a teaching resource for college students learning web development with Laravel.

Based on modern Laravel practices and inspired by the Laravel community.

