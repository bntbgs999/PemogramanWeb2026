<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

// Sengaja hanya menerima POST (bukan GET) agar penghapusan tidak bisa
// dipicu tanpa sengaja lewat link/preview crawler.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM buku WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Buku berhasil dihapus.'];
}

header('Location: list.php');
exit;
