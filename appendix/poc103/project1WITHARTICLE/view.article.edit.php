<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
</head>
<body>

<?php
$article = $databag['level1payload']['article'];
$url = $httpMessageHandler['URL'];
$user_id = $httpMessageHandler['SESSION']['user_id'] ?? -1;
?>
<div>
    <h4>Edit Article</h4>

    <p>Article #<?= $article['id'] ?></p>

<form action="<?= $url ?>" method="POST">
    <input type="hidden" name="theme" value="articles" />
    <input type="hidden" name="action" value="update" />
    <input type="hidden" name="controller" value="ArticleController" />

    <label for="title">Title:</label><input type="text" name="title" value="<?= $article['title'] ?>" /><br />
    <textarea name="body" rows="10" cols="50"><?= $article['body'] ?></textarea>
    <input type="hidden" name="id" value="<?= $article['id'] ?>" />
    <input type="hidden" name="user_id" value="<?= $article['user_id'] ?>" />
    <input type="hidden" name="submitted" value="1" /><br />
    <input type="submit" value="Submit">
</form><br />
</div>

<div>
    <a href="./index.php?theme=articles&action=show&id=<?= $article['id'] ?>&controller=ArticleController">back</a><br /><br />
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
