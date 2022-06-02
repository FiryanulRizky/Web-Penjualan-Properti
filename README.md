<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Projek Web Penjualan Properti

Platform tansaksi yang melibatkan kesepakatan antara pembeli dengan agen properti.

## Teknologi Yang Digunakan

- Framework laravel 9.11
- PHP 8.1.4
- DBMS MySQL

## Highlight Fitur

- Login dengan Autentikasi Multi-level
- Tersedia panel Admin dan Super Admin
- Verifikasi Google reCAPTCHA (V3 – Validasi Pengguna Otomatis) 
- Fitur kirim dan terima Email (Gunakan SMTP dari Mailtrap jika hendak menjalankan fitur ini via lokal)
- Support upload multiple image menggunakan library Image Handling ( "intervention/image")
- Menggunakan Googlecharts.Js dalam memvisualisasikan data transaksi ke dalam bentuk diagram (library "consoletvs/charts")
- Menggunakan sweetalert dalam tampilan notifikasi (library "realrashid/sweet-alert")

## Catatan

- Untuk menggunakan Fitur Pesan, perlu menggunakan layanan SMTP seperti contohnya mailtrap, daftar ke [mailtrap.io](https://mailtrap.io/), lalu buat layanan SMTP disana secara gratis.
- Setelah membuat SMTP, pastikan sudah mendapatkan informasi seperti berikut :

![smtp](https://user-images.githubusercontent.com/60762912/171605856-20ef75ea-e2cb-459d-9a24-ef7c5f9bc85f.PNG)

- Lalu Setting .env sesuai informasi yang didapat :

![env](https://user-images.githubusercontent.com/60762912/171605874-405c8f6d-e123-494d-802c-e34cf6226f9e.PNG)

## Screenshot Tampilan Antarmuka

![1  Home](https://user-images.githubusercontent.com/60762912/171592715-80036c85-820f-4ca0-9615-a063f07046bd.png)

![2  Register](https://user-images.githubusercontent.com/60762912/170884935-8443a64c-78eb-4d81-999d-119bb970f322.png)

![3  Verifikasi Email](https://user-images.githubusercontent.com/60762912/170884939-269dac79-e5a0-49ef-acfc-9e23222a8e4b.png)

![4  Email Verifikasi Masuk](https://user-images.githubusercontent.com/60762912/170884940-6a1eddf7-effe-45e9-8b31-7a4b47bdc4fc.png)

![5  Login](https://user-images.githubusercontent.com/60762912/170884941-001414bc-9a51-41fb-a9a6-a611ae59402e.png)

![6  Tambah Property](https://user-images.githubusercontent.com/60762912/170884942-a71e3fd0-795b-475f-b7f0-65541da04561.png)

![7  Edit Property](https://user-images.githubusercontent.com/60762912/171574269-23987006-3eb5-4f79-aefc-85600e026750.png)

![8  Pengajuan Transaksi](https://user-images.githubusercontent.com/60762912/170884956-4d4dcba3-4945-473f-8fe0-4b53299ccc95.png)

![9  Pengajuan Transaksi Berhasil](https://user-images.githubusercontent.com/60762912/171609901-6edf6d96-5ed7-402e-adf5-5b456d576688.png)

![10  Daftar Transaksi](https://user-images.githubusercontent.com/60762912/170884967-9b636c41-1404-4c9e-9c46-6deddf8bf7bd.png)

![11  Pesan Transaksi](https://user-images.githubusercontent.com/60762912/171592814-a7eacb8c-5976-46f5-8617-55298746b565.png)

![12  Daftar Pesan Masuk](https://user-images.githubusercontent.com/60762912/171573151-c4313b50-550e-42c3-a877-cbe23bdf792a.png)

![15  Blogpost](https://user-images.githubusercontent.com/60762912/171573088-6377ed5b-9f6d-4911-9ee3-8e2c75a23385.png)

![13  Login Admin](https://user-images.githubusercontent.com/60762912/170884976-3a09247a-3a71-4eb0-84c4-7dcf57376d99.png)

![14  Dashboard Admin](https://user-images.githubusercontent.com/60762912/171573080-ab07aca1-d694-4855-8668-1c7cba5b4c1a.png)

## Catatan Untuk Fitur Super Admin

- Untuk Login Super Admin bisa dilakukan dengan mengakses http://127.0.0.1:8000/admin/login (jika dijalankan secara lokal).
- Antarmuka Register Super Admin tidak disertakan pada projek ini, cara alternatif untuk dapat mengakses panel super admin adalah melakukan input data manual ke tabel admins pada database setelah melakukan migrasi.
- Berikut adalah Informasi yang bisa dimasukkan ke tabel admins : (catatan untuk password gunakan format enkripsi, misal 12345678 : $2y$10$tjEkfXLiHAgvgAD.2uDb4uxgQD1xxS4a2y85C4hmeCOgO3NP.fewy , kemudian masukkan value 1 pada kolom isSuper)

![super admin manual](https://user-images.githubusercontent.com/60762912/171594659-f678061b-94ab-4164-b213-e0ad207c8706.PNG)

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
