<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Task 2 - Basic</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </head>
    <body class="pt-3 container">
        <div>
            <h2>Check Digit Algorithm</h2>
        </div>

        <form class="pt-3 pb-3" action="" method="POST">
            <div class="form-group">
                <label for="numValue">Enter Value</label>
                <input type="number" class="form-control" id="numValue" name="numValue" placeholder="98062477123">
            </div>

            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary btn-block">Calculate</button>
                </div>
                <div class="col-md-6">   
                    <button type="button" class="btn btn-secondary btn-block" data-toggle="tooltip" data-placement="bottom" title="Autofill with given values in the task." onclick="autoFill()">Auto Fill Values</button>
                </div>
            </div>

            <input type="hidden" name="submit_form" value="1" />
        </form>

        <script>
            function autoFill() {
                document.getElementById('numValue').value = "98062477123";
            }
        </script>

        <?php
        if (isset($_POST['submit_form'])) {
            $numValue = filter_input(INPUT_POST, 'numValue');

            if (is_numeric($numValue)) {
                $sum = 0;
                $checkDigit = calculateCheckDigit($numValue);

                echo "Given value is $numValue" . "<br/>";
                echo "Check Digit is <b class='text-danger'>$checkDigit</b>" . "<br/>";
                echo "Generated value is $numValue<b class='text-danger'>$checkDigit</b>";
            } else {
                echo "<div class='text-danger'>Please enter all required input fields.</div>";
            }
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
