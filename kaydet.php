<?php
// Veritabanı bağlantısı kurma
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "account";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Hata modunu ayarlama
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    // Form verilerini al
    $email = $_POST['eposta'];
    $password = $_POST['sifre'];
    $username = $_POST['kullaniciAdi'];
  
    // SQL sorgusunu hazırlama
    $stmt = $conn->prepare("INSERT INTO account (email, password, username) VALUES (:eposta, :sifre,:kullaniciAdi)");
    $stmt->bindParam(':eposta', $email);
    $stmt->bindParam(':sifre', $password);
    $stmt->bindParam(':kullaniciAdi', $username);
  
    // Sorguyu çalıştırma
    $stmt->execute();
  
    echo "Yeni kayıt başarıyla eklendi";
  } catch(PDOException $e) {
    echo "Hata: " . $e->getMessage();
  }
  
  $conn = null;
  ?> 

