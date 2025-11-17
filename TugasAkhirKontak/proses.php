<?php
/* File: proses.php */
include 'init.php';

function validate_input($data) {
    $errors = [];
    $nama = trim($data['nama'] ?? '');
    $telepon = trim($data['telepon'] ?? '');
    $email = trim($data['email'] ?? '');

    if (empty($nama)) {
        $errors[] = "Nama harus diisi.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $nama)) {
        $errors[] = "Nama hanya boleh mengandung huruf dan spasi.";
    }

    if (empty($telepon)) {
        $errors[] = "Nomor telepon harus diisi.";
    } elseif (!preg_match("/^[0-9]+$/", $telepon)) {
        $errors[] = "Nomor telepon hanya boleh angka.";
    }

    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }

    $sanitized_data = [
        'nama' => htmlspecialchars($nama),
        'telepon' => htmlspecialchars($telepon),
        'email' => htmlspecialchars($email)
    ];

    return ['errors' => $errors, 'data' => $sanitized_data];
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'tambah') {
    
    $validation = validate_input($_POST);
    
    if (!empty($validation['errors'])) {
        $_SESSION['errors'] = $validation['errors'];
        $_SESSION['form_data'] = $_POST;
        header('Location: tambah.php');
        exit();
    } else {
        $_SESSION['kontak'][] = $validation['data'];
        $_SESSION['message'] = "Kontak berhasil ditambahkan!";
        header('Location: index.php');
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'edit') {
    
    $id = (int)$_POST['id'];
    
    if (!isset($_SESSION['kontak'][$id])) {
        $_SESSION['message'] = "Error: Kontak tidak ditemukan.";
        header('Location: index.php');
        exit();
    }
    
    $validation = validate_input($_POST);
    
    if (!empty($validation['errors'])) {
        $_SESSION['errors'] = $validation['errors'];
        $_SESSION['form_data'] = $_POST;
        header('Location: edit.php?id=' . $id);
        exit();
    } else {
        $_SESSION['kontak'][$id] = $validation['data'];
        $_SESSION['message'] = "Kontak berhasil diperbarui!";
        header('Location: index.php');
        exit();
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    
    $id = (int)$_GET['id'];
    
    if (isset($_SESSION['kontak'][$id])) {
        unset($_SESSION['kontak'][$id]);
        $_SESSION['kontak'] = array_values($_SESSION['kontak']);
        $_SESSION['message'] = "Kontak berhasil dihapus!";
    } else {
        $_SESSION['message'] = "Error: Gagal menghapus, kontak tidak ditemukan.";
    }
    
    header('Location: index.php');
    exit();
}

header('Location: index.php');
exit();
?>