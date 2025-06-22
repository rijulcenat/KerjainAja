<main class="container mt-5 pt-4">

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <link rel="stylesheet" href="public/css/stylepost.css">
    <form action="index.php?c=Post&m=store" method="POST" class="row g-3">
        <div class="col-12">
            <label for="judulPekerjaan" class="form-label">Judul Pekerjaan</label>
            <input type="text" class="form-control" id="judulPekerjaan" name="judul_pekerjaan" required>

        </div>

        <div class="col-md-6">
            <label for="departemen" class="form-label">Departemen</label>
            <select id="departemen" name="departemen" class="form-select" required>
                <option value="">Pilih Departemen</option>
                <option>IT</option>
                <option>Marketing</option>
                <option>Human Resources</option>
                <option>Finance</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="lokasi" class="form-label">Lokasi Kerja</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi" required>
        </div>

        <div class="col-md-6">
            <label for="jenisPekerjaan" class="form-label">Jenis Pekerjaan</label>
            <select id="jenisPekerjaan" name="jenis_pekerjaan" class="form-select" required>
                <option value="">Pilih Jenis</option>
                <option>Full-time</option>
                <option>Part-time</option>
                <option>Freelance</option>
                <option>Internship</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="batasWaktu" class="form-label">Batas Waktu Lamaran</label>
            <input type="date" class="form-control" id="batasWaktu" name="batas_waktu" required>
        </div>

        <div class="col-12">
            <label for="deskripsi" class="form-label">Deskripsi Pekerjaan</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
        </div>

        <div class="col-12">
            <label for="requirements" class="form-label">Kualifikasi / Persyaratan</label>
            <textarea class="form-control" id="requirements" name="kualifikasi" rows="4" required></textarea>
        </div>

        <div class="col-12">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="statusLowongan" name="status" value="active" checked>
                <label class="form-check-label" for="statusLowongan">Lowongan Aktif</label>
            </div>
        </div>

        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Posting Lowongan</button>
        </div>
    </form>
</main>