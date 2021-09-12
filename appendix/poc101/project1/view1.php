<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document 1</title>
</head>
<body>

<?php
$greetings = $databag['level1payload']['greetings'];
$luckyNumber = $databag['level1payload']['luckyNumber'];
$age = $databag['age'];
$name = $httpMessageHandler['GET']['name'] ?? "";
?>
<h4><?= $greetings ?></h4>
<h4>how are you?</h4>
<h4>I am <?= $age ?>℃.</h4>
<div>My luck number is: <h4><?= $luckyNumber ?></h4><div>


<?php
if ($name === "") {
    $joke = "Lily's hat is on the ground.";
} else {
    $joke = "{$name}'s hat is on the ground.";
}
?>
<h4><?= $joke ?></h4>


<?php
$__isDebug = false;
// $__isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
$__isLoggedIn = $databag['SESSION']['isLoggedIn'] ?? false;
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
http://localhost:8000/index.php
http://localhost:8000/index.php?name=tom
http://localhost:8000/index.php?name=you"><script>alert('XSS');</script>
http://localhost:8000/index.php"><script>alert(‘xss’);</script>

http://localhost:8000/index.php?name=tom&keyword=you"><script>alert('XSS');</script>
-->
