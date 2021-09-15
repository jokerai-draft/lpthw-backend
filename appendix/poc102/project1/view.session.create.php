<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<?php
/*
// 以下判断是不必要的，因为会直接提示 你已经登入 并且 redirect (这是在控制器里完成的 isAlreadyLoggedIn )
if ($__isLoggedIn === true) {
    // show links leading to logged-in-only pages
    // show logout button
}
if ($__isLoggedIn === false) {
    // show login button
}
*/
?>

<?php
$url = $httpMessageHandler['URL'];
?>

<h4>Login Form</h4>

<form action="<?= $url ?>" method="POST">
    <input type="hidden" name="theme" value="default" />
    <input type="hidden" name="action" value="login" />
    <input type="hidden" name="controller" value="SessionController" />

    <label for="username">Username:</label>
    <input type="text" name="username" />
    <label for="password">Password:</label>
    <input type="password" name="password" />
    <input type="hidden" name="submitted" value="1" />
    <input type="submit" value="Sign in">
</form>

<a href="./index.php">index</a>

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
http://localhost:8000/index.php?action=login
http://localhost:8000/index.php?action=timechecker2

http://localhost:8000/index.php?action=start1&name=you"><script>alert('XSS');</script>
http://localhost:8000/index.php"><script>alert(‘xss’);</script>

http://localhost:8000/index.php?name=tom&keyword=you"><script>alert('XSS');</script>
-->
