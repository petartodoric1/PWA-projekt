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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $lozinka = $_POST['lozinka'];
    $lozinka2 = $_POST['lozinka2'];
    
    if ($lozinka !== $lozinka2) {
        header("Location: registracija.php?error=1");
        exit();
    }

    $hashed_password = password_hash($lozinka, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO korisnik (korisnicko_ime, lozinka, ime, prezime, admin) VALUES (?, ?, ?, ?, 0)");
    $stmt->bind_param("ssss", $korisnicko_ime, $hashed_password, $ime, $prezime);

    if ($stmt->execute()) {
        header("Location: registracija.php?success=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
