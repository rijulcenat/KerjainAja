<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/style1.css">
    <title>Halaman Utama</title>
</head>
<body>
    <div class="utama">
        <img src="view/logo.png" alt="logo" class="logo">
        <div class="tombolUtama">
            <select class="tombol" onchange="window.location.href=this.value">
                <option selected value="">BUAT AKUN BARU</option>
                <option value="">Sebagai Pelamar</option>
                <option value="">Sebagai Perusahaan</option>
            </select>
            <a href="index2.php?c=Profile&m=form" class="tombol">MASUK</a>
        </div>
    </div>
</body>
</html>