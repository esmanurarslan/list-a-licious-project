<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "account";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}

// Form gönderildiğinde çalışacak kod
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["eposta1"];
    $password = $_POST["sifre1"];

    // Veritabanında eşleşme kontrolü
    $stmt = $conn->prepare("SELECT * FROM account WHERE email = :eposta1 AND password = :sifre1");
    $stmt->bindParam(':eposta1', $email);
    $stmt->bindParam(':sifre1', $password);
    $stmt->execute();
    $count = $stmt->rowCount();

    if ($count > 0) {
        // Eşleşme varsa yönlendirme
        header("Location: deneme.html");
        exit;
    } else {
        // Eşleşme yoksa hata mesajı
        echo "Hatalı e-posta veya parola";
    }
}
?>









