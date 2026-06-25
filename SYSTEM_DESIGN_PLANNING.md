# Perencanaan Desain Sistem: LaporanKita (Sistem Informasi Pengaduan Masyarakat)

Dokumen ini berisi perencanaan **Use Case Diagram**, **Activity Diagram**, dan **Class Diagram** untuk project **LaporanKita** berdasarkan kode backend Laravel yang sedang berjalan.

---

## 📊 1. Use Case Diagram

Use Case Diagram menggambarkan interaksi antara aktor (pengguna/sistem eksternal) dengan fungsionalitas yang disediakan oleh sistem LaporanKita.

### Aktor Sistem:
1. **Guest/Public User (Masyarakat Umum)**: Pengguna yang belum terdaftar/login. Hanya dapat melihat laporan publik.
2. **Registered User (Pelapor)**: Pengguna yang sudah masuk. Dapat membuat laporan pengaduan, mengedit laporan (jika status masih Baru), memberikan dukungan (vote/support), serta melihat riwayat pengaduan dan notifikasi mereka.
3. **Admin (Petugas/Instansi)**: Pengguna dengan akses dashboard admin. Bertugas mengelola pengaduan, mengubah status penanganan, memverifikasi kategori, serta mengelola akun pengguna (manajemen user).
4. **System (Mesin/Layanan)**:
   - **Naive Bayes Classification Engine**: Melakukan klasifikasi otomatis kategori pengaduan.
   - **Cloudinary Storage**: Layanan penyimpanan foto pengaduan.
   - **Notification Service**: Mengirim notifikasi perubahan status/dukungan.

### Visualisasi Use Case (Mermaid)

```mermaid
graph TB
    %% Aktor
    subgraph Aktor["👥 Aktor"]
        Guest["👤 Guest User"]
        User["👤 Registered User<br>(Pelapor)"]
        Admin["👨‍💼 Admin"]
        System["🤖 System Components"]
    end

    %% Fungsionalitas
    subgraph Sub_Auth["🔐 Autentikasi & Akun"]
        UC01["UC-001: Registrasi Akun"]
        UC02["UC-002: Login Email/Password"]
        UC03["UC-003: Login Google OAuth"]
        UC04["UC-004: Logout"]
        UC05["UC-005: Kelola Profil & Kata Sandi"]
    end

    subgraph Sub_Laporan["📝 Manajemen Pengaduan"]
        UC06["UC-006: Membuat Laporan Baru"]
        UC07["UC-007: Melihat Daftar Laporan (Publik)"]
        UC08["UC-008: Melihat Detail Laporan"]
        UC09["UC-009: Melihat Laporan Saya"]
        UC10["UC-010: Mengubah Laporan (Status: Baru)"]
        UC11["UC-011: Menghapus Laporan (Status: Baru)"]
    end

    subgraph Sub_Support["👍 Sistem Dukungan (Voting)"]
        UC12["UC-012: Memberikan/Membatalkan Dukungan"]
        UC13["UC-013: Melihat Daftar Pendukung"]
    end

    subgraph Sub_Admin["⚙️ Dashboard & Panel Admin"]
        UC14["UC-014: Melihat Statistik Dashboard"]
        UC15["UC-015: Melihat Semua Laporan (Admin)"]
        UC16["UC-016: Menyaring (Filter) & Mencari Laporan"]
        UC17["UC-017: Meninjau Detail Laporan (Admin)"]
        UC18["UC-018: Memperbarui Status & Kategori"]
        UC19["UC-019: Manajemen Akun Pengguna (Manajemen User)"]
    end

    subgraph Sub_ML["🤖 Otomatisasi Sistem"]
        UC20["UC-020: Klasifikasi Kategori Otomatis (Naive Bayes)"]
        UC21["UC-021: Mengirim Notifikasi Perubahan Status"]
        UC22["UC-022: Mengirim Notifikasi Dukungan Laporan"]
    end

    %% Relasi Guest
    Guest --> UC01
    Guest --> UC02
    Guest --> UC03
    Guest --> UC07
    Guest --> UC08

    %% Relasi Registered User
    User --> UC04
    User --> UC05
    User --> UC06
    User --> UC07
    User --> UC08
    User --> UC09
    User --> UC10
    User --> UC11
    User --> UC12
    User --> UC13

    %% Relasi Admin
    Admin --> UC04
    Admin --> UC05
    Admin --> UC14
    Admin --> UC15
    Admin --> UC16
    Admin --> UC17
    Admin --> UC18
    Admin --> UC19

    %% Hubungan Include & Extend
    UC06 -.->|includes| UC20
    UC18 -.->|includes| UC21
    UC12 -.->|includes| UC22

    %% Hubungan System
    System --> UC20
    System --> UC21
    System --> UC22
```

