<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Task 1 - Advanced</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </head>
    <body class="pt-3 container">
        <div>
            <h2>Interest Rate Calculator</h2>
        </div>

        <form class="pt-3 pb-3" action="" method="POST">
            <div class="form-group">
                <label for="loanAmt">Loan Amount (RM)</label>
                <input type="number" class="form-control" id="loanAmt" name="loanAmt" min="1" placeholder="400000">
            </div>

            <div class="form-group">
                <label for="monthlyRepayment">Monthly Payment (RM)</label>
                <input type="number" class="form-control" id="monthlyRepayment" min="1" name="monthlyRepayment" step=".01" placeholder="1500">
            </div>

            <div class="form-group">
                <label for="loanTerm">Loan Term (in years)</label>
                <input type="number" class="form-control" id="loanTerm" min="1" name="loanTerm" placeholder="30">
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

        <?php
        if (isset($_POST['submit_form'])) :
            $loanAmt = filter_input(INPUT_POST, 'loanAmt');
            $monthlyRepayment = filter_input(INPUT_POST, 'monthlyRepayment');
            $loanTerm = filter_input(INPUT_POST, 'loanTerm');

            if (is_numeric($loanAmt) && is_numeric($monthlyRepayment) && is_numeric($loanTerm)) {
                $interestRate = calculateInterestRate($loanAmt, $monthlyRepayment, $loanTerm);
                echo "<b>Interest Offer to look for</b> is <b>" . round($interestRate, 2) . "%</b>";
            } else {
                echo "<div class='text-danger'>Please enter all required input fields.</div>";
            }
        endif;

        function calculateInterestRate($loanAmt, $monthlyRepayment, $loanTerm) {
            $N = $loanTerm * 12;
            $ints = array();

            for ($i = 1; $i <= 100; $i++) {
                $c = calculateMonthlyRepayment($loanAmt, $i, $N);

                //if the calculated is more than supplied monthlyPayment, no use of calculating the preceeding values.`
                if ($c > $monthlyRepayment) {
                    break;
                }

                $ints[] = $c;
            }

            //Calculate the possible integer interest rate. Returns the integer value in the interest. (E.g. X.YY%, calculates value of X)
            $possibleInterestInt = array_search(getClosest($monthlyRepayment, $ints), $ints) + 1;

            unset($ints);
            $ints = array();

            for ($i = $possibleInterestInt * 10; $i <= ($possibleInterestInt + 1) * 10; $i++) {
                $val = $i / 10; //instead of looping through decimals, use integer in loop then divide by 10 to get the decimal.
                $c = calculateMonthlyRepayment($loanAmt, $val, $N);

                if ($c > $monthlyRepayment) {
                    break;
                }

                $ints[] = $c;
            }

            //Calculates the possible decimal value of the interest rate. (E.g. X.YZ%, calculates value of Y)
            $possibleInterestDec = strval($possibleInterestInt) . "." . strval(array_search(getClosest($monthlyRepayment, $ints), $ints));

            unset($ints);
            $ints = array();

            for ($i = 0; $i <= 10; $i++) {
                $val = $possibleInterestDec + $i / 100;
                $c = calculateMonthlyRepayment($loanAmt, $val, $N);

                if (round($c) > round($monthlyRepayment)) {
                    break;
                }

                $ints[] = $c;
            }

            //Calculates the possible decimal value of the interest rate. (E.g. X.YZ%, calculates value of Z)
            $possibleInterestDec = strval($possibleInterestDec) . strval(array_search(getClosest($monthlyRepayment, $ints), $ints));
            
            return $possibleInterestDec;
        }

        function calculateMonthlyRepayment($loanAmt, $interestRate, $loanTerm) {
            $r = ($interestRate / 100.00) / 12;
            $c = $loanAmt * ($r / (1 - pow(1 + $r, -$loanTerm)));
            
            return $c;
        }

        function getClosest($search, $arr) {
            $closest = null;
            foreach ($arr as $item) {
                if ($closest === null || abs($search - $closest) > abs($item - $search)) {
                    $closest = $item;
                }
            }
            return $closest;
        }

        include_once 'Footer.php';
        ?>
    </body>

    <script>
        function autoFill() {
            document.getElementById('loanAmt').value = "400000";
            document.getElementById('monthlyRepayment').value = "1500";
            document.getElementById('loanTerm').value = "30";
        }
    </script>
</html>
