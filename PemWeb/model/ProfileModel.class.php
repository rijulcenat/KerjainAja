<?php 
class ProfileModel extends Model {
    function getById($id) {
        $sql = "SELECT * FROM pelamar WHERE id = '$id'";
        $result = $this->db->query($sql);
        return $result->fetch_assoc(); 
    }
   
    function update($id, $foto_nama, $nama, $alamat, $email, $password, $nomor, $pendidikkan, $keahlian, $pengalaman, $deskripsi, $cv_nama){
        $sql = "UPDATE pelamar SET
        foto = '$foto_nama',
        nama_lengkap = '$nama',
        alamat = '$alamat',
        email = '$email',
        password = '$password',
        no_telpon = '$nomor',
        pendidikan_terakhir = '$pendidikkan',
        keahlian = '$keahlian',
        pengalaman = '$pengalaman',
        deskripsi_diri = '$deskripsi',
        cv = '$cv_nama'
        WHERE id = '$id'";
        return $this->db->query($sql);
    }
}