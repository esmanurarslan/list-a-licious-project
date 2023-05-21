<?php
// Oturumu sonlandırma ve yönlendirme
session_start();
session_unset();
session_destroy();
header("Location: mainPage.html");
exit;
?>
