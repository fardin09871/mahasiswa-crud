<?php
include 'koneksi.php';

if($_POST) {
    $nim = trim($_POST['nim']);
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $jurusan = trim($_POST['jurusan']);
    $foto_nama = '';


    if(!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }

    if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $file = $_FILES['foto'];
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];
        $max_size = 2 * 1024 * 1024; // 2MB
        
        if(in_array($file['type'], $allowed_types) && $file['size'] <= $max_size) {
            $foto_nama = uniqid() . '_' . time() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
            move_uploaded_file($file['tmp_name'], 'uploads/' . $foto_nama);
        }
    }

    if(isset($_POST['id']) && !empty($_POST['id'])) {
     
        $id = $_POST['id'];
        
        if($foto_nama) {
           
            $query = "SELECT foto FROM mahasiswa WHERE id = ?";
            $stmt = $koneksi->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $old_data = $result->fetch_assoc();
            
            if($old_data['foto'] && file_exists('uploads/' . $old_data['foto'])) {
                unlink('uploads/' . $old_data['foto']);
            }
            
            $query = "UPDATE mahasiswa SET nim=?, nama_lengkap=?, jurusan=?, foto=? WHERE id=?";
            $stmt = $koneksi->prepare($query);
            $stmt->bind_param("sssii", $nim, $nama_lengkap, $jurusan, $foto_nama, $id);
        } else {
            $query = "UPDATE mahasiswa SET nim=?, nama_lengkap=?, jurusan=? WHERE id=?";
            $stmt = $koneksi->prepare($query);
            $stmt->bind_param("sssi", $nim, $nama_lengkap, $jurusan, $id);
        }
    } else {
    
        $query = "INSERT INTO mahasiswa (nim, nama_lengkap, jurusan, foto) VALUES (?, ?, ?, ?)";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("ssss", $nim, $nama_lengkap, $jurusan, $foto_nama);
    }

    if($stmt->execute()) {
        header('Location: form.php?success=1');
        exit;
    } else {
        echo "Error: " . $koneksi->error;
    }
}
?>