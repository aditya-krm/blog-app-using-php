# Laravel Blog Application

A full-featured blog platform built with Laravel, featuring post creation, category management, user authentication, and an admin panel.

## Features

- 🔐 User authentication (login, registration)
- ✍️ Create, edit, and delete blog posts
- 📂 Categorize posts with custom categories
- 🖼️ Upload featured images for posts
- 🔍 Search and filter posts by title or category
- 📱 Responsive design with Tailwind CSS
- 👑 Admin functionality for content moderation
- 📊 Dashboard with statistics and user activity

## Requirements

- PHP >= 8.2
- Composer
- MySQL or compatible database
- Node.js and NPM
- Git

## Setup Instructions

### For Linux Users

1. **Clone the repository**

```bash
git clone https://github.com/your-username/blog-app.git
cd blog-app
```

2. **Install PHP dependencies**

```bash
composer install
```

3. **Install JavaScript dependencies**

```bash
npm install
```

4. **Set up environment file**

```bash
cp .env.example .env
php artisan key:generate
```

5. **Configure database**

Edit the `.env` file and update the database connection settings:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_app
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. **Run migrations and seed the database**

```bash
php artisan migrate --seed
```

7. **Create storage link for uploaded images**

```bash
php artisan storage:link
```

8. **Build assets**

```bash
npm run build
```

9. **Start the development server**

```bash
php artisan serve
```

Access the application at http://localhost:8000

### For Windows Users

1. **Prerequisites**

   - Install [XAMPP](https://www.apachefriends.org/download.html) (includes PHP, MySQL)
   - Install [Composer](https://getcomposer.org/download/)
   - Install [Node.js](https://nodejs.org/)
   - Install [Git](https://git-scm.com/downloads)

2. **Clone the repository**

   Open Command Prompt or Git Bash:

   ```bash
   git clone https://github.com/your-username/blog-app.git
   cd blog-app
   ```

3. **Install PHP dependencies**

   ```bash
   composer install
   ```

4. **Install JavaScript dependencies**

   ```bash
   npm install
   ```

5. **Set up environment file**

   ```bash
   copy .env.example .env
   php artisan key:generate
   ```

6. **Configure database**

   - Start XAMPP Control Panel and start Apache and MySQL services
   - Open phpMyAdmin (http://localhost/phpmyadmin) and create a new database named `blog_app`
   - Edit the `.env` file and update the database connection settings:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=blog_app
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. **Run migrations and seed the database**

   ```bash
   php artisan migrate --seed
   ```

8. **Create storage link for uploaded images**

   ```bash
   php artisan storage:link
   ```

9. **Build assets**

   ```bash
   npm run build
   ```

10. **Start the development server**

    ```bash
    php artisan serve
    ```

    Access the application at http://localhost:8000

## Default Login Credentials

After seeding the database, you can use these accounts:

- **Admin Account**:
  - Email: admin@example.com
  - Password: password

- **Regular User Account**:
  - Email: test@example.com
  - Password: password

## Project Structure

- **Controllers**: Located in `app/Http/Controllers/`
  - `BlogController.php` - Handles the public-facing blog pages
  - `PostController.php` - Manages post CRUD operations
  - `CategoryController.php` - Manages category CRUD operations
  - `DashboardController.php` - Handles the user dashboard
  - `Admin/` - Admin-specific controllers

- **Models**: Located in `app/Models/`
  - `User.php` - User model with relationships
  - `Post.php` - Post model with category and user relationships
  - `Category.php` - Category model with posts relationship

- **Views**: Located in `resources/views/`
  - `blog/` - Public blog views
  - `posts/` - Post management views
  - `categories/` - Category management views
  - `admin/` - Admin panel views
  - `layouts/` - Layout templates
  - `components/` - Reusable view components

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
