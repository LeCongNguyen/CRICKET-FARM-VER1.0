<!DOCTYPE html>
<html>

<head>
    <title>CricketFarm</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--link boostrap 4.0 online-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <?php
    require("./php_action/showRoomParameters.php");
    ?>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            showRoomParameters("localhost", "cricket_farm_ver1.0", "root@", "");
            ?>
        </div>
    </div>
</body>

</html>