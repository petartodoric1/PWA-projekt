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

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = $_POST['lozinka'];
    
    $stmt = $conn->prepare("SELECT lozinka, ime FROM korisnik WHERE korisnicko_ime = ?");
    $stmt->bind_param("s", $korisnicko_ime);
    $stmt->execute();
    $stmt->bind_result($hashed_password, $ime);
    
    if ($stmt->fetch()) {
        if (password_verify($lozinka, $hashed_password)) {
            $_SESSION['korisnicko_ime'] = $korisnicko_ime;
            header("Location: administrator.php");
            exit();
        } else {
            $error = "Neispravna lozinka.";
        }
    } else {
        $error = "Neispravno korisničko ime.";
    }
    
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>
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
        <h2>Prijava</h2>
        <?php if ($error): ?>
            <p style="color:red;"><?php echo $error; ?></p>
            <p><a href="registracija.php">Registrirajte se ovdje</a>.</p>
        <?php endif; ?>
        <form action="login_skripta.php" method="post">
            <label for="korisnicko_ime">Korisničko ime:</label>
            <input type="text" id="korisnicko_ime" name="korisnicko_ime" required><br>
            
            <label for="lozinka">Lozinka:</label>
            <input type="password" id="lozinka" name="lozinka" required><br>
            
            <input type="submit" value="Prijavi se">
        </form>
    </main>
    <footer>
    <p>Petar Todorić | ptodoric@tvz.hr | 2024</p>
    </footer>
</body>
</html>
