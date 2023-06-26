<?php 
session_start();
require 'function/functions.php';

if(isset($_COOKIE['login'])) {
    if ($_COOKIE['level'] == 'admin') {
        $_SESSION['login'] = true;
        $ambilNama = $_COOKIE['login'];
    } 
    
    elseif ($_COOKIE['level'] == 'user') {
        $_SESSION['login'] = true;
        header('Location: index');
    } 
} 

elseif ($_SESSION['level'] == 'admin') {
    $ambilNama = $_SESSION['user'];
} 

else {
    if ($_SESSION['level'] == 'user') {
        header('Location: index');
        exit;
    }
}

if(empty($_SESSION['login'])) {
    header('Location: login');
    exit;
} 


if(empty($_SESSION['login'])) {
    header('Location: login');
    exit;
} 


// $username = $_GET['username'];
// $idUser = $_GET['idUser'];
// //konfigurasi pagenation
// $jumlahTabel = 5;
// $jumlahData = count(query("SELECT * FROM contact_us WHERE username "));
// $jumlahHalaman = ceil($jumlahData / $jumlahTabel);
// $halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
// $awalData = ($jumlahTabel * $halamanAktif) - $jumlahTabel;

$dataFeedback = query("SELECT * FROM contact_us");
///konfigurasi pagenation

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/zaimu.png">
    <title>Zaimu App - Feedback</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <link rel="stylesheet" href="css/styler.css?v=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <style>
    </style>
</head>

<body>
    <div class="header">
        <img src="img/zaimu.jpg" width="25px" height="25px" class="float-left logo-fav">
        <h3 class="text-secondary font-weight-bold float-left logo">Zaimu</h3>
        <h3 class="text-secondary float-left logo2">App</h3>
        <a href="logout">
            <div class="logout">
                <i class="fas fa-sign-out-alt float-right log"></i>
                <p class="float-right logout">Logout</p>
            </div>
        </a>
    </div>

    <div class="sidebar">
        <nav>
            <ul>
                <li>
                    <img src="img/avatar.jpg" class="img-fluid profile float-left" width="60px">
                    <h5 class="admin"><?= substr($ambilNama, 0, 7) ?></h5>
                    <div class="online online2">
                        <p class="float-right ontext">Online</p>
                        <div class="on float-right"></div>
                    </div>
                </li>

                <!-- fungsi slide -->
                <script>
                    $(document).ready(function () {
                        $("#flip").click(function () {
                            $("#panel").slideToggle("medium");
                            $("#panel2").slideToggle("medium");
                        });
                        $("#flip2").click(function () {
                            $("#panel3").slideToggle("medium");
                            $("#panel4").slideToggle("medium");
                        });
                    });
                </script>

                <!-- dashboard -->
                <a href="dashboard_admin" style="text-decoration: none;">
                    <li class="aktif" style="border-left: 5px solid #306bff;">
                        <div>
                            <span class="fas fa-tachometer-alt"></span>
                            <span>Dashboard</span>
                        </div>
                    </li>
                </a>

                <!-- data -->
                <li class="klik" id="flip" style="cursor:pointer;">
                    <div>
                        <span class="fas fa-database"></span>
                        <span>Kelola User</span>
                        <i class="fas fa-caret-right float-right" style="line-height: 20px;"></i>
                    </div>
                </li>

                <a href="kelolaUser" class="linkAktif">
                    <li id="panel" style="display: none;">
                        <div style="margin-left: 20px;">
                            <span><i class="fas fa-file-invoice-dollar"></i></span>
                            <span>Data User</span>
                        </div>
                    </li>
                </a>
    
                <!-- data -->

                <!-- Input -->
                <li class="klik2" id="flip2" style="cursor:pointer;">
                    <div>
                        <span class="fas fa-plus-circle"></span>
                        <span>Feedback</span>
                        <i class="fas fa-caret-right float-right" style="line-height: 20px;"></i>
                    </div>
                </li>

                <a href="feedback" class="linkAktif">
                    <li id="panel3" style="display: none;">
                        <div style="margin-left: 20px;">
                            <span><i class="fas fa-file-invoice-dollar"></i></span>
                            <span>Data Feedback</span>
                        </div>
                    </li>
                </a>
                <!-- Input -->

           
                <script>
                    $(".klik").click(function () {
                        $(this).find('i').toggleClass('fa-caret-up fa-caret-right');
                        if ($(".klik").not(this).find("i").hasClass("fa-caret-right")) {
                            $(".klik").not(this).find("i").toggleClass('fa-caret-up fa-caret-right');
                        }
                    });
                    $(".klik2").click(function () {
                        $(this).find('i').toggleClass('fa-caret-up fa-caret-right');
                        if ($(".klik2").not(this).find("i").hasClass("fa-caret-right")) {
                            $(".klik2").not(this).find("i").toggleClass('fa-caret-up fa-caret-right');
                        }
                    });
                </script>
                <!-- change icon -->
            </ul>
        </nav>
    </div>

    <div class="main-content khusus">
        <div class="konten khusus2">
            <div class="konten_dalem khusus3">
                <h2 class="head" style="color: #4b4f58;">Feedback</h2>
                <hr style="margin-top: -2px;">
                <!-- bagian isi tabel -->
                <div class="headline">
                    <h5>Data Feedback</h5>
                </div>
                <div class="container" id="container">
                    <div class="row tampil" id="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover table-striped table-bordered">
                                    <tr>
                                        <th>No.</th>
                                        <th>Fullname</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php $i = 1; ?>
                                    <?php foreach($dataFeedback as $row) : ?>
                                            <tr id="<?= $row['id'] ?>" style="cursor: pointer">
                                                <td> <?= $i++ ?> </td>
                                                <td data-target="username" class="data" data-id="<?= $row['id'] ?>"><?= $row['fullname'] ?></td>
                                                <td data-target="email" class="data" data-id="<?= $row['id'] ?>"><?= $row['email'] ?></td>
                                                <td data-target="subject"><?= $row['subject'] ?></td>
                                                <td class="data" data-id="<?= $row['id'] ?>"><?= $row['message'] ?></td>
                                                <td data-target="user">
                                                <button class="btn btn-sm btn-danger btn-hapus" data-id="<?= $row['id'] ?>" onclick="showDeleteModal(<?= $row['id'] ?>)">Hapus</button>
                                                </td> 
                                            </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Button trigger modal -->
                    <!-- Tambahkan modal untuk konfirmasi penghapusan -->
                    <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus Feedback</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus feedback ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-danger" onclick="deleteFeedback()">Hapus</button>
                        </div>
                        </div>
                    </div>
                    </div>

