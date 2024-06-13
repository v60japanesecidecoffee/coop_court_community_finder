<?php
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'myminorprojdb';
$db = new mysqli($servername, $username, $password, $dbname) or die("Connection failed:");
$sql = "SELECT * FROM communities";
$communitylist = $db->query($sql);
$current_page = basename($_SERVER['PHP_SELF']);
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Communities - Coop</title>
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
        <h2>Available Communities</h2>
        <table>
            <thead>
                <tr>
                    <th>Community Name</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $communitylist->fetch_assoc()): ?>
                    <tr onclick="location.href='communitydetails.php?id=<?php echo $row['id']; ?>'">
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>