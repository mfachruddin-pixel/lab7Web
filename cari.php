<?php
// Data array sederhana
$daftarMahasiswa = ["Alya", "Bima", "Citra", "Doni", "Fachruddin"];
$hasilCari = [];
$kataKunci = "";

if (isset($_GET["kata"])) {
    $kataKunci = trim($_GET["kata"]);
    if ($kataKunci !== "") {
        foreach ($daftarMahasiswa as $mhs) {
            // stripos digunakan agar pencarian tidak case-sensitive
            if (stripos($mhs, $kataKunci) !== false) {
                $hasilCari[] = $mhs;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pencarian Mahasiswa (GET)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container bg-white p-4 rounded shadow-sm" style="max-width: 500px;">
        <h4>Cari Nama Mahasiswa</h4>
        <form method="GET" action="">
            <div class="input-group mb-3">
                <input id="kata" name="kata" type="text" class="form-control" placeholder="Masukkan nama..." value="<?= htmlspecialchars($kataKunci, ENT_QUOTES, "UTF-8") ?>">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>

        <?php if (isset($_GET["kata"])): ?>
            <p>Hasil pencarian untuk kata kunci: <strong><?= htmlspecialchars($kataKunci, ENT_QUOTES, "UTF-8") ?></strong></p>
            <?php if (count($hasilCari) > 0): ?>
                <ul class="list-group">
                    <?php foreach ($hasilCari as $hasil): ?>
                        <li class="list-group-item"><?= htmlspecialchars($hasil, ENT_QUOTES, "UTF-8") ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <div class="alert alert-warning">Data tidak ditemukan.</div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>