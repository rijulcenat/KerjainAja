<?php

class JobPost
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


    public static function save($data)
    {
        $conn = self::getDbConnection();
        $sql = "INSERT INTO job_posts (judul_pekerjaan, departemen, lokasi, jenis_pekerjaan, batas_waktu, deskripsi, kualifikasi, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $statusInt = ($data['status'] === 'active' || $data['status'] == 1) ? 1 : 0;
        $stmt->bind_param(
            "sssssssi",
            $data['judul_pekerjaan'],
            $data['departemen'],
            $data['lokasi'],
            $data['jenis_pekerjaan'],
            $data['batas_waktu'],
            $data['deskripsi'],
            $data['kualifikasi'],
            $statusInt
        );
        return $stmt->execute();
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
        $sql = "UPDATE job_posts SET judul_pekerjaan=?, departemen=?, lokasi=?, jenis_pekerjaan=?, batas_waktu=?, deskripsi=?, kualifikasi=?, status=? WHERE id=?";
        $stmt = $conn->prepare($sql);

        $statusInt = ($data['status'] === 'active' || $data['status'] == 1) ? 1 : 0;

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
        return $stmt->execute();
    }

    public static function updateStatus($id, $status)
    {
        $conn = self::getDbConnection();
        $sql = "UPDATE job_posts SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $statusInt = ($status === 'active' || $status == 1) ? 1 : 0;
        $stmt->bind_param("ii", $statusInt, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
