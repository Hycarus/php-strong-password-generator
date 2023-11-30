<?php

function generatePassword()
{
    $symbols = '!?&%$<>^+-\*/()[]{}@#\_=';
    $letters = 'qwertyuiopasdfghjklzxcvbnm';
    $upLetters = strtoupper($letters);
    $numbers = '0123456789';

    if (isset($_GET['passwordLength'])) {
        $passwordLength = $_GET['passwordLength'];
        $newPassword = '';
        while (strlen($newPassword) < $passwordLength) {

            $valoriDisponibili = $symbols . $letters . $upLetters . $numbers;
            $newCharacter = $valoriDisponibili[rand(0, strlen($valoriDisponibili) - 1)];
            if (!strpos($newPassword, $newCharacter)) {
                $newPassword .= $newCharacter;
            }
        }
        // var_dump($newPassword);
        $_SESSION['password'] = $newPassword;
        header('Location: index.php');
        die();
    }
    return false;
}
function login()
{
    if ((isset($_POST['email']) && $_POST['email'] !== '') && (isset($_POST['password']) && $_POST['password'] !== '')) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        // var_dump($_POST);
        $error = checkPassword($password);
        if ($error) {
            return $error;
        }
        $_SESSION['auth_token'] = rand(10000, 99999) . $email;
    }
    if (!empty($_SESSION['auth_token'])) {
        header('Location: index.php');
    }
}
function checkPassword($password)
{
    if (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters';
        return $error;
    } else {
        return false;
    }
}
