<?php
session_start();

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

// Provjeri je li korisnik prijavljen
if (!isset($_SESSION['korisnicko_ime'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['odjava'])) {
    session_unset(); // Unisti sesiju
    session_destroy();
    header("Location: login.php"); // Preusmjeri na login stranicu nakon odjave
    exit();
}

// Provjeri ima li korisnik administratorska prava
$korisnicko_ime = $_SESSION['korisnicko_ime'];
$stmt = $conn->prepare("SELECT admin, ime FROM korisnik WHERE korisnicko_ime = ?");
$stmt->bind_param("s", $korisnicko_ime);
$stmt->execute();
$stmt->bind_result($admin, $ime);
$stmt->fetch();
$stmt->close();

if ($admin != 1) {
    echo "Pozdrav, $ime. Nemate administratorska prava.";
    exit();
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM articles WHERE id=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
    $stmt->close();
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $naslov = $_POST['naslov'];
    $sazetak = $_POST['sazetak'];
    $tekst = $_POST['tekst'];
    $kategorija = $_POST['kategorija'];
    $arhiva = isset($_POST['arhiva']) ? 1 : 0;
    
    $stmt = $conn->prepare("UPDATE articles SET naslov=?, sazetak=?, tekst=?, kategorija=?, arhiva=? WHERE id=?");
    $stmt->bind_param("ssssii", $naslov, $sazetak, $tekst, $kategorija, $arhiva, $id);
    
    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
}

$stmt = $conn->prepare("SELECT id, naslov, sazetak, tekst, kategorija, arhiva FROM articles ORDER BY datum DESC");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracija</title>
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
        <h1>Administracija</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naslov</th>
                    <th>Sažetak</th>
                    <th>Tekst</th>
                    <th>Kategorija</th>
                    <th>Arhiva</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $skraceni_tekst = substr($row['tekst'], 0, 15);
                        $skraceni_sazetak = substr($row['sazetak'], 0, 15);

                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['naslov'] . "</td>";
                        echo "<td>" . $skraceni_sazetak . "</td>";
                        echo "<td>" . $skraceni_tekst . "</td>";
                        echo "<td>" . $row['kategorija'] . "</td>";
                        echo "<td>" . ($row['arhiva'] ? 'Da' : 'Ne') . "</td>";
                        echo "<td>";
                        echo "<form method='post' class='adminforma' style='display:inline;'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<input type='submit' class='admingumb' name='delete' value='Izbriši'>";
                        echo "</form>";
                        echo "<form method='post' action='update.php' style='display:inline;'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<input type='submit' name='edit' value='Uredi'>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Nema vijesti za administraciju.";
                }
                ?>
            </tbody>
        </table>

        <form style="box-shadow: none;"action="" method="post">
            <input type="submit" name="odjava" value="Odjavi se">
        </form>
    </main>
    <footer>
    <p>Petar Todorić | ptodoric@tvz.hr | 2024</p>
    </footer>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
