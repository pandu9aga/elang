<?php
session_start();
session_destroy();
header('Location:loginpn.php?pesan=logout');
?>
