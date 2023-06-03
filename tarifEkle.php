<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/mainPage.css">
    <link rel="stylesheet" href="style/tarifler.css">
    <link rel="stylesheet" href="style/tarifEkle.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Document</title>
   

</head>
<body>
<h1 style="font-size:100px; font-family:'Inter';font-weight:lighter ;"><a href="deneme.html" style="text-decoration: none;font-family:'Inter';font-weight:lighter ;">EcoShop</a> | Tarif Ekle</h1>

<div class="mb-3">
    <form method="POST">
        <div class="ekle-box">
            <label for="title" class="form-label">Başlık:</label><br>
            <input type="text" class="form-control" name="title" required><br>
            <input type="hidden" id="ingredientListInput" name="ingredientListInput" value="">
            <ul id="ingredientsList" name="ingredientsList"></ul>

            <label for="ingredientAmount" class="form-label">Malzeme Miktarı:</label>
            <input type="text" class="form-control" id="ingredientAmount">
            <label for="ingredientName" class="form-label">Malzeme Adı:</label>
            <input type="text" class="form-control" id="ingredientName">
            <div class="center-button">
                <button type="button" class="btn btn-primary mb-3" style="margin-inline: auto;" onclick="addIngredient()">Ekle</button><br><br>
            </div>
            <label for="text" class="form-label">Tarifin Yapılışı:</label><br>
            <textarea id="text" class="form-control" rows="10" name="text" required></textarea><br>
            
            <select id="category" name="category" required>
                <option value='1'>Aperatifler</option>
                <option value='2'>Çorbalar</option>
                <option value='3'>Et Yemekleri</option>
                <option value='4'>Hamur İşi Tarifleri</option>
                <option value='5'>Salata ve Mezeler</option>
                <option value='6'>Tatlılar</option>
                <option value='7'>Sebze Yemekleri</option>
            </select>
            

            <div class="center-button">
                <button type="submit" class="btn btn-primary mb-3" name="kaydet" style="margin-inline: auto;">Kaydet</button>
                <div class="mesaj">
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Veritabanı bağlantısı yapılır (veritabanı bilgilerini güncellemeniz gerekebilir)
                    $servername = "localhost";
                    $username = "root";
                    $password = "root";
                    $dbname = "account";
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Bağlantı kontrol edilir
                    if ($conn->connect_error) {
                        die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
                    }
                    if (isset($_POST["kaydet"])){
                        // Formdan gelen verileri al
                        $title = isset($_POST["title"]) ? $_POST["title"] : '';
                       
                        $ingredientsListInput = isset($_POST["ingredientListInput"]) ? $_POST["ingredientListInput"] : '';
                        $ingredientsList = explode(",", $ingredientsListInput);
                        $ingredientsListText = implode("\n", $ingredientsList);


                        $text = isset($_POST["text"]) ? $_POST["text"] : '';
                        $category = isset($_POST["category"]) ? $_POST["category"] : '';

                        // Veriler veritabanına eklenir
                        $sql = "INSERT INTO recepies (title, ingredientsList,text, category) VALUES ('$title','$ingredientsListText','$text', '$category')";

                        if ($conn->query($sql) === TRUE) {
                            echo "Veriler başarıyla kaydedildi";
                        } else {
                            echo "Veri kaydetme hatası: " . $conn->error;
                        }
                    }

                    // Veritabanı bağlantısı kapatılır
                    $conn->close();
                }
            ?>
            </div>
            </div>
        </div>
    </form>
</div>

<script>
    function addIngredient() {
        var amount = document.getElementById('ingredientAmount').value;
        var name = document.getElementById('ingredientName').value;

        if (amount !== "" && name !== "") {
            var ingredient = document.createElement('li');
            ingredient.innerText = amount + ' - ' + name;

            document.getElementById('ingredientsList').appendChild(ingredient);

            // Update hidden input value
            var ingredientListInput = document.getElementById('ingredientListInput');
            var currentList = ingredientListInput.value;
            var updatedList = currentList + ',' + amount + ' - ' + name;
            ingredientListInput.value = updatedList;

            // Clear the input fields
            document.getElementById('ingredientAmount').value = "";
            document.getElementById('ingredientName').value = "";
        }
    }
</script>





<div class="footer" style="text-align: center;font-family:'Inter';font-weight:lighter ;">
        <hr >
          <p >contact us | <span class="circle">&copy;</span> 2023 Es^2 corporation | Bandirma</p>
</div>

    </body>
</html>