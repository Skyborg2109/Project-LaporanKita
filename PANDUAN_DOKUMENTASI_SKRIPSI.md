# Panduan Dokumentasi Bab IV Skripsi (Sangat Lengkap)
## Penerapan Metode Naive Bayes untuk Klasifikasi Laporan Pengaduan Masyarakat

Dokumen ini berisi panduan teknis dan akademis yang sangat rinci untuk membantu Anda menulis **Bab IV (Hasil dan Pembahasan)**. Panduan ini menjelaskan secara mendalam fungsi setiap halaman, mekanisme di balik layar (backend, routing, database), poin visual yang harus diberi tanda (anotasi), serta draf narasi skripsi siap pakai.

---

## 👥 KELOMPOK 1: ANTARMUKA & PENGAJUAN LAPORAN (SISI PELAPOR)

### 1. Halaman Login dan Registrasi
*   **Anotasi Visual (Beri Kotak Merah/Tanda Panah)**:
    1.  *Form Input Kredensial*: Bagian penginputan Email dan Password.
    2.  *Tombol Google Sign-In*: Tombol untuk masuk otomatis menggunakan akun Google.
*   **Detail Fungsional**: Halaman ini merupakan antarmuka awal bagi pengguna. Registrasi menggunakan enkripsi `bcrypt` pada password guna menjaga keamanan database. Proses autentikasi reguler diverifikasi oleh [AuthController::login](file:///c:/laragon/www/Project-LaporanKita/app/Http/Controllers/AuthController.php#L63) sedangkan Google SSO diproses oleh [AuthController::handleGoogleCallback](file:///c:/laragon/www/Project-LaporanKita/app/Http/Controllers/AuthController.php#L19) menggunakan Laravel Socialite.
*   **Draf Narasi Skripsi**:
    > "Halaman autentikasi pada Gambar 4.1 merupakan pintu gerbang keamanan sistem yang membedakan hak akses pengguna menggunakan konsep Role-Based Access Control (RBAC). Pada proses pendaftaran akun (registrasi), sistem mengenkripsi password menggunakan algoritma bcrypt (hash satu arah). Untuk memudahkan user pelapor, disediakan pula fitur Single Sign-On (SSO) menggunakan API Google OAuth 2.0. Saat proses autentikasi berhasil, session Laravel akan melakukan regenerasi ID session demi keamanan, lalu membagi redirect peran (role): jika role='admin' akan dilempar menuju rute /dashboardadmin, dan jika role='user' akan dilempar ke rute /dashboarduser."

---

### 2. Halaman Dashboard Pelapor
*   **Anotasi Visual (Beri Kotak Merah/Tanda Panah)**:
    1.  *Widget Ringkasan*: Kotak info jumlah total aduan, aduan diproses, dan selesai milik pelapor.
    2.  *Tabel Aduan Terbaru*: List daftar 5 laporan pengaduan terakhir milik user pelapor.
    3.  *Panel Notifikasi*: Lonceng notifikasi in-app di bagian atas.
*   **Detail Fungsional**: Diproses oleh [DashboardUserController::index](file:///c:/laragon/www/Project-LaporanKita/app/Http/Controllers/DashboardUserController.php#L22). Halaman ini melakukan query khusus ke tabel `laporans` dengan filter `where('user_id', Auth::id())` sehingga pengguna hanya dapat melihat pengaduannya sendiri (keamanan data terisolasi).
*   **Draf Narasi Skripsi**:
    > "Gambar 4.2 menyajikan halaman Dashboard Pelapor yang ditujukan khusus bagi masyarakat terdaftar. Melalui antarmuka ini, pengguna dapat memantau status aduan mereka secara dinamis. Widget ringkasan data dihitung langsung menggunakan agregasi Eloquent Laravel (`count()`) berdasarkan filter foreign key `user_id` pelapor yang sedang aktif. Halaman ini juga memuat daftar notifikasi belum dibaca yang bersumber dari tabel `notifications` untuk memberi tahu pengguna jika ada respons atau dukungan (vote) baru dari masyarakat lain terkait pengaduan miliknya."

---

### 3. Halaman Form Pengajuan Laporan (Fitur Prediksi AJAX Real-Time)
*   **Anotasi Visual (Beri Kotak Merah/Tanda Panah)**:
    1.  *Form Input*: Judul, Deskripsi aduan, Lokasi Kejadian, dan Input File Foto.
    2.  *Box Prediksi Kategori (AJAX)*: Area yang menampilkan tulisan *"Prediksi Kategori Otomatis: [Nama Kategori] (Keyakinan: XX.XX%)"* yang muncul secara real-time saat pengguna mengetik deskripsi aduan.
*   **Detail Fungsional**: Saat pelapor mengetik di kolom deskripsi, event JavaScript `keyup` mengirimkan teks aduan via Fetch API (AJAX) menuju rute [NaiveBayesController::predictAjax](file:///c:/laragon/www/Project-LaporanKita/app/Http/Controllers/NaiveBayesController.php#L103). Backend mengembalikan JSON berisi hasil prediksi kategori dan probabilitasnya tanpa memuat ulang halaman (asynchronous). Foto yang dipilih akan langsung diunggah ke Cloudinary saat formulir disubmit melalui [CloudinaryService](file:///c:/laragon/www/Project-LaporanKita/app/Services/CloudinaryService.php).
*   **Draf Narasi Skripsi**:
    > "Antarmuka pembuatan laporan pengaduan pada Gambar 4.3 dilengkapi dengan integrasi asinkron (AJAX) menuju mesin klasifikasi Naive Bayes. Ketika pelapor mendeskripsikan peristiwa (misalnya mengetik kalimat: 'ada jalan berlubang di jalan raya nasional km 12 dekat lampu merah...'), kode JavaScript di sisi klien akan mendeteksi ketukan tombol dan mengirimkan data teks tersebut ke `NaiveBayesController::predictAjax`. Di backend, teks tersebut diproses oleh `NaiveBayesService` untuk dibersihkan (preprocessing), di-stemming, dan dihitung skor kemiripannya dengan probabilitas kategori yang ada. Hasil klasifikasi sementara kemudian dikirim kembali dalam format JSON untuk langsung ditampilkan pada form pembuatan laporan sebagai rekomendasi kategori aduan."

---

### 4. Halaman Detail Laporan Pelapor
*   **Anotasi Visual (Beri Kotak Merah/Tanda Panah)**:
    1.  *Kategori & Status*: Label kategori aduan (hasil prediksi/verifikasi) dan status aduan (Baru/Diproses/Selesai).
    2.  *Bukti Foto*: Carousel gambar dokumentasi yang di-host di Cloudinary CDN.
    3.  *Tombol Dukung*: Tombol interaktif "Dukung" beserta jumlah masyarakat yang mendukung laporan tersebut.
*   **Detail Fungsional**: Ditangani oleh [DashboardUserController::show](file:///c:/laragon/www/Project-LaporanKita/app/Http/Controllers/DashboardUserController.php#L86). Tombol dukung memicu fungsi [DashboardUserController::toggleSupport](file:///c:/laragon/www/Project-LaporanKita/app/Http/Controllers/DashboardUserController.php#L200) untuk mencatat/menghapus relasi di tabel `supports` dan mengembalikan jumlah dukungan terbaru secara asinkron.
*   **Draf Narasi Skripsi**:
    > "Halaman detail laporan aduan pelapor (Gambar 4.4) menyajikan data pengaduan yang tersimpan lengkap dengan metadata pendukung. Bukti foto pengaduan dimuat langsung dari server Cloudinary menggunakan tautan aman. Halaman ini juga memiliki sistem interaksi publik berupa fitur 'Dukung Laporan'. Fitur ini bekerja dengan mencatat relasi Many-to-Many antara tabel `users` dan `laporans` ke dalam tabel pivot `supports`. Jumlah dukungan (vote count) ditampilkan secara langsung dan dapat diperbarui tanpa memuat ulang halaman berkat pemanfaatan asinkron JavaScript, membantu pengguna memantau urgensi aduan di mata masyarakat."

---

## ⚙️ KELOMPOK 2: DASHBOARD & VERIFIKASI PENGADUAN (SISI ADMIN)

### 5. Halaman Dashboard Utama Admin
*   **Anotasi Visual (Beri Kotak Merah/Tanda Panah)**:
    1.  *Widget Agregasi Laporan*: Statistik Laporan Baru, Diproses, Selesai dari seluruh masyarakat.
    2.  *Grafik Tren Laporan (Line Chart)*: Grafik visual yang menggambarkan frekuensi aduan masuk 7 hari terakhir.
    3.  *Tabel Laporan Terbaru*: Menampilkan 5 laporan pengaduan masyarakat yang baru saja dikirimkan.
*   **Detail Fungsional**: Diproses oleh [DashboardAdminController::index](file:///c:/laragon/www/Project-LaporanKita/app/Http/Controllers/DashboardAdminController.php#L24). Mengambil statistik laporan global dan menghitung data tren harian menggunakan kelas `Carbon` untuk dikirimkan ke view Blade yang menggunakan library Chart.js.
*   **Draf Narasi Skripsi**:
    > "Halaman Dashboard Admin pada Gambar 4.5 menyajikan visualisasi data operasional sistem secara real-time. Informasi agregasi total aduan diproses secara efisien menggunakan fungsi penarikan agregat (`count()`) dari Query Builder Laravel. Grafik garis (line chart) diimplementasikan dengan memanfaatkan library Chart.js, di mana label hari dan data statistik dihitung dari riwayat database 7 hari ke belakang menggunakan class Carbon Helper PHP. Antarmuka ini memudahkan administrator memantau beban kerja penanganan aduan masuk secara berkala."

---

### 6. Halaman Detail Laporan Admin (Verifikasi Status & Kategori)
*   **Anotasi Visual (Beri Kotak Merah/Tanda Panah)**:
    1.  *Dropdown Pilihan Kategori*: Dropdown berisi semua kategori aduan resmi untuk memvalidasi/mengoreksi hasil klasifikasi otomatis sistem.
    2.  *Dropdown Pilihan Status*: Pilihan status tindak lanjut aduan (baru, diproses, selesai, ditolak).
    3.  *Tombol Update*: Tombol simpan untuk memperbarui tabel database.
*   **Detail Fungsional**: Ditangani oleh [DashboardAdminController::show](file:///c:/laragon/www/Project-LaporanKita/app/Http/Controllers/DashboardAdminController.php#L80) dan [DashboardAdminController::updateStatus](file:///c:/laragon/www/Project-LaporanKita/app/Http/Controllers/DashboardAdminController.php#L87). Jika status diubah, sistem memicu pengiriman kelas notifikasi [LaporanStatusNotification](file:///c:/laragon/www/Project-LaporanKita/app/Notifications/LaporanStatusNotification.php) ke akun Pelapor terkait.
*   **Draf Narasi Skripsi**:
    > "Gambar 4.6 menampilkan halaman detail laporan di panel admin yang berfungsi sebagai pusat kendali tindak lanjut aduan. Melalui halaman ini, admin melakukan pemeriksaan silang (cross-check) terhadap kategori otomatis yang diajukan oleh algoritma Naive Bayes. Jika sistem salah mengklasifikasikan kategori (misalnya aduan tentang 'selokan tersumbat' diprediksi sebagai 'Infrastruktur' padahal seharusnya 'Kebersihan/Lingkungan'), admin dapat langsung mengubahnya secara manual lewat dropdown kategori. Saat tombol 'Simpan Perubahan' ditekan, sistem memperbarui tabel `laporans` dan mendeteksi perubahan status aduan. Jika terjadi perubahan status, event listener Laravel secara otomatis mengirimkan notifikasi in-app kepada user pembuat laporan."

---

## 🤖 KELOMPOK 3: IMPLEMENTASI & EVALUASI METODE NAIVE BAYES

### 7. Halaman Panel Utama Naive Bayes (Corpus & Tombol Training)
*   **Anotasi Visual (Beri Kotak Merah/Tanda Panah)**:
    1.  *Info Ringkasan Model*: Status Keaktifan Model, Jumlah Dokumen Training, Jumlah Kategori, dan Total Kata Unik (Vocabulary).
    2.  *Grafik Batang Distribusi*: Visualisasi jumlah dokumen per kategori.
    3.  *Tombol Training*: Tombol 'Mulai Training' untuk menjalankan proses ekstraksi data corpus.
    4.  *Tabel Detail Kelas*: Tabel berisi Prior Probability ($P(C_j)$) dari setiap kategori yang dihitung berdasarkan jumlah dokumen.
*   **Detail Fungsional**: Diproses oleh [NaiveBayesController::index](file:///c:/laragon/www/Project-LaporanKita/app/Http/Controllers/NaiveBayesController.php#L23). Menarik ringkasan statistik model dari [NaiveBayesService::getModelStats](file:///c:/laragon/www/Project-LaporanKita/app/Services/NaiveBayesService.php#L312). Tombol 'Mulai Training' mengeksekusi [NaiveBayesService::train](file:///c:/laragon/www/Project-LaporanKita/app/Services/NaiveBayesService.php#L117) yang membersihkan data training lama di tabel `naive_bayes_words` dan `naive_bayes_classes`, lalu melakukan ekstraksi kata serta perhitungan probabilitas dari data historis laporan pengaduan masyarakat.
*   **Draf Narasi Skripsi**:
    > "Gambar 4.7 menunjukkan halaman manajemen metode Naive Bayes yang digunakan untuk melatih model klasifikasi. Halaman ini memvisualisasikan data corpus yang tersimpan pada tabel `naive_bayes_words` dan `naive_bayes_classes`. Ketika tombol 'Mulai Training' ditekan, sistem mengeksekusi metode `NaiveBayesService::train()`. Langkah pertama proses training adalah membersihkan (truncate) tabel model sebelumnya, kemudian melakukan tokenisasi dan stemming sederhana terhadap seluruh deskripsi laporan pengaduan yang sudah divalidasi. Sistem selanjutnya menghitung total frekuensi kemunculan setiap kata di setiap kategori dan menghitung nilai Prior Probability $P(C_j)$ untuk masing-masing kelas dengan membagi jumlah dokumen kelas tersebut dengan total keseluruhan dokumen training."

---

### 8. Hasil Uji Klasifikasi Manual (Prediksi Kustom & Skor Probabilitas)
*   **Anotasi Visual (Beri Kotak Merah/Tanda Panah)**:
    1.  *Kolom Input Teks Uji*: Kotak textarea untuk mengetik kalimat pengujian bebas.
    2.  *Hasil Prediksi*: Label kategori hasil prediksi tertinggi.
    3.  *Nilai Probabilitas Akhir*: Persentase skor keyakinan akhir model (%).
    4.  *Tabel Distribusi Probabilitas*: Rincian persentase probabilitas untuk semua kategori kelas aduan (Softmax normalization).
*   **Detail Fungsional**: Dikendalikan oleh [NaiveBayesController::klasifikasi](file:///c:/laragon/www/Project-LaporanKita/app/Http/Controllers/NaiveBayesController.php#L66). Metode [NaiveBayesService::predict](file:///c:/laragon/www/Project-LaporanKita/app/Services/NaiveBayesService.php#L214) mengambil teks masukan, melakukan preprocessing (tokenize, stopword removal, stemming), menghitung log-probabilities untuk setiap kelas agar terhindar dari bias numerik (underflow), dan menerapkan normalisasi softmax untuk menghasilkan persentase probabilitas.
*   **Draf Narasi Skripsi**:
    > "Untuk membuktikan akurasi kalkulasi sistem secara transparan, Gambar 4.8 menyajikan antarmuka uji coba klasifikasi manual. Setelah admin menginput teks uji dan menekan tombol 'Klasifikasikan', backend memanggil metode `NaiveBayesService::predict()`. Teks input akan melalui tahap case folding, pembersihan tanda baca, penghapusan kata tidak bermakna (stopword), dan pemotongan imbuhan (stemming). Sistem kemudian mencari frekuensi kata-kata hasil pembersihan tersebut pada database model terlatih. Perhitungan probabilitas posterior $P(C_j|D)$ dilakukan menggunakan log-likelihood ditambahkan prior probabilitas kelas, ditambah penerapan Laplace Smoothing $+1$ pada pembilang dan $+|V|$ (total kosa kata unik) pada penyebut guna menghindari nilai nol. Nilai log-skor akhir tiap kelas kemudian dinormalisasi menggunakan fungsi softmax agar menghasilkan nilai probabilitas bernilai 0 hingga 100%."

---

### 9. Halaman Evaluasi Akurasi Batch (Uji Akurasi Sistem)
*   **Anotasi Visual (Beri Kotak Merah/Tanda Panah)**:
    1.  *Card Ringkasan Evaluasi*: Total data aduan diuji, jumlah prediksi benar, jumlah prediksi salah, dan persentase **Akurasi Model (%)**.
    2.  *Tabel Hasil Pengujian*: Tabel detail berisi kolom ID Laporan, Judul Laporan, Kategori Asli, Kategori Prediksi, Persentase Keyakinan, dan label status keberhasilan klasifikasi (BENAR/SALAH).
*   **Detail Fungsional**: Diproses oleh [NaiveBayesController::evaluasi](file:///c:/laragon/www/Project-LaporanKita/app/Http/Controllers/NaiveBayesController.php#L86). Rute ini mengeksekusi [NaiveBayesService::batchPredict](file:///c:/laragon/www/Project-LaporanKita/app/Services/NaiveBayesService.php#L347) yang melintasi (looping) seluruh laporan berkategori, menjalankan klasifikasi Naive Bayes, dan menghitung persentase akurasi akhir dengan rumus:
    $$\text{Akurasi} = \frac{\text{Jumlah Prediksi Benar}}{\text{Total Data Diuji}} \times 100\%$$
*   **Draf Narasi Skripsi**:
    > "Halaman evaluasi kinerja sistem pada Gambar 4.9 digunakan untuk mengukur kinerja algoritma Naive Bayes secara menyeluruh. Evaluasi dijalankan menggunakan metode Batch Prediction (`NaiveBayesService::batchPredict()`) terhadap seluruh laporan yang terdaftar. Sistem secara otomatis membandingkan kesesuaian antara kategori usulan sistem (prediksi) dengan kategori aduan asli yang telah diverifikasi oleh admin. Hasil evaluasi mencatat total data diuji sebanyak Z laporan, dengan klasifikasi tepat (Benar) sebanyak Y laporan, dan klasifikasi keliru (Salah) sebanyak Z-Y laporan, sehingga menghasilkan nilai akurasi sebesar X%. Pengujian ini memberikan landasan empiris bahwa metode Naive Bayes yang dibangun memiliki tingkat keandalan yang tinggi dalam mengklasifikasikan pengaduan masyarakat secara otomatis."
