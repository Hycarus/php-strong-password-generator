<?php
session_start();
if (isset($_SESSION['auth_token'])) {
    session_destroy();
    header('Location: index.php');
}
header('Location: index.php');
die();
