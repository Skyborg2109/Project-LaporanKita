# LaporanKita - Use Case Quick Reference
## Panduan Cepat untuk Developers & Stakeholders

---

## 🎯 Project Summary

**LaporanKita** adalah platform web untuk **Sistem Informasi Pengaduan Masyarakat (SIPM)** yang memungkinkan masyarakat melaporkan masalah kepada instansi yang berwenang dengan fitur:

✅ **Multi-channel Authentication** (Email, Google OAuth)  
✅ **AI-Powered Auto-Classification** (Naive Bayes)  
✅ **Social Support System** (Voting/Like)  
✅ **Admin Dashboard** (Monitoring & Management)  
✅ **RESTful API** (Mobile Integration)  
✅ **Real-time Notifications**  

**Tech Stack:** Laravel 11 | MySQL | Sanctum | Cloudinary | Naive Bayes ML

---

## 👥 3 Aktor Utama

### 1. 👤 Guest User
- **Akses:** Publik (tidak perlu login)
- **Fitur:**
  - Lihat daftar laporan
  - Lihat detail laporan
  - Register/Login

### 2. 👤 Registered User (Pelapor)
- **Akses:** Login required
- **Fitur:**
  - ➕ Buat laporan baru (foto + deskripsi)
  - 📋 Lihat laporan sendiri
  - ✏️ Edit laporan
  - ❌ Hapus laporan
  - 👍 Support laporan lain
  - 📨 Terima notifikasi
  - 📝 Edit profil

### 3. 👨‍💼 Admin
- **Akses:** Login required (role=admin)
- **Fitur:**
  - 📊 Dashboard (statistik laporan)
  - 📋 View semua laporan
  - 🔍 Filter laporan (status/kategori)
  - ✅ Update status laporan
  - 📁 Kategorisasi laporan
  - 📨 Trigger notifikasi

---

## 🚀 Use Cases (21 Total)

### **Authentication & Account (5 UC)**

| # | Use Case | Flow | Endpoint |
|----|----------|------|----------|
| **001** | **Register** | Guest fills form → Account created | `POST /api/auth/register` |
| **002** | **Login Email** | Enter credentials → Get token | `POST /api/auth/login` |
| **003** | **Login Google** | Click Google → OAuth → Auto login | `GET /auth/google/*` |
| **004** | **Logout** | Click logout → Session cleared | `POST /api/auth/logout` |
| **005** | **View Profile** | User clicks profile → See user data | `GET /api/auth/me` |

### **Laporan Management (6 UC)**

| # | Use Case | Flow | Endpoint |
|----|----------|------|----------|
| **006** | **Create Laporan** | Fill form + upload foto → **Auto-classify** → Save | `POST /api/laporan` |
| **007** | **View All Laporan** | List laporan publik (10 per page) | `GET /api/laporan` |
| **008** | **View Detail** | Click laporan → Show full detail | `GET /api/laporan/{id}` |
| **009** | **View My Laporan** | Authenticated user → Own reports | `GET /api/laporan/saya/list` |
| **010** | **Edit Laporan** | User can edit own report (status=BARU) | `PUT /api/laporan/{id}` |
| **011** | **Delete Laporan** | User/Admin can delete | `DELETE /api/laporan/{id}` |

### **Support System (2 UC)**

| # | Use Case | Flow | Model |
|----|----------|------|-------|
| **012** | **Support Laporan** | Click "Dukung" → Count+1 → Notify pelapor | Support model |
| **013** | **View Supporter List** | Show users who supported this report | Supporter list view |

### **Admin Dashboard (5 UC)**

| # | Use Case | Flow | Route |
|----|----------|------|-------|
| **014** | **View Dashboard** | Admin see: total, baru, diproses, selesai, chart | `/dashboardadmin` |
| **015** | **View All (Admin)** | Admin see all laporan with pagination | `/dashboardadmin/semualaporan` |
| **016** | **Filter Laporan** | Filter by status & kategori | GET with params |
| **017** | **View Detail (Admin)** | Admin see laporan detail + edit form | `/dashboardadmin/laporan/{id}` |
| **018** | **Update Status** | Admin change status → **Notify pelapor** | `PUT /api/laporan/{id}` |

