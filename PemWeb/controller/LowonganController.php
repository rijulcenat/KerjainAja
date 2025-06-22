<?php
require_once 'model/Lowongan.php';

class LowonganController
{
    public function watch()
    {
        $lowongan = Lowongan::getAll();
        require 'view/templates/header.php';
        require 'view/lowongan/watch.php';
        require 'view/templates/footer.php';
    }

    public function updateStatus()
    {
        header('Content-Type: application/json');

        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['id']) || !isset($input['status'])) {
            echo json_encode(['success' => false, 'message' => 'Input tidak valid.']);
            return;
        }

        $id = $input['id'];
        $status = (int)$input['status'];

        $success = Lowongan::updateStatus($id, $status);

        if ($success) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => true, 'message' => 'Status tidak berubah atau sudah sesuai.']);
        }
    }
}
