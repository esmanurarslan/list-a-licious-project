<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Ayarları | EcoShop</title>
    <link rel="stylesheet" href="style/profileSettings.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <style>
    .container{
      width: 35%;
    }
  </style>
    

</head>

<body>


    <header>
    <h1 style="font-size: 100px; font-family:'Inter';font-weight:lighter ;"><a href="deneme.html" style="text-decoration: none;font-family:'Inter';font-weight:lighter ;">EcoShop</a> | Profil Ayarları</h1>
    </header>
    <?php 
        session_start();
        if(empty($_SESSION['user'])){
          echo 'kullanıcı bulunamadı';
          exit();
        
        }
        $user = $_SESSION['user'];
    ?>
      
      <div class="container"> 
        
        <h2>Kullanıcı Bilgileri</h2>
        <form method="POST" action="parolaDegis.php">

          <div class="input-box">
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>
          </div>
          <div class="input-box">
            <label for="email">E-Mail:</label>
            <input type="text" id="email" name="email" value="<?php echo $user['email']; ?>" required>
          </div>  

          <div class="change-password">
            <h2>Parolayı Güncelle</h2>
            <div class="input-box">
              
              <input type="password" id="password" name="password" required>
              <label for="password">Şifre:</label>
            </div>  
            <div class="input-box">
              
              <input type="password" id="new_password" name="new_password">
              <label for="new_password">Yeni Şifre:</label>
            </div>  
            <div class="input-box">
              
              <input type="password" id="new_password_again" name="new_password_again">
              <label for="new_password_again">Yeni Şifre Tekrar:</label>
            </div> 
            <div class="buton"> 
              <input type="submit" value="Değişikliği Kaydet">
            </div> 


          </div>

        </form>



        <div class="buton"> 


          <form method="POST" action="delete_account.php" onsubmit="return confirm('Hesabınızı silmek istediğinize emin misiniz?');">
              <input type="submit" name="delete_account" value="Hesabı Sil">
          </form>


        </div>

      </div>
      




      <div class="footer" >
        <hr >
          <p style="text-align: center;font-family:'Inter'">contact us | <span class="circle">&copy;</span> 2023 Es^2 corporation | Bandirma</p>
      </div>
</body>
</html>