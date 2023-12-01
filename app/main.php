<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./main.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="left">
            <?php
            include("./views/layouts/sidebar.php");
            ?>
        </div>
        <div class="right">
            <?php
            include("./views/pages/ajukan-peminjaman/index.php");
            ?>
        </div>
    </div>
</body>
<script src="./views/layouts/sidebar.js"></script>

</html>