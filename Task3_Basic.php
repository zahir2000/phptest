<?php require_once 'Lcg.php'; ?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Task 3 - Advanced</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </head>
    <body class="pt-3 container">
        <div>
            <h2>Check Prime Number from LCG</h2>
        </div>

        <form class="pt-3 pb-3" action="" method="POST">
            <div class="form-check pb-3">
                <input type="checkbox" class="form-check-input" id="showAllPrimes" name="showAllPrimes">
                <label class="form-check-label" for="showAllPrimes">Show All Prime Numbers</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Calculate</button>
            <input type="hidden" name="submit_form" value="1" />
        </form>

        <?php
        if (isset($_POST['submit_form'])) {
            $isShowAllPrimeNum = filter_input(INPUT_POST, 'showAllPrimes');

            $lcg = new Lcg(65536, 137, 1, 0);
            $primeCounter = 0;
            $num = 0;

            while ($primeCounter < 100) {
                $num = $lcg->next();
                if (isPrimeNumber($num)) {
                    $primeCounter++;
                    if (isset($isShowAllPrimeNum)) {
                        print "$primeCounter -> " . $num . "<br/>";
                    }
                }
            }

            echo "<br/>100th Prime Number is <b>$num</b><br/><br/>";
        }

        function isPrimeNumber($num) {
            if ($num == 1) {
                return false;
            }
            for ($i = 2; $i <= $num / 2; $i++) {
                if ($num % $i == 0) {
                    return false;
                }
            }

            return true;
        }
        ?>
        <footer class="footer pt-5">
            <div class="container text-center">
                <a href="Main.php" class="btn text-success btn-lg font-weight-bold">Return to Menu</a>
            </div>
        </footer>
    </body>
</html>
