# Membuka Use Case Diagram di Draw.io
## Panduan Lengkap

---

## 📥 Cara 1: Buka File yang Sudah Dibuat

### **Online (Recommended)**
1. Buka **[draw.io](https://draw.io)** di browser
2. Klik **File → Open** (atau `Ctrl+O`)
3. Pilih **Device** atau **Google Drive/OneDrive** sesuai lokasi file
4. Navigate ke: `c:\laragon\www\Project-LaporanKita\LaporanKita_UseCase.drawio`
5. Klik **Open**

**Atau Drag & Drop:**
- Buka draw.io di browser
- Drag file `LaporanKita_UseCase.drawio` ke area canvas
- Otomatis terbuka

### **Desktop (Draw.io Desktop App)**
1. Download dari: [draw.io releases](https://github.com/jgraph/drawio-desktop/releases)
2. Install aplikasi
3. Buka aplikasi
4. Klik **File → Open**
5. Pilih file `LaporanKita_UseCase.drawio`

---

## 🎨 Struktur Diagram

File ini sudah berisi:

### **4 Aktor** (Actor Shapes)
- 👤 **Guest User** (Kiri atas)
- 👤 **Registered User** (Kiri tengah)
- 👨‍💼 **Admin** (Kanan tengah)
- 🤖 **System** (Bawah)

### **21 Use Cases** (Ellipse Shapes)

**Warna Coding:**
- 🔵 **Biru** = Authentication (UC-001 s/d UC-005)
- 🟢 **Hijau** = Laporan Management (UC-006 s/d UC-011)
- 🟣 **Pink** = Support System (UC-012, UC-013)
- 🟡 **Ungu** = Admin Management (UC-014 s/d UC-018)
- 🟠 **Orange** = ML & Notifications (UC-019 s/d UC-021)

### **Relationships** (Garis)
- Garis padat = Aktor menggunakan UC
- Garis putus-putus = Include/Trigger relationship

---

## ✏️ Cara Mengedit Diagram

### **Menambah Use Case Baru**
1. Klik menu **Shape** di toolbar kiri
2. Cari **Ellipse** 
3. Drag ke canvas
4. Double-click untuk edit text
5. Ubah warna: Right-click → **Format → Style → Fill Color**

### **Menambah Aktor Baru**
1. Klik **Shape** → Cari **Actor**
2. Drag ke canvas
3. Double-click untuk edit nama

### **Menambah Relationship**
1. Klik **Connector** tool (panah di toolbar)
2. Drag dari Aktor ke Use Case
3. Atau dari UC ke UC untuk include/trigger

### **Edit Warna**
1. Klik UC/shape yang ingin diubah
2. Di panel kanan, klik **Style**
3. Ubah **Fill Color** sesuai kebutuhan

---

## 💾 Menyimpan & Export

### **Simpan ke Draw.io**
- `Ctrl+S` atau **File → Save**
- File akan tersimpan di lokasi yang sama

### **Export ke Format Lain**

**PNG (Gambar)**
1. **File → Export as → PNG**
2. Atur ukuran jika perlu
3. Klik **Export**

**PDF**
1. **File → Export as → PDF**
2. Klik **Export**

**SVG**
1. **File → Export as → SVG**
2. Klik **Export**

**JPG**
1. **File → Export as → JPG**
2. Klik **Export**

---

## 🔗 Share & Collaborate

### **Share Link**
1. Klik **File → Share**
2. Pilih opsi share (Google Drive, OneDrive, dll)
3. Copy link

### **Buka di GitHub**
1. Upload file `.drawio` ke repository
2. GitHub akan menampilkan preview diagram
3. Klik "View in draw.io" untuk edit online

---

## 📝 Tips & Tricks

### **Auto-arrange Diagram**
1. Pilih semua (Ctrl+A)
2. **Arrange → Align** untuk rapikan

### **Print Diagram**
1. **File → Print** (Ctrl+P)
2. Atur ukuran kertas
3. Print

### **Zoom**
- Mouse wheel untuk zoom
- Atau gunakan `+` `-` buttons di toolbar

### **Pan/Move**
- Hold spacebar + drag untuk move canvas
- Atau gunakan scroll bars

### **Layer Management**
- Right-click shape → **Arrange → Send to back/Bring to front**

---

## 🎓 Editing Tips

### **Atur Spacing Otomatis**
1. Select semua UC (Ctrl+A)
2. **Format → Arrange → Distribute**
3. Pilih **Distribute Horizontally/Vertically**

### **Edit Text dengan Cepat**
- Double-click shape untuk edit teks
- Tekan Escape untuk selesai

### **Copy Format**
1. Klik shape dengan format yang diinginkan
2. Klik format painter (di toolbar)
3. Klik shape lain untuk apply format

### **Change Font Size**
1. Select shape
2. Di panel kanan, lihat **Text**
3. Ubah font size di dropdown

---

## 🚀 Next Steps

### **Setelah Mengedit:**
1. Save file (Ctrl+S)
2. Export ke PNG/PDF untuk presentasi
3. Share dengan tim

### **Sinkronisasi dengan Documentation:**
Jika edit diagram, update juga:
- `USECASE_PLANNING.md` (deskripsi UC)
- `USECASE_DIAGRAMS.md` (mermaid version)
- `USECASE_QUICKREFERENCE.md` (quick guide)

---

## 🔧 Troubleshooting

### **File tidak terbuka?**
- Pastikan file berekstensi `.drawio`
- Coba buka di draw.io online
- Cek apakah file corrupt

### **Diagram tidak terlihat rapi?**
- Gunakan **Arrange → Auto Layout**
- Atau manual drag shapes untuk position

### **Mau share dengan format lain?**
- Export ke PNG/PDF untuk non-interactive view
- Export ke SVG untuk web compatible

---

## 📚 Resources

- **Draw.io Documentation:** https://www.drawio.com/doc/
- **UML Use Case Guide:** https://www.omg.org/spec/UML/
- **Tutorial Video:** Search "draw.io use case diagram" di YouTube

---

## 📌 File Locations

| File | Purpose |
|------|---------|
| `LaporanKita_UseCase.drawio` | Use Case Diagram (Draw.io format) |
| `USECASE_PLANNING.md` | Dokumentasi lengkap 21 UC |
| `USECASE_DIAGRAMS.md` | Diagram mermaid & workflows |
| `USECASE_QUICKREFERENCE.md` | Quick reference guide |

---

**Terakhir Update:** 3 Juni 2026

**Status Diagram:** ✅ Ready to use

Selamat membuat use case diagram! 🎨📊
