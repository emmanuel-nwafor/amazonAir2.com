<?php
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "search_engine"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['query'])) {
    $search_query = $_GET['query'];

    $search_query = $conn->real_escape_string($search_query);

    $sql = "SELECT * FROM articles WHERE title LIKE '%$search_query%' OR content LIKE '%$search_query%'";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>airPurity.com</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<center>
<form action="" method="GET">
        <input type="text" name="query" placeholder="Search..." value="<?php echo isset($_GET['query']) ? $_GET['query'] : ''; ?>" required id="search">
        <input type="submit" value="Search" id="formButton">
    </form>

    <?php if (isset($result)): ?>
        <!-- <h2>Search Results:</h2> -->
        <?php if ($result->num_rows > 0): ?>
            <ul>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <li>
                        <h3><?php echo $row['title']; ?></h3>
                        <p><?php echo $row['content']; ?></p>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No results found for '<?php echo htmlspecialchars($search_query); ?>'</p>
        <?php endif; ?>
    <?php endif; ?>

    <?php
    $conn->close();
    ?>
</center>
</body>
</html>
