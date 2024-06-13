<?php
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'myminorprojdb';
$db = new mysqli($servername, $username, $password, $dbname) or die("Connection failed:");
if (isset($_SESSION['username'])) {
    $usernm=$_SESSION['username'];
} else {
    die("User not logged in.");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $url = $db->real_escape_string(htmlspecialchars($_POST['url']));
    $updateURL="UPDATE accountdata SET S_ProfileIMG = '$url' WHERE S_Username = '$usernm'";
    if ($db->query($updateURL) === TRUE) {
        echo "<script>alert('Profile Picture Changed Successfully!');</script>";
    } else {
        echo "Error updating profile: " . $db->error;
    }
}
$db->close();
header("Location: profileedit.php");
?>
