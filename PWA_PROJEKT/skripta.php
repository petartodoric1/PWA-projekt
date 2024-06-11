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

// Preuzimanje podataka iz forme
$naslov = $_POST['naslov'];
$sazetak = $_POST['sazetak'];
$tekst = $_POST['tekst'];
$kategorija = $_POST['kategorija'];
$arhiva = isset($_POST['arhiva']) ? 1 : 0;

// Upload slike
$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}
$uploadFile = $uploadDir . basename($_FILES['slika']['name']);

if (move_uploaded_file($_FILES['slika']['tmp_name'], $uploadFile)) {
    $slika = $uploadFile;
} else {
    echo "Error uploading image.";
    exit;
}

// SQL za unos podataka
$sql = "INSERT INTO articles (naslov, sazetak, tekst, kategorija, slika, arhiva)
VALUES ('$naslov', '$sazetak', '$tekst', '$kategorija', '$slika', '$arhiva')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    // Preusmjeravanje na članak
    $last_id = $conn->insert_id;
    header("Location: clanak.php?id=$last_id");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

