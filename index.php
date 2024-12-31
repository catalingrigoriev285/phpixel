<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>phpixel</title>
</head>

<body>
    <?php
    $config = require 'app/config.php';
    require_once 'app/models/User.php';

    $test = User::update(['name' => 'Alexandru'], 4);


    ?>
</body>

</html>