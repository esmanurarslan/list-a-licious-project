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

// Parola değiştirme formu gönderildiğinde çalışacak kod
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kullanıcının oturum bilgilerini al
    $user = $_SESSION['user'];
    $userId = $user['id'];

    $currentPassword = $_POST["password"];
    $newPassword = $_POST["new_password"];

    // Kullanıcının mevcut parolasını kontrol et
    $stmt = $conn->prepare("SELECT * FROM account WHERE id = :userId AND password = :currentPassword");
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':currentPassword', $currentPassword);
    $stmt->execute();
    $count = $stmt->rowCount();

    if ($count > 0) {
        // Mevcut parola doğru ise, yeni parolayı güncelle
        $stmt = $conn->prepare("UPDATE account SET password = :newPassword WHERE id = :userId");
        $stmt->bindParam(':newPassword', $newPassword);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        //echo "Parola başarıyla değiştirildi.";
        header("Location: mainPage.html");
    } else {
        // Mevcut parola yanlış ise, hata mesajı ver
        echo "Mevcut parola yanlış.";
    }
}
?>