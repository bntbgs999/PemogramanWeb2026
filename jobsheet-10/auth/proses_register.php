<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

$nama = trim($_POST['nama'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$role = 'petugas';  // petugas vs admin
// Validasi server-side — wajib ada meski sudah divalidasi JS di Jobsheet 5,
// karena validasi client bisa dilewati (nonaktifkan JS / kirim request manual).
$errors = [];
if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}
if ($username === '') {
    $errors[] = "Username wajib diisi.";
}
if ($password === '') {
    $errors[] = "Password wajib diisi.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: register.php');
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO users (nama, username, password, role)
     VALUES (:nama, :username, :password, :role)
     RETURNING id"
);
$stmt->execute([
    'nama' => $nama,
    'username' => $username,
    'password' => password_hash($password, PASSWORD_DEFAULT),
    'role' => $role,
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'User berhasil ditambahkan.'];
header('Location: ../index.php');
exit;
