<?php 
class Profile extends Controller {
    function form() { 
        $model = $this->model('ProfileModel'); 
        $user = $model->getById(1); 
        $this->view('HalamanProfile.php', ['user' => $user]); 
        //var_dump($user);
    }

    function update() {
        $id = $_POST['id']?? null;
        $foto = $_FILES['foto'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $nomor = $_POST['nomor'];
        $pendidikkan = $_POST['pendidikkan'];
        $keahlian = $_POST['keahlian'];
        $pengalaman = $_POST['pengalaman'];
        $deskripsi = $_POST['deskripsi'];
        $cv = $_FILES['cv'];

        $foto_nama = $_FILES['foto']['name'];
        $tmp_foto = $_FILES['foto']['tmp_name'];
        if ($foto_nama) {
            move_uploaded_file($tmp_foto, 'dokumen/' . $foto_nama);
        } else {
            $lama = $this->model('ProfileModel')->getById($id);
            $foto_nama = $lama['foto'];
        }

        $cv_nama = $_FILES['cv']['name'];
        $tmp_cv = $_FILES['cv']['tmp_name'];
        if ($cv_nama) {
        move_uploaded_file($tmp_cv, 'dokumen/' . $cv_nama);
        } else {
        $lama = $this->model('ProfileModel')->getById($id);
        $cv_nama = $lama['cv'];  
        }

        $model = $this->model('ProfileModel'); 
        /*var_dump*/ ($model->update($id, $foto_nama, $nama, $alamat, $email, $password, $nomor, $pendidikkan, $keahlian,$pengalaman, $deskripsi, $cv_nama)); 
        $user = $model->getById(1);
        $this->view('HalamanProfile.php', ['user' => $user]);
        exit;
    }
}