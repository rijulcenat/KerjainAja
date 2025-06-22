<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="view/style2.css">
    <title>Update Profile</title>
</head>
<body>
    <div class="container">
        <h2 class="judul1"> PROFILE </h2>
        <img src="dokumen/<?= $user['foto'] ?>" alt="profil" class="foto">
        <form class="row g-3" action="?c=Profile&m=update" method="POST" enctype="multipart/form-data" style="margin-top: 5px;">
            <input type="hidden" name="id" value="<?= $user['id'] ?? '' ?>">
            <div class="kotak">
                <div class="col-12">
                    <label for="inputFoto" class="form-label">Edit Foto Diri (format jpeg)</label>
                    <input type="file" class="form-control" id="inputFoto" name="foto">
                </div>
            </div>
            <div class="kotak">
                <h4 class="subab">Edit Data Diri dan Pengalaman</h4>
                <div class="col-12">
                    <label for="inputNama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="inputNama" name="nama" value="<?= $user['nama_lengkap'] ?? '' ?>">
                </div>
                <div class="col-12">
                    <label for="inputAlamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="inputAlamat" name="alamat" value="<?= $user['alamat'] ?? '' ?>">
                </div>
                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" name="email" value="<?= $user['email'] ?? '' ?>">
                </div>
                <div class="col-12">
                    <label for="inputPassword4" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" name="password" value="<?= $user['password'] ?? '' ?>">
                </div>
                <div class="col-12">
                    <label for="inputTelepon" class="form-label">No Telepon</label>
                    <input type="tel" class="form-control" id="inputTelepon" name="nomor" value="<?= $user['no_telpon'] ?? '' ?>">
                </div>
                <div class="col-12">
                    <label for="inputPendidikkan" class="form-label">Pendidikkan Terakhir</label>
                    <input type="text" class="form-control" id="inputPendidikkan" name="pendidikkan" value="<?= $user['pendidikan_terakhir'] ?? '' ?>">
                </div>
                <div class="col-12">
                    <label for="inputKeahlian" class="form-label">Keahlian</label>
                    <input type="text" class="form-control" id="inputKeahlian" name="keahlian" value="<?= $user['keahlian'] ?? '' ?>">
                </div>
                <div class="col-12">
                    <label for="inputPengalaman" class="form-label">Pengalaman</label>
                    <input type="text" class="form-control" id="inputPengalaman" name="pengalaman" value="<?= $user['pengalaman'] ?? '' ?>">
                </div>
                <div class="col-12">
                    <label for="inputDeskripsi" class="form-label">Deskripsi Diri</label>
                    <textarea class="form-control" id="inputDeskripsi" rows="5" name="deskripsi"><?= $user['deskripsi_diri'] ?? '' ?></textarea>
                </div>
            </div>
            <div class="kotak">
                <img src="dokumen/<?= $user['cv'] ?>" alt="cv" class="cv">
                <div class="col-12">
                    <label for="inputCV" class="form-label">Edit CV (format jpg)</label>
                    <input type="file" class="form-control" id="inputCV" name="cv">
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">UPDATE</button>
            </div>
        </form>
    </div>
    <footer>
        <nav class="navbar fixed-bottom bg-white border-top">
            <div class="container d-flex justify-content-around">
                <a href="/PemWeb/index3.php" class="icon"><i class="fa-solid fa-house"></i></a>
                <button class="icon"><i class="fas fa-comment"></i></button>
                <a href="/PemWeb/index.php?c=Lowongan&m=watch" class="icon">
                    <i class="fa-solid fa-user"></i>
                </a>
            </div>
        </nav>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js" integrity="sha384-VQqxDN0EQCkWoxt/0vsQvZswzTHUVOImccYmSyhJTp7kGtPed0Qcx8rK9h9YEgx+" crossorigin="anonymous"></script>
</body>
</html>