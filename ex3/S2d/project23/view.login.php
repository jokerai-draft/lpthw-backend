<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document 1</title>
    <style>
        .container {
            display: flex;
            flex-direction: row;
        }
        .container > div {
            margin: 30px 30px;
        }
    </style>
</head>
<body>
    <h4>Login</h4>

<?php
$msg = $databag['level1payload']['msg'];
$isLoggedIn = $databag['level1payload']['isLoggedIn'];
$url = $httpMessageHandler['URL'];
?>

<b><?= $msg ?></b>
<?php
if ($isLoggedIn !== true) {
?>
<form action="<?= $url ?>" method="POST">
    <label for="">username</label><br />
    <input type="text" name="username" /><br />
    <label for="">password</label><br />
    <input type="password" name="password" /><br />
    <input type="hidden" name="submitted" value="1" />
    <input type="submit" name="submit" value="submit" />
</form>
<?php
}
if ($isLoggedIn === true) {
?>
<h4>Welcome</h4>
<p>wow look at this ...</p>
<a href="./document1.php" target="_blank">document1</a> <a href="./document2.php" target="_blank">document2</a>
<a href="./document3.php" target="_blank">document3</a>
<br><br><br><br>
<?php require 'partial.logout-button.php'; ?>
<?php
}
?>
</body>
</html>
<!--
http://localhost:8000/document1.php
http://localhost:8000/document1.php?name=tom
http://localhost:8000/document1.php"><script>alert(‘xss’);</script>

http://localhost:8000/document1.php?name=tom&keyword=you"><script>alert('XSS');</script>
-->
