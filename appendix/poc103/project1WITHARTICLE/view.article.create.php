<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Article</title>
</head>
<body>

<?php

$url = $httpMessageHandler['URL'];
$user_id = $httpMessageHandler['SESSION']['user_id'] ?? -1;
?>
<div>
    <h4>Add New Article</h4>

    <p>New article</p>

<form action="<?= $url ?>" method="POST">
    <input type="hidden" name="theme" value="articles" />
    <input type="hidden" name="action" value="store" />
    <input type="hidden" name="controller" value="ArticleController" />

    <label for="title">Title:</label><input type="text" name="title" />
    <textarea name="body" rows="4" cols="50" placeholder=""></textarea>
    <input type="hidden" name="user_id" value="<?= $user_id ?>" />
    <input type="hidden" name="submitted" value="1" />
    <input type="submit" value="Submit">
</form>
</div>

<div>
    <a href="./index.php?theme=articles&action=index&controller=ArticleController">articles</a><br />
    <a href="./index.php">index</a><br />
</div>

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
