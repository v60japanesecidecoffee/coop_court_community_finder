<?php
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'myminorprojdb';
$db = new mysqli($servername, $username, $password, $dbname) or die("Connection failed:");

// Fetch court list
$sql = "SELECT * FROM courts";
$courtlist = $db->query($sql);

// Fetch community list with limit
$community_sql = "SELECT * FROM communities LIMIT 3";
$communitylist = $db->query($community_sql);

$current_page = basename($_SERVER['PHP_SELF']);
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homepage - Coop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f7ff;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            position: relative;
            width: 20em;
            height: 15em;
            margin: 0 auto;
            background: #000000;
            border-radius: 10px;
            overflow: hidden;
        }
        .container .courtname {
            position: absolute;
            bottom: 0;
            background: rgb(0,0,0);
            background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);
            color: #f1f1f1;
            width: 100%;
            text-align: center;
            border-radius: 10px;
        }
        section {
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            flex-wrap: wrap;
            margin-right: 10%;
            margin-left: 10%;
            gap: 30px 0;
        }
        .section-title {
            margin-right: 10%;
            margin-left: 10%;
        }
        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.3s;
        }
        img:hover {
            opacity: 0.8;
        }
        h1 {
            font-size: 1.2em;
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
            table {
                font-size:0.8em;
            }
            h1 {
                font-size: 0.8em;
            }
            .container {
                width: 13.3em;
                height: 10em;
            }
            section {
                gap:1em 1em;
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
    <h2 class="section-title">Badminton Courts</h2>
    <section>
        <?php 
        $counter = 0;
        while($row = $courtlist->fetch_assoc()): 
            if ($counter >= 3) break;
            $counter++; 
        ?>
            <a href="courts.php?id=<?php echo $row['id']; ?>">
            <div class="container">
                <img src="<?php echo $row['imgurl']; ?>" alt="<?php echo $row['name']; ?>"></img>
                <div class="courtname">
                    <h1><?php echo $row['name']; ?></h1>
                </div>
            </div>
            </a>
        <?php endwhile; ?>
    </section>
    <h2 class="section-title">Communities</h2>
    <section>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
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
    </section>
</body>
</html>