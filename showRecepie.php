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
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['category'])){
    $category = $_GET['category'];

}


// Veritabanından liste verilerini çekme
$sql = "SELECT * FROM recepies WHERE category = '$category'";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html>
<head>
  <title>listAlicious | <?=$category?></title>
  <link rel="stylesheet" href="style/mainPage.css">
    <link rel="stylesheet" href="style/tarifler.css">
    <link rel="stylesheet" href="style/tarifEkle.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <style>
    h1 {
     
      font-weight: lighter;
    }
    b{
        font-size: 100px; 
        font-weight:lighter ;
        font-family:'Inter';
        color:rgb(54, 1, 92);
        text-shadow: 1px 1px 1px #d47e37, 2px 2px 1px #d1a582;
    }

            
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
            border:10px  solid rgba(255, 255, 255, .5);;
            border-radius:30px;
            background: transparent;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 30px rgba(0, 0, 0, .5);
            overflow: hidden;
            margin-top:7%;
            margin-left: auto;
            margin-right: auto;
            margin-block: 10px 20px;
            writing-mode: horizontal-tb;"
            border-image:linear-gradient(var(--angle),#54E6E7,#9EDFD3,#AAC6C6)1;
            animation: 2s rotate linear infinite;
        }
        @property --angle{
            syntax:'<angle>';
            initial-value:0deg;
            inherits:false;
        }
        @keyframes rotate{
            to{
                --angle:360deg;
            }
        }

        .center-button {
        display: flex;
        justify-content: center;
    }
           
       
       

  </style>
  <link rel="stylesheet" href="myList.css">
  <link rel="stylesheet" href="default.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>
<?php
if ($category == 1) {
    $category="Aperatifler";
} elseif ($category == 2) {
    $category="Çorbalar";
}elseif ($category == 3) {
    $category="Et Yemekleri";
}elseif ($category == 4) {
    $category="Hamur İşi Tarifleri";
}elseif ($category == 5) {
    $category="Salata ve Mezeler";
}elseif ($category == 6) {
    $category="Tatlılar";
}elseif ($category == 7) {
    $category="Sebze Yemekleri";
}
?>


<h1 style="font-size:80px; font-family:'Inter';font-weight:lighter ;text-align: center;"><a href="deneme.html" style="text-decoration: none;font-family:'Inter';font-weight:lighter ; color:rgb(54, 1, 92);">list<b>A</b>licious</a> | <?=$category?></h1>
 
<?php 
if ($result && mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $title = $row['title'];
                $ingredientsList = $row["ingredientsList"];
                $ingredients = explode("\n", $ingredientsList);
                $text = $row['text'];
        ?>
        <div>
            <div class="box" >
                <table class="table table-borderless" >
                    <tr >
                        <td><h2><?=$title?></h2></td>
                            
                    </tr>
                    <tr>
                        <td>Malzemeler</td>
                    </tr>
                        
                        <?php
                        
                        foreach ($ingredients as $ingredient) {
                            $ingredient = trim($ingredient);
                            if (!empty($ingredient)) {
                                ?>
                    <tr>
                                
                        
                        <td>
                            <form action="addList.php?category=<?=urlencode($category)?>" method ="POST">
                                <input  name="ingredientListInput" value="<?=$ingredient?>">
                                
                                <input type="hidden" name="user_id" value="<?=$user_id?>">
                                
                                            
                                <button class="btn-outline-danger " type="submit" name="addList">ekle</button>
                            </form>
                        </td>
                        
                         
                    
                        
                                       
                                    
                    </tr> 
                    
                            
                                <?php
                            }
                        }?>
                    <tr><td>Tarifin yapılışı: <?=$text?></td></tr>
                        
                            
                            
                            
                            
                        

                </table>
                    
            </div>
                
        </div>   

        <?php
            }
        } else {
            echo "There is no available data";
        } ?>
</body>
</html>

