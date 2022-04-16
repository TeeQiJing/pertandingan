<!-- Pg 84 -->
<?php
    session_start();
    session_destroy();
    header("location: login.php");
?>