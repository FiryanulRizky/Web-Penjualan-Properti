<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes();

Route::get('/',[App\Http\Controllers\PageController::class, 'index']);
Route::get('/logout', [App\Http\Controllers\PageController::class, 'logout'])->name('logout');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/logout', [App\Http\Controllers\Auth\AdminLoginController::class, 'logout'])->name('admin.logout');

Route::get('/home', [App\Http\Controllers\PageController::class, 'index']);
Route::get('/rumah', [App\Http\Controllers\PageController::class, 'index'])->name('index');
Route::get('/lahan', [App\Http\Controllers\PageController::class, 'lahan'])->name('lahan');
Route::get('/apartemen', [App\Http\Controllers\PageController::class, 'apartemen'])->name('apartemen');
Route::get('/gedung', [App\Http\Controllers\PageController::class, 'gedung'])->name('gedung');
Route::get('/gudang', [App\Http\Controllers\PageController::class, 'gudang'])->name('gudang');
Route::get('/blog', [App\Http\Controllers\PageController::class, 'blog'])->name('blog');
Route::get('/tentangkami', [App\Http\Controllers\PageController::class, 'tentangkami'])->name('tentangkami');
Route::get('/kontak_kami', [App\Http\Controllers\PageController::class, 'kontak_kami'])->name('kontak_kami');

Route::get('/tambahproperti', [App\Http\Controllers\PageController::class, 'tambahProperti']);
Route::get('/tambah/rumah', [App\Http\Controllers\PageController::class, 'tambahRumah']);
Route::post('/tambah/rumah', [App\Http\Controllers\PropertyController::class, 'tambahRumah']);
Route::get('/tambah/lahan', [App\Http\Controllers\PageController::class, 'tambahLahan']);
Route::post('/tambah/lahan', [App\Http\Controllers\PropertyController::class, 'tambahLahan']);
Route::get('/tambah/gedung', [App\Http\Controllers\PageController::class, 'tambahGedung']);
Route::post('/tambah/gedung', [App\Http\Controllers\PropertyController::class, 'tambahGedung']);
Route::get('/tambah/apartemen', [App\Http\Controllers\PageController::class, 'tambahApartemen']);
Route::post('/tambah/apartemen', [App\Http\Controllers\PropertyController::class, 'tambahApartemen']);
Route::get('/tambah/gudang', [App\Http\Controllers\PageController::class, 'tambahGudang']);
Route::post('/tambah/gudang', [App\Http\Controllers\PropertyController::class, 'tambahGudang']);


Route::get('/tambah/map', [App\Http\Controllers\PageController::class, 'dismap']);



Route::get('/rumah/cari', [App\Http\Controllers\PageController::class, 'carirumah']);
Route::get('/rumah/{house}', [App\Http\Controllers\RumahController::class, 'tampilRumah']);
Route::get('/admin/rumah/{house}', [App\Http\Controllers\RumahController::class, 'tampilRumahAdmin']);
Route::post('/rumah/{house}', [App\Http\Controllers\RumahController::class, 'cariRumah']);
Route::post('/rumah/{house}/transaksi', [App\Http\Controllers\TransaksiController::class, 'transaksiRumah']);
Route::post('/rumah/{house}/kontakpemilik', [App\Http\Controllers\UserEmailController::class, 'kontakRumah']);
Route::post('/rumah/{house}/report', [App\Http\Controllers\ReportPropertyController::class, 'reportRumah']);
Route::get('/rumah/{house}/favorit', [App\Http\Controllers\FavoritController::class, 'RumahFavorit']);
Route::get('/profil/rumah/{house}/edit', [App\Http\Controllers\RumahController::class, 'tampilEditRumah'])->middleware('auth');
Route::get('/admin/rumah/{house}/edit', [App\Http\Controllers\AdminController::class, 'tampilAdminEditRumah'])->middleware('auth:admin');
Route::post('/admin/rumah/{house}/edit', [App\Http\Controllers\RumahController::class, 'editRumah']);
Route::post('/profil/rumah/{house}/edit', [App\Http\Controllers\RumahController::class, 'editRumah']);
Route::post('/profil/rumah/{house}/hapus', [App\Http\Controllers\RumahController::class, 'hapusRumah']);
Route::post('/admin/rumah/{house}/hapus', [App\Http\Controllers\RumahController::class, 'hapusRumah'])->middleware('auth:admin');

