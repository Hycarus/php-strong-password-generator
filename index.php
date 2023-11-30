<?php

include __DIR__ . '/partials/header.php';
if (!isset($_SESSION['auth_token'])) {
    header('Location: login.php');
    exit;
}
$error = generatePassword();

?>



<main class="container">
    <?php if (!empty($_SESSION['password'])) { ?>
        <div class="alert alert-success">
            <h2>
                <?php echo $_SESSION['password'] ?>
            </h2>
        </div>
    <?php } ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET" class='py-5'>
        <input type="number" min='8' max='20' name="passwordLength">
        <button type='submit'>Genera</button>
        <button type='reset'>Reset</button>
    </form>
</main>

<?php
include __DIR__ . '/partials/footer.php';
?>