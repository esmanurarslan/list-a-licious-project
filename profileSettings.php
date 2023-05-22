<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Ayarları | EcoShop</title>
    <link rel="stylesheet" href="profileSettings.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100&display=swap" rel="stylesheet">

</head>
<body>
    
    <h1 style="font-size:200px;font-family:'Inter';font-weight:lighter;"><a href="deneme.html" style="text-decoration: none;">EcoShop</a>| Profil Ayarları </h1> 
    
    <body>
      <?php 
        session_start();
        if(empty($_SESSION['user'])){
          echo 'kullanıcı bulunamadı';
          exit();

        }
        $user = $_SESSION['user'];

      ?>

      <div class="container">  
        <h1>Profil Ayarları</h1>
        <form method="POST" action="login.php">
          <div class="input-box">
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>
          </div>
          <div class="input-box">
            <label for="email">E-Mail:</label>
            <input type="text" id="email" name="email" value="<?php echo $user['email']; ?>" required>
          </div>  
          <div class="input-box">
            <label for="password">Şifre:</label>
            <input type="password" id="password" name="password" required>
          </div>  
          <div class="input-box">
            <label for="new_password">Yeni Şifre:</label>
            <input type="password" id="new_password" name="new_password">
          </div>  
          <div class="buton"> 
            <input type="submit" value="Değişikliği Kaydet">
          </div> 
        </form>
        <div class="buton"> 
        <form method="POST" action="delete_account.php" onsubmit="return confirm('Hesabınızı silmek istediğinize emin misiniz?');">
            <input type="submit" value="Hesabı Sil">
        </form>
        </div>
      </div>
  </body>

    <div class="footer">
      <hr >
        <p style="text-align: center;">contact us | <span class="circle">&copy;</span> 2023 Es^2 corporation | Bandirma</p>
    </div>
</body>
</html>