# Ecommerce Training

A small e-commerce app built with Laravel 12.

This was my **first Laravel project**. I made it to understand the basics of the framework, so the focus was the backend. The front end was not the main thing, which is why the pages use simple Blade views with basic Tailwind styling.

## What it does

There are three roles:

- **Customer**: browse products and categories, add to cart, place orders, see their own orders and notifications.
- **Seller**: add, edit and delete their own products from a seller dashboard.
- **Admin**: approve products, accept or reject orders, view customers and sellers, and update user balances.

How it works:

- Products start as `pending` and only show in the shop after the admin accepts them.
- Customers pay from a balance that the admin sets.
- Orders start as `pending`. Rejecting one refunds the balance.
- Users get a notification when their balance or an order changes.

## What I learned

- Routing, controllers, form requests and Blade components
- Migrations and Eloquent relationships (one-to-many, many-to-many)
- Authentication with sessions, plus a session-based cart
- Roles and permissions with [spatie/laravel-permission](https://spatie.be/docs/laravel-permission)
- Database notifications
- Seeders for roles, users and sample data

## Run it

You need PHP 8.2+, Composer, Node.js and MySQL.

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
# set the DB_* values in .env
php artisan migrate --seed
php artisan storage:link
npm run dev
php artisan serve
```

Then open http://127.0.0.1:8000.

## Demo users

The seeder creates these users. The password for all of them is `password`.

| Role | Email |
|---|---|
| Admin | admin@example.com |
| Seller | seller@example.com |
| Customer | customer@example.com |

## Notes

- About, Contact, FAQ and the other footer pages only have placeholder text.
- Stock is not reduced when an order is placed.
- It is a learning project, so it is not meant for production.
