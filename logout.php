<?php
    session_start();
    session_destroy();
    header("Location:warning.php");
?>