Route::get('/lahan/cari', [App\Http\Controllers\PageController::class, 'carilahan']);
Route::get('/lahan/{land}', [App\Http\Controllers\LahanController::class, 'tampilLahan']);
Route::get('/admin/lahan/{land}', [App\Http\Controllers\LahanController::class, 'tampilLahanAdmin']);
Route::post('/lahan/{land}', [App\Http\Controllers\LahanController::class, 'cariLahan']);
Route::post('/lahan/{land}/transaksi', [App\Http\Controllers\TransaksiController::class, 'transaksiLahan']);
Route::post('/lahan/{land}/kontakpemilik', [App\Http\Controllers\UserEmailController::class, 'kontakLahan']);
Route::post('/lahan/{land}/report', [App\Http\Controllers\ReportPropertyController::class, 'reportLahan']);
Route::get('/lahan/{land}/favorit', [App\Http\Controllers\FavoritController::class, 'LahanFavorit']);
Route::get('/profil/lahan/{land}/edit', [App\Http\Controllers\LahanController::class, 'tampilEditLahan'])->middleware('auth');
Route::get('/admin/lahan/{land}/edit', [App\Http\Controllers\AdminController::class, 'tampilAdminEditLahan'])->middleware('auth:admin');
Route::post('/admin/lahan/{land}/edit', [App\Http\Controllers\LahanController::class, 'editLahan']);
Route::post('/profil/lahan/{land}/edit', [App\Http\Controllers\LahanController::class, 'editLahan']);
Route::post('/profil/lahan/{land}/hapus', [App\Http\Controllers\LahanController::class, 'hapusLahan']);
Route::post('/admin/lahan/{land}/hapus', [App\Http\Controllers\LahanController::class, 'hapusLahanAdmin'])->middleware('auth:admin');

Route::get('/gedung/cari', [App\Http\Controllers\PageController::class, 'carigedung']);
Route::get('/gedung/{building}', [App\Http\Controllers\GedungController::class, 'tampilGedung']);
Route::get('/admin/gedung/{building}', [App\Http\Controllers\GedungController::class, 'tampilGedungAdmin']);
Route::post('/gedung/{building}', [App\Http\Controllers\GedungController::class, 'cariGedung']);
Route::post('/gedung/{building}/transaksi', [App\Http\Controllers\TransaksiController::class, 'transaksiGedung']);
Route::post('/gedung/{building}/kontakpemilik', [App\Http\Controllers\UserEmailController::class, 'kontakBangunan']);
Route::post('/gedung/{building}/report', [App\Http\Controllers\ReportPropertyController::class, 'reportGedung']);
Route::get('/gedung/{building}/favorit', [App\Http\Controllers\FavoritController::class, 'GedungFavorit']);
Route::get('/profil/gedung/{building}/edit', [App\Http\Controllers\GedungController::class, 'tampilEditGedung'])->middleware('auth');
Route::get('/admin/gedung/{building}/edit', [App\Http\Controllers\AdminController::class, 'tampilAdminEditGedung'])->middleware('auth:admin');
Route::post('/admin/gedung/{building}/edit', [App\Http\Controllers\GedungController::class, 'editGedung']);
Route::post('/profil/gedung/{building}/edit', [App\Http\Controllers\GedungController::class, 'editGedung']);
Route::post('/profil/gedung/{building}/hapus', [App\Http\Controllers\GedungController::class, 'hapusGedung']);
Route::post('/admin/gedung/{building}/hapus', [App\Http\Controllers\GedungController::class, 'hapusGedung'])->middleware('auth:admin');

