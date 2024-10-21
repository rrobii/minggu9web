<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id'])) {
    header("location:login.php");
}

$id = $_SESSION['id'];
$query = mysqli_query($koneksi, "SELECT * FROM user_detail WHERE id=$id");
$user = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h2>Welcome, <?php echo $user['user_fullname']; ?></h2>
    <p>Email: <?php echo $user['user_email']; ?></p>
    <p>Level: <?php echo $user['level']; ?></p>
    <a href="edit.php">Edit Profile</a>
    <a href="logout.php">Logout</a>
    <?php if ($user['level'] == 1): ?>
        <h3>User List</h3>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Fullname</th>
                <th>Action</th>
            </tr>
            <?php
            $users = mysqli_query($koneksi, "SELECT * FROM user_detail");
            while($row = mysqli_fetch_assoc($users)):
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['user_email']; ?></td>
                <td><?php echo $row['user_fullname']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>
</body>
</html>