<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="mainPage.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100&display=swap" rel="stylesheet">

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
<h1 style="font-size:100px; font-family:'Inter';font-weight:lighter ;"><a href="deneme.html" style="text-decoration: none;font-family:'Inter';font-weight:lighter ;">EcoShop</a> | Tarif Eke</h1>

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
            <input type="text" class="form-control" id="title" name="title" required><br>

            <label for="ingredients" class="form-label">Malzemeler:</label>
            <ul id="ingredientsList"></ul>
            <input type="text" class="form-control" id="ingredientInput" placeholder="Malzeme girin">
            <button type="button" class="btn btn-primary" onclick="addIngredient()">Malzeme Ekle</button>
            
            <br>
            
            <label for="text" class="form-label">Yapılış:</label>
            <textarea id="text" class="form-control" name="text" required></textarea>
            

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
        // Eklenen kaydın ID'sini alın
        $recepiesId = mysqli_insert_id($conn);

        // Malzemeleri alın
        $ingredients = explode("\n", $text);

        // Malzemeleri göstermek için bir liste oluşturun
        echo '<h3>Malzemeler:</h3>';
        echo '<ul>';
        foreach ($ingredients as $ingredient) {
            $ingredient = trim($ingredient);
            if (!empty($ingredient)) {
                echo '<li>' . $ingredient . '</li>';
            }
        }
        echo '</ul>';

        // Kaydedilen text alanını gösterin
        echo '<h3>Yapılış:</h3>';
        echo '<p>' . $text . '</p>';
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
            while ($row = $result->fetch_assoc()) {
                $title = $row['title'];
                $text = $row['text'];
        ?>
                <div class="-">
                    <h2 class=""><?=$title?></h2>
                    <div id="" class="" data-bs-parent="">
                        <ul>
                            <?php
                            $ingredients = explode("\n", $text);
                            foreach ($ingredients as $ingredient) {
                                $ingredient = trim($ingredient);
                                if (!empty($ingredient)) {
                                    echo '<li>' . $ingredient . '</li>';
                                }
                            }
                            ?>
                        </ul>
                        
                    </div>
                    <hr>
                </div>
        <?php
            }
        } else {
            echo "There is no available data";
        }
    
    }
        
}

    
// Diğer gerekli işlemler ve sayfa içeriği
?>
<div class="footer">
        <hr >
          <p style="text-align: center;">contact us | <span class="circle">&copy;</span> 2023 Es^2 corporation | Bandirma</p>
</div>

<script>
    function addIngredient() {
        var ingredientInput = document.getElementById("ingredientInput");
        var ingredientsList = document.getElementById("ingredientsList");
        var textArea = document.getElementById("text");

        var ingredientText = ingredientInput.value.trim();
        if (ingredientText !== "") {
            var listItem = document.createElement("li");
            listItem.textContent = ingredientText;
            ingredientsList.appendChild(listItem);
            ingredientInput.value = "";

            // Malzemeyi 'text' alanına ekleyin
            var textValue = textArea.value.trim();
            if (textValue !== "") {
                textValue += "\n"; // Yeni satır ekle
            }
            textValue += "- " + ingredientText;
            textArea.value = textValue;
        }
    }
</script>
</body>
</html>