<?php
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'myminorprojdb';
$db = new mysqli($servername, $username, $password, $dbname) or die("Connection failed:");  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernm = $_POST['user'];
    $passwd = $_POST['pass'];
    $accountcheck = "SELECT * FROM accountdata WHERE S_Username = '$usernm' AND S_Password = '$passwd'";
    $result=mysqli_query($db, $accountcheck);
    $check=mysqli_fetch_array($result);
    if (isset($check)) {
        $_SESSION['username'] = $usernm;
        header("Location: main.php");
        echo "<script>alert('Login successful!');</script>";
    } else {
        echo "<script>alert('Invallid Username or Password');</script>";
    }
}   

$db->close();
?>
<html lang="en">
<head>
    <title>User Login - Coop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="login_style.css">
</head>
<body>
    <div class="login_box">
    <form method="post" action="">
        <label>Username:</label>
        <input type="text" name="user" /></br></br>
        <label>Password:</label>
        <input type="password" name="pass" />
        <input type="submit" name="login" value="Login" />
    </form>
    <p>No Account? <a href="register.php">Create one</a><p>
    </div>
</body>
</html>