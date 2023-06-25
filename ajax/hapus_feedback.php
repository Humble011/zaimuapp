<?php
require '../function/functions.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
  $feedbackId = $_POST['id'];

  $query = "DELETE FROM feedback WHERE id = ?";
  $stmt = $koneksi->prepare($query);
  $stmt->bind_param('i', $feedbackId);
  if ($stmt->execute()) {
    // Penghapusan berhasil
    $response = "Feedback berhasil dihapus.";
    echo $response;
    exit;
  } else {
    // Penghapusan gagal
    $response = "Terjadi kesalahan saat menghapus feedback.";
    echo $response;
    exit;
  }
} else {
  // Jika permintaan bukan metode POST atau ID feedback tidak tersedia, berikan respons error
  http_response_code(400);
  echo "Permintaan tidak valid.";
  exit;
}
