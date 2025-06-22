<?php

class Lowongan
{

    private static function getDbConnection()
    {
        static $conn = null;

        if ($conn === null) {
            $conn = new mysqli('localhost', 'root', '', 'job_portal');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        }
        return $conn;
    }

    public static function getAll()
    {
        $conn = self::getDbConnection();
        $result = $conn->query("SELECT * FROM job_posts ORDER BY created_at DESC");
        $data = [];
        if ($result) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
        }
        return $data;
    }

    public static function getById($id)
    {
        $conn = self::getDbConnection();
        $stmt = $conn->prepare("SELECT * FROM job_posts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result ? $result->fetch_assoc() : null;
        $stmt->close();
        return $row;
    }

    public static function update($id, $data)
    {
        $conn = self::getDbConnection();
        $stmt = $conn->prepare("UPDATE job_posts SET judul_pekerjaan=?, departemen=?, lokasi=?, jenis_pekerjaan=?, batas_waktu=?, deskripsi=?, kualifikasi=?, status=? WHERE id=?");

        $statusInt = (int)$data['status'];

        $stmt->bind_param(
            "sssssssii",
            $data['judul_pekerjaan'],
            $data['departemen'],
            $data['lokasi'],
            $data['jenis_pekerjaan'],
            $data['batas_waktu'],
            $data['deskripsi'],
            $data['kualifikasi'],
            $statusInt,
            $id
        );
        $stmt->execute();
        $stmt->close();
    }

    public static function updateStatus($id, $status)
    {
        $conn = self::getDbConnection();
        $statusInt = (int)$status;
        $stmt = $conn->prepare("UPDATE job_posts SET status=? WHERE id=?");
        $stmt->bind_param("ii", $statusInt, $id);
        $stmt->execute();
        $success = $stmt->affected_rows > 0;
        $stmt->close();
        return $success;
    }
}
