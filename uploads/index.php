<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📚 Data Mahasiswa</h1>
            <p>Kelola data mahasiswa dengan lengkap dan mudah</p>
        </div>
        
        <div class="table-container">
            <div style="margin-bottom: 20px;">
                <a href="form.php" class="btn btn-primary">➕ Tambah Mahasiswa Baru</a>
            </div>
            
            <?php
            $query = "SELECT * FROM mahasiswa ORDER BY created_at DESC";
            $result = $koneksi->query($query);
            ?>
            
            <?php if($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>NIM</th>
                        <th>Nama Lengkap</th>
                        <th>Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php if($row['foto']): ?>
                                <img src="uploads/<?php echo htmlspecialchars($row['foto']); ?>" 
                                     alt="Foto <?php echo htmlspecialchars($row['nama_lengkap']); ?>" 
                                     class="avatar">
                            <?php else: ?>
                                <div style="width:60px;height:60px;background:#e5e7eb;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#6b7280;">No Photo</div>
                            <?php endif; ?>
                        </td>
                        <td><strong><?php echo htmlspecialchars($row['nim']); ?></strong></td>
                        <td><?php echo htmlspecialchars($row['nama_lengkap']); ?></td>
                        <td><?php echo htmlspecialchars($row['jurusan']); ?></td>
                        <td class="btn-group">
                            <a href="form.php?id=<?php echo $row['id']; ?>" class="btn btn-warning action-btn">✏️ Edit</a>
                            <a href="hapus.php?id=<?php echo $row['id']; ?>" 
                               class="btn btn-danger action-btn" 
                               onclick="return confirm('Yakin ingin menghapus data mahasiswa <?php echo htmlspecialchars($row['nama_lengkap']); ?>?')">🗑️ Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div class="no-data">
                <p>📭 Belum ada data mahasiswa</p>
                <a href="form.php" class="btn btn-primary">Tambah Mahasiswa Pertama</a>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="footer">
            <p>© 2026 Aplikasi CRUD Mahasiswa</p>
        </div>
    </div>

    <script>
     
    </script>
</body>
</html>