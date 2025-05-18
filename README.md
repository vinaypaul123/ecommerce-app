# E-Commerce Web Application

## Project Description

The E-Commerce Web Application is a Laravel-based platform that allows users to browse products, add them to a cart, and place orders. Admins can manage products and users through an admin panel. The main objective of the project is to provide a fully functional online shopping system with user authentication, blog content, cart management.

---

## Features

### User Panel:
- Browse products with details
- Add products to cart
- View and manage cart
- Checkout orders
- Track order summary
  
### Admin Panel:
- Dashboard: View total users, products, and orders
- Manage Products: Add, edit, delete products
- Manage Users: View all registered users
- View Orders: See order details and user info
- 
**Manage Blog Posts**: Add, update, delete blog posts, Comment
  
### Authentication:
- Secure user login and registration
- Admin and User roles

### Artisan Command:
- Scheduled job to notify inactive users (30+ days of inactivity)

---

## Getting Started
1) Install Composer Dependencies: composer install
2) Run Migrations : php artisan migrate
3) Run =  php artisan db:seed --class=AdminUserSeeder
    Admin Login : http://localhost:8000/login
   email = admin@gmail.com
   password = admin123
### Installation

## Requirements
1) PHP 8.2.12
2) Laravel 10.48.29
3) MySQL
4) Composer
