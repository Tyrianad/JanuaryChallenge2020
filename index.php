<?php
require_once 'vendor/FormManager.php';

$formManager = new FormManager('f-config.json');

$success_submit = $formManager->interceptSubmit();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>January 2020 Challenge</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .form-check-label{
            cursor:pointer;
        }
    </style>
</head>
<body class="container">
<div class="row">
    <div class="col-8 offset-2">
        <?php
        if($success_submit)
        {
            ?>
            <div class="alert alert-success mt-4">
                Form submitted!
            </div>
        <?php
        }
        else
        {
            ?>
            <div class="alert alert-danger">
                There was an error while processing your request!
            </div>
        <?php
        }
        ?>
        <div class="jumbotron mt-4">
            <h3 class="pb-3">Please fill in all the informations</h3>
        <?php
        echo  $formManager->getHtml();
        ?>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>