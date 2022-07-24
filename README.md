# Neofutsal
![Image](https://github.com/Ir001/neofutsal/blob/main/doc/Certificate.png?raw=true)

[NeoFutsal](https://github.com/Ir001/neofutsal) adalah situs aplikasi layanan booking online lapangan futsal yang menerima berbagai metode pembayaran.

## Preview

### Desktop Admin

![Image](https://github.com/Ir001/neofutsal/blob/main/doc/Neo_Futsal_Desktop.png?raw=true)

### Mobile User

![Image](https://github.com/Ir001/neofutsal/blob/main/doc/Neo_Futsal_App.png?raw=true)

## Latar Belakang

Di era modern seperti sekarang ini, dunia telah mengenal dengan teknologi bernama internet. Melalui internet, semua orang bisa berkomunikasi dengan orang lain yang bahkan berada di berbagai negara diseluruh dunia. Adanya jaringan global membuat internet bisa diakses selama 24 jam. Kita pasti tahu peran dari media internet itu sendiri dalam kehidupan seperti apa. Bukan hanya untuk membantu manusia mencari informasi, internet juga bisa digunakan sebagai peluang bisnis dengan membuat aplikasi berbasis website. Aplikasi berbasis website ini mudah diakses oleh semua orang karena penggunaan internet yang semakin luas.

Teknologi internet dan teknologi website bisa digunakan untuk alat bantu mengorganisasikan waktu dalam sistem informasi booking online yang dapat diakses kapan pun dan dimana pun.

Seperti di [NeoFutsal](https://github.com/Ir001/neofutsal) yang masih menemukan masalah, seperti kesulitan dalam pemesanan tempat futsal, pencatatan pemesanan masih menggunakan metode manual, kurangnya informasi mengenai tempat futsal dan belum ada jaminan pemesanan lapangan untuk konfirmasi status bermain.

Oleh karena itu, maka dirancanglah aplikasi sistem booking online lapangan futsal berbasis website agar memudahkan pelanggan dalam pemesanan lapangan.

Aplikasi ini akan menggantikan sistem pemesanan secara konvensional, sehingga mempermudah pelanggan dan pengelolah dalam melakukan transaksi karena pengaturannya dapat dilakukan secara terpusat.

Dengan dibuatnya aplikasi ini, diharapkan bisa mempermudah pelanggan dalam menghadapi permasalahan yang terjadi ketika pemesanan sewa lapangan.

## Tujuan dan hasil yang akan dicapai

-   Mempermudah pelanggan dalam memesan lapangan
-   Memberikan informasi mengenai pemesanan lapangan dan jadwal futsal
-   Mempermudah Neofutsal dalam memasarkan bisnis booking lapangan futsal menggunakan sebuah aplikasi
-   Mempermudah Neofutsal dalam mengelola data transaksi booking lapangan futsal
-   Membuat aplikasi berbasis website untuk pemesanan, penjadwalan, pembatalan serta penggunaan lapangan futsal

## Analisa SWOT

### Strengths (S)

-   Pelanggan dapat memesan lapangan futsal dengan mudah
-   Pelanggan langsung bisa mendapatkan informasi yang tepat mengenai sistem booking online lapangan futsal
-   Hemat waktu, tenaga dan biaya
-   Sistem yang dibuat sesuai dengan kebutuhan pelanggan agar tidak bingung dalam mengoperasikannya
-   Adanya pendataan booking lapangan futsal yang sistematis dan terkomputerisasi

### Weakness (W)

-   Tidak setiap orang mengerti cara menggunakan sistem booking online lapangan futsal
-   Keamanan transaksi kurang aman apabila dibandingkan dengan pembayaran langsung
-   Server down karena banyaknya yang mengakses
-   Aplikasi booking online lapangan futsal tidak bisa digunakan apabila mati listrik atau tidak ada internet

### Opportunities (O)

-   Pemanfaatan teknologi informasi untuk usaha bisnis
-   Teknologi informasi yang berkembang secara terus menerus
-   Penggunaan media internet yang semakin pesat membuat sistem booking online lapangan futsal lebih cepat dikenal masyarakat
-   Tingginya kebutuhan masyarakat terhadap informasi secara online

### Threats (T)

-   Sistem informasi online kemungkinan dapat diretas oleh pelanggan
-   Banyaknya usaha booking online lapangan futsal dengan sistem yang sama
-   Harus selalu up to date memberikan informasi kepada pelanggan
    Maraknya situs penipuan yang berkedok menyediakan sistem booking online lapangan futsal

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
php artisan storage:link
php artisan serve
# Open http://localhost:8000/
```

## Contributing

Neofutsal dibuat untuk mengikuti event lomba IT Web Apps [TESTIFEST](https://drive.google.com/file/d/1n1jJ6ORmboWOVU5YiMy61IVtr_xnn9EO/view).
Neofutsal dibuat menggunakan :

-   PHP [Laravel 8](https://laravel.com/docs/8.x/installation)
-   CSS [TailwindCSS](https://tailwindcss.com/docs/installation)
-   Template Dashboard Admin [NOW UI Dashboard](https://now-ui-dashboard-laravel.creative-tim.com/docs/getting-started/laravel-setup.html)
