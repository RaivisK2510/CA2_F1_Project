# Quick Start Guide for Students

## Getting Your Blog Running in 10 Minutes

Follow these steps in order:

### 1. ✅ Check Prerequisites

Make sure you have these installed:
```bash
php --version    # Should be 8.1 or higher
composer --version
mysql --version  # or mysql.server start
node --version   # Should be 16.x or higher
npm --version
```

### 2. 📦 Install Dependencies

```bash
composer install
npm install
```

### 3. ⚙️ Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

Then edit `.env` file and update your database settings:
```env
DB_DATABASE=blog_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. 🗄️ Create Database

In MySQL:
```sql
CREATE DATABASE blog_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Or from terminal:
```bash
mysql -u root -p -e "CREATE DATABASE blog_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 5. 🏗️ Run Migrations

```bash
php artisan migrate
```

You should see output like:
```
Migration table created successfully.
Migrating: 2014_10_12_000000_create_users_table
Migrated:  2014_10_12_000000_create_users_table
...
```

### 6. 🔗 Create Storage Link

```bash
php artisan storage:link
```

### 7. 🎨 Build Assets

In a new terminal window:
```bash
npm run dev
```

Leave this running. It will watch for file changes.

### 8. 🚀 Start Laravel Server

In another terminal window:
```bash
php artisan serve
```

### 9. 🎉 Visit Your Blog

Open your browser and go to: **http://localhost:8000**

### 10. 👤 Create Your Account

1. Click "Register" in the top navigation
2. Fill in:
   - Name: Your name
   - Email: your.email@example.com
   - Password: At least 8 characters
3. Click "Register"

---

## Your First Blog Post

Once logged in:

1. Click **"Create New Post"** button
2. Enter a **Title** (e.g., "My First Laravel Blog Post")
3. Write a **Description** (the main content)
4. Upload an **Image** (optional)
5. Click **"Create Post"**

🎊 Congratulations! You just created your first post!

---

## Common Terminal Commands

```bash
# Stop the development server
# Press Ctrl + C in the terminal running php artisan serve

# Stop the asset watcher
# Press Ctrl + C in the terminal running npm run dev

# Clear application cache
php artisan cache:clear
php artisan config:clear

# Reset database (WARNING: Deletes all data!)
php artisan migrate:fresh

# View all routes
php artisan route:list

# Create a new controller
php artisan make:controller YourController

# Create a new model
php artisan make:model YourModel -m

# Run database seeders
php artisan db:seed
```

---

## File Locations Cheat Sheet

| What You Want to Change | Where to Look |
|------------------------|---------------|
| Routes (URLs) | `routes/web.php` |
| Blog logic | `app/Http/Controllers/PostController.php` |
| Post data structure | `app/Models/Post.php` |
| Database tables | `database/migrations/*.php` |
| Who can edit/delete | `app/Policies/PostPolicy.php` |
| How pages look | `resources/views/posts/*.blade.php` |
| Navigation bar | `resources/views/layouts/app.blade.php` |
| CSS styles | `resources/sass/app.scss` |

---

## Troubleshooting

### "Access denied for user" database error
- Check your database credentials in `.env`
- Make sure MySQL is running: `mysql.server start` (macOS)

### "No application encryption key has been set"
```bash
php artisan key:generate
```

### Images not showing after upload
```bash
php artisan storage:link
```

### "Class 'X' not found"
```bash
composer dump-autoload
```

### Blade changes not showing
```bash
php artisan view:clear
```

### NPM/Build errors
```bash
rm -rf node_modules package-lock.json
npm install
npm run dev
```

---

## Next Steps

Once you're comfortable with the basics:

1. 📖 Read the full [README.md](README.md) for detailed documentation
2. 🎯 Try the "Extending the Application" ideas
3. 🔍 Explore the Laravel documentation: https://laravel.com/docs
4. 💡 Watch Laracasts videos: https://laracasts.com

---

## Need Help?

1. Check the [README.md](README.md) for detailed documentation
2. Read the Laravel documentation: https://laravel.com/docs
3. Search Stack Overflow: https://stackoverflow.com/questions/tagged/laravel
4. Ask your instructor

**Remember:** Every expert was once a beginner. Keep practicing! 🚀