Route::get('/apartemen/cari', [App\Http\Controllers\PageController::class, 'cariapartemen']);
Route::get('/apartemen/{apartment}', [App\Http\Controllers\ApartemenController::class, 'tampilApartemen']);
Route::get('/admin/apartemen/{apartment}', [App\Http\Controllers\ApartemenController::class, 'tampilApartemenAdmin']);
Route::post('/apartemen/{apartment}', [App\Http\Controllers\ApartemenController::class, 'cariApartemen']);
Route::post('/apartemen/{apartment}/transaksi', [App\Http\Controllers\TransaksiController::class, 'transaksiApartemen']);
Route::post('/apartemen/{apartment}/kontakpemilik', [App\Http\Controllers\UserEmailController::class, 'kontakApartemen']);
Route::post('/apartemen/{apartment}/report', [App\Http\Controllers\ReportPropertyController::class, 'reportApartemen']);
Route::get('/apartemen/{apartment}/favorit', [App\Http\Controllers\FavoritController::class, 'ApartemenFavorit']);
Route::get('/profil/apartemen/{apartment}/edit', [App\Http\Controllers\ApartemenController::class, 'tampilEditApartemen'])->middleware('auth');
Route::get('/admin/apartemen/{apartment}/edit', [App\Http\Controllers\AdminController::class, 'tampilAdminEditApartemen'])->middleware('auth:admin');
Route::post('/admin/apartemen/{apartment}/edit', [App\Http\Controllers\ApartemenController::class, 'editApartemen']);
Route::post('/profil/apartemen/{apartment}/edit', [App\Http\Controllers\ApartemenController::class, 'editApartemen']);
Route::post('/profil/apartemen/{apartment}/hapus', [App\Http\Controllers\ApartemenController::class, 'hapusApartemen']);
Route::post('/admin/apartemen/{apartment}/hapus', [App\Http\Controllers\ApartemenController::class, 'hapusApartemen'])->middleware('auth:admin');

Route::get('/gudang/cari', [App\Http\Controllers\PageController::class, 'carigudang']);
Route::get('/gudang/{warehouse}', [App\Http\Controllers\GudangController::class, 'tampilGudang']);
Route::get('/admin/gudang/{warehouse}', [App\Http\Controllers\GudangController::class, 'tampilGudangAdmin']);
Route::post('/gudang/{warehouse}', [App\Http\Controllers\GudangController::class, 'cariGudang']);
Route::post('/gudang/{warehouse}/transaksi', [App\Http\Controllers\TransaksiController::class, 'transaksiGudang']);
Route::post('/gudang/{warehouse}/kontakpemilik', [App\Http\Controllers\UserEmailController::class, 'kontakGudang']);
Route::post('/gudang/{warehouse}/report', [App\Http\Controllers\ReportPropertyController::class, 'reportGudang']);
Route::get('/gudang/{warehouse}/favorit', [App\Http\Controllers\FavoritController::class, 'GudangFavorit']);
Route::get('/profil/gudang/{warehouse}/edit', [App\Http\Controllers\GudangController::class, 'tampilEditGudang'])->middleware('auth');
Route::get('/admin/gudang/{warehouse}/edit', [App\Http\Controllers\AdminController::class, 'tampilAdminEditGudang'])->middleware('auth:admin');
Route::post('/admin/gudang/{warehouse}/edit', [App\Http\Controllers\GudangController::class, 'editGudang']);
Route::post('/profil/gudang/{warehouse}/edit', [App\Http\Controllers\GudangController::class, 'editGudang']);
Route::post('/profil/gudang/{warehouse}/hapus', [App\Http\Controllers\GudangController::class, 'hapusGudang']);
Route::post('/admin/gudang/{warehouse}/hapus', [App\Http\Controllers\GudangController::class, 'hapusGudang'])->middleware('auth:admin');



//General Route
Route::post('/sendmessage', [App\Http\Controllers\MessageController::class, 'contactUsEmail'])->middleware('guest');

