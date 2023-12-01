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
    <?php } elseif ($error) {    ?>
        <div class="alert alert-danger my-3">
            <h2>
                <?php echo $error ?>
            </h2>
        </div>
    <?php } ?>
    <form class="d-flex align-items-center flex-wrap my-5" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET" class='py-5'>
        <input class="w-25 me-2" type="number" min='8' max='20' name="passwordLength">
        <button class="btn btn-success me-2" type='submit'>Genera</button>
        <button class="btn btn-danger" type='reset'>Reset</button>
        <?php if (isset($_GET['advanced'])) { ?>
            <div class="w-100">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="repeat">
                    <label class="form-check-label" for="flexSwitchCheckChecked">Consenti ripetizioni di uno o più caratteri</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="letters" id="flexCheckIndeterminate" name="character[]">
                    <label class="form-check-label" for="flexCheckIndeterminate">
                        Includi Lettere
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="number" id="flexCheckIndeterminate" name="character[]">
                    <label class="form-check-label" for="flexCheckIndeterminate">
                        Includi Numeri
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="symbol" id="flexCheckIndeterminate" name="character[]">
                    <label class="form-check-label" for="flexCheckIndeterminate">
                        Includi Simboli
                    </label>
                </div>
            </div>
        <?php } ?>
    </form>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
        <button class="btn btn-primary" type="submit" name="advanced">Opzioni avanzate</button>
    </form>



</main>

<?php
include __DIR__ . '/partials/footer.php';
?>