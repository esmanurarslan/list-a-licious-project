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
$sql = "SELECT items,account_id FROM myList WHERE account_id = '$user[id]'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
  <title>listAlicious | Listem</title>
  <style>
    h1 {
     
      font-weight: lighter;
    }
    a{
      color: rgb(54, 1, 92);
    }
    b{
      font-size: 150px; 
      font-weight:lighter ;
      font-family:'Inter';
      color:rgb(54, 1, 92);
      text-shadow: 2px 2px 1px #d47e37, 4px 4px 1px #d1a582;
    }
    
    
  </style>

  <link rel="stylesheet" href="style/myListt.css">
  <link rel="stylesheet" href="style/default.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>
<h1 style="font-size:130px; font-family:'Inter';font-weight:lighter ;"><a href="deneme.html" style="text-decoration: none;font-family:'Inter';font-weight:lighter ;color: rgb(54, 1, 92);">list<b>A</b>licious</a> | Listem</h1>
 <div>
  <form id="add-item-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <label for="item">Listeye ürün ekle:</label>
    <input type="text" id="item" name="item">
    <button type="submit" name="add">Ekle</button>
   
  </form>
  </div>
  <div class="shoplist">
  <ul id="shopping-list">
    <?php
    if ($result->num_rows > 0) {
      
        while ($row = $result->fetch_assoc()) {
          echo "<li>" . $row["items"] . "<a href='delete.php?item=" . $row["items"] . "'>×</a></li>";


        }
    } else {
        echo "<li>Liste boş.</li>";
    }
    ?>
  </ul>
  </div>
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
        $sql = "INSERT INTO myList (items,account_id)
        SELECT '$item', '$user[id]'
        WHERE NOT EXISTS (
          SELECT 1
          FROM myList
          WHERE items = '$item' AND account_id = '$user[id]'
        )";
        if ($conn->query($sql) === TRUE) {
          
           
        } else {
            echo "Ürün listede mevcut";
        }
    } 
}

$conn->close();
?>

