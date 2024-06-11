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

$sql = "SELECT id, naslov, sazetak, kategorija, slika FROM articles WHERE arhiva = 0 ORDER BY datum DESC";
$result = $conn->query($sql);
?>
<?php


$articles_politika = array();
$articles_ostalo = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if ($row['kategorija'] == 'Politika') {
            $articles_politika[] = $row;
        } elseif ($row['kategorija'] == 'Ostalo') {
            $articles_ostalo[] = $row;
        }
    }
} else {
    echo "Nema vijesti.";
}


?>


<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naslovna stranica</title>
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
        <section class="politics">
            <h2>POLITIKA ></h2>
            <div class="articles-row">
                <?php
                if ($result->num_rows > 0) {
                    foreach ($articles_politika as $article) {
                        echo "<article>";
                        echo "<img src='" . $article['slika'] . "' alt='Article Image'>";
                        echo "<h5 class='article-h5'>" . $article['kategorija'] . "</h5>";
                        echo "<h3><a href='clanak.php?id=" . $article['id'] . "'>" . $article['naslov'] . "</a></h3>";
                        echo "</article>";
                    }
                    }
                 else {
                    echo "Nema vijesti u kategoriji politika.";
                }
                ?>
            </div>
        </section>
        <section class="health">
            <h2>OSTALO ></h2>
            <div class="articles-row">
                <?php
                if ($result->num_rows > 0) {
                    foreach ($articles_ostalo as $article) {
                        echo "<article>";
                        echo "<img src='" . $article['slika'] . "' alt='Article Image'>";
                        echo "<h5 class='article-h5'>" . $article['kategorija'] . "</h5>";
                        echo "<h3><a href='clanak.php?id=" . $article['id'] . "'>" . $article['naslov'] . "</a></h3>";
                        echo "</article>";
                    }
                    }
                 else {
                    echo "Nema vijesti u kategoriji zdravlje.";
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