---

## 🔄 2. Activity Diagram

Activity Diagram memodelkan alur kerja (workflow) dinamis dari proses bisnis utama di dalam sistem.

### A. Alur Pembuatan Laporan & Klasifikasi Otomatis
Menjelaskan bagaimana Registered User membuat laporan, sistem mengunggah foto ke Cloudinary, memproses teks dengan Naive Bayes untuk penentuan kategori otomatis, lalu menyimpannya.

```mermaid
stateDiagram-v2
    [*] --> AksesForm : Registered User membuka menu "Buat Laporan"
    AksesForm --> IsiData : Mengisi Judul, Deskripsi, Lokasi, & Pilih Foto
    IsiData --> SubmitForm : Klik Tombol "Kirim Laporan"
    
    state SubmitForm <<choice>>
    SubmitForm --> UploadCloudinary : Validasi Form Berhasil
    SubmitForm --> TampilkanError : Validasi Form Gagal
    TampilkanError --> IsiData
    
    state "Proses Backend & System" as BackendProcess {
        UploadCloudinary --> SimpanURL : Cloudinary mengembalikan URL Aman foto
        SimpanURL --> PenggabunganTeks : Gabung Judul + Deskripsi + Lokasi
        
        state "Sistem Naive Bayes (UC-020)" as ML_Engine {
            PenggabunganTeks --> Preprocessing : Tokenize & Case Folding
            Preprocessing --> StopwordRemoval : Hapus kata tidak penting (stopwords)
            StopwordRemoval --> SimpleStemming : Potong awalan/akhiran kata
            SimpleStemming --> HitungProbabilitas : Hitung probabilitas kata per kelas (Laplace Smoothing)
            HitungProbabilitas --> AmbilKategoriTertinggi : Pilih kategori dengan skor tertinggi
        }
        
        AmbilKategoriTertinggi --> SimpanDatabase : Simpan Laporan dengan status 'baru' dan kategori otomatis
    }
    
    SimpanDatabase --> BerhasilDisimpan : Mengembalikan respon sukses
    BerhasilDisimpan --> TampilkanNotifikasiAdmin : Kirim pemberitahuan laporan baru ke Admin
    TampilkanNotifikasiAdmin --> [*]
```

### B. Alur Tindak Lanjut & Perubahan Status Laporan oleh Admin
Menjelaskan alur kerja admin saat meninjau laporan masuk, memverifikasi/mengubah kategori, memperbarui status pengaduan, dan memicu notifikasi real-time untuk pelapor.

```mermaid
stateDiagram-v2
    [*] --> AdminLogin : Login sebagai Admin
    AdminLogin --> MasukDashboard : Buka Dashboard Admin
    MasukDashboard --> TampilkanStatistik : Sistem menampilkan jumlah laporan per status & grafik 7 hari
    TampilkanStatistik --> LihatDaftarLaporan : Membuka halaman "Semua Laporan"
    LihatDaftarLaporan --> SaringLaporan : (Opsional) Filter berdasarkan Kategori / Status
    SaringLaporan --> BukaDetailLaporan : Klik tombol detail pada salah satu laporan
    BukaDetailLaporan --> TinjauLaporan : Verifikasi bukti foto, lokasi, deskripsi, & kategori otomatis
    
    TinjauLaporan --> FormUpdate : Ubah Status (Baru -> Diproses -> Selesai / Ditolak) dan sesuaikan Kategori
    FormUpdate --> SimpanPerubahan : Klik "Simpan Perubahan"
    
    state "Proses Perubahan Status" as PerubahanStatus {
        SimpanPerubahan --> UpdateDB : Update kolom 'status' & 'kategori' di tabel 'laporans'
        UpdateDB --> CekStatusBerubah : Apakah status berubah?
        
        state CekStatusBerubah <<choice>>
        CekStatusBerubah --> KirimNotif : Ya (Status Berubah)
        CekStatusBerubah --> TanpaNotif : Tidak (Hanya Kategori yang Berubah)
        
        KirimNotif --> SimpanNotifikasi : Buat data notifikasi baru di tabel 'notifications'
        SimpanNotifikasi --> NotifikasiRealtime : Kirim notifikasi in-app ke Pelapor
    }
    
    NotifikasiRealtime --> SuksesUpdate : Tampilkan pesan sukses di halaman Admin
    TanpaNotif --> SuksesUpdate
    SuksesUpdate --> [*]
```

