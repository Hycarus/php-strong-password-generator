<?php

function generatePassword()
{
    $symbols = '!?&%$<>^+-\*/()[]{}@#\_=';
    $letters = 'qwertyuiopasdfghjklzxcvbnm';
    $upLetters = strtoupper($letters);
    $numbers = '0123456789';

    if (isset($_GET['passwordLength'])) {
        if (empty($_GET['character'])) {
            return 'Che password vuoi senza niente??';
        }
        $passwordLength = $_GET['passwordLength'];
        $newPassword = '';
        if (count($_GET['character']) === 3) {
            $valoriDisponibili = $symbols . $letters . $upLetters . $numbers;
        } else if (in_array('letters', $_GET['character']) && in_array('number', $_GET['character'])) {
            $valoriDisponibili = $letters . $upLetters . $numbers;
        } else if (in_Array('letters', $_GET['character']) && in_array('symbol', $_GET['character'])) {
            $valoriDisponibili = $letters . $upLetters . $symbols;
        } else if (in_array('number', $_GET['character']) && in_array('symbol', $_GET['character'])) {
            $valoriDisponibili = $numbers . $symbols;
        } else if (in_array('letters', $_GET['character'])) {
            $valoriDisponibili = $letters . $upLetters;
        } else if (in_array('number', $_GET['character'])) {
            $valoriDisponibili = $numbers;
        } else if (in_array('symbol', $_GET['character'])) {
            $valoriDisponibili = $symbols;
        }
        while (strlen($newPassword) < $passwordLength) {
            $newCharacter = $valoriDisponibili[rand(0, strlen($valoriDisponibili) - 1)];
            if (isset($_GET['repeat'])) {
                $newPassword .= $newCharacter;
            } else {
                if (!str_contains($newPassword, $newCharacter)) {
                    $newPassword .= $newCharacter;
                }
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
