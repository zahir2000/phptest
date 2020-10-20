<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Task 2 - Advanced</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </head>
    <body class="pt-3 container">
        <div>
            <h2>Check Digit Algorithm - Uniformity</h2>
        </div>
        
        <form class="pt-3 pb-3" action="" method="POST">
            <p>Given number range from 1 to 1,000,000. Tally and find if check digits are uniformly distributed.</p>
            <button type="submit" class="btn btn-primary btn-block">Calculate</button>
            <input type="hidden" name="submit_form" value="1" />
        </form>

        <?php
        if (isset($_POST['submit_form'])) {
            $numRange = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
            for ($i = 1; $i <= 1000000; $i++) {
                $checkDigit = calculateCheckDigit($i);
                $numRange[$checkDigit]++;
            }

            echo "Check Digit -> Frequency" . "<br/>";
            $i = 0;
            foreach ($numRange as $freq) {
                echo $i++ . " -> " . $freq . "<br/>";
            }
            
            echo "<br/>The output shows the check digits are <b>not</b> uniformly distributed";
            echo "<br/>Highest Frequency Check Digit is " . array_search(max($numRange), $numRange);
        }

        function calculateCheckDigit($numValue) {
            $sum = 0;
            $numValueSplit = str_split($numValue);

            /*
             * $r = array();
             * for ($i = 0; $i < strlen($numValue); $i++) {
             *     $r[] = substr($numValue, $i, 1);
             * }
             */

            foreach ($numValueSplit as $digit) {
                $sum += $digit;

                if ($sum % 2 == 0) {
                    $sum /= 2;
                } else {
                    $sum = ($sum - 1) / 2;
                }
            }

            return $sum;
        }
        include_once 'Footer.php';
        ?>
    </body>
</html>
