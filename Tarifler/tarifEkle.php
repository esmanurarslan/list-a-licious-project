<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="mainPage.css">
    <title>Document</title>
    <style>
            body{
        position: relative;
        background: radial-gradient(
        rgba(255, 31, 0, 0.2) 0%, rgba(250, 253, 87, 0.2) 100%), #E9E7B8;
        }
    </style>
</head>
<body>
<?php

// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "account";

$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
?>
   <div class="mb-3"> 
        <form method="POST" >
        
            <label for="title" class="form-label">Başlık:</label>
            <input type="text" class="form-control" id="title" name="title" required>
            
            <label for="text" class="form-label">Metin:</label>
            <textarea id="text" class="form-control" name="text" required></textarea>
            
            <label for="category" class="form-control">Kategori:</label>
            <select id="category" name="category"  required>
                <option value=" ">Kategori Seçin</option>
                <option value='1'>Aperatifler</option>
                <option value='2'>Çorbalar</option>
                <option value='3'>Et Yemekleri</option>
                <option value='4'>Hamur İşi Tarifleri</option>
                <option value='5'>Salata ve Mezeler</option>
                <option value='6' >Tatlılar</option>
                <option value='7' >Sebze Yemekleri</option>
            </select>
            
            <button type="submit" class="btn btn-primary mb-3">Kaydet</button>
       
        </form>
    </div>
<?php
    // Formdan gelen verileri alın
    $title = $_POST['title'];
    $text = $_POST['text'];
    $category = $_POST['category'];

    // Veritabanına yeni kaydı ekleme işlemi
    $query = "INSERT INTO recepies (title, text, category) VALUES ('$title', '$text', '$category')";
    
    // Sorguyu veritabanında çalıştırın
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo 'Kayıt başarıyla eklendi.';
    } else {
        echo 'Kayıt eklenirken bir hata oluştu: ' . mysqli_error($conn);
    }
}
elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['category'])) {
    $category = $_GET['category'];
        // Veritabanı bağlantısı
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "account";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Bağlantıyı kontrol et
    if ($conn->connect_error) {
        die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
    }
    else{

        // İlgili kaydı veritabanından çekmek için gerekli sorguyu oluşturun
        $query = "SELECT * FROM recepies WHERE category = $category";

        // Sorguyu veritabanında çalıştırın ve sonucu alın
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
?>

            <div class="card-body" id="">
                <?php
                    while ($row = $result->fetch_assoc()) {
                            
                        $title = $row['title'];
                        $text = $row['text'];
                ?>
                        <div class="-">
                            <h2 class="">
                                    <?=$title?>
                            </h2>
                            <div id="" class="" data-bs-parent="">
                                <div class="">
                                    <?=$text?>
                                </div>
                            </div>
                            <hr>
            </div>
<?php
                
                    }


        }else
        {
            echo "There is no available data";
        }
    
    }
        
}

    
// Diğer gerekli işlemler ve sayfa içeriği
?>
</body>
</html>
