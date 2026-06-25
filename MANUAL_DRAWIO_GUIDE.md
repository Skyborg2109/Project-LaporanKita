# Panduan Manual Membuat Use Case Diagram di Draw.io
## Project LaporanKita

---

## 📋 Daftar Isi
1. [Persiapan](#persiapan)
2. [Step-by-Step Pembuatan](#step-by-step-pembuatan)
3. [Posisi & Layout](#posisi--layout)
4. [Warna & Styling](#warna--styling)
5. [Checklist Penyelesaian](#checklist-penyelesaian)

---

## 🎯 Persiapan

### **Tools yang Diperlukan:**
- Browser (Chrome, Firefox, Edge)
- Koneksi internet
- File ini sebagai referensi

### **Buka Draw.io:**
1. Kunjungi **[draw.io](https://draw.io)**
2. Klik **"Create New Diagram"** atau **"File → New"**
3. Pilih **"Blank Diagram"**
4. Klik **"Create"**

### **Siapkan Kanvas:**
- Kanvas terbuka dengan grid
- Ukuran default sudah cukup
- Anda bisa zoom in/out dengan mouse wheel

---

## 📐 Step-by-Step Pembuatan

### **FASE 1: SETUP AWAL (5 menit)**

#### **Step 1: Buat System Boundary**
1. Di toolbar kiri, cari **Shape**
2. Pilih **Rectangle** (kotak)
3. Drag di tengah kanvas membuat kotak besar (area diagram)
4. Double-click untuk edit text: **"LaporanKita System"**
5. Atur ukuran: ~950px width × 750px height
6. Right-click → **Style** → Ubah:
   - **Stroke**: 2px
   - **Fill Color**: White atau Light Gray
   - **Font Size**: 14
   - **Font Style**: Bold
   - Centang **Rounded**

#### **Step 2: Buat Title/Label**
1. Tambah **Text** element di atas boundary
2. Tulis: **"LaporanKita - Use Case Diagram"**
3. Font size: 16, Bold

---

### **FASE 2: TAMBAH AKTOR (10 menit)**

#### **Step 3: Guest User (Kiri Atas)**
1. Cari **Actor** shape di toolbar
2. Drag ke kiri atas (di luar boundary)
3. Label: **"👤 Guest User"** (atau cukup "Guest User")
4. Posisi: x=40, y=200

#### **Step 4: Registered User (Kiri Tengah)**
1. Tambah **Actor** baru
2. Label: **"👤 Registered User"**
3. Posisi: x=40, y=400
4. Spasi vertikal: ~200px dari actor sebelumnya

#### **Step 5: Admin (Kanan Tengah)**
1. Tambah **Actor** baru
2. Label: **"👨‍💼 Admin"**
3. Posisi: x=1100, y=400 (di luar boundary kanan)
4. Mirror dari User position

#### **Step 6: System (Bawah)**
1. Tambah **Actor** baru
2. Label: **"🤖 System"**
3. Posisi: x=550, y=850 (di bawah boundary)

---

### **FASE 3: TAMBAH USE CASES - AUTHENTICATION (15 menit)**

#### **Step 7: Kelompok Authentication (Warna Biru)**

**UC-001: Register**
1. Cari **Ellipse** shape
2. Drag ke dalam boundary
3. Label: **"UC-001\nRegister"** (Enter untuk line break)
4. Posisi: x=250, y=120
5. Size: 90px × 50px
6. Style:
   - Fill: **#B4E5FF** (Light Blue)
   - Stroke: **#0066CC** (Dark Blue), 2px
   - Font: 10pt, center aligned

**UC-002: Login**
1. Duplicate UC-001 (Ctrl+D atau Copy-Paste)
2. Label: **"UC-002\nLogin"**
3. Posisi: x=360, y=120 (100px ke kanan)

**UC-003: Google OAuth**
1. Duplicate UC-002
2. Label: **"UC-003\nGoogle OAuth"**
3. Posisi: x=470, y=120

**UC-004: Logout**
1. Duplicate UC-003
2. Label: **"UC-004\nLogout"**
3. Posisi: x=580, y=120

**UC-005: View Profile**
1. Duplicate UC-004
2. Label: **"UC-005\nProfile"**
3. Posisi: x=690, y=120

---

### **FASE 4: TAMBAH USE CASES - LAPORAN (20 menit)**

#### **Step 8: Kelompok Laporan Management (Warna Hijau)**

**UC-006: Create Laporan** (HIGH PRIORITY - Bold border)
1. Buat Ellipse baru
2. Label: **"UC-006\nCreate Laporan"**
3. Posisi: x=250, y=220 (100px bawah UC-001)
4. Style:
   - Fill: **#B4FFB4** (Light Green)
   - Stroke: **#00AA00**, **3px** (lebih tebal!)
   - Font: 10pt

**UC-007: View All**
1. Duplicate UC-006 (untuk copy warna)
2. Label: **"UC-007\nView All"**
3. Posisi: x=360, y=220
4. Stroke: **2px** (normal)

**UC-008: View Detail**
1. Duplicate UC-007
2. Label: **"UC-008\nDetail"**
3. Posisi: x=470, y=220

**UC-009: My Laporan**
1. Duplicate UC-008
2. Label: **"UC-009\nMy Laporan"**
3. Posisi: x=580, y=220

**UC-010: Edit Laporan**
1. Duplicate UC-009
2. Label: **"UC-010\nEdit"**
3. Posisi: x=690, y=220

**UC-011: Delete Laporan**
1. Duplicate UC-010
2. Label: **"UC-011\nDelete"**
3. Posisi: x=800, y=220

---

### **FASE 5: TAMBAH USE CASES - SUPPORT (8 menit)**

#### **Step 9: Kelompok Support System (Warna Pink)**

**UC-012: Support Laporan** (HIGH PRIORITY)
1. Buat Ellipse baru
2. Label: **"UC-012\nSupport"**
3. Posisi: x=360, y=320 (100px bawah UC-007)
4. Style:
   - Fill: **#FFB4E5** (Light Pink)
   - Stroke: **#CC0066**, **3px** (bold)

**UC-013: View Supporters**
1. Duplicate UC-012
2. Label: **"UC-013\nSupporters"**
3. Posisi: x=470, y=320
4. Stroke: **2px** (normal)

---

### **FASE 6: TAMBAH USE CASES - ADMIN (12 menit)**

#### **Step 10: Kelompok Admin Management (Warna Ungu)**

**UC-014: View Dashboard** (HIGH PRIORITY)
1. Buat Ellipse baru
2. Label: **"UC-014\nDashboard"**
3. Posisi: x=580, y=320
4. Style:
   - Fill: **#E5B4FF** (Light Purple)
   - Stroke: **#9900CC**, **3px** (bold)

**UC-015: View All (Admin)**
1. Duplicate UC-014
2. Label: **"UC-015\nView All"**
3. Posisi: x=690, y=320
4. Stroke: **2px**

**UC-016: Filter Laporan**
1. Duplicate UC-015
2. Label: **"UC-016\nFilter"**
3. Posisi: x=800, y=320

**UC-017: View Detail (Admin)**
1. Duplicate UC-016
2. Label: **"UC-017\nDetail"**
3. Posisi: x=580, y=410 (90px bawah)

**UC-018: Update Status** (HIGH PRIORITY)
1. Duplicate UC-017
2. Label: **"UC-018\nUpdate Status"**
3. Posisi: x=690, y=410
4. Stroke: **3px** (bold)

---

### **FASE 7: TAMBAH USE CASES - ML & NOTIFICATIONS (10 menit)**

#### **Step 11: Kelompok ML & Notifications (Warna Orange)**

**UC-019: Auto-Classify** (HIGH PRIORITY)
1. Buat Ellipse baru
2. Label: **"UC-019\nAuto Classify"**
3. Posisi: x=250, y=520 (110px bawah)
4. Style:
   - Fill: **#FFE5B4** (Light Orange)
   - Stroke: **#FF8800**, **3px** (bold)

**UC-020: Status Notification** (HIGH PRIORITY)
1. Duplicate UC-019
2. Label: **"UC-020\nStatus Notif"**
3. Posisi: x=360, y=520

**UC-021: Support Notification**
1. Duplicate UC-020
2. Label: **"UC-021\nSupport Notif"**
3. Posisi: x=470, y=520
4. Stroke: **2px**

---

### **FASE 8: TAMBAH RELATIONSHIPS (30 menit)**

#### **Step 12: Aktor ke Use Cases**

**Dari Guest User ke UC-001, UC-002, UC-003, UC-007, UC-008:**
1. Pilih **Connector** tool (panah di toolbar)
2. Drag dari Guest User ke UC-001
3. Line style: Solid, 2px
4. Arrow: Open arrow (default)
5. Repeat untuk UC-002, UC-003, UC-007, UC-008

**Dari Registered User ke semua UC yang bisa diakses:**
- UC-002, UC-004, UC-005, UC-006, UC-007, UC-008, UC-009, UC-010, UC-011, UC-012, UC-013

**Dari Admin ke UC-nya:**
- UC-002, UC-004, UC-014, UC-015, UC-016, UC-017, UC-018

**Dari System ke UC-019, UC-020, UC-021:**
- Style: **Dashed line**, 2px
- Label: **"triggers"**

---

### **FASE 9: INCLUDE RELATIONSHIPS (5 menit)**

#### **Step 13: Include/Triggers Relationships**

**UC-006 includes UC-019:**
1. Buat connector dari UC-006 ke UC-019
2. Style: **Dashed**, 2px, **#FF8800** (orange)
3. Label: **"includes"**

**UC-018 triggers UC-020:**
1. Connector dari UC-018 ke UC-020
2. Style: **Dashed**, 2px, **#FF8800**
3. Label: **"triggers"**

**UC-012 triggers UC-021:**
1. Connector dari UC-012 ke UC-021
2. Style: **Dashed**, 2px, **#FF8800**
3. Label: **"triggers"**

---

### **FASE 10: LEGEND (10 menit)**

#### **Step 14: Tambah Legend**

Di bawah diagram (area kosong):

1. **Text "LEGEND"** - Font Bold 12pt
   - Posisi: x=50, y=700

2. **Text "Blue = Authentication"** - Font 9pt
   - Posisi: x=50, y=725

3. **Text "Green = Laporan Management"** - Font 9pt
   - Posisi: x=50, y=745

4. **Text "Pink = Support System"** - Font 9pt
   - Posisi: x=250, y=725

5. **Text "Purple = Admin Management"** - Font 9pt
   - Posisi: x=250, y=745

6. **Text "Orange = ML and Notifications"** - Font 9pt
   - Posisi: x=450, y=725

7. **Text "Thick stroke = High Priority UC"** - Font 9pt
   - Posisi: x=450, y=745

---

## 📏 Posisi & Layout

### **Referensi Posisi (X, Y):**

**Aktor:**
```
Guest User:        x=40,   y=200
Registered User:   x=40,   y=400
Admin:             x=1100, y=400
System:            x=550,  y=850
```

**Row 1 - Authentication (y=120):**
```
UC-001: x=250
UC-002: x=360
UC-003: x=470
UC-004: x=580
UC-005: x=690
```

**Row 2 - Laporan (y=220):**
```
UC-006: x=250
UC-007: x=360
UC-008: x=470
UC-009: x=580
UC-010: x=690
UC-011: x=800
```

**Row 3 - Support & Admin (y=320):**
```
UC-012: x=360
UC-013: x=470
UC-014: x=580
UC-015: x=690
UC-016: x=800
```

**Row 4 - Admin (y=410):**
```
UC-017: x=580
UC-018: x=690
```

**Row 5 - ML & Notifications (y=520):**
```
UC-019: x=250
UC-020: x=360
UC-021: x=470
```

---

## 🎨 Warna & Styling

### **Tabel Warna:**

| Kategori | Fill Color | Stroke Color | Stroke Width |
|----------|-----------|--------------|-------------|
| Authentication | #B4E5FF | #0066CC | 2px |
| Laporan (normal) | #B4FFB4 | #00AA00 | 2px |
| Laporan (priority) | #B4FFB4 | #00AA00 | **3px** |
| Support (normal) | #FFB4E5 | #CC0066 | 2px |
| Support (priority) | #FFB4E5 | #CC0066 | **3px** |
| Admin (normal) | #E5B4FF | #9900CC | 2px |
| Admin (priority) | #E5B4FF | #9900CC | **3px** |
| ML (normal) | #FFE5B4 | #FF8800 | 2px |
| ML (priority) | #FFE5B4 | #FF8800 | **3px** |

### **Priority Use Cases (Bold = 3px stroke):**
- ✓ UC-006: Create Laporan
- ✓ UC-012: Support Laporan
- ✓ UC-014: View Dashboard
- ✓ UC-018: Update Status
- ✓ UC-019: Auto-Classify
- ✓ UC-020: Status Notification

---

## ✅ Checklist Penyelesaian

### **Phase 1: Setup ✓**
- [ ] Buka draw.io dan buat diagram baru
- [ ] Buat system boundary rectangle
- [ ] Tambah title/label

### **Phase 2: Aktor ✓**
- [ ] Tambah Guest User (kiri atas)
- [ ] Tambah Registered User (kiri tengah)
- [ ] Tambah Admin (kanan tengah)
- [ ] Tambah System (bawah)

### **Phase 3: Use Cases ✓**
- [ ] Authentication (5 UC, warna biru)
- [ ] Laporan Management (6 UC, warna hijau)
- [ ] Support System (2 UC, warna pink)
- [ ] Admin Management (5 UC, warna ungu)
- [ ] ML & Notifications (3 UC, warna orange)

### **Phase 4: Styling ✓**
- [ ] Atur warna semua UC sesuai kategori
- [ ] Atur stroke width (2px normal, 3px priority)
- [ ] Atur font size konsisten (10pt)

### **Phase 5: Relationships ✓**
- [ ] Draw garis dari Guest User ke UC-nya
- [ ] Draw garis dari Registered User ke UC-nya
- [ ] Draw garis dari Admin ke UC-nya
- [ ] Draw dashed lines dari System ke UC-nya
- [ ] Draw include/trigger relationships

### **Phase 6: Legend ✓**
- [ ] Tambah legend text untuk setiap kategori
- [ ] Tambah penjelasan stroke width

### **Quality Check ✓**
- [ ] Semua 21 UC ada
- [ ] Semua 4 aktor ada
- [ ] Warna sesuai kategori
- [ ] Priority UC memiliki stroke 3px
- [ ] Relationships lengkap
- [ ] Layout rapi dan mudah dibaca

---

## 💡 Tips & Tricks

### **Duplikasi Cepat:**
- Copy-paste UC yang sudah di-style untuk copy warna/font
- Tinggal edit posisi dan label

### **Align Otomatis:**
- Select multiple UC (Shift+Click)
- Right-click → **Arrange → Distribute Horizontally**
- Untuk align vertikal: **Arrange → Align → Top/Bottom**

### **Edit Text Cepat:**
- Double-click ellipse untuk edit text
- Tekan Tab untuk pindah ke shape berikutnya

### **Zoom & Pan:**
- Mouse wheel untuk zoom
- Spacebar + drag untuk pan/move canvas
- Ctrl+Shift+F untuk fit to window

### **Save Progress:**
- Ctrl+S atau **File → Save**
- Simpan dengan nama: **"LaporanKita-UseCase-Manual"**

---

## 🚀 Estimated Time

| Fase | Durasi |
|------|--------|
| Setup Awal | 5 menit |
| Aktor | 5 menit |
| Authentication UC | 5 menit |
| Laporan UC | 8 menit |
| Support UC | 3 menit |
| Admin UC | 7 menit |
| ML UC | 5 menit |
| Relationships | 20 menit |
| Legend | 5 menit |
| Quality Check | 5 menit |
| **TOTAL** | **~70 menit** |

---

## 📸 Preview Hasil Akhir

```
                            ┌─────── Authentication (Biru) ──────────────┐
                            │ UC-001 UC-002 UC-003 UC-004 UC-005         │
                            └──────────────────────────────────────────────┘
                            
                            ┌─────── Laporan (Hijau) ──────────────────────┐
👤 Guest User ─────────────│ UC-006* UC-007 UC-008 UC-009 UC-010 UC-011 │
                            └──────────────────────────────────────────────┘
👤 Registered User ──────────
                            ┌─ Support (Pink) ─┬─ Admin (Ungu) ──────────┐
                            │ UC-012* UC-013   │ UC-014* UC-015 UC-016  │
                            └──────────────────┼────────────────────────┘
👨‍💼 Admin ─────────────────┐ │                  │ UC-017 UC-018*        │
                            │ └──────────────────┴────────────────────────┘
                            │
                            ┌────────── ML & Notifications (Orange) ──────┐
                            │ UC-019* UC-020* UC-021                      │
                            └─────────────────────────────────────────────┘
                            
                            🤖 System
                            
* = High Priority (Bold stroke 3px)
```

---

## 📞 Referensi

- **Draw.io Docs:** https://www.drawio.com/doc/
- **File Dokumentasi:** `USECASE_PLANNING.md`
- **Quick Reference:** `USECASE_QUICKREFERENCE.md`

---

**Good luck! Anda pasti bisa! 💪**

Terakhir update: 3 Juni 2026
