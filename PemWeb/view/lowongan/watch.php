<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Lowongan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
     <!-- Tambahkan baris ini -->
    
</head>

<body class="bg-light">
    <header>
        <nav class="navbar fixed-top bg-white border-top">
            <div class="container d-flex justify-content-around">
                <div class="d-flex justify-content-center">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="Profile-tab" data-bs-toggle="tab" data-bs-target="#Profile-tab-pane" type="button" role="tab" aria-controls="Profile-tab-pane" aria-selected="true">Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="Lowongan-tab" data-bs-toggle="tab" data-bs-target="#Lowongan-tab-pane" type="button" role="tab" aria-controls="Lowongan-tab-pane" aria-selected="false">Lowongan</button>
                        </li>
                    </ul>
                </div>

                <div class="container text-center mt-3 mb-2">
                    <a href="index.php?c=Post&m=create" class="btn btn-primary rounded-circle">+</a>
                </div>
            </div>
        </nav>
    </header>

    <main class="mx-auto my-5 pt-5" style="padding-top: 100px;">
        <div class="container mt-4">
            <h2>Daftar Lowongan</h2>
            <div class="row">
                <?php foreach ($lowongan as $lowongan_item): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($lowongan_item['judul_pekerjaan']); ?></h5>
                                <p class="card-text"><?= htmlspecialchars(substr($lowongan_item['deskripsi'], 0, 100)); ?>...</p>
                                <a href="index.php?c=Post&m=edit&id=<?= $lowongan_item['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="index.php?c=Post&m=view&id=<?= $lowongan_item['id']; ?>" class="btn btn-info btn-sm">Pelamar</a>

                                <div class="form-check form-switch ms-auto">
                                    <input class="form-check-input" type="checkbox" id="switch<?= $lowongan_item['id']; ?>"
                                        <?php
                                        ?>
                                        <?= ($lowongan_item['status'] == 1) ? 'checked' : ''; ?>
                                        onchange="updateStatus(<?= $lowongan_item['id']; ?>, this.checked)">
                                    <label class="form-check-label" id="label<?= $lowongan_item['id']; ?>" for="switch<?= $lowongan_item['id']; ?>">
                                        <?php
                                        ?>
                                        <?= ($lowongan_item['status'] == 1) ? 'Open' : 'Closed'; ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <script>
        function updateStatus(id, isChecked) {
            const status = isChecked ? 1 : 0;

            fetch('index.php?c=Lowongan&m=updateStatus', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: id,
                        status: status
                    })
                })
                .then(response => response.json())
                .then (data => {
                    if (data.success) {
                        document.getElementById('label' + id).innerText = isChecked ? 'Open' : 'Closed';
                    } else {
                        document.getElementById('switch' + id).checked = !isChecked;
                        alert('Gagal mengubah status: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch((err) => {
                    document.getElementById('switch' + id).checked = !isChecked;
                    alert('Terjadi kesalahan jaringan.');
                });
        }
    </script>
</body>

</html>