<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'myminorprojdb';
$db = new mysqli($servername, $username, $password, $dbname) or die("Connection failed:");

$data = json_decode(file_get_contents('php://input'), true);
$review_id = $data['review_id'];
$user_ip = $_SERVER['REMOTE_ADDR'];
$sql = "SELECT * FROM likes WHERE review_id = $review_id AND user_ip = '$user_ip'";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    $sql = "DELETE FROM likes WHERE review_id = $review_id AND user_ip = '$user_ip'";
    $db->query($sql);
    $liked = false;
} else {
    $sql = "INSERT INTO likes (review_id, user_ip) VALUES ($review_id, '$user_ip')";
    $db->query($sql);
    $liked = true;
}
$sql = "SELECT COUNT(*) as like_count FROM likes WHERE review_id = $review_id";
$result = $db->query($sql);
$like_count = $result->fetch_assoc()['like_count'];

echo json_encode(['success' => true, 'likes' => $like_count, 'liked' => $liked]);

$db->close();
?>
