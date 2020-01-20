<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once 'vendor/FormManager.php';
$formManager = new FormManager('f-config.json');
$formManager->interceptSubmit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>January 2020 Challenge</title>
    <?php
        echo  $formManager->getHtml();
    ?>
</head>
<body>
</body>
</html>