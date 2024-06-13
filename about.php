<?php
session_start();
$current_page = basename($_SERVER['PHP_SELF']);
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About - Coop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f7ff;
            min-height: 100vh;
            margin: 0;
        }
        section {
            padding:20px;
            margin-left:10%;
            margin-right: 10%;
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
        h2 {
            font-size:1.5em;
        }
        p {
            margin-bottom: 20px;
            line-height: 1.6;
            font-size:1.2em;
        }
        .social-icons {
            display: flex;
            align-items: center;
        }
        .social-icons a {
            margin-right: 10px;
            color: #001f4d;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .social-icons a:hover {
            color: #003380;
        }
        @media only screen and (max-width: 600px) {
            header {
                height: 36px;
            }
            header a {
                font-size: 0.6em;
            }
            h2 {
                font-size: 1.1em;
            }
            h1 {
                font-size: 1.1em;
            }
            p {
                font-size:0.9em;
            }
            li {
                font-size:0.9em;
            }
            img {
                width:24px;
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
        <h2>About Us</h2>
        <p>Welcome to Coop! Our main goal as a service is to become the hub for all badminton enthusiasts across the globe. From providing a platform for searching badminton courts, to providing a place where badminton enthusiasts from different parts of the world can come together as one and become a community!</p>
        <p>We are not sponsored or run by any government entitiy.</p>
    </br>
        <h2>Contact Us</h2>
        <p>If you have any questions, feedback, or inquiries, feel free to reach out to us:</p>
        <ul>
            <li>Email: contact.coop@gmail.com</li>
            <li>Phone: +62 021-1111-2222</li>
            <li>Address: 25 Olympic-ro, Songpa District, Seoul, South Korea</li>
        </ul>
    </br>
        <h2>Connect with Us</h2>
        <div class="social-icons">
            <a href="https://www.facebook.com/"><img src="https://cdn-icons-png.freepik.com/256/15707/15707770.png?semt=ais_hybrid" alt="Facebook" style="width:32px"></a>
            <a href="https://x.com/"><img src="https://cdn.iconscout.com/icon/free/png-256/free-twitter-9420781-7651211.png" alt="Twitter" style="width:32px"></a>
            <a href="https://www.instagram.com/"><img src="https://cdn-icons-png.flaticon.com/512/1384/1384031.png" alt="Instagram" style="width:32px"></a>
        </div>
    </section>
</body>
</html>