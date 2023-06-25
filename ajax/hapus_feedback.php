<?php
// Import file functions.php yang berisi koneksi database dan fungsi-fungsi lainnya
require_once '../function/functions.php';

// Cek apakah ada data ID yang dikirim melalui metode POST
if (isset($_POST['id'])) {
    $feedbackId = $_POST['id'];

    // Fungsi untuk menghapus feedback berdasarkan ID
    function hapusFeedback($feedbackId) {
        global $koneksi;
        $query = "DELETE FROM contact_us WHERE id = '$feedbackId'";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    // Panggil fungsi hapusFeedback() dan cek hasilnya
    $jumlahHapus = hapusFeedback($feedbackId);

    if ($jumlahHapus > 0) {
        echo "Feedback telah dihapus";
    } else {
        echo "Gagal menghapus feedback";
    }
} else {
    echo "ID feedback tidak ditemukan";
}
?>
