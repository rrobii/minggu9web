<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $fullname = $_POST['fullname'];
    $level = 2; // Assuming 2 is for regular users
    
    // Check if the level exists in level_detail table
    $check_level = mysqli_query($koneksi, "SELECT * FROM level_detail WHERE id_level = $level");
    if (mysqli_num_rows($check_level) == 0) {
        $error = "Invalid user level";
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO user_detail (user_email, user_password, user_fullname, level) VALUES ('$email', '$password', '$fullname', $level)");
        
        if ($query) {
            header("location:login.php");
            exit();
        } else {
            $error = "Registrasi gagal: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <?php if(isset($error)) { echo "<p style='color:red'>$error</p>"; } ?>
    <form method="post" action="">
        <label>Email:</label><br>
        <input type="email" name="email" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br>
        <label>Nama Lengkap:</label><br>
        <input type="text" name="fullname" required><br><br>
        <input type="submit" value="Register">
    </form>
    <p>Sudah punya akun? <a href="login.php">Login disini</a></p>
</body>
</html>