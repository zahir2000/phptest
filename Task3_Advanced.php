<?php require_once 'Lcg.php'; ?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Task 3 - Basic</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </head>
    <body class="pt-3 container">
        <div>
            <h2>Decryption Function</h2>
        </div>

        <form class="pt-3 pb-3" action="" method="POST">
            <div class="form-group">
                <label for="encryptText">Enter Text to Encrypt</label>
                <input type="text" class="form-control" id="encryptText" name="encryptText" placeholder="Enter something">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Encrypt Me!</button>
            <input type="hidden" name="submit_form" value="1" />
        </form>

        <?php
        if (isset($_POST['submit_form'])) {
            $textToEncrypt = filter_input(INPUT_POST, 'encryptText');

            if (!empty($textToEncrypt)) {
                $encrypt = encrypt($textToEncrypt);
                echo "Original Text is <b class='text-success'>$textToEncrypt</b><br/>";
                echo "Encrypted value is <b class='text-info'>$encrypt</b><br/><br/>";
                
                $decrypt = decrypt($encrypt);
                echo "Decrypting <b class='text-info'>$encrypt</b> now...<br/>";
                echo "Decrypted value is <b class='text-success'>$decrypt</b><br/><br/>";
            } else {
                echo "<b class='text-danger'>Please enter a text.</b>";
            }
        }

        function encrypt($plainText) {
            $lcg = new Lcg(256, 11, 1, 0);
            $bytes = unpack('C*', $plainText);
            $xors = [];
            foreach ($bytes as $val) {
                $xors[] = $val ^ $lcg->next();
            }
            $str = pack('C*', ...$xors);
            return base64_encode($str);
        }

        function decrypt($base64EncodedValue) {
            $cipherText = base64_decode($base64EncodedValue);

            $lcg = new Lcg(256, 11, 1, 0);
            $bytes = unpack('C*', $cipherText);
            $xors = [];
            foreach ($bytes as $val) {
                $xors[] = $val ^ $lcg->next();
            }
            $str = pack('C*', ...$xors);
            return $str;
        }
        include_once 'Footer.php';
        ?>
    </body>
</html>
