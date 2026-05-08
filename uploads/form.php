<?php 
include 'koneksi.php'; 
$edit = false;
$data = [];

if(isset($_GET['id'])) {
    $edit = true;
    $id = $_GET['id'];
    $query = "SELECT * FROM mahasiswa WHERE id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $edit ? 'Edit' : 'Tambah'; ?>Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><?php echo $edit ? '✏️ Edit' : '➕ Tambah'; ?> Mahasiswa</h1>
        </div>
        
        <div class="form-container">
            <?php if(isset($_GET['success'])): ?>
            <div class="alert alert-success">
                ✅ Data mahasiswa berhasil disimpan!
            </div>
            <?php endif; ?>
            
            <form action="proses.php" method="POST" enctype="multipart/form-data" id="mahasiswaForm" onsubmit="return validateForm()">
                <?php if($edit): ?>
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="nim">NIM *</label>
                    <input type="text" id="nim" name="nim" value="<?php echo $edit ? htmlspecialchars($data['nim']) : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap *</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo $edit ? htmlspecialchars($data['nama_lengkap']) : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="jurusan">Jurusan *</label>
                    <select id="jurusan" name="jurusan" required>
                        <option value="">Pilih Jurusan</option>
                        <option value="Teknik Informatika" <?php echo ($edit && $data['jurusan']=='Teknik Informatika') ? 'selected' : ''; ?>>Teknik Informatika</option>
                        <option value="Sistem Informasi" <?php echo ($edit && $data['jurusan']=='Sistem Informasi') ? 'selected' : ''; ?>>Sistem Informasi</option>
                        <option value="Teknik Elektro" <?php echo ($edit && $data['jurusan']=='Teknik Elektro') ? 'selected' : ''; ?>>Teknik Elektro</option>
                        <option value="Manajemen" <?php echo ($edit && $data['jurusan']=='Manajemen') ? 'selected' : ''; ?>>Manajemen</option>
                        <option value="Akuntansi" <?php echo ($edit && $data['jurusan']=='Akuntansi') ? 'selected' : ''; ?>>Akuntansi</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="foto">Foto Profil</label>
                    <input type="file" id="foto" name="foto" accept="image/jpeg,image/jpg,image/png">
                    <?php if($edit && $data['foto']): ?>
                    <div style="margin-top: 10px;">
                        <img src="uploads/<?php echo htmlspecialchars($data['foto']); ?>" 
                             alt="Foto saat ini" style="width:100px;height:100px;object-fit:cover;border-radius:10px;">
                        <p style="font-size:0.9em;color:#6b7280;margin-top:5px;">Foto saat ini akan diganti jika Anda upload foto baru</p>
                    </div>
                    <?php endif; ?>
                    <small style="color:#6b7280;">Max 2MB (JPG, PNG)</small>
                </div>
                
                <div style="display:flex; gap:15px;">
                    <input type="submit" value="<?php echo $edit ? '💾 Update Data' : '💾 Simpan Data'; ?>" class="btn btn-success">
                    <a href="index.php" class="btn btn-primary">← Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>