<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <style>
            .footer{
                position: absolute;
                bottom: 0;
                width: 60%;
                height: 60px;
                line-height: 60px;
                display: block;
            }
        </style>
    </head>
    <footer class="footer">
        <div class="container text-center">
            <a href="Main.php" class="btn text-success btn-lg font-weight-bold">Return to Menu</a>
        </div>
    </footer>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</html>
