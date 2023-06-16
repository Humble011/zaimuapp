<?php 
    session_start();
    require "function/functions.php";
    
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
    <title>Zaimu App - Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <link rel="stylesheet" href="css/styler.css?v=1.0">
    <link rel="stylesheet" href="css/dashboard.css?v=1.0">
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="js/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

    <style>
    
.rentang {
    padding-bottom: 75px;
}
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
                <li class="rentang">
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
                <a href="dashboard" style="text-decoration: none;">
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

                <a href="pengeluaran" class="linkAktif">
                    <li id="panel2" style="display: none;">
                        <div style="margin-left: 20px;">
                            <span><i class="fas fa-hand-holding-usd"></i></span>
                            <span>Data Pengeluaran</span>
                        </div>
                    </li>
                </a>
                <!-- data -->

                <!-- Input -->
                <li class="klik2" id="flip2" style="cursor:pointer;">
                    <div>
                        <span class="fas fa-plus-circle"></span>
                        <span>Masukan</span>
                        <i class="fas fa-caret-right float-right" style="line-height: 20px;"></i>
                    </div>
                </li>

                <a href="tambahPemasukkan" class="linkAktif">
                    <li id="panel3" style="display: none;">
                        <div style="margin-left: 20px;">
                            <span><i class="fas fa-file-invoice-dollar"></i></span>
                            <span>Pemasukkan</span>
                        </div>
                    </li>
                </a>

                <a href="tambahPengeluaran" class="linkAktif">
                    <li id="panel4" style="display: none;">
                        <div style="margin-left: 20px;">
                            <span><i class="fas fa-hand-holding-usd"></i></span>
                            <span>Pengeluaran</span>
                        </div>
                    </li>
                </a>
                <!-- Input -->

                <!-- laporan -->
                <a href="laporan" style="text-decoration: none;">
                    <li>
                        <div>
                            <span><i class="fas fa-clipboard-list"></i></span>
                            <span>Laporan</span>
                        </div>
                    </li>
                </a>

                <!-- change icon -->
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
                <h2 class="heade" style="color: #4b4f58;">Dashboard</h2>
                <hr style="margin-top: -2px;">
                <div class="container" id="container" style="border: none;">
                    <div class="row tampilCardview" id="row">

                    <div class="col-md-4 jarak">
                        <div class="card card-stats card-warning" style="background: #347ab8;">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="fa fa-users ikon" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 d-flex align-items-center tulisan">
                                        <div class="numbers">
                                            <p class="card-category ket head">Jumlah User</p>
                                            <h4 class="card-title ket total"><?= mysqli_num_rows($jumlahUser) ?> User
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 jarak">
                        <a style="text-decoration: none; cursor: pointer;" class="btn-userAktif">
                            <div class="card card-stats card-warning" style="background:#5db85b ">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fa fa-user ikon"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 d-flex align-items-center tulisan">
                                            <div class="numbers">
                                                <p class="card-category ket head">User Aktif</p>
                                                <h4 class="card-title ket total"><?= mysqli_num_rows($jumlahUserAktif) ?> User</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="overlay" style="background: #5db85b;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-eye ikon2"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 d-flex align-items-center">
                                            <p class="tulisan">Lihat User</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4 jarak">
                        <a style="text-decoration: none; cursor: pointer;" class="btn-userNonAktif">
                            <div class="card card-stats card-warning" style="background: #d95350;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-power-off ikon"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 d-flex align-items-center tulisan">
                                            <div class="numbers">
                                                <p class="card-category ket head">Masukan</p>

                                                <h4 class="card-title ket total"><?= mysqli_num_rows($jumlahUserTidakAktif) ?> User</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="overlay" style="background: #d95350;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-eye ikon2"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 d-flex align-items-center">
                                            <p class="tulisan">Lihat User</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
    <!-- Modal dana masuk -->
    <div class="modal fade" id="myModal3" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
                                    </tr>
                                    <?php foreach($dataUser as $row) : ?>
                                        <?php if ($row['username'] != 'admin') : ?>
                                            <tr id="<?= $row['id_user'] ?>" style="cursor: pointer">
                                                <td data-target="id_user" class="data" data-id="<?= $row['id_user'] ?>"><?= $row['id_user'] ?></td>
                                                <td data-target="username" class="data" data-id="<?= $row['id_user'] ?>"><?= $row['username'] ?></td>
                                                <td data-target="email" class="data" data-id="<?= $row['id_user'] ?>"><?= $row['email'] ?></td>
                                                <td data-target="no_rek"><?= $row['no_rek'] ?></td>
                                                <td class="data" data-id="<?= $row['id_user'] ?>"><?= $row['level'] ?></td>
                                                <td data-target="status" class="data" data-id="<?= $row['id_user'] ?>"><?= $row['status']?></td>
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
                
    
    
    <!-- Modal history -->
    <div class="modal fade" id="myModal4" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Riwayat transaksi</h5>
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
                            <th>No.</th>
                            <th>Kode transaksi</th>
                            <th>Nominal</th>
                            <th>Aksi</th>
                            <th>Tanggal</th>
                        </tr>
                        <?php foreach($rekeningMasuk as $row) : ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row['kode'] ?></td>
                                <td><?= $row['jumlah'] ?></td>
                                <td><?= $row['aksi'] ?></td>
                                <td><?= $row['tanggal'] ?></td>
                            </tr>
                            <?php $no++ ?>
                        <?php endforeach; ?>

                        <?php foreach($rekeningKeluar as $row) : ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row['kode'] ?></td>
                                <td><?= $row['jumlah'] ?></td>
                                <td><?= $row['aksi'] ?></td>
                                <td><?= $row['tanggal'] ?></td>
                            </tr>
                            <?php $no++ ?>
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
    <!-- Modal history -->

    <!-- Modal transfer -->
    <div class="modal fade" id="myModal5" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Transfer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- isi form -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jumlahRekOut">No rekening</label>
                        <input type="text" class="form-control" id="no_rek" required>
                    </div>
                </div>
                <!-- footer form -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <a href="#" class="btn btn-primary tambah_norek">Cari</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal transfer -->

    <!-- banyak modal -->
    <script>
        $('#openBtn').click(function () {
            $('#myModal2').modal({
                show: true
            });
        })
        $('#openBtn2').click(function () {
            $('#myModal3').modal({
                show: true
            });
        })
        $('#openBtn3').click(function () {
            $('#myModal4').modal({
                show: true
            });
        })
        $('#openBtn4').click(function () {
            $('#myModal5').modal({
                show: true
            });
        })
    </script>
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
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: ["Saldo masuk", "Saldo keluar"],
                datasets: [{
                    label: 'Data rekening',
                    data: [
                        <?= $totalRekIn ?>, 
                        <?= $totalRekOut ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132)',
                        'rgba(54, 162, 235)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        stacked: true
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                }
            }
        });
    </script>

    <script src="js/bootstrap.js"></script>
    <script src="js/kirimNoRek.js"></script>
    <script src="ajax/js/tambahRekeningIn.js"></script>
    <script src="ajax/js/tambahRekeningOut.js"></script>
</body>

</html>