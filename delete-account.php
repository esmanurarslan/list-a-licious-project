<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "account";

try {
    // Oturumu başlat
    session_start();

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}

// Hesap silme işlemi
if (isset($_POST['delete_account'])) {
    // Kullanıcının oturum bilgilerini al
    $user = $_SESSION['user'];
    $userId = $user['id'];

    // Veritabanından hesabı sil
    $stmt = $conn->prepare("DELETE FROM account WHERE id = :userId");
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();

    // Oturumu sonlandır ve yönlendir
    session_destroy();
    header("Location: mainPage.html");
    exit;
}
?>