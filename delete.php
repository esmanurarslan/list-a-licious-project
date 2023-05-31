<?php
// Database bağlantısını yapalım
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "account";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Silinecek öğeyi get parametresinden alalım
$itemName = $_GET["item"];

// myList tablosundan öğeyi silelim
$sql = "DELETE FROM myList WHERE items = '$itemName'";
$result = $conn->query($sql);

if ($result) {
    // Başarılı bir şekilde silindiğinde geri dönüş yapalım
    header("Location: myList.php");
    exit();
} else {
    // Silme işlemi başarısız olduğunda hata mesajı gönderelim
    echo "Silme işlemi başarısız oldu.";
}

$conn->close();
?>
