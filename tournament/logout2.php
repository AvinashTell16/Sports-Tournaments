<?php
session_start();
session_destroy();
session_unset();

header("Location: admin.php",TRUE,301);
?>