//User Profile Section
Route::get('/profil', [App\Http\Controllers\ProfilController::class, 'loadUserDashboard'])->middleware('auth');
Route::get('/profil/gantipassword', [App\Http\Controllers\PageController::class, 'gantiPassword'])->middleware('auth');
Route::get('/profil/editprofil', [App\Http\Controllers\PageController::class, 'editprofil'])->middleware('auth');
Route::get('/profil/favoritsaya', [App\Http\Controllers\ProfilController::class, 'tampilFavorit'])->middleware('auth');
Route::post('/profil/favoritsaya/{favorite}/hapus', [App\Http\Controllers\ProfilController::class, 'hapusFavorit'])->middleware('auth');
Route::get('/profil/pesan', [App\Http\Controllers\ProfilController::class, 'PesanSaya'])->middleware('auth');
Route::get('/profil/pesan/semua', [App\Http\Controllers\ProfilController::class, 'tampilSemuaPesan'])->middleware('auth');
Route::get('/profil/pesan/{message}/tampil', [App\Http\Controllers\ProfilController::class, 'tampilPesan'])->middleware('auth');
Route::get('/profil/pesan/{message}/hapus', [App\Http\Controllers\ProfilController::class, 'hapusPesan'])->middleware('auth');
Route::post('/profil/pesan/balas', [App\Http\Controllers\UserEmailController::class, 'balasPesan'])->middleware('auth');
Route::get('/profil/hapusakun', [App\Http\Controllers\PageController::class, 'hapusakun'])->middleware('auth');
Route::get('/profil/rumahsaya', [App\Http\Controllers\PageController::class, 'RumahSaya'])->middleware('auth');
Route::get('/profil/lahansaya', [App\Http\Controllers\PageController::class, 'LahanSaya'])->middleware('auth');
Route::get('/profil/apartemensaya', [App\Http\Controllers\PageController::class, 'ApartemenSaya'])->middleware('auth');
Route::get('/profil/gedungsaya', [App\Http\Controllers\PageController::class, 'GedungSaya'])->middleware('auth');
Route::get('/profil/gudangsaya', [App\Http\Controllers\PageController::class, 'GudangSaya'])->middleware('auth');
Route::get('/profil/semuatransaksi', [App\Http\Controllers\ProfilController::class, 'semuaTransaksi'])->middleware('auth');
Route::get('/profil/transaksisaya', [App\Http\Controllers\ProfilController::class, 'TransaksiSaya'])->middleware('auth');
Route::get('/profil/transaksi/{offer}/kontak', [App\Http\Controllers\ProfilController::class, 'kontakTransaksi'])->middleware('auth');
Route::post('/profil/transaksi/kontak/kirim', [App\Http\Controllers\UserEmailController::class, 'kirimKontakTransaksi'])->middleware('auth');
Route::get('/profil/transaksi/{offer}/kontak/pemilik', [App\Http\Controllers\ProfilController::class, 'kontakPemilikTransaksi'])->middleware('auth');
Route::post('/profil/transaksi/contact/pemilik/kirim', [App\Http\Controllers\UserEmailController::class, 'kirimKontakPemilikTransaksi'])->middleware('auth');
Route::get('/profil/terjual', [App\Http\Controllers\ProfilController::class, 'tampilPropertiTerjual'])->middleware('auth');
Route::get('/profil/terjual/{property}/tandaiterjual', [App\Http\Controllers\ProfilController::class, 'tandaiTerjual'])->middleware('auth');
Route::get('/profil/terjual/{property}/tandaibelumterjual', [App\Http\Controllers\ProfilController::class, 'tandaiBelumTerjual'])->middleware('auth');
Route::post('/profil/updateavatar', [App\Http\Controllers\ProfilController::class, 'updateAvatar'])->middleware('auth');
Route::post('/profil/user/{user}/hapus', [App\Http\Controllers\ProfilController::class, 'hapusAkunUser'])->middleware('auth');
Route::post('/profil/updateakun', [App\Http\Controllers\ProfilController::class, 'updateAkun'])->middleware('auth');
Route::post('/profil/updatepassword', [App\Http\Controllers\ProfilController::class, 'gantiPassword'])->middleware('auth');

