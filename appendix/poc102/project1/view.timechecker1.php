<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time checker 1</title>
</head>
<body>

<?php
$credential = $databag['level1payload']['credential'];
$url = $httpMessageHandler['URL'];
?>

<?php
if ($credential['isLoggedIn'] === true) {
    // show links leading to logged-in-only pages
    // show logout button

    echo "welcome, " . $credential['username'] . ".";
    echo "<br />";
    echo "it is " . (new DateTime())->format('Y-m-d H:i:s') . " now." . "<br />";
    echo <<<EOT
<a href="./index.php">index</a><br />
EOT;
}
if ($credential['isLoggedIn'] === false) {
    // show login button
    echo <<<EOT
<a href="./index.php?action=login">click to login</a>
EOT;
}
?>

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
http://localhost:8000/index.php
http://localhost:8000/index.php?action=timechecker1
http://localhost:8000/index.php?action=timechecker2

http://localhost:8000/index.php?action=start1&name=you"><script>alert('XSS');</script>
http://localhost:8000/index.php"><script>alert(‘xss’);</script>

http://localhost:8000/index.php?name=tom&keyword=you"><script>alert('XSS');</script>
-->
