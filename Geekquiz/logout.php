<?php
session_start();
session_destroy();// Detruire la session
header('Location: index.php');
exit();
?>