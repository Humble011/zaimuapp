<?php 
    require 'functions.php';
    
    if (empty($_POST['fullname']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])){
        echo '{"status" : "Error", "Message" : "fullname, email, subject, and message is required!"}';
        exit();
    }

    // tambah data
    $fullname = htmlspecialchars($_POST["fullname"]);
    $email = htmlspecialchars($_POST["email"]);
    $subject = htmlspecialchars($_POST["subject"]);
    $message = htmlspecialchars($_POST["message"]);

    // query insert data
    $query = "INSERT INTO contact_us VALUES ('', '$fullname', '$email', '$sumber', '$subject', '$message')";
    
    if (mysqli_query($koneksi, $query)) {
        echo '{"Status" : "Succes", "Message" : "Data berhasil ditambahkan!"}';
    } else {
        echo '{"Status" : "Error", "Message" : '.mysqli_error($koneksi).'}';
    }
?>