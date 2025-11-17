<?php
/* File: init.php */

session_start();

if (!isset($_SESSION['kontak'])) {
    $_SESSION['kontak'] = [];
}

if (!isset($_SESSION['errors'])) {
    $_SESSION['errors'] = [];
}

if (!isset($_SESSION['form_data'])) {
    $_SESSION['form_data'] = [];
}
?>