//Admin Panel
Route::post('/admin/updateavatar', [App\Http\Controllers\AdminController::class, 'updateAvatar'])->middleware('auth:admin');
Route::get('/admin/user/{user}/tampil', [App\Http\Controllers\AdminController::class, 'tampilUser'])->middleware('auth:admin');
Route::get('/admin/properti/semua', [App\Http\Controllers\AdminController::class, 'tampilSemuaProperti'])->middleware('auth:admin');
Route::get('/admin/properti/rumah', [App\Http\Controllers\AdminController::class, 'tampilSemuaRumah'])->middleware('auth:admin');
Route::get('/admin/properti/lahan', [App\Http\Controllers\AdminController::class, 'tampilSemuaLahan'])->middleware('auth:admin');
Route::get('/admin/properti/gedung', [App\Http\Controllers\AdminController::class, 'tampilSemuaGedung'])->middleware('auth:admin');
Route::get('/admin/properti/apartemen', [App\Http\Controllers\AdminController::class, 'tampilSemuaApartemen'])->middleware('auth:admin');
Route::get('/admin/properti/gudang', [App\Http\Controllers\AdminController::class, 'tampilSemuaGudang'])->middleware('auth:admin');
Route::get('/admin/user/semua', [App\Http\Controllers\AdminController::class, 'tampilSemuaUser'])->middleware('auth:admin');
Route::get('/admin/user/{user}/kontak', [App\Http\Controllers\AdminController::class, 'adminKontakUser'])->middleware('auth:admin');
Route::post('/admin/user/kontak', [App\Http\Controllers\AdminController::class, 'adminKirimKontakUser'])->middleware('auth:admin');
Route::get('/admin/user/{user}/edit', [App\Http\Controllers\AdminController::class, 'tampilAdminEditUser'])->middleware('auth:admin');
Route::post('/admin/user/edit', [App\Http\Controllers\AdminController::class, 'adminEditUser'])->middleware('auth:admin');
Route::post('/admin/user/{user}/hapus', [App\Http\Controllers\AdminController::class, 'adminHapusUser'])->middleware('auth:admin');
Route::get('/admin/user/tambah', [App\Http\Controllers\AdminController::class, 'tampilAdminTambahUser'])->middleware('auth:admin');
Route::post('/admin/user/tambah', [App\Http\Controllers\AdminController::class, 'adminTambahUser'])->middleware('auth:admin');
Route::get('/admin/semua', [App\Http\Controllers\AdminController::class, 'tampilSemuaAdmin'])->middleware('auth:admin');
Route::get('/admin/tambah', [App\Http\Controllers\AdminController::class, 'tampilTambahAdmin'])->middleware('auth:admin');
Route::post('/admin/tambah', [App\Http\Controllers\AdminController::class, 'tambahAdmin'])->middleware('auth:admin');
Route::get('/admin/{admin}/edit', [App\Http\Controllers\AdminController::class, 'tampilEditAdmin'])->middleware('auth:admin');
Route::post('/admin/edit', [App\Http\Controllers\AdminController::class, 'editAdmin'])->middleware('auth:admin');
Route::post('/admin/{admin}/hapus', [App\Http\Controllers\AdminController::class, 'hapusAdmin'])->middleware('auth:admin');
Route::get('/admin/report', [App\Http\Controllers\AdminController::class, 'tampilReport'])->middleware('auth:admin');
Route::post('/admin/report/{property}/lock', [App\Http\Controllers\AdminController::class, 'lockProperti'])->middleware('auth:admin');
Route::post('/admin/report/{property}/unlock', [App\Http\Controllers\AdminController::class, 'unlockProperti'])->middleware('auth:admin');
Route::get('/admin/artikel', [App\Http\Controllers\AdminController::class, 'semuaArtikel'])->middleware('auth:admin');
Route::post('/admin/blog/{article}/hapus', [App\Http\Controllers\AdminController::class, 'hapusArtikel'])->middleware('auth:admin');
Route::get('/admin/pertanyaan/tampil', [App\Http\Controllers\AdminController::class, 'semuaPertanyaan'])->middleware('auth:admin');
Route::get('/admin/pertanyaan/{message}/balas', [App\Http\Controllers\AdminController::class, 'tampilBalasPertanyaan'])->middleware('auth:admin');
Route::post('/admin/pertanyaan/balas', [App\Http\Controllers\AdminController::class, 'balasPertanyaan'])->middleware('auth:admin');
Route::post('/admin/pertanyaan/{message}/hapus', [App\Http\Controllers\AdminController::class, 'hapusPertanyaan'])->middleware('auth:admin');

//Blog
Route::get('/blog', [App\Http\Controllers\PageController::class, 'tampilBlog']);
Route::get('/blog/{article}/tampil', [App\Http\Controllers\PageController::class, 'tampilBlogPost']);
Route::get('/blog/baru', [App\Http\Controllers\ArtikelController::class, 'BlogPostBaru'])->middleware('auth:admin');
Route::post('/blog/baru', [App\Http\Controllers\ArtikelController::class, 'tambahBlogPost'])->middleware('auth:admin');
Route::get('/blog/{article}/edit', [App\Http\Controllers\ArtikelController::class, 'tampilEditBlogPost'])->middleware('auth:admin');
Route::post('/blog/{article}/edit', [App\Http\Controllers\ArtikelController::class, 'editBlogPost'])->middleware('auth:admin');
Route::post('/blog/komen', [App\Http\Controllers\KomentarController::class, 'tambahKomentar']);
Route::get('/blog/komen/{comment}/hapus', [App\Http\Controllers\KomentarController::class, 'hapusKomentar'])->middleware('auth:admin');
Route::get('/blog/komen/{comment}/hapus/user', [App\Http\Controllers\KomentarController::class, 'hapusKomentar'])->middleware('auth');

// Auth::routes();
Auth::routes(['verify' => true]);

