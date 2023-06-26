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
//konfigurasi pagenation
$jumlahTabel = 5;
$jumlahData = count(query("SELECT * FROM users WHERE username NOT LIKE 'admin'"));
$jumlahHalaman = ceil($jumlahData / $jumlahTabel);
$halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
$awalData = ($jumlahTabel * $halamanAktif) - $jumlahTabel;

$dataUser = query("SELECT * FROM users WHERE username NOT LIKE 'admin' LIMIT $awalData, $jumlahTabel");
///konfigurasi pagenation
$jumlahUser = mysqli_query($koneksi, "SELECT * FROM users WHERE username NOT LIKE 'admin'");
$jumlahUserAktif = mysqli_query($koneksi, "SELECT * FROM users WHERE status = 'aktif' AND username NOT LIKE 'admin'");
$jumlahUserTidakAktif = mysqli_query($koneksi, "SELECT * FROM users WHERE status = 'tidak aktif' AND username NOT LIKE 'admin'");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/zaimu.png">
    <title>Zaimu App - Pemasukkan</title>
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
        <img src="img/zaimu.png" width="25px" height="25px" class="float-left logo-fav">
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
                    <img src="img/avatar.svg" class="img-fluid profile float-left" width="60px">
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
                <h2 class="head" style="color: #4b4f58;">Users</h2>
                <hr style="margin-top: -2px;">

                <!-- bagian pencarian -->
                <div class="row cari-filter" style="margin-top: 10px;">
                    <div class="col-lg-12" style="margin-top: 20px;">
                        <div class="input-group">
                            <input type="text" name="cari" class="form-control border-right-0 cari" id="keyword" placeholder="Search" style="width: 90%;padding: 5px 10px; font-size: 18px;" autocomplete="off">
                            <div class="input-group-append">
                                <span class="input-group-text bg-white border-left-0 icone"><i class="fa fa-search" style="font-size: 23px;"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- bagian pencarian -->
                
                <!-- bagian isi tabel -->
                <div class="headline" style="height: 40px;margin-top: 15px;">
                    <h4 class="ml-3 mt-1" style="color: #4b4f58">Data User</h4>
                </div>
                <div class="container tampil" id="container">
                    <div class="row" id="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover table-striped table-bordered">
                                    <tr>
                                        <th>ID User</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>No Rekening</th>
                                        <th>Level</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php $i = 1; ?>
                                    <?php foreach($dataUser as $row) : ?>
                                        <?php if ($row['username'] != 'admin') : ?>
                                            <tr id="<?= $row['id_user'] ?>" style="cursor: pointer">
                                                <td><?= $i++?></td>
                                                <td data-target="username" class="data" data-id="<?= $row['id_user'] ?>"><?= $row['username'] ?></td>
                                                <td data-target="email" class="data" data-id="<?= $row['id_user'] ?>"><?= $row['email'] ?></td>
                                                <td data-target="no_rek"><?= $row['no_rek'] ?></td>
                                                <td class="data" data-id="<?= $row['id_user'] ?>"><?= $row['level'] ?></td>
                                                <td data-target="status" class="data" data-id="<?= $row['id_user'] ?>"><?= $row['status']?></td>
                                                <td>
                                                    <button data-id="<?= $row['id_user'] ?>" data-role="update" class="btn btn-outline-primary openBtn">
                                                        <i class="fas fa-edit"></i> edit
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /bagian isi tabel -->
                
                <!-- pagenation -->
                <div class="panel-footer">
                    <nav class="float-right page">
                        <ul class="pagination">

                            <?php if ($halamanAktif > 1) : ?>
                            <li class="page-item">
                                <a href="?halaman=<?= $halamanAktif - 1 ?>" class="page-link">Previous</a>
                            </li>
                            <?php else : ?>
                            <li class="page-item">
                                <div class="page-link">Previous</div>
                            </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                <?php if ($i == $halamanAktif) : ?>
                                <li class="page-item active" aria-current="page">
                                    <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                                </li>
                                <?php else : ?>
                                <li class="page-item" aria-current="page">
                                    <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                                </li>
                                <?php endif; ?>
                            <?php endfor; ?>

                            <?php if ($halamanAktif < $jumlahHalaman) : ?>
                            <li>
                                <a href="?halaman=<?= $halamanAktif + 1 ?>" class="page-link" href="#">Next</a>
                            </li>
                            <?php else : ?>
                            <li class="page-item">
                                <div class="page-link">Next</div>
                            </li>
                            <?php endif; ?>
                        </ul>

                    </nav>
                </div>
                <!-- /pagenation -->
            </div>
        </div>
    </div>

    <br>

    <!-- Modal edit data -->
    <div class="modal fade" id="myModal2" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ubah Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- isi form -->
                <div class="modal-body">
                    <input type="hidden" id="userId" class="form-control">
                    <div class="form-group">
                        <label for="id_user">ID User</label>
                        <input type="text" class="form-control" id="id_user" disabled>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status">
                            <option value="aktif">Aktif</option>
                            <option value="tidak aktif">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <!-- footer form -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button id="save" class="btn btn-primary">simpan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal edit data -->

    <!-- Modal user aktif -->
    <div class="modal fade" id="myModal3" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Data user aktif</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- isi form -->
                <script type="text/javascript" src="js/pisahTitik.js"></script>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered">
                        <tr>
                            <th>ID User</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Status</th>
                        </tr>
                        <?php foreach($jumlahUserAktif as $row) : ?>
                            <?php if($row['username'] != 'admin') : ?>
                            <tr>
                                <td><?= $row['id_user'] ?></td>
                                <td><?= $row['username'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['level'] ?></td>
                                <td><?= $row['status']?></td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        </table>
                    </div>
                </div>
                <!-- footer form -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal user aktif -->

    

    <!-- banyak modal -->
    <script>
        $('.openBtn').click(function () {
            $('#myModal2').modal({
                show: true
            });
        })
        $('.btn-userAktif').click(function () {
            $('#myModal3').modal({
                show: true
            });
        })
        $('.btn-userNonAktif').click(function () {
            $('#myModal4').modal({
                show: true
            });
        })
    </script>
    </script>

    <script src="ajax/js/updateUser.js"></script>
    <script src="ajax/js/cariUser.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/kirimNoRek.js"></script>
    <script src="ajax/js/tambahRekeningIn.js"></script>
    <script src="ajax/js/tambahRekeningOut.js"></script>
</body>

</html>