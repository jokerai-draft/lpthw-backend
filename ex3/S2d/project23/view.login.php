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
} else {
?>
<h4>Welcome</h4><br><br><br><br>
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
