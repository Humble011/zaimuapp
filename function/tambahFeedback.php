<?php 
    require 'functions.php';
    
    if (empty($_POST['fullname']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])){
        echo '{"status" : "Error", "Message" : "fullname, email, subject, and message are required!"}';
        exit();
    }

    // tambah data
    $fullname = htmlspecialchars($_POST["fullname"]);
    $email = htmlspecialchars($_POST["email"]);
    $subject = htmlspecialchars($_POST["subject"]);
    $message = htmlspecialchars($_POST["message"]);

    // query insert data
    $query = "INSERT INTO contact_us (fullname, email, subject, message) VALUES ('$fullname', '$email', '$subject', '$message')";
    
    if (mysqli_query($koneksi, $query)) {
        echo '{"Status" : "Success", "Message" : "Data berhasil ditambahkan!"}';
    } else {
        echo '{"Status" : "Error", "Message" : "'.mysqli_error($koneksi).'"}';
    }
?>