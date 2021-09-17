<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
</head>
<body>

<?php
$article = $databag['level1payload']['article'];

?>
<div>
    <h4>Article</h4>

    <p>#<?= $article['id'] ?></p>
    <p>Title: <?= $article['title'] ?></p>
    <div><?= $article['body'] ?></div><br />
</div>

<div>
    <a href="./index.php?theme=articles&action=edit&id=<?= $article['id'] ?>&controller=ArticleController">edit</a><br />
    <br />
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
