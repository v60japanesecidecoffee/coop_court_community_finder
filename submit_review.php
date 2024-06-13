<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'myminorprojdb';
$db = new mysqli($servername, $username, $password, $dbname) or die("Connection failed:");

$court_id = $_POST['court_id'];
$reviewer_name = $_POST['reviewer_name'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];

$sql = "INSERT INTO reviews (court_id, rating, comment, reviewer_name) VALUES ('$court_id', '$rating', '$comment', '$reviewer_name')";

if ($db->query($sql) === TRUE) {
    header("Location: courts.php?id=$court_id");
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

$db->close();
?>