<script>
  // Fungsi untuk menampilkan modal konfirmasi penghapusan
  function showDeleteModal(feedbackId) {
    // Mendapatkan modal
    var modal = document.getElementById('hapusModal');

    // Menambahkan atribut data-id pada tombol hapus di modal
    var hapusFeedbackBtn = modal.querySelector('.btn-danger');
    hapusFeedbackBtn.setAttribute('data-id', feedbackId);

    // Menampilkan modal
    $('#hapusModal').modal('show');
  }

  // Fungsi untuk menghapus feedback
  function deleteFeedback() {
    // Mendapatkan ID feedback dari tombol hapus di modal
    var feedbackId = document.querySelector('#hapusModal .btn-danger').getAttribute('data-id');

    // Kirim permintaan AJAX ke server untuk menghapus feedback
    $.ajax({
      url: 'ajax/hapus_feedback.php',
      type: 'POST',
      data: { id: feedbackId },
      success: function(response) {
        // Tindakan penghapusan berhasil
        // Misalnya, tampilkan pesan bahwa feedback telah dihapus
        alert(response);

        // Refresh halaman setelah penghapusan berhasil
        location.reload();
      },
      error: function(xhr, status, error) {
        // Tindakan penghapusan gagal
        // Misalnya, tampilkan pesan error
        alert("Terjadi kesalahan saat menghapus feedback: " + error);
      }
    });

    // Sembunyikan modal setelah mengirim permintaan penghapusan
    $('#hapusModal').modal('hide');
  }
</script>


    
   

    <script src="js/bootstrap.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
   
</body>

</html>