<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\Level2Controller;
use App\Http\Controllers\Level3Controller;
use App\Http\Controllers\Level4Controller;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\ElementController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DropdownController;
use Illuminate\Support\Facades\Route;
use App\Jenjang;
use App\Prodi;

// Authentication Routes
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('proses', [AuthController::class, 'proses']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Home Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('tabel/{prodi:kode}', [HomeController::class, 'tabel']);
Route::get('tabel/berkas/{element}', [HomeController::class, 'berkas']);
Route::get('tabel/view/{berkas}', [HomeController::class, 'view']);
Route::get('single-search', [HomeController::class, 'singleSearch'])->name('singleSearch');
Route::post('single-search/hasil', [HomeController::class, 'hasilsingleSearch']);
Route::get('multiple-search', [HomeController::class, 'multiSearch'])->name('multipleSearch');
Route::post('multi-search/hasil', [HomeController::class, 'hasilmultiSearch']);
Route::get('diagram', [HomeController::class, 'diagram'])->name('diagram');
Route::get('diagram/login', fn() => redirect()->route('login'));
Route::get('diagram/{prodi:kode}', [HomeController::class, 'radarDiagram']);

// Middleware Protected Routes
Route::middleware(['auth', 'cekRole:Admin,Ketua LPM,Ketua Program Studi,Dosen,UPPS,Mahasiswa,Alumni'])->group(function () {
    $jenjangs = Jenjang::get();
    $prodis = Prodi::get();

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Jenjang
    foreach ($jenjangs as $jenjang) {
        Route::get("kriteria/{$jenjang->kode}", [KriteriaController::class, 'index'])->name($jenjang->kode);
    }

    // Prodi
    foreach ($prodis as $prodi) {
        Route::get("prodi/{$prodi->kode}", [ProdiController::class, 'index'])->name($prodi->kode);
        Route::get("prodi/{$prodi->kode}/{any}", [ProdiController::class, 'butir']);
    }

    // Kriteria
    Route::post('kriteria/store', [KriteriaController::class, 'store']);
    Route::delete('kriteria/hapus/{l1}', [KriteriaController::class, 'hapus']);
    Route::put('kriteria/put/{l1}', [KriteriaController::class, 'put']);

    // Level 2
    foreach ($jenjangs as $jenjang) {
        Route::get("sub-kriteria/l2/{$jenjang->kode}", [Level2Controller::class, 'sort']);
    }
    Route::get('sub-kriteria/l2', [Level2Controller::class, 'index'])->name('level2');
    Route::post('sub-kriteria/l2/post', [Level2Controller::class, 'store']);
    Route::delete('sub-kriteria/l2/hapus/{l2}', [Level2Controller::class, 'hapus']);
    Route::put('sub-kriteria/l2/put/{l2}', [Level2Controller::class, 'put']);

    // Level 3
    foreach ($jenjangs as $jenjang) {
        Route::get("sub-kriteria/l3/{$jenjang->kode}", [Level3Controller::class, 'sort']);
    }
    Route::get('sub-kriteria/l3', [Level3Controller::class, 'index'])->name('level3');
    Route::post('sub-kriteria/l3/post', [Level3Controller::class, 'store']);
    Route::delete('sub-kriteria/l3/hapus/{l3}', [Level3Controller::class, 'hapus']);
    Route::put('sub-kriteria/l3/put/{l3}', [Level3Controller::class, 'put']);

    // Level 4
    foreach ($jenjangs as $jenjang) {
        Route::get("sub-kriteria/l4/{$jenjang->kode}", [Level4Controller::class, 'sort']);
    }
    Route::get('sub-kriteria/l4', [Level4Controller::class, 'index'])->name('level4');
    Route::post('sub-kriteria/l4/post', [Level4Controller::class, 'store']);
    Route::delete('sub-kriteria/l4/hapus/{l4}', [Level4Controller::class, 'hapus']);
    Route::put('sub-kriteria/l4/put/{l4}', [Level4Controller::class, 'put']);

    // Indikator
    foreach ($jenjangs as $jenjang) {
        Route::get("indikator/{$jenjang->kode}", [IndikatorController::class, 'index'])->name("indikator-{$jenjang->kode}");
    }
    Route::post('indikator/store', [IndikatorController::class, 'store']);
    Route::get('indikator/input-score/{indikator}', [IndikatorController::class, 'inputScore']);
    Route::post('indikator/store-score', [IndikatorController::class, 'storeScore']);
    Route::get('indikator/cek-score/{indikator}', [IndikatorController::class, 'cekScore']);
    Route::get('indikator/konfirmasi/{indikator}', [IndikatorController::class, 'konfirmasi']);
    Route::delete('indikator/hapus/{indikator}', [IndikatorController::class, 'hapusIndikator']);
    Route::get('indikator/edit/{indikator}', [IndikatorController::class, 'editFormIndikator']);
    Route::put('indikator/put/{indikator}', [IndikatorController::class, 'putIndikator']);
    Route::get('indikator/konfrimasi-score/{score}', [IndikatorController::class, 'konfirmasiScore']);
    Route::delete('indikator/score-hapus/{score}', [IndikatorController::class, 'hapusScore']);
    Route::get('indikator/score/edit/{score}', [IndikatorController::class, 'editScore']);
    Route::put('indikator/score/put/{score}', [IndikatorController::class, 'putScore']);

    // Element
    foreach ($prodis as $prodi) {
        Route::get("element/{$prodi->kode}", [ElementController::class, 'index'])->name("element-{$prodi->kode}");
    }
    Route::get('element/tambah', [ElementController::class, 'tambahElement'])->name('tambah-element');
    Route::post('element/store', [ElementController::class, 'store']);
    Route::get('element/unggah-berkas/{element}', [ElementController::class, 'unggahBerkas']);
    Route::post('element/store-berkas', [ElementController::class, 'storeBerkas']);
    Route::get('element/lihat-berkas/{element}', [ElementController::class, 'lihatBerkas']);
    Route::get('element/syarat-akreditasi/{element}', [ElementController::class, 'akreditas']);
    Route::put('element/put-akreditasi/{element}', [ElementController::class, 'putAkreditas']);
    Route::get('element/syarat-unggul/{element}', [ElementController::class, 'unggul']);
    Route::put('element/put-unggul/{element}', [ElementController::class, 'putUnggul']);
    Route::get('element/syarat-baik/{element}', [ElementController::class, 'baik']);
    Route::put('element/put-baik/{element}', [ElementController::class, 'putBaik']);
    Route::delete('element/reset/{element}', [ElementController::class, 'resetData']);
    Route::get('element/konfirmasi/{element}', [ElementController::class, 'konfirHapus']);
    Route::delete('element/delete/{element}', [ElementController::class, 'delete']);
    Route::get('element/detail/{element}', [ElementController::class, 'detailElement']);
    Route::put('element/bobot/put/{element}', [ElementController::class, 'putBobot']);

    // Berkas
    Route::get('berkas/cari', [BerkasController::class, 'cari'])->name('berkas');
    Route::post('berkas/hasil', [BerkasController::class, 'hasil']);
    Route::get('berkas/{berkas}', [BerkasController::class, 'detail']);
    Route::delete('berkas/hapus/{berkas}', [BerkasController::class, 'hapus']);
    Route::get('berkas/edit/{berkas}', [BerkasController::class, 'edit']);
    Route::put('berkas/put/{berkas}', [BerkasController::class, 'put']);

    // Pengaturan
    Route::get('jenjang-pendidkan', [PengaturanController::class, 'jenjang'])->name('jenjang');
    Route::post('jenjang-pendidikan/post', [PengaturanController::class, 'jenjangPost']);
    Route::delete('jenjang-pendidikan/hapus/{jenjang}', [PengaturanController::class, 'jenjangDelete']);
    Route::put('jenjang-pendidikan/put/{jenjang}', [PengaturanController::class, 'jenjangPut']);
    Route::get('program-studi', [PengaturanController::class, 'prodi'])->name('prodi');
    Route::post('program-studi/post', [PengaturanController::class, 'prodiPost']);
    Route::delete('program-studi/hapus/{prodi}', [PengaturanController::class, 'prodiDelete']);
    Route::put('program-studi/put/{prodi}', [PengaturanController::class, 'prodiPut']);

    // User Management
    Route::get('users', [AdminController::class, 'index'])->name('users');
    Route::get('users/tambah/admin', [AdminController::class, 'tambahAdmin'])->name('tambah-admin');
    Route::get('users/tambah/ketua-lpm', [AdminController::class, 'tambahLpm'])->name('tambah-lpm');
    Route::get('users/tambah/ketua-program-studi', [AdminController::class, 'tambahKaprodi'])->name('tambah-kaprodi');
    Route::get('users/tambah/dosen', [AdminController::class, 'tambahDosen'])->name('tambah-dosen');
    Route::get('users/tambah/upps', [AdminController::class, 'tambahUpps'])->name('tambah-upps');
    Route::get('users/tambah/mahasiswa-alumni', [AdminController::class, 'tambahMhsAlm'])->name('tambah-mhsalm');
    Route::post('users/store', [AdminController::class, 'store']);
    Route::delete('users/hapus/{user}', [AdminController::class, 'hapus']);
    Route::get('users/edit/{user}', [AdminController::class, 'edit']);
    Route::put('users/put/{user}', [AdminController::class, 'put']);

    // Target
    Route::get('target', [TargetController::class, 'index'])->name('target');
    Route::get('target/{prodi:kode}', [TargetController::class, 'detail']);
    Route::get('target/create-target/{prodi:kode}', [TargetController::class, 'createTarget']);
    Route::put('target/update/{target}', [TargetController::class, 'update']);

    // Mahasiswa
    Route::get('data/mahasiswa/{prodi:kode}', [MahasiswaController::class, 'index']);
    Route::get('data/mahasiswa/tambah/{prodi:kode}', [MahasiswaController::class, 'tambah']);
    Route::post('data/mahasiswa/store', [MahasiswaController::class, 'store']);
});

// Dropdown Routes
Route::post('dropdownlist/getJen', [DropdownController::class, 'getJen'])->name('getJen');
Route::post('dropdownlist/getPro', [DropdownController::class, 'getPro'])->name('getPro');
Route::post('dropdownlist/getIndikator', [DropdownController::class, 'getIndikator'])->name('getInd');
Route::post('dropdownlist/getScore', [DropdownController::class, 'getScore'])->name('getScore');
Route::post('dropdownlist/getl1', [DropdownController::class, 'getL1'])->name('l1');
Route::post('dropdownlist/getl2', [DropdownController::class, 'getL2'])->name('l2');
Route::post('dropdownlist/getl3', [DropdownController::class, 'getL3'])->name('l3');
Route::post('dropdownlist/getl4', [DropdownController::class, 'getL4'])->name('l4');

// No Multiple Saat Edit Berkas
Route::post('dropdownlist/getl1ne', [DropdownController::class, 'getL1ne'])->name('l1ne');
Route::post('dropdownlist/getl2ne', [DropdownController::class, 'getL2ne'])->name('l2ne');
Route::post('dropdownlist/getl3ne', [DropdownController::class, 'getL3ne'])->name('l3ne');
Route::post('dropdownlist/getl4ne', [DropdownController::class, 'getL4ne'])->name('l4ne');

// No Multiple [Sub Butir L2 - L4]
Route::post('dropdownlist/getjn', [DropdownController::class, 'getjn'])->name('jn');
Route::post('dropdownlist/getl1n', [DropdownController::class, 'getL1n'])->name('l1n');
Route::post('dropdownlist/getl2n', [DropdownController::class, 'getL2n'])->name('l2n');
Route::post('dropdownlist/getl3n', [DropdownController::class, 'getL3n'])->name('l3n');
Route::post('dropdownlist/getl4n', [DropdownController::class, 'getL4n'])->name('l4n');

// No Multiple Saat Edit Level [Sub Butir L2 - L4]
Route::post('dropdownlist/getjnu', [DropdownController::class, 'getjnu'])->name('jnu');
Route::post('dropdownlist/getl1nu', [DropdownController::class, 'getL1nu'])->name('l1nu');
Route::post('dropdownlist/getl2nu', [DropdownController::class, 'getL2nu'])->name('l2nu');
Route::post('dropdownlist/getl3nu', [DropdownController::class, 'getL3nu'])->name('l3nu');
Route::post('dropdownlist/getl4nu', [DropdownController::class, 'getL4nu'])->name('l4nu');
