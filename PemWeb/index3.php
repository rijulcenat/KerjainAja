<?php
require_once __DIR__ . '/controller/JobController.php'; 

$page = $_GET['page'] ?? 'home';
$id = $_GET['id'] ?? null;

$controller = new JobController();

switch ($page) {
    case 'home':
        $controller->index();
        break;
    case 'detail':
        if ($id) {
            $controller->detail($id);
        } else {
            echo "ID lowongan tidak ditemukan.";
        }
        break;
    default:
        echo "Halaman tidak ditemukan.";
        break;
}