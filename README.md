# Lab7Web_PHP - Praktikum Pemrograman Web (Server-Side PHP)

**Identitas Mahasiswa**
- **Nama:** Muhammad Fachruddin
- **NIM:** 312510103
- **Program Studi:** Teknik Informatika
- **Universitas:** Universitas Pelita Bangsa (UPB)

## 📌 Tujuan Praktikum
1. Memahami perbedaan arsitektur pemrosesan client-side dan server-side.
2. Menguasai sintaks dasar PHP, variabel, array, perulangan, percabangan, dan *functions*.
3. Mampu menerima, memvalidasi (server-side), mensanitasi, dan menampilkan data dari form HTML menggunakan metode GET dan POST.

## 🛠️ Perangkat & Lingkungan
- **Text Editor:** Visual Studio Code
- **Web Server Lokal:** XAMPP (Apache & PHP)
- **Browser:** Google Chrome / Edge

## 🚀 Cara Menjalankan Server Lokal & Proyek
1. Buka aplikasi **XAMPP Control Panel**.
2. Klik tombol **Start** pada modul **Apache**.
3. Pindahkan folder repository ini (`Lab7Web_PHP`) ke dalam direktori `C:\xampp\htdocs\`.
4. Buka web browser dan akses URL berikut: 
   `http://localhost/Lab7Web_PHP/mini_project.php`

## 📂 Struktur File
- `index.php` : Kumpulan Latihan 1 - 7 dari modul praktikum.
- `mini_project.php` : Source code utama Aplikasi Formulir Data Mahasiswa dengan integrasi Bootstrap 5.
- `cari.php` : Implementasi Eksperimen Mandiri 2 (Pencarian nama dalam array dengan metode GET).
- `README.md` : Dokumentasi repository.

## 📝 Ringkasan Kasus Uji Validasi (Mini Project)
- **Kasus Input Valid:** Memasukkan Nama "Muhammad Fachruddin", NIM "312510103" (tepat 9 angka), email yang valid (contoh@email.com), semester 3, dan semua nilai angka terisi penuh. Sistem berhasil menampilkan ringkasan data, menghitung rata-rata, dan memformat biaya admin ke dalam Rupiah.
- **Kasus Input Tidak Valid 1:** Kolom NIM diisi dengan "31251" (kurang dari 9 digit) atau mengandung huruf. PHP akan memblokir proses dan memunculkan error *"NIM harus berupa angka dan berjumlah tepat 9 digit."*
- **Kasus Input Tidak Valid 2:** Mengosongkan komponen nilai atau mengisi Semester dengan angka "15". PHP akan mendeteksi *out of bounds* dan memunculkan notifikasi *"Semester harus berupa angka 1-14."*

## 💡 Jawaban Pertanyaan Evaluasi
1. **Perbedaan pemrosesan client-side dan server-side:** Client-side adalah proses yang dieksekusi langsung di sisi browser pengguna, sedangkan server-side berjalan di komputer server untuk memproses logika sebelum hasilnya dikirim kembali ke browser berupa HTML.
2. **Mengapa file PHP harus dijalankan melalui web server:** Karena PHP bersifat server-side, sehingga butuh web server (seperti Apache) untuk menerjemahkan skrip menjadi output HTML.
3. **Fungsi tanda $ pada variabel PHP:** Berfungsi untuk mendeklarasikan atau mengawali penamaan sebuah variabel.
4. **Perbedaan metode GET dan POST:** GET mengirimkan data dengan menyisipkannya pada parameter URL, sedangkan POST mengirimkan data melalui body HTTP request sehingga lebih rahasia dan aman.
5. **Mengapa input pengguna perlu divalidasi di sisi server:** Karena validasi client-side (HTML) mudah dimanipulasi; validasi server-side adalah pertahanan utama untuk memastikan data valid dan aman.
6. **Fungsi htmlspecialchars():** Untuk mencegah eksekusi skrip berbahaya (XSS) dengan mengonversi karakter khusus menjadi entitas HTML saat menampilkan data ke halaman.
7. **Manfaat penggunaan function:** Memungkinkan blok kode digunakan kembali berkali-kali tanpa harus menulis ulang logika yang sama, sehingga kode lebih terstruktur.