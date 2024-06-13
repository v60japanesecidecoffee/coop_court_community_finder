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
    echo "<script>alert('Please login to edit your profile!');</script>";
    die("User not logged in.");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $db->real_escape_string(htmlspecialchars($_POST['firstname']));
    $lastname = $db->real_escape_string(htmlspecialchars($_POST['lastname']));
    $usernmNEW = $db->real_escape_string(htmlspecialchars($_POST['user']));
    $passwd = $db->real_escape_string(htmlspecialchars($_POST['pass']));

    $update_profile = "UPDATE accountdata SET S_Firstname = '$firstname', S_Lastname = '$lastname', S_Username = '$usernmNEW' WHERE S_Username = '$usernm'";
    if ($db->query($update_profile) === TRUE) {
        echo "<script>alert('Profile updated successfully');</script>";
    } else {
        echo "Error updating profile: " . $db->error;
    }

    if (!empty($passwd) && isset($passwd)) {
        $update_password = "UPDATE accountdata SET S_Password = '$passwd' WHERE S_Username = '$usernmNEW'";
        if ($db->query($update_password) === TRUE) {
            echo "<script>alert('Password updated successfully');</script>";
        } else {
            echo "Error updating password: " . $db->error;
        }
    }
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
        <title>Profile Edit - Coop</title>
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
            .edit_box {
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

            .edit_box img {
                width: 128px;
                border-radius: 50%;
                margin-bottom: 20px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                transition: 0.3s;
            }
            .edit_box img:hover {
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            }
            .edit_box input[type="submit"] {
                width: 10em;
                padding: 10px;
                border: none;
                border-radius: 5px;
                background-color: #007bff;
                color: white;
                font-size: 18px;
                cursor: pointer;
                margin-top: 20px;
            }
            .edit_box button {
                width: 12em;
                padding: 8px;
                border: none;
                border-radius: 5px;
                background-color: #007bff;
                color: white;
                font-size: 14px;
                cursor: pointer;
            }
            .edit_box label {
                display: block;
                margin-bottom: 10px;
                font-weight: bold;
                text-align: left;
            }
            .edit_box input[type="text"],
            .edit_box input[type="password"] {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 16px;
            }
            .edit_box input[type="text"]:focus,
            .edit_box input[type="password"]:focus {
                border-color: #007bff;
                outline: none;
                box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            }
            .edit_box input[type="submit"].delacc {
                background-color: #ff4066;
            }
            .edit_box input[type="submit"].delacc:hover {
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
                .edit_box button {
                    font-size:10px;
                }
                .edit_box {
                    width:380px;
                }
                .edit_box input[type="submit"] {
                    width: 8em;
                    font-size:0.9em;
                }
                .edit_box p {
                    font-size: 24px;
                    font-weight: bold;
                }
                .edit_box p.username {
                    font-size: 18px;
                    font-weight: 300;
                }
                .edit_box label {
                    font-size:0.8em;
                }
                .edit_box input[type="text"],
                .edit_box input[type="password"] {
                    width: 100%;
                    padding: 10px;
                    margin: 10px 0;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    font-size: 12px;
                }
                .edit_box input[type="text"]:focus,
                .edit_box input[type="password"]:focus {
                    border-color: #007bff;
                    outline: none;
                    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
                }
            }
        </style>
        <script>
            function sendURL() {
                const url = prompt("Please enter the image URL:");
                if (url) {
                    const xhr = new XMLHttpRequest();
                    xhr.open("POST", "upload_url.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.send("url=" + encodeURIComponent(url));
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            alert("Image uploaded!");
                        }
                    };
                } else {
                    alert("No URL entered.");
                }
            }
        </script>
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
        <div class="edit_box">
            <img src="<?php echo $info_user['S_ProfileIMG']?>" alt="<?php echo $info_user['S_Username']?>'s profile picture"></img>
            <button onclick="sendURL()">Change Profile Picture</button></br>
            <form method="post" action="">
                <label>Full name:</label>
                <input type="text" name="firstname" placeholder="<?php echo $info_user['S_Firstname']?>" value="<?php echo $info_user['S_Firstname']?>"/>
                <input type="text" name="lastname" placeholder="<?php echo $info_user['S_Lastname']?>" value="<?php echo $info_user['S_Lastname']?>"/></br></br>
                <label>Username and Password:</label>
                <input type="text" name="user" placeholder="<?php echo $info_user['S_Username']?>" value="<?php echo $info_user['S_Username']?>"/></br>
                <input type="password" name="pass" placeholder="New Password" /></br>
                <input type="submit" name="savechanges" value="Save Changes" />
            </form>
            <form method="" action="deleteaccount.php">
                <input type="submit" name="deleteaccount" value="Delete Account" class="delacc"/>
            </form>
        </div>
    </section>
    </body>
</html>