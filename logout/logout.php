<?php
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../gdnguoidung/index.php?page=trangchu");
    exit();
?>