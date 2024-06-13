<?php
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'myminorprojdb';
$db = new mysqli($servername, $username, $password, $dbname) or die("Connection failed:");
$court_id = $_GET['id'];

$sql = "SELECT * FROM courts WHERE id = $court_id";
$courtresult = $db->query($sql);
$court = $courtresult->fetch_assoc();

$sql = "SELECT * FROM reviews WHERE court_id = $court_id";
$reviewresult = $db->query($sql);

$sql = "SELECT AVG(rating) as average_rating FROM reviews WHERE court_id = $court_id";
$getaverage = $db->query($sql);
$averageRating = $getaverage->fetch_assoc()['average_rating'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $court['name']; ?></title>
    <link rel="stylesheet" href="court.css">
    <script src="likefeature.js"></script>
</head>
<body>
    <header>
        <a href="main.php" class="<?php echo $current_page == 'main.php' ? 'active' : ''; ?>">Home</a>
        <a href="showallcourt.php" class="<?php echo $current_page == 'showallcourt.php' ? 'active' : ''; ?>">Courts</a>
        <a href="communities.php" class="<?php echo $current_page == 'communities.php' ? 'active' : ''; ?>">Communities</a>
        <a href="about.php" class="<?php echo $current_page == 'about.php' ? 'active' : ''; ?>">About</a>
        <a href="search_courts.php" class="<?php echo $current_page == 'search_courts.php' ? 'active' : ''; ?>">Search</a>
        <a href="profile.php" class="<?php echo $current_page == 'profile.php' ? 'active' : ''; ?>">Profile</a>
    </header>
    </header>
    <section>
    <h1><?php echo $court['name']; ?></h1>
    <div class="imgbox">
        <img src="<?php echo $court['imgurl']; ?>" alt="court image"></img>
    </div>
    <p><?php echo $court['location']; ?></p>
    <p><?php echo $court['description']; ?></p>
    <p>Average Rating: <?php echo number_format($averageRating, 2); ?></p>
    <h2>Reviews</h2>
    <ul>
        <?php while($row = $reviewresult->fetch_assoc()): ?>
            <li>
                <strong><?php echo $row['reviewer_name']; ?></strong> (<?php echo $row['rating']; ?>/5)
                <p><?php echo $row['comment']; ?></p>
                <div>
                    <button class="like-button" data-review-id="<?php echo $row['id']; ?>">
                        <?php
                            $review_id = $row['id'];
                            $user_ip = $_SERVER['REMOTE_ADDR'];
                            $like_check_result = $db->query("SELECT * FROM likes WHERE review_id = $review_id AND user_ip = '$user_ip'");
                            if ($like_check_result->num_rows > 0) {
                                echo 'Unlike';
                            } else {
                                echo 'Like';
                            }
                        ?>
                    </button>
                    <span id="like-count-<?php echo $row['id']; ?>">
                        <?php
                            $like_count_result = $db->query("SELECT COUNT(*) as like_count FROM likes WHERE review_id = $review_id");
                            $like_count = $like_count_result->fetch_assoc()['like_count'];
                            echo $like_count;
                        ?>
                    </span> Likes
                </div>
            </li>
        <?php endwhile; ?>
    </ul>

    <h2>Submit a Review</h2>
    <form action="submit_review.php" method="post">
        <input type="hidden" name="court_id" value="<?php echo $court_id; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="reviewer_name" required>
        <label for="rating">Rating:</label>
        <select id="rating" name="rating">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <label for="comment">Comment:</label>
        <textarea id="comment" name="comment" required></textarea></br>
        <button type="submit">Submit</button>
    </form>
    </section>
</body>
</html>