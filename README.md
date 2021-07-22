# Neofutsal

Neofutsal adalah situs aplikasi layanan booking online lapangan futsal yang menerima berbagai metode pembayaran.

## Instalasi

Saya asumsikan bahwa Anda telah mempunyai:

-   PHP Versi 7.4+
-   [Composer](https://getcomposer.org/download/)
-   [Node JS](https://nodejs.org/en/download/) & Node Package Manager (NPM)
-   Web Server
-   Database Server

```bash
git clone git@github.com:Ir001/neofutsal.git
cd neofutsal
cp .env.example .env
composer install
php artisan key:generate
# Konfigurasi database pada .env
php artisan migrate --seed
npm install
npm run production
php artisan serve
# Open http://localhost:8000/
```

## Contributing

Neofutsal dibuat untuk mengikuti event lomba IT Web Apps [TESTIFEST](https://drive.google.com/file/d/1n1jJ6ORmboWOVU5YiMy61IVtr_xnn9EO/view).
Neofutsal dibuat menggunakan :

-   PHP [Laravel 8](https://laravel.com/docs/8.x/installation)
-   CSS [TailwindCSS](https://tailwindcss.com/docs/installation)
-   Template Dashboard Admin [SB-Admin 2](https://startbootstrap.com/theme/sb-admin-2)

## License

[MIT](https://choosealicense.com/licenses/mit/)
