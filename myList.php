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
$sql = "SELECT items FROM myList WHERE account_id = '$user[id]'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
  <title>EcoShop | Listelerim</title>
  <style>
    h1 {
      font-size: 200px;
      font-weight: lighter;
    }
    
  </style>
  <link rel="stylesheet" href="myList.css">
  <link rel="stylesheet" href="default.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100&display=swap" rel="stylesheet">
</head>
<body>
<h1 style="font-size:100px; font-family:'Inter';font-weight:lighter ;"><a href="deneme.html" style="text-decoration: none;font-family:'Inter';font-weight:lighter ;">EcoShop</a> | Alışveriş Listem</h1>
 
  <form id="add-item-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <label for="item">Listeye ürün ekle:</label>
    <input type="text" id="item" name="item">
    <button type="submit" name="add">Ekle</button>
   
  </form>
  
  <ul id="shopping-list">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row["items"] . "<a class='delete-item'>×</a></li>";
        }
    } else {
        echo "<li>Liste boş.</li>";
    }
    ?>
  </ul>
  <div class="footer">
        <hr >
          <p style="text-align: center;">contact us | <span class="circle">&copy;</span> 2023 Es^2 corporation | Bandirma</p>
      </div>

      
</body>
</html>

<?php
// Form verilerini almak ve veritabanına eklemek
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add"])) {
        $item = $_POST["item"]; // Formdaki ürün adı alanından değeri al
        header("Refresh:0");
         
        
        // Veritabanına ekleme işlemi
        $sql = "INSERT INTO myList (items, account_id)
        VALUES ('$item', '$user[id]')";
        if ($conn->query($sql) === TRUE) {
          
           
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST["save"])) {
        // Tüm listeyi kaydetme işlemi
        $listItems = $_POST["listItems"]; // Hidden input ile gizli olarak gönderilen liste öğelerini al
        
        // Her bir öğeyi myList tablosuna eklemek için döngü
        foreach ($listItems as $item) {
            $item = $conn->real_escape_string($item); // Güvenlik için veri temizleme
            $sql = "INSERT INTO myList (items, account_id)
            VALUES ('$item', '$user[id]')";
            $conn->query($sql);
        }
        
        echo "Liste başarıyla kaydedildi.";
    }
}

$conn->close();
?>

