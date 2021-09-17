<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document 1</title>
</head>
<body>

<i>Now that you're here.</i>

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
    echo <<<EOT
<a href="./index.php?action=timechecker1">timechecker1</a><br />
<a href="./index.php?action=timechecker2">timechecker2</a><br />
<form action="$url" method="POST">
    <input type="hidden" name="theme" value="default" />
    <input type="hidden" name="action" value="logout" />
    <input type="hidden" name="controller" value="SessionController" />
    <input type="hidden" name="submitted" value="1" />
    <input type="submit" value="Logout">
</form>
EOT;
}
if ($credential['isLoggedIn'] === false) {
    // show login button
    echo <<<EOT
<a href="./index.php?action=login">click to login</a><br />
<a href="./index.php?action=index&controller=ContactController">contacts</a><br />
<a href="./index.php">index</a><br />
EOT;
}
?>

<?php
$__isDebug = true;
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
