<?php 
    session_start();
    require "function/functions.php";
    
    if ( isset($_SESSION["login"]) ) {
        header("Location: dashboard");
        exit;
    } elseif(isset($_COOKIE['login'])) {
        header("Location: dashboard");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/zaimu.png">
    <title>Zaimu</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        type="text/css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/modal.css">
    <style>
        header{
            min-height: 600px;
        }
        .parallax {
            background: url(img/atas.jpg);
            background-attachment: fixed;
            background-size: cover;
            background-repeat: no-repeat;
        }   

        .parallax2 {
            background: url(img/team.jpg);
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .navbar-brand {
            font-weight:bold;
        }
        .navbar-brand span{
            color: rgb(30,144,255);;
        }
        .garis{
            border-bottom: 2px solid rgb(30, 144, 255);
        }
        .garis:hover{
            border-bottom: 2px solid rgb(0, 0, 139)
        }
        .team:hover{
            box-shadow: 5px 5px 0 rgb(30, 144, 255)
        }
        .contact-wrap {
            width: 80%;
            height: auto;
            margin: auto;
            display: flex;
            flex-wrap: wrap;
        }

        .contact-in {
            padding: 40px 30px;
        }

        .contact-in:nth-child(1) {
            flex: 30%;
            background: url(img/11.jpg);
            color: #fff;
        }

        .contact-in:nth-child(2) {
            flex: 45%;
            background: rgb(30,144,255);
        }

        .contact-in:nth-child(3) {
            flex: 25%;
            padding: 0;
        }

        .contact-in h1 {
            font-size: 24px;
            color: #fff;
            text-transform: uppercase;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .contact-in h2 {
            font-size: 20px;
            font-weight: 400;
            margin-bottom: 15px;
        }

        .contact-in h2 i {
            font-size: 16px;
            width: 40px;
            height: 40px;
            margin-right: 10px;
            background: #f5f5f5;
            color: #000;
            border-radius: 50px;
            line-height: 40px;
            text-align: center;
        }

        .contact-in p {
            font-size: 14px;
            font-weight: 300;
            margin-bottom: 20px;
        }

        .contact-in ul {
            padding: 0;
            margin: 0;
        }

        .contact-in ul li {
            list-style: none;
            display: inline-block;
            margin-right: 5px;
            margin-top: 5px;
        }

        .contact-in ul li a {
            display: block;
            width: 30px;
            height: 30px;
            text-align: center;
            background: #fff;
            border-radius: 50px;
        }

        .contact-in ul li a i {
            font-size: 14px;
            line-height: 30px;
            color: #000;
        }

        .contact-in form {
            width: 100%;
            height: auto;
        }

        .contact-in-input {
            width: 100%;
            height: 40px;
            margin-bottom: 20px;
            border: 1px solid #fff;
            outline: none;
            padding-left: 5px;
            background: transparent;
            color: #fff;
            font-size: 12px;
            font-weight: 300;
            font-family: 'Poppins', sans-serif;
        }

        .contact-in-input::placeholder {
            color: #fff;
        }

        .contact-in-textarea {
            width: 100%;
            height: 140px;
            margin-bottom: 20px;
            border: 1px solid #fff;
            outline: none;
            padding-top: 5px;
            padding-left: 5px;
            background: transparent;
            color: #fff;
            font-size: 12px;
            font-weight: 300;
            font-family: 'Poppins', sans-serif;
        }

        .contact-in-textarea::placeholder {
            color: #fff;
        }

        .contact-in-btn {
            width: 100%;
            height: 40px;
            border: 1px solid #fff;
            outline: none;
            background: transparent;
            color: #fff;
            font-size: 12px;
            font-weight: 300;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
        }
        .contact-in-btn:hover{
            background: #fff;
            color: rgb(30, 144, 255);
        }


        .contact-in iframe {
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top main-nav" id="mainNav">
        <div class="container">
            <a class="js-scroll-trigger" href="#page-top">
                <img src="img/logo.png" width="20px" style="margin-right: 10px; margin-bottom: 2px;">
            </a>
            <a class="navbar-brand js-scroll-trigger" href="#page-top">Zaimu<span>App</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#contact">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="login" class="nav-link">Sign in</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navigation -->

    <!-- header -->
    <header id="home" class="text-light parallax">
        <div class="container konten">
            <h1 style="font-size: 36pt;">Welcome to Zaimu App</h1>
            <p class="lead" style="font-size: 16pt; font-weight:400;">Aplikasi pencatatan keuangan harian dengan
                fitur
                transaksi terbaik</p>
            <a href="login" class="btn btn-outline-light button">Get Started</a>
        </div>
    </header>
    <!-- header -->

    <!-- features -->
    <section id="features" class="bg-light">
        <div class=" container konten2">
            <div class="garis text-center">FEATURES</div>

            <div class="col-lg-12 foot-fitur">
                <h4 class="headline text-center">Zaimu App</h4>
                <p class="isi-fitur text-center">Zaimu App adalah aplikasi web pencatatan keuangan harian yang
                    mempunyai fitur-fitur menarik untuk memonitoring keuangan harian anda. Direkomendasikan bagi para
                    remaja
                    yang kesulitan dalam melakukan pengelolaan keuangannya. </p>
            </div>

            <div class="row row2">
                <div class="col-lg-6 fiturs">
                    <div class="gbr">
                        <div class="box">
                            <img src="img/trk.jpg" class="gambar-fitur img" width="100%">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 fiturs">
                    <h4 class="headline">Transaksi Harian</h4>
                    <p class="isi-fitur">
                        Kami memberikan fitur transaksi harian yang akan menampilkan data
                        harian yang bisa mempermudah anda dalam mengelola keuangan pribadi. dan data keuangan anda akan
                        tersimpan dengan aman di dalam aplikasi ini.</p>
                </div>
            </div>

            <div class="row row2">
                <div class="col-lg-6 fiturs">
                    <h4 class="headline">Rekening Pribadi</h4>
                    <p class="isi-fitur">Kami menyediakan fitur rekening pribadi yang dapat mempermudah anda dalam
                        melakukan pengelolaan keuangan di dompet dan juga di rekening anda. Dengan fitur ini,
                        pengelolaan
                        uang anda di rekening menjadi lebih mudah dan terkelola dengan baik.</p>
                </div>
                <div class="col-lg-6 fiturs">
                    <div class="gbr">
                        <div class="box">
                            <img src="img/rek.jpg" class="gambar-fitur img" width="100%">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row2">
                <div class="col-lg-6 fiturs">
                    <div class="gbr">
                        <div class="box">
                            <img src="img/mon.jpg" class="gambar-fitur img" width="100%">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 fiturs">
                    <h4 class="headline">Monitoring Keuangan</h4>
                    <p class="isi-fitur">Monitoring keuangan tentunya sangat diperlukan untuk mengelola pengeluaran dan
                        pemasukan kita. kami menyediakan dashboard yang berisi beberapa fitur, seperti saldo, total
                        uang yang masuk dan keluar, dan rekening.</p>
                </div>
            </div>

        </div>
    </section>
    <!-- features -->

    <!-- about us -->
    <section id="about" class="bg-primary parallax2">
        <div class="container">
            <div style="color: white;" class="garis garis3 text-center">TIPS HEMAT</div>
            <div class="row text-center">
                <div class="col-lg-4">
                    <div class="team">
                        <div class="gbr">
                            <div class="box">
                                <img class="img" src="profile/note.png" width="100%">
                            </div>
                        </div>
                        <div class="teks">
                            <h3 class="job-desk">Mencatat Keuangan</h3>
                            <p>Pencatatan keuangan ini mempermudah untuk melakukan evaluasi dalam mengatur keuangan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="team">
                        <div class="gbr">
                            <div class="box">
                                <img class="img" src="profile/priority.png" width="100%">
                            </div>
                        </div>
                        <div class="teks">
                            <h3 class="job-desk">Prioritas Kebutuhan</h3>
                            <p>Dengan memprioritaskan kebutuhan, harapannya pengeluaran keuangan bisa ditekan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="team">
                        <div class="gbr">
                            <div class="box">
                                <img class="img" src="profile/deposit.png" width="100%">
                            </div>
                        </div>
                        <div class="teks">
                            <h3 class="job-desk">Menabung</h3>
                            <p>Bertujuan untuk memenuhi kebutuhan di waktu yang akan datang serta menyiapkan dana saat ada kejadian tak terduga.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about us -->

    <!-- contact -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="garis garis2 text-center">CONTACT US</div>
                        <div class="contact-wrap">
                            <div class="contact-in">
                                <h1>Contact Info</h1>
                                <h2><i class="fa fa-phone" aria-hidden="true"></i> Phone</h2>
                                <p>123-456-789</p>
                                <h2><i class="fa fa-envelope" aria-hidden="true"></i> Email</h2>
                                <p>muhammadhilmi148@gmail.com</p>
                                <h2><i class="fa fa-map-marker" aria-hidden="true"></i> Address</h2>
                                <p>Jl. Soekarno Hatta No.643</p>
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            <div class="contact-in">
                                <h1>Send a Message</h1>
                                <form>
                                    <input type="text" placeholder="Full Name" class="contact-in-input">
                                    <input type="text" placeholder="Email" class="contact-in-input">
                                    <input type="text" placeholder="Subject" class="contact-in-input">
                                    <textarea placeholder="Message" class="contact-in-textarea"></textarea>
                                    <input type="submit" value="SUBMIT" class="contact-in-btn">
                                </form>
                            </div>
                            <div class="contact-in">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15842.267192845562!2d107.650718!3d-6.942262!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf097d99bcccc4293!2sUniversitas%20Informatika%20Dan%20Bisnis%20Indonesia%20(UNIBI)!5e0!3m2!1sid!2sid!4v1675114693065!5m2!1sid!2sid" width="100%" height="auto" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact -->

    <!-- Footer -->
    <div class="py-3 bg-dark">
        <div class="container text-light">
            <div class="row">
                <div class="col-lg-3 col-6 p-3">
                    <h5> <b>Main</b> </h5>
                    <ul class="list-unstyled">
                        <li> <a href="#home" class="js-scroll-trigger foot-link">Home</a> </li>
                        <li> <a href="#features" class="js-scroll-trigger foot-link">Features</a> </li>
                        <li> <a href="#about" class="js-scroll-trigger foot-link">About Us</a> </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-6 p-3">
                    <h5> <b>Others</b> </h5>
                    <ul class="list-unstyled">
                        <li> <a href="faq" class="foot-link">FAQ</a> </li>
                        <li> <a href="#" class="foot-link">Promotion Videos</a> </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 p-3">
                    <h5> <b>About</b> </h5>
                    <p class="mb-0">Zaimu App dilengkapi dengan fitur menarik yang dapat mempermudah user mengelola keuangannya.</p>
                </div>
                <div class="col-lg-3 col-md-6 p-3">
                    <h5> <b>Follow us</b> </h5>
                    <div class="row">
                        <div class="col-md-12 d-flex align-items-center justify-content-between my-2">
                            <a href="https://www.facebook.com" class="foot-link" target="_blank">
                                <i class="d-block fa fa-facebook-official warna-icon fa-lg mr-2"></i>
                            </a>
                            <a href="https://www.instagram.com" class="foot-link" target="_blank">
                                <i class="d-block fa fa-instagram warna-icon fa-lg mx-2"></i>
                            </a>
                            <a href="https://twitter.com" class="foot-link" target="_blank">
                                <i class="d-block fa fa-twitter warna-icon fa-lg ml-2"></i>
                            </a>
                            <a href="https://google.com" class="foot-link" target="_blank">
                                <i class="d-block fa fa-google warna-icon fa-lg ml-2"></i>
                            </a>
                            <a href="https://google.com" class="foot-link" target="_blank">
                                <i class="d-block fa fa-github warna-icon fa-lg ml-2"></i>
                            </a>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="mb-0 mt-2">Copyright © 2023 All rights reserved.</p> 
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->

    <!-- <footer class="bg-dark foot">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; 2018 Semicolon SQUAD</p>
        </div>
    </footer> -->

    <!-- js utama -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-easing/jquery.easing.min.js"></script>

    <!-- js scrolling -->
    <script src="js/scrolling-nav.js"></script>

</body>

</html>