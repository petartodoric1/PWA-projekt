<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vijesti";

// Kreiraj konekciju
$conn = new mysqli($servername, $username, $password, $dbname);

// Provjeri konekciju
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$kategorija = $_GET['kategorija'];
$sql = "SELECT id, naslov, sazetak, slika FROM articles WHERE kategorija='$kategorija' ORDER BY datum DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $kategorija; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
    <div class="logo">
            <img class="logos" src="slike/Stern_Logo.png" alt="Logo">
            
        </div>
        <div class="heder">
        <h1 class="stern">stern</h1>
        <nav class="navigacijaclanak">
            <ul>
            <li><a href="index.php">Home</a></li>
                <li><a href="kategorija.php?kategorija=Politika">Politika</a></li>
                <li><a href="kategorija.php?kategorija=Ostalo">Ostalo</a></li>
                <li><a href="administrator.php">Administracija</a></li>
                <li><a href="unos.html">Unos</a></li>
            </ul>
        </nav>
        </div>
    </header>
    <main>
        <section class="articles-category">
            <h2><?php echo $kategorija; ?> ></h2>
            <div class="articles-row">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<article>";
                        echo "<img src='" . $row['slika'] . "' alt='Article Image'>";
                        echo "<h3><a href='clanak.php?id=" . $row['id'] . "'>" . $row['naslov'] . "</a></h3>";
                        echo "<p>" . $row['sazetak'] . "</p>";
                        echo "</article>";
                    }
                } else {
                    echo "Nema vijesti u ovoj kategoriji.";
                }
                ?>
            </div>
        </section>
    </main>
    <footer>
    <p>Petar Todorić | ptodoric@tvz.hr | 2024</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
