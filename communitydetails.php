<?php
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'myminorprojdb';
$db = new mysqli($servername, $username, $password, $dbname) or die("Connection failed:");

$community_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM communities WHERE id = $community_id";
$community_result = $db->query($sql);
$community = $community_result->fetch_assoc();

$sql = "SELECT * FROM members WHERE community_id = $community_id";
$members_result = $db->query($sql);

$current_page = basename($_SERVER['PHP_SELF']);
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Community Details - Coop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f7ff;
            min-height: 100vh;
            margin: 0;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 20px auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #001f4d;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        header {
            display: flex;
            justify-content: flex-start;
            background-color: #001f4d;
            padding: 0;
            height: 60px;
            align-items: center;
        }
        header a:last-child {
            margin-left: auto;
        }
        header a {
            color: white;
            padding-right: 20px;
            padding-left: 20px;
            text-decoration: none;
            text-align: center;
            height: 100%;
            display: flex;
            align-items: center;
        }
        header a.active {
            background-color: #003380;
        }
        @media only screen and (max-width: 600px) {
            header {
                height: 36px;
            }
            header a {
                font-size: 0.6em;
            }
            h2 {
                font-size: 1em;
            }
            h1 {
                font-size: 1em;
            }
            table {
                font-size:0.8em;
            }
        }
    </style>
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
    <div class="container">
        <h2>Community Details</h2>
        <?php if ($community): ?>
            <table>
                <tr>
                    <th>Name</th>
                    <td><?php echo $community['name']; ?></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><?php echo $community['description']; ?></td>
                </tr>
                <tr>
                    <th>Skill Level</th>
                    <td><?php echo $community['skill_level']; ?></td>
                </tr>
            </table>

            <h3>Members</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($member = $members_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $member['name']; ?></td>
                            <td><?php echo $member['email']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Community not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>