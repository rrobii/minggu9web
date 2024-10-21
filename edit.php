<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id'])) {
    header("location:login.php");
}

$id = isset($_GET['id']) ? $_GET['id'] : $_SESSION['id'];
$query = mysqli_query($koneksi, "SELECT * FROM user_detail WHERE id=$id");
$user = mysqli_fetch_assoc($query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $level = $_POST['level'];
    
    $update = mysqli_query($koneksi, "UPDATE user_detail SET user_email='$email', user_fullname='$fullname', level=$level WHERE id=$id");
    
    if ($update) {
        header("location:home.php");
    } else {
        $error = "Update gagal";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
</head>
<body>
    <h2>Edit Profile</h2>
    <?php if(isset($error)) { echo "<p style='color:red'>$error</p>"; } ?>
    <form method="post" action="">
        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo $user['user_email']; ?>" required><br>
        <label>Nama Lengkap:</label><br>
        <input type="text" name="fullname" value="<?php echo $user['user_fullname']; ?>" required><br>
        <label>Level:</label><br>
        <select name="level">
            <option value="1" <?php if($user['level'] == 1) echo 'selected'; ?>>Admin</option>
            <option value="2" <?php if($user['level'] == 2) echo 'selected'; ?>>User</option>
        </select><br><br>
        <input type="submit" value="Update">
    </form>
    <a href="home.php">Back to Home</a>
</body>
</html>