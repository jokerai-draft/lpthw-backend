<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document 2</title>
</head>
<body>

<?php
$counter = $databag['level1payload']['counter'];
$step = $databag['level1payload']['step'];
$name = $httpMessageHandler['GET']['name'] ?? "tom";
$url = $httpMessageHandler['URL'];
?>

<h4>hi <?= $name ?></h4>

<h4>Play with counter</h4>

<form action="<?= $url ?>" method="POST">
    <input type="hidden" name="theme" value="default" />
    <input type="hidden" name="action" value="store" />

    <input type="submit" name="operation" value="+" />
    <span><?= $counter ?></span>
    <input type="submit" name="operation" value="-" /><br>
    <label for="step">step </label>
    <input type="text" id="step" name="step" value="<?= $step ?>" /><br>
    <input type="hidden" name="submitted" value="1" />
    <input type="button" value="clean" onclick="document.getElementById('step').value='0';" />
</form>

<?php
$__isDebug = false;
// $__isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
$__isLoggedIn = $httpMessageHandler['SESSION']['isLoggedIn'] ?? false;
#debug
if ($__isDebug) {
    echo "<pre>";
    print_r($httpMessageHandler);
    print_r($databag);
    // print_r($_SESSION);
    echo "</pre>";
}
?>

</body>
</html>
<!--
http://localhost:8000/index.php?action=default
http://localhost:8000/index.php?action=default&name=lucy

-->
