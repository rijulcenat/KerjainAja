<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Lowongan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <main class="mx-auto my-4" style="max-width: 600px;">
        <div class="container mt-4">
            <h2 class="mb-4">Edit Lowongan</h2>

            <form method="post" action="index.php?c=Post&m=edit&id=<?= htmlspecialchars($lowongan['id']) ?>">
                <div class="mb-3">
                    <label>Judul Pekerjaan</label>
                    <input type="text" name="judul_pekerjaan" class="form-control" value="<?= htmlspecialchars($lowongan['judul_pekerjaan']) ?>" required>
                </div>
                <div class="mb-3">
                    <label>Departemen</label>
                    <input type="text" name="departemen" class="form-control" value="<?= htmlspecialchars($lowongan['departemen']) ?>">
                </div>
                <div class="mb-3">
                    <label>Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" value="<?= htmlspecialchars($lowongan['lokasi']) ?>">
                </div>
                <div class="mb-3">
                    <label>Jenis Pekerjaan</label>
                    <input type="text" name="jenis_pekerjaan" class="form-control" value="<?= htmlspecialchars($lowongan['jenis_pekerjaan']) ?>">
                </div>
                <div class="mb-3">
                    <label>Batas Waktu</label>
                    <input type="date" name="batas_waktu" class="form-control" value="<?= htmlspecialchars($lowongan['batas_waktu']) ?>">
                </div>
                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4"><?= htmlspecialchars($lowongan['deskripsi']) ?></textarea>
                </div>
                <div class="mb-3">
                    <label>Kualifikasi</label>
                    <textarea name="kualifikasi" class="form-control" rows="4"><?= htmlspecialchars($lowongan['kualifikasi']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active" <?= ($lowongan['status'] == 1 || $lowongan['status'] == 'active') ? 'selected' : '' ?>>Open</option>
                        <option value="inactive" <?= ($lowongan['status'] == 0 || $lowongan['status'] == 'inactive') ? 'selected' : '' ?>>Closed</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="index.php?c=Lowongan&m=watch" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </main>
</body>

</html>