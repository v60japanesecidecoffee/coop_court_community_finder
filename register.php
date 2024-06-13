<?php
session_unset();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'myminorprojdb';
$db = new mysqli($servername, $username, $password, $dbname) or die("Connection failed:");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $usernm = htmlspecialchars($_POST['user']);
    $passwd = htmlspecialchars($_POST['pass']);
    $email_error = $username_error = '';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email.";
    } else {
        $checkdupe = $db->prepare("SELECT S_Email FROM accountdata WHERE S_Email = ?");
        $checkdupe->bind_param("s", $email);
        $checkdupe->execute();
        $checkdupe->store_result();
        if ($checkdupe->num_rows > 0) {
            $email_error = "Email is already taken!";
            echo "<script>alert('Email is already taken!');</script>";
        }
        $checkdupe->close();
    }
    $checkdupe = $db->prepare("SELECT S_Username FROM accountdata WHERE S_Username = ?");
    $checkdupe->bind_param("s", $usernm);
    $checkdupe->execute();
    $checkdupe->store_result();
    if ($checkdupe->num_rows > 0) {
        $username_error = "Username is already taken.";
        echo "<script>alert('Username is already taken!');</script>";
    }
    $checkdupe->close();
    if (empty($email_error) && empty($username_error)) {
        $query = "INSERT INTO accountdata (S_Firstname, S_Lastname, S_Email, S_Username, S_Password) VALUES ('$firstname', '$lastname','$email','$usernm','$passwd')";
        mysqli_query($db, $query) or die(mysqli_error($db));
        echo "<script>alert('Registration successful');</script>";
    }
$db->close();
}
?>
<html lang="en">
<head>
    <title>Account Registration - Coop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="register_style.css">
</head>
<body>
    <div class="login_box">
    <form method="post" action="">
        <label>Full name:</label>
        <input type="text" name="firstname" placeholder="First Name" required/>
        <input type="text" name="lastname" placeholder="Last Name"/></br>
        <input type="email" id="email" class="email "name="email" placeholder="Email" required/></br></br>
        <label>Username and Password:</label>
        <input type="text" name="user" placeholder="New Username" required/></br>
        <input type="password" name="pass" placeholder="New Password" required/></br>
        <input type="submit" name="register" value="Register" />
        </p>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a><p>
    </div>
</body>
</html>