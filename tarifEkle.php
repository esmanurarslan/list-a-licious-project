<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mainPage.css">
    <link rel="stylesheet" href="tarifler.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Document</title>
   
    <style>
            
        table{
            width:50%;
        }
        td{
            vertical-align: left;
        }
        .box{
            position: relative;
            --angle:0deg;
            width:50%;
            height:auto;
            
            border:10px  solid;
            
            border-radius:30px;
          
            margin-left:2%; 
            margin-top:4%;
            margin-block: 10px 20px;
            writing-mode: horizontal-tb;"
            border-image:linear-gradient(var(--angle),#54E6E7,#9EDFD3,#AAC6C6)1;
            animation: 2s rotate linear infinite;
        }

        .center-button {
        display: flex;
        justify-content: center;
    }  
    </style>
</head>
<body>
<h1 style="font-size:100px; font-family:'Inter';font-weight:lighter ;"><a href="deneme.html" style="text-decoration: none;font-family:'Inter';font-weight:lighter ;">EcoShop</a> | Tarif Ekle</h1>

   <div class="mb-3 "> 
        <form method="POST">
        <div class="ekle-box">
            <label for="title" class="form-label">Başlık:</label>
            <input type="text" class="form-control" name="title" required>

            <ul id="ingredientsList"></ul>

            <label for="text" class="form-label">Malzemeler ve Yapılışı:</label>
            <textarea id="text" class="form-control" rows="10" name="text" required></textarea>
            <script>
            var placeholderText = "Lütfen malzemeleri önlerine '-' işareti koyarak ve alt alta yazınız.Daha sonra alt paragrafa yapılışını ekleyiniz.";
            document.getElementById('text').setAttribute('placeholder', placeholderText);
            </script>

            <select id="category" name="category" required >
            
                <option value='1'>Aperatifler</option>
                <option value='2'>Çorbalar</option>
                <option value='3'>Et Yemekleri</option>
                <option value='4'>Hamur İşi Tarifleri</option>
                <option value='5'>Salata ve Mezeler</option>
                <option value='6'>Tatlılar</option>
                <option value='7'>Sebze Yemekleri</option>
            </select>
            <div class="center-button">
            <button type="submit" class="btn btn-primary mb-3" name="kaydet">Kaydet</button>
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
                        $text = isset($_POST["text"]) ? $_POST["text"] : '';
                        $category = isset($_POST["category"]) ? $_POST["category"] : '';

                        // Veriler veritabanına eklenir
                        $sql = "INSERT INTO recepies (title, text, category) VALUES ('$title', '$text', '$category')";

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
        </form>

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
    




<div class="footer" style="text-align: center;font-family:'Inter';font-weight:lighter ;">
        <hr >
          <p >contact us | <span class="circle">&copy;</span> 2023 Es^2 corporation | Bandirma</p>
</div>

    </body>
</html>