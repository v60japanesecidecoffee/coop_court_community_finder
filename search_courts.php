<?php
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'myminorprojdb';
$db = new mysqli($servername, $username, $password, $dbname) or die("Connection failed:");

$searchResultsCourts = [];
$searchResultsCommunities = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $searchQuery = isset($_POST['searchfor']) ? $_POST['searchfor'] : '';
    if ($searchQuery !== '') {
        // Search in courts
        $sql = "SELECT * FROM courts WHERE name LIKE ?";
        $stmt = $db->prepare($sql);
        $searchTerm = "%" . $searchQuery . "%";
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $searchResultsCourts[] = $row;
        }

        // Search in communities
        $sql = "SELECT * FROM communities WHERE name LIKE ? OR description LIKE ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $searchResultsCommunities[] = $row;
        }
    }
}
$current_page = basename($_SERVER['PHP_SELF']);
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search - Coop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f7ff;
            min-height: 100vh;
            margin: 0;
            color: #333;
        }
        .container {
            position: relative;
            width: 20em;
            height: 15em;
            margin: 0 auto;
            background: #000000;
            overflow: hidden;
            border-radius: 10px;
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
            flex-wrap: wrap;
            justify-content: flex-start;
            gap: 2em 2em;
            margin-right: 10%;
            margin-left: 10%;
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
        input[type="text"] {
            width: 80%;
            padding: 10px;
            margin-left: 10%;
            margin-right: 10%;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom:5%;   
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
        h3 {
            margin-left:10%;
            margin-right:10%;
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
            h3 {
                font-size:0.9em;
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
    <h2 class="section-title">Search for:</h2>
    <form method="post" action="">
        <input type="text" name="searchfor" placeholder="Search for courts or communities" />
    </form>
    <?php if (!empty($searchResultsCourts) || !empty($searchResultsCommunities)): ?>
    <h2 class="section-title">Search Results for '<?php echo htmlspecialchars($searchQuery); ?>'</h2>
    <h3>Courts</h3>
    <section>
        <?php if (!empty($searchResultsCourts)): ?>
            <?php foreach ($searchResultsCourts as $row): ?>
                <a href="courts.php?id=<?php echo $row['id']; ?>">
                    <div class="container">
                        <img src="<?php echo $row['imgurl']; ?>" style="width:100%"></img>
                        <div class="courtname">
                            <h1><?php echo $row['name']; ?></h1>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No courts found for '<?php echo htmlspecialchars($searchQuery); ?>'</p>
        <?php endif; ?>
    </section>
    <h3>Communities</h3>
    <section>
        <?php if (!empty($searchResultsCommunities)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($searchResultsCommunities as $row): ?>
                        <tr onclick="location.href='communitydetails.php?id=<?php echo $row['id']; ?>'">
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No communities found for '<?php echo htmlspecialchars($searchQuery); ?>'</p>
        <?php endif; ?>
    </section>
    <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <h2 class="section-title">No results found for '<?php echo htmlspecialchars($searchQuery); ?>'</h2>
    <?php endif; ?>
</body>
</html>