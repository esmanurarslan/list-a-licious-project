<?php
session_start();

// Oturum kontrolü yapma
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Kullanıcı bilgilerini almak
$user = $_SESSION['user'];

// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "account";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Veritabanına bağlanılamadı: " . $conn->connect_error);
}

// Veritabanından liste verilerini çekme
$sql = "SELECT id FROM account WHERE id = '$user[id]'";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["addList"])) {
        $category = $_GET['category'];
        $item = $_POST["ingredient"]; // Tablodaki ürün adı alanından değeri al
        $item=ltrim($item, '-');
        
        header("Location: showRecepie.php?category=" . urlencode($category));
        

        
        // Veritabanına ekleme işlemi
        $sql = "INSERT INTO myList (items,account_id)
            SELECT '$item', '$user[id]'
            WHERE NOT EXISTS (
            SELECT 1
            FROM myList
            WHERE items = '$item' AND account_id = '$user[id]'
            )";
        if ($conn->query($sql) === TRUE) {
            
                echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js">
                    alert("Ürün başarıyla eklendi!");
                </script>';
        
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }
    } 
}

$conn->close();



?>