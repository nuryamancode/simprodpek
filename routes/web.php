<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerifikasiController;
use App\Http\Controllers\Auth\LupaPasswordController;
use App\Http\Controllers\Direktur\DirekturController;
use App\Http\Controllers\Direktur\KalenderController;
use App\Http\Controllers\Direktur\KlienController;
use App\Http\Controllers\Direktur\PenilaianController;
use App\Http\Controllers\Direktur\PeriodeController;
use App\Http\Controllers\Direktur\ProyekController;
use App\Http\Controllers\Direktur\TimController;
use App\Http\Controllers\Direktur\TugasController;
use App\Http\Controllers\General\GeneralController;
use App\Http\Controllers\HR\BidangController;
use App\Http\Controllers\HR\DataKaryawanController;
use App\Http\Controllers\HR\HRController;
use App\Http\Controllers\HR\JenisPenilaianController;
use App\Http\Controllers\HR\KelolaPenilaianController;
use App\Http\Controllers\HR\KelolaPenilaiController;
use App\Http\Controllers\HR\KriteriaController;
use App\Http\Controllers\HR\LaporanKinerjaController;
use App\Http\Controllers\HR\ManajemenUserController;
use App\Http\Controllers\HR\SubKriteriaController;
use App\Http\Controllers\Karyawan\HasilKinerjaController;
use App\Http\Controllers\Karyawan\KaryawanController;
use App\Http\Controllers\Karyawan\PenilaianRekanKerjaController;
use App\Http\Controllers\Karyawan\TugasProyekController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/maintenance', function(){return view('components.maintenance');})->name('maintenance');
Route::get('/home', [AuthController::class, 'home_redirect']);
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'home'])->name('home');
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/proses-register', [AuthController::class, 'proses_register'])->name('proses.register');
    Route::get('/lupa-password', [LupaPasswordController::class, 'index'])->name('password.request');
    Route::get('/reset-password', [LupaPasswordController::class, 'index2'])->name('password.reset');
    Route::post('/lupa-password', [LupaPasswordController::class, 'forget_password_send'])->name('password.email');
    Route::post('/reset-password', [LupaPasswordController::class, 'reset_password'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    // general
    Route::get('/email/verify', [EmailVerifikasiController::class, 'index'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [EmailVerifikasiController::class, 'handler_verification'])->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerifikasiController::class, 'resend_email'])->middleware('throttle:6,1')->name('verification.send');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // karyawan
    Route::middleware('perm:Karyawan')->prefix('/karyawann')->name('karyawan')->group(function () {
        // dashboard
        Route::get('/', [KaryawanController::class, 'index'])->name('.dashboard');

        // profil
        Route::get('/profil', [KaryawanController::class, 'profil'])->name('.profil');
        Route::get('/edit-profil', [KaryawanController::class, 'edit'])->name('.edit.profil');
        Route::put('/profil-update', [KaryawanController::class, 'update'])->name('.update.profil');

        // notifikasi
        Route::get('/notifikasi', [KaryawanController::class, 'notifikasi'])->name('.notifikasi');
        Route::get('/baca-notifikasi/{id_notifikasi}', [GeneralController::class, 'notifikasi_dibaca'])->name('.notifikasi.dibaca');
        Route::delete('/hapus-semua-notifikasi', [GeneralController::class, 'delete_all_notifikasi'])->name('.hapus.semua.notifikasi');

        // daftar tugas
        Route::get('/tugas-karyawan', [TugasProyekController::class, 'index'])->name('.tugas.karyawan');
        Route::get('/tugas-karyawan-detail/{id_tugas}', [TugasProyekController::class, 'detail'])->name('.tugas.karyawan.detail');
        Route::put('/tugas-karyawan-upload/{id_tugas}', [TugasProyekController::class, 'upload'])->name('.tugas.karyawan.upload');
        Route::get('/tugas-download-berkas/{berkas}', [GeneralController::class, 'download_berkas_proyek'])->name('.tugas.download.berkas');
        Route::get('/tugas-download-hasil/{uploadberkas}', [GeneralController::class, 'download_hasil_proyek'])->name('.tugas.download.hasil');

        // tugas selesai
        Route::get('/tugas-selesai', [TugasProyekController::class, 'tugas_selesai'])->name('.tugas.selesai.karyawan');
        Route::get('/tugas-selesai-detail/{id_tugas}', [TugasProyekController::class, 'detail_tugas_selesai'])->name('.tugas.selesai.karyawan.detail');

        //penilaian rekan kerja
        Route::get('/penilaian-rekankerja', [PenilaianRekanKerjaController::class, 'index'])->name('.penilaian.rekankerja');
        Route::post('/penilaian-rekankerja/save/{penilaiansatu_id}', [PenilaianRekanKerjaController::class, 'save_penilaianrekan'])->name('.penilaian.satu');
        Route::get('/penilaian/{penilaiansatu_id}', [PenilaianRekanKerjaController::class, 'penilaian'])->name('.penilaian');
        Route::post('/penilaian-save', [PenilaianRekanKerjaController::class, 'hasil_penilaian'])->name('.hasil.penilaian');



        // hasil kinerja karyawan
        // Route::get('/hasil-kinerja', [HasilKinerjaController::class, 'index'])->name('.hasil.kinerja');
        // Route::get('/hasil-kinerja-detail/{id}', [HasilKinerjaController::class, 'detail'])->name('.detail.hasil.kinerja');

    });


    // direktur
    Route::middleware('perm:Direktur')->prefix('/direktur')->name('direktur')->group(function () {
        // dashboard
        Route::get('/', [DirekturController::class, 'index'])->name('.dashboard');

        // profil
        Route::get('/profil', [DirekturController::class, 'profil'])->name('.profil');
        Route::get('/edit-profil', [DirekturController::class, 'edit'])->name('.edit.profil');
        Route::put('/profil-update', [DirekturController::class, 'update'])->name('.update.profil');

        // notifikasi
        Route::get('/notifiksi', [DirekturController::class, 'notifikasi'])->name('.notifiksai');
        Route::get('/baca-notifiksi/{id_notifikasi}', [GeneralController::class, 'notifikasi_dibaca'])->name('.notifiksai.dibaca');
        Route::delete('/hapus-semua-notifikasi', [GeneralController::class, 'delete_all_notifikasi'])->name('.hapus.semua.notifiksai');

        // proyek
        Route::get('/proyek', [ProyekController::class, 'index'])->name('.proyek');
        Route::get('/proyek-delete/{proyek}', [ProyekController::class, 'delete'])->name('.delete.proyek');
        Route::post('/proyek-save', [ProyekController::class, 'save'])->name('.save.proyek');
        Route::put('/proyek-update/{id_proyek}', [ProyekController::class, 'update'])->name('.update.proyek');
        Route::put('/proyek-selesai/{proyek_id}', [ProyekController::class, 'proyek_selesai'])->name('.proyek.selesai');

        // tugas
        Route::get('/tugas/{id_proyek}', [TugasController::class, 'tugas'])->name('.tugas');
        Route::get('/tugas-delete/{tugas}', [TugasController::class, 'delete'])->name('.delete.tugas');
        Route::post('/tugas-save', [TugasController::class, 'save'])->name('.save.tugas');
        Route::put('/tugas-update/{id_tugas}', [TugasController::class, 'update'])->name('.update.tugas');
        Route::put('/tugas-selesai/{id_tugas}', [TugasController::class, 'tugas_selesai'])->name('.tugas.selesai');
        Route::put('/tugas-belum-selesai/{id_tugas}', [TugasController::class, 'tugas_belum_selesai'])->name('.tugas.belum.selesai');
        Route::put('/tugas-dilihat/{id_tugas}', [TugasController::class, 'tugas_dilihat'])->name('.tugas.dilihat');
        Route::get('/tugas-download-berkas/{berkas}', [GeneralController::class, 'download_berkas_proyek'])->name('.tugas.download.berkas');
        Route::get('/tugas-download-hasil/{uploadberkas}', [GeneralController::class, 'download_hasil_proyek'])->name('.tugas.download.hasil');

        // laporan proyek selesai
        Route::get('/laporan-proyek', [ProyekController::class, 'laporan'])->name('.laporan.proyek');

        // kalender
        Route::get('/kalender-proyek', [KalenderController::class, '__invoke'])->name('.kalender.proyek');
        Route::get('/kalender-proyek/delete/{kalender}', [KalenderController::class, 'delete'])->name('.delete.kalender.proyek');
        Route::post('/kalender-proyek/save', [KalenderController::class, 'save'])->name('.save.kalender.proyek');

        // klien
        Route::get('/klien', [KlienController::class, 'index'])->name('.klien');
        Route::get('/klien-delete/{klien}', [KlienController::class, 'delete'])->name('.delete.klien');
        Route::post('/klien-save', [KlienController::class, 'save'])->name('.save.klien');
        Route::put('/klien-update/{id_klien}', [KlienController::class, 'update'])->name('.update.klien');
        Route::get('/klien-download-berkas/{berkas_klien}', [GeneralController::class, 'download_berkas_klien'])->name('.klien.download.berkas');

        // tim
        Route::get('/tim', [TimController::class, 'index'])->name('.tim');
        Route::post('/tim-save', [TimController::class, 'save'])->name('.save.tim');

        // penilaian
        Route::get('/penilaian/{penilaian_id}', [PenilaianController::class, 'penilaian'])->name('.penilaian');
        Route::post('/penilaian-save', [PenilaianController::class, 'hasil_penilaian'])->name('.hasil.penilaian');
        Route::post('/penilaian-save-penilai{penilaian_id}', [PenilaianController::class, 'save_penilaiankaryawan'])->name('.penilaian.satu');
        Route::get('/penilaian', [PenilaianController::class, 'index'])->name('.kelola.penilaian');


    });



    // hr
    Route::middleware('perm:Human Resource')->prefix('/hr')->name('hr')->group(function () {
        // dashboard
        Route::get('/', [HRController::class, 'index'])->name('.dashboard');

        // profil
        Route::get('/profil', [HRController::class, 'profil'])->name('.profil');
        Route::get('/edit-profil', [HRController::class, 'edit'])->name('.edit.profil');
        Route::put('/update-profil', [HRController::class, 'update'])->name('.update.profil');
        Route::post('/ganti-password', [HRController::class, 'ganti_password'])->name('.ganti.password');

        // bidang
        Route::get('/bidang', [BidangController::class, 'index'])->name('.bidang');
        Route::get('/bidang-delete/{bidang}', [BidangController::class, 'delete'])->name('.delete.bidang');
        Route::post('/bidang-save', [BidangController::class, 'save'])->name('.save.bidang');
        Route::put('/bidang-update/{id_bidang}', [BidangController::class, 'update'])->name('.update.bidang');

        // data karyawan
        Route::get('/data-karyawan', [DataKaryawanController::class, 'index'])->name('.data.karyawan');
        Route::get('/data-karyawan-delete/{id}', [DataKaryawanController::class, 'delete'])->name('.delete.data.karyawan');
        Route::put('/data-karyawan-bidang/{id_karyawan}', [DataKaryawanController::class, 'tambah_bidang'])->name('.add.bidang.data.karyawan');

        // jenispenilaian
        Route::get('/jenis-penilaian', [JenisPenilaianController::class, 'index'])->name('.jenis.penilaian');
        Route::get('/jenis-penilaian-delete/{id}', [JenisPenilaianController::class, 'delete'])->name('.delete.jenis.penilaian');
        Route::post('/jenis-penilaian-save', [JenisPenilaianController::class, 'save'])->name('.save.jenis.penilaian');
        Route::put('/jenis-penilaian-update/{id}', [JenisPenilaianController::class, 'update'])->name('.update.jenis.penilaian');

        // kriteria
        Route::get('/kriteria', [KriteriaController::class, 'index'])->name('.kriteria');
        // kriteria direktur
        Route::get('/kriteria-direktur-delete/{kriteria}', [KriteriaController::class, 'delete_kriteria_direktur'])->name('.delete.kriteria.direktur');
        Route::post('/kriteria-direktur-save', [KriteriaController::class, 'save_kriteria_direktur'])->name('.save.kriteria.direktur');
        Route::put('/kriteria-direktur-update/{id_kriteria}', [KriteriaController::class, 'update_kriteria_direktur'])->name('.update.kriteria.direktur');

        // kriteria rekan kerja
        Route::get('/kriteria-rekan-kerja-delete/{kriteria}', [KriteriaController::class, 'delete_kriteria_rekan_kerja'])->name('.delete.kriteria.rekan.kerja');
        Route::post('/kriteria-rekan-kerja-save', [KriteriaController::class, 'save_kriteria_rekan_kerja'])->name('.save.kriteria.rekan.kerja');
        Route::put('/kriteria-rekan-kerja-update/{id_kriteria}', [KriteriaController::class, 'update_kriteria_rekan_kerja'])->name('.update.kriteria.rekan.kerja');

        // sub kriteria
        Route::get('/sub-kriteria', [SubKriteriaController::class, 'index'])->name('.sub.kriteria');
        // sub kriteria direktur
        Route::get('/sub-kriteria-direktur-delete/{subKriteria}', [SubKriteriaController::class, 'delete_sub_direktur'])->name('.delete.sub.kriteria.direktur');
        Route::post('/sub-kriteria-direktur-save', [SubKriteriaController::class, 'save_sub_direktur'])->name('.save.sub.kriteria.direktur');
        Route::put('/sub-kriteria-direktur-update/{id_subkriteria}', [SubKriteriaController::class, 'update_sub_direktur'])->name('.update.sub.kriteria.direktur');

        // sub kriteria rekan kerja
        Route::get('/sub-kriteria-rekan-kerja-delete/{subKriteria}', [SubKriteriaController::class, 'delete_sub_rekan_kerja'])->name('.delete.sub.kriteria.rekan.kerja');
        Route::post('/sub-kriteria-rekan-kerja-save', [SubKriteriaController::class, 'save_sub_rekan_kerja'])->name('.save.sub.kriteria.rekan.kerja');
        Route::put('/sub-kriteria-rekan-kerja-update/{id_subkriteria}', [SubKriteriaController::class, 'update_sub_rekan_kerja'])->name('.update.sub.kriteria.rekan.kerja');

        // kelola penilai
        Route::get('/kelola-penilai', [KelolaPenilaiController::class, 'index'])->name('.kelola.penilai');
        Route::get('/kelola-penilai-delete/{id}', [KelolaPenilaiController::class, 'delete'])->name('.delete.kelola.penilai');
        Route::post('/kelola-penilai-save', [KelolaPenilaiController::class, 'save'])->name('.save.kelola.penilai');
        Route::put('/kelola-penilai-update/{id}', [KelolaPenilaiController::class, 'update'])->name('.update.kelola.penilai');

        // manajemen user
        Route::get('/manajemen-user', [ManajemenUserController::class, 'index'])->name('.manajemen.user');
        Route::get('/manajemen-user-delete/{user}', [ManajemenUserController::class, 'delete'])->name('.delete.manajemen.user');
        Route::post('/manajemen-user-save', [ManajemenUserController::class, 'save'])->name('.save.manajemen.user');
        Route::put('/manajemen-user-update/{id}', [ManajemenUserController::class, 'update'])->name('.update.manajemen.user');

        // penilaian
        Route::get('/kelola-penilaian', [KelolaPenilaianController::class, 'index'])->name('.kelola.penilaian');
        Route::get('/kelola-penilaian-delete/{periode}', [KelolaPenilaianController::class, 'delete'])->name('.delete.kelola.penilaian');
        Route::get('/kelola-penilaian-detail/{id}', [KelolaPenilaianController::class, 'detail'])->name('.detail.kelola.penilaian');
        Route::post('/kelola-penilaian-save', [KelolaPenilaianController::class, 'save'])->name('.save.kelola.penilaian');
        Route::put('/kelola-penilaian-update/{id}', [KelolaPenilaianController::class, 'update'])->name('.update.kelola.penilaian');

        // laporan kinerja
        Route::get('/laporan-kinerja', [LaporanKinerjaController::class, 'index'])->name('.laporan.kinerja');
    });
});
