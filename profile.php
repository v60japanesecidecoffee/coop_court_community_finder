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
    echo "<script>alert('Please login to view your profile!');</script>";
    die("User not logged in.");
}

$profile = "SELECT S_Firstname, S_Lastname, S_Username, S_ProfileIMG FROM accountdata WHERE S_Username = '$usernm'";
$details = $db->query($profile);
$info_user = $details->fetch_assoc();

$current_page = basename($_SERVER['PHP_SELF']);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>User Profile - Coop</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f7ff;
                min-height: 100vh;
                margin: 0;
            }
            header {
                display: flex;
                justify-content: flex-start;
                background-color: #001f4d;
                padding: 0;
                height: 60px;
                align-items: center;
            }
            header a:last-child{
                margin-left:auto;
            }
            header a {
                color: white;
                padding-right:20px;
                padding-left:20px;  
                text-decoration: none;
                text-align: center;
                height: 100%;
                display: flex;
                align-items: center;
            }
            header a.active {
                background-color: #003380;
            }
            .info_box {
                background-color: #ffffff;
                padding: 40px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
                width: 500px;
                text-align: center;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .info_box img {
                width: 128px;
                border-radius: 50%;
                margin-bottom: 20px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }

            .info_box p {
                margin: 10px 0;
                font-size: 32px;
                font-weight: bold;
            }
            .info_box p.username {
                margin: 10px 0;
                font-size: 24px;
                font-weight: 400;
            }
            .info_box input[type="submit"] {
                width: 100px;
                padding: 10px;
                border: none;
                border-radius: 5px;
                background-color: #007bff;
                color: white;
                font-size: 18px;
                cursor: pointer;
                font-size:1.2em;
            }
            .info_box input[type="submit"].logout {
                background-color: #ff4066;
            }
            .info_box input[type="submit"].logout:hover {
                background-color: #e60935;
            }
            section {
                margin-top: 3em;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            @media only screen and (max-width: 600px) {
                header {
                    height: 36px;
                }
                header a {
                    font-size: 0.6em;
                }
                p {
                    font-size:0.8em;
                }
                h2 {
                    font-size: 1em;
                }
                h1 {
                    font-size: 1em;
                }
                .info_box {
                    width:380px;
                }
                .info_box input[type="submit"] {
                    width: 75px;
                    font-size:0.9em;
                }
                .info_box p {
                    font-size: 24px;
                    font-weight: bold;
                }
                .info_box p.username {
                    font-size: 18px;
                    font-weight: 300;
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
    <section>
        <div class="info_box">
            <img src="<?php echo $info_user['S_ProfileIMG']?>" alt="<?php echo $info_user['S_Username']?>'s profile picture"></img>
            <p><strong><?php echo $info_user['S_Firstname']?> <?php echo $info_user['S_Lastname']?></strong></p>
            <p class="username"><?php echo $info_user['S_Username']?></p></br>
            <form method="" action="profileedit.php">
            <input type="submit" name="edit" value="Edit"/>
            </form>
        </br>
            <form method="" action="logout.php">
                <input type="submit" name="logout" value="Logout" class="logout"/>
            </form>
        </div>
    </section>
    </body>
</html>