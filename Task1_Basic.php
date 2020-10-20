<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Task 1 - Basic</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </head>
    <body class="pt-3 container">
        <div>
            <h2>Monthly Repayment</h2>
        </div>

        <form class="pt-3 pb-3" action="" method="POST">
            <div class="form-group">
                <label for="pAmt">Loan Amount (RM)</label>
                <input type="number" class="form-control" id="pAmt" name="pAmt" placeholder="400000">
            </div>

            <div class="form-group">
                <label for="interestRate">Annual Interest Rate (%)</label>
                <input type="number" class="form-control" id="interestRate" name="interestRate" step=".01" placeholder="4.00">
            </div>

            <div class="form-group">
                <label for="period">Loan Term (in years)</label>
                <input type="number" class="form-control" id="period" name="period" min="1" placeholder="30">
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
                document.getElementById('pAmt').value = "400000";
                document.getElementById('interestRate').value = "4.00";
                document.getElementById('period').value = "30";
            }
        </script>

        <?php
        if (isset($_POST['submit_form'])) :
            $loanAmt = filter_input(INPUT_POST, 'pAmt');
            $interestRate = filter_input(INPUT_POST, 'interestRate');
            $loanTerm = filter_input(INPUT_POST, 'period');

            if (is_numeric($loanAmt) && is_numeric($loanTerm) && is_numeric($interestRate)) {
                $monthlyPayment = calculateMonthlyRepayment($loanAmt, $interestRate, $loanTerm);
                
                echo "Loan Amount: RM$loanAmt<br/>";
                echo "Annual Interest Rate: $interestRate%<br/>";
                echo "Loan Term: $loanTerm years<br/><br/>";
                echo "<b>Monthly Repayment</b>: <b>RM" . round($monthlyPayment, 2) . "</b>";
            } else {
                echo "<div class='text-danger'>Please enter all required input fields.</div>";
            }
        endif;

        function calculateMonthlyRepayment($loanAmt, $interestRate, $loanTerm) {
            //Number of payments
            $N = $loanTerm * 12;

            //Interest rate per month
            $r = ($interestRate / 100.00) / 12;

            //$c = $principalAmt * ($r * pow(1 + $r, $N) / (pow(1 + $r, $N) - 1));
            //Monthly repayment
            $c = $loanAmt * ($r / (1 - pow(1 + $r, -$N)));

            return $c;
        }
        include_once 'Footer.php';
        ?>
    </body>
</html>