### **ML & Notifications (3 UC)**

| # | Use Case | Flow | Trigger |
|----|----------|------|---------|
| **019** | **Auto-Classify** | Text preprocessing → Naive Bayes → Category assigned | On UC-006 |
| **020** | **Status Notification** | Admin update status → Pelapor notified | On UC-018 |
| **021** | **Support Notification** | User support → Pelapor notified | On UC-012 |

---

## 📊 Status Laporan Flow

```
BARU (New)
  ↓
DIPROSES (Processing)
  ↓
├─ SELESAI (Completed) ✓
└─ DITOLAK (Rejected) ✗
```

**Hanya admin yang bisa update status.**

---

## 🗂️ Key Database Models

### **User** (Registered users)
```
id | name | email* | password | role | is_verified | foto_profil | google_id | ...
```
*email unique

### **Laporan** (Reports)
```
id | user_id | judul | deskripsi | lokasi | foto[] | kategori | status | created_at
```

### **Support** (Votes/Likes)
```
id | user_id | laporan_id | created_at
```

### **Notification**
```
id | user_id | data{message, laporan_id} | read_at | created_at
```

### **Kategori** (Categories)
```
id | nama_kategori | deskripsi
```

### **NaiveBayesClass** & **NaiveBayesWord**
```
For ML training & classification
```

---

## 📱 Core API Endpoints

### Auth (Public)
```bash
POST   /api/auth/register          # Create account
POST   /api/auth/login             # Get token
GET    /auth/google/redirect       # OAuth redirect
GET    /auth/google/callback       # OAuth callback
```

### Auth (Protected)
```bash
POST   /api/auth/logout            # Logout
GET    /api/auth/me                # Get current user
```

### Laporan (Public)
```bash
GET    /api/laporan                # List all (paginated)
GET    /api/laporan/{id}           # Get detail
```

### Laporan (Protected)
```bash
POST   /api/laporan                # Create new
PUT    /api/laporan/{id}           # Update
DELETE /api/laporan/{id}           # Delete
GET    /api/laporan/saya/list      # Get own reports
```

---

## 🔄 Main User Journeys

### **Journey 1: Report a Problem** 👤📝✅
```
1. Guest visits site
2. Click "Report" → Redirect login
3. Register or Login (UC-002/003)
4. Fill laporan form (judul, deskripsi, lokasi, foto)
5. Submit → System auto-classifies (UC-019)
6. Laporan created with status "BARU"
7. User gets confirmation
8. Admin gets notified
```

### **Journey 2: Admin Reviews & Updates** 👨‍💼📊✅
```
1. Admin login (UC-002)
2. View dashboard (UC-014) → See new reports
3. Filter or search laporan (UC-016)
4. Click to see detail (UC-017)
5. Verify auto-classification
6. Update status: BARU → DIPROSES → SELESAI (UC-018)
7. System sends notification to user (UC-020)
8. User receives update
```

### **Journey 3: Support a Report** 👥👍
```
1. User login
2. Browse laporan list (UC-007)
3. See interesting laporan
4. Click "Dukung" button (UC-012)
5. Support count increases
6. Pelapor gets notified (UC-021)
```

---

## 🤖 Machine Learning Flow (Naive Bayes)

### **When:** User creates new laporan (UC-006)

### **How:**
```
Input: "Jalan Rusak di Jl. Sudirman"
       + "Banyak lubang di depan kantor, berbahaya"
       + "Jl. Sudirman Jakarta Pusat"
         ↓
[1] Text Preprocessing
    - Lowercase
    - Remove stopwords (yang, di, dari, dll)
         ↓
[2] Tokenization
    - Split into words
    - Stem words (lemmatization)
         ↓
[3] Feature Extraction
    - Count word frequencies per category
         ↓
[4] Naive Bayes Classification
    - Calculate probability for each category:
      P(Category | words) ∝ P(words | Category) × P(Category)
         ↓
[5] Result:
    - kategori = "Infrastruktur Jalan" (confidence: 0.87)
    - kategori = "Keselamatan" (confidence: 0.23)
         ↓
Output: Assign "Infrastruktur Jalan" to laporan
```

