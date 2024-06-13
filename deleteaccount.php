<?php
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'myminorprojdb';
$db = new mysqli($servername, $username, $password, $dbname) or die("Connection failed:");
if (isset($_SESSION['username'])) {
    $usernm = $_SESSION['username'];
} else {
    die("User not logged in.");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $delete = "DELETE FROM accountdata WHERE S_Username = '$usernm'";
    if ($db->query($delete) === TRUE) {
        session_unset(); 
        session_destroy();
        header("Location: login.php");
        exit();
        echo "<script>alert('Account Deletion Successful!');</script>";
    } else {
        echo "<script>alert('Failed to delete account. Please try again later.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account - Coop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f7ff;
            min-height: 100vh;
            margin: 0;
            text-align:center;
        }
        input[type="submit"] {
            width: 12em;
            padding: 10px;
            border: none;
            border-radius: 7px;
            background-color: #007bff;
            color: white;
            font-size: 18px;
            height:3em;
            cursor: pointer;
        }
        input[type="submit"].delete {
            background-color: #ff4066;
        }
        input[type="submit"]:hover {
            background-color: #135ead;
        }
        input[type="submit"].delete:hover {
            background-color: #e60935;
        }
        section {
            display:flex;
            flex-wrap:wrap;
            justify-content:center;
            gap:20px 30px;
        }
        @media only screen and (max-width: 600px) {
            h2 {
                font-size:1.2em;
            }
            input[type="submit"] {
                width: 10em;
                font-size: 14px;
                height:3em;
            }
        }
        </style>
</head>
<body>
    <h2>Are you sure you want to delete your account?</h2>
    <section>
        <form method="post" action="">
            <input type="submit" name="deleteaccount" value="Delete" class="delete"/>
        </form>
        <form method="" action="profileedit.php">
            <input type="submit" name="profileedit" value="Cancel"/>
        </form>
    </section>
</body>
</html>
