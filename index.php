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
        <div class="alert alert-success my-3">
            <h2>La tua password è:
                <?php echo $_SESSION['password'] ?>
            </h2>
        </div>
    <?php } ?>
    <form class="d-flex my-5" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET" class='py-5'>
        <input class="w-25 me-2" type="number" min='8' max='20' name="passwordLength">
        <button class="btn btn-success me-2" type='submit'>Genera</button>
        <button class="btn btn-danger" type='reset'>Reset</button>
    </form>
</main>

<?php
include __DIR__ . '/partials/footer.php';
?>