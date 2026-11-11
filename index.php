<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Praktikum PHP - Latihan Dasar</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; line-height: 1.6; }
        .latihan { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        h2 { color: #333; border-bottom: 2px solid #eee; padding-bottom: 5px; }
    </style>
</head>
<body>
    <h1>Belajar PHP - Latihan 1 sampai 7</h1>

    <div class="latihan">
        <h2>Latihan 1: Menjalankan PHP</h2>
        <?php
        echo "<p>PHP berhasil dijalankan.</p>";
        echo "<p>Waktu server: " . date("d-m-Y H:i:s") . "</p>";
        ?>
    </div>

    <div class="latihan">
        <h2>Latihan 2: Variabel, operator, dan percabangan</h2>
        <?php
        $nama = "Siti";
        $tugas = 85;
        $uts = 78;
        $uas = 90;
        $nilaiAkhir = ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);
        
        if ($nilaiAkhir >= 85) {
            $predikat = "A";
        } elseif ($nilaiAkhir >= 75) {
            $predikat = "B";
        } elseif ($nilaiAkhir >= 60) {
            $predikat = "C";
        } else {
            $predikat = "D";
        }
        
        echo "Nama: " . htmlspecialchars($nama) . "<br>";
        echo "Nilai akhir: " . number_format($nilaiAkhir, 2) . "<br>";
        echo "Predikat: " . $predikat;
        ?>
    </div>

    <div class="latihan">
        <h2>Latihan 3: Perulangan dan array</h2>
        <?php
        $mahasiswa = ["Alya", "Bima", "Citra", "Doni"];
        echo "<h3>Daftar Mahasiswa</h3><ol>";
        foreach ($mahasiswa as $nama_mhs) {
            echo "<li>" . htmlspecialchars($nama_mhs) . "</li>";
        }
        echo "</ol>";
        ?>
    </div>

    <div class="latihan">
        <h2>Latihan 4: Membuat function</h2>
        <?php
        function hitungDiskon($harga, $persen) {
            $potongan = $harga * ($persen / 100);
            return $harga - $potongan;
        }
        
        $hargaAkhir = hitungDiskon(150000, 10);
        echo "Harga setelah diskon: Rp" . number_format($hargaAkhir, 0, ",", ".");
        ?>
    </div>

    <div class="latihan">
        <h2>Latihan 5: Memproses form dengan GET</h2>
        <form method="GET" action="">
            <label for="kata">Kata kunci:</label>
            <input id="kata" name="kata" type="text">
            <button type="submit">Cari</button>
        </form>
        <?php
        if (isset($_GET["kata"])) {
            $kata = trim($_GET["kata"]);
            echo "Kata kunci: " . htmlspecialchars($kata, ENT_QUOTES, "UTF-8");
        }
        ?>
    </div>

    <div class="latihan">
        <h2>Latihan 6: Memproses form dengan POST</h2>
        <form method="POST" action="">
            <label for="nama_post">Nama: </label>
            <input id="nama_post" name="nama_post" type="text" required>
            <label for="prodi_post">Program Studi:</label>
            <input id="prodi_post" name="prodi_post" type="text" required>
            <button type="submit" name="kirim_latihan6">Kirim Data</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["kirim_latihan6"])) {
            $nama_post = trim($_POST["nama_post"] ?? "");
            $prodi_post = trim($_POST["prodi_post"] ?? "");
            
            if ($nama_post === "" || $prodi_post === "") {
                echo "<p>Semua kolom wajib diisi.</p>";
            } else {
                echo "<h3>Data diterima</h3>";
                echo "Nama: " . htmlspecialchars($nama_post, ENT_QUOTES, "UTF-8") . "<br>";
                echo "Program Studi: " . htmlspecialchars($prodi_post, ENT_QUOTES, "UTF-8");
            }
        }
        ?>
    </div>

    <div class="latihan">
        <h2>Latihan 7: Pengolahan data sederhana</h2>
        <?php
        $hasil = null;
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["hitung_latihan7"])) {
            $barang = trim($_POST["barang"] ?? "");
            $hargaInput = $_POST["harga"] ?? "";
            $jumlahInput = $_POST["jumlah"] ?? "";
            
            if ($barang === "" || !is_numeric($hargaInput) || !ctype_digit((string)$jumlahInput) || (float)$hargaInput < 0 || (int)$jumlahInput < 1) {
                $error_latihan7 = "Periksa kembali nama barang, harga, dan jumlah.";
            } else {
                $harga = (float)$hargaInput;
                $jumlah = (int)$jumlahInput;
                $subtotal = $harga * $jumlah;
            }
        }
        ?>
        <form method="POST">
            <label>Nama barang <input name="barang" required></label><br><br>
            <label>Harga <input name="harga" type="number" min="0" step="0.01" required></label><br><br>
            <label>Jumlah <input name="jumlah" type="number" min="1" step="1" required></label><br><br>
            <button type="submit" name="hitung_latihan7">Hitung</button>
        </form>
        <?php
        if (isset($error_latihan7)) {
            echo "<p>" . htmlspecialchars($error_latihan7) . "</p>";
        } elseif (isset($subtotal)) {
            echo "<p>Barang: " . htmlspecialchars($barang) . "</p>";
            echo "<p>Subtotal: Rp" . number_format($subtotal, 0, ",", ".") . "</p>";
        }
        ?>
    </div>

</body>
</html>
