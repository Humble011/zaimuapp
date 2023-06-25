<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'db_keuangan');

// fungsi generate no rek
function acak($panjang)
{
    $karakter = '1234567890';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
        $pos = rand(0, strlen($karakter) - 1);
        $string = $karakter[
        $pos];
    }
    return $string;
}

function register($dataRegister)
{
    global $koneksi;

    $email = htmlspecialchars(stripcslashes($dataRegister['email-registrasi']));
    $username = htmlspecialchars(stripcslashes($dataRegister['username-registrasi']));
    $password = mysqli_real_escape_string($koneksi, htmlspecialchars($dataRegister['password-registrasi']));
    $passwordConfirm = mysqli_real_escape_string($koneksi, htmlspecialchars($dataRegister['password-confirm']));

    $cekUser = mysqli_query($koneksi, "SELECT email, username FROM users WHERE email = '$email' OR username = '$username'");

    // cek username dan email
    if (mysqli_num_rows($cekUser) > 0) {
        echo "
            <script>
                swal('Maaf','Username / email telah dipakai!','info');
            </script>
        ";
        return false;
    }

    // cek konfirmasi password
    if ($password != $passwordConfirm) {
        echo "
            <script>
                swal('Maaf', 'Password konfirmasi harus sama','info');
            </script>
        ";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $no_rek = acak(12);
    $sukses = mysqli_query($koneksi, "INSERT INTO users (email, username, password, no_rek) VALUES ('$email', '$username', '$password', '$no_rek')");

    if ($sukses > 0) {
        echo "
    <script>
        swal('Berhasil','Akun anda berhasil didaftarkan!','success');
    </script>
    ";
    } else {
        echo "
            <script>
            swal('Maaf',Akun anda gagal didaftarkan','warning');
            </script>
        ";
        return false;
    }

    return mysqli_affected_rows($koneksi);
}