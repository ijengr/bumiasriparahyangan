# Bumi Asri Parahyangan

Website properti perumahan Bumi Asri Parahyangan yang dibangun dengan Laravel 11, menampilkan unit properti, galeri, fasilitas, dan sistem kontak.

## Tech Stack

- Laravel 11 (PHP 8.2+)
- SQLite Database
- Tailwind CSS 3
- Alpine.js
- AOS (Animate On Scroll)
- Vite

## Features

- Responsive modern design dengan animasi halus
- Unit properti dengan filter dan detail lengkap
- Galeri gambar dengan lightbox
- Fasilitas perumahan
- Form kontak dengan email notification
- Admin dashboard untuk manage konten
- SEO optimized dengan Schema.org structured data
- Smooth scroll dan scroll-to-top button
- Animated counter statistics
- Database indexing untuk performa optimal
- Security headers dan CSRF protection

## Requirements

- PHP 8.2 atau lebih tinggi
- Composer
- Node.js & NPM
- SQLite extension enabled

## Installation

1. Clone repository

```bash
git clone https://github.com/ijengr/bumiasriparahyangan.git
cd bumiasriparahyangan
```

2. Install dependencies

```bash
composer install
npm install
```

3. Setup environment

```bash
copy .env.example .env
php artisan key:generate
```

4. Configure database di .env (default SQLite)

```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite
```

5. Jalankan migration dan seeder

```bash
php artisan migrate --seed
php artisan storage:link
```

6. Build assets

```bash
npm run dev
```

7. Jalankan development server

```bash
php artisan serve
```

Website akan berjalan di http://127.0.0.1:8000

## Default Admin Account

- Email: admin@example.com
- Password: password

## Project Structure

```
app/
  ├── Http/Controllers/     # Controllers untuk halaman dan admin
  ├── Models/              # Eloquent models (Unit, Facility, Gallery, Message, Setting)
  ├── Services/            # Business logic services
  └── Helpers/             # Helper classes (Cache, Image, Theme)
  
resources/
  ├── views/
  │   ├── landing/        # Public pages (home, units, gallery, contact)
  │   ├── admin/          # Admin dashboard pages
  │   └── layouts/        # Layout templates
  ├── css/                # Tailwind CSS
  └── js/                 # JavaScript files
  
database/
  ├── migrations/         # Database migrations
  └── seeders/           # Database seeders
  
public/
  ├── images/            # Static images
  └── storage/           # Symlink to storage/app/public
```

## Database Schema

- users - Admin users
- units - Property units dengan spesifikasi
- facilities - Fasilitas perumahan
- gallery_images - Galeri foto
- messages - Pesan kontak dari pengunjung
- settings - Dynamic settings untuk konten website

## Available Scripts

Development:
```bash
npm run dev          # Start Vite dev server
php artisan serve    # Start Laravel server
```

Production:
```bash
npm run build        # Build assets untuk production
php artisan optimize # Cache routes, config, views
```

Database:
```bash
php artisan migrate:fresh --seed  # Reset database dengan data baru
php artisan db:seed               # Seed database saja
```

Cache:
```bash
php artisan cache:clear   # Clear application cache
php artisan view:clear    # Clear compiled views
php artisan config:clear  # Clear config cache
```

## Performance Optimizations

- Database indexes pada frequently queried columns
- Image optimization dengan Intervention Image
- View caching dan query caching
- Lazy loading untuk images
- CSS/JS minification via Vite
- CDN ready untuk static assets

## Security Features

- CSRF protection pada semua forms
- SQL injection protection via Eloquent ORM
- XSS protection dengan Blade templating
- Rate limiting pada contact form
- Secure headers (X-Frame-Options, X-Content-Type-Options)
- Input validation dan sanitization

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## License

This project is open-sourced software licensed under the MIT license.
