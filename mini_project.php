<?php
// Inisialisasi variabel
$data = null;
$error = [];

// [Eksperimen Mandiri 3] Function untuk mengubah format harga menjadi Rupiah
function formatRupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}

// Proses data saat form disubmit dengan metode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["nama"] ?? "");
    $nim = trim($_POST["nim"] ?? "");
    $prodi = trim($_POST["prodi"] ?? "");
    $semesterInput = $_POST["semester"] ?? "";
    $email = trim($_POST["email"] ?? "");
    
    // [Eksperimen Mandiri 1] Komponen nilai
    $nilaiTugas = $_POST["nilai_tugas"] ?? "";
    $nilaiUts = $_POST["nilai_uts"] ?? "";
    $nilaiUas = $_POST["nilai_uas"] ?? "";

    // Validasi Server-Side
    if ($nama === "") $error[] = "Nama wajib diisi.";
    if ($prodi === "") $error[] = "Program studi wajib diisi.";
    
    // [Eksperimen Mandiri 4] Validasi NIM (Hanya angka dan panjang tepat 9 digit)
    if ($nim === "") {
        $error[] = "NIM wajib diisi.";
    } elseif (!ctype_digit($nim) || strlen($nim) !== 9) {
        $error[] = "NIM harus berupa angka dan berjumlah tepat 9 digit.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Format email tidak valid.";
    }
    
    if (!ctype_digit((string)$semesterInput) || (int)$semesterInput < 1 || (int)$semesterInput > 14) {
        $error[] = "Semester harus berupa angka 1-14.";
    }

    if ($nilaiTugas === "" || $nilaiUts === "" || $nilaiUas === "") {
        $error[] = "Semua komponen nilai wajib diisi.";
    } elseif (!is_numeric($nilaiTugas) || !is_numeric($nilaiUts) || !is_numeric($nilaiUas)) {
        $error[] = "Nilai harus berupa angka.";
    }

    // Jika tidak ada error, proses data
    if (!$error) {
        // [Eksperimen Mandiri 1] Hitung rata-rata nilai
        $rataRata = ($nilaiTugas + $nilaiUts + $nilaiUas) / 3;
        
        $data = compact("nama", "nim", "prodi", "email", "nilaiTugas", "nilaiUts", "nilaiUas", "rataRata");
        $data["semester"] = (int)$semesterInput;
        $data["biaya_admin"] = 150000; // Contoh data untuk menguji function formatRupiah
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Data Mahasiswa - Praktikum 7</title>
    <!-- Menggunakan Bootstrap 5 untuk UI Profesional -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <!-- Menampilkan Pesan Error Jika Ada -->
            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($error as $err): ?>
                            <li><?= htmlspecialchars($err, ENT_QUOTES, "UTF-8") ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Menampilkan Ringkasan Data Jika Sukses -->
            <?php if ($data): ?>
                <div class="card shadow-sm mb-4 border-success">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Ringkasan Data Mahasiswa</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless mb-0">
                            <tr><th width="30%">Nama</th><td>: <?= htmlspecialchars($data["nama"], ENT_QUOTES, "UTF-8") ?></td></tr>
                            <tr><th>NIM</th><td>: <?= htmlspecialchars($data["nim"], ENT_QUOTES, "UTF-8") ?></td></tr>
                            <tr><th>Program Studi</th><td>: <?= htmlspecialchars($data["prodi"], ENT_QUOTES, "UTF-8") ?></td></tr>
                            <tr><th>Semester</th><td>: <?= $data["semester"] ?></td></tr>
                            <tr><th>Email</th><td>: <?= htmlspecialchars($data["email"], ENT_QUOTES, "UTF-8") ?></td></tr>
                            <tr><th>Nilai Rata-rata</th><td>: <?= number_format($data["rataRata"], 2) ?></td></tr>
                            <tr><th>Biaya Admin</th><td>: <?= formatRupiah($data["biaya_admin"]) ?></td></tr>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Form Data Mahasiswa -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Formulir Data Mahasiswa</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" required value="<?= $_POST['nama'] ?? '' ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">NIM (9 Digit)</label>
                                <input type="text" name="nim" class="form-control" required value="<?= $_POST['nim'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Program Studi</label>
                                <input type="text" name="prodi" class="form-control" required value="<?= $_POST['prodi'] ?? '' ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required value="<?= $_POST['email'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Semester (1-14)</label>
                            <input type="number" name="semester" class="form-control" min="1" max="14" required value="<?= $_POST['semester'] ?? '' ?>">
                        </div>
                        
                        <h5 class="border-bottom pb-2 mb-3">Komponen Nilai</h5>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label class="form-label">Nilai Tugas</label>
                                <input type="number" step="0.01" name="nilai_tugas" class="form-control" required value="<?= $_POST['nilai_tugas'] ?? '' ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Nilai UTS</label>
                                <input type="number" step="0.01" name="nilai_uts" class="form-control" required value="<?= $_POST['nilai_uts'] ?? '' ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Nilai UAS</label>
                                <input type="number" step="0.01" name="nilai_uas" class="form-control" required value="<?= $_POST['nilai_uas'] ?? '' ?>">
                            </div>
                        </div>

                        <!-- [Eksperimen Mandiri 5] Tombol Kirim & Reset -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">Kirim Data</button>
                            <button type="reset" class="btn btn-secondary px-4">Reset Form</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>