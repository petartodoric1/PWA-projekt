<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
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
        <h2>Registracija</h2>
        <form action="registracija_skripta.php" method="post">
            <label for="korisnicko_ime">Korisničko ime:</label>
            <input type="text" id="korisnicko_ime" name="korisnicko_ime" required><br>
            
            <label for="ime">Ime:</label>
            <input type="text" id="ime" name="ime" required><br>

            <label for="prezime">Prezime:</label>
            <input type="text" id="prezime" name="prezime" required><br>
            
            <label for="lozinka">Lozinka:</label>
            <input type="password" id="lozinka" name="lozinka" required><br>
            
            <label for="lozinka2">Ponovite lozinku:</label>
            <input type="password" id="lozinka2" name="lozinka2" required><br>
            
            <input type="submit" value="Registriraj se">
        </form>
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <p style="color:green;">Uspješna registracija. <a href="login.php">Prijavite se ovdje</a>.</p>
        <?php endif; ?>
        <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
            <p style="color:red;">Lozinke nisu identične. Pokušajte ponovno.</p>
        <?php endif; ?>
    </main>
    <footer>
    <p>Petar Todorić | ptodoric@tvz.hr | 2024</p>
    </footer>
</body>
</html>
