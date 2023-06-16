<?php 
session_start();
require 'function/functions.php';

// if(isset($_COOKIE['login'])) {
//     if ($_COOKIE['level'] == 'admin') {
//         $_SESSION['login'] = true;
//     } 
    
//     elseif ($_COOKIE['level'] == 'user') {
//         $_SESSION['login'] = true;
//         header('Location: index');
//     } 
// } 

// elseif ($_SESSION['level'] == 'admin') {
//     $ambilNama = $_SESSION['user'];
// } 

// else {
//     if ($_SESSION['level'] == 'user') {
//         header('Location: index');
//         exit;
//     }
// }

// if(empty($_SESSION['login'])) {
//     header('Location: login');
//     exit;
// } 

// $username = $_GET['username'];
// $idUser = $_GET['idUser'];

// $jumlahTabel = 5;
// $jumlahData = count(query("SELECT * FROM pemasukkan WHERE username = '$username'"));
// $jumlahHalaman = ceil($jumlahData / $jumlahTabel);
// $halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
// $awalData = ($jumlahTabel * $halamanAktif) - $jumlahTabel;

// $pemasukkan = query("SELECT * FROM pemasukkan WHERE username = '$username' LIMIT $awalData, $jumlahTabel");

$sql = "SELECT * FROM users";
$users = mysqli_query($koneksi,$sql);


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
        <a href="administrator">
            <div class="logout">
                <i class="fas fa-sign-out-alt float-right log"></i>
                <p class="float-right logout"></p>
            </div>
        </a>
    </div>

    <div class="sidebar">
        <nav>
            <ul>
                <li>
                    <img src="img/avatar.svg" class="img-fluid profile float-left" width="60px">
                    <h5 class="admin"></h5>
                    <div class="online">
                        <p class="float-right ontext">ID User : </p>
                    </div>
                </li>
                <!-- fungsi slide -->
                <script>
                    $(document).ready(function(){
                    $("#flip").click(function(){
                        $("#panel").slideToggle("medium");
                        $("#panel2").slideToggle("medium");
                    });
                    $("#flip2").click(function(){
                        $("#panel3").slideToggle("medium");
                        $("#panel4").slideToggle("medium");
                    });
                });
                </script>

                <!-- dashboard -->
                <a href="" style="text-decoration: none;">
                    <li class="aktif" style="border-left: 5px solid #306bff;">
                        <div>
                            <span><i class="fas fa-file-invoice-dollar"></i></span>
                            <span>Data PemaUssukan</span>
                        </div>
                    </li>
                </a>

                <!-- data -->
                <a href="" style="text-decoration: none;">
                <li style="cursor:pointer;">
                    <div>
                        <span><i class="fas fa-hand-holding-usd"></i></span>
                        <span>Data Pengeluaran</span>
                        
                    </div>
                </li></a>
           
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

                <!-- bagian isi tabel -->
                <div class="headline">
                    <h5>Data Users</h5>
                </div>
                <div class="container" id="container">
                    <div class="row tampil" id="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover table-striped table-bordered">
                                    <tr>
                                        <th>No.</th>
                                        <th>username</th>
                                        <th>Status</th>
                                        <th>Level</th>
                                        <th>No Rek</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php $i = 1; ?>
											<?php foreach ($users as $row) : ?>
											<tr class="show" id="<?= $row['id'] ?>">
													<td> <?= $i ?> </td>
													<td data-target="username"><?= htmlspecialchars($row['username']) ?></td>
													<td data-target="status"><?= htmlspecialchars($row['status']) ?></td>
													<td data-target="level"><?= htmlspecialchars($row['level']) ?></td>
													<td data-target="no_rek"><?= htmlspecialchars($row['no_rek']) ?></td>
													<td>
														<a href="#" id="<?= $row['id']; ?>" class="btn btn-info delete">
															<i class="fas fa-trash-alt"></i>
														</a>
														<a href="#" data-id="<?= $row['id']; ?>" data-role="update" class="btn btn-outline-secondary" id="openBtn">
															<i class="fas fa-edit"></i>
														</a>
													</td>
											</tr>
											<?php $i++ ?>
											<?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Button trigger modal -->
                    
                </div>
                <!-- bagian isi tabel -->

                
                
            </div>
        </div>
    </div>


    <script src="js/bootstrap.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</body>

</html>