**Reference:** `app/Services/NaiveBayesService.php`

---

## 🔔 Notification Types

### **Type 1: Status Change Notification** (UC-020)
- **Trigger:** Admin update laporan status
- **Message:** "Laporan Anda berstatus [DIPROSES] pada 2026-06-03"
- **Recipient:** Laporan creator
- **Storage:** `notifications` table

### **Type 2: Support Notification** (UC-021)
- **Trigger:** User clicks "Dukung"
- **Message:** "[Nama User] mendukung laporan Anda"
- **Recipient:** Laporan creator
- **Storage:** `notifications` table

**Channel:** In-app only (Email optional)

---

## 🛡️ Security Features

✅ **Password Hashing** - bcrypt  
✅ **Token Authentication** - Sanctum Bearer token  
✅ **OAuth 2.0** - Google secure SSO  
✅ **Input Validation** - Form request validation  
✅ **Authorization** - Role-based (admin/user)  
✅ **CSRF Protection** - Laravel middleware  
✅ **SQL Injection Prevention** - ORM Eloquent  
✅ **File Upload Security** - Cloudinary CDN  

---

## 📈 Usage Statistics (Admin Dashboard)

**Displayed on UC-014:**
- Total laporan (semua waktu)
- Laporan Baru (status=baru)
- Laporan Diproses (status=diproses)
- Laporan Selesai (status=selesai)
- Laporan Ditolak (status=ditolak)
- Chart: Laporan per hari (7 hari terakhir)
- Recent: 5 laporan terbaru

---

## 🚦 Traffic Flow

```
User              Server              External Services
 ↓                                     
 │─ Login ────────→ Laravel Sanctum   
 │                  ↓ Validate
 │                  ↓ Generate Token
 │←────── Token ────┤
 │
 │─ Create Laporan ─→ Validate Input
 │                   ↓ Upload foto → Cloudinary → Store URL
 │                   ↓ Naive Bayes → Auto-classify
 │                   ↓ Save to DB
 │←── Success ──────┤
 │
 │─ View Laporan ──→ Query DB
 │                   ↓ Format response
 │←── JSON data ────┤
 │
 │─ Support ───────→ Check support exists
 │                   ↓ Insert/Delete
 │                   ↓ Trigger notification
 │←── Success ──────┤
```

---

## 📋 Development Phases

### **Phase 1: Core Features** ✅ DONE
- Authentication (Email + Google)
- Laporan CRUD
- Photo upload
- Auto-classification

### **Phase 2: Admin & Management** 🔄 IN PROGRESS
- Admin dashboard
- Status management
- Notifications
- Filtering

### **Phase 3: Enhancement** ⏳ TODO
- API documentation
- Mobile app optimization
- Email notifications
- Bulk operations
- Analytics

---

## 🎓 Quick Tips for Developers

### **Adding New Feature:**
1. Create UC (Use Case) description
2. Design database changes
3. Implement controller/service
4. Add API endpoint
5. Update routes
6. Test with Postman

### **Testing New UC:**
```bash
# Use Postman collection:
# LaporanKita_API.postman_collection.json

# Or cURL:
curl -X POST http://localhost/Project-LaporanKita/public/api/laporan \
  -H "Authorization: Bearer TOKEN" \
  -F "judul=Test Report" \
  -F "deskripsi=This is test" \
  -F "lokasi=Jakarta" \
  -F "foto=@/path/to/image.jpg"
```

### **Common Files:**
- Controllers: `app/Http/Controllers/`
- Models: `app/Models/`
- Routes: `routes/api.php`, `routes/web.php`
- Services: `app/Services/`
- Views: `resources/views/`

---

## 📞 Support & Documentation

| Dokumen | Link |
|---------|------|
| Full Use Case Planning | `USECASE_PLANNING.md` |
| Diagrams & Workflows | `USECASE_DIAGRAMS.md` |
| API Postman | `LaporanKita_API.postman_collection.json` |
| Project README | `README.md` |
| This Guide | `USECASE_QUICKREFERENCE.md` |

---

**Last Updated:** 3 Juni 2026  
**Project Status:** 🟡 In Development  
**Maintained by:** Development Team  
