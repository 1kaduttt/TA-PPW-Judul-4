<?php
/* File: tambah.php */
include 'init.php';

$errors = $_SESSION['errors'] ?? [];
$form_data = $_SESSION['form_data'] ?? [];

unset($_SESSION['errors']);
unset($_SESSION['form_data']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kontak</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Kontak Baru</h2>

        <?php if (!empty($errors)): ?>
            <div class="error-list">
                <strong>Terjadi Kesalahan:</strong>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="proses.php">
            <input type="hidden" name="action" value="tambah">
            
            <div class="form-group">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($form_data['nama'] ?? ''); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="telepon">Nomor Telepon:</label>
                <input type="text" id="telepon" name="telepon" value="<?php echo htmlspecialchars($form_data['telepon'] ?? ''); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email (Opsional):</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($form_data['email'] ?? ''); ?>">
            </div>
            
            <input type="submit" class="btn btn-primary" value="Tambah Kontak">
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>