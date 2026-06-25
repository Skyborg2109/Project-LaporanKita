# Quick Checklist - Membuat Use Case Diagram Manual
## Copy & Paste Version untuk Kemudahan

---

## 🎯 QUICK START (2 menit)

1. ✅ Buka **[draw.io](https://draw.io)**
2. ✅ Klik **Create New Diagram** → **Blank**
3. ✅ Siap mulai! 🚀

---

## 📋 FASE 1: AKTOR (5 menit)

### Tambah Actor Shapes:

```
ACTOR 1 - Guest User
- Shape: Actor
- Label: Guest User
- Position: (40, 200)

ACTOR 2 - Registered User
- Shape: Actor  
- Label: Registered User
- Position: (40, 400)

ACTOR 3 - Admin
- Shape: Actor
- Label: Admin
- Position: (1100, 400)

ACTOR 4 - System
- Shape: Actor
- Label: System
- Position: (550, 850)
```

**Checklist:**
- [ ] 4 aktor sudah ditambah
- [ ] Label sesuai
- [ ] Posisi tepat

---

## 📝 FASE 2: SYSTEM BOUNDARY

```
Shape: Rectangle
Label: "LaporanKita System"
Position: (180, 80)
Size: ~950x750

Style:
- Rounded: YES
- Stroke: 2px, #333333
- Fill: White
- Font: Bold, 14pt
```

**Checklist:**
- [ ] Boundary rectangle dibuat
- [ ] Label "LaporanKita System" ditambah
- [ ] Rounded corners aktif

---

## 🔵 FASE 3: AUTHENTICATION USE CASES (5 menit)

**Template UC (Ellipse):**
```
Fill: #B4E5FF (Light Blue)
Stroke: #0066CC, 2px
Font: 10pt, centered
Size: 90x50
```

| # | Label | X | Y |
|---|-------|---|---|
| UC-001 | Register | 250 | 120 |
| UC-002 | Login | 360 | 120 |
| UC-003 | Google OAuth | 470 | 120 |
| UC-004 | Logout | 580 | 120 |
| UC-005 | Profile | 690 | 120 |

**Checklist:**
- [ ] 5 ellipse dibuat
- [ ] Warna biru (#B4E5FF)
- [ ] Posisi grid (100px spacing)
- [ ] Font 10pt

---

## 🟢 FASE 4: LAPORAN MANAGEMENT USE CASES (8 menit)

**Template UC (Ellipse):**
```
Fill: #B4FFB4 (Light Green)
Stroke: #00AA00, 2px (NORMAL) atau 3px (PRIORITY)
Font: 10pt, centered
Size: 90x50
```

| # | Label | X | Y | Priority |
|---|-------|---|---|----|
| UC-006 | Create Laporan | 250 | 220 | ⭐ 3px |
| UC-007 | View All | 360 | 220 | 2px |
| UC-008 | Detail | 470 | 220 | 2px |
| UC-009 | My Laporan | 580 | 220 | 2px |
| UC-010 | Edit | 690 | 220 | 2px |
| UC-011 | Delete | 800 | 220 | 2px |

**Checklist:**
- [ ] 6 ellipse dibuat
- [ ] Warna hijau (#B4FFB4)
- [ ] UC-006 memiliki stroke 3px
- [ ] Posisi grid 100px spacing

---

## 🟣 FASE 5: SUPPORT USE CASES (3 menit)

**Template UC (Ellipse):**
```
Fill: #FFB4E5 (Light Pink)
Stroke: #CC0066, 2px (NORMAL) atau 3px (PRIORITY)
Font: 10pt, centered
Size: 90x50
```

| # | Label | X | Y | Priority |
|---|-------|---|---|----|
| UC-012 | Support | 360 | 320 | ⭐ 3px |
| UC-013 | Supporters | 470 | 320 | 2px |

**Checklist:**
- [ ] 2 ellipse dibuat
- [ ] Warna pink (#FFB4E5)
- [ ] UC-012 memiliki stroke 3px

---

## 🟡 FASE 6: ADMIN MANAGEMENT USE CASES (7 menit)

**Template UC (Ellipse):**
```
Fill: #E5B4FF (Light Purple)
Stroke: #9900CC, 2px (NORMAL) atau 3px (PRIORITY)
Font: 10pt, centered
Size: 90x50
```

| # | Label | X | Y | Priority |
|---|-------|---|---|----|
| UC-014 | Dashboard | 580 | 320 | ⭐ 3px |
| UC-015 | View All | 690 | 320 | 2px |
| UC-016 | Filter | 800 | 320 | 2px |
| UC-017 | Detail | 580 | 410 | 2px |
| UC-018 | Update Status | 690 | 410 | ⭐ 3px |

**Checklist:**
- [ ] 5 ellipse dibuat
- [ ] Warna ungu (#E5B4FF)
- [ ] UC-014 dan UC-018 memiliki stroke 3px

---

## 🟠 FASE 7: ML & NOTIFICATIONS USE CASES (5 menit)

**Template UC (Ellipse):**
```
Fill: #FFE5B4 (Light Orange)
Stroke: #FF8800, 2px (NORMAL) atau 3px (PRIORITY)
Font: 10pt, centered
Size: 90x50
```

| # | Label | X | Y | Priority |
|---|-------|---|---|----|
| UC-019 | Auto Classify | 250 | 520 | ⭐ 3px |
| UC-020 | Status Notif | 360 | 520 | ⭐ 3px |
| UC-021 | Support Notif | 470 | 520 | 2px |

**Checklist:**
- [ ] 3 ellipse dibuat
- [ ] Warna orange (#FFE5B4)
- [ ] UC-019 dan UC-020 memiliki stroke 3px

---

## 🔗 FASE 8: RELATIONSHIPS (25 menit)

### **GUEST USER Connections:**
```
Guest → UC-001 (solid line, 2px)
Guest → UC-002 (solid line, 2px)
Guest → UC-003 (solid line, 2px)
Guest → UC-007 (solid line, 2px)
Guest → UC-008 (solid line, 2px)
```

**Checklist:**
- [ ] 5 garis dibuat
- [ ] Semua solid line, 2px

---

### **REGISTERED USER Connections:**
```
User → UC-002 (solid line, 2px)
User → UC-004 (solid line, 2px)
User → UC-005 (solid line, 2px)
User → UC-006 (solid line, 2px)
User → UC-007 (solid line, 2px)
User → UC-008 (solid line, 2px)
User → UC-009 (solid line, 2px)
User → UC-010 (solid line, 2px)
User → UC-011 (solid line, 2px)
User → UC-012 (solid line, 2px)
User → UC-013 (solid line, 2px)
```

**Checklist:**
- [ ] 11 garis dibuat
- [ ] Semua solid line, 2px

---

### **ADMIN Connections:**
```
Admin → UC-002 (solid line, 2px)
Admin → UC-004 (solid line, 2px)
Admin → UC-014 (solid line, 2px)
Admin → UC-015 (solid line, 2px)
Admin → UC-016 (solid line, 2px)
Admin → UC-017 (solid line, 2px)
Admin → UC-018 (solid line, 2px)
```

**Checklist:**
- [ ] 7 garis dibuat
- [ ] Semua solid line, 2px

---

### **SYSTEM Connections (Dashed):**
```
System → UC-019 (dashed line, 2px, label "triggers")
System → UC-020 (dashed line, 2px, label "triggers")
System → UC-021 (dashed line, 2px, label "triggers")
```

**Checklist:**
- [ ] 3 garis dibuat
- [ ] Semua dashed line, 2px
- [ ] Label "triggers" ditambahkan

---

### **INCLUDE/TRIGGER Relationships:**
```
UC-006 → UC-019 (dashed line, 2px, #FF8800, label "includes")
UC-018 → UC-020 (dashed line, 2px, #FF8800, label "triggers")
UC-012 → UC-021 (dashed line, 2px, #FF8800, label "triggers")
```

**Checklist:**
- [ ] 3 garis dibuat
- [ ] Semua dashed line, 2px, warna orange (#FF8800)
- [ ] Label ditambahkan

---

## 🏷️ FASE 9: LEGEND (5 menit)

**Tambah Text di bawah diagram:**

```
Position (50, 700):
"LEGEND" (Bold, 12pt)

Position (50, 725):
"Blue = Authentication" (9pt)

Position (50, 745):
"Green = Laporan Management" (9pt)

Position (250, 725):
"Pink = Support System" (9pt)

Position (250, 745):
"Purple = Admin Management" (9pt)

Position (450, 725):
"Orange = ML and Notifications" (9pt)

Position (450, 745):
"Thick stroke = High Priority UC" (9pt)
```

**Checklist:**
- [ ] 7 text items ditambahkan
- [ ] Posisi sesuai
- [ ] Font size konsisten

---

## ✨ FASE 10: QUALITY CHECK

**Visual Check:**
- [ ] Semua 21 UC terlihat
- [ ] Semua 4 aktor terlihat
- [ ] Warna sesuai kategori
- [ ] Priority UC memiliki stroke tebal (3px)
- [ ] Layout rapi dan tidak overlap
- [ ] Legend jelas dan lengkap

**Content Check:**
- [ ] Semua aktor terhubung ke UC-nya
- [ ] Include/trigger relationships ada
- [ ] Label semua UC jelas dan benar
- [ ] Tidak ada typo

**Appearance Check:**
- [ ] Grid alignment bagus
- [ ] Spacing konsisten
- [ ] Ukuran ellipse sama (90x50)
- [ ] Font size konsisten (10pt untuk UC)

---

## 💾 PHASE 11: SAVE & EXPORT

**Save:**
1. Ctrl+S atau **File → Save**
2. Nama: **"LaporanKita-UseCase-Manual"**
3. Format: `.drawio` (default)

**Export (Optional):**
1. **File → Export as → PNG**
2. Atau **PDF** untuk print-friendly

**Checklist:**
- [ ] File sudah disave
- [ ] Nama file benar
- [ ] Versi export sudah dibuat (optional)

---

## 📊 TOTAL CHECKLIST

| Item | Count | Status |
|------|-------|--------|
| Aktor | 4 | [ ] |
| Authentication UC | 5 | [ ] |
| Laporan UC | 6 | [ ] |
| Support UC | 2 | [ ] |
| Admin UC | 5 | [ ] |
| ML UC | 3 | [ ] |
| **Total UC** | **21** | [ ] |
| Guest User connections | 5 | [ ] |
| Registered User connections | 11 | [ ] |
| Admin connections | 7 | [ ] |
| System connections | 3 | [ ] |
| Include/Trigger relationships | 3 | [ ] |
| **Total connections** | **29** | [ ] |
| Legend items | 7 | [ ] |

---

## ⏱️ ESTIMATED TIME PER PHASE

```
Phase 1: Aktor                    5 menit
Phase 2: Boundary                 3 menit
Phase 3: Authentication UC        5 menit
Phase 4: Laporan UC              8 menit
Phase 5: Support UC              3 menit
Phase 6: Admin UC                7 menit
Phase 7: ML UC                   5 menit
Phase 8: Relationships          20 menit
Phase 9: Legend                  5 menit
Phase 10: Quality Check          5 menit
Phase 11: Save & Export          2 menit
────────────────────────────────────────
TOTAL: ~70 menit
```

---

## 🎨 WARNA REFERENCE

Copy-paste colors untuk Draw.io:

```
Blue:    #B4E5FF    (Fill)  | #0066CC (Stroke)
Green:   #B4FFB4    (Fill)  | #00AA00 (Stroke)
Pink:    #FFB4E5    (Fill)  | #CC0066 (Stroke)
Purple:  #E5B4FF    (Fill)  | #9900CC (Stroke)
Orange:  #FFE5B4    (Fill)  | #FF8800 (Stroke)
Boundary: #333333 (Stroke)
```

---

## 🚀 SIAP MULAI?

1. Buka file ini sebagai reference
2. Buka [draw.io](https://draw.io)
3. Ikuti setiap fase dari atas ke bawah
4. Check setiap item saat selesai
5. Done! ✅

**Good luck! 💪**

---

**Created:** 3 Juni 2026
**Total UC:** 21
**Estimated Time:** 70 menit
**Difficulty:** Easy-Medium
