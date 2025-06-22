<?php
// Cukup panggil model yang kita butuhkan di atas
require_once 'model/JobPost.php';

class PostController
{

    public function create()
    {
        require 'view/templates/header.php';
        require 'view/post/create.php';
        require 'view/templates/footer.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'judul_pekerjaan' => $_POST['judul_pekerjaan'] ?? '',
                'departemen'      => $_POST['departemen'] ?? '',
                'lokasi'          => $_POST['lokasi'] ?? '',
                'jenis_pekerjaan' => $_POST['jenis_pekerjaan'] ?? '',
                'batas_waktu'     => $_POST['batas_waktu'] ?? '',
                'deskripsi'       => $_POST['deskripsi'] ?? '',
                'kualifikasi'     => $_POST['kualifikasi'] ?? '',
                'status'          => $_POST['status'] ?? 'inactive'
            ];

            JobPost::save($data);

            header("Location: index.php?c=Lowongan&m=watch");
            exit;
        }
    }

    public function edit()
    {
        if (!isset($_GET['id'])) {
            header('Location: index.php?c=Lowongan&m=watch');
            exit;
        }
        $id = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'judul_pekerjaan' => $_POST['judul_pekerjaan'],
                'departemen'      => $_POST['departemen'],
                'lokasi'          => $_POST['lokasi'],
                'jenis_pekerjaan' => $_POST['jenis_pekerjaan'],
                'batas_waktu'     => $_POST['batas_waktu'],
                'deskripsi'       => $_POST['deskripsi'],
                'kualifikasi'     => $_POST['kualifikasi'],
                'status'          => $_POST['status'],
            ];

            JobPost::update($id, $data);

            header('Location: index.php?c=Lowongan&m=watch');
            exit;
        }

        $lowongan = JobPost::getById($id);

        if (!$lowongan) {
            die("Lowongan tidak ditemukan.");
        }

        require 'view/lowongan/edit.php';
    }

    public function updateStatus() {}
}
