<?php
include 'koneksi.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    
    $query = "SELECT foto FROM mahasiswa WHERE id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    
   
    if($data['foto'] && file_exists('uploads/' . $data['foto'])) {
        unlink('uploads/' . $data['foto']);
    }
    
   
    $query = "DELETE FROM mahasiswa WHERE id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()) {
        header('Location: index.php');
        exit;
    } else {
        echo "Error: " . $koneksi->error;
    }
}
?>