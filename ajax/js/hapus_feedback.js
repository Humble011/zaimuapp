$(document).ready(function() {
    // Menangani klik tombol hapus
    $('.btn-hapus').click(function() {
      var feedbackId = $(this).data('id');
      
      // Tampilkan konfirmasi dialog
      if (confirm('Apakah Anda yakin ingin menghapus feedback ini?')) {
        // Kirim permintaan AJAX ke hapus_feedback.php
        $.ajax({
          url: 'hapus_feedback.php',
          method: 'POST',
          data: { id: feedbackId },
          success: function(response) {
            // Feedback berhasil dihapus
            alert(response);
            // Refresh halaman
            location.reload();
          },
          error: function(xhr, status, error) {
            // Terjadi kesalahan
            alert('Terjadi kesalahan saat menghapus feedback: ' + error);
          }
        });
      }
    });
  });