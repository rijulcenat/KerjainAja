<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KerjainAja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/style1.css"> </head>
<body>
    <div class="container-fluid py-3">
        <header class="d-flex align-items-center mb-3">
            <h1 class="h4 mb-0">KerjainAja</h1>
        </header>
        <div class="input-group mb-3">
            <span class="input-group-text bg-white border-end-0"><i class="fas fa-search"></i></span>
            <input type="text" class="form-control border-start-0" placeholder="Cari Lowongan Pekerjaan">
            <span class="input-group-text bg-white border-start-0"><i class="fas fa-times"></i></span>
        </div>
        <div class="row g-3">
            <?php foreach ($jobs as $job): ?>
                <div class="col-6">
                    <div class="card job-item">
                        <a href="index.php?page=detail&id=<?php echo $job['id']; ?>">
                            <img src="<?php echo $job['image']; ?>" class="card-img-top" alt="Foto Perusahaan"> </a>
                        <div class="card-body">
                            <p class="card-text text-muted"><?php echo $job['description']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <nav>
        <div class="tombolMenu" style="background-color: white;">
            <button><i class="fa-solid fa-house"></i></button>
            <button><i class="fas fa-comment"></i></button>
            <a href="/PemWeb/index.php?c=Lowongan&m=watch" class="btn">
                <i class="fa-solid fa-user"></i>
            </a>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>