### C. Alur Memberikan Dukungan (Support/Vote Laporan)
Menjelaskan bagaimana seorang pengguna terdaftar dapat mendukung laporan pengguna lain (atau membatalkannya), dan bagaimana sistem mengupdate total dukungan secara dinamis.

```mermaid
stateDiagram-v2
    [*] --> LoginUser : Pelapor Login ke Sistem
    LoginUser --> JelajahiLaporan : Buka daftar laporan publik
    JelajahiLaporan --> BukaDetailLaporan : Memilih laporan milik pengguna lain
    BukaDetailLaporan --> KlikDukung : Klik tombol "Dukung"
    
    state "Sistem Dukungan (UC-012)" as SupportSystem {
        KlikDukung --> CekDukungan : Apakah user sudah pernah mendukung laporan ini?
        
        state CekDukungan <<choice>>
        CekDukungan --> BatalkanDukungan : Sudah Mendukung (True)
        CekDukungan --> TambahDukungan : Belum Mendukung (False)
        
        BatalkanDukungan --> HapusRecord : Hapus baris di tabel 'supports'
        HapusRecord --> KurangiCounter : Kurangi counter total support pada laporan
        
        TambahDukungan --> BuatRecord : Buat baris baru (user_id, laporan_id) di tabel 'supports'
        BuatRecord --> TambahCounter : Tambah counter total support pada laporan
        TambahCounter --> BuatNotifDukungan : Buat notifikasi "[Nama] mendukung laporan Anda"
        BuatNotifDukungan --> KirimKePembuat : Kirim notifikasi ke pembuat laporan
    }
    
    KurangiCounter --> ResponSukses : Kembalikan JSON (status: unsupported, count: X)
    KirimKePembuat --> ResponSukses : Kembalikan JSON (status: supported, count: X)
    ResponSukses --> UpdateTampilanUI : Ubah warna ikon tombol & perbarui angka counter secara asinkron (AJAX)
    UpdateTampilanUI --> [*]
```

---

## 📐 3. Class Diagram

Class Diagram di bawah ini dirancang berdasarkan struktur kode riil Laravel di project ini, mencakup relasi Eloquent Model, Controller, Service Helper, dan Notification.

### Visualisasi Class Diagram (Mermaid)

```mermaid
classDiagram
    %% Hubungan Pewarisan dari framework Laravel
    class Model {
        <<Eloquent>>
        +save()
        +delete()
        +update(array attributes)
    }
    
    class Authenticatable {
        <<Eloquent Auth>>
    }

    class Controller {
        <<Base Controller>>
    }

    class Notification {
        <<Laravel Notification>>
    }

    %% Models
    class User {
        +int id
        +string name
        +string email
        +string password
        +string role
        +boolean is_active
        +boolean is_verified
        +string telepon
        +string alamat
        +string nik
        +string nip
        +string foto_profil
        +string instansi
        +string google_id
        +casts() array
        +laporans() HasMany
        +supports() HasMany
        +supportedLaporans() BelongsToMany
    }
    Authenticatable <|-- User

    class Laporan {
        +int id
        +int user_id
        +string judul
        +string kategori
        +text deskripsi
        +string lokasi
        +array foto
        +string status
        +user() BelongsTo
        +supports() HasMany
        +supportingUsers() BelongsToMany
    }
    Model <|-- Laporan

    class Support {
        +int id
        +int user_id
        +int laporan_id
        +user() BelongsTo
        +laporan() BelongsTo
    }
    Model <|-- Support

    class Kategori {
        +int id
        +string nama
        +string slug
    }
    Model <|-- Kategori

    class NaiveBayesClass {
        +int id
        +string kategori
        +int jumlah_dokumen
        +int total_kata
    }
    Model <|-- NaiveBayesClass

    class NaiveBayesWord {
        +int id
        +string kategori
        +string kata
        +int frekuensi
    }
    Model <|-- NaiveBayesWord

    %% Services
    class CloudinaryService {
        #Cloudinary cloudinary
        +upload(file, folder) string
        +delete(publicId) bool
    }

    class NaiveBayesService {
        #array stopwords
        +tokenize(string text) array
        #simpleStem(string word) string
        +train(array laporanIds) array
        +predict(string text) array
        #normalizeToProbabilities(array logScores) array
        +getModelStats() array
        +batchPredict(bool onlyUnkategorized) array
    }

    %% Notifications
    class LaporanStatusNotification {
        +Laporan laporan
        +via($notifiable) array
        +toMail($notifiable) MailMessage
        +toArray($notifiable) array
    }
    Notification <|-- LaporanStatusNotification

    %% Web Controllers
    class AuthController {
        +redirectToGoogle() Redirect
        +handleGoogleCallback() Redirect
        +showLoginForm() View
        +login(Request request) Redirect
        +register(Request request) Redirect
        +logout(Request request) Redirect
    }
    Controller <|-- AuthController

    class DashboardAdminController {
        #CloudinaryService cloudinary
        +index() View
        +semuaLaporan() View
        +filterLaporan(Request request) View
        +show(int id) View
        +updateStatus(Request request, int id) Redirect
        +profil() View
        +updateProfil(Request request) Redirect
        +updatePassword(Request request) Redirect
        +users(Request request) View
        +userDetail(int id) View
        +updateUser(Request request, int id) Redirect
        +updateUserRole(Request request, int id) Redirect
        +toggleUserStatus(Request request, int id) Redirect
        +deleteUser(Request request, int id) Redirect
    }
    Controller <|-- DashboardAdminController

    class DashboardUserController {
        #CloudinaryService cloudinary
        +index() View
        +create() View
        +store(Request request) Redirect
        +show(int id) View
        +laporansaya() View
        +notifikasi() View
        +markNotifRead(Request request) JsonResponse
        +profil() View
        +updateProfil(Request request) Redirect
        +updatePassword(Request request) Redirect
        +toggleSupport(int id) JsonResponse
        +edit(int id) View
        +update(Request request, int id) Redirect
        +destroy(int id) Redirect
    }
    Controller <|-- DashboardUserController

    class NaiveBayesController {
        #NaiveBayesService nb
        +index() View
        +train(Request request) Redirect
        +klasifikasi(Request request) Redirect/JsonResponse
        +evaluasi() View
        +predictAjax(Request request) JsonResponse
        +reset() Redirect
    }
    Controller <|-- NaiveBayesController

    %% API Controllers
    class AuthApiController {
        +register(Request request) JsonResponse
        +login(Request request) JsonResponse
        +logout(Request request) JsonResponse
        +me(Request request) JsonResponse
    }
    Controller <|-- AuthApiController

    class LaporanApiController {
        +index(Request request) JsonResponse
        +show(int id) JsonResponse
        +store(Request request) JsonResponse
        +update(Request request, int id) JsonResponse
        +destroy(Request request, int id) JsonResponse
        +myLaporan(Request request) JsonResponse
    }
    Controller <|-- LaporanApiController

    %% Relasi Asosiasi database (Eloquent Relationship)
    User "1" --> "many" Laporan : laporans (pembuat)
    User "1" --> "many" Support : supports (melakukan vote)
    Laporan "1" --> "many" Support : supports (mendapatkan vote)
    Laporan "1" --> "1" User : user (milik)
    Support "1" --> "1" User : user
    Support "1" --> "1" Laporan : laporan
    User "many" -- "many" Laporan : supportedLaporans (melalui supports)
    
    %% Relasi Asosiasi Data Naive Bayes
    NaiveBayesClass "1" --> "many" NaiveBayesWord : "kategori sama"

    %% Relasi Dependensi (Penggunaan kelas/services)
    DashboardAdminController ..> CloudinaryService : Dependency Injection
    DashboardAdminController ..> LaporanStatusNotification : Triggers
    DashboardUserController ..> CloudinaryService : Dependency Injection
    NaiveBayesController ..> NaiveBayesService : Dependency Injection
    LaporanStatusNotification ..> Laporan : Contains
```

---

## 💡 Rangkuman Aliran Data Utama

1. **Pengajuan Pengaduan**:
   - `DashboardUserController::store` -> Memanggil `CloudinaryService::upload` untuk mengunggah berkas gambar.
   - `LaporanApiController::store` atau `DashboardUserController::store` -> Memanggil database untuk menyimpan data laporan.
   - Bersamaan dengan itu, `NaiveBayesService::predict` menganalisis teks untuk menentukan kategori laporan secara cerdas.
2. **Dukungan (Support)**:
   - `DashboardUserController::toggleSupport` memanipulasi baris data `Support` dan memperbarui counter. Jika terjadi dukungan baru, notifikasi dibuat dan disimpan.
3. **Pemberitahuan**:
   - Admin mengubah status laporan via `DashboardAdminController::updateStatus`. Ini memicu instansiasi `LaporanStatusNotification` yang terikat pada `User` pembuat pengaduan.
