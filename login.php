<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    $query = mysqli_query($koneksi, "SELECT * FROM user_detail WHERE user_email='$email' AND user_password='$password'");
    $cek = mysqli_num_rows($query);
    
    if ($cek > 0) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['id'] = $data['id'];
        $_SESSION['email'] = $email;
        $_SESSION['level'] = $data['level'];
        header("location:home.php");
    } else {
        $error = "Email atau password salah";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if(isset($error)) { echo "<p style='color:red'>$error</p>"; } ?>
    <form method="post" action="">
        <label>Email:</label><br>
        <input type="email" name="email" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <p>Belum punya akun? <a href="register.php">Daftar disini</a></p>
</body>
</html>