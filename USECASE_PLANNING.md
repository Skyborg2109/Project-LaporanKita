# Use Case Planning - Project LaporanKita
## Sistem Informasi Pengaduan Masyarakat (SIPM)

---

## 📋 Daftar Isi
1. [Ringkasan Project](#ringkasan-project)
2. [Identifikasi Aktor](#identifikasi-aktor)
3. [Use Case Diagram](#use-case-diagram)
4. [Use Case Descriptions](#use-case-descriptions)
5. [Alur Proses](#alur-proses-utama)
6. [Fitur & Teknologi](#fitur--teknologi)

---

## 🎯 Ringkasan Project

**Nama:** LaporanKita (Sistem Informasi Pengaduan Masyarakat)

**Deskripsi:** Platform digital yang memungkinkan masyarakat untuk melaporkan masalah/keluhan kepada instansi berwenang. Sistem ini dilengkapi dengan:
- Otentikasi user (Email & Google OAuth)
- Manajemen laporan pengaduan
- Sistem dukungan (voting/support untuk laporan)
- Klasifikasi otomatis menggunakan Machine Learning (Naive Bayes)
- Dashboard untuk Admin dan User
- API RESTful untuk integrasi mobile
- Notifikasi real-time

---

## 👥 Identifikasi Aktor

### 1. **Guest/Public User** 🔓
- User yang belum login/terdaftar
- Dapat melihat laporan publik
- Tidak dapat membuat laporan baru

### 2. **Registered User (Pelapor)** 👤
- User yang sudah melakukan registrasi/login
- Dapat membuat laporan pengaduan baru
- Dapat melihat status laporan mereka sendiri
- Dapat memberikan dukungan (support) pada laporan
- Dapat melihat laporan dari user lain
- Dapat menerima notifikasi perubahan status laporan

### 3. **Admin** 👨‍💼
- User dengan role khusus untuk mengelola sistem
- Dapat melihat dashboard dengan statistik lengkap
- Dapat melihat semua laporan
- Dapat mengubah status laporan
- Dapat mengkategorisasi laporan
- Dapat mengelola laporan yang masuk

### 4. **System** 🤖
- Sistem klasifikasi otomatis (Naive Bayes)
- Sistem notifikasi

---

## 📊 Use Case Diagram

```
┌─────────────────────────────────────────────────────────────────┐
│                        LAPORANKITA SYSTEM                       │
├─────────────────────────────────────────────────────────────────┤
│                                                                 │
│  ┌──────────────┐         ┌───────────────┐                   │
│  │    Guest     │         │ Registered    │    ┌──────────┐   │
│  │    User      │         │    User       │    │  Admin   │   │
│  └──────┬───────┘         └───────┬───────┘    └────┬─────┘   │
│         │                         │                 │         │
│         │    ┌────────────────────┼─────────────────┤         │
│         │    │                    │                 │         │
│         ├────┼─── View Laporan ───┼─────────────────┤         │
│         │    │                    │                 │         │
│         │    │  ┌─ Registrasi    │    ┌─ Dashboard Admin    │
│         │    │  │ & Login        │    │                   │
│         │    │  ├─ View Profile  │    ├─ View Statistics    │
│         │    │  │                │    │                   │
│         │    │  ├─ Create Laporan│    ├─ Filter Laporan     │
│         │    │  │ (with Photos)  │    │                   │
│         │    │  │                │    ├─ Update Status      │
│         │    │  ├─ Support Laporan   │                   │
│         │    │  │                │    ├─ Auto Classification  │
│         │    │  ├─ View My Laporan  │                   │
│         │    │  │                │    ├─ Send Notifikasi    │
│         │    │  └─ Edit Laporan  │    │                   │
│         │    │                    │    └────────────────────  │
│         │    │                    │                 │         │
│         │    └────────────────────┼─────────────────┤         │
│         └─────────────────────────┴─────────────────┘         │
│                                                                 │
│  Sistem Components:                                            │
│  • Naive Bayes Classification Engine                          │
│  • Cloudinary Image Upload Service                            │
│  • Email & Google OAuth Service                               │
│  • Notification Service                                        │
│                                                                 │
└─────────────────────────────────────────────────────────────────┘
```

---

## 📝 Use Case Descriptions

### **A. AUTHENTICATION & ACCOUNT MANAGEMENT**

#### UC-001: Register Account
| Aspek | Deskripsi |
|-------|-----------|
| **Actor** | Guest User |
| **Precondition** | User belum terdaftar |
| **Main Flow** | 1. User mengakses halaman registrasi<br>2. User memasukkan: Nama, Email, Password<br>3. Sistem validasi input<br>4. Sistem membuat akun baru<br>5. User redirect ke login |
| **Postcondition** | Akun user berhasil dibuat |
| **Exception** | Email sudah terdaftar → Tampilkan error |
| **API Endpoint** | `POST /api/auth/register` |

#### UC-002: Login dengan Email/Password
| Aspek | Deskripsi |
|-------|-----------|
| **Actor** | Guest User / Registered User |
| **Precondition** | User sudah memiliki akun |
| **Main Flow** | 1. User memasukkan Email dan Password<br>2. Sistem validasi kredensial<br>3. Jika valid → Generate API Token (Sanctum)<br>4. User login berhasil<br>5. Redirect ke Dashboard sesuai role |
| **Postcondition** | Session user aktif, API token diterima |
| **Exception** | Kredensial salah → Tampilkan error |
| **API Endpoint** | `POST /api/auth/login` |

#### UC-003: Login dengan Google OAuth
| Aspek | Deskripsi |
|-------|-----------|
| **Actor** | Guest User |
| **Precondition** | User memiliki Google Account |
| **Main Flow** | 1. User klik "Login dengan Google"<br>2. Redirect ke Google OAuth<br>3. User approve permissions<br>4. Sistem cek apakah user sudah terdaftar<br>5. Jika baru → Buat akun baru<br>6. Jika sudah → Update google_id<br>7. User login berhasil |
| **Postcondition** | User ter-autentikasi, akun ter-link dengan Google |
| **Exception** | Google callback error → Redirect login |
| **Route** | `GET /auth/google/redirect`<br>`GET /auth/google/callback` |

#### UC-004: Logout
| Aspek | Deskripsi |
|-------|-----------|
| **Actor** | Registered User / Admin |
| **Precondition** | User sudah login |
| **Main Flow** | 1. User klik tombol Logout<br>2. Sistem revoke API token<br>3. Session user dihapus<br>4. Redirect ke halaman login |
| **Postcondition** | User ter-logout, token tidak valid |
| **API Endpoint** | `POST /api/auth/logout` |

#### UC-005: View Profile
| Aspek | Deskripsi |
|-------|-----------|
| **Actor** | Registered User / Admin |
| **Precondition** | User sudah login |
| **Main Flow** | 1. User akses halaman profile<br>2. Sistem menampilkan data user:<br>   - Nama, Email, Telepon<br>   - Alamat, NIK, NIP<br>   - Foto Profil, Instansi<br>3. User dapat edit profile |
| **Postcondition** | Profile data ditampilkan |
| **API Endpoint** | `GET /api/auth/me` |

---

### **B. LAPORAN MANAGEMENT**

#### UC-006: Create Laporan (Membuat Pengaduan Baru)
| Aspek | Deskripsi |
|-------|-----------|
| **Actor** | Registered User |
| **Precondition** | User sudah login |
| **Main Flow** | 1. User akses halaman "Buat Laporan"<br>2. User mengisi form:<br>   - Judul laporan<br>   - Deskripsi detail<br>   - Lokasi kejadian<br>   - Upload foto (1+ foto)<br>3. User submit form<br>4. Sistem upload foto ke Cloudinary<br>5. **Sistem auto-classify** menggunakan Naive Bayes<br>6. Laporan disimpan dengan status "Baru"<br>7. Admin dapat melihat laporan baru |
| **Postcondition** | Laporan berhasil dibuat, ditugaskan kategori otomatis |
| **Auto Classification** | Naive Bayes menganalisis: Judul + Deskripsi + Lokasi → Tentukan kategori |
| **API Endpoint** | `POST /api/laporan` |
| **Form Fields** | judul, deskripsi, lokasi, foto[], kategori |

#### UC-007: View All Laporan (Public)
| Aspek | Deskripsi |
|-------|-----------|
| **Actor** | Guest User / Registered User / Admin |
| **Precondition** | Minimal 1 laporan ada di sistem |
| **Main Flow** | 1. User akses halaman "Laporan"<br>2. Sistem menampilkan list laporan dengan:<br>   - Judul, Deskripsi preview<br>   - Nama pelapor, Tanggal<br>   - Status, Kategori<br>   - Jumlah support/dukungan<br>3. User dapat klik untuk lihat detail |
| **Postcondition** | List laporan ditampilkan |
| **API Endpoint** | `GET /api/laporan` |
| **Pagination** | 10 per halaman |

#### UC-008: View Laporan Detail
| Aspek | Deskripsi |
|-------|-----------|
| **Actor** | Guest User / Registered User / Admin |
| **Precondition** | Laporan dengan ID tertentu ada |
| **Main Flow** | 1. User klik laporan dari list<br>2. Sistem menampilkan detail lengkap:<br>   - Info pelapor (nama, foto, kontak)<br>   - Judul, Deskripsi, Lokasi<br>   - Semua foto dalam carousel<br>   - Status laporan<br>   - Kategori<br>   - Tanggal pembuatan<br>   - Jumlah support dan list supporter |
| **Postcondition** | Detail laporan ditampilkan |
| **API Endpoint** | `GET /api/laporan/{id}` |

#### UC-009: View My Laporan (Laporan Saya)
| Aspek | Deskripsi |
|-------|-----------|
| **Actor** | Registered User |
| **Precondition** | User sudah login, punya minimal 1 laporan |
| **Main Flow** | 1. User akses "Laporan Saya" di dashboard<br>2. Sistem menampilkan laporan user sendiri:<br>   - List laporan yang dibuat<br>   - Filter by status<br>   - Lihat jumlah support per laporan<br>3. User dapat klik untuk lihat detail/edit |
| **Postcondition** | List laporan user ditampilkan |
| **API Endpoint** | `GET /api/laporan/saya/list` |

#### UC-010: Update Laporan (Edit)
| Aspek | Deskripsi |
|-------|-----------|
| **Actor** | Registered User (pembuat laporan) |
| **Precondition** | User adalah pembuat laporan, status masih "Baru" |
| **Main Flow** | 1. User akses laporan mereka<br>2. User klik tombol "Edit"<br>3. User ubah: Judul, Deskripsi, Lokasi<br>4. User dapat upload foto tambahan<br>5. User submit perubahan<br>6. Sistem validasi input<br>7. Sistem update di database<br>8. Laporan ter-update |
| **Postcondition** | Data laporan berhasil diperbarui |
| **API Endpoint** | `PUT /api/laporan/{id}` |
| **Restriction** | Hanya dapat edit jika status "Baru" |

#### UC-011: Delete Laporan
| Aspek | Deskripsi |
|-------|-----------|
| **Actor** | Registered User (pembuat) / Admin |
| **Precondition** | Laporan ada di sistem |
| **Main Flow** | 1. User/Admin klik tombol "Hapus"<br>2. Sistem tanyakan konfirmasi<br>3. User confirm delete<br>4. Sistem hapus laporan dari database<br>5. Sistem hapus foto dari Cloudinary |
| **Postcondition** | Laporan berhasil dihapus |
| **API Endpoint** | `DELETE /api/laporan/{id}` |
| **Restriction** | User hanya bisa hapus laporan sendiri, Admin bisa hapus semua |

---

### **C. SUPPORT SYSTEM (Sistem Dukungan)**

#### UC-012: Support Laporan (Give Support/Vote)
| Aspek | Deskripsi |
|-------|-----------|
| **Actor** | Registered User |
| **Precondition** | User sudah login, laporan ada |
| **Main Flow** | 1. User buka detail laporan<br>2. User klik tombol "Dukung"<br>3. Sistem cek apakah user sudah mendukung<br>4. Jika belum → Catat support baru<br>5. Jika sudah → Batalkan support<br>6. Update jumlah support di laporan<br>7. Notifikasi dikirim ke pembuat laporan |
| **Postcondition** | Support berhasil ditambah/dibatalkan |
| **Model** | Support (user_id, laporan_id) |
| **Notification** | "User X mendukung laporan Anda" |

#### UC-013: View Laporan Supporter List
| Aspek | Deskripsi |
|-------|-----------|
| **Actor** | Registered User / Admin |
| **Precondition** | Laporan ada, minimal 1 supporter |
| **Main Flow** | 1. User/Admin buka detail laporan<br>2. Sistem tampilkan list user yang mendukung<br>   - Nama supporter<br>   - Foto profil<br>   - Waktu support |
| **Postcondition** | List supporter ditampilkan |

---

### **D. ADMIN DASHBOARD & MANAGEMENT**

#### UC-014: View Admin Dashboard
| Aspek | Deskripsi |
|-------|-----------|
| **Actor** | Admin |
| **Precondition** | User punya role "Admin", sudah login |
| **Main Flow** | 1. Admin akses dashboard admin<br>2. Sistem tampilkan statistik:<br>   - Total laporan<br>   - Laporan status "Baru"<br>   - Laporan status "Diproses"<br>   - Laporan status "Selesai"<br>   - Laporan status "Ditolak"<br>3. Chart laporan 7 hari terakhir<br>4. List 5 laporan terbaru |
| **Postcondition** | Dashboard statistics ditampilkan |
| **Route** | `/dashboardadmin` |

#### UC-015: View All Laporan (Admin)
| Aspek | Deskripsi |
|-------|-----------|
| **Actor** | Admin |
| **Precondition** | Admin sudah login |
| **Main Flow** | 1. Admin akses "Semua Laporan"<br>2. Sistem tampilkan list semua laporan:<br>   - Dari semua user<br>   - Dengan status dan kategori<br>3. Pagination 10 per halaman |
| **Postcondition** | List laporan ditampilkan |
| **Route** | `/dashboardadmin/semualaporan` |

#### UC-016: Filter Laporan (Admin)
| Aspek | Deskripsi |
|-------|-----------|
| **Actor** | Admin |
| **Precondition** | Admin sudah login |
| **Main Flow** | 1. Admin akses halaman filter<br>2. Admin pilih filter:<br>   - By Status (Baru, Diproses, Selesai, Ditolak)<br>   - By Kategori<br>3. Sistem tampilkan laporan sesuai filter<br>4. Admin dapat klik laporan untuk detail |
| **Postcondition** | Laporan ter-filter ditampilkan |
| **Method** | GET with query parameters: status, kategori |

#### UC-017: View Laporan Detail (Admin)
| Aspek | Deskripsi |
|-------|-----------|
| **Actor** | Admin |
| **Precondition** | Admin sudah login, laporan ada |
| **Main Flow** | 1. Admin klik laporan dari list<br>2. Sistem tampilkan detail lengkap<br>3. Admin dapat lihat form untuk update status/kategori |
| **Postcondition** | Detail laporan ditampilkan dengan form edit |
| **Route** | `/dashboardadmin/laporan/{id}` |

#### UC-018: Update Laporan Status & Kategori
| Aspek | Deskripsi |
|-------|-----------|
| **Actor** | Admin |
| **Precondition** | Admin melihat detail laporan |
| **Main Flow** | 1. Admin ubah Status:<br>   - Baru → Diproses<br>   - Diproses → Selesai / Ditolak<br>2. Admin ubah/confirm Kategori<br>3. Admin submit perubahan<br>4. Sistem update laporan di database<br>5. **Kirim notifikasi ke pelapor** tentang perubahan status<br>6. Update tercatat dengan timestamp |
| **Postcondition** | Status & kategori laporan ter-update, notifikasi dikirim |
| **API Endpoint** | `PUT /api/laporan/{id}` |
| **Notification** | Status berubah ke [status baru] |

---

### **E. AUTOMATIC CLASSIFICATION (MACHINE LEARNING)**

#### UC-019: Auto-Classify Laporan (Naive Bayes)
| Aspek | Deskripsi |
|-------|-----------|
| **Actor** | System (triggered by UC-006) |
| **Precondition** | Laporan baru dibuat oleh user |
| **Main Flow** | 1. Sistem menerima teks laporan (judul + deskripsi + lokasi)<br>2. **Text Preprocessing:**<br>   - Lowercase<br>   - Tokenisasi<br>   - Stopword removal<br>   - Stemming (Porter stemmer Indonesia)<br>3. **Feature Extraction:**<br>   - Hitung term frequencies<br>   - Bandingkan dengan corpus per kategori<br>4. **Classification:**<br>   - Terapkan Naive Bayes Classifier<br>   - Hitung probability per kategori<br>   - Pilih kategori dengan probability tertinggi<br>5. Assign kategori ke laporan<br>6. Simpan classification confidence score |
| **Postcondition** | Laporan otomatis dikategorisasi |
| **Algorithm** | Naive Bayes dengan Laplace Smoothing |
| **Reference** | NaiveBayesService.php, NaiveBayesWord model |
| **Training Data** | Diambil dari laporan historis |

---

### **F. NOTIFICATION SYSTEM**

#### UC-020: Send Status Change Notification
| Aspek | Deskripsi |
|-------|-----------|
| **Actor** | System (triggered by UC-018) |
| **Precondition** | Admin update status laporan |
| **Main Flow** | 1. Admin update status laporan (UC-018)<br>2. Sistem detect status berubah<br>3. Sistem buat notifikasi dengan pesan:<br>   "Laporan Anda berstatus [status] pada [waktu]"<br>4. Kirim notifikasi ke user pembuat laporan<br>5. Notifikasi tersimpan di database |
| **Postcondition** | Notifikasi berhasil dikirim ke user |
| **Channel** | In-app notification, Email (optional) |
| **Model** | Notification (user_id, data) |

#### UC-021: Send Support Notification
| Aspek | Deskripsi |
|-------|-----------|
| **Actor** | System (triggered by UC-012) |
| **Precondition** | User memberikan support pada laporan |
| **Main Flow** | 1. User support laporan (UC-012)<br>2. Sistem detect support baru<br>3. Sistem buat notifikasi:<br>   "[Username] mendukung laporan Anda"<br>4. Kirim ke pembuat laporan |
| **Postcondition** | Notifikasi dikirim |

---

## 🔄 Alur Proses Utama

### **Alur 1: User Membuat Laporan Baru**
```
┌─────────────────────────────────────────────────────────────┐
│                                                             │
│  1. User Login (UC-002/003)                                 │
│         ↓                                                   │
│  2. User akses "Buat Laporan Baru"                         │
│         ↓                                                   │
│  3. User isi form (UC-006)                                  │
│     - Judul, Deskripsi, Lokasi                             │
│     - Upload foto (Cloudinary)                             │
│         ↓                                                   │
│  4. SISTEM AUTO-CLASSIFY (UC-019)                          │
│     - Naive Bayes analysis                                 │
│     - Assign kategori otomatis                             │
│         ↓                                                   │
│  5. Laporan tersimpan status "BARU"                         │
│         ↓                                                   │
│  6. Notifikasi ke Admin                                     │
│     (Laporan baru masuk)                                   │
│         ↓                                                   │
│  7. SELESAI ✓                                               │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

### **Alur 2: Admin Meninjau & Update Laporan**
```
┌─────────────────────────────────────────────────────────────┐
│                                                             │
│  1. Admin Login (UC-002)                                    │
│         ↓                                                   │
│  2. Admin lihat Dashboard (UC-014)                          │
│     - Lihat statistik & laporan terbaru                    │
│         ↓                                                   │
│  3. Admin akses laporan dari list (UC-015/16)              │
│         ↓                                                   │
│  4. Admin lihat detail laporan (UC-017)                    │
│     - Verifikasi kategori otomatis                         │
│     - Confirm/ubah kategori jika perlu                    │
│         ↓                                                   │
│  5. Admin update status (UC-018)                           │
│     Status: BARU → DIPROSES → SELESAI/DITOLAK              │
│         ↓                                                   │
│  6. SISTEM KIRIM NOTIFIKASI (UC-020)                       │
│     ke pembuat laporan                                      │
│         ↓                                                   │
│  7. Repeat sampai semua laporan ditangani                  │
│         ↓                                                   │
│  8. SELESAI ✓                                               │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

### **Alur 3: User Mendukung Laporan Lain**
```
┌─────────────────────────────────────────────────────────────┐
│                                                             │
│  1. User Login (UC-002/003)                                 │
│         ↓                                                   │
│  2. User lihat daftar laporan (UC-007)                      │
│         ↓                                                   │
│  3. User klik laporan yang tertarik (UC-008)               │
│         ↓                                                   │
│  4. User klik tombol "DUKUNG" (UC-012)                     │
│         ↓                                                   │
│  5. Sistem catat support baru                              │
│     Update jumlah support di laporan                        │
│         ↓                                                   │
│  6. SISTEM KIRIM NOTIFIKASI (UC-021)                       │
│     ke pembuat laporan                                      │
│     "[User] mendukung laporan Anda"                         │
│         ↓                                                   │
│  7. SELESAI ✓                                               │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

---

## 🛠️ Fitur & Teknologi

### **Teknologi Stack**
| Komponen | Teknologi |
|----------|-----------|
| Backend | Laravel 11 |
| Database | MySQL/PostgreSQL |
| Authentication | Laravel Sanctum (API Token) |
| OAuth | Google OAuth 2.0 |
| File Upload | Cloudinary |
| ML Classification | Naive Bayes (Custom PHP) |
| Frontend | Blade Templates + Vite (JavaScript/CSS) |
| API | RESTful API dengan JSON responses |

### **Key Features**
| Fitur | Status | Komponen |
|-------|--------|----------|
| User Registration & Login | ✅ | AuthController, UC-001, UC-002 |
| Google OAuth Integration | ✅ | AuthController, UC-003 |
| Create Report | ✅ | LaporanApiController, UC-006 |
| Photo Upload (Cloudinary) | ✅ | CloudinaryService, UC-006 |
| Auto-Classification (Naive Bayes) | ✅ | NaiveBayesService, UC-019 |
| View All Reports | ✅ | LaporanApiController, UC-007 |
| Support System | ✅ | Support Model, UC-012 |
| Admin Dashboard | ✅ | DashboardAdminController, UC-014 |
| Status Management | ✅ | DashboardAdminController, UC-018 |
| Notifications | ✅ | LaporanStatusNotification, UC-020 |
| API Authentication | ✅ | Sanctum Middleware |
| Mobile API | ✅ | API endpoints |

### **Database Models**
```
Users
├── id (PK)
├── name
├── email (UNIQUE)
├── password (hashed)
├── role (admin, user)
├── is_active, is_verified
├── telepon, alamat, nik, nip
├── foto_profil, instansi
├── google_id
└── timestamps

Laporan
├── id (PK)
├── user_id (FK → Users)
├── judul
├── kategori
├── deskripsi
├── lokasi
├── foto (JSON array)
├── status (baru, diproses, selesai, ditolak)
└── timestamps

Support
├── id (PK)
├── user_id (FK → Users)
├── laporan_id (FK → Laporan)
└── timestamps

Kategori
├── id (PK)
├── nama_kategori
└── deskripsi

Notifications
├── id (PK)
├── user_id (FK → Users)
├── data (JSON)
├── read_at
└── timestamps

NaiveBayesClass
├── id (PK)
├── class_name
└── total_documents

NaiveBayesWord
├── id (PK)
├── word
├── class_id (FK → NaiveBayesClass)
└── frequency
```

---

## 📱 API Endpoints Summary

### **Authentication**
```
POST   /api/auth/register          Register user baru
POST   /api/auth/login             Login dan dapatkan token
POST   /api/auth/logout            Logout (require token)
GET    /api/auth/me                Get current user (require token)
```

### **Laporan (Public)**
```
GET    /api/laporan                List semua laporan
GET    /api/laporan/{id}           Get detail laporan
```

### **Laporan (Protected)**
```
POST   /api/laporan                Create laporan baru
PUT    /api/laporan/{id}           Update laporan
DELETE /api/laporan/{id}           Delete laporan
GET    /api/laporan/saya/list      Get my laporans
```

---

## 🎓 Kesimpulan

Project **LaporanKita** adalah platform terintegrasi untuk manajemen pengaduan masyarakat dengan fitur:
- ✅ Autentikasi multi-channel (Email + Google)
- ✅ Laporan dengan foto dan lokasi
- ✅ Klasifikasi otomatis menggunakan Machine Learning
- ✅ Sistem voting/support untuk laporan
- ✅ Dashboard admin untuk monitoring
- ✅ Sistem notifikasi real-time
- ✅ API RESTful untuk mobile app

Dengan 21 use case utama, sistem ini dirancang untuk memudahkan masyarakat melaporkan masalah dan membantu admin dalam menangani pengaduan secara efisien.

---

**Dokumen ini dibuat untuk perencanaan dan dokumentasi project.**
**Terakhir diupdate: 3 Juni 2026**
