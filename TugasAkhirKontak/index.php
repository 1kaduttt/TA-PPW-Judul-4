<?php
/* File: index.php */
include 'init.php';

$message = '';
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kontak</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Sistem Manajemen Kontak</h1>
        
        <?php if ($message): ?>
            <div class="success-msg">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <a href="tambah.php" class="btn btn-primary" style="margin-bottom: 20px;">+ Tambah Kontak Baru</a>

        <h2>Daftar Kontak</h2>
        <?php if (empty($_SESSION['kontak'])): ?>
            <p>Belum ada kontak yang tersimpan.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['kontak'] as $id => $kontak): ?>
                        <tr>
                            <td><?php echo $id + 1; ?></td>
                            <td><?php echo htmlspecialchars($kontak['nama']); ?></td>
                            <td><?php echo htmlspecialchars($kontak['telepon']); ?></td>
                            <td><?php echo htmlspecialchars($kontak['email'] ?: '-'); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $id; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="proses.php?action=delete&id=<?php echo $id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